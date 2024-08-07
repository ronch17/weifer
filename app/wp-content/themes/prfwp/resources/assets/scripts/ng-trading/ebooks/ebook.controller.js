import { MediaService } from '../services/wp-rest-media.service';
import { observeComponentLifecycles } from '../utils/observe-component-lifecycles';
import { useStreams } from '../utils/use-streams';
import * as rx from '../utils/rx';
import * as _ from '../utils/lodash';

//import { tapLog } from '../utils/tap-log';

export class EbookController {
    constructor($http, prfMediaService, prfPopupService) {
        this.link$ = new rx.BehaviorSubject('');
        this.prfMediaService = prfMediaService;
        this.opCalcFileUrl$ = new rx.Subject();
        this.prfPopupService = prfPopupService;

        this.lifecycles = observeComponentLifecycles(this);

        useStreams([this.streamCalcFileUrl()], this.lifecycles.onDestroy$);
    }

    $onInit() {}

    $onChanges() {}

    $onDestroy() {}

    streamCalcFileUrl() {
        return rx.pipe(
            () => this.opCalcFileUrl$,
            rx.filter(fileId => !_.isNil(fileId)),
            rx.switchMap(fileId => rx.obs.from(this.getEbookUrl(fileId)).pipe(rx.catchError((err, caught) => ''))),
            rx.tap(fileUrl => this.link$.next(fileUrl))
        )(null);
    }

    getEbookUrl(fileId) {
        return this.prfMediaService.getMediaItem(fileId);
    }
}

EbookController.$inject = ['$http', 'prfMediaService', 'prfPopupService'];
