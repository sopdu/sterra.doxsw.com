<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("О компании");
//LocalRedirect("/company/about/");
?>
<div class="about-page">
    <main class="page-main">
        <div class="bg-block">
            <div class="about-page__jumbotron"><!-- JUMBOTRON -->
                <div class="jumbotron">
                    <div class="container">
                        <div class="home-banner">
                            <div class="home-banner__content">
                                <div class="home-banner__text">О компании</div>
                                <div class="home-banner__description">«С-Терра СиЭсПи» — российский разработчик и производитель средств сетевой информационной безопасности. Наша цель — обеспечить российский рынок современными решениями для построения VPN.</div><a class="btn btn-accent" href="/upload/iblock/877/Sterra_Presentation_25-01-2022.pdf" download>
                                    <svg class="btn-icon">
                                        <use href="<?=SITE_TEMPLATE_PATH?>/images/icons/icon-sprite.svg#download-arrow"></use>
                                    </svg><span>Презентация о компании</span></a>
                            </div>
                            <div class="home-banner__img"><img src="<?=SITE_TEMPLATE_PATH?>/images/icons/about-banner.png" alt=""></div>
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
<div class="superior">
    <?$APPLICATION->IncludeComponent(
        "bitrix:news.list",
        "superior",
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
                1 => "",
            ),
            "FILTER_NAME" => "",
            "HIDE_LINK_WHEN_NO_DETAIL" => "N",
            "IBLOCK_TYPE" => "about",
            "IBLOCK_ID" => "51",
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
                0 => "",
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
            "SORT_ORDER1" => "ASC",
            "SORT_ORDER2" => "DESC",
            "STRICT_SECTION_CHECK" => "N",
            "COMPONENT_TEMPLATE" => "superior"
        ),
        false
    );?>
