var app = angular.module('AIEnglishApp', []);
function BaseController($scope, $http, $rootScope) {
    $scope.range = (first, end) => {
        let retVal = [];
        for (let i = first; i <= end; i++) {
            retVal.push(i);
        }
        return retVal;
    };

    $scope.prev = () => {
        if ($scope.pageId > 0) {
            $scope.pageId--;
            $scope.find();
        }
    };

    $scope.next = () => {
        $scope.pageId++;
        $scope.find();
    };

    $scope.setPage = function (pageNo) {
        $scope.currentPage = pageNo;
    };

    $scope.pageChanged = function (n) {
        $scope.meta.pageId = n;
        $scope.find();
    };
}