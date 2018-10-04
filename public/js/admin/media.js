/**
 * admin.media.index  : Sending Ajax
 *
 * @return {[type]} [description]
 */
$(document).ready(function () {

    /**
     * [description]
     *
     * @return {[type]} [description]
     */
    $(".adminMediaIndexAjax").each(function () {
        $(this).change(function () {
            var type = $("#media-types option:selected").val();
            var year = $("#adminMediaYearArchive option:selected").val();
            var month = $("#adminMediaMonthArchive option:selected").val();
            var day = $("#adminMediaDayArchive option:selected").val();

            $.ajax({
                method: 'POST',
                url: url,
                data: {
                    type: type,
                    year: year,
                    month: month,
                    day: day,
                },
            })
            .done(function (data) {
                $("#adminMediaListAllFiles").html(data);
            })
            .fail(function () {
                alert('Error Something Wrong');
            });
        });
    });

    $("#adminMediaTimeFilterButton").click(function(){
        var type = $("#media-types option:selected").val();
        var year = $("#adminMediaYearArchive option:selected").val();
        var month = $("#adminMediaMonthArchive option:selected").val();
        var day = $("#adminMediaDayArchive option:selected").val();

        $.ajax({
            method: 'POST',
            url: url,
            data: {
                type: type,
                year: year,
                month: month,
                day: day,
            },
        })
        .done(function (data) {
            $("#adminMediaListAllFiles").html(data);
        })
        .fail(function () {
            alert('Error Something Wrong');
        });
    });

    /**
     * filter all month in specific year
     *
     * @return {[type]} [description]
     */
    $("#adminMediaYearArchive").change(function(){
        var year = $("#adminMediaYearArchive option:selected").val();

        $.ajax({
            method: 'POST',
            url: FilterMonthUrl,
            data: {
                year: year,
            },
        })
        .done(function(data){
            $("#adminMediaMonthArchive").html(data);
        })
        .fail(function () {
            alert("Error Something Wrong!");
        });

    });

    /**
     * filter all days in specific month
     *
     * @return {[type]} [description]
     */
    $("#adminMediaMonthArchive").change(function(){
        var month = $("#adminMediaMonthArchive option:selected").val();

        $.ajax({
            method: 'POST',
            url: FilterDayUrl,
            data: {
                month: month,
            },
        })
        .done(function (data) {
            $("#adminMediaDayArchive").html(data);
        })
        .fail(function () {
            alert("Errors: Something Wrong !");
        });

    });

    /**
     * [description]
     *
     * @return {[type]} [description]
     */
    displayAdminMediaShowItem();
    /**
     * Toggle select box
     */
    $("#bulkSelectFile").click(function(){
        $("#adminMediaSelectBoxWrap").addClass("d-none");
        $("#adminMediaBulkDestroyWrap").removeClass("d-none");

        $(".imageWrap").unwrap().addClass("adminMediaImageWrap");
        $(".adminMediaImageWrap").each(function(){
            $(this).click(function(){
                var checkbox = $(this).find("input[type='checkbox']");
                if (checkbox.prop("checked") == true) {
                    checkbox.prop("checked", false);
                } else {
                    checkbox.prop("checked", true);
                }
                $(this).find("i.adminMediaImageCheckBoxIcon").toggleClass("d-none");
                $(this).toggleClass("ImageWrapBorderColor");
            });
        });
    });

    $("#cancelBulkSelect").click(function(){
        $("#adminMediaBulkDestroyWrap").addClass("d-none");
        $("#adminMediaSelectBoxWrap").removeClass("d-none");

        /** hide icon checkbox */
        $(".adminMediaImageWrap i.adminMediaImageCheckBoxIcon").each(function(){
            if (! $(this).hasClass("d-none")) {
                $(this).addClass("d-none");
            }
        });

        /** change checkbox value to false */
        $(".adminMediaImageWrap input[type='checkbox']").prop("checked", false);

        /** remove click event - remove border */
        $(".adminMediaImageWrap").each(function(){
            $(this).unbind("click");
            $(this).removeClass("ImageWrapBorderColor");
        });
        $(".imageWrap").removeClass("adminMediaImageWrap");
        $(".imageWrap").wrap("<a href=\"javascript:void(0)\" class=\"displayAdminMediaShowItem d-block\"></a>");
        displayAdminMediaShowItem();
    });

});

/**
 * [displayAdminMediaShowItem description]
 *
 * @return {[type]} [description]
 */
function displayAdminMediaShowItem()
{
    $(".displayAdminMediaShowItem").each(function(){
        $(this).click(function(event){
            event.preventDefault();
            var urlshow = $(this).find("div.imageWrap").attr("data-url");
            $.ajax({
                method: 'GET',
                url: urlshow,
            })
            .done(function (data) {
                $("#adminMediaShowItem").html(data);
                $("#adminMediaShowItem").removeClass("d-none");
                $("#closeAdminmediaShowItem").click(function(){
                    $("#adminMediaShowItem").addClass("d-none");
                    $("#adminMediaShowItem").html('');
                });
            })
            .fail(function () {
                alert('Error Something Wrong');
            });
        });
    });
}
