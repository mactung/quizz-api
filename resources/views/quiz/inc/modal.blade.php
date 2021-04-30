<div class="modal fade show" id="modal-xl" style="display: none;" aria-modal="true">
<div class="modal-dialog modal-xl">
    <div class="modal-content">
    <div class="modal-header">
        <h4 class="modal-title" ng-show="mode === 'create'">Thêm quiz</h4>
        <h4 class="modal-title" ng-show="mode === 'edit'">Sửa quiz</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">×</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="row mb-3">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Title" 
                    aria-label="Title" 
                    aria-describedby="basic-addon2"
                    ng-model="quiz.title"
                    ng-model-options='{ debounce: 1000 }'
                    ng-change="searchQuiz()">
            </div>
            <div class="row flex-column ml-3 mr-3 mb-3 w-100 pl-2" ng-show="relatedQuizs.length > 0">
                <span class="font-weight-bold">Câu hỏi tương tự: </span>
                <span class="border-bottom  pt-1 pb-1" ng-repeat="quiz in relatedQuizs" ng-bind="quiz.title"><span>
            </div>
            <div class="custom-control custom-radio w-100">
                <div class="input-group mb-1">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                        <input type="radio" name="customRadio" ng-model="correctAnswer" value="0">
                        </div>
                    </div>
                    <input type="text" class="form-control" ng-model="answers[0].content">
                </div>
                <div class="input-group mb-1">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                        <input type="radio" name="customRadio" ng-model="correctAnswer" value="1">
                        </div>
                    </div>
                    <input type="text" class="form-control" ng-model="answers[1].content">
                </div>
                <div class="input-group mb-1">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                        <input type="radio" name="customRadio" ng-model="correctAnswer" value="2">
                        </div>
                    </div>
                    <input type="text" class="form-control" ng-model="answers[2].content">
                </div>
                <div class="input-group mb-1">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                        <input type="radio" name="customRadio" ng-model="correctAnswer" value="3">
                        </div>
                    </div>
                    <input type="text" class="form-control" ng-model="answers[3].content">
                </div>
            </div>
            <div class="form-group mb-3 w-100 p-3">
                <label for="exampleFormControlTextarea1">Fact</label>
                <textarea class="form-control rounded-0" 
                    id="exampleFormControlTextarea1" rows="10"
                    ng-model="quiz.fact"
                ></textarea>
            </div>
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Image Link" 
                    aria-label="Image Link" 
                    aria-describedby="basic-addon2"
                    ng-model="quiz.image_link">
            </div>

        </div>
        <div  class="row">
            <div class="input-group mb-3 col-3">
                <select class="custom-select"
                    ng-options="item as item.name for item in categories track by item.id" ng-model="selectedCategory"
                >
                    <option value="">Chọn Category</option>
                </select>
            </div>
            <div class="input-group mb-3 col-3">
                <select class="custom-select"
                    ng-options="item as item.title for item in levels track by item.value" ng-model="selectedLevel"
                >
                    <option value="">Chọn Level</option>
                </select>
            </div>
            <div class="input-group mb-3 col-3">
                <select class="custom-select"
                    ng-options="item as item.title for item in languages track by item.value" ng-model="selectedLanguage"
                >
                    <option value="">Chọn Language</option>
                </select>
            </div>
            <div class="input-group mb-3 col-3">
                <select class="custom-select"
                    ng-options="item as item.title for item in nations track by item.value" ng-model="selectedNation"
                >
                    <option value="">Chọn quốc gia</option>
                </select>
            </div>
        </div>
    </div>
    <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" ng-click="createQuiz()">Save changes</button>
    </div>
    </div>
    <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>
