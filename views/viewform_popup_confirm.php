<div id = "popup">
	<form id="popup_form" method="POST">
	<p class ="question">Bạn có muốn xóa toàn bộ dữ liệu?</p>
	<input type="hidden" value="delete_data">
	<input type="button" id = "yes" value="Có" name="yes">
	<input type="button" id = "no" value="Không" name="no">
	</form> 
</div>

<style type="text/css">
	*
	{
		padding: 0;
		margin: 0;
	}

	#popup
	{
		display: none;
		position: fixed;
		z-index: 9999;
		width: 100%;
		height: 100%;
		text-align: center;
		font-size: 14px;
		top: 0;
		left: 0;
		background: rgba(0,0,0,0.8);
	}

	#popup_form
	{
		border: 1px solid green;
		width: 300px;
		height: 100px;
		position:absolute;
		top: 50%;
		left:50%;
		transform: translate(-50%,-50%);
		background-color: white;
		margin: auto;
	}
	.question
	{
		font-size:18px;
	}
	
	#yes, #no
	{
		font-size:15px;
		margin : 5px;
		width:100px;
		position:relative;
	}

</style>



