angular.module('app.controllers')
    .controller('ProjectDashboardController',
        ['$scope', '$location', '$routeParams', 'Project', 'Client', 'appConfig',
        function($scope, $location, $routeParams, Project, Client, appConfig) {
            $scope.project = {};

            Project.query({
                orderBy: 'created_at',
                sortedBy: 'desc',
                project_type: 'member',
                limit: 5
            }, function(response) {
                $scope.projectsAsMember = response.data;

                if ($scope.projectsAsMember[0]) {
                    $scope.projectAsMember = $scope.projectsAsMember[0];
                }
            });

            Project.query({
                orderBy: 'created_at',
                sortedBy: 'desc',
                project_type: 'owner',
                limit: 5
            }, function(response) {
                $scope.projectsAsOwner = response.data;

                if ($scope.projectsAsOwner[0]) {
                    $scope.projectAsOwner = $scope.projectsAsOwner[0];
                }
            });

            $scope.changeTab = function (tab) {
              if (tab == 'asOwner') {
                $('.tab-owner' ).addClass('active');
                $('.tab-member').removeClass('active');
                $('.row-member').hide();
                $('.row-owner' ).fadeIn('slow');
              } else if (tab == 'asMember') {
                $('.tab-owner' ).removeClass('active');
                $('.tab-member').addClass('active');
                $('.row-member').fadeIn('slow');
                $('.row-owner' ).hide();
              }
            };

            $scope.showProjectAsMember = function(project) {
                $scope.projectAsMember = project;
            };

            $scope.showProjectAsOwner = function(project) {
                $scope.projectAsOwner = project;
            };

            $scope.changeTab('asOwner');
        }
    ]);
