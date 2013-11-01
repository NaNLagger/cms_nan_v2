<p class="titleleft"><b>Авторизация</b></p>
<div class="mod">
<?php 
if($user->Check()) 
	$user->Privetstvie(); 
else 
{ 
	$user->FormLogin();
}
?>
</div>