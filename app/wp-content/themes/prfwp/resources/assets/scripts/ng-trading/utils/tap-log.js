import * as rx from './rx';

export function tapLog(name, ...args) {
    // tslint:disable-next-line:no-console
    return rx.tap(x => console.log(name, x, ...args.map(fn => fn())));
}
