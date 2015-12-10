angular.module('app.controllers')
        .controller('ProjectTaskShowController',
                ['$scope', 'Client', function ($scope, Client) {
                        $scope.clients = Client.query();
                    }
                ]);