module.exports = {
    extends: ['stylelint-config-twbs-bootstrap/scss', 'stylelint-prettier/recommended'],
    plugins: ['stylelint-prettier'],
    rules: {
        'prettier/prettier': true,
        'no-empty-source': null,
        'selector-type-no-unknown': null,
        'selector-max-id': 0,

        'selector-pseudo-class-no-unknown': [
            true,
            {
                ignorePseudoClasses: ['local', 'global'],
            },
        ],
        'property-no-unknown': [
            true,
            {
                ignoreProperties: ['composes'],
            },
        ],
        'property-no-vendor-prefix': [
            true,
            {
                ignoreProperties: ['appearance'],
            },
        ],
        'property-blacklist': [
            //'border-radius',
            'border-top-left-radius',
            'border-top-right-radius',
            'border-bottom-right-radius',
            'border-bottom-left-radius',
            'transition',
            'font-size',
        ],
        'selector-class-pattern': '^[acfm-|prfwp-|svg-|js-|ng-|loginprfw__][A-Za-z0-9\\-_]*[a-z0-9]$',
        'at-rule-no-unknown': [
            true,
            {
                ignoreAtRules: [
                    'extend',
                    'at-root',
                    'debug',
                    'warn',
                    'error',
                    'if',
                    'else',
                    'for',
                    'each',
                    'while',
                    'mixin',
                    'include',
                    'content',
                    'return',
                    'function',
                    'tailwind',
                    'apply',
                    'responsive',
                    'variants',
                    'screen',
                ],
            },
        ],
        'selector-no-qualifying-type': [
            true,
            {
                ignore: ['class'],
            },
        ],
    },
};
