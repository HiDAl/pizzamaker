'use strict';
function resourceErrorHandler(response) {
  alert("An error connecting to backend api: "  + response.data);
  return false;
}

angular.module('frontendApp')
  .factory('Ingredient', function ($resource) {
      return $resource('http://localhost:8000/api/ingredients/:id', { id: '@id' }, {
        update: {
          url: "http://localhost:8000/api/ingredients/:id",
          method: 'PUT', // this method issues a PUT request
          interceptor: {responseError : resourceErrorHandler}
        },

        get:    {method:'GET',
                   interceptor : {responseError : resourceErrorHandler}},
        query:  {method:'GET', isArray: true,
                   interceptor : {responseError : resourceErrorHandler}},
        'delete': {method:'DELETE'}
      });
  });