</div>
    <div class="company-mission">
        <div class="container">
            <div class="company-mission__block">
                <div class="company-mission__title">
                    <?
                    $APPLICATION->IncludeComponent(
                    	"bitrix:main.include",
                    	"",
                    	Array(
                    		"AREA_FILE_SHOW" => "file",
                    		"AREA_FILE_SUFFIX" => "inc",
                    		"EDIT_TEMPLATE" => "",
                    		"PATH" => "/local/include/about/mission-header.php"
                    	)
                    );?>
                </div>
                <div class="company-mission__description">
                    <?
                    $APPLICATION->IncludeComponent(
                    	"bitrix:main.include",
                    	"",
                    	Array(
                    		"AREA_FILE_SHOW" => "file",
                    		"AREA_FILE_SUFFIX" => "inc",
                    		"EDIT_TEMPLATE" => "",
                    		"PATH" => "/local/include/about/mission-text.php"
                    	)
                    );
                    ?>
                </div>
                <div class="company-mission-wrap">
                    <div class="company-mission__img"><img src="<?=SITE_TEMPLATE_PATH?>/images/about/about-image.png" alt=""></div>
                    <div class="company-mission-content">
                        <div class="company-mission-content__title">
                            <?$APPLICATION->IncludeComponent(
                            	"bitrix:main.include",
                            	"",
                            	Array(
                            		"AREA_FILE_SHOW" => "file",
                            		"AREA_FILE_SUFFIX" => "inc",
                            		"EDIT_TEMPLATE" => "",
                            		"PATH" => "/local/include/about/purpose-header.php"
                            	)
                            );?>
                        </div>
                        <?$APPLICATION->IncludeComponent(
                        	"bitrix:main.include",
                        	"",
                        	Array(
                        		"AREA_FILE_SHOW" => "file",
                        		"AREA_FILE_SUFFIX" => "inc",
                        		"EDIT_TEMPLATE" => "",
                        		"PATH" => "/local/include/about/purpose-text.php"
                        	)
                        );?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="about-history">
        <div class="about-history__wrap">
            <div class="about-history__title">История</div>
            <?$APPLICATION->IncludeComponent(
                "bitrix:news.list",
                "history",
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
                        1 => "",
                    ),
                    "FILTER_NAME" => "",
                    "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                    "IBLOCK_TYPE" => "about",
                    "IBLOCK_ID" => "52",
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
                        0 => "",
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
                    "SORT_ORDER1" => "ASC",
                    "SORT_ORDER2" => "DESC",
                    "STRICT_SECTION_CHECK" => "N",
                    "COMPONENT_TEMPLATE" => "history"
                ),
                false
            );?>
        </div>
    </div>
    <section class="about-team">
        <div class="container tab">
            <header class="about-team__header">
                <h2 class="h1 about-team__title">Наша команда</h2>
                <ul class="tab-head">
                    <li class="tab-head__item" data-type="lead">
                        <button class="tab-head__button active" type="button">Руководство</button>
                    </li>
                    <li class="tab-head__item" data-type="all">
                        <button class="tab-head__button" type="button">Все</button>
                    </li>
                </ul>
            </header>
            <div class="tab-body">
                <div class="tab-body__item active" data-type="lead">
                    <?$APPLICATION->IncludeComponent(
                        "bitrix:news.list",
                        "administration",
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
                                1 => "",
                            ),
                            "FILTER_NAME" => "",
                            "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                            "IBLOCK_TYPE" => "about",
                            "IBLOCK_ID" => "53",
                            "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                            "INCLUDE_SUBSECTIONS" => "Y",
                            "MESSAGE_404" => "",
                            "NEWS_COUNT" => "50",
                            "PAGER_BASE_LINK_ENABLE" => "N",
                            "PAGER_DESC_NUMBERING" => "N",
                            "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                            "PAGER_SHOW_ALL" => "N",
                            "PAGER_SHOW_ALWAYS" => "N",
                            "PAGER_TEMPLATE" => ".default",
                            "PAGER_TITLE" => "Новости",
                            "PARENT_SECTION" => "170",
                            "PARENT_SECTION_CODE" => "",
                            "PREVIEW_TRUNCATE_LEN" => "",
                            "PROPERTY_CODE" => array(
                                0 => "POSITION",
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
                            "SORT_ORDER1" => "ASC",
                            "SORT_ORDER2" => "DESC",
                            "STRICT_SECTION_CHECK" => "N",
                            "COMPONENT_TEMPLATE" => "administration"
                        ),
                        false
                    );?>
                </div>
                <?$APPLICATION->IncludeComponent(
                    "bitrix:news.list",
                    "stuff",
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
                            1 => "DETAIL_PICTURE",
                        ),
                        "FILTER_NAME" => "",
                        "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                        "IBLOCK_TYPE" => "about",
                        "IBLOCK_ID" => "53",
                        "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                        "INCLUDE_SUBSECTIONS" => "Y",
                        "MESSAGE_404" => "",
                        "NEWS_COUNT" => "50",
                        "PAGER_BASE_LINK_ENABLE" => "N",
                        "PAGER_DESC_NUMBERING" => "N",
                        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                        "PAGER_SHOW_ALL" => "N",
                        "PAGER_SHOW_ALWAYS" => "N",
                        "PAGER_TEMPLATE" => ".default",
                        "PAGER_TITLE" => "Новости",
                        "PARENT_SECTION" => "171",
                        "PARENT_SECTION_CODE" => "",
                        "PREVIEW_TRUNCATE_LEN" => "",
                        "PROPERTY_CODE" => array(
                            0 => "POSITION",
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
                        "SORT_ORDER1" => "ASC",
                        "SORT_ORDER2" => "DESC",
                        "STRICT_SECTION_CHECK" => "N",
                        "COMPONENT_TEMPLATE" => "stuff"
                    ),
                    false
                );?>
            </div>
        </div>
    </section>
    <div class="about-work">
        <div class="container">
            <div class="about-work__block">
                <div class="about-work__title">
                    <?$APPLICATION->IncludeComponent(
                    	"bitrix:main.include",
                    	"",
                    	Array(
                    		"AREA_FILE_SHOW" => "file",
                    		"AREA_FILE_SUFFIX" => "inc",
                    		"EDIT_TEMPLATE" => "",
                    		"PATH" => "/local/include/about/work-header.php"
                    	)
                    );?>
                </div>
                <div class="about-work__content">
                    <div class="about-work__text">
                        <?$APPLICATION->IncludeComponent(
                        	"bitrix:main.include",
                        	"",
                        	Array(
                        		"AREA_FILE_SHOW" => "file",
                        		"AREA_FILE_SUFFIX" => "inc",
                        		"EDIT_TEMPLATE" => "",
                        		"PATH" => "/local/include/about/work-text.php"
                        	)
                        );?>
                    </div>
                    <div class="about-work__image"><img src="<?=SITE_TEMPLATE_PATH?>/images/about/about-work-with-us.png" alt=""></div>
                </div>
            </div>
        </div>
    </div>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>