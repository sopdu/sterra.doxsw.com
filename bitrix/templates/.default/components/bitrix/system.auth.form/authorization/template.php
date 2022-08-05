<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>

<?$this -> setFrameMode(true);?>

<?$frame = $this -> createFrame() -> begin();?>


<div class="login-form right soft-grey">
<?if($arResult["FORM_TYPE"] == "login"):?>

<?
if ($arResult['SHOW_ERRORS'] == 'Y' && $arResult['ERROR'])
	ShowMessage($arResult['ERROR_MESSAGE']);
?>
	<form name="system_auth_form<?=$arResult["RND"]?>" method="POST" action="<?=$arResult["AUTH_URL"]?>">
	<?if($arResult["BACKURL"] <> ''):?>
	<input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
	<?endif?>
	<?foreach ($arResult["POST"] as $key => $value):?>
		<input type="hidden" name="<?=$key?>" value="<?=$value?>" />
	<?endforeach?>
	<input type="hidden" name="AUTH_FORM" value="Y" />
	<input type="hidden" name="TYPE" value="AUTH" />
	
	<p><?=GetMessage('ENTER_IN_PERSONAL_AREA')?></p>
	
		<input type="text" name="USER_LOGIN" size="20" placeholder="Логин"/>
		<input type="password" name="USER_PASSWORD" size="20" placeholder="Пароль"/>
		<input type="submit" value="Войти" class="blue"/>
		<div class="round-button right icon-arrow-next"></div>
	</form>
	<div class="clearfix"></div>
	<a href="<?=$arResult["AUTH_REGISTER_URL"]?>"><?=GetMessage('AUTH_REGISTER')?></a>
	<a href="<?=$arResult["AUTH_FORGOT_PASSWORD_URL"]?>" class="rmmbr"><?=GetMessage('AUTH_FORGOT_PASSWORD_2')?></a>
<?
//if($arResult["FORM_TYPE"] == "login")
else:
?>
<div class="exit_form">	
	<p class="exitedname">Вы вошли как: <br />
		<?=$arResult["USER_NAME"]?><br />
		[<?=$arResult["USER_LOGIN"]?>]
	</p>
	<form action="<?=$arResult["AUTH_URL"]?>">
		<?foreach ($arResult["GET"] as $key => $value):?>
			<input type="hidden" name="<?=$key?>" value="<?=$value?>" />
		<?endforeach?>	
		<input type="hidden" name="logout" value="yes" />
		<input type="submit" name="logout_butt" value="<?=GetMessage("AUTH_LOGOUT_BUTTON")?>" />	

	</form>
</div>	
<?endif?>
</div>
<div class="clearfix"></div>

<?$frame -> end();?>


