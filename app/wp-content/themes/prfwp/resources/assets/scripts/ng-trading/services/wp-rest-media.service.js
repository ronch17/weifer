export class MediaService {
    constructor($http) {
        this.$http = $http;
        this.cache = null;
        this.cachePromise = null;
    }

    getMediaItem(itemId) {
        if (this.cache) {
            return Promise.resolve(this.cache);
        }

        if (this.cachePromise) {
            return this.cachePromise;
        }

        this.cachePromise = this.$http
            .get(`/wp-json/wp/v2/media/${itemId}`)
            .then(results => results.data)
            .then(item => item.source_url)
            .then(data => {
                this.cache = data;
                this.cachePromise = null;
                return data;
            });

        return this.cachePromise;
    }
}

MediaService.$inject = ['$http'];
