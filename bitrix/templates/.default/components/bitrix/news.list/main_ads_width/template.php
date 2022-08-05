<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?><?$this -> setFrameMode(true);?>

<?$frame = $this -> createFrame() -> begin();?>

<div class="content two_third" style="float:left;">
	<div class="title_two_third soft-blue">
		<h3><?=GetMessage('ADS')?></h3>
		<a href="/company/ads/" class="width-button right blue"><?=GetMessage('ALL_ADS')?><div class="round-button right icon-arrow-next"></div></a>
	</div>	
	<section class="news-block">
	<?foreach($arResult["ITEMS"] as $arItem):?>

<? $link = 0;?>
<? $prop = 0;?>
<?if ($arItem['PROPERTIES']['LINK_PROP']['VALUE'] == "Нет ссылки"):?>
<? $link = 0; ?><? $prop = 0;?>
<?endif?>
<?if ($arItem['PROPERTIES']['LINK_PROP']['VALUE'] == "Детальное описание"):?>
<? $link = $arItem['DETAIL_PAGE_URL'];?><? $prop = 1;?>
<?endif?>
<?if ($arItem['PROPERTIES']['LINK_PROP']['VALUE'] == "Внешняя ссылка"):?>
<? $link = $arItem['PROPERTIES']['ADS_LINK']['VALUE'];?><? $prop = 1;?>
<?endif?>

		<?
		$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
		?>	
		<div>

<?if($prop == 1):?>
<a href="<? echo $link; ?>" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
<?else:?>

<?endif;?>

<div class="ads one_third">
				<div class="ads-text">
					<h3><?=$arItem['NAME']?></h3>
					<p><?=$arItem['PREVIEW_TEXT']?></p>
				<?if($prop == 1):?>
					<p style="font-size: 12px; color: #262472; text-decoration: underline;" href="<? echo $link; ?>" id="<?=$this->GetEditAreaId($arItem['ID']);?>">подробнее...</p>
				<?else:?> <?endif;?>

				</div>
			</div>
		<?if($prop == 1):?></a><?else:?> <?endif;?>
	</div>		
	<?endforeach;?>		
	</section>				
</div>
<?$frame -> end();?>