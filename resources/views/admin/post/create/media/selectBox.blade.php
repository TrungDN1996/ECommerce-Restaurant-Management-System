<div class="row m-0 px-3 align-items-center bg-white py-0 py-sm-3" id="adminMediaSelectBoxWrap" style="border-bottom: 2px solid #251c18;">
    <div class="col-sm-auto pb-3 pb-sm-0">
        <a href="#" class="text-dark"><i class="fas fa-list-alt" style="font-size: 2rem;"></i></a>
    </div>
    <div class="col-sm-auto pb-3 pb-sm-0">
        <a href="#" class="text-dark"><i class="fas fa-th-large" style="font-size: 2rem;"></i></a>
    </div>
    <div class="col-sm-auto pb-3 pb-sm-0">
        <select name="type" class="col-auto adminMediaIndexAjax" id="media-types">
            <option value="all">All Media</option>
            <option value="image">Image</option>
            <option value="video">Video</option>
            <option value="audio">Audio</option>
            <option value="mine">Mine</option>
        </select>
    </div>
    <div class="col-sm-auto p-2" style="border: 1px solid #b37c4a;">
        <div class="row m-0 align-items-center">
            <div class="col-auto">
                <strong class="pr-2">Years:</strong>
                <select name="year" id="adminMediaYearArchive">
                    <option value="all">All Years</option>
                    @foreach($years as $key => $val)
                        <option value="{{ $val['year'] }}">{{ $val['year'] }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-auto">
                <strong class="pr-2">Months:</strong>
                <select name="month" id="adminMediaMonthArchive">
                    <option value="all">All Months</option>
                    @for ($i = 12; $i >= 1; $i--)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>
            </div>
            <div class="col-auto">
                <strong class="pr-2">Days:</strong>
                <select name="day" id="adminMediaDayArchive">
                    <option value="all">All Days</option>
                    @for ($i = 31; $i >= 1; $i--)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>
            </div>
            <div class="col-auto">
                <input type="button" value="Filter" class="btn btn-dark" id="adminMediaTimeFilterButton">
            </div>
        </div>
    </div>
</div>
