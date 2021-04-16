app.controller(
    "CategoryController",
    function ($scope, $timeout, $http, $rootScope) {
        this.prototype = new BaseController(
            $scope,
            $http,
            $timeout,
            $rootScope
        );
        $scope.mode;
        $scope.categories = [];
        $scope.selectedCategory;
        $scope.categoryName;

        $scope.searchText = null;

        $scope.init = () => {
            $scope.getCategories();
        };

        $scope.getCategories = () => {
            return $http.get("api/category").then((res) => {
                $scope.categories = res.data.result;
            });
        };

        $scope.createCategory = () => {
            $http
                .post("api/category", {
                    name: $scope.categoryName,
                })
                .then((res) => {
                    toastr.success("Tạo thành công!");
                })
                .catch((err) => console.log(err));
        };

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
            if (
                confirm("Bạn có muốn xóa danh mục " + category.name + " không?")
            ) {
                $http
                    .delete("/api/category/" + category.id)
                    .then(function (response) {
                        if (response.data.status == "successful") {
                            toastr.success("Xóa thành công!");
                            $scope.categories = $scope.categories.filter(
                                (c) => c.id !== category.id
                            );
                            console.log($scope.categories);
                        }
                    });
            }
        };
        $scope.init();
    }
);
