angular.module('app.controllers')
    .controller('ClientDashboardController',
        ['$scope', '$location', '$routeParams', 'Client',
        function($scope, $location, $routeParams, Client) {
            $scope.client = {};

            Client.query({
                orderBy: 'created_at',
                sortedBy: 'desc',
                limit: 8
            }, function(response) {
                $scope.clients = response.data;

                if ($scope.clients[0]) {
                    $scope.client = $scope.clients[0];
                }
            });

            $scope.showClient = function(client) {
                $scope.client = client;
            };
        }]);
