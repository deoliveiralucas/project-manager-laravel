angular.module('app.directives')
    .directive('loginForm',
        ['appConfig',
        function(appConfig) {
            return {
                restrict: 'E',
                templateUrl: appConfig.baseUrl + '/build/views/templates/form-login.html',
                $scope: false
            };
    }]);
