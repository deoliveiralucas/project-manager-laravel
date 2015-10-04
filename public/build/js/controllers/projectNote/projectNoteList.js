angular.module('app.controllers')
    .controller('ProjectNoteListController', ['$scope', 'ProjectNote', function($scope, ProjectNote) {
        $scope.projectNotes = ProjectNote.query();
    }]);