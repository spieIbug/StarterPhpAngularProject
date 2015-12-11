/**
 * Created by yacmed on 02/12/2015.
 */
'use strict'
var app = angular.module('loginModule', ['ngRoute']);
app.config(function($routeProvider){
    $routeProvider.when('/welcome', {
        templateUrl : 'partials/welcome.html',
        controller : 'homeCtrl'
    }).when('/login', {
        templateUrl : 'partials/login.html',
        controller : 'loginController'
    }).otherwise({
        redirectTo: '/login'
    });
});