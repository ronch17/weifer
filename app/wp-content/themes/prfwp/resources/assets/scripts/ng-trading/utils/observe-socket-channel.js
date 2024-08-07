import * as rx from './rx';
import * as _ from './lodash';
import io from 'socket.io-client';

function createSocket(url, query, options) {
    const socket = io(url, {
        query,
        ...options,
    });

    return socket;
}

export function observeSocketChannel(socketRegistryService, registryName, url, token, channelName) {
    return new rx.Observable(observer => {
        let socket = socketRegistryService.getSocket(registryName);
        if (_.isNil(socket)) {
            const query = `token=${token}`;
            const options = {
                transports: ['websocket'],
            };
            socket = createSocket(url, query, options);
            socketRegistryService.addSocket(registryName, socket);
        }

        if (socket.hasListeners(channelName) === false) {
            socket.emit('subscribe', channelName, res => {
                if (!res) {
                    console.warn('Unable to subscribe to', channelName);
                } else {
                    console.info(`socket ${registryName}, subscribed to ${channelName}`);
                }
            });
        }

        const onDataFn = data => {
            observer.next(data);
        };

        socket.addEventListener(channelName, onDataFn);

        return () => {
            socket.removeListener(channelName, onDataFn);

            if (socket.hasListeners(channelName)) {
                return;
            }

            socket.emit('unsubscribe', channelName, res => {
                if (!res) {
                    console.warn('Unable to unsubscribe', channelName);
                } else {
                    console.info(`socket ${registryName}, unsubscribed to ${channelName}`);
                }
            });
        };
    });
}
