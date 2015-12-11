/**
 * Created by yacmed on 02/12/2015.
 */
'use strict'
app.controller('mainCtrl',function($scope, $rootScope,  sessionService, loginService){
    if (agentPage != null) agentPage.play('Greet');
    $rootScope.user = {
        user : '',
        pwd  : ''
    };
});
app.controller('loginController',function($scope, $rootScope, loginService, $location, sessionService){
    $scope.submitForm = function(user){
        $rootScope.user = user;
        loginService.login(user).success(function(data){
            var resultat = data;
            if (resultat !== undefined){
                if (resultat[0]!==undefined){
                    if (resultat[0].id !== undefined){
                        if (agentPage != null) agentPage.play('Greet');
                        sessionService.set('user', resultat[0].login);
                        sessionService.set('uid', resultat[0].uid);
                        $location.path('welcome');
                    }
                    else{
                        $('#loginModal').addClass('animated shake');
                        $('#loginModal').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
                            $('#loginModal').removeClass('animated shake');
                        });
                    }
                }
                else{
                    $('#loginModal').addClass('animated shake');
                    $('#loginModal').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
                        $('#loginModal').removeClass('animated shake');
                    });
                }
            }
            else{
                $('#loginModal').addClass('animated shake');
                $('#loginModal').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
                    $('#loginModal').removeClass('animated shake');
                });
            }
        }).error(function(data){
            console.error('Communication interrompue');
        });

    }
});
app.controller('homeCtrl', function($scope, loginService, $location, sessionService){
    $scope.userSession = {
        user: sessionService.get('user'),
        uid : sessionService.get('uid')
    };
    $scope.userRoles = [];
    loginService.isLogged($scope.userSession).success(function(data){
        if (data.status==="true"){
            loginService.loadPrivileges($scope.userSession).success(function(data){
                $scope.userRoles = data;
            }).error(function(data){
                if (agentPage != null) agentPage.play('Write');
            });
        } else {
            sessionService.destroy();
            if (agentPage != null) agentPage.play('Wave');
            $location.path('/login');
        }

    }).error(function(data){
        console.error('Communication interrompue');
    });
    /**
     *
     * @param role
     * @returns {boolean}
     */
    $scope.checkRole = function(role){
        var result = false;
        for(var i=0; i < $scope.userRoles.length; i++){
            if ($scope.userRoles[i].libelle.indexOf(role)>-1){
                result = true;
                return result;
            }
        }
        return result;
    }
});