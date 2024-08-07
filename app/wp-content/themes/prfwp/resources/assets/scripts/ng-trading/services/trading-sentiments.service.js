import groupBy from 'lodash/fp/groupBy';

const host = 'api.binarytradingcore.com';
const resource = 'Statistics';
const subResource = 'AssetBuySellRatio';
//const integrationToken = '885c8bd0-2544-2c68-cca3-53b7b4c05102';

const brandToken = window.main.PLATFORM_BRAND_GUST_TOKEN;

export class TradingSentimentsService {
    constructor($http) {
        this.$http = $http;
    }

    getStatsAssetBuySellRatio() {
        return this.$http
            .get(['//', host, '/', resource, '/', subResource].join(''), {
                headers: {
                    'x-api-token': brandToken,
                },
                params: {
                    query: JSON.stringify({ take: 10, includes: ['asset'] }),
                },
            })
            .then(results => results.data);
    }
}

TradingSentimentsService.$inject = ['$http'];
