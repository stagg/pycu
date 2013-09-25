
app.controller('SlideDeckMainCtrl', ['$scope', '$compile', '$stateParams', 'promise1', 'promise2', 'getSelected',
    function($scope, $compile, $stateParams, promise1, promise2, getSelected) {
        if(!$scope.slideContent ) {
            $scope.slideContent = promise2.data;
        }
        $scope.$watch('slideContent', function() {
            var slideDeck = $("#slideDeck");
            slideDeck.animate({'zoom':0.8},  0);
            $scope.$evalAsync(function () {
                $("div[id^='page_']").mouseup(function() {
                    getSelected.selection(slideDeck);
                    getSelected.open();
                });
            })
        });
}]);


app.controller('SlideDeckPageCtrl', ['$scope', '$stateParams',
    function($scope,  $stateParams) {
        console.log($stateParams);
        var page = '#page_'+$stateParams.page;
            $(page).get(0).scrollIntoView();
    }
]);

app.controller('ModalInstanceCtrl',
    function() {

    }
);