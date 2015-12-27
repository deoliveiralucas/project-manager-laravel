angular.module('app.directives')
    .directive('loadTemplate',
        ['$compile', '$http', 'OAuth',
        function($compile, $http, OAuth) {
            return {
                restrict: 'E',
                link: function(scope, element, attr) {
                    scope.$on('$routeChangeStart', function(event, next, current) {
                        if (OAuth.isAuthenticated()) {
                            if (next.$$route.originalPath != '/login' &&
                                next.$$route.originalPath != '/logout'
                            ) {
                                if (! scope.isTemplateLoad) {
                                    scope.isTemplateLoad = true;

                                    $http.get(attr.url).then(function(response) {
                                        element.html(response.data);
                                        $compile(element.contents())(scope);
                                    });
                                }
                                return;
                            }
                        }
                        resetTemplate();

                        function resetTemplate() {
                            scope.isTemplateLoad = false;
                            element.html("");
                        }
                    });
                }
            };
    }]);
