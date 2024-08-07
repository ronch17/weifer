import { filterCompChange } from './filter-comp-change';
import { map } from 'rxjs/internal/operators/map';
import { pipe } from 'rxjs/internal/util/pipe';
import { tap } from 'rxjs/internal/operators/tap';

export function observeCompChange(value$, inputName, onChanges$) {
    return pipe(
        () => filterCompChange(inputName, onChanges$),
        map(({ currentValue }) => currentValue),
        tap(val => value$.next(val))
    )(null);
}
