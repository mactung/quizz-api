
@extends('layouts.main')

@section('css')
    <style>
        .mw-300 {
            max-width: 300px
        }
    </style>
@endsection

@section('content')
    <script src="js/ng-controllers/category-controller.js"></script>
    <div class="row" ng-controller="CategoryController">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Categories</h3>
                </div>
            <!-- /.card-header -->
                <div class="card-body">

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
                                Add Category</button>
                            </div>
                        </div>
                    </div>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th style="width: 2%">#</th>
                                <th style="width: 30%">Name</th>
                                <th style="width: 15%">Image</th>
                                <th style="width: 8%">Options</th>
                            </tr>
                            
                        </thead>
                        <tbody>
                            <tr ng-repeat="category in categories track by $index">
                                <td ng-bind="category.id"></td>
                                <td ng-bind="category.name"></td>
                                <td ng-bind="category.image_url"></td>
                                <td>
                                    <button
                                        data-toggle="modal" 
                                        data-target="#modal-xl" 
                                        class="btn-sm btn-primary" 
                                        ng-click="openModal('edit', category)">
                                        <i class="fa fa-edit"></i>
                                    </button>

                                    <button
                                        class="btn-sm btn-danger" 
                                        ng-click="removeCategory(category)">
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
        @include('category.inc.modal')
    </div>

@endsection