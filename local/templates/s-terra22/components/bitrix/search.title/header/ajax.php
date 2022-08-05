<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
// echo "<pre>"; print_r($arResult); echo "</pre>";
if(!empty($arResult["CATEGORIES"]) && $arResult['CATEGORIES_ITEMS_EXISTS']):?>
	<ul class="search-list" data-list>
	<?foreach($arResult["CATEGORIES"] as $category_id => $arCategory):?>
		<?foreach($arCategory["ITEMS"] as $i => $arItem):?>
			<div><a href="<?echo $arItem["URL"]?>"><?echo $arItem["NAME"]?></a></div>
		<?endforeach;?>
	<?endforeach;?>
	</ul>
<?endif;
?>