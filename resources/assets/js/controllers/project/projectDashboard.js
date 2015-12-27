angular.module('app.controllers')
    .controller('ProjectDashboardController',
        ['$scope', '$location', '$routeParams', 'Project', 'Client', 'appConfig',
        function($scope, $location, $routeParams, Project, Client, appConfig) {
            $scope.project = {};

            Project.query({
                orderBy: 'created_at',
                sortedBy: 'desc',
                limit: 5
            }, function(response) {
                $scope.projects = response.data;

                if ($scope.projects[0]) {
                    $scope.project = $scope.projects[0];
                }
            });

            $scope.showProject = function(project) {
                $scope.project = project;
            };
        }
    ]);
