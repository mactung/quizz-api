
@extends('layouts.main')

@section('css')
    <style>
        .mw-300 {
            max-width: 300px
        }
    </style>
@endsection

@section('content')
    <script src="js/ng-controllers/quiz-controller.js"></script>
    <div class="row" ng-controller="QuizController">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Quizs</h3>
                </div>
            <!-- /.card-header -->
                <div class="card-body">
                    @include('quiz.inc.filter')

                    <div class="mb-3 mt-3 row">
                        <div class="col-10">
                        </div>
                        <div class="col-2">
                            <div class="float-right text-right">
                                <button type="button" 
                                    class="btn btn-primary btn-sm" 
                                    data-toggle="modal" 
                                    data-target="#modal-xl" 
                                    ng-click="openModal('create')">
                                Add Quiz</button>
                            </div>
                        </div>
                    </div>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th style="width: 2%">#</th>
                                <th style="width: 30%">Title</th>
                                <th style="width: 30%">Answers</th>
                                <th style="width: 30%">Fact</th>
                                <th style="width: 15%">Image</th>
                                <th style="width: 8%">Options</th>
                            </tr>
                            
                        </thead>
                        <tbody>
                            <tr ng-repeat="quiz in quizs track by $index">
                                <td ng-bind="quiz.id"></td>
                                <td >
                                    <span class="font-weight-bold " ng-bind="quiz.title"></span>
                                    <div class="mt-5"><span class="font-weight-bold">Level:</span> <span ng-bind="quiz.level"></span></div>
                                    <div><span class="font-weight-bold">Category: </span><span ng-bind="categoriesObj[quiz.category_id].name"></span></div>
                                </td>
                                <td>
                                    
                                    <div ng-repeat="answer in quiz.answers track by $index"> 
                                        <i class="fa fa-check" ng-show="answer.is_correct == 1"></i>
                                        <i class="fa fa-circle" ng-hide="answer.is_correct == 1"></i>
                                        @{{ answer.content }}
                                    </div>
                                </td>
                                <td >
                                    <div class="overflow-auto" style="height: 200px;" ng-bind="quiz.fact"></div>
                                </td>
                                
                                <td >
                                    <img src="@{{ quiz.image_link }}"
                                        style="width: 200px; height: 110px; object-fit: cover;"  />
                                </td>
                                <td>
                                    <button
                                        data-toggle="modal" 
                                        data-target="#modal-xl" 
                                        class="btn-sm btn-primary" 
                                        ng-click="openModal('edit', quiz)">
                                        <i class="fa fa-edit"></i>
                                    </button>

                                    <button
                                        class="btn-sm btn-danger" 
                                        ng-click="removeQuiz(quiz)">
                                        <i class="fa fa-times"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    {{-- <tfoot>
                        <tr>
                            
                        </tr>
                    </tfoot> --}}
                    </table>
                    <!-- <div class="mt-3" ng-show="vocabularys.length > 0">
                        @include('inc.pagination')
                    </div> -->
                </div>
            </div>
        </div>
        @include('quiz.inc.modal')
    </div>

@endsection