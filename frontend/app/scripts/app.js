'use strict';

/**
 * @ngdoc overview
 * @name frontendApp
 * @description
 * # frontendApp
 *
 * Main module of the application.
 */
angular
  .module('frontendApp', [
    'ngAnimate',
    'ngCookies',
    'ngResource',
    'ui.router',
    'ngSanitize',
    'ngTouch',
  ])
  .config(function ($stateProvider) {
    $stateProvider
      .state('pizzas', {
        url: '/',
        templateUrl: 'views/main.html',
        controller: 'PizzaCtrl',
      })

      //Ingredients
      .state('ingredients', {
        url: '/ingredients',
        templateUrl: 'views/ingredients.html',
        controller: 'IngredientCtrl',
      })
      .state('newIngredient', {
        url: '/ingredients/new',
        templateUrl: 'views/ingredients_new.html',
        controller: 'IngredientNewCtrl',
      })
      .state('editIngredient', {
        url: '/ingredients/:id/edit',
        templateUrl: 'views/ingredients_edit.html',
        controller: 'IngredientEditCtrl',
      })
      // Pizza
      .state('newPizza', {
        url: '/pizzas/new',
        templateUrl: 'views/pizzas_new.html',
        controller: 'PizzaNewCtrl',
      })
      .state('editPizza', {
        url: '/pizzas/:id/edit',
        templateUrl: 'views/pizzas_edit.html',
        controller: 'PizzaEditCtrl',
      })
  })
  .run(function($state){
    $state.go('pizzas');
  });;
