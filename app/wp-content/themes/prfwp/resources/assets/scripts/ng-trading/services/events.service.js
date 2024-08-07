import groupBy from 'lodash/fp/groupBy';

export class EventsService {
    constructor($http) {
        this.$http = $http;
        this.cache = null;
        this.cachePromise = null;
    }

    getList() {
        if (this.cache) {
            return Promise.resolve(this.cache);
        }

        if (this.cachePromise) {
            return this.cachePromise;
        }

        this.cachePromise = this.$http
            .get('/wp-json/wp/v2/event?per_page=100')
            .then(results => results.data)
            .then(items => items.map(item => ({ title: item.title, ...item.acf })))
            .then(items => groupBy(item => item.date, items))
            .then(data => {
                this.cache = data;
                this.cachePromise = null;
                return data;
            });

        return this.cachePromise;
    }
}

EventsService.$inject = ['$http'];
