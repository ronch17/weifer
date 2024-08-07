import { pipe } from 'rxjs/internal/util/pipe';
import { map } from 'rxjs/internal/operators/map';
import { filter } from 'rxjs/internal/operators/filter';
import * as _ from './lodash';

export function filterCompChange(propertyName, onChange$) {
    return pipe(
        () => onChange$,
        map(changes => changes[propertyName]),
        filter(propChange => !_.isNil(propChange))
    )(null);
}
