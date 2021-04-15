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
            $scope.search();
        }
    };

    $scope.next = () => {
        $scope.pageId++;
        $scope.search();
    };
}