<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?php
$ruMonths = [
    'января',
    'февраля',
    'марта',
    'апреля',
    'мая',
    'июня',
    'июля',
    'августа',
    'сентября',
    'октября',
    'ноября',
    'декабря'
];
$date = strtotime($arResult['DATE_CREATE']);
?>
 <div class="case-page page-main">
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
          <div class="text-container">
              <?
              if ($arResult['PROPERTIES']['H1_DETAIL']['VALUE']) $header = $arResult['PROPERTIES']['H1_DETAIL']['VALUE'];
              else $header = $arResult["NAME"];
              ?>
			  <div class="case-page__title"><?=$header?></div>
            <div class="case-page__subtitle"><?=date('d', $date)?> <?=$ruMonths[date('n', $date)-1]?> <?=date('Y', $date)?> </div>
            <div class="case-page__content">
				<?=$arResult['PROPERTIES']['BEFORE_SLIDER']['~VALUE']['TEXT']?>
				<div class="about-team-slider">
				  <?foreach ($arResult["PROPERTIES"]["FILE"]["VALUE"] as $galer):?>
                <div class="slider__item"><img src="<?=CFile::GetPath($galer)?>"></div>
                <?endforeach?>
              </div>
              <div class="about-team-slider-thumbnails-wrap">
                <ul class="about-team-slider-thumbnails" id="about-team-slider-thumbnails">
                   <?foreach ($arResult["PROPERTIES"]["FILE"]["VALUE"] as $galer):?>
                  <li><img src="<?=CFile::GetPath($galer)?>"></li>
                <?endforeach?>
                </ul>
				</div>
              <?=$arResult["DETAIL_TEXT"]?>
            </div>
              <?if($arResult["PROPERTIES"]["OTZYV"]["VALUE"]):
                  $arResult["PROPERTIES"]["OTZYV"]["VALUE"] = Array($arResult["PROPERTIES"]["OTZYV"]["VALUE"])?>
                <div class="case-reviews-slider js-partner-slider-1">
			<?foreach($arResult["PROPERTIES"]["OTZYV"]["VALUE"] as $otzyv):?>
					<?$resElement = \CIBlockElement::GetList([],['IBLOCK_ID' => 64,'ID' => $otzyv,],
						false,
						false,
						['ID','IBLOCK_ID','NAME','PREVIEW_TEXT','PROPERTY_FIO','PROPERTY_DOL','PREVIEW_PICTURE']
					);
					
					if ( !($element = $resElement->getNext() ) )
					{
						echo "Элемент не найден";
						return;
					}?>
              <div class="case-reviews-slider__item"><a class="case-reviews-slider__item__wrap" href="#">
                  <div class="case-reviews-slider__item__top"><?=$element["NAME"]?></div>
                  <div class="case-reviews-slider__item__image"><img src="<?=CFile::GetPath($element["PREVIEW_PICTURE"])?>"></div>
                  <div class="case-reviews-slider__item__description"><?=$element["PREVIEW_TEXT"]?></div>
                  <div class="case-reviews-slider__item__bottom">
                    <div class="title"><?=$element["PROPERTY_FIO_VALUE"]?></div>
                    <div class="value"><?=$element["PROPERTY_DOL_VALUE"]?></div>
                  </div></a></div>
				<?endforeach;?>
            </div>
              <?endif?>
            <div class="case-reviews-slider__control ">
              <!--<button class="btn btn-primary-inverse btn-round" data-controls="prev">
                      <svg width="7" height="12">
                        <use xlink:href="#i-chevron-left" href="#i-chevron-left"></use>
                      </svg>
              </button>
              <button class="btn btn-primary-inverse btn-round" data-controls="next">
                      <svg width="7" height="12">
                        <use xlink:href="#i-chevron-right" href="#i-chevron-right"></use>
                      </svg>
              </button>-->
                <?$rs=CIBlockElement::GetList(array("active_from" => "desc"), array("ACTIVE"=>"Y", "IBLOCK_ID"=>$arResult["IBLOCK_ID"]), false, array("nElementID"=>$arResult["ID"], "nPageSize"=>1), array("ID", "DETAIL_PAGE_URL"));
                while($ar=$rs->GetNext()) {
                    $page[] = $ar;
                }
                ?>

                <?if (count($page) == 2 && $arResult["ID"] == $page[0]['ID']):?>
                    <a class="btn btn-primary-inverse btn-round" href="<?=$page[1]['DETAIL_PAGE_URL']?>">
                        <svg width="7" height="12">
                            <use xlink:href="#i-chevron-left" href="#i-chevron-left"></use>
                        </svg>
                    </a>
                    <a class="btn btn-primary-inverse btn-round" href="#" disabled="">
                        <svg width="7" height="12">
                            <use xlink:href="#i-chevron-right" href="#i-chevron-right"></use>
                        </svg>
                    </a>

                <?elseif (count($page) == 3):?>
                    <a class="btn btn-primary-inverse btn-round" href="<?=$page[2]['DETAIL_PAGE_URL']?>">
                        <svg width="7" height="12">
                            <use xlink:href="#i-chevron-left" href="#i-chevron-left"></use>
                        </svg>
                    </a>

                    <a class="btn btn-primary-inverse btn-round" href="<?=$page[0]['DETAIL_PAGE_URL']?>">
                        <svg width="7" height="12">
                            <use xlink:href="#i-chevron-right" href="#i-chevron-right"></use>
                        </svg>
                    </a>

                <?elseif (count($page) == 2 && $arResult["ID"] == $page[1]['ID']):?>
                    <a class="btn btn-primary-inverse btn-round" href="#" disabled>
                        <svg width="7" height="12">
                            <use xlink:href="#i-chevron-left" href="#i-chevron-left"></use>
                        </svg>
                    </a>

                    <a class="btn btn-primary-inverse btn-round" href="<?=$page[0]['DETAIL_PAGE_URL']?>">
                        <svg width="7" height="12">
                            <use xlink:href="#i-chevron-right" href="#i-chevron-right"></use>
                        </svg>
                    </a>
                <?endif;?>

                <a class="btn btn-primary-inverse" href="/partnery/cases/">Все кейсы</a>
            </div>
          </div>
        </div>
            <div class="bg-block">
          <div class="home-page__form">
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
            </div>
</div>
        </div>

