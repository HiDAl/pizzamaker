'use strict';

/**
 * @ngdoc function
 * @name frontendApp.controller:MainCtrl
 * @description
 * # MainCtrl
 * Controller of the frontendApp
 */
angular.module('frontendApp')

.controller('IngredientCtrl', function ($scope, $window, Ingredient) {
  $scope.ingredients =  Ingredient.query();

  $scope.delete = function(ingredient) {
    if(confirm("Are you sure?")) {
      ingredient.$delete(function(){
        $window.location.reload();
      });
    }
  }
})

.controller('IngredientEditCtrl', function ($scope, $state, $stateParams, Ingredient) {
  $scope.updateIngredient = function() {
    $scope.ingredient.$update(function() {
      $state.go('ingredients');
    });
  };

  $scope.loadIngredient = function() {
    $scope.ingredient = Ingredient.get({ id: $stateParams.id });
  };

  $scope.loadIngredient();
})

.controller('IngredientNewCtrl', function ($scope, $state, $stateParams, Ingredient) {
   $scope.ingredient = new Ingredient();

  $scope.addIngredient = function() {
    $scope.ingredient.$save(function() {
      $state.go('ingredients');
    });
  };
});
