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
phpApp.controller('mainCtrl', function($scope,$route,$http){
  $scope.$route = $route;

  $scope.insertData = function(){
  $http.post(
    "../insert.php",
    {'productName':$scope.productName,'productPrice':$scope.productPrice,'productQuantity':$scope.productQuantity}
  ).then(function(data){
      alert("Product added");
      $scope.productName = null;
      $scope.productPrice = null;
      $scope.productQuantity = null;

      $scope.displayData();
  });
  }

  $scope.displayData = function(){
    $http.get("../select.php").then(function(data){
      $scope.product = data.data;
    });
  }

  $scope.increaseQuantity = function(id,productQuantity){

    $http.post(
    "../update.php",
    {'productQuantity':parseInt(productQuantity) + 1,'ID':id}
  ).then(function(data){
      $scope.displayData();
  });
  }

  $scope.decreaseQuantity = function(id,productQuantity){

    $http.post(
    "../update.php",
    {'productQuantity':parseInt(productQuantity) - 1,'ID':id}
  ).then(function(data){
      $scope.displayData();
  });
  }

  $scope.deleteProduct = function(id){
    if(confirm("Are you sure you would like to delete this product?")){
      $http.post("../delete.php",{'ID':id}).then(function(data){
        $scope.displayData();
      });
    }
  }

});

//CUSTOM FILTER FOR RESTOCK TGGGLE
phpApp.filter('showRestockOnly',function(){
  return function(product,restockToggle){
    var filtered = [];
    if(restockToggle == 1)
    {
      angular.forEach(product, function(item) {
        if(item.Product_QTY == 0) {
          filtered.push(item);
        }
      });
      return filtered;
    }
    else
    {
      return product;
    }
  }
});
