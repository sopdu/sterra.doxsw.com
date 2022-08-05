<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Работа у нас");
$arFilter = [ "IBLOCK_ID" => 4, "=ACTIVE" => "Y" ];
$count = \Bitrix\Iblock\ElementTable::getCount($arFilter);
?>
	<div class="vacancies-page">
		<main class="page-main">
			<div class="bg-block">
				<div class="vacancies-page__jumbotron"><!-- JUMBOTRON -->
					<div class="jumbotron">
						<div class="container">
							<div class="vacancies-banner">
								<div class="vacancies-banner__content">
									<div class="vacancies-banner__text">Работа у нас</div>
									<div class="vacancies-banner__description">
										<p>Компания С-Терра строит бизнес, в первую очередь, вокруг людей. При найме новых сотрудников мы отдаем предпочтение не столько опытным, сколько способным кандидатам.</p>
										<p>Мы поддерживаем атмосферу открытости  и доброжелательности. У нас каждый сотрудник может свободно высказывать свои мысли и предложения, участвуя в развитии общего дела.</p>
									</div><a class="vacancies-banner__phone-link" href="tel:+7 (499) 940-90-61">+7 (499) 940-90-61</a><a class="vacancies-banner__email-link" href="mailto:hiring@s-terra.ru">hiring@s-terra.ru</a>
								</div>
								<div class="vacancies-banner__img"><img src="<?=SITE_TEMPLATE_PATH?>/images/about/about-work-with-us.png" alt=""></div>
							</div>
						</div>
					</div><!-- /JUMBOTRON -->
				</div>
			</div>
		</main>
		<?$APPLICATION->IncludeComponent("bitrix:breadcrumb", ".default", Array(
				"START_FROM" => "1",
				"PATH" => "",
				"SITE_ID" => SITE_ID,
			),
			false
		);?>
		<div class="vacancies-vacant">
			<div class="container">
				<div class="vacancies-vacant__content vacant" data-full-length="<?=$count?>" data-page-size="6" data-action="/local/ajax/vacancies.php" data-method="GET">
					<?$APPLICATION->IncludeComponent(
						"bitrix:news.list",
						"vacancies",
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
								1 => "DETAIL_PAGE_URL",
							),
							"FILTER_NAME" => "",
							"HIDE_LINK_WHEN_NO_DETAIL" => "N",
							"IBLOCK_TYPE" => "about",
							"IBLOCK_ID" => "4",
							"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
							"INCLUDE_SUBSECTIONS" => "Y",
							"MESSAGE_404" => "",
							"NEWS_COUNT" => "6",
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
								0 => "CITY",
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
							"COMPONENT_TEMPLATE" => "vacancies"
						),
						false
					);?>
					<div class="vacancies-vacant__controll">
						<? if($count>6) { ?>
						<div class="vacancies-vacant__controll__text js-control-text">Показано 6 из <?=$count?></div>
						<button class="js-control-more vacancies-vacant__controll__btn btn btn-primary-inverse">Еще 6</button>
						<? } else { ?><div class="vacancies-vacant__controll__text js-control-text">Показано <?=$count?> из <?=$count?></div><? } ?>
					</div>
				</div>
			</div>
		</div>
		<div class="vacancies-review">
			<div class="vacancies-review__wrap">
				<div class="vacancies-review__title">Отзывы наших сотрудников</div>
				<?$APPLICATION->IncludeComponent(
					"bitrix:news.list",
					"emp_reviews",
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
							0 => "",
							1 => "",
						),
						"FILTER_NAME" => "",
						"HIDE_LINK_WHEN_NO_DETAIL" => "N",
						"IBLOCK_ID" => "50",
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
							0 => "POSITION",
							1 => "",
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
						"COMPONENT_TEMPLATE" => "emp_reviews"
					),
					false
				);?>
			</div>
		</div><!-- Work -->
		<section class="vacancies-work">
			<div class="container">
				<header class="vacancies-work__header">
					<h2 class="h1 vacancies-work__title">Оценка условий труда</h2>
				</header>
			</div>
			<?$APPLICATION->IncludeComponent(
				"bitrix:news.list",
				"job_conditions",
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
						0 => "",
						1 => "",
					),
					"FILTER_NAME" => "",
					"HIDE_LINK_WHEN_NO_DETAIL" => "N",
					"IBLOCK_ID" => "49",
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
						0 => "PDF",
						1 => "",
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
					"COMPONENT_TEMPLATE" => "job_conditions"
				),
				false
			);?>
		</section>
	</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>