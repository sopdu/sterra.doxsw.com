<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);




$strSectionEdit = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_EDIT");
$strSectionDelete = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_DELETE");
$arSectionDeleteParams = array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM'));
?>
<div class="section">

<script>
	function reloadSelectors() {
		var $certs = jQuery('.versions:visible').find('.cert-item');
		var cryptTypes = [];
		var certNames = [];
		$certs.each(function(index, value) {
			certName = jQuery(value).find('.cert-name').attr('data-product-names');
			if (typeof certName != 'undefined') {
				certNameAr = certName.split('|');
				jQuery(certNameAr).each(function(index, value) {
					if (certNames.indexOf(value) < 0) {
						certNames.push(value);
					}
				});
			}
			cryptType = jQuery(value).find('.crypt-type').attr('data-crypt-type');
			if (typeof cryptType != 'undefined') {
				
				cryptTypeAr = cryptType.split(',');
				jQuery(cryptTypeAr).each(function(index, value) {
					if (cryptTypes.indexOf(value) < 0) {
						cryptTypes.push(value);
					}
				});
			}
		});

		$certNameSelect = jQuery("#certNameSelect");
		$cryptTypeSelect = jQuery("#cryptTypeSelect");

		$certNameSelect.find("option").remove();
		$certNameSelect.append('<option value="">Все</option>');
		jQuery.each(certNames, function(key, value) {
			$certNameSelect
				.append($("<option></option>")
				.attr("value",value)
				.text(value));
		});
		$cryptTypeSelect.find("option").remove();
		$cryptTypeSelect.append('<option value="">Все</option>');
		jQuery.each(cryptTypes, function(key, value) {
			$cryptTypeSelect
				.append($("<option></option>")
				.attr("value",value)
				.text(value));
		});
		jQuery('#certNameSelect').trigger('refresh');
		jQuery('#cryptTypeSelect').trigger('refresh');
	}

	jQuery(document).ready(function() {
		// jQuery("#certNameSelect").styler('destroy');
		// jQuery("#cryptTypeSelect").styler('destroy');

		reloadSelectors();

		jQuery('.tab a').on('click', function() {
			reloadSelectors();
		})

		jQuery('#certNameSelect, #cryptTypeSelect').on('change', function() {
			jQuery('.versions:visible .codabra-cert-type').show();

			certName = jQuery('#certNameSelect').val();
			cryptType = jQuery('#cryptTypeSelect').val();

			if (certName.length>0 || cryptType.length>0) {
				$tab = jQuery('.versions:visible');
				$tab.find('.cert-item').hide();
				$tab.find('.cert-item').each(function(index, value) {
					tmpCertName = jQuery(value).find('.cert-name').attr('data-product-names');
					if (typeof tmpCertName != 'undefined') {
						tmpCertNameAr = tmpCertName.split('|');
					} else {
						tmpCertNameAr = [];
					}

					tmpCryptType = jQuery(value).find('.crypt-type').attr('data-crypt-type');
					if (typeof tmpCryptType != 'undefined') {
						tmpCryptTypeAr = tmpCryptType.split(',');
					} else {
						tmpCryptTypeAr = [];
					}

					if (certName.length>0 && cryptType.length>0) {
						if (tmpCertNameAr.indexOf(certName)>=0 && tmpCryptTypeAr.indexOf(cryptType)>=0) {
							jQuery(value).show();
						}
					}

					if (certName.length>0 && cryptType.length==0) {
						if (tmpCertNameAr.indexOf(certName)>=0) {
							jQuery(value).show();
						}
					}

					if (certName.length==0 && cryptType.length>0) {
						if (tmpCryptTypeAr.indexOf(cryptType)>=0) {
							jQuery(value).show();
						}
					}
				});
			} else {
				jQuery('.versions:visible').find('.cert-item').show();
			}

			jQuery('.versions:visible .codabra-cert-type-wrapper').each(function(index,value) {
				if (jQuery(value).find('.cert-item:visible').length==0) {
					jQuery(value).find('.codabra-cert-type').hide();
				}
			});

			return false;
		});
	});
</script>

<div class="section awards">
<br>
	<div class="twelve soft-blue doc-search">
		<form id="search-form">
			<i>Продукт:</i>
			<select name="certName" id="certNameSelect">
			</select>
			<div style="float:right; padding-right:7px;">
			<i>Криптография:</i>
			<select name="cryptType" id="cryptTypeSelect">
			</select>
			</div>
		</form>
	</div>
