import { Subject } from 'rxjs/internal/Subject';
import * as _ from './lodash';

export function observeComponentLifecycles(context) {
    const origOnInit = context.$onInit;
    const origOnDestroy = context.$onDestroy;
    const origOnChanges = context.$onChanges;

    if ([origOnInit, origOnDestroy, origOnChanges].some(x => _.isNil(x))) {
        throw new Error('All lifecycles must be implemented');
    }

    const onInit$ = new Subject();
    const onDestroy$ = new Subject();
    const onChanges$ = new Subject();

    context.$onInit = () => {
        origOnInit.call(context);

        onInit$.next();
    };

    context.$onDestroy = () => {
        origOnDestroy.call(context);

        onDestroy$.next();
        onDestroy$.complete();
    };

    context.$onChanges = changesObj => {
        origOnChanges.call(context, changesObj);

        onChanges$.next(changesObj);
    };

    return {
        onInit$,
        onDestroy$,
        onChanges$,
    };
}
