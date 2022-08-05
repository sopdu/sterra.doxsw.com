<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Поддержка");
?> <div class="support-main-page page-main"><!-- JUMBOTRON -->
    <div class="jumbotron">
        <div class="container">
            <div class="home-banner">
                <div class="home-banner__content">
                    <div class="home-banner__text">Поддержка</div>
                    <div class="home-banner__description">
                        <?
                        $APPLICATION->IncludeComponent(
                            "bitrix:main.include",
                            "",
                            Array(
                                "AREA_FILE_SHOW" => "file",
                                "AREA_FILE_SUFFIX" => "inc",
                                "EDIT_TEMPLATE" => "",
                                "PATH" => "/local/include/support/support-slider-info.php"
                            )
                        );?>
                    </div>
                   <div class="home-banner-buttons">
                       <!--<a class="btn btn-accent" href="https://www.s-terra.ru/auth/">
                            <svg class="btn-icon desktop">
                                <use href="/local/templates/s-terra22/images/icons/icon-sprite.svg#user"></use>
                            </svg>
                            <svg class="btn-icon mobile" style="fill: #7470E0;">
                                <use href="/local/templates/s-terra22/images/icons/icon-sprite.svg#user-mobile"></use>
                            </svg><span>Войти в личный кабинет</span></a>-->
                       <a class="btn btn-white" data-course-modal>
                           <span class="desktop">Написать в техподдержку</span><span class="mobile">Написать в поддержку</span>
                       </a>
                   </div>
                </div>
                <div class="home-banner__img"><img src="/local/templates/s-terra22/images/support-main/main.png" alt=""></div>
            </div>
        </div>
    </div><!-- /JUMBOTRON -->
    <?$APPLICATION->IncludeComponent("bitrix:breadcrumb", ".default", Array(
        "START_FROM" => "1",
        "PATH" => "",
        "SITE_ID" => SITE_ID,
    ),
        false
    );?>


    <div class="support-main-cards">
        <div class="container">
            <div class="support-main-cards-title">Виды техподдержки</div>

            <div class="support-block">
                <div class="support-headers">
                    <div class="support-header empty"></div>
                    <div data-target=".garant" class="support-header active">
                        <div class="support-main-card-title">Гарантийная</div>
                    </div>
                    <div data-target=".standart" class="support-header support-main-card-2">
                        <div class="support-main-card-title">Стандартная</div>
                    </div>
                    <div data-target=".advanced" class="support-header support-main-card-3">
                        <div class="support-main-card-title">Расширенная</div>
                    </div>
                    <div data-target=".premium" class="support-header support-main-card-4">
                        <div class="support-main-card-title">Премиальная</div>
                    </div>
                </div>
                <div class="accordion home-faq" id="home-faq-2">
                    <?
                    $sections = Array();
                    $sectionIDs = Array();
                    $sectionsDB = CIBlockSection::GetList(
                        Array('SORT' => 'ASC'),
                        Array('ACTIVE' => 'Y', 'IBLOCK_ID' => 62)
                    );
                    while ($section = $sectionsDB->Fetch()){
                        $sectionIDs[] = $section['ID'];
                        $sections[] = $section;
                    }

                    $elemsBySection = Array();
                    $elemsDB = CIBlockElement::GetList(
                        Array('IBLOCK_SECTION_ID' => 'ASC', 'SORT' => 'ASC'),
                        Array('ACTIVE' => 'Y', 'IBLOCK_ID' => 62, 'SECTION_ID' => $sectionIDs),
                        false,
                        false,
                        Array('IBLOCK_SECTION_ID', 'ID', 'NAME', 'PROPERTY_GARANT', 'PROPERTY_STANDART', 'PROPERTY_ADVANCED', 'PROPERTY_PREMIUM', 'PROPERTY_GARANT_CHECK', 'PROPERTY_STANDART_CHECK', 'PROPERTY_ADVANCED_CHECK', 'PROPERTY_PREMIUM_CHECK')
                    );
                    while ($elem = $elemsDB->Fetch()) {
                        if (!isset($elemsBySection[$elem['IBLOCK_SECTION_ID']]));
                        $elemsBySection[$elem['IBLOCK_SECTION_ID']][] = $elem;
                    }
                    ?>
                    <?foreach ($sections as $section):?>
                        <section class="home-faq-item accordion-item">
                            <header class="home-faq-item__header accordion-item-header accordion-trigger">
                                <h3 class="home-faq-item__title"><?=$section['NAME']?></h3>
                                <div class="home-faq-item__state"></div>
                            </header>
                            <div class="accordion-item-panel">
                                <div class="home-faq-item__content">
                                    <table class="support-table">
                                        <?foreach ($elemsBySection[$section['ID']] as $elem):?>
                                            <tr>
                                                <td class="support-char-name"><?=$elem['NAME']?></td>
                                                <td class="value-col garant active">
                                                    <?if($elem['PROPERTY_GARANT_CHECK_ENUM_ID']):?>
                                                        <svg class="check-icon support-main-card-item-icon">
                                                            <use href="<?=SITE_TEMPLATE_PATH?>/images/icons/icon-sprite.svg#check-icon"></use>
                                                        </svg>
                                                    <?else: echo $elem['PROPERTY_GARANT_VALUE']; endif;?>
                                                </td>
                                                <td class="value-col standart">
                                                    <?if($elem['PROPERTY_STANDART_CHECK_ENUM_ID']):?>
                                                        <svg class="check-icon support-main-card-item-icon">
                                                            <use href="<?=SITE_TEMPLATE_PATH?>/images/icons/icon-sprite.svg#check-icon"></use>
                                                        </svg>
                                                    <?else: echo $elem['PROPERTY_STANDART_VALUE']; endif;?>
                                                </td>
                                                <td class="value-col advanced">
                                                    <?if($elem['PROPERTY_ADVANCED_CHECK_ENUM_ID']):?>
                                                        <svg class="check-icon support-main-card-item-icon">
                                                            <use href="<?=SITE_TEMPLATE_PATH?>/images/icons/icon-sprite.svg#check-icon"></use>
                                                        </svg>
                                                    <?else: echo $elem['PROPERTY_ADVANCED_VALUE']; endif;?>
                                                </td>
                                                <td class="value-col premium">
                                                    <?if($elem['PROPERTY_PREMIUM_CHECK_ENUM_ID']):?>
                                                        <svg class="check-icon support-main-card-item-icon">
                                                            <use href="<?=SITE_TEMPLATE_PATH?>/images/icons/icon-sprite.svg#check-icon"></use>
                                                        </svg>
                                                    <?else: echo $elem['PROPERTY_PREMIUM_VALUE']; endif;?>
                                                </td>
                                            </tr>
                                        <?endforeach;?>
                                    </table>
                                </div>
                            </div>
                        </section>
                    <?endforeach;?>
                </div>
                <div class="support-footers">
                    <div class="support-footer empty"></div>
                    <div class="support-footer garant support-main-card-1 active">
                        <div class="support-main-card-footer-text">1 год включен в стоимость продукта</div>
                    </div>
                    <div class="support-footer standart support-main-card-2">
                        <button class="btn support-main-card-footer-button" data-course-modal="">Отправить запрос</button>
                    </div>
                    <div class="support-footer advanced support-main-card-3">
                        <button class="btn support-main-card-footer-button" data-course-modal="">Отправить запрос</button>
                    </div>
                    <div class="support-footer premium support-main-card-4">
                        <button class="btn support-main-card-footer-button" data-course-modal="">Отправить запрос</button>
                    </div>
                </div>
            </div>
            <?$APPLICATION->AddHeadScript("/support/tech-support/script.js" );?>

            <?/*$APPLICATION->IncludeComponent(
        "bitrix:news.list",
        "vidy_podderjki",
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
            "IBLOCK_ID" => "62",
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
                0 => "chto_vhodit",
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
    );*/?>
        </div>
        <!--<div class="product-card-video-slider-slider__control js-cards-slider-control-1">
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
        </div>-->
    </div>

    <div class="support-main-description">
        <div class="container">
            <?
            $APPLICATION->IncludeComponent(
                "bitrix:main.include",
                "",
                Array(
                    "AREA_FILE_SHOW" => "file",
                    "AREA_FILE_SUFFIX" => "inc",
                    "EDIT_TEMPLATE" => "",
                    "PATH" => "/local/include/support/support-table.php"
                )
            );?>
        </div>
    </div>

    <section class="home-faq support-main-accordion">
        <div class="container">
            <div class="support-main-accordion__title">Гарантийное обслуживание</div>
            <div class="support-main-accordion__subtitle">
                <?
                $APPLICATION->IncludeComponent(
                	"bitrix:main.include",
                	"",
                	Array(
                		"AREA_FILE_SHOW" => "file",
                		"AREA_FILE_SUFFIX" => "inc",
                		"EDIT_TEMPLATE" => "",
                		"PATH" => "/local/include/support/serv1.php"
                	)
                );
                ?>
            </div>
            <div class="home-faq__accordion">
                <div class="accordion" id="home-faq">

                    <!-- <section class="home-faq-item accordion-item">
    <header class="home-faq-item__header accordion-item-header accordion-trigger">
        <h2 class="home-faq-item__title">Порядок работы с неисправным оборудованием, находящимся на гарантийном обслуживании производителя</h2>
        <div class="home-faq-item__state"></div>
    </header>
    <div class="accordion-item-panel">
        <div class="home-faq-item__content">
            <ul>
                <li>
                    <?
                    $APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        "",
                        Array(
                            "AREA_FILE_SHOW" => "file",
                            "AREA_FILE_SUFFIX" => "inc",
                            "EDIT_TEMPLATE" => "",
                            "PATH" => "/local/include/support/serv2.php"
                        )
                    );
                    ?>
                </li>
            </ul>
            <button class="btn btn-primary" data-ask-question>Написать в поддержку</button>
            <ul>
                <li><?
                    $APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        "",
                        Array(
                            "AREA_FILE_SHOW" => "file",
                            "AREA_FILE_SUFFIX" => "inc",
                            "EDIT_TEMPLATE" => "",
                            "PATH" => "/local/include/support/serv3.php"
                        )
                    );
                    ?></li>
            </ul>
            <div class="search-field js-input-search-field">
                <div class="search-field__icon">
                    <svg width="14" height="14">
                        <use xlink:href="#i-search" href="#i-search"></use>
                    </svg>
                </div>
                <input class="js-input-search form-control" value="" placeholder="Поиск по названию производителя" name="q" data-field autocomplete="off">
                </div>
                <div class="support-main-accordion-item-wrap">
                    <div class="support-main-accordion-item">
                        <div class="support-main-accordion-item__text">
                            <div class="support-main-accordion-item__text__title">Специализированный АК С - Терра (АК S-Terra)</div>
                            <div class="support-main-accordion-item__text__description"><a href="#somelink">Условия гарантийного обслуживания</a> аппаратных комплексов С-Терра (АК S-Terra)</div>
                        </div>
                        <div class="support-main-accordion-item__contacts"><a class="support-main-accordion-item__contacts__phone" href="#">
                                <svg class="support-main-accordion-item__contacts__phone__icon">
                                    <use href="<?=SITE_TEMPLATE_PATH?>/images/icons/icon-sprite.svg#phone-icon"></use>
                                </svg><span>+7 (499) 940–90–01</span></a><a class="support-main-accordion-item__contacts__email" href="#">
                                <svg class="support-main-accordion-item__contacts__email__icon">
                                    <use href="<?=SITE_TEMPLATE_PATH?>/images/icons/icon-sprite.svg#mail-icon"></use>
                                </svg><span>sales@s-terra.ru</span></a></div>
                    </div>
                    <div class="support-main-accordion-item">
                        <div class="support-main-accordion-item__text">
                            <div class="support-main-accordion-item__text__title">ПАК С-Терра Юнит</div>
                            <div class="support-main-accordion-item__text__description">Срок гарантии на аппаратную платформу — 1 год</div>
                        </div>
                        <div class="support-main-accordion-item__contacts"><a class="support-main-accordion-item__contacts__phone" href="#">
                                <svg class="support-main-accordion-item__contacts__phone__icon">
                                    <use href="<?=SITE_TEMPLATE_PATH?>/images/icons/icon-sprite.svg#phone-icon"></use>
                                </svg><span>+7 (499) 940–90–01</span></a><a class="support-main-accordion-item__contacts__email" href="#">
                                <svg class="support-main-accordion-item__contacts__email__icon">
                                    <use href="<?=SITE_TEMPLATE_PATH?>/images/icons/icon-sprite.svg#mail-icon"></use>
                                </svg><span>sales@s-terra.ru</span></a></div>
                    </div>
                    <div class="support-main-accordion-item">
                        <div class="support-main-accordion-item__text">
                            <div class="support-main-accordion-item__text__title">Cisco</div>
                            <div class="support-main-accordion-item__text__description"><p>Запрос на гарантийную замену АП открывается через техническую поддержку ООО «С‑Терра СиЭсПи».</p> <p><a href="#">Условия реализации и предоставления сервисов и поддержки Cisco.</a></p></div>
                        </div>
                    </div>
                    <div class="support-main-accordion-item">
                        <div class="support-main-accordion-item__text">
                            <div class="support-main-accordion-item__text__title">Cisco NME-RVPN</div>
                            <div class="support-main-accordion-item__text__description">ООО «С-Терра СиЭсПи»</div>
                        </div>
                        <div class="support-main-accordion-item__contacts"><a class="support-main-accordion-item__contacts__phone" href="#">
                                <svg class="support-main-accordion-item__contacts__phone__icon">
                                    <use href="<?=SITE_TEMPLATE_PATH?>/images/icons/icon-sprite.svg#phone-icon"></use>
                                </svg><span>+7 (499) 940–90–01</span></a><a class="support-main-accordion-item__contacts__email" href="#">
                                <svg class="support-main-accordion-item__contacts__email__icon">
                                    <use href="<?=SITE_TEMPLATE_PATH?>/images/icons/icon-sprite.svg#mail-icon"></use>
                                </svg><span>sales@s-terra.ru</span></a></div>
                    </div>
                    <div class="support-main-accordion-item">
                        <div class="support-main-accordion-item__text">
                            <div class="support-main-accordion-item__text__title">Huawei</div>
                            <div class="support-main-accordion-item__text__description"><p>Гарантийное обслуживание аппаратных платформ Huawei производится в <a href="#">сервисных центрах компании.</a></p> <p><a href="#">Проверить условия обслуживания купленного оборудования</a></p></div>
                        </div>
                    </div>
                    <div class="support-main-accordion-item">
                        <div class="support-main-accordion-item__text">
                            <div class="support-main-accordion-item__text__title">Hewlett Packard</div>
                            <div class="support-main-accordion-item__text__description"><a href="#">Сервисные центры</a></div>
                        </div>
                    </div>
                    <div class="support-main-accordion-item">
                        <div class="support-main-accordion-item__text">
                            <div class="support-main-accordion-item__text__title">DEPO</div>
                            <div class="support-main-accordion-item__text__description"><a href="#">Компьютерные сервисные центры</a></div>
                        </div>
                    </div>
                    <div class="support-main-accordion-item">
                        <div class="support-main-accordion-item__text">
                            <div class="support-main-accordion-item__text__title">Kraftway</div>
                            <div class="support-main-accordion-item__text__description"><a href="#">Сервисная сеть</a></div>
                        </div>
                    </div>
                    <div class="support-main-accordion-item">
                        <div class="support-main-accordion-item__text">
                            <div class="support-main-accordion-item__text__title">TONK</div>
                            <div class="support-main-accordion-item__text__description">ООО «С-Терра СиЭсПи»</div>
                        </div>
                        <div class="support-main-accordion-item__contacts"><a class="support-main-accordion-item__contacts__phone" href="#">
                                <svg class="support-main-accordion-item__contacts__phone__icon">
                                    <use href="<?=SITE_TEMPLATE_PATH?>/images/icons/icon-sprite.svg#phone-icon"></use>
                                </svg><span>+7 (499) 940–90–01</span></a><a class="support-main-accordion-item__contacts__email" href="#">
                                <svg class="support-main-accordion-item__contacts__email__icon">
                                    <use href="<?=SITE_TEMPLATE_PATH?>/images/icons/icon-sprite.svg#mail-icon"></use>
                                </svg><span>sales@s-terra.ru</span></a></div>
                    </div>
                    <div class="support-main-accordion-item">
                        <div class="support-main-accordion-item__text">
                            <div class="support-main-accordion-item__text__title">СЗИ НСД семейства АККОРД</div>
                            <div class="support-main-accordion-item__text__description"><a href="#">Сервисные центры ОКБ «САПР»</a></div>
                        </div>
                    </div>
                    <div class="support-main-accordion-item">
                        <div class="support-main-accordion-item__text">
                            <div class="support-main-accordion-item__text__title">ПАК «Соболь»</div>
                            <div class="support-main-accordion-item__text__description"><a href="#">Сервисные центры компании «Код Безопасности»</a></div>
                        </div>
                    </div>
                    <div class="support-main-accordion-item">
                        <div class="support-main-accordion-item__text">
                            <div class="support-main-accordion-item__text__title">АПМДЗ «КРИПТОН-ЗАМОК»</div>
                            <div class="support-main-accordion-item__text__description"><a href="#">Сервисные центры Фирмы «АНКАД»</a></div>
                        </div>
                    </div>
                    <div class="support-main-accordion-item">
                        <div class="support-main-accordion-item__text">
                            <div class="support-main-accordion-item__text__title">АПМДЗ «МАКСИМ-М1»</div>
                            <div class="support-main-accordion-item__text__description"><a href="#">Сервисные центры АО «НПО РусБИТех»</a></div>
                        </div>
                    </div>
                    <div class="support-main-accordion-item">
                        <div class="support-main-accordion-item__text">
                            <div class="support-main-accordion-item__text__title">Eltex (ESR-H)</div>
                            <div class="support-main-accordion-item__text__description"><p>Перед отправкой оборудования в сервисный центр Eltex запросите <a href="#">в службе технической поддержки компании</a> «С-Терра СиЭсПи» инструкцию по разукомплектованию СКЗИ.</p><p><a href="#">Сервисные центры Eltex</a></p></div>
                        </div>
                    </div>
                </div>
                <small>
                    <?
                    $APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        "",
                        Array(
                            "AREA_FILE_SHOW" => "file",
                            "AREA_FILE_SUFFIX" => "inc",
                            "EDIT_TEMPLATE" => "",
                            "PATH" => "/local/include/support/no-serv.php"
                        )
                    );
                    ?>
                </small>
            </div>
        </div>
    </section> -->

                    <section class="home-faq-item accordion-item">
                        <header class="home-faq-item__header accordion-item-header accordion-trigger">
                            <h2 class="home-faq-item__title">Порядок передачи неисправного оборудования в ремонт через компанию ООО «С-Терра СиЭсПи»</h2>
                            <div class="home-faq-item__state"></div>
                        </header>
                        <div class="accordion-item-panel">
                            <div class="home-faq-item__content">
                                <div class="support-main-accordion__block">
                                    <div class="support-main-accordion__block__title">Шаг 1</div>
                                    <div class="support-main-accordion__block__description">
                                        <p>Обратитесь в службу технической поддержки для проведения удаленной диагностики. В случае положительного заключения о возможной неисправности АП, служба технической поддержки выдает RMA ID для каждой неисправной аппаратной платформы</p>
                                    </div>
                                </div>
                                <div class="support-main-accordion__block">
                                    <div class="support-main-accordion__block__title">Шаг 2</div>
                                    <div class="support-main-accordion__block__description">
                                        <p>После получения RMA ID следует каждую аппаратную платформу поместить в упаковку, защищающую при транспортировке от механических воздействий и влаги. В случае бескорпусной аппаратной платформы, упаковка должна обеспечивать защиту от электростатических разрядов. Мы рекомендуем для транспортировки аппаратной платформы использовать заводскую упаковку. В случае, если программно-аппаратный комплекс оборудован АПМДЗ, необходимо укомплектовать АПМДЗ Паспортом на изделие, считывателем iButton и идентификатором iButton, если данные устройства были в комплекте поставки.</p>
                                    </div>
                                </div>
                                <div class="support-main-accordion__block__alert">
                                    <div class="support-main-accordion__block__alert__title">Примечание</div>
                                    <div class="support-main-accordion__block__alert__text">Не отправляйте лицензии, CD, копии сертификатов, другие печатные материалы вместе с неисправным оборудованием!</div>
                                </div>
                                <div class="support-main-accordion__block">
                                    <div class="support-main-accordion__block__title">Шаг 3</div>
                                    <div class="support-main-accordion__block__description">
                                        <p>Нанесите на каждую упаковку полученный RMA ID</p>
                                    </div>
                                </div>
                                <div class="support-main-accordion__block">
                                    <div class="support-main-accordion__block__title">Шаг 4</div>
                                    <div class="support-main-accordion__block__description">
                                        <p>Доставьте неисправное оборудование по адресу сервис центра</p>
                                        <div class="support-main-accordion__block__description__item">
                                            <svg class="support-main-accordion__block__description__item__icon">
                                                <use href="<?=SITE_TEMPLATE_PATH?>/images/icons/icon-sprite.svg#pin-icon"></use>
                                            </svg><span>124460 г. Зеленоград, ул. Конструктора Лукина, д. 14, стр. 12, Технополис Москва</span>
                                        </div>
                                        <div class="support-main-accordion__block__description__item">
                                            <svg class="support-main-accordion__block__description__item__icon">
                                                <use href="<?=SITE_TEMPLATE_PATH?>/images/icons/icon-sprite.svg#user"></use>
                                            </svg><span>Контактное лицо для отправлений: <b>Грекова Неля</b></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </section>


    <div class="no-support container">
        <div class="text-block">
            <?
            $APPLICATION->IncludeComponent(
                "bitrix:main.include",
                "",
                Array(
                    "AREA_FILE_SHOW" => "file",
                    "AREA_FILE_SUFFIX" => "inc",
                    "EDIT_TEMPLATE" => "",
                    "PATH" => "/local/include/support/no-support.php"
                )
            );?>
        </div>
    </div>

    <div class="support-timing container">
        <div class="text-block">
            <?
            $APPLICATION->IncludeComponent(
                "bitrix:main.include",
                "",
                Array(
                    "AREA_FILE_SHOW" => "file",
                    "AREA_FILE_SUFFIX" => "inc",
                    "EDIT_TEMPLATE" => "",
                    "PATH" => "/local/include/support/support-timing.php"
                )
            );?>
        </div>
    </div>


    <div class="support-main-video-slider">
        <div class="support-main-video-slider__wrap">
            <div class="support-main-video-slider__title">Видеоуроки</div>
            <?$APPLICATION->IncludeComponent(
                "bitrix:news.list",
                "video-slider-support",
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
                    "DETAIL_URL" => "/support/education/videouroki/#ELEMENT_CODE#",
                    "DISPLAY_BOTTOM_PAGER" => "Y",
                    "DISPLAY_TOP_PAGER" => "N",
                    "FIELD_CODE" => array("",""),
                    "FILTER_NAME" => "",
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
                    "PROPERTY_CODE" => array("",""),
                    "SET_BROWSER_TITLE" => "N",
                    "SET_LAST_MODIFIED" => "N",
                    "SET_META_DESCRIPTION" => "Y",
                    "SET_META_KEYWORDS" => "Y",
                    "SET_STATUS_404" => "N",
                    "SET_TITLE" => "N",
                    "SHOW_404" => "N",
                    "SORT_BY1" => "ACTIVE_FROM",
                    "SORT_BY2" => "SORT",
                    "SORT_ORDER1" => "DESC",
                    "SORT_ORDER2" => "ASC",
                    "STRICT_SECTION_CHECK" => "N"
                )
            );?>
        </div>
    </div>
</div>
    <!-- FOOTER -->
    <div class="top-button">
        <div class="container">
            <button class="btn btn-primary-inverse btn-round" hidden type="button">
                <svg width="14" height="14">
                    <use xlink:href="#i-arrow-top" href="#i-arrow-top"></use>
                </svg>
            </button>
        </div>
    </div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>