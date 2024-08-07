import groupBy from 'lodash/fp/groupBy';

export class CfdPlatformRulesService {
    constructor($http) {
        this.$http = $http;
    }

    getGroupedRulesList() {
        return this.$http
            .get(
                'https://api.binarytradingcore.com/Rules?query={"Query":{"status":{"$in":["active","suspended"]},"type":"cfd"},"includes":["Asset.TradingPeriods","Asset.TradingPeriods.Days","Asset.Exchange"]}',
                {
                    headers: {
                        'x-api-token': window.main.PLATFORM_BRAND_GUST_TOKEN,
                    },
                }
            )
            .then(results => results.data)
            .then(rules => groupBy(rule => rule.asset.group, rules));
    }

    getSpecificRulesList(selectedRules) {
        return this.$http
            .get(
                'https://api.binarytradingcore.com/Rules?query={"Query":{"status":{"$in":["active","suspended"]},"type":"cfd"},"includes":["Asset.TradingPeriods","Asset.TradingPeriods.Days","Asset.Exchange"]}',
                {
                    headers: {
                        'x-api-token': window.main.PLATFORM_BRAND_GUST_TOKEN,
                    },
                }
            )
            .then(results => results.data)
            .then(rules => rules.map(rule => rule.asset))
            .then(assets => assets.filter(asset => selectedRules.includes(asset.name)));
    }
}

CfdPlatformRulesService.$inject = ['$http'];
