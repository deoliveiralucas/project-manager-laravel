angular.module('app.filters').filter('statusStyle', ['appConfig', function(appConfig) {
    return function(input) {
      var currentDate = new Date();
      var dueDate = new Date(input);

      if (parseInt(dueDate.getTime() -currentDate.getTime()) >= 0) {
        return "text-success";
      }

      return "text-danger";
    };
}]);
