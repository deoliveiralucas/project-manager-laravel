angular.module('app.controllers')
    .controller('ProjectEditController', 
    ['$scope', '$location', '$routeParams', 'Project', 'Client', 
        function($scope, $location, $routeParams, Project, Client) {
        $scope.project = Project.get({id: $routeParams.id});

        $scope.save = function() {
            if ($scope.form.$valid) {
                Project.update({id: $scope.project.project_id}, $scope.project, function() {
                    $location.path('/projects');
                });
            }
        };
        
        $scope.clients = Client.query();        

        $scope.allStatus = [{
            id: 0,
            label: "Status 0"
        },{
            id: 1,
            label: "Status 1"
        },{
            id: 2,
            label: "Status 2"
        },{
            id: 3,
            label: "Status 3"
        }];
    }]);