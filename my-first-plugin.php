<?php
/**
 * Plugin Name: My First Plugin
 * Plugin URI: 
 * Description: Plugin này sử dụng để tăng bộ đếm cho trang mỗi khi homepage được truy cập.
 * Version: 1.0
 * Author: Quang
 * Author URI: 
 */
if (!defined('ABSPATH')){
	die;
}

class count_plugin{
	
	public function __construct(){
		register_activation_hook(__FILE__,array($this,'plugin_activation')); 					//gán hàm sẽ chạy khi activate plugin.
		
		//hook để gọi các hàm trong class. 
		add_action('template_redirect',array($this,'visitor_count')); 
		add_action('admin_action_count_plugin_request',array($this,'handle_post_request'));
		//add_action('admin_action_delete_data',array($this,'handle_popup_request'));
		add_action('admin_menu',array($this,'create_menu'));
		add_action('wp_footer',array($this,'view_form_homepage')); //chèn html vào trước khi kết thúc body tag.
		add_action('admin_footer',array($this,'plugin_deactivation_popup'));
		add_action('admin_enqueue_scripts',array($this,'deactivate_scripts'));
		add_action('wp_ajax_delete_data',array($this,'delete_data_deactivate_popup'));
	}
	//gọi hàm này khi activate plugin
	public function plugin_activation(){
		 //tạo biến data với bộ đếm để hiển thị.
			$data = array("count"=>0,
					 	  "time"=>null,
					 	  "admin_input"=>"Chào mừng"
					 		);
			add_option("visitor_counter_data",$data); //tạo một trường option trong WP_option để lưu trữ data
		}

	//hàm đếm số người truy cập homepage
	public function visitor_count(){
		if (is_front_page()){ 
			$data = get_option("visitor_counter_data");
				$data["count"]+=1;
				$data['time']=current_time('d/m/Y H:i:s');
				update_option("visitor_counter_data",$data);
			}
		}
	//hàm xử lý input request từ submit button

	public function handle_post_request(){
		if (isset ($_POST['reset'])){
			$data=get_option("visitor_counter_data");
			$data["count"] = 0;
			$data['time'] = null;
			update_option("visitor_counter_data",$data);
			}
		if (isset ($_POST['admin_input'])){
			$data=get_option("visitor_counter_data");
			$data['admin_input'] = $_POST['admin_input'];
			update_option("visitor_counter_data",$data);
			}

		wp_safe_redirect( add_query_arg( 'updated', 'true', wp_get_referer() ) );
        exit();
	}


	//tạo một menu plugin trong admin menu
	public function create_menu(){
		add_menu_page ( 'Quang Plugin','Quang Plugin','manage_options','quang-counter-plugin',array($this,'view_form_adminpage' ) );
	}

	public function view_form_adminpage(){
		//kiểm tra quyền admin
		if (!current_user_can( 'manage_options' )) {
            wp_die( __('Bạn không có quyền truy cập trang web này.') );
        }
        // lấy data để hiển thị   
        $data = get_option( 'visitor_counter_data' );
        // Lấy file php để hiển thị
        include 'views/viewform_adminpage.php';
	}

	public function view_form_homepage(){
	    // lấy data để hiển thị   
        $data = get_option( 'visitor_counter_data' );
        // Lấy file php để hiển thị
        include 'views/viewform_homepage.php';
	} 

	public function plugin_deactivation_popup(){
		include 'views/viewform_popup_confirm.php';
	}

	public function deactivate_scripts(){
		wp_enqueue_script('deactivate-popup-js', plugin_dir_url( __FILE__ ).'js/deactivate_popup.js', array('jquery'));
		//tạo biến chứa url của admin-ajax để xử lý AJAX request từ Jquery
		$array_ajax = array('ajax_url'=>admin_url('admin-ajax.php'));
		// Gán biến này để sử dụng trong Jquery Script.
		wp_localize_script('deactivate-popup-js','deactivate_popup_js_ajax',$array_ajax);
	}

	public function delete_data_deactivate_popup(){
		//kiểm tra quyền admin
		if (current_user_can( 'manage_options' )){
			delete_option('visitor_counter_data');
			exit();
		}
	} 
}
$my_first_plugin = new count_plugin();	
