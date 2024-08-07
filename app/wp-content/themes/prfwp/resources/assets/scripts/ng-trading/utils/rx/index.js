import { Observable } from 'rxjs/internal/Observable';
import { Subject } from 'rxjs/internal/Subject';
import { BehaviorSubject } from 'rxjs/internal/BehaviorSubject';

import { map } from 'rxjs/internal/operators/map';
import { tap } from 'rxjs/internal/operators/tap';
import { filter } from 'rxjs/internal/operators/filter';
import { catchError } from 'rxjs/internal/operators/catchError';
import { switchMap } from 'rxjs/internal/operators/switchMap';
import { withLatestFrom } from 'rxjs/internal/operators/withLatestFrom';
import { debounceTime } from 'rxjs/internal/operators/debounceTime';
import { startWith } from 'rxjs/internal/operators/startWith';
import { delay } from 'rxjs/internal/operators/delay';
import { timeoutWith } from 'rxjs/internal/operators/timeoutWith';

import { pipe } from 'rxjs/internal/util/pipe';

import { timer } from 'rxjs/internal/observable/timer';
import { from } from 'rxjs/internal/observable/from';
import { fromEvent } from 'rxjs/internal/observable/fromEvent';
import { combineLatest } from 'rxjs/internal/observable/combineLatest';
import { of } from 'rxjs/internal/observable/of';

const obs = {
    from,
    of,
    combineLatest,
    fromEvent,
    timer,
};

export {
    Observable,
    Subject,
    BehaviorSubject,
    map,
    tap,
    switchMap,
    withLatestFrom,
    pipe,
    debounceTime,
    filter,
    catchError,
    startWith,
    delay,
    timeoutWith,
    obs,
};
