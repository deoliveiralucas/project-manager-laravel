angular.module('app.controllers')
        .controller('ProjectTaskRemoveController',
                ['$scope', '$location', '$routeParams', 'ProjectTask',
                function ($scope, $location, $routeParams, ProjectTask) {
                    
                    $scope.projectTask = ProjectTask.get({
                        id: $routeParams.id,
                        idTask: $routeParams.idTask
                    });

                    $scope.remove = function () {
                        $scope.projectTask.$delete({
                            id: $routeParams.id,
                            idTask: $scope.projectTask.id
                        }).then(function () {
                            $location.path('/project/' + $routeParams.id + '/tasks');
                        });
                    };
                }]);