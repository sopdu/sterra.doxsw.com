<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="twelve right article">
	<h1><?=$arResult['NAME']?></h1>
	<div class="clearfix"></div>
	<br />

	<div class="banner twelve" style="background-size: contain; text-align: left; background-repeat: no-repeat; ">
		<img src="<?=$arResult['DETAIL_PICTURE']['SRC']?>" alt="" >
	</div>
	<br />
	<?=$arResult['DESCRIPTION']?>
</div>
