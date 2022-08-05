<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
require $_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php';
CModule::IncludeModule('iblock');


//business_partners
if($type == 'technical_partners') { 
	$IBLOCK_ID = 14;
} else $IBLOCK_ID = 15;


$property_enums = CIBlockPropertyEnum::GetList(Array("NAME"=>"ASC", "SORT"=>"ASC", "VALUE"=>"ASC"), Array("IBLOCK_ID"=>$IBLOCK_ID));
while($enum_fields = $property_enums->GetNext())
{
  $arResult['SELECT'][] = $enum_fields;
}

$arFilter = Array("IBLOCK_ID"=>$IBLOCK_ID, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");

if(intval($_REQUEST['region']) > 0)
 $arFilter['PROPERTY_REGION'] = intval($_REQUEST['region']);

$res = CIBlockElement::GetList(Array(), $arFilter, array("PROPERTY_REGION", "PROPERTY_CITY"), false);
while($ob = $res->GetNextElement())
{
 $arFields = $ob->GetFields();

 if(strlen(trim($arFields['PROPERTY_CITY_VALUE'])) > 0)
	$arResult['CITY'][$arFields['PROPERTY_REGION_ENUM_ID']][] = $arFields['PROPERTY_CITY_VALUE'];

	$arResult['CITIES'][] = array(
		'region' => $arFields['PROPERTY_REGION_ENUM_ID'],
		'name' => $arFields['PROPERTY_CITY_VALUE'],
	);

	$cities[$arFields['PROPERTY_CITY_VALUE']] = $arFields['PROPERTY_REGION_ENUM_ID'];
}
ksort($cities);
?>

<i>Регион:</i>
<select name="region" id="region">
	<option value="">Все</option>
	<?foreach($arResult['SELECT'] as $arSelect):?> 
		<option value="<?=$arSelect['ID']?>" <?if ($arSelect['ID'] == $_REQUEST['region']) echo "selected";?> title="" class="bxhtmled-surrogate"><?=$arSelect['VALUE']?></option>
	<?endforeach?>
</select>
<div style="float:right; padding-right:7px;">
<i>Город:</i>
<select name="city" id="city">
	<option value="">Все</option>
	<?/*foreach($arResult['CITY'] as $arRegion=>$arCities):?> 
		<?foreach($arCities as $arCity):?> 
			<option class="region_<?=$arRegion?>" value="<?=$arCity?>" <?if ($arCity == $_REQUEST['city']) echo "selected";?> title="" class="bxhtmled-surrogate"><?=$arCity?></option>
		<?endforeach;?>
	<?endforeach*/?>

	<?foreach($cities as $city => $region):?> 
		<option class="region_<?=$region?>" value="<?=$city?>" <?if ($city == $_REQUEST['city']) echo "selected";?> title="" class="bxhtmled-surrogate"><?=$city?></option>
	<?endforeach?>
</select>
</div>

<script>
	$(function(){
		if ($('#search-form select').length) $('#search-form select').styler();
	});
	
$(function(){
	$("#region").change(function(){
		
		$.post('/partnery/<?=$type?>/', {'ajax':'Y', 'region':$("#region").val(), "city": ""}, function(data){
			$("#partners").html(data);
			if ($('#search-form select').length) $('#search-form select').styler();
			set_tabs();
		});
	});
	$("#city").change(function(){
		
		$.post('/partnery/<?=$type?>/', {'ajax':'Y', 'region':$("#region").val(), "city":$("#city").val()}, function(data){
			$("#partners").html(data);
			if ($('#search-form select').length) $('#search-form select').styler();
			set_tabs();
		});
		
	});		
});	
</script>	
