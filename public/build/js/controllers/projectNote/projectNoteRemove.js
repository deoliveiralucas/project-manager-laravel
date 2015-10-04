angular.module('app.controllers')
    .controller('ProjectNoteRemoveController', 
    ['$scope', '$location', '$routeParams', 'ProjectNote', 
        function($scope, $location, $routeParams, ProjectNote) {
        $scope.projectNote = ProjectNote.get({id: $routeParams.id});

        $scope.remove = function() {
            $scope.projectNote.$delete().then(function() {
                $location.path('/project/1/notes');
            });
        };
    }]);