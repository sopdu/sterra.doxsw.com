<section class="home-faq-item accordion-item">
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
                <!--button.js-input-search-clear.icon-btn.search-field__reset(type='button' data-reset)-->
                <!--    +svg-icon('times', 10, 10)-->
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
</section>