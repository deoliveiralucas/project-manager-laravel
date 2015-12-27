angular.module('app.controllers')
    .controller('MenuController', ['$scope', '$cookies', function($scope, $cookies) {
        $scope.user = $cookies.getObject('user');
    }]);
