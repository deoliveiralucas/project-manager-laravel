angular.module('app.services')
        .service('ProjectMember', ['$resource', 'appConfig',
            function ($resource, appConfig) {
                return $resource(appConfig.baseUrl + '/project/:id/members/:idProjectMember', {
                    id: '@id',
                    idProjectMember: '@idProjectMember',
                }, {
                    update: {
                        method: 'PUT'
                    }
                });
            }]);
