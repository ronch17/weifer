import * as _ from '../lodash';
const io = require('socket.io-client');

export function createSocket(url, options, token) {
    const fullOptions = _.flow([acc => ({ ...options }), acc => (token ? { ...acc, query: `token=${token}` } : acc)])(
        {}
    );

    const socket = io(url, fullOptions);

    return socket;
}
