angular.module('app.services')
    .service('ProjectFile', ['$resource', 'appConfig', 'Url',
        function($resource, appConfig, Url) {
            var url = appConfig.baseUrl + Url.getUrlResource(appConfig.urls.projectFile);
            
            return $resource(url, {
                id: '@id',
                idFile: '@idFile'
            }, {
                update: {
                    method: 'PUT'
                },
                download: {
                    url: url + '/download',
                    method: 'GET'
                }
            });
    }]);