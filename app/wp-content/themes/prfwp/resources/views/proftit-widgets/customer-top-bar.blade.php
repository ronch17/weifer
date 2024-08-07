<div ng-cloak ng-if="prf.customer" class="prfwp-customerTopBar">
    <div class="prfwp-customerTopBar__container container">
        <div class="prfwp-customerTopBar__myAccount">
            <a href="{{ App::url('/account-summary') }}">{{_e('My Account', 'sage')}}</a> | {{_e('Welcome', 'sage')}} @{{prf.customer.firstName}} @{{prf.customer.lastName}}!
        </div>
        <div class="prfwp-customerTopBar__details">
            <div class="prfwp-customerTopBar__detail">
                <span class="prfwp-customerTopBar__detail__label">{{_e('ID', 'sage')}}:</span>
                <span class="prfwp-customerTopBar__detail__value">@{{prf.tradingAccount.externalAccountId}}</span>
            </div>

            <div class="prfwp-customerTopBar__detail">
                <span class="prfwp-customerTopBar__detail__label">{{_e('Balance', 'sage')}}:</span>
                <span class="prfwp-customerTopBar__detail__value"><prf-account-balance-widget
                      ng-cloak ng-if="prf.tradingAccount"></prf-account-balance-widget></span>
            </div>

            <div class="prfwp-customerTopBar__detail loginprfw__account-switcher prfw-common">
                <prf-account-switcher ng-cloak ng-if="prf.tradingAccount"></prf-account-switcher>
            </div>
        </div>
    </div>
</div>
