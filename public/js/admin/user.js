/**
 * admin.user.index
 *
 * @return {[type]} [description]
 */
$(document).ready(function () {
    /**
     * Filter
     *
     * @return {[type]} [description]
     */
    $(".adminUserIndexAjax").each(function () {
        $(this).change(function () {
            var select = $("#adminUserSelect option:selected").val();
            var role = $("#adminUserRole option:selected").val();
            var activate = $("#adminUserActive option:selected").val();
            var status = $("#adminUserStatus option:selected").val();
            var type = $("#adminUserType option:selected").val();
            var year = $("#adminUserYearArchive option:selected").val();
            var month = $("#adminUserMonthArchive option:selected").val();
            var day = $("#adminUserDayArchive option:selected").val();


            $.ajax({
                method: 'GET',
                url: url,
                data: {
                    select: select,
                    role: role,
                    activate: activate,
                    status: status,
                    type: type,
                    year: year,
                    month: month,
                    day: day,
                },
            })
            .done(function (data) {
                $("#adminUserTableList").html(data);
                activateCheckbox();
                paginateAjax();
            })
            .fail(function () {
                alert('Error Something Wrong');
            });


        });

        /**
         * [description]
         *
         * @return {[type]} [description]
         */
        $("#adminUserTimeFilterButton").click(function(){
            var select = $("#adminUserSelect option:selected").val();
            var role = $("#adminUserRole option:selected").val();
            var activate = $("#adminUserActive option:selected").val();
            var status = $("#adminUserStatus option:selected").val();
            var type = $("#adminUserType option:selected").val();
            var year = $("#adminUserYearArchive option:selected").val();
            var month = $("#adminUserMonthArchive option:selected").val();
            var day = $("#adminUserDayArchive option:selected").val();


            $.ajax({
                method: 'GET',
                url: url,
                data: {
                    select: select,
                    role: role,
                    activate: activate,
                    status: status,
                    type: type,
                    year: year,
                    month: month,
                    day: day,
                },
            })
            .done(function (data) {
                $("#adminUserTableList").html(data);
                activateCheckbox();
                paginateAjax();
            })
            .fail(function () {
                alert('Error Something Wrong');
            });
        });

        /**
         * [description]
         *
         * @return {[type]} [description]
         */
        $("#adminUserYearArchive").change(function(){
            var year = $("#adminUserYearArchive option:selected").val();

            $.ajax({
                method: 'POST',
                url: FilterMonthUrl,
                data: {
                    year: year,
                },
            })
            .done(function (data) {
                $("#adminUserMonthArchive").html(data);
            })
            .fail(function () {
                alert("Error Something Wrong !");
            });
        });

        /**
         * [description]
         *
         * @return {[type]} [description]
         */
        $("#adminUserMonthArchive").change(function(){
            var month = $("#adminUserMonthArchive option:selected").val();

            $.ajax({
                method: 'POST',
                url: FilterDayUrl,
                data: {
                    month: month,
                },
            })
            .done(function (data) {
                $("#adminUserDayArchive").html(data);
            })
            .fail(function () {
                alert("Errors Something Wrong");
            });
        });
    });


    /**
     * Bulk action
     *
     * @return {[type]} [description]
     */
    $(".checkbox-all").each(function () {
        $(this).change(function () {
            if ($(this).prop("checked") == true){
                $(".checkbox-item").each(function () {
                    $(this).prop( "checked", true );
                });
            } else {
                $(".checkbox-item").each(function () {
                    $(this).prop( "checked", false );
                });
            }
        });
    });
    /**
     * activate checkbox
     */
    activateCheckbox();
});

/**
 * [activateCheckbox description]
 *
 * @return {[type]} [description]
 */
function activateCheckbox()
{
    $(".activate-checkbox").each(function(){
        $(this).change(function(){

            if ($(this).prop("checked") == true) {
                var action ="activate";
            } else {
                var action = "deactivate";
            }
            var id = $(this).prop("user-id");
            var url_activate_checkbox = $(this).attr("url");


            $.ajax({
                method: "POST",
                url: url_activate_checkbox,
                data: {
                    action: action,
                    id: id,
                },
            })
            .done(function (data){
                console.log(data);
            })
            .fail(function (data){
                alert('Fail ... Something Wrong .. !');
            });


        });
    });
}

/**
 * [paginateAjax description]
 *
 * @return {[type]} [description]
 */
function paginateAjax()
{
    /**
     * Paginate ajax
     */
    $("div.paginate-ajax a.page-link").each(function(){
        $(this).click(function(e){
            e.preventDefault();
             e.stopPropagation();
            var href = $(this).attr("href");

            $.ajax({
                method: 'GET',
                url: href,
            })
            .done(function(data){
                $("#adminUserTableList").html(data);
                activateCheckbox();
                paginateAjax();
            })
            .fail(function(){
                alert("Error .. ! Something Wrong !");
            });
        });
    });
}
