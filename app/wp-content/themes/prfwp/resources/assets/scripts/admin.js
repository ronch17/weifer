// Force CSS update
// https://github.com/webpack-contrib/extract-text-webpack-plugin/issues/30#issuecomment-256958209
if (process.env.NODE_ENV !== 'production') {
    if (module.hot) {
        const reporter = window.__webpack_hot_middleware_reporter__;
        const success = reporter.success;
        reporter.success = function() {
            document.querySelectorAll('[id*="sage"]').forEach(link => {
                const nextStyleHref = link.href.replace(/(\?\d+)?$/, `?${Date.now()}`);
                link.href = nextStyleHref;
            });
            success();
        };
    }
}
