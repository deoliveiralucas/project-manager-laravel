angular.module('app.services')
        .service('ProjectTask', ['$resource', '$filter', 'appConfig',
            function ($resource, $filter, appConfig) {

                function transformData(data) {
                    var o = angular.copy(data);

                    if (angular.isObject(data)) {
                        if (data.hasOwnProperty('start_date')) {
                            o.start_date = $filter('date')(data.start_date, 'yyyy-MM-dd');
                        }

                        if (data.hasOwnProperty('due_date')) {
                            o.due_date = $filter('date')(data.due_date, 'yyyy-MM-dd');
                        }

                        return appConfig.utils.transformRequest(o);

                    }
                    return data;
                }
                ;

                return $resource(appConfig.baseUrl + '/project/:id/task/:idTask', {
                    id: '@id',
                    idTask: '@idTask',
                }, {
                    save: {
                        method: 'POST',
                        transformRequest: transformData
                    },
                    update: {
                        method: 'PUT',
                        transformRequest: transformData
                    },
                    get: {
                        transformResponse: function (data, headers) {
                            var o = appConfig.utils.transformResponse(data, headers);

                            if (angular.isObject(o)) {
                                if (o.hasOwnProperty('start_date') && o.start_date) {

                                    var arrayDate = o.start_date.split('-'),
                                            month = parseInt(arrayDate[1]) - 1;

                                    o.start_date = new Date(arrayDate[0], month, arrayDate[2]);
                                }

                                if (o.hasOwnProperty('due_date') && o.due_date) {

                                    var arrayDate = o.due_date.split('-'),
                                            month = parseInt(arrayDate[1]) - 1;

                                    o.due_date = new Date(arrayDate[0], month, arrayDate[2]);
                                }
                            }

                            return o;
                        }
                    }

                });
            }]);