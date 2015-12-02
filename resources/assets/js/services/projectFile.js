angular.module('app.services')
    .service('ProjectFile', ['$resource', 'appConfig', function($resource, appConfig) {
        return $resource(appConfig.baseUrl + '/project/:id/file/:idFile', {
            id: '@id',
            idFile: '@idFile'
        }, {
            update: {
                method: 'PUT'
            }
        });
    }]);