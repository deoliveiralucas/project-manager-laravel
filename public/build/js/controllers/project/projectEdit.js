angular.module('app.controllers')
    .controller('ProjectEditController', 
    ['$scope', '$location', '$routeParams', 'Project', 'Client', 'appConfig', 
        function($scope, $location, $routeParams, Project, Client, appConfig) {
        $scope.project = Project.get({id: $routeParams.id});
        
        $scope.save = function() {
            if ($scope.form.$valid) {
                Project.update({id: $scope.project.project_id}, $scope.project, function() {
                    $location.path('/projects');
                });
            }
        };
        
        $scope.clients = Client.query();        
        $scope.status = appConfig.project.status;
    }]);