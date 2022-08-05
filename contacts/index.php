<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Контакты");
$file = COption::GetOptionString( "askaron.settings", "UF_FILE" );
?>
      <div class="contacts-page page-main">
        <div class="breadcrumb">
          <div class="container">
            <ul class="breadcrumb__list"><span class="breadcrumb__link">Главная</span><span class="breadcrumb__link-current"> / Контакты</span>
            </ul>
          </div>
        </div>
        <div class="contacts-main">
          <div class="container">
            <div class="contacts-main-title">Контакты</div>
            <div class="contacts-main-grid">
              <div class="contacts-main-grid__col">
				<div class="contacts-main-grid__item">
                <?
                $APPLICATION->IncludeComponent(
                    "bitrix:main.include",
                    "",
                    Array(
                        "AREA_FILE_SHOW" => "file",
                        "AREA_FILE_SUFFIX" => "inc",
                        "EDIT_TEMPLATE" => "",
                        "PATH" => "/include/contact/preob.php"
                    )
                );
                ?>
				</div>
                <div class="contacts-main-grid__item">
				 <?
                $APPLICATION->IncludeComponent(
                    "bitrix:main.include",
                    "",
                    Array(
                        "AREA_FILE_SHOW" => "file",
                        "AREA_FILE_SUFFIX" => "inc",
                        "EDIT_TEMPLATE" => "",
                        "PATH" => "/include/contact/tech.php"
                    )
                );
                ?>
                </div>
                <div class="contacts-main-grid__item">
					<?
                $APPLICATION->IncludeComponent(
                    "bitrix:main.include",
                    "",
                    Array(
                        "AREA_FILE_SHOW" => "file",
                        "AREA_FILE_SUFFIX" => "inc",
                        "EDIT_TEMPLATE" => "",
                        "PATH" => "/include/contact/tech-supp.php"
                    )
                );
                ?>
                </div>
                <div class="tablet contacts-main-grid__item">
                  <div class="contacts-main-grid__item__title">Общие вопросы</div>
                  <div class="contacts-main-grid__item__block">
                    <div class="icon">
                            <svg width="15" height="12">
                              <use xlink:href="#i-contacts-phone" href="#i-contacts-phone"></use>
                            </svg>
                    </div>
                    <div class="value"><a class="phone" href="tel:+74999409061">+7 (499) 940–90–61</a></div>
                  </div>
                  <div class="contacts-main-grid__item__block">
                    <div class="icon">
                            <svg width="15" height="17">
                              <use xlink:href="#i-contacts-fax" href="#i-contacts-fax"></use>
                            </svg>
                    </div>
                    <div class="value"><a class="phone" href="tel:+74999409061">+7 (499) 940–90–61</a></div>
                  </div>
                  <div class="contacts-main-grid__item__block">
                    <div class="icon">
                            <svg width="15" height="12">
                              <use xlink:href="#i-contacts-mail" href="#i-contacts-mail"></use>
                            </svg>
                    </div>
                    <div class="value"><a href="#">information@s-terra.ru</a></div>
                  </div>
                </div>
              </div>
              <div class="contacts-main-grid__col">
                <div class="contacts-main-grid__item">
				<?
                $APPLICATION->IncludeComponent(
                    "bitrix:main.include",
                    "",
                    Array(
                        "AREA_FILE_SHOW" => "file",
                        "AREA_FILE_SUFFIX" => "inc",
                        "EDIT_TEMPLATE" => "",
                        "PATH" => "/include/contact/remont.php"
                    )
                );
                ?>
              </div>
              <div class="contacts-main-grid__col">
                <div class="contacts-main-grid__item">
				<?
                $APPLICATION->IncludeComponent(
                    "bitrix:main.include",
                    "",
                    Array(
                        "AREA_FILE_SHOW" => "file",
                        "AREA_FILE_SUFFIX" => "inc",
                        "EDIT_TEMPLATE" => "",
                        "PATH" => "/include/contact/cop.php"
                    )
                );
                ?>
                </div>
                <div class="contacts-main-grid__item">
				<?
                $APPLICATION->IncludeComponent(
                    "bitrix:main.include",
                    "",
                    Array(
                        "AREA_FILE_SHOW" => "file",
                        "AREA_FILE_SUFFIX" => "inc",
                        "EDIT_TEMPLATE" => "",
                        "PATH" => "/include/contact/pr.php"
                    )
                );
                ?>
              </div>
              <div class="contacts-main-grid__col">
                <div class="contacts-main-grid__item">
				<?
                $APPLICATION->IncludeComponent(
                    "bitrix:main.include",
                    "",
                    Array(
                        "AREA_FILE_SHOW" => "file",
                        "AREA_FILE_SUFFIX" => "inc",
                        "EDIT_TEMPLATE" => "",
                        "PATH" => "/include/contact/fact-addr.php"
                    )
                );
                ?>
                </div>
                <div class="contacts-main-grid__item">
				<?
                $APPLICATION->IncludeComponent(
                    "bitrix:main.include",
                    "",
                    Array(
                        "AREA_FILE_SHOW" => "file",
                        "AREA_FILE_SUFFIX" => "inc",
                        "EDIT_TEMPLATE" => "",
                        "PATH" => "/include/contact/yr-addr.php"
                    )
                );
                ?>
                </div>
