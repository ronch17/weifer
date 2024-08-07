import { observeComponentLifecycles } from '../../utils/observe-component-lifecycles';
import * as rx from '../../utils/rx';
// import * as _ from '../utils/lodash';
// import * as dt from '../utils/date-fns';
// import { tapLog } from '../utils/tap-log';

const styles = require('./calendar-widget.component.scss');

import { startOfWeek, endOfWeek, eachDay, subDays, addDays, format } from 'date-fns';

import template from './calendar-widget.component.html';
import { useStreams } from '../../utils/use-streams';

function createDateStats(date) {
    return {
        title: `${date.getDate()} ${date.toLocaleString('default', {
            month: 'short',
        })}`,
        subtitle: `${date.toLocaleString('default', { weekday: 'short' })}`,
        key: format(date, 'DD/MM/YYYY'),
        date,
    };
}

function addEventsInfoToDayStats(dayStat, groupedEvents) {
    if (!groupedEvents[dayStat.key]) {
        return { ...dayStat, text: 'no events' };
    }

    if (groupedEvents[dayStat.key].length === 1) {
        return { ...dayStat, text: 'one event' };
    }
    return { ...dayStat, text: `${groupedEvents[dayStat.key].length} events` };
}

class Controller {
    constructor(prfEventsService) {
        this.dataPickerOpened = true;
        this.styles = styles;
        this.prfEventsService = prfEventsService;
        this.lifecycles = observeComponentLifecycles(this);
        this.selectedDate$ = new rx.BehaviorSubject(new Date());
        this.selectedKey$ = new rx.BehaviorSubject(null);
        this.dayEvents$ = new rx.BehaviorSubject(null);
        this.isLoading$ = new rx.BehaviorSubject(true);
        this.startDate$ = new rx.BehaviorSubject(null);
        this.endDate$ = new rx.BehaviorSubject(null);
        this.currentSliceDays$ = new rx.BehaviorSubject([]);
        this.opMovePrevPage$ = new rx.Subject();
        this.opMoveNextPage$ = new rx.Subject();
        Object.defineProperty(this, 'selectedDate', {
            get: () => {
                return this.selectedDate$.getValue();
            },
            set: value => {
                this.selectedDate$.next(value);
            },
        });

        useStreams(
            [
                this.streamCalcFirstSelectedDate(),
                this.streamCalcCurrentSliceDays(),
                this.streamMoveNextPage(),
                this.streamMovePrevPage(),
                this.streamCalcSelectedKey(),
                this.streamCalcDayEvents(),
            ],
            this.lifecycles.onDestroy$
        );
    }

    $onInit() {}

    $onDestroy() {}

    $onChanges() {}

    streamCalcFirstSelectedDate() {
        return rx.pipe(
            () => this.lifecycles.onInit$,
            rx.map(() => new Date()),
            rx.tap(date => this.selectedDate$.next(date))
        )(null);
    }

    streamCalcCurrentSliceDays() {
        return rx.pipe(
            () => this.selectedDate$,
            rx.tap(() => this.isLoading$.next(true)),
            rx.switchMap(selectedDate => rx.obs.from(this.getGroupedEvents(selectedDate))),
            rx.withLatestFrom(this.selectedDate$),
            rx.map(([groupedEvents, selectedDate]) => this.calcWeekDays(selectedDate, groupedEvents)),
            rx.tap(({ startDate, endDate, weekDays }) => {
                this.currentSliceDays$.next(weekDays);
                this.startDate$.next(startDate);
                this.endDate$.next(endDate);
            }),
            rx.tap(() => this.isLoading$.next(false))
        )(null);
    }

    streamMoveNextPage() {
        return rx.pipe(
            () => this.opMoveNextPage$,
            rx.withLatestFrom(this.selectedDate$),
            /* eslint-disable-next-line no-unused-vars */
            rx.map(([a, selectedDate]) => addDays(selectedDate, 7)),
            rx.tap(selectedDate => this.selectedDate$.next(selectedDate))
        )(null);
    }

    streamMovePrevPage() {
        return rx.pipe(
            () => this.opMovePrevPage$,
            rx.withLatestFrom(this.selectedDate$),
            /* eslint-disable-next-line no-unused-vars */
            rx.map(([a, selectedDate]) => subDays(selectedDate, 7)),
            rx.tap(selectedDate => this.selectedDate$.next(selectedDate))
        )(null);
    }

    streamCalcSelectedKey() {
        return rx.pipe(
            () => this.selectedDate$,
            rx.map(date => format(date, 'DD/MM/YYYY')),
            rx.tap(dateFormatted => this.selectedKey$.next(dateFormatted))
        )(null);
    }

    streamCalcDayEvents() {
        return rx.pipe(
            () => this.selectedKey$,
            /* eslint-disable-next-line no-unused-vars */
            rx.switchMap(selectedKey => rx.obs.from(this.getGroupedEvents())),
            rx.withLatestFrom(this.selectedKey$),
            rx.map(([groupedEvents, selectedKey]) => groupedEvents[selectedKey]),
            rx.map(events => (events ? events : [])),
            rx.map(events =>
                events.map(event => {
                    return {
                        date: event.date,
                        time: event.time,
                        event: event.title.rendered,
                        impact: event.level,
                        assets: event.assets
                            ? Object.keys(event.assets).reduce((acc, key) => {
                                  if (event.assets[key] === '') {
                                      return acc;
                                  }
                                  return [...acc, ...event.assets[key]];
                              }, [])
                            : [],
                    };
                })
            ),
            rx.tap(events => this.dayEvents$.next(events))
        )(null);
    }

    getGroupedEvents() {
        return this.prfEventsService.getList();
    }

    calcWeekDays(day, groupedEvents) {
        const startDate = startOfWeek(day);
        const endDate = endOfWeek(day);

        const weekDays = eachDay(startDate, endDate)
            .map(date => createDateStats(date))
            .map(dayStat => addEventsInfoToDayStats(dayStat, groupedEvents));

        return {
            startDate,
            endDate,
            weekDays,
        };
    }
}

Controller.$inject = ['prfEventsService'];

export const CalendarWidgetComponent = {
    template,
    controller: Controller,
    bindings: {
        events: '<',
    },
};
