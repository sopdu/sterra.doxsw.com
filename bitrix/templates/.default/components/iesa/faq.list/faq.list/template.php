<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<div class="twelve right">
		<h1><?=$APPLICATION->GetTitle();?></h1>
<div class="otstup"><?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	Array(
	)
);?></div>
		<div class="clearfix"></div>
		
		<ul class="accordeon faq">
			<?foreach($arResult['ITEMS'] as $arItem):?>
			<li class='accord-list'>
				<h3 class="title faq_title">
					<?=$arItem['PREVIEW_TEXT']?>
				</h3>
				<div class="accord-content">
					<?=$arItem['DETAIL_TEXT']?>
				</div>
			</li>
			<?endforeach?>	
		</ul>
		<div class="clearfix"></div>
		<br />
	</div>
