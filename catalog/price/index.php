<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Прайс-листы");
//last notification
$listres = CIBlockElement::GetList(
		["ACTIVE_FROM" => "DESC"],
		["IBLOCK_ID" => 36, "=ACTIVE" => "Y"],
		false,
		["nTopCount" => 1],
		["ACTIVE_FROM", "PREVIEW_TEXT"]
);
$arNLastEl = $listres->GetNext();
?>
	<div class="price-page page-main">
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
		<div class="price-main">
			<div class="container">
				<div class="price-main__content__title">Стоимость продукции S-Terra</div>
				<div class="price-main__wrap">
					<div class="price-main__content">
                        <?
                        $APPLICATION->IncludeComponent(
                        	"bitrix:main.include",
                        	"",
                        	Array(
                        		"AREA_FILE_SHOW" => "file",
                        		"AREA_FILE_SUFFIX" => "inc",
                        		"EDIT_TEMPLATE" => "",
                        		"PATH" => "/local/include/price/priceText.php"
                        	)
                        );
                        ?>
					</div>
					<div class="price-main__notification">
						<div class="price-main__notification__wrap">
							<div class="price-main__notification__subtitle">Объявление</div>
							<div class="price-main__notification__date"><?=$arNLastEl["ACTIVE_FROM"]?> г.</div>
							<?=$arNLastEl["PREVIEW_TEXT"]?>
						</div>
					</div>
				</div>
			</div>
		</div>
        <?$APPLICATION->IncludeComponent(
            "bitrix:news.list",
            "prices",
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
                "FILTER_NAME" => "",
                "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                "IBLOCK_ID" => "55",
                "IBLOCK_TYPE" => "products",
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
                    0  => "FILE",
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
                "COMPONENT_TEMPLATE" => "prices"
            ),
            false
        );?>
		<div class="price-structure">
			<div class="container">
				<div class="price-structure__title">Структура прайс-листа</div>
				<div class="price-structure-table">
					<?$APPLICATION->IncludeComponent(
						"bitrix:main.include",
						"",
						Array(
							"AREA_FILE_SHOW" => "file",
							"AREA_FILE_SUFFIX" => "inc",
							"EDIT_TEMPLATE" => "",
							"PATH" => "/local/include/price/table.php"
						)
					);?>
				</div>
				<div class="price-structure__text">
					<?
                    $APPLICATION->IncludeComponent(
                    	"bitrix:main.include",
                    	"",
                    	Array(
                    		"AREA_FILE_SHOW" => "file",
                    		"AREA_FILE_SUFFIX" => "inc",
                    		"EDIT_TEMPLATE" => "",
                    		"PATH" => "/local/include/price/bottomText.php"
                    	)
                    );
                    ?>
				</div>
			</div>
		</div>
	</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>