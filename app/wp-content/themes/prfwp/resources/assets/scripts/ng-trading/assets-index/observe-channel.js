import * as rx from '../utils/rx';

export function observeChannel(socketService, channel) {
    return new rx.Observable(observer => {
        const onDataFn = data => {
            observer.next(data);
        };

        socketService.subscribe(channel, onDataFn);

        return () => {
            socketService.unsubscribe(channel, onDataFn);
        };
    });
}
