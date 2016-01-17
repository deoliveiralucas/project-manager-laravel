angular.module('app.filters').filter('showStatus', ['appConfig', function(appConfig) {
    return function(input) {
      var statusSelected = "";
      appConfig.project.status.forEach(function(value) {
        if (value.value == input) {
          statusSelected = value.label;
        }
      });

      return statusSelected;
    };
}]);
