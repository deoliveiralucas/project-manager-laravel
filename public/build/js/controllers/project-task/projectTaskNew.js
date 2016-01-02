angular.module('app.controllers')
        .controller('ProjectTaskNewController',
                ['$scope', '$location', '$routeParams', 'appConfig', 'ProjectTask',
                function ($scope, $location, $routeParams, appConfig, ProjectTask) {

                    $scope.projectTask = new ProjectTask();
                    $scope.status = appConfig.projectTask.status;

                    $scope.start_date = {
                        status: {
                            opened: false
                        }
                    };

                    $scope.due_date = {
                        status: {
                            opened: false
                        }
                    };

                    $scope.openStartDatePicker = function ($event) {
                        $scope.start_date.status.opened = true;
                    };

                    $scope.openDueDatePicker = function ($event) {
                        $scope.due_date.status.opened = true;
                    };
                    
                    $scope.save = function () {

                        if ($scope.form.$valid) {
                            $scope.projectTask.$save({id: $routeParams.id}).then(function () {
                                $location.path('/project/' + $routeParams.id + '/tasks');
                            });
                        }
                    }
                }]);