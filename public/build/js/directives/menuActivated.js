angular.module('app.directives')
    .directive('menuActivated',
        ['$location',
        function($location) {
            return {
                restrict: 'A',
                link: function(scope, element, attr) {
                    scope.$watch(function() {
                        return $location.path();
                    }, function(newValue) {
                        var liElements = element[0].querySelectorAll('li[data-match-route]');
                        angular.forEach(liElements, function(li) {
                            var liElement = angular.element(li);
                            var pattern = liElement.attr('data-match-route').replace('/', '\\/');
                            var regexp = new RegExp(pattern, 'i');
                            if (regexp.test(newValue)) {
                                liElement.children().first().addClass('actived');
                            } else {
                                liElement.children().first().removeClass('actived');
                            }
                        });
                    });
                }
            };
    }]);
