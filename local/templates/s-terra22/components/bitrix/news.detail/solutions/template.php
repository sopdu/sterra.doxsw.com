<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
//echo "<pre>"; print_r($arResult); echo "</pre>";

if($arResult["IBLOCK_ID"] == 18) {
	$pageClass = "complex-card-page";
}
else {
	$pageClass = "industry-card-page";
}

$GLOBALS['arVideoFilter'] = ["ID" => $arResult["PROPERTIES"]["VIDEO"]["VALUE"]];
$GLOBALS['arClientsFilter'] = ["ID" => $arResult["PROPERTIES"]["CLIENTS"]["VALUE"]];

?>
<div class="<?=$pageClass?>">
	<main class="complex-card-jumbotron page-main">
		<div class="bg-block">
			<div class="jumbotron">
				<div class="container">
					<div class="complex-card-jumbotron__wrap">
						<div class="complex-card-jumbotron__text">
							<div class="complex-card-jumbotron__text__icon"><img src="<?=$arResult["DISPLAY_PROPERTIES"]["SVG"]["FILE_VALUE"]["SRC"]?>"></div>
							<div class="complex-card-jumbotron__text__icon__mobile"><img src="<?=$arResult["DISPLAY_PROPERTIES"]["SVG_MOB"]["FILE_VALUE"]["SRC"]?>"></div>
							<div class="complex-card-jumbotron__text__content">
								<div class="complex-card-jumbotron__text__title"><?=$arResult["NAME"]?></div>
								<div class="complex-card-jumbotron__text__description"><?=$arResult["PREVIEW_TEXT"]?></div>
								<div class="complex-card-jumbotron__text__buttons btn-dekstop">
									<a href="#form" class="btn btn-accent btn-lg">Оставить заявку</a>

									<a style="<?=$arResult['PROPERTIES']['PRICE_LIST']['VALUE'] ? '' : 'display:none'?>" href="<?=CFile::GetPath($arResult['PROPERTIES']['PRICE_LIST']['VALUE'])?>" class="btn btn-lg btn-white" target="_blank">Прайс-лист</a>
								</div>
							</div>
						</div>
						<div class="complex-card-jumbotron__text__buttons btn-mobile">
							<a href="#form" class="btn btn-accent btn-lg">Заявка</a>
                            <?if($arResult['PROPERTIES']['PRICE_LIST']['VALUE']):?>
							<a href="<?=CFile::GetPath($arResult['PROPERTIES']['PRICE_LIST']['VALUE'])?>" class="btn btn-lg btn-white">Прайс-лист</a>
                            <?endif?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</main>

	<?if(is_array($arResult["PROPERTIES"]["CLIENTS"]["VALUE"]) && count($arResult["PROPERTIES"]["CLIENTS"]["VALUE"])>0) {?>
		<div class="industry-card-clients">
			<?$APPLICATION->IncludeComponent(
				"bitrix:breadcrumb",
				".default",
				Array(
					"START_FROM" => "1",
					"PATH" => "",
					"SITE_ID" => SITE_ID,
				),
				false
			);?>
			<div class="container">
				<div class="industry-card-clients__wrap">
					<div class="industry-card-clients__title">Наши клиенты</div>
					<?$APPLICATION->IncludeComponent(
						"bitrix:news.list",
						"solution_brands",
						array(
							"ACTIVE_DATE_FORMAT" => "d.m.Y",
							"ADD_SECTIONS_CHAIN" => "N",
							"AJAX_MODE" => "N",
							"AJAX_OPTION_ADDITIONAL" => "",
							"AJAX_OPTION_HISTORY" => "N",
							"AJAX_OPTION_JUMP" => "N",
							"AJAX_OPTION_STYLE" => "Y",
							"CACHE_FILTER" => "N",
							"CACHE_GROUPS" => "Y",
							"CACHE_TIME" => "36000000",
							"CACHE_TYPE" => "A",
							"CHECK_DATES" => "Y",
							"DETAIL_URL" => "",
							"DISPLAY_BOTTOM_PAGER" => "N",
							"DISPLAY_DATE" => "N",
							"DISPLAY_NAME" => "N",
							"DISPLAY_PICTURE" => "Y",
							"DISPLAY_PREVIEW_TEXT" => "Y",
							"DISPLAY_TOP_PAGER" => "N",
							"FIELD_CODE" => array(
								0 => "NAME",
								1 => "PREVIEW_PICTURE",
								2 => "DETAIL_PICTURE",
							),
							"FILTER_NAME" => "arClientsFilter",
							"HIDE_LINK_WHEN_NO_DETAIL" => "N",
							"IBLOCK_ID" => "47",
							"IBLOCK_TYPE" => "about",
							"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
							"INCLUDE_SUBSECTIONS" => "Y",
							"MESSAGE_404" => "",
							"NEWS_COUNT" => "20",
							"PAGER_BASE_LINK_ENABLE" => "N",
							"PAGER_DESC_NUMBERING" => "N",
							"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
							"PAGER_SHOW_ALL" => "N",
							"PAGER_SHOW_ALWAYS" => "N",
							"PAGER_TEMPLATE" => ".default",
							"PAGER_TITLE" => "Новости",
							"PARENT_SECTION" => "",
							"PARENT_SECTION_CODE" => "",
							"PREVIEW_TRUNCATE_LEN" => "",
							"PROPERTY_CODE" => array(
								0  => "",
							),
							"SET_BROWSER_TITLE" => "N",
							"SET_LAST_MODIFIED" => "N",
							"SET_META_DESCRIPTION" => "N",
							"SET_META_KEYWORDS" => "N",
							"SET_STATUS_404" => "N",
							"SET_TITLE" => "N",
							"SHOW_404" => "N",
							"SORT_BY1" => "SORT",
							"SORT_BY2" => "ACTIVE_FROM",
							"SORT_ORDER1" => "DESC",
							"SORT_ORDER2" => "DESC",
							"STRICT_SECTION_CHECK" => "N",
							"COMPONENT_TEMPLATE" => "solution_brands"
						),
						false
					);?>
					<div class="industry-card-clients__control js-clients-slider-control-1">
						<button class="btn btn-primary-inverse btn-round" data-controls="prev">
							<svg width="7" height="12">
								<use xlink:href="#i-chevron-left" href="#i-chevron-left"></use>
							</svg>
						</button>
						<button class="btn btn-primary-inverse btn-round" data-controls="next">
							<svg width="7" height="12">
								<use xlink:href="#i-chevron-right" href="#i-chevron-right"></use>
							</svg>
						</button>
					</div>
				</div>
			</div>
		</div>
	<?} else {?>
	<?$APPLICATION->IncludeComponent(
		"bitrix:breadcrumb",
		".default",
		Array(
			"START_FROM" => "1",
			"PATH" => "",
			"SITE_ID" => SITE_ID,
		),
		false
	);?>
	<?}?>
	<?=$arResult["DETAIL_TEXT"]?>

	<section class="home-faq">
		<div class="container">
			<div class="home-faq__accordion">
				<div class="accordion" id="home-faq">
					<? foreach( $arResult["PROPERTIES"]["BLOCKS_NAME"]["VALUE"] as $key => $name ) { ?>
					<section class="home-faq-item accordion-item">
						<header class="home-faq-item__header accordion-item-header accordion-trigger">
							<h2 class="home-faq-item__title"><?=htmlspecialchars_decode($name)?></h2>
							<div class="home-faq-item__state"></div>
						</header>
						<div class="accordion-item-panel">
							<div class="home-faq-item__content">
								<?=htmlspecialchars_decode($arResult["PROPERTIES"]["BLOCKS_CONTENT"]["VALUE"][$key]["TEXT"])?>
							</div>
						</div>
					</section>
					<? } ?>
				</div>
			</div>
		</div>
	</section>
	<div class="industry-card-items">
		<div class="container">
			<div class="industry-card-items__title">Для организации безопасной удаленной работы сотрудников используйте продукты С-Терра:</div>
			<div class="industry-card-items__wrap">
				<div class="industry-card-items-slider js-items-slider-1">
					<? foreach($arResult["PRODUCTS"] as $arItem) {?>
					<div class="industry-card-items__item">
						<div class="industry-card-items__item__wrap">
							<div class="industry-card-items__item__title"><?=$arItem["NAME"]?></div>
							<div class="industry-card-items__item__description"><?=$arItem["UF_SHORT_DESCRIPTION"]?></div>
							<div class="industry-card-items__item__blocks">
								<? if($arItem["UF_DESIGN"][0] != "") {
								    $text = '';
								    $first = true;
								    foreach ($arItem["UF_DESIGN"] as $design){
								        if (!$first) $text.= ', ';
								        else $first = false;
								        $text.= $design;
                                    }
								    ?>
									<div class="industry-card-items__item__block">
										<div class="industry-card-items__item__block__title">Исполнения</div>
										<div class="industry-card-items__item__block__value"><?=$text?></div>
									</div>
								<? } ?>
								<?
                                if ($arItem['UF_CERT_CLASS'][0] || $arItem['UF_CERT_FBI'][0] || $arItem['UF_CERT_OTHER'][0]){
                                        $certClass = $arItem['UF_CERT_CLASS'];
                                        $certFBI = $arItem['UF_CERT_FBI'];
                                        $certOther = $arItem['UF_CERT_OTHER'];

                                        $val = '';
                                        if (count($certFBI)) {
                                            $val .= 'ФСБ: ';
                                            $first = true;
                                            foreach ($certFBI as $cert) {
                                                if (!$first) $val.=', ';
                                                $val .= $cert;
                                                if ($first) $first = false;
                                            }
                                            $val.='<br>';
                                        }
                                        if (count($certClass)) {
                                            $val .= 'ФСТЭК: ';
                                            $first = true;
                                            foreach ($certClass as $cert) {
                                                if (!$first) $val.=', ';
                                                $val .= $cert;
                                                if ($first) $first = false;
                                            }
                                            $val.='<br>';
                                        }
                                        if (count($certOther)) {
                                            $first = true;
                                            foreach ($certOther as $cert) {
                                                if (!$first) $val.=', ';
                                                $val .= $cert;
                                                if ($first) $first = false;
                                            }
                                            $val.='<br>';
                                        }


                                        if ($val){
								    ?>
									<div class="industry-card-items__item__block">
										<div class="industry-card-items__item__block__title">Сертификация</div>
										<div class="industry-card-items__item__block__value"><?=$val?></div>
									</div>
								<? }} ?>
							</div>
							<div class="industry-card-items__item__footer">
								<div class="industry-card-items__item__footer__image"><img src="<?=$arItem["ICON"]?>"></div><a class="btn btn-primary-inverse" href="<?=$arItem["URL"]?>">Подробнее</a>
							</div>
						</div>

					</div>
					<? } ?>
				</div>
				<div class="industry-card-items__control js-items-slider-control-1">
					<button class="btn btn-primary-inverse btn-round" data-controls="prev">
						<svg width="7" height="12">
							<use xlink:href="#i-chevron-left" href="#i-chevron-left"></use>
						</svg>
					</button>
					<button class="btn btn-primary-inverse btn-round" data-controls="next">
						<svg width="7" height="12">
							<use xlink:href="#i-chevron-right" href="#i-chevron-right"></use>
						</svg>
					</button>
				</div>
			</div>
		</div>
	</div>



    <?$APPLICATION->IncludeComponent(
				"bitrix:news.list",
				"video-slider",
				array(
					"ACTIVE_DATE_FORMAT" => "d.m.Y",
					"ADD_SECTIONS_CHAIN" => "N",
					"AJAX_MODE" => "N",
					"AJAX_OPTION_ADDITIONAL" => "",
					"AJAX_OPTION_HISTORY" => "N",
					"AJAX_OPTION_JUMP" => "N",
					"AJAX_OPTION_STYLE" => "Y",
					"CACHE_FILTER" => "N",
					"CACHE_GROUPS" => "Y",
					"CACHE_TIME" => "36000000",
					"CACHE_TYPE" => "A",
					"CHECK_DATES" => "Y",
					"DETAIL_URL" => "",
					"DISPLAY_BOTTOM_PAGER" => "N",
					"DISPLAY_DATE" => "N",
					"DISPLAY_NAME" => "N",
					"DISPLAY_PICTURE" => "Y",
					"DISPLAY_PREVIEW_TEXT" => "Y",
					"DISPLAY_TOP_PAGER" => "N",
					"FIELD_CODE" => array(
						0 => "NAME",
						1 => "PREVIEW_PICTURE",
						2 => "DETAIL_PICTURE",
					),
					"FILTER_NAME" => "arVideoFilter",
					"HIDE_LINK_WHEN_NO_DETAIL" => "N",
					"IBLOCK_ID" => "56",
					"IBLOCK_TYPE" => "support",
					"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
					"INCLUDE_SUBSECTIONS" => "Y",
					"MESSAGE_404" => "",
					"NEWS_COUNT" => "20",
					"PAGER_BASE_LINK_ENABLE" => "N",
					"PAGER_DESC_NUMBERING" => "N",
					"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
					"PAGER_SHOW_ALL" => "N",
					"PAGER_SHOW_ALWAYS" => "N",
					"PAGER_TEMPLATE" => ".default",
					"PAGER_TITLE" => "Новости",
					"PARENT_SECTION" => "",
					"PARENT_SECTION_CODE" => "",
					"PREVIEW_TRUNCATE_LEN" => "",
					"PROPERTY_CODE" => array(
						0  => "HREF",
					),
					"SET_BROWSER_TITLE" => "N",
					"SET_LAST_MODIFIED" => "N",
					"SET_META_DESCRIPTION" => "N",
					"SET_META_KEYWORDS" => "N",
					"SET_STATUS_404" => "N",
					"SET_TITLE" => "N",
					"SHOW_404" => "N",
					"SORT_BY1" => "SORT",
					"SORT_BY2" => "ACTIVE_FROM",
					"SORT_ORDER1" => "DESC",
					"SORT_ORDER2" => "DESC",
					"STRICT_SECTION_CHECK" => "N",
					"COMPONENT_TEMPLATE" => "video-slider"
				),
				false
			);?>

