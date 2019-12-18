jQuery(function($){
	var deactivation_Link = $('#the-list').find('[data-slug="my-first-plugin"] span.deactivate a'),
	 	popup_ms = $("#popup"),
	 	popup_form = popup_ms.find('form'),
	 	form_open = false;

	 	//Ngăn không cho default deactivation chạy và bật popup
	 	deactivation_Link.on('click',function(event){
	 		event.preventDefault();
	 		popup_ms.css('display','block');
	 		form_open = true;
	 	});

	 	// Chạy khi bấm vào nút có
	 	popup_form.on('click','#yes',function(event){
	 		event.preventDefault();
	 		//tạo biến data với action key để hook vào hàm xóa data.
	 		var data = {};
	 		data.action = "delete_data";
	 		//AJAX request để xóa data
	 		jQuery.post(deactivate_popup_js_ajax.ajax_url,data,clear_ajax); 
	 		//chạy hàm sau khi gửi request thành công, hiện thông báo
	 		function clear_ajax(){
	 			alert('Bạn đã xóa dữ liệu thành công!');
	 		};
	 		location.href = deactivation_Link.attr('href');
	 	});

	 	//Chạy khi bấm vào nút không
	 	popup_form.on('click','#no',function(event){
	 		event.preventDefault();
	 		location.href = deactivation_Link.attr('href');
	 	});

	 	// Bấm ESC để thoát khỏi popup ms
	 	$(document).keyup(function(event) {
			if (27 == event.keyCode && form_open) {
				popup_ms.hide();
				form_open = false;
			}
		});
})