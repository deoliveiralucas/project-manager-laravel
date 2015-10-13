angular.module('app.controllers')
    .controller('ProjectNewController', 
        ['$scope', '$location', '$cookies', 'Project', 'Client', 
        function($scope, $location, $cookies, Project, Client) {
        $scope.project = new Project();
        $scope.project.owner_id = $cookies.getObject('user').user_id;

        $scope.save = function(){
            if($scope.form.$valid) {
                $scope.project.$save().then(function(){
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