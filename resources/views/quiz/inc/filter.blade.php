<div class="mb-5">
    <div class="row">
        <div class="col-3">
            <div class="input-group mb-3">
                <select class="custom-select"
                    ng-options="level as level.title for level in levels track by level.value"
                    ng-model="selectedLevel">
                    <option value="">Chọn Level</option>
                </select>
            </div>
        </div>
        <div class="col-3">
            <div class="input-group mb-3">
                <select class="custom-select"
                    ng-options="category as category.name for category in categories track by category.id"
                    ng-model="selectedCategory">
                    <option value="">Chọn Category</option>
                </select>
            </div>
        </div>
        <div class="col-3">
            <div class="input-group mb-3">
                <select class="custom-select"
                    ng-options="language as language.title for language in languages track by language.value"
                    ng-model="selectedLanguage">
                </select>
            </div>
        </div>
    </div>
    <div class="mb-5 row">
        <div class="col-10">
            <form class="form">
                <div class="input-group">
                    <input class="form-control" type="search" placeholder="Search" ng-model="searchText">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit" ng-click="search()">Search</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-2">
            <button class="btn btn-primary" ng-click="clear()">Clear</button>

        </div>
    </div>
</div>