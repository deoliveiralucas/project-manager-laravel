angular.module('app.controllers')
.controller('ForbiddenModalController',
    ['$timeout', '$location', '$modalInstance', function($timeout, $location, $modalInstance) {
      $timeout(function () {
        $location.path('home');
        $modalInstance.close();
      }, 2000);
    }]);
