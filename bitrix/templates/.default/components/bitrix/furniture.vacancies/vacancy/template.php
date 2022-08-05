<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="twelve right article awards">
<h1>Вакансии</h1>
<div class="twelve">
<?
foreach ($arResult['ITEMS'] as $key=>$val):
?>
<?
	$this->AddEditAction($val['ID'],$val['EDIT_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($val['ID'],$val['DELETE_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('FAQ_DELETE_CONFIRM', array("#ELEMENT#" => CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_NAME")))));
?>
<?
	if ($key > 0):
?>
<div class="hr"></div>
<?
	endif;
?>
<div id="<?=$this->GetEditAreaId($val['ID']);?>">
<a name="<?=$val["ID"]?>"></a>
<h3><?=$val['NAME']?></h3>
<p>
	<?=$val['PREVIEW_TEXT']?>
	<?=$val['DETAIL_TEXT']?>
</p><p>
	<a href="#top"><?=GetMessage("SUPPORT_FAQ_GO_UP")?></a>
</p>
</div>
<div class="twelve tabs-page sertificates" id="<?=$this->GetEditAreaId($arItem['ID']);?>">				
	<div class="images left">
	<?if(!empty($arItem['PREVIEW_PICTURE'])):?>
		<img src="<?=$arItem['PREVIEW_PICTURE']['src']?>" alt="<?=$arItem['NAME']?>"/>
	<?endif?>
	</div>
	<div class="apear left">
		<a href="<?=$arItem['DETAIL_PAGE_URL']?>"><?=$arItem['NAME']?></a><br />
		<b><?=$arItem['PREVIEW_TEXT']?></b>
	</div>
	<div class="clearfix"></div>
</div>
<?endforeach;?>
</div>
</div>