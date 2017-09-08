var phpApp = angular.module('phpApp', ['ngRoute']);

phpApp.config(function($routeProvider,$locationProvider){
  $locationProvider.hashPrefix('');

  $routeProvider
    .when('/overview',{
      templateUrl: '../views/overview.html',
      controller: 'mainCtrl',
      activetab: 'overview'
  }).when('/stockpile',{
      templateUrl: '../views/stockpile.html',
      controller: 'mainCtrl',
      activetab: 'stockpile'
  }).when('/salesRecord',{
      templateUrl: '../views/salesRecord.html',
      controller: 'mainCtrl',
      activetab: 'salesRecord'
  }).otherwise({
    redirectTo: '/overview'
  });

});

//MAIN CONTROLLER
phpApp.controller('mainCtrl', function($scope,$route){

  $scope.$route = $route;

});
