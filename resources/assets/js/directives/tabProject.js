angular.module('app.directives')
    .directive('tabProject',
        [function() {
            return {
                restrict: 'A',
                link: function(scope, element, attr) {
                    $(element).find('a').click(function() {
                        var tabContent = $(element).parent().find('.tab-content');
                        var a = $(this);

                        $(element).find('.active').removeClass('active');
                        tabContent.find('.active').removeClass('active');
                        tabContent.find('[id=' + a.attr('aria-controls') + ']').addClass('active');
                        a.addClass('active');
                    });
                }
            };
    }]);
