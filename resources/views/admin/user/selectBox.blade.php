<div class="row m-0 p-3 align-items-center bg-white ">
    <div class="col-12 col-sm-auto pb-3 pt-0 py-md-2">
        <strong class="pr-2">Select:</strong>
        <select name="select" class="col-auto adminUserIndexAjax" id="adminUserSelect">
            <option value="active">Active</option>
            <option value="deleted">Deleted</option>
            <option value="all">All</option>
        </select>
    </div>
    <div class="col-12 col-sm-auto pb-3 pt-0 py-md-2">
        <strong class="pr-2">Roles:</strong>
        <select name="role" class="col-auto adminUserIndexAjax" id="adminUserRole">
            <option value="all">All Roles</option>
            <option value="user">User</option>
            <option value="admin">Adminstrator</option>
        </select>
    </div>
    <div class="col-12 col-sm-auto pb-3 pt-0 py-md-2">
        <strong class="pr-2">Activate/InActivate:</strong>
        <select name="activate" class="col-auto adminUserIndexAjax" id="adminUserActive">
            <option value="all">All</option>
            <option value="1">Activated</option>
            <option value="0">InActivate</option>
        </select>
    </div>
    <div class="col-12 col-sm-auto pb-3 pt-0 py-md-2">
        <strong class="pr-2">Status:</strong>
        <select name="status" class="col-auto adminUserIndexAjax" id="adminUserStatus">
            <option value="all">All Status</option>
            <option value="old">Old</option>
            <option value="new">New</option>
            <option value="loyal">Loyal</option>
        </select>
    </div>
    <div class="col-12 col-sm-auto pb-3 pt-0 py-md-2">
        <strong class="pr-2">Type:</strong>
        <select name="type" class="col-auto adminUserIndexAjax"id="adminUserType">
            <option value="all">All Types</option>
            <option value="traveller">Traveller</option>
            <option value="local">Local</option>
        </select>
    </div>
    <div class="col-12 p-0">
        <div class="row m-0 align-items-center p-3">
            <div class="col-auto">
                <strong class="pr-2">Years:</strong>
                <select name="year" class="col-auto" id="adminUserYearArchive">
                    <option value="all">All Years</option>
                    @foreach ($years as $key => $val)
                        <option value="{{ $val['year'] }}">{{ $val['year'] }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-auto">
                <strong class="pr-2">Months:</strong>
                <select name="month" class="col-auto" id="adminUserMonthArchive">
                    <option value="all">All Months</option>
                    @for ($i = 12; $i >= 1; $i--)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>
            </div>
            <div class="col-auto">
                <strong class="pr-2">Days:</strong>
                <select name="day" class="col-auto" id="adminUserDayArchive">
                    <option value="all">All Days</option>
                    @for ($i = 31; $i >= 1; $i--)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>
            </div>
            <div class="col-auto">
                <input type="button" value="Filter" id="adminUserTimeFilterButton" class="btn btn-dark">
            </div>
        </div>
    </div>
</div>
