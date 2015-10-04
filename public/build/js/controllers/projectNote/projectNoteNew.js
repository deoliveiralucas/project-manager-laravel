angular.module('app.controllers')
    .controller('ProjectNoteNewController', 
    ['$scope', '$location', 'ProjectNote', function($scope, $location, ProjectNote) {
        $scope.projectNote = new ProjectNote();

        $scope.save = function() {
            if ($scope.form.$valid) {
                $scope.projectNote.project_id = '1';
                $scope.projectNote.$save().then(function() {
                    $location.path('/project/1/notes');
                });
            }
        };
    }]);