<?
if(CModule::IncludeModule('iblock')) {
    $arSort= Array("NAME"=>"ASC");
    $arSelect = Array("ID","NAME", "PROPERTY_FILE");
    $arFilter = Array("IBLOCK_ID" => 66);

    $res =  CIBlockElement::GetList($arSort, $arFilter, false, false, $arSelect);
 
    while($ob = $res->GetNextElement()){
        $arFields = $ob->GetFields();
    }
}
?>
				  <a target="_blank" href="<?=CFile::GetPath($arFields['PROPERTY_FILE_VALUE'])?>" class="btn btn-primary-inverse desktop contacts-main-btn">
                  <svg class="btn-icon">
                    <use href="/local/templates/s-terra22/images/icons/icon-sprite.svg#download-arrow-mobile"></use>
                  </svg><span>Реквизиты компании</span>
                </a>
              </div>
            </div>
            <div class="tablet mobile">
              <a target="_blank" href="<?=CFile::GetPath($arFields['PROPERTY_FILE_VALUE'])?>" class="btn btn-primary-inverse contacts-main-btn">
                <svg class="btn-icon">
                  <use href="/local/templates/s-terra22/images/icons/icon-sprite.svg#download-arrow-mobile"></use>
                </svg><span>Реквизиты компании</span>
              </a>

            </div>
            <div class="contacts-main-map">
              <div id="map"></div>
            </div>
            <div class="contacts-main-banner">
              <div class="contacts-main-banner__wrap">
                <div class="contacts-main-banner__text">
                  <div class="contacts-main-banner__title">Станьте нашим партнером</div>
                  <div class="contacts-main-banner__description">Для наших бизнес-партнеров предусмотрены льготные условия приобретения, специальные условия поддержки и другие преимущества</div>
                  <button class="btn btn-accent" data-partner-modal>Стать партнером</button>
                </div>
				  <div class="contacts-main-banner__image"><img src="/local/templates/s-terra22/images/contacts/contacts.png"></div>
              </div>
            </div>
          </div>
        </div><!-- CONTACT FORM -->
        <div class="home-contact-form catalog-form">
          <?
                $APPLICATION->IncludeComponent(
                    "bitrix:main.include",
                    "",
                    Array(
                        "AREA_FILE_SHOW" => "file",
                        "AREA_FILE_SUFFIX" => "inc",
                        "EDIT_TEMPLATE" => "",
                        "PATH" => "/local/include/contact-form.php"
                    )
                );
                ?>
        </div><!-- /CONTACT FORM -->
        <div class="contacts-form">
          <div class="container">
            <div class="contacts-form__wrap">
              <div class="contacts-form__title">Подпишитесь на рассылку и будьте в курсе новостей «С&#8209;Терра СиЭсПи»</div>
              <form class="contacts-form__block" action="/local/ajax/subscribe.php" method="GET">
                <div class="contacts-form__block__row">
                  <div class="form-field">
                    <label class="form-label">Название компании</label>
                    <input class="form-control" type="text" name="company" placeholder="">
                  </div>
                  <div class="form-field">
                    <label class="form-label">Email*</label>
                    <input class="form-control" type="text" name="email">
                  </div>
                </div>
                <div class="contacts-form__block__row__footer">
                  <div class="form-field home-contact-form__confirm">
                    <label class="checkbox">
                      <input type="checkbox" name="agreement"><span class="checkbox-box"></span>
                      <div class="checkbox-label">Даю согласие на обработку своих персональных данных в соответствии с <a target="_blank" href="/upload/medialibrary/6c7/politika_obrabotki_personal_dannyh_sterra_29-11-2019.pdf">Политикой обработки персональных данных ООО «С-Терра СиЭсПи»</a>.</div>
                    </label>
                  </div>
                  <div class="home-contact-form__submit">
                    <button class="btn btn-primary btn-block" type="submit">Отправить</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
<script src="https://api-maps.yandex.ru/2.1/?apikey=611c8b74-5d90-4ddd-9002-2f741ed053ad&lang=ru_RU" type="text/javascript"></script>
<script type="text/javascript">
    ymaps.ready(init);
        function init(){
            // Создание карты.
            var myMap = new ymaps.Map("map", {
                center: [56.007514, 37.156934],
    controls: ["zoomControl"],
    zoom: 16,
    
    });
    myPlacemark = new ymaps.Placemark(myMap.getCenter(), {
    hintContent: 'S-terra',
    balloonContent: 'S-terra'
    }, {
    // Опции.
    // Необходимо указать данный тип макета.
    iconLayout: 'default#image',
    // Своё изображение иконки метки.
    iconImageHref: '/local/templates/s-terra22/images/contacts/pin.png',
    // Размеры метки.
    iconImageSize: [40, 48],
    // Смещение левого верхнего угла иконки относительно
    // её "ножки" (точки привязки).
    iconImageOffset: [-30, -30 ]
    }),
    myMap.geoObjects
        .add(myPlacemark)
    }
    </script>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>