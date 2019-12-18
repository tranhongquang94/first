<div class="counter_text">
	<p class="count_viewers">Số người truy cập trang: <?php echo $data['count'];?>&nbsp<?php echo($data['count']>1 ? "views." :"view.");?></p>
	<?php if ($data['time']) :?>
	<p class="count_viewers">Lần cuối truy cập: <em><?php echo $data['time'];?></em></p>
	<?php endif; ?>
</div>

<div class="counter_submit">
	<form method="post" action="<?php echo admin_url( 'admin.php' ); ?>" id="count_req">
		<input type="hidden" name="action" value="count_plugin_request" />
	<!-- Tạo 3 input với type Submit để nhận dữ liệu POST vào xử lý tại admin.php -->
		 <input type="submit" class="counter_action" name = "reset" value="Reset bộ đếm" ><br>
	Input:<input id="textinput" type="text" name="admin_input" value ="<?php echo $data['admin_input'];?>"><br>
		 <input type="submit" value="Submit">
	</form>
</div> 


<style type="text/css">
	#textinput{
		margin:10px;
	}

