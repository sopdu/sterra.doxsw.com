<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>




<?$this -> setFrameMode(true);?>

<?$frame = $this -> createFrame() -> begin();?>

<div class="twelve right article awards">
<?global $arf;if ($arf['PROPERTY_CITY']==41):?>
<h1>Вакансии в Зеленограде</h1>
<br>
<?endif;?>
<?if ($arf['PROPERTY_CITY']==40):?>
<!--<h1>Вакансии в Москве</h1>-->
<br>
<?endif;?>
<div class="twelve">
<ul class="accordeon">
		<?foreach($arResult["ITEMS"] as $arItem):?>
	<li class="accord-list accord-adhoc" style="margin: 0 0 15px 0; padding-bottom: 0px;">
			<?
			$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
			$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
			?>

			<!--<div class="twelve tabs-page sertificates" id="<?=$this->GetEditAreaId($arItem['ID']);?>">	

				<div class="apear left conf-news">-->
					<h3 class=" title faq_title" style="font-size: 16px;"><?=$arItem['NAME']?></h3>
<div class="accord-content">
					<?=$arItem['PREVIEW_TEXT']?>
<!--<style>
.iksweb {
    display: inline-block !important;
    text-decoration: none !important;
    background-color: #262472 !important;
    color: #fff !important;
    border: none; !important;
    border-radius: 50px !important;
    font-size: 16px !important;
    padding: 3px 17px !important; 
    transition: all 0.4s ease !important;
}
.iksweb:hover {
    text-decoration: none !important; 
    background-color: #e42d24 !important;
    color: #fff !important;
}
</style>
<a href="intest.php" class="iksweb">Откликнуться</a> -->

					</div>
				<!--</div>

				<div class="clearfix"></div>
			</div>-->
	</li>
		<?endforeach?>		
	</ul>
		<div class="clearfix"></div>
		<br>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?>
<?endif;?>
</div>	
</div>
							



<?$frame -> end();?>