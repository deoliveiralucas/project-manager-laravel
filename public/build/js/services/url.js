angular.module('app.services')
    .service('Url', ['$interpolate', function ($interpolate) {
        return {
            getUrlFromUrlSymbol: function (url, params) {
                var urlMod = $interpolate(url)(params);
                return urlMod.replace(/\/\//g, '/')
                             .replace(/\/$/, '');
            },
            getUrlResource: function (url) {
                return url.replace(new RegExp('{{', 'g'), ':')
                          .replace(new RegExp('}}', 'g'), '');
            }
        };
    }]);