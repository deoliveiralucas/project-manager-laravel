angular.module('app.services')
    .service('ProjectNote', ['$resource', 'appConfig', function($resource, appConfig) {
        return $resource(appConfig.baseUrl + '/project/1/note/:id', {id: '@id'}, {
            update: {
                method: 'PUT'
            }
        });
    }]);