'use strict';

/**
 * @ngdoc function
 * @name frontendApp.controller:MainCtrl
 * @description
 * # MainCtrl
 * Controller of the frontendApp
 */
angular.module('frontendApp')

.controller('PizzaCtrl', function ($scope, $window, Pizza) {
  $scope.pizzas =  Pizza.query();

  $scope.delete = function(pizza) {
    if(confirm("Are you sure?")) {
      pizza.$delete(function(){
        $window.location.reload();
      });
    }
  }
})

.controller('PizzaEditCtrl', function ($scope, $state, $stateParams, Pizza, Ingredient) {
  $scope.ingredients = Ingredient.query(function(){
    if($scope.ingredients.length == 0) {
      alert("Doesn't exists ingredients!");
      $state.go('newIngredient');
    }
  });


  $scope.updatePizza = function() {
    if (!$scope.pizza.ingredients || $scope.pizza.ingredients.length == 0) {
      alert("Select one ingredient please!")
      return false;
    }

    $scope.pizza.$update(function() {
      $state.go('pizzas');
    });
  };

  $scope.loadPizza = function() {
    $scope.pizza = Pizza.get({ id: $stateParams.id });
  };

  $scope.loadPizza();
})

.controller('PizzaNewCtrl', function ($scope, $state, $stateParams, Pizza, Ingredient) {
  $scope.ingredients = Ingredient.query(function(){
    if($scope.ingredients.length == 0) {
      alert("Doesn't exists ingredients!");
      $state.go('newIngredient');
    }
  });
  $scope.pizza       = new Pizza();

  $scope.addPizza = function() {
    if (!$scope.pizza.ingredients || $scope.pizza.ingredients.length == 0) {
      alert("Select one ingredient please!")
      return false;
    }

    $scope.pizza.ingredients = $scope.pizza.ingredients.map(function(ingredient){ return ingredient.id; });

    $scope.pizza.$save(function() {
      $state.go('pizzas');
    });
  };
});
