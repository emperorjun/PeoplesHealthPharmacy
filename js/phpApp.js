var phpApp = angular.module('phpApp', ['ngRoute']);

phpApp.config(function($routeProvider,$locationProvider){
  $locationProvider.hashPrefix('');

  $routeProvider
    .when('/overview',{
      templateUrl: '../views/overview.html',
      controller: 'mainCtrl'
  }).when('/stockpile',{
      templateUrl: '../views/stockpile.html',
      controller: 'mainCtrl'
  }).when('/salesRecord',{
      templateUrl: '../views/salesRecord.html',
      controller: 'mainCtrl'
  }).otherwise({
    redirectTo: '/overview'
  });

});

//MAIN CONTROLLER
phpApp.controller('mainCtrl', function($scope){


});
