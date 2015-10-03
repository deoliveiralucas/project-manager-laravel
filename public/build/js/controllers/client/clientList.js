angular.module('app.controllers')
    .controller('ClientListController', ['$scope', 'Client', function($scope, Client) {
        $scope.clients = Client.query();
    }]);