function addAdmin(id){
	$.post("/admin/addAdminAjax/"+id, {}, function (data) {
		alert("Модератор добавлен");
		location="/admin/";
	});
}

function delAdmin(id){
	$.post("/admin/delAdminAjax/"+id, {}, function (data) {
		alert("Модератор удален");
		location="/admin/";
	});
}

$(function(){
  $("#phone").mask("+7 (999) 999-99-99");
});

$(document).ready(function() {

	$("#category").change(function() {
		var sort = $("#category option:selected").attr("data-sort"); 
		$("#catName").val($("#category option:selected").text().trim()); 
		$("#sortCat option[value='"+ sort +"']").attr("selected", "selected");
	});

	$("#delUser").click(function () {
		var result = confirm("Вы действительно хотите удалить аккаунт?");
		if(result)
			$.post("/cabinet/delUser", {}, function (data) {
				alert("Аккаунт удален");
				location="/";
			});
		return false;
	});

	$(".add-to-cart").click(function () {
		var id = $(this).attr("data-id");
		$.post("/cart/addAjax/"+id, {}, function (data) {
			$("#cart-count").html(data);
			$("#hint-"+id).toggle(300).delay(1000).fadeOut(300); 
		});
		return false;
	});

	$(".delete-feedback").click(function () {

		var idf = $(this).attr("data-id");
		var result = confirm("Вы действительно хотите удалить сообщение?");
		if(result)
			$.post("/user/delFeedbackAjax/"+idf, {}, function (data) {
				alert("Сообщение удалено");
				location="/feedback";
			});
		return false;
	});
	/* Показать/скрыть форму feedback */
	$('#show-form').click(function () {
		$('.sub-feedback').removeClass('hide');
		$('#feedback').addClass('hide');
	});
	$('form#add-feedback #cancel').click(function () {
		$('.sub-feedback').addClass('hide');
		$('#feedback').removeClass('hide');
		location="/feedback";
	});

	$('#admin-cancel').click(function () {
		location="/admin";
	});

	$('#cart-cancel').click(function () {
		location="/cart";
	});

	$('.edit-product').click(function () {
		var id = $(this).attr("data-id");
		$('a.cancel-product[data-id="'+id+'"]').removeClass('hide');
		$('a.apply-product[data-id="'+id+'"]').removeClass('hide');
		$('a.delete-product[data-id="'+id+'"]').addClass('hide');
		$('a.edit-product[data-id="'+id+'"]').addClass('hide');

		$('form[data-id="'+id+'"]').removeClass('hide');
		$('div.row[data-id="'+id+'"]').css('display', 'none');
	});

	$('.delete-product').click(function () {
		var id = $(this).attr("data-id");
		var result = confirm("Вы действительно хотите удалить этот товар?");
		if(result)
			$.post("/product/delProductAjax/"+id, {}, function (data) {
				alert("Товар удален");
				location="/admin/editProduct";
			});
		return false;
	});

	$('.delete-category').click(function () {
		var id = $('#category').val();
		var result = confirm("Вы действительно хотите удалить эту категорию?");
		if(result)
			$.post("/category/delCategoryAjax/"+id, {}, function (data) {
				alert("Категория удалена");
				location="/admin";
			});
		return false;
	});

	$("#categories ul").hide();
	$("#categories li span").click(function() {
		$("#categories ul:visible").slideUp("normal");
		if (($(this).next().is("ul")) && (!$(this).next().is(":visible"))) {
			$(this).next().slideDown("normal");
		}
	});



	// $('.apply-product').click(function () {
	// 	var id = $(this).attr("data-id");
	// 	// var photo = ''; var name = ''; var price = '';

	// 	photo = $('#image_file[data-id="55"]').val().substr($('#image_file[data-id="55"]').val().lastIndexOf('\\') + 1);
	// 	name = $('[data-id="'+id+'"][name="name"]').val();
	// 	price = $('[data-id="'+id+'"][name="price"]').val();
	// 	category = $('[data-id="'+id+'"][name="category"]').val();
	// 	description = $('[data-id="'+id+'"][name="description"]').val().trim();
	// 	code = $('[data-id="'+id+'"][name="code"]').text();
	// 	brand = $('[data-id="'+id+'"][name="brand"]').val();

	// 	var result = confirm("Вы действительно хотите применить изменения? ");
	// 	if(result)
	// 		// $.post(
	// 		// 	// "/product/editProductAjax/"+name+'/'+category+'/'+price+'/'+description+'/'+code+'/'+brand+'/'+photo, 
	// 		// 	"/product/editProductAjax/"+id, 
	// 		// 	{
	// 		// 		name:name,
	// 		// 		category:category,
	// 		// 		price:price,
	// 		// 		description:description,
	// 		// 		code:code,
	// 		// 		brand:brand,
	// 		// 		photo:photo,
	// 		// 	}, 
	// 		// );		
	// 		$.ajax({
	// 			url: "/product/editProductAjax/"+id,
	// 			method:"POST",
	// 			data:{
	// 				name:name,
	// 				category:category,
	// 				price:price,
	// 				description:description,
	// 				code:code,
	// 				brand:brand,
	// 				photo:photo,
	// 			},
	// 		});
	// 	return false;
	// });

	// $('.cancel-product').click(function () {
	// 	var id = $(this).attr("data-id");
		// $('a.edit-product[data-id="'+id+'"]').removeClass('hide');
		// $('a.apply-product[data-id="'+id+'"]').addClass('hide');
	// 	$('a.delete-product[data-id="'+id+'"]').removeClass('hide');
	// 	$('a.cancel-product[data-id="'+id+'"]').addClass('hide');
	// 	$('form[data-id="'+id+'"]').addClass('hide');
	// 	$('div.row[data-id="'+id+'"]').css('display', 'flex');
	// });
		
});
