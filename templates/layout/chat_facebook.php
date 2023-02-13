<?php if($_SESSION['chat_facebook']==1) { ?>
<style>
	div.chat_facebook
	{
		position:fixed;
		right:-110px;
		bottom:-300px;
		width:250px;
		z-index:777777;
	}
	div.tieude_chat
	{
		background: #3B5998;
		color: #fff;
		width: 50%;
		padding: 3px 7px;
		font-size: 15px;
		cursor:pointer;
	}
	@media screen and (max-width: 800px) {
		div.chat_facebook
		{
			position:fixed;
			right:-110px;
			bottom:-300px;
			width:250px;
			z-index:777777;
		}
	}
</style>
<?php }else { ?>
<style>
	div.chat_facebook
	{
		position:fixed;
		right:0;
		bottom:0;
		width:250px;
		z-index:777777;
	}
	div.tieude_chat
	{
		background: #3B5998;
		color: #fff;
		width: 50%;
		padding: 3px 7px;
		font-size: 15px;
		cursor:pointer;
	}
	@media screen and (max-width: 800px) {
		div.chat_facebook
		{
			position:fixed;
			right:-110px;
			bottom:-300px;
			width:250px;
			z-index:777777;
		}
	}
</style>
<?php } ?>
<div class="chat_facebook"><div class="tieude_chat">Facebook chat</div>
	<div class='fb-page chat-item' data-adapt-container-width='true' data-height='300' data-hide-cover='false' data-href='<?=$company['fanpage']?>' data-show-facepile='true' data-show-posts='false' data-small-header='false' data-tabs='messages' data-width='250'></div>
</div>

<script type="text/javascript">
	$(document).ready(function(e) {
        $('.tieude_chat').click(function(){
			if($('.chat_facebook').css('right')=='0px')
			{
				$('.chat_facebook').animate({bottom:-300},500).animate({right:-110},300);
			}
			else
			{
				$('.chat_facebook').animate({right:0},300).animate({bottom:0},500);
			}
			$.ajax({
				url:'ajax/tao_session.php',
				success:function(kq){
					console.log(kq);
				}
			});
		});
    });
</script>

