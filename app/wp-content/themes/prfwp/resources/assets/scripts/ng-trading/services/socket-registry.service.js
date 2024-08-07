import * as _ from '../utils/lodash';

export class SocketRegistryService {
    constructor() {
        this.sockets = [];
    }

    addSocket(key, socket) {
        const sockets = Object.assign({}, this.sockets);
        sockets.key = socket;
        this.sockets = sockets;
    }

    removeSocket(key) {
        this.sockets = _.omit([key], this.sockets);
    }

    getSocket(key) {
        return this.sockets[key];
    }
}

SocketRegistryService.$inject = [];
