app.controller("QuizController", function ($scope, $timeout, $http, $rootScope) {
    this.prototype = new BaseController($scope, $http, $timeout, $rootScope);
    $scope.quizs = [];
    $scope.quiz = {
        title: "",
        fact: "",
        image_url: "",
        category_id: "",
        level: 0,
    };
    $scope.mode;
    $scope.categories = [];
    $scope.selectedCategory;
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
    $scope.tempVocabularys = {};
    $scope.searchText = null;
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
    $scope.init = () => {
        $scope.getCategories().then(() => {
            $scope.getQuizs();
        });
    };

    $scope.getCategories = () => {
        return $http.get("api/category").then((res) => {
            $scope.categories = res.data.result;
            $scope.selectedCategory = $scope.categories[0];
        });
    };
    $scope.getQuizs = () => {
        $http.get("api/quiz?embeds=answers").then((res) => {
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
                    $scope.answers.forEach((answer, index) => {
                        if (index == $scope.correctAnswer) {
                            answer.is_correct = true;
                        } else {
                            answer.is_correct = false;
                        }
                        answer.quiz_id = quizId;
                        $http.post("api/answer", answer);
                    });
                })
                .catch((err) => console.log(err));
        }
        if ($scope.mode === "edit") {
            $http
                .put("api/quiz/" + quiz.id, quiz)
                .then((res) => {
                    quizId = res.data.result.id;
                    $scope.answers.forEach((answer, index) => {
                        if (index == $scope.correctAnswer) {
                            answer.is_correct = true;
                        } else {
                            answer.is_correct = false;
                        }
                        answer.quiz_id = quizId;
                        $http.put("api/answer/" + answer.id, answer);
                    });
                })
                .catch((err) => console.log(err));
        }
    };

    $scope.buildCreateData = () => {
        $scope.quiz.category_id = $scope.selectedCategory.id;
        $scope.quiz.level = $scope.selectedLevel.value;
        return $scope.quiz;
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
        $http.delete('/api/quiz/' + quiz.id).then(() => {
            quiz.answers.forEach(answer => {
                $http.delete('api/answer/' + answer.id);
            })
        })
    }

    $scope.init();
});
