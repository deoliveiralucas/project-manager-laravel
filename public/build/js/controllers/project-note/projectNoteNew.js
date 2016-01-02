angular.module('app.controllers')
    .controller('ProjectNoteNewController', 
    ['$scope', '$routeParams', '$location', 'ProjectNote', 
        function($scope, $routeParams, $location, ProjectNote) {
        $scope.projectNote = new ProjectNote();
        $scope.projectNote.project_id = $routeParams.id;

        $scope.save = function() {
            if ($scope.form.$valid) {
                $scope.projectNote.$save({id: $routeParams.id}).then(function() {
                    $location.path('/project/' + $scope.projectNote.project_id + '/notes');
                });
            }
        };
    }]);