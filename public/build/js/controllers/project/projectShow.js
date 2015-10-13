angular.module('app.controllers')
    .controller('ProjectNoteShowController',['$scope', '$location', '$routeParams', 'ProjectNote',  function($scope, $location, $routeParams, ProjectNote){
        $scope.projectNote = ProjectNote.get({
            id: $routeParams.id,
            idNote: $routeParams.idNote
        });

        $scope.back = function() {
            $location.path('/project/'+$routeParams.id+'/notes');
        };
    }]);