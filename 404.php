<?
include_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/urlrewrite.php');

CHTTP::SetStatus("404 Not Found");
@define("ERROR_404","Y");

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

$APPLICATION->SetTitle("404 Not Found");

/*
$APPLICATION->IncludeComponent("bitrix:main.map", ".default", Array(
	"LEVEL"	=>	"3",
	"COL_NUM"	=>	"2",
	"SHOW_DESCRIPTION"	=>	"Y",
	"SET_TITLE"	=>	"Y",
	"CACHE_TIME"	=>	"36000000"
	)
);
*/

//require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>

<div class="page service-page"><!-- HEADER -->
    <!-- Элемент списка (может быть со вложенным списком)-->
    <!-- Секция меню в&nbsp;плашке на&nbsp;мобильных-->
    <header class="header">
        <div class="header-view">
            <div class="container">
                <div class="header-view__wrapper"><a class="header-logo" href="/"><img src="/local/templates/s-terra22/images/logo.png" alt="S-Terra logo"></a>
                    <div class="header__navigation">
                        <!-- Элемент списка (может быть со вложенным списком)-->
                        <!-- Секция меню в&nbsp;плашке на&nbsp;мобильных-->
                        <nav class="header-navigation">
                            <ul>
                                <li data-submenu="about"><a href="javascript:void(0)">О компании
                                        <svg width="8" height="5">
                                            <use xlink:href="#i-chevron-bottom" href="#i-chevron-bottom"></use>
                                        </svg></a>
                                    <div class="header-navigation-pane" data-pane="about" hidden="true">
                                        <div class="header-navigation-pane__mask"></div><div class="header-navigation-pane__block">
                                            <div class="container">
                                                <div class="row header-section">
                                                    <div class="col col-auto">
                                                        <div class="header-section__info"><a class="header-section__name" href="#">О компании</a>
                                                            <div class="header-section__description">Разрабатываем и&nbsp;производим средства сетевой информационной безопасности на&nbsp;основе технологии IPsec</div>
                                                        </div>
                                                    </div>
                                                    <div class="col col-auto">
                                                        <div class="header-section__list">
                                                            <ul>
                                                                <li data-level="1"><a href="#">Основная информация</a>
                                                                </li>
                                                                <li data-level="1"><a href="#">Награды и&nbsp;благодарности</a>
                                                                </li>
                                                                <li data-level="1"><a href="#">Работа у&nbsp;нас</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="active" data-submenu="catalog"><a href="javascript:void(0)">Каталог
                                        <svg width="8" height="5">
                                            <use xlink:href="#i-chevron-bottom" href="#i-chevron-bottom"></use>
                                        </svg></a>
                                    <div class="header-navigation-pane" data-pane="catalog" hidden="">
                                        <div class="header-navigation-pane__mask"></div><div class="header-navigation-pane__block">
                                            <div class="container">
                                                <div class="row header-section">
                                                    <div class="col col-auto">
                                                        <div class="header-section__info"><a class="header-section__name" href="#">Каталог</a>
                                                            <div class="header-section__description">Поможем защитить информационную систему любого масштаба</div>
                                                        </div>
                                                    </div>
                                                    <div class="col col-auto">
                                                        <div class="header-section__list">
                                                            <ul class="products">
                                                                <li data-level="1"><a href="#">Продукты</a>
                                                                    <ul>
                                                                        <li class="active" data-level="2"><a href="#">Программные средства</a>
                                                                            <ul class="offset">
                                                                                <li data-level="3"><a href="#">С-Терра Клиент</a>
                                                                                </li>
                                                                                <li data-level="3"><a href="#">С-Терра Клиент А</a>
                                                                                </li>
                                                                            </ul>
                                                                        </li>
                                                                        <li data-level="2"><a href="#">Шлюзы безопасности</a>
                                                                            <ul class="offset">
                                                                                <li data-level="3"><a href="#">С-Терра Шлюз</a>
                                                                                </li>
                                                                                <li data-level="3"><a href="#">С-Терра Шлюз DP</a>
                                                                                </li>
                                                                                <li data-level="3"><a href="#">С-Терра Юнит</a>
                                                                                </li>
                                                                                <li data-level="3"><a href="#">С-Терра Виртуальный Шлюз</a>
                                                                                </li>
                                                                                <li data-level="3"><a href="#">С-Терра для&nbsp;Cisco</a>
                                                                                </li>
                                                                                <li data-level="3"><a href="#">Криптомаршрутизатор ESR-ST</a>
                                                                                </li>
                                                                                <li data-level="3"><a href="#">С-Терра Шлюз Е</a>
                                                                                </li>
                                                                                <li data-level="3"><a href="#">С-Терра Виртуальный Шлюз Е</a>
                                                                                </li>
                                                                            </ul>
                                                                        </li>
                                                                        <li data-level="2"><a href="#">Специальные решения</a>
                                                                            <ul class="offset">
                                                                                <li data-level="3"><a href="#">С-Терра L2</a>
                                                                                </li>
                                                                                <li data-level="3"><a href="#">С-Терра СОВ</a>
                                                                                </li>
                                                                            </ul>
                                                                        </li>
                                                                        <li data-level="2"><a href="#">Система управления</a>
                                                                            <ul class="offset">
                                                                                <li data-level="3"><a href="#">С-Терра КП</a>
                                                                                </li>
                                                                            </ul>
                                                                        </li>
                                                                    </ul>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="col col-auto">
                                                        <div class="header-section__list">
                                                            <ul>
                                                                <li data-level="1"><a href="#">Отраслевые решения</a>
                                                                    <ul class="offset">
                                                                        <li data-level="2"><a href="#">Финансовый сектор</a>
                                                                        </li>
                                                                        <li data-level="2"><a href="#">Государственный сектор</a>
                                                                        </li>
                                                                        <li data-level="2"><a href="#">Топливно-энергетическая отрасль</a>
                                                                        </li>
                                                                        <li data-level="2"><a href="#">Телекоммуникационная отрасль</a>
                                                                        </li>
                                                                    </ul>
                                                                </li>
                                                                <li data-level="1"><a href="#">Комплексные решения</a>
                                                                    <ul class="offset">
                                                                        <li data-level="2"><a href="#">Защита канала 10 Гбит и&nbsp;больше</a>
                                                                        </li>
                                                                        <li data-level="2"><a href="#">Обнаружение вторжений</a>
                                                                        </li>
                                                                        <li data-level="2"><a href="#">Защита удаленного доступа</a>
                                                                        </li>
                                                                        <li data-level="2"><a href="#">Защита персональных данных</a>
                                                                        </li>
                                                                        <li data-level="2"><a href="#">Защита межфилиальных взаимодействий</a>
                                                                        </li>
                                                                        <li data-level="2"><a href="#">Защита виртуализации</a>
                                                                        </li>
                                                                        <li data-level="2"><a href="#">Защита подключения к&nbsp;СМЭВ</a>
                                                                        </li>
                                                                        <li data-level="2"><a href="#">Защита подключения к&nbsp;ИС ЕПТ</a>
                                                                        </li>
                                                                    </ul>
                                                                </li>
                                                                <li data-level="1"><a href="#">Прайс-листы</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li data-submenu="support"><a href="javascript:void(0)">Поддержка
                                        <svg width="8" height="5">
                                            <use xlink:href="#i-chevron-bottom" href="#i-chevron-bottom"></use>
                                        </svg></a>
                                    <div class="header-navigation-pane" data-pane="support" hidden="true">
                                        <div class="header-navigation-pane__mask"></div><div class="header-navigation-pane__block">
                                            <div class="container">
                                                <div class="row header-section">
                                                    <div class="col col-auto">
                                                        <div class="header-section__info"><a class="header-section__name" href="#">Поддержка</a>
                                                            <div class="header-section__description">Квалифицированные консультации и&nbsp;помощь в&nbsp;решении технических проблем</div>
                                                        </div>
                                                    </div>
                                                    <div class="col col-auto">
                                                        <div class="header-section__list">
                                                            <ul>
                                                                <li data-level="1"><a href="#">Техническая поддержка</a>
                                                                </li>
                                                                <li data-level="1"><a href="#">Часто задаваемые вопросы (FAQ)</a>
                                                                </li>
                                                                <li data-level="1"><a href="#">Загрузки</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="col col-auto">
                                                        <div class="header-section__list">
                                                            <ul>
                                                                <li data-level="1"><a href="#">Документация</a>
                                                                    <ul class="offset">
                                                                        <li data-level="2"><a href="#">Сертификаты на&nbsp;продукцию</a>
                                                                        </li>
                                                                        <li data-level="2"><a href="#">Лицензии и&nbsp;свидетельства</a>
                                                                        </li>
                                                                        <li data-level="2"><a href="#">Нормативные документы</a>
                                                                        </li>
                                                                    </ul>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="col col-auto">
                                                        <div class="header-section__list">
                                                            <ul>
                                                                <li data-level="1"><a href="#">Обучение</a>
                                                                    <ul class="offset">
                                                                        <li data-level="2"><a href="#">Курсы</a>
                                                                        </li>
                                                                        <li data-level="2"><a href="#">Видеоуроки</a>
                                                                        </li>
                                                                    </ul>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li data-submenu="press"><a href="javascript:void(0)">Пресс-центр
                                        <svg width="8" height="5">
                                            <use xlink:href="#i-chevron-bottom" href="#i-chevron-bottom"></use>
                                        </svg></a>
                                    <div class="header-navigation-pane" data-pane="press" hidden="true">
                                        <div class="header-navigation-pane__mask"></div><div class="header-navigation-pane__block">
                                            <div class="container">
                                                <div class="row header-section">
                                                    <div class="col col-3">
                                                        <div class="header-section__info"><a class="header-section__name" href="#">Пресс-центр</a>
                                                            <div class="header-section__description">Будьте первыми в&nbsp;курсе новостей и&nbsp;обновлений нашей компании</div>
                                                        </div>
                                                    </div>
                                                    <div class="col col-auto">
                                                        <div class="header-section__list">
                                                            <ul>
                                                                <li data-level="1"><a href="#">Новости</a>
                                                                </li>
                                                                <li data-level="1"><a href="#">Объявления</a>
                                                                </li>
                                                                <li data-level="1"><a href="#">Мероприятия</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="col col-auto">
                                                        <div class="header-section__list">
                                                            <ul>
                                                                <li data-level="1"><a href="#">Вебинары</a>
                                                                </li>
                                                                <li data-level="1"><a href="#">Публикации</a>
                                                                </li>
                                                                <li data-level="1"><a href="#">Маркетинговые материалы</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li><a href="#">Партнеры</a></li>
                                <li><a href="#">Контакты</a></li>
                            </ul>
                        </nav>
                    </div>
                    <div class="header__contacts">
                        <div class="header-contacts">
                            <div class="header-contacts__view"><a class="header-contacts__phone" href="tel:84999409061">+7 (499) 940-90-61</a>
                                <button class="header-contacts__trigger" type="button">Написать нам
                                    <svg width="12" height="7">
                                        <use xlink:href="#i-chevron-bottom" href="#i-chevron-bottom"></use>
                                    </svg>
                                </button>
                            </div>
                            <div class="header-contacts__pane" hidden="true">
                                <div class="header-contacts__wrapper">
                                    <div class="contacts-block">
                                        <div class="contacts-block__question">
                                            <button class="btn btn-primary-inverse btn-block" type="button" data-ask-question="">Задать вопрос</button>
                                        </div>
                                        <div class="contacts-block__mail">
                                            <div class="contacts-block__label">Напишите нам</div><a href="mailto:information@s-terra.ru">information@s-terra.ru</a>
                                        </div>
                                        <div class="contacts-block__apps">
                                            <div class="apps colored">
                                                <div class="apps-block">
                                                    <div class="apps-title">Мы в&nbsp;мессенджерах</div>
                                                    <ul class="apps-list">
                                                        <li><a class="app-icon app-icon-wa" href="#" target="_blank" rel="noopener noreferrer nofollow"><img class="icon" src="./img/apps/wa.png"><img class="colored-icon" src="./img/apps/wa-color.png"></a></li>
                                                        <li><a class="app-icon app-icon-tg" href="#" target="_blank" rel="noopener noreferrer nofollow"><img class="icon" src="./img/apps/tg.png"><img class="colored-icon" src="./img/apps/tg-color.png"></a></li>
                                                    </ul>
                                                </div>
                                                <div class="apps-block">
                                                    <div class="apps-title">Мы в&nbsp;соцсетях</div>
                                                    <ul class="apps-list">
                                                        <li><a class="app-icon app-icon-fb" href="#" target="_blank" rel="noopener noreferrer nofollow"><img class="icon" src="./img/apps/fb.png"><img class="colored-icon" src="./img/apps/fb-color.png"></a></li>
                                                        <li><a class="app-icon app-icon-yt" href="#" target="_blank" rel="noopener noreferrer nofollow"><img class="icon" src="./img/apps/yt.png"><img class="colored-icon" src="./img/apps/yt-color.png"></a></li>
                                                        <li><a class="app-icon app-icon-vk" href="#" target="_blank" rel="noopener noreferrer nofollow"><img class="icon" src="./img/apps/vk.png"><img class="colored-icon" src="./img/apps/vk-color.png"></a></li>
                                                        <li><a class="app-icon app-icon-in" href="#" target="_blank" rel="noopener noreferrer nofollow"><img class="icon" src="./img/apps/in.png"><img class="colored-icon" src="./img/apps/in-color.png"></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="header__actions">
                        <div class="header-search">
                            <button class="btn btn-round btn-sm btn-primary-inverse header-search__trigger" type="button">
                                <svg width="14" height="14">
                                    <use xlink:href="#i-search" href="#i-search"></use>
                                </svg>
                            </button>
                            <div class="header-search__search"><!-- SEARCH FORM -->
                                <!-- data-autocomplete - урл для&nbsp;подгрузки 10 результатов-->
                                <!-- action - урл для&nbsp;отправки формы (переход на&nbsp;страницу поиска)-->
                                <form class="search" data-search="" data-autocomplete="./backend/search.json" action="./search-page" method="GET">
                                    <div class="search-field">
                                        <div class="search-field__icon">
                                            <svg width="14" height="14">
                                                <use xlink:href="#i-search" href="#i-search"></use>
                                            </svg>
                                        </div>
                                        <input class="form-control" value="" placeholder="Поиск" name="q" data-field="" autocomplete="off">
                                        <button class="icon-btn search-field__reset" type="button" data-reset="">
                                            <svg width="10" height="10">
                                                <use xlink:href="#i-times-bold" href="#i-times-bold"></use>
                                            </svg>
                                        </button>
                                    </div>
                                    <ul class="search-list" data-list="" hidden=""></ul>
                                </form><!-- /SEARCH FORM -->
                            </div>
                        </div><a class="btn btn-round btn-sm btn-primary-inverse header-account" href="#">
                            <svg width="16" height="16">
                                <use xlink:href="#i-user" href="#i-user"></use>
                            </svg></a>
                    </div>
                    <button class="icon-btn header-toggler" type="button" data-closed="true"><span class="burger">
                                      <svg width="20" height="17">
                                        <use xlink:href="#i-burger" href="#i-burger"></use>
                                      </svg></span><span class="times">
                                      <svg width="16" height="16">
                                        <use xlink:href="#i-times" href="#i-times"></use>
                                      </svg></span></button>
                </div>
            </div>
        </div>
        <div class="header-pane" hidden="true">
            <div class="header-pane__mask"></div>
            <div class="header-pane__content">
                <div class="container">
                    <div class="header-pane__search"><!-- SEARCH FORM -->
                        <!-- data-autocomplete - урл для&nbsp;подгрузки 10 результатов-->
                        <!-- action - урл для&nbsp;отправки формы (переход на&nbsp;страницу поиска)-->
                        <form class="search" data-search="" data-autocomplete="./backend/search.json" action="./search-page" method="GET">
                            <div class="search-field">
                                <div class="search-field__icon">
                                    <svg width="14" height="14">
                                        <use xlink:href="#i-search" href="#i-search"></use>
                                    </svg>
                                </div>
                                <input class="form-control" value="" placeholder="Поиск" name="q" data-field="" autocomplete="off">
                                <button class="icon-btn search-field__reset" type="button" data-reset="">
                                    <svg width="10" height="10">
                                        <use xlink:href="#i-times-bold" href="#i-times-bold"></use>
                                    </svg>
                                </button>
                            </div>
                            <ul class="search-list" data-list="" hidden=""></ul>
                        </form><!-- /SEARCH FORM -->
                    </div>
                    <div class="header-pane__nav">
                        <div class="header-menu">
                            <section class="header-menu-section" data-section="account">
                                <header class="header-menu-section__header"><a class="header-menu-section__title" href="#">Личный кабинет</a>
                                </header>
                            </section>
                            <div class="d-md-none">
                                <section class="header-menu-section" data-section="about">
                                    <header class="header-menu-section__header"><a class="header-menu-section__title" href="#">О компании</a>
                                        <button class="icon-btn header-menu-section__toggler">
                                            <svg width="12" height="7">
                                                <use xlink:href="#i-chevron-bottom" href="#i-chevron-bottom"></use>
                                            </svg>
                                        </button>
                                    </header>
                                    <div class="header-menu-section__items" style="height: 0px; overflow: hidden; transition: height 400ms ease-in-out 0s;">
                                        <ul>
                                            <li data-level="1"><a href="#">Основная информация</a>
                                            </li>
                                            <li data-level="1"><a href="#">Награды и&nbsp;благодарности</a>
                                            </li>
                                            <li data-level="1"><a href="#">Работа у&nbsp;нас</a>
                                            </li>
                                        </ul>
                                    </div>
                                </section>
                            </div>
                            <section class="header-menu-section" data-section="catalog">
                                <header class="header-menu-section__header"><a class="header-menu-section__title" href="#">Каталог</a>
                                    <button class="icon-btn header-menu-section__toggler">
                                        <svg width="12" height="7">
                                            <use xlink:href="#i-chevron-bottom" href="#i-chevron-bottom"></use>
                                        </svg>
                                    </button>
                                </header>
                                <div class="header-menu-section__items" style="height: 0px; overflow: hidden; transition: height 400ms ease-in-out 0s;">
                                    <ul>
                                        <li data-level="1"><a href="#">Продукты</a>
                                            <ul>
                                                <li class="active" data-level="2"><a href="#">Программные средства</a>
                                                    <ul class="offset">
                                                        <li data-level="3"><a href="#">С-Терра Клиент</a>
                                                        </li>
                                                        <li data-level="3"><a href="#">С-Терра Клиент А</a>
                                                        </li>
                                                    </ul>
                                                </li>
                                                <li data-level="2"><a href="#">Шлюзы безопасности</a>
                                                    <ul class="offset">
                                                        <li data-level="3"><a href="#">С-Терра Шлюз</a>
                                                        </li>
                                                        <li data-level="3"><a href="#">С-Терра Шлюз DP</a>
                                                        </li>
                                                        <li data-level="3"><a href="#">С-Терра Юнит</a>
                                                        </li>
                                                        <li data-level="3"><a href="#">С-Терра Виртуальный Шлюз</a>
                                                        </li>
                                                        <li data-level="3"><a href="#">С-Терра для&nbsp;Cisco</a>
                                                        </li>
                                                        <li data-level="3"><a href="#">Криптомаршрутизатор ESR-ST</a>
                                                        </li>
                                                        <li data-level="3"><a href="#">С-Терра Шлюз Е</a>
                                                        </li>
                                                        <li data-level="3"><a href="#">С-Терра Виртуальный Шлюз Е</a>
                                                        </li>
                                                    </ul>
                                                </li>
                                                <li data-level="2"><a href="#">Специальные решения</a>
                                                    <ul class="offset">
                                                        <li data-level="3"><a href="#">С-Терра L2</a>
                                                        </li>
                                                        <li data-level="3"><a href="#">С-Терра СОВ</a>
                                                        </li>
                                                    </ul>
                                                </li>
                                                <li data-level="2"><a href="#">Система управления</a>
                                                    <ul class="offset">
                                                        <li data-level="3"><a href="#">С-Терра КП</a>
                                                        </li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </li>
                                        <li data-level="1"><a href="#">Отраслевые решения</a>
                                            <ul class="offset">
                                                <li data-level="2"><a href="#">Финансовый сектор</a>
                                                </li>
                                                <li data-level="2"><a href="#">Государственный сектор</a>
                                                </li>
                                                <li data-level="2"><a href="#">Топливно-энергетическая отрасль</a>
                                                </li>
                                                <li data-level="2"><a href="#">Телекоммуникационная отрасль</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li data-level="1"><a href="#">Комплексные решения</a>
                                            <ul class="offset">
                                                <li data-level="2"><a href="#">Защита канала 10 Гбит и&nbsp;больше</a>
                                                </li>
                                                <li data-level="2"><a href="#">Обнаружение вторжений</a>
                                                </li>
                                                <li data-level="2"><a href="#">Защита удаленного доступа</a>
                                                </li>
                                                <li data-level="2"><a href="#">Защита персональных данных</a>
                                                </li>
                                                <li data-level="2"><a href="#">Защита межфилиальных взаимодействий</a>
                                                </li>
                                                <li data-level="2"><a href="#">Защита виртуализации</a>
                                                </li>
                                                <li data-level="2"><a href="#">Защита подключения к&nbsp;СМЭВ</a>
                                                </li>
                                                <li data-level="2"><a href="#">Защита подключения к&nbsp;ИС ЕПТ</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li data-level="1"><a href="#">Прайс-листы</a>
                                        </li>
                                    </ul>
                                </div>
                            </section>
                            <div class="d-none d-md-block">
                                <section class="header-menu-section" data-section="about">
                                    <header class="header-menu-section__header"><a class="header-menu-section__title" href="#">О компании</a>
                                        <button class="icon-btn header-menu-section__toggler">
                                            <svg width="12" height="7">
                                                <use xlink:href="#i-chevron-bottom" href="#i-chevron-bottom"></use>
                                            </svg>
                                        </button>
                                    </header>
                                    <div class="header-menu-section__items" style="height: 0px; overflow: hidden; transition: height 400ms ease-in-out 0s;">
                                        <ul>
                                            <li data-level="1"><a href="#">Основная информация</a>
                                            </li>
                                            <li data-level="1"><a href="#">Награды и&nbsp;благодарности</a>
                                            </li>
                                            <li data-level="1"><a href="#">Работа у&nbsp;нас</a>
                                            </li>
                                        </ul>
                                    </div>
                                </section>
                            </div>
                            <section class="header-menu-section" data-section="support">
                                <header class="header-menu-section__header"><a class="header-menu-section__title" href="#">Поддержка</a>
                                    <button class="icon-btn header-menu-section__toggler">
                                        <svg width="12" height="7">
                                            <use xlink:href="#i-chevron-bottom" href="#i-chevron-bottom"></use>
                                        </svg>
                                    </button>
                                </header>
                                <div class="header-menu-section__items" style="height: 0px; overflow: hidden; transition: height 400ms ease-in-out 0s;">
                                    <ul>
                                        <li data-level="1"><a href="#">Техническая поддержка</a>
                                        </li>
                                        <li data-level="1"><a href="#">Часто задаваемые вопросы (FAQ)</a>
                                        </li>
                                        <li data-level="1"><a href="#">Загрузки</a>
                                        </li>
                                        <li data-level="1"><a href="#">Документация</a>
                                            <ul class="offset">
                                                <li data-level="2"><a href="#">Сертификаты на&nbsp;продукцию</a>
                                                </li>
                                                <li data-level="2"><a href="#">Лицензии и&nbsp;свидетельства</a>
                                                </li>
                                                <li data-level="2"><a href="#">Нормативные документы</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li data-level="1"><a href="#">Обучение</a>
                                            <ul class="offset">
                                                <li data-level="2"><a href="#">Курсы</a>
                                                </li>
                                                <li data-level="2"><a href="#">Видеоуроки</a>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </section>
                            <section class="header-menu-section" data-section="press">
                                <header class="header-menu-section__header"><a class="header-menu-section__title" href="#">Пресс-центр</a>
                                    <button class="icon-btn header-menu-section__toggler">
                                        <svg width="12" height="7">
                                            <use xlink:href="#i-chevron-bottom" href="#i-chevron-bottom"></use>
                                        </svg>
                                    </button>
                                </header>
                                <div class="header-menu-section__items" style="height: 0px; overflow: hidden; transition: height 400ms ease-in-out 0s;">
                                    <ul>
                                        <li data-level="1"><a href="#">Новости</a>
                                        </li>
                                        <li data-level="1"><a href="#">Объявления</a>
                                        </li>
                                        <li data-level="1"><a href="#">Мероприятия</a>
                                        </li>
                                        <li data-level="1"><a href="#">Вебинары</a>
                                        </li>
                                        <li data-level="1"><a href="#">Публикации</a>
                                        </li>
                                        <li data-level="1"><a href="#">Маркетинговые материалы</a>
                                        </li>
                                    </ul>
                                </div>
                            </section>
                            <section class="header-menu-section" data-section="partners">
                                <header class="header-menu-section__header"><a class="header-menu-section__title" href="#">Партнеры</a>
                                </header>
                            </section>
                            <section class="header-menu-section" data-section="contacts">
                                <header class="header-menu-section__header"><a class="header-menu-section__title" href="#">Контакты</a>
                                </header>
                            </section>
                        </div>
                    </div>
                    <div class="header-pane__contacts">
                        <div class="contacts-block">
                            <div class="contacts-block__question">
                                <button class="btn btn-primary-inverse btn-block" type="button" data-ask-question="">Задать вопрос</button>
                            </div>
                            <div class="contacts-block__mail">
                                <div class="contacts-block__label">Напишите нам</div><a href="mailto:information@s-terra.ru">information@s-terra.ru</a>
                            </div>
                            <div class="contacts-block__apps">
                                <div class="apps colored">
                                    <div class="apps-block">
                                        <div class="apps-title">Мы в&nbsp;мессенджерах</div>
                                        <ul class="apps-list">
                                            <li><a class="app-icon app-icon-wa" href="#" target="_blank" rel="noopener noreferrer nofollow"><img class="icon" src="./img/apps/wa.png"><img class="colored-icon" src="./img/apps/wa-color.png"></a></li>
                                            <li><a class="app-icon app-icon-tg" href="#" target="_blank" rel="noopener noreferrer nofollow"><img class="icon" src="./img/apps/tg.png"><img class="colored-icon" src="./img/apps/tg-color.png"></a></li>
                                        </ul>
                                    </div>
                                    <div class="apps-block">
                                        <div class="apps-title">Мы в&nbsp;соцсетях</div>
                                        <ul class="apps-list">
                                            <li><a class="app-icon app-icon-fb" href="#" target="_blank" rel="noopener noreferrer nofollow"><img class="icon" src="./img/apps/fb.png"><img class="colored-icon" src="./img/apps/fb-color.png"></a></li>
                                            <li><a class="app-icon app-icon-yt" href="#" target="_blank" rel="noopener noreferrer nofollow"><img class="icon" src="./img/apps/yt.png"><img class="colored-icon" src="./img/apps/yt-color.png"></a></li>
                                            <li><a class="app-icon app-icon-vk" href="#" target="_blank" rel="noopener noreferrer nofollow"><img class="icon" src="./img/apps/vk.png"><img class="colored-icon" src="./img/apps/vk-color.png"></a></li>
                                            <li><a class="app-icon app-icon-in" href="#" target="_blank" rel="noopener noreferrer nofollow"><img class="icon" src="./img/apps/in.png"><img class="colored-icon" src="./img/apps/in-color.png"></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header><!-- /HEADER --><!-- Course FORM -->
    <!-- /Course FORM --><!-- Course FORM -->
    <!-- /Course FORM --><!-- QUESTION FORM -->
    <!-- /QUESTION FORM -->
    <div class="container service-page-container">
        <div class="service-page-wrap">
            <div class="service-page-text">
                <div class="service-page-text__title">Страница не&nbsp;найдена</div>
                <div class="service-page-text__subtitle">Попробуйте начать с&nbsp;<a href="/">главной страницы</a> или&nbsp;воспользуйтесь <a href="/search/">поиском</a></div>
            </div>
            <div class="service-page__image"><img src="<?=SITE_TEMPLATE_PATH?>/images/not_found.png"></div>
        </div>
    </div>
