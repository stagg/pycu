//  Copyright: 2013 Josh Stagg
//  Project: python_copper

if (typeof String.prototype.startsWith != 'function') {
  // see below for better implementation!
  String.prototype.startsWith = function (str){
    return this.indexOf(str) == 0;
  };
}

var app = angular.module('pycu', ['ui.bootstrap', 'ui.router', 'restangular'])
    .config(function($stateProvider, $urlRouterProvider) {
  //
  // // For any unmatched url, redirect to /state1
  $urlRouterProvider.otherwise("/home");
  //


  // Now set up the states
  $stateProvider
    .state('home', {
      url: "/"
    })
    .state('slide', {
        url: "/slide/:id",
        views: {
            "main": {
                 resolve:{
                    promise1: loadSlideInfo,
                    promise2: loadSlideDeck
                },
                templateUrl: "templates/slide.html",
                controller: 'SlideDeckMainCtrl'
             },
            "sidebar": {
                    templateUrl: "templates/selections.html"
            }
        }
    })
    .state('slide.page', {
        url: "/page/:page",
        views: {
            "main": {
                templateUrl: "templates/slide.html",
                controller: 'SlideDeckPageCtrl'
            }
        }
    })
    .state('slide.page.selection', {
        url: "/selection/:sel",
        views: {
            "sidebar": {
                templateUrl: "templates/selections.html"
            }
        }
    })
}).config(function(RestangularProvider) {
    RestangularProvider.setBaseUrl('?/')
});

app.run(function($rootScope) {
    $rootScope.$on('$stateChangeSuccess', function(event, toState, toParams) {
//        console.log(toParams);
        if( toState.name.startsWith('slide.page')) {
            var page = '#page_'+toParams.page;
            if($(page).get(0)) {
                $(page).get(0).scrollIntoView();
                if (toState.name.startsWith("slide.page.selection")) {
                    loadSelection(toParams.page, toParams.sel);
                }
            }
        }
    });
})

app.run(function($state, $stateParams, $location) {
    $('#main').scroll( function (e){
        var winTop = $('#main').scrollTop(),
      bodyHt = $('#main').height(),
      vpHt = $('#main').height() + 10;  // viewport height + margin
          $("div[id^='page_']").each(function(i,elem){

            var loc = $(elem).offset().top;
           if ( loc > 50 && loc < vpHt ) {
                $location.path('/page/' + i+1);
           }
          })
         })
});

function isScrolledIntoView(elem)
{
    var docViewTop = $('#main').scrollTop();
    var docViewBottom = docViewTop + $('#main').height();

    var elemTop = $(elem).offset().top;
    var elemBottom = elemTop + $(elem).height();

    return ((elemBottom <= docViewBottom) && (elemTop >= docViewTop));
}

function loadSlideDeck($http, promise1 ) {
    return $http({method: 'GET', url: promise1.url});
}

function loadSlideInfo($stateParams,  Restangular) {
    return Restangular.one('slide', $stateParams.id).get();
}

function loadSelection(page, sel) {
        var range = document.createRange();
        var startPar = $("div#page_2 div#id_1 p.p1.ft6").get(0);
        var endLi = $("div#page_2 div#id_1 p.p4.ft13").get(0);
        range.setStart(startPar, 4);
        range.setEnd(endLi,1);
        window.getSelection().removeAllRanges();
        window.getSelection().addRange(range);
}

// Jquery
app.factory('getSelected', ['$modal', function($modal) {
    return {
        selection: function(el) {
            var selection;
            if (window.getSelection) {
                selection = window.getSelection();
            } else  if (document.selection) { //pre IE 9 support :(
                selection = document.selection.createRange();
            }
            if (selection.type=='Range') {
                // range.insertNode(span);

                var mySelection={
                    anchorNode: {
                        name: selection.anchorNode.nodeName,
                        parent: selection.anchorNode.parentNode,
                        offset: selection.anchorOffset,
                    },
                    focusNode: {
                        name: selection.anchorNode.nodeName,
                        parent: selection.anchorNode.parentNode,
                        offset: selection.anchorOffset,
                    }
                };
                console.log(selection);
            }
        },
        open: function() {
            $modal.open({
                templateUrl: 'templates/info.html',
                controller: 'ModalInstanceCtrl'
            });
        }
    };
}]);


