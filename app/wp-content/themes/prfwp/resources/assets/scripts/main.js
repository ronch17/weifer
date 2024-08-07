import 'jquery-inview';
// Import everything from autoload
import './autoload/**/*';
// import local dependencies
import Router from './util/Router';
import common from './routes/common';
// Force CSS update
// https://github.com/webpack-contrib/extract-text-webpack-plugin/issues/30#issuecomment-256958209
// prfwp - AngularJS Trading App
import { AssetsTableComponent } from './ng-trading/assets-index/assets-table/assets-table.component';
import { AssetsTableRowComponent } from './ng-trading/assets-index/assets-table-row/assets-table-row.component';
import { CfdPlatformRulesService } from './ng-trading/services/cfd-platform-rules.service';
import { SocketRegistryService } from './ng-trading/services/socket-registry.service';
import { AssetsTableManagerComponent } from './ng-trading/assets-index/assets-table-manager/assets-table-manager.component';
import { PageController } from './ng-trading/page/page.controller';
import { GenericPopup } from './ng-trading/generic-popup/generic-popup.component';

/** Populate Router instance with DOM routes */
const routes = new Router({
    common,
});

// Load Events
jQuery(document).ready(() => routes.loadEvents());

/* global angular */
angular
    .module('prfwp', ['prf'])
    .service('prfCfdPlatformRulesService', CfdPlatformRulesService)
    .service('socketRegistry', SocketRegistryService)
    .controller('prfPage', PageController)
    .component('prfAssetsTableManagerComponent', AssetsTableManagerComponent)
    .component('prfAssetsTable', AssetsTableComponent)
    .component('prfAssetsTableRow', AssetsTableRowComponent)
    .component('prfwpGenericPopup', GenericPopup);
