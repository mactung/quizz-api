<div class="modal fade show" id="modal-xl" style="display: none;" aria-modal="true">
<div class="modal-dialog modal-xl">
    <div class="modal-content">
    <div class="modal-header">
        <h4 class="modal-title">Extra Large Modal</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">×</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="row mb-3">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Title" 
                    aria-label="Cateogry Name" 
                    aria-describedby="basic-addon2"
                    ng-model="categoryName">
            </div>
        </div>
    </div>
    <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" ng-click="createCategory()">Save changes</button>
    </div>
    </div>
    <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>
