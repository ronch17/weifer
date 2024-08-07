import { takeUntil } from 'rxjs/internal/operators/takeUntil';
import { pipe } from 'rxjs/internal/util/pipe';
import { combineLatest } from 'rxjs/internal/observable/combineLatest';

/**
 * Pattern to use streams inside a component.
 *
 * Subscribe to stream after all streams are constructed. Unsubscribe from it automaticly using `takeUntil`
 * the unsub$ observable emit that the component is ending it's life cycle.
 *
 * @param streams - The streams sources
 * @param usub$ - Observable returning when the component is ending.
 * @return - subscription.
 */
export function useStreams(streams, unsub$) {
    return pipe(() => combineLatest(streams), takeUntil(unsub$))(null).subscribe();
}
