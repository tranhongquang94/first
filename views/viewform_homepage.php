<div class="counter_text">
	<p class="count_viewers">Số người truy cập trang: <?php echo $data['count'];?>&nbsp<?php echo($data['count']>1 ? "views." :"view.");?></p>
	<?php if ($data['time']) :?>
	<p class="count_viewers">Lần cuối truy cập: <em><?php echo $data['time'];?>.</em></p>
<?php endif; ?>
	<?php if ($data['count']):?>
	<p class ="count_viewers"><?php echo ($data['admin_input'] ? $data['admin_input']:"Chào mừng");?>&nbspthành viên thứ <?php echo ($data["count"] ? $data["count"] : " ");?>&nbspđến với trang web.</p>
<?php endif; ?>
</div>


