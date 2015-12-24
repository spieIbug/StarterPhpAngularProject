/**
 * Created by yacmed on 02/12/2015.
 */
'use strict'
app.controller('loginController',function($scope, $http){
    $scope.user = {};
    $scope.submitForm = function(user){
        $scope.user = user;
        $scope.submitForm = function(user){
            $http.post('api/?method=checkLogin', $scope.user).success(function(data){
                console.log('ok');
            }).error(function(data){
                console.log('ko');
            });
        }

    }
});