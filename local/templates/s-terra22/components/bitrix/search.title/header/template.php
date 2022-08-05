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
$this->setFrameMode(true);?>
<?
$INPUT_ID = trim($arParams["~INPUT_ID"]);
if(strlen($INPUT_ID) <= 0)
	$INPUT_ID = "title-search-input";
$INPUT_ID = CUtil::JSEscape($INPUT_ID);

$CONTAINER_ID = trim($arParams["~CONTAINER_ID"]);
if(strlen($CONTAINER_ID) <= 0)
	$CONTAINER_ID = "title-search";
$CONTAINER_ID = CUtil::JSEscape($CONTAINER_ID);

if($arParams["SHOW_INPUT"] !== "N"):?>
	<div class="header-search__search" id="<?echo $CONTAINER_ID?>"><!-- SEARCH FORM -->
		<form class="search" data-search action="<?echo $arResult["FORM_ACTION"]?>" method="GET">
			<div class="search-field">
				<div class="search-field__icon">
					<svg width="14" height="14">
						<use xlink:href="#i-search" href="#i-search"></use>
					</svg>
				</div>
				<input class="form-control" id="<?echo $INPUT_ID?>" value="" placeholder="Поиск" name="q" data-field autocomplete="off">
				<button class="icon-btn search-field__reset" type="button" data-reset>
					<svg width="10" height="10">
						<use xlink:href="#i-times-bold" href="#i-times-bold"></use>
					</svg>
				</button>
			</div>
			<ul class="search-list" data-list hidden></ul>
		</form><!-- /SEARCH FORM -->
	</div>
<?endif?>
<script>
	BX.ready(function(){
		new JCTitleSearch({
			'AJAX_PAGE' : '<?echo CUtil::JSEscape(POST_FORM_ACTION_URI)?>',
			'CONTAINER_ID': '<?echo $CONTAINER_ID?>',
			'INPUT_ID': '<?echo $INPUT_ID?>',
			'MIN_QUERY_LEN': 2
		});
	});
</script>
