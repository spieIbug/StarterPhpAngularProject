/**
 * Created by yacmed on 11/12/2015.
 */
'use strict'
app.directive('menuLateral', function() {
    return {
        restrict : 'E',
        templateUrl: 'partials/menu-lateral.html'
    };
});
app.directive('menuTop', function() {
    return {
        restrict : 'E',
        templateUrl: 'partials/menu-top.html'
    };
});
