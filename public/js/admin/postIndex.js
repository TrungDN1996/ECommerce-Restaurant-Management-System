$(document).ready(function(){
    $("select[name = type]").change(function(){
        var type = $(this).val();
        //alert(type);
        $.get('/admin/post/'+type+'/type/', {'type':type}, function(data){
            $("#list_type").html(data);
        });
    });

    $("select[name = user]").change(function(){
        var user = $(this).val();
        //alert(user);
        $.get('/admin/post/'+user+'/user/', {'user':user}, function(data){
            $("#list_type tbody").html(data);
        });
    });

    $("select[name = category]").change(function(){
        var category = $(this).val();
        //alert(category);
        $.get('/admin/post/'+category+'/category/', {'category':category}, function(data){
            $("#list_type tbody").html(data);
        });
    });
});

$(document).ready(function() {
	$("#search").keyup(function(event) {
        var search = $(this).val();
        //alert(search);
        $.get('/admin/post/list/search', {'search':search}, function(data){
            $("#list_type tbody").html(data);
        });
    });
});
