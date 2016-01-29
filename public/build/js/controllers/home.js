angular.module('app.controllers')
    .controller('HomeController',
        ['$scope', '$cookies', '$timeout', '$pusher', 'Project',
        function($scope, $cookies, $timeout, $pusher, Project) {
            $scope.tasks = [];

            var pusher  = $pusher(window.client);
            var channel = pusher.subscribe('user.' + $cookies.getObject('user').user_id);

            channel.bind('ProjectManager\\Events\\TaskWasIncluded',
                function(data) {
                    if ($scope.tasks.length >= 6) {
                        $scope.tasks.splice($scope.tasks.length -1, 1);
                    }

                    data.task.action = 'incluida';
                    $timeout(function() {
                        $scope.tasks.unshift(data.task);
                    }, 1000);
                }
            );

            channel.bind('ProjectManager\\Events\\TaskWasUpdated',
                function(data) {
                    if ($scope.tasks.length >= 6) {
                        $scope.tasks.splice($scope.tasks.length -1, 1);
                    }

                    data.task.action = 'alterada';
                    $timeout(function() {
                        $scope.tasks.unshift(data.task);
                    }, 1000);
                }
            );

            $scope.styleList = function () {
              $('.box-project').removeClass("col-sm-4").addClass("col-sm-10");
            };

            $scope.styleGrid = function () {
              $('.box-project').removeClass("col-sm-10").addClass("col-sm-4");
            };

            function getResultsPage(pageNumber) {
                Project.query({}, function(data) {
                    $scope.projects = data.data;
                    $scope.totalProjects = data.meta.pagination.total;
                });
            }

            getResultsPage(1);
    }]);
