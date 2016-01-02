angular.module('app.directives')
    .directive('projectFileDownload',
        ['$timeout', '$window', 'appConfig', 'ProjectFile',
        function($timeout, $window, appConfig, ProjectFile) {
            return {
                restrict: 'E',
                templateUrl: appConfig.baseUrl + '/build/views/templates/project-file-download.html',
                link: function(scope, element, attr) {
                    var anchor = element.children()[0];

                    scope.$on('salvar-arquivo', function(event, data) {
                        $(anchor).removeClass('disabled');
                        $(anchor).text('Salvar arquivo');

                        blobUtil.base64StringToBlob(data.file).then(function (blob) {
                            $(anchor).attr({
                                href: $window.URL.createObjectURL(blob, data.mime_type),
                                download: data.name
                            });
                        });

                        $timeout(function() {
                            scope.downloadFile = function() {

                            };
                            $(anchor)[0].click();
                        });
                    });
                },
                controller: ['$scope', '$element', '$attrs',
                    function($scope, $element, $attrs) {
                        $scope.downloadFile = function() {
                            var anchor = $element.children()[0];
                            $(anchor).addClass('disabled').text('Baixando...');

                            ProjectFile.download({
                                id: $attrs.id,
                                idFile: $attrs.idFile
                            },
                            function(data) {
                                $scope.$emit('salvar-arquivo', data);
                            });
                        };
                }]
            };
    }]);
