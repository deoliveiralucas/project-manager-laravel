angular.module('app.controllers')
    .controller('ProjectFileNewController', 
    ['$scope', '$routeParams', '$location', 'appConfig', 'Url', 'Upload',
        function($scope, $routeParams, $location, appConfig, Url, Upload) {
            $scope.save = function() {
                
                if ($scope.form.$valid) {
                    var url = appConfig.baseUrl + 
                        Url.getUrlFromUrlSymbol(appConfig.urls.projectFile, {
                            id: $routeParams.id,
                            idFile: ''
                        });
                    
                    Upload.upload({
                        url: url,
                        fields: {
                            name: $scope.projectFile.name,
                            description: $scope.projectFile.description,
                            project_id: $routeParams.id
                        },
                        file: $scope.projectFile.file
                    }).success(function (resp) {
                        $location.path('/project/' + $routeParams.id + '/files');
                    });
                }

            };
            
        }
    ]);