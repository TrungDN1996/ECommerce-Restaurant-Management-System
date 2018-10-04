<div class="pb-50">
    <div class="row">
        <div class="col-auto">
            <h3>Add Media</h3>
        </div>
        <div class="col-auto row align-items-center">
            <button class="btn btn-primary" id="toggleCollapseUploadForm">Upload</button>
        </div>
    </div>
    {{-- Toggle Upload Form --}}
    <div class="row" id="collapseUploadForm">
        <div class="col text-center">
            <div class="form-group">
                <label for="file" class="btn btn-info" role="button">Upload File</label>
                <span class="file-name"></span>
                <input type="file" name="file" id="file">
            </div>
            <button id="ajaxUploadMedia" class="btn btn-info">Save</button>
        </div>
    </div>
</div>
