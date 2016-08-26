'use strict';

angular.module('frontendApp')
  .factory('Pizza', function ($resource) {
      return $resource('http://localhost:8000/api/pizzas/:id', { id: '@id' }, {
        update: {
          url: "http://localhost:8000/api/pizzas/:id",
          method: 'PUT', // this method issues a PUT request
          transformRequest: function(data) {
            data.ingredients = data.ingredients.map(function(ingredient){ return ingredient.id; });

            return angular.toJson(data);
          },
          interceptor: {responseError : resourceErrorHandler}
        },

        get:    {method:'GET',
                   interceptor : {responseError : resourceErrorHandler}},
        query:  {method:'GET', isArray: true,
                   interceptor : {responseError : resourceErrorHandler}},
        delete: {method:'DELETE'}
      });
  });
