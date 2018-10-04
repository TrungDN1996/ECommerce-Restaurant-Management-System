$(document).ready(function(){
    $("select[name = type]").change(function(){
        var type = $(this).val();
        //alert(type);
        $.get('/admin/category/'+type, {'type':type}, function(data){
            $("#list_type tbody").html(data);
        });
    });
});

$('.alert').delay(4000).slideUp();