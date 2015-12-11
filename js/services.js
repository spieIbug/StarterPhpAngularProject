/**
 * Created by yacmed on 02/12/2015.
 */
'use strict'
app.factory('sessionService', function($http){
    return {
        set:function(key, value){
            return sessionStorage.setItem(key, value);
        },
        get:function(key){
            return sessionStorage.getItem(key);
        },
        destroy:function(){
            for (var key in sessionStorage){
                sessionStorage.removeItem(key, sessionStorage.getItem[key]);
            }
        }
    };
});
app.factory('loginService', function($http, $location, sessionService){
    var API = "api/roles/"
    return{
        login:function(user){
            return $http.post(API+'?method=login', user);
        },
        logout: function(user){
            sessionService.destroy(); //destruction de la session coté client
            $http.post(API+'?method=logout&user='+user);//destruction de la session coté serveur
            $location.path('../../'); // redirection vers la page du login
        },
        loadPrivileges: function(user){
            return $http.get(API+'?method=getUserRoles&user='+user.user+'&uid='+user.uid);
        },
        isLogged: function(user){
            return $http.post(API+'?method=isLogged',user);
        }
    }
});
