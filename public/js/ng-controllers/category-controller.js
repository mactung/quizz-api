app.controller("CategoryController", function ($scope, $timeout, $http, $rootScope) {
    this.prototype = new BaseController($scope, $http, $timeout, $rootScope);
    $scope.mode;
    $scope.categories = [];
    $scope.selectedCategory;
    $scope.categoryName;
    
    
    $scope.searchText = null;
   
    $scope.init = () => {
        $scope.getCategories()
    };

    $scope.getCategories = () => {
        return $http.get("api/category").then((res) => {
            $scope.categories = res.data.result;
        });
    };

    $scope.createCategory = () => {
        console.log(11);
        $http.post('api/category', {
            name: $scope.categoryName
        })
        .then((res) => console.log(res)).catch(err => console.log(err))
    }

    $scope.openModal = (mode, quiz) => {
        $scope.mode = mode;
        if (mode === "create") {
            return;
        }
        if (mode === "edit") {
            $scope.quiz = quiz;
            $scope.answers = quiz.answers;
            $scope.answers.forEach((answer, index) => {
                if (answer.is_correct === 1) {
                    console.log(index);
                    $scope.correctAnswer = String(index);
                }
            });
            $scope.selectedLevel = {
                value: quiz.level,
                title: "Level " + quiz.level,
            };
            $scope.categories.forEach((category) => {
                if (category.id === quiz.category_id) {
                    $scope.selectedCategory = category;
                }
            });
        }
    };

    $scope.removeCategory = (category) => {
        $http.delete("/api/category/" + category.id).then(() => {
        });
    }
    $scope.init();
});
