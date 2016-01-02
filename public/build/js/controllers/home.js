angular.module('app.controllers')
    .controller('HomeController',
        ['$scope', '$cookies', '$timeout', '$pusher',
        function($scope, $cookies, $timeout, $pusher) {
            $scope.tasks = [];

            var pusher  = $pusher(window.client);
            var channel = pusher.subscribe('user.' + $cookies.getObject('user').user_id);

            channel.bind('ProjectManager\\Events\\TaskWasIncluded',
                function(data) {
                    if ($scope.tasks.length >= 6) {
                        $scope.tasks.splice($scope.tasks.length -1, 1);
                    }

                    $timeout(function() {
                        $scope.tasks.unshift(data.task);
                    }, 1000);
                }
            );
    }]);