</div>


<style>
    .service-page {
        min-height: 100vh;
        padding-top: 80px;
        background-color: #1E1D85;
    }
    .service-page-container {
        min-height: calc(100vh - 80px);
        display: flex;
        align-items: center;
    }
    .service-page-wrap {
        height: 100%;
        padding-top: 40px;
        padding-bottom: 40px;
        display: flex;
        align-items: center;
    }
    .service-page__image {
        width: 488px;
    }
    .service-page__image img {
        width: 100%;
    }
    .service-page-text {
        display: flex;
        flex-direction: column;
        width: 650px;
    }
    .service-page-text__title {
        font-weight: 500;
        font-size: 42px;
        line-height: 120%;
        /* or 50px */
        color: #FFFFFF;
        margin-bottom: 19px;
    }
    .service-page-text__subtitle {
        font-weight: 400;
        font-size: 17px;
        line-height: 140%;
        /* or 24px */
        max-width: 370px;
        color: #FFFFFF;
    }
    .service-page-text__subtitle a {
        text-decoration: underline;
        color: #FFFFFF;
        font-weight: 400;
    }

    @media (max-width: 1200px) {
        .service-page__image {
            flex-grow: 1;
            width: unset;
        }
    }
    @media (max-width: 991px) {
        .service-page-container {
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
        .service-page-wrap {
            flex-direction: column;
            align-items: center;
            width: 100%;
        }
        .service-page__image {
            width: 488px;
            margin-left: auto;
            margin-right: auto;
            margin-bottom: 80px;
            max-width: 64%;
        }
        .service-page-text {
            order: 1;
            width: unset;
        }
        .service-page-text__title {
            text-align: center;
            font-size: 32px;
            line-height: 120%;
            margin-bottom: 22px;
        }
        .service-page-text__subtitle {
            text-align: center;
            font-size: 15px;
            line-height: 140%;
        }
    }
    @media (max-width: 767px) {
        .service-page__image {
            margin-bottom: 40px;
        }
        .service-page-text__title {
            font-size: 20px;
            line-height: 120%;
            margin-bottom: 15px;
        }
    }
</style>