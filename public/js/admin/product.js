$(document).ready(function(){
	$("#search").keyup(function(event) {
		/* Act on the event */
		var search = $(this).val();
		//alert(search);
		$.get('/admin/product/search', {'search':search}, function(data){
			//alert(data);
            $("#list-search").html(data);
        });
	});
});

$(document).ready(function(){
	$("select[name = page]").change(function(event) {
		/* Act on the event */
		var page = $(this).val();
		//alert(page);
		$.get('/admin/product/listpage/'+page, {'page':page}, function(data){
			$('#list-product').html(data);
		});
	});

});

$(document).ready(function() {
	$(".filterByAjax").each(function() {
		$(this).change(function() {
			var url = '/admin/product/filter/filterByAjax';
			var category = $("#category option:selected").val();
			var product = $("#product option:selected").val();

			$.ajax({
                method: 'GET',
                url: url,
                data: {
                	category: category,
                    product: product,
					},
				})
            .done(function (data) {
                $("#list-product").html(data);
            	})
            .fail(function () {
                alert('Error Something Wrong');
            });

     	});
    });
});

$(".alert").delay(3000).slideUp();
