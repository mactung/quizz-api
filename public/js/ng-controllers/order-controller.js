app.controller('OrderController', function ($scope, $http) {
    $scope.orders = [];
    $scope.meta = {};
    $scope.pageId = 0;
    $scope.pageSize = '50';

    $scope.statuses = {
        expire: 'Expire',
        unexpire: 'Unexpire'
    }

    $scope.filter = {
        name: ''
    };

    $scope.init = () => {
        $scope.find();
    }

    $scope.find = ()=> {
        $scope.orders = [];
        $scope.isLoading = true;
        let filters = $scope.buildFilter();
        $http.get('/api/order' + filters)
            .then(function (response) {
                if (response.data.status == 'successful') {
                    $scope.orders = response.data.result;
                    $scope.meta = response.data.meta;
                    $scope.isLoading = false;
                }
            }, function (error) {
                console.log(error);
                $scope.isLoading = false;
            });
    }

    $scope.search = function () {
        $scope.pageId = 0;
        $scope.find();
    }

    $scope.buildFilter = () => {
        let filters = '?';

        if ($scope.filter.name) {
            filters += 'name=' + $scope.filter.name;
        }

        if ($scope.filter.status) {
            filters += '&status=' + $scope.filter.status;
        }

        if($scope.pageId){
            filters += '&page_id=' + $scope.pageId;
        }

        if($scope.pageSize){
            filters += '&page_size=' + $scope.pageSize;
        }

        return filters;
    }

    $scope.setPage = function (pageNo) {
        $scope.currentPage = pageNo;
    };

    $scope.pageChanged = function () {
        $scope.pageId = $scope.currentPage - 1;
    };

    $scope.clear = () => {
        $scope.pageId = 0;
        $scope.pageSize = '50';
        $scope.filter = {
            name: ''
        };
        let filters = $scope.buildFilter();
        $scope.find();
    }

    $scope.changePage = (index) => {
        $scope.pageId = index - 1;
        $scope.find();
    }

    $scope.range = (first, end)=> {
        let retVal =[];
        for(let i = first; i <= end; i++){
            retVal.push(i);
        }
        return retVal;
    }

    $scope.prev = () => {
        if($scope.pageId > 0){
            $scope.pageId--;
            $scope.find();
        }
    }

    $scope.next = () => {
        if ($scope.pageId < $scope.meta.page_count - 1) {
            $scope.pageId++;
            $scope.find();
        }
    }

    $scope.edit = (item) => {
        item.editing = true;
        item.old_answer = item.answer;
    }

    $scope.read = (item) => {
        item.is_readed = $('#js-is-readed-' + item.id).is(':checked');
        $http.put('/api/feedback/' + item.id, {
            is_readed: item.is_readed ? 1 : 0
        })
            .then(function (response) {
                item.editing = false;
            });
    }

    $scope.show = (item) => {
        item.is_show = $('#js-is-show-' + item.id).is(':checked');
        $http.put('/api/feedback/' + item.id, {
            is_show: item.is_show ? 1 : 0
        })
            .then(function (response) {
                item.editing = false;
            });
    }

    $scope.save = (item) => {
        $http.put('/api/feedback/' + item.id, {
            answer: item.answer
        })
            .then(function (response) {
                item.editing = false;
            });
    }

    $scope.cancel = (item) => {
        item.editing = false;
        item.answer = item.old_answer;
    }

    $scope.refund = (item) => {
        $http.put('/api/user_purchase/' + item.id, {
            status: 'refunded'
        })
            .then(function (response) {
                item.status = 'refunded';
            })
    }

    $scope.init();

})