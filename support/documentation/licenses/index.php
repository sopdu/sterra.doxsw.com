<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Лицензии");
?><div class="support-documentation-page page-main">
	 <?$APPLICATION->IncludeComponent(
	"bitrix:breadcrumb",
	".default",
	Array(
		"PATH" => "",
		"SITE_ID" => SITE_ID,
		"START_FROM" => "1"
	)
);?>
	<div class="container">
		<div class="support-documentation__title">
			 Документация
		</div>
		<div class="support-documentation__banner">
			<div class="support-documentation__banner__image">
 <img src="/local/templates/s-terra22/images/support-main/main.png">
			</div>
			<div class="support-documentation__banner__text">
				<p>
					 У нас есть Портал документации, на&nbsp;котором собраны все документы по&nbsp;средствам защиты информации, в&nbsp;том числе лицензионные соглашения, формуляры ФСБ и&nbsp;ФСТЭК и&nbsp;правила пользования продукцией.
				</p>
 <a class="btn btn-accent" href="/">Перейти на портал</a>
			</div>
		</div>
		<ul class="support-documentation-page__filter" id="nav">
			<li class="support-documentation-page__filter__item"><a class="support-documentation-page__filter__button" type="button" data-type="1" href="/support/documentation/certificates/#nav">Сертификаты на продукцию</a></li>
			<li class="support-documentation-page__filter__item"><a class="support-documentation-page__filter__button active" type="button" data-type="2" href="/support/documentation/licenses/#nav">Лицензии</a></li>
			<li class="support-documentation-page__filter__item"><a class="support-documentation-page__filter__button" type="button" data-type="3" href="/support/documentation/svidetelstva-na-po/#nav">Свидетельства на ПО</a></li>
			<li class="support-documentation-page__filter__item"><a class="support-documentation-page__filter__button" type="button" data-type="4" href="/support/documentation/normativnye-dokumenty/#nav">Нормативные документы</a></li>
		</ul>
		 <?$APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"template4",
	Array(
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
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array("PREVIEW_PICTURE",""),
		"FILTER_NAME" => "",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "22",
		"IBLOCK_TYPE" => "products",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "Y",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "12",
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
		"PROPERTY_CODE" => array("","ACTIV_TO","ACTIV_FROM","CRIPTOGRAFY","TYPE","FILE_FOR_SAVE",""),
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SORT_BY1" => "SORT",
		"SORT_BY2" => "ACTIVE_FROM",
		"SORT_ORDER1" => "ASC",
		"SORT_ORDER2" => "DESC",
		"STRICT_SECTION_CHECK" => "N"
	)
);?>
	</div>
</div>
</div>
 <br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>