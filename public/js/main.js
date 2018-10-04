/**
 * Common Jquery event
 *
 * @return {[type]} [description]
 */
$(document).ready(function(){
    $("input[type='file']").each(function(){
        $(this).change(function(){
            $filename = $(this).val().split('\\').pop();
            $(this).prev("span.file-name").css("display", "inline");
            $(this).prev("span.file-name").html($filename);
        });
    });
    $.ajaxSetup({
    headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});
