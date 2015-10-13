angular.module('app.controllers')
    .controller('ProjectNoteShowController', ['$scope', 'ProjectNote', function($scope, ProjectNote) {
        $scope.projectNotes = ProjectNote.query();
    }]);