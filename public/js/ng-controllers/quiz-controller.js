app.controller(
    "QuizController",
    function ($scope, $timeout, $http, $rootScope) {
        this.prototype = new BaseController(
            $scope,
            $http,
            $timeout,
            $rootScope
        );
        $scope.quizs = [];
        $scope.quiz;
        $scope.mode;
        $scope.categories = [];
        $scope.categoriesObj = {};
        $scope.selectedCategory;
        $scope.selectedLevel;
        $scope.selectedLanguage = {
            value: "en",
            title: "English",
        };
        $scope.answers;
        $scope.levels = [
            {
                value: 1,
                title: "Level 1",
            },
            {
                value: 2,
                title: "Level 2",
            },
            {
                value: 3,
                title: "Level 3",
            },
        ];
        $scope.languages = [
            {
                value: "vi",
                title: "Vietnamese",
            },
            {
                value: "en",
                title: "English",
            },
        ];
        $scope.init = () => {
            $scope.getCategories().then(() => {
                $scope.getQuizs();
                $scope.resetDataCreate();
            });
        };

        $scope.getCategories = () => {
            return $http.get("api/category").then((res) => {
                $scope.categories = res.data.result;
                $scope.categories.forEach((c) => {
                    $scope.categoriesObj[String(c.id)] = c;
                });
            });
        };
        $scope.getQuizs = () => {
            let filters = $scope.buildFilter();
            $http.get("api/quiz?embeds=answers&filters=" + filters).then((res) => {
                $scope.quizs = res.data.result;
            });
        };

        $scope.createQuiz = () => {
            const quiz = $scope.buildCreateData();
            let quizId = null;
            if ($scope.mode === "create") {
                $http
                    .post("api/quiz", quiz)
                    .then((res) => {
                        quizId = res.data.result.id;
                        return Promise.all(
                            $scope.answers.map((answer, index) => {
                                if (index == $scope.correctAnswer) {
                                    answer.is_correct = true;
                                } else {
                                    answer.is_correct = false;
                                }
                                answer.quiz_id = quizId;
                                return $http.post("api/answer", answer);
                            })
                        );
                    })
                    .then(() => {
                        toastr.success("Tạo thành công!");
                        $scope.resetDataCreate();
                    })
                    .catch((err) => console.log(err));
            }
            if ($scope.mode === "edit") {
                $http
                    .put("api/quiz/" + quiz.id, quiz)
                    .then((res) => {
                        quizId = res.data.result.id;
                        return Promise.all(
                            $scope.answers.map((answer, index) => {
                                if (index == $scope.correctAnswer) {
                                    answer.is_correct = true;
                                } else {
                                    answer.is_correct = false;
                                }
                                answer.quiz_id = quizId;
                                return $http.put(
                                    "api/answer/" + answer.id,
                                    answer
                                );
                            })
                        );
                    })
                    .then(() => {
                        toastr.success("Sửa thành công!");
                    })
                    .catch((err) => console.log(err));
            }
        };

        $scope.buildCreateData = () => {
            $scope.quiz.category_id = $scope.selectedCategory.id;
            $scope.quiz.level = $scope.selectedLevel.value;
            $scope.quiz.language = $scope.selectedLanguage.value;
            return $scope.quiz;
        };

        $scope.buildFilter = () => {
            let filters = '';
            filters += "language=" + $scope.selectedLanguage.value;
            return filters;

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

        $scope.removeQuiz = (quiz) => {
            if (confirm("Bạn có muốn xóa danh mục " + quiz.title + " không?")) {
                $http
                    .delete("/api/quiz/" + quiz.id)
                    .then(() => {
                        return Promise.all(
                            quiz.answers.map((answer) => {
                                return $http.delete("api/answer/" + answer.id);
                            })
                        );
                    })
                    .then((res) => {
                        toastr.success("Xóa thành công!");
                        $scope.quizs = $scope.quizs.filter(
                            (q) => q.id !== quiz.id
                        );
                    });
            }
        };

        $scope.resetDataCreate = () => {
            $scope.quiz = {
                title: "",
                fact: "",
                image_url: "",
                category_id: "",
            };
            $scope.selectedLevel = {
                value: 1,
                title: "Level 1",
            };
            $scope.answers = [
                {
                    content: "",
                    is_correct: false,
                },
                {
                    content: "",
                    is_correct: false,
                },
                {
                    content: "",
                    is_correct: false,
                },
                {
                    content: "",
                    is_correct: false,
                },
            ];
        };

        $scope.init();
    }
);