</div>
<br><br>
<?
if (0 < $arResult["SECTIONS_COUNT"])
{
	?><ul class="tabs"><?	
			$i=1;
			foreach ($arResult['SECTIONS'] as &$arSection)
			{
				$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionEdit);
				$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);?>
				
				<li class="<?if($i==1):?>current<?endif;?> tab"><a href="#tab<?=$i;?>"><b><?=$arSection["NAME"]?></b></a></li>
				<? $i++;
			}?>
			</ul><?$i=1;
			foreach ($arResult['SECTIONS'] as &$arSection)
			{?>
				<div class="box versions <?if($i==1):?>visible<?endif;?>">
					<?$APPLICATION->IncludeComponent(
	"bitrix:catalog.section", 
	"sertificate_list", 
	array(
		"COMPONENT_TEMPLATE" => "sertificate_list",
		"IBLOCK_TYPE" => "products",
		"IBLOCK_ID" => "41",
		"SECTION_ID" => $arSection["ID"],
		"SECTION_CODE" => "",
		"SECTION_USER_FIELDS" => array(
			0 => "",
			1 => "",
		),
		"ELEMENT_SORT_FIELD" => "sort",
		"ELEMENT_SORT_ORDER" => "asc",
		"ELEMENT_SORT_FIELD2" => "id",
		"ELEMENT_SORT_ORDER2" => "desc",
		"FILTER_NAME" => "arrFilter",
		"INCLUDE_SUBSECTIONS" => "Y",
		"SHOW_ALL_WO_SECTION" => "N",
		"PAGE_ELEMENT_COUNT" => "999",
		"LINE_ELEMENT_COUNT" => "3",
		"PROPERTY_CODE" => array(
			0 => "ACTIV_TO",
			1 => "PRODUCT",
			2 => "TYPE",
			3 => "PRODUCT.NAME",
			4 => "",
		),
		"OFFERS_LIMIT" => "5",
		"TEMPLATE_THEME" => "blue",
		"MESS_BTN_BUY" => "Купить",
		"MESS_BTN_ADD_TO_BASKET" => "В корзину",
		"MESS_BTN_SUBSCRIBE" => "Подписаться",
		"MESS_BTN_DETAIL" => "Подробнее",
		"MESS_NOT_AVAILABLE" => "Нет в наличии",
		"SECTION_URL" => "",
		"DETAIL_URL" => "",
		"SECTION_ID_VARIABLE" => "SECTION_ID",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_GROUPS" => "Y",
		"SET_TITLE" => "N",
		"SET_BROWSER_TITLE" => "N",
		"BROWSER_TITLE" => "-",
		"SET_META_KEYWORDS" => "Y",
		"META_KEYWORDS" => "-",
		"SET_META_DESCRIPTION" => "Y",
		"META_DESCRIPTION" => "-",
		"ADD_SECTIONS_CHAIN" => "N",
		"SET_STATUS_404" => "N",
		"CACHE_FILTER" => "N",
		"ACTION_VARIABLE" => "action",
		"PRODUCT_ID_VARIABLE" => "id",
		"PRICE_CODE" => array(
		),
		"USE_PRICE_COUNT" => "N",
		"SHOW_PRICE_COUNT" => "1",
		"PRICE_VAT_INCLUDE" => "Y",
		"BASKET_URL" => "/personal/basket.php",
		"USE_PRODUCT_QUANTITY" => "N",
		"PRODUCT_QUANTITY_VARIABLE" => "",
		"ADD_PROPERTIES_TO_BASKET" => "Y",
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"PARTIAL_PRODUCT_PROPERTIES" => "N",
		"PRODUCT_PROPERTIES" => array(
		),
		"DISPLAY_COMPARE" => "N",
		"PAGER_TEMPLATE" => $i==1?"publication":"blag",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"PAGER_TITLE" => "Сертификат",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "Y",
		"MESS_BTN_COMPARE" => "Сравнить",
		"ADD_PICT_PROP" => "-",
		"LABEL_PROP" => "-",
		"BACKGROUND_IMAGE" => "-",
		"SEF_MODE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"USE_MAIN_ELEMENT_SECTION" => "N",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"SHOW_404" => "N",
		"MESSAGE_404" => "",
		"DISABLE_INIT_JS_IN_COMPONENT" => "N"
	),
	false
);?>
				</div>
				<? $i++;
			}?>
		
<?}?>

</div>