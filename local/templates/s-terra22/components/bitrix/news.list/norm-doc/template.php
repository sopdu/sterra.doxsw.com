<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);

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

/*echo "<pre>";
print_r($arResult['ITEMS']);
echo "</pre>";*/
?>
<div class="support-documentation-tab-4">
            <div class="support-documentation-tab-4__wrap home-faq">
              <div class="home-faq__accordion">
                <div class="accordion" id="home-faq">
			<?foreach($arResult["ITEMS"] as $arSectItem): //Цикл для вывода категорий?> 
                  <section class="home-faq-item accordion-item">
                    <header class="home-faq-item__header accordion-item-header accordion-trigger">
                      <h2 class="home-faq-item__title"><?echo $arSectItem['NAME']?></h2>
                      <div class="home-faq-item__state"></div>
                    </header>
                    <div class="accordion-item-panel">
				<? foreach($arSectItem['ELEMENTS'] as $arItem): //цикли для элементов?>
						<?if ($arItem["PROPERTIES"]["SSYLKA"]["VALUE"]){?>
						<a target="_blank" class="support-documentation-tab-4__item" href="<?=$arItem["PROPERTIES"]["SSYLKA"]["VALUE"]?>">
							<?}else{?>
						<a target="_blank"  class="support-documentation-tab-4__item" href="<?=CFile::GetPath($arItem["PROPERTIES"]["FILE"]["VALUE"]);?>">
							<?}?>
                            <?
                            if ($arItem['DETAIL_TEXT']) $name = $arItem['DETAIL_TEXT'];
                            else $name = $arItem['NAME']
                            ?>
                        <div class="support-documentation-tab-4__item__title"><?echo $name?></div>
                        <div class="support-documentation-tab-4__item__description"><?=$arItem["PREVIEW_TEXT"]?></div>
						</a>
						<?endforeach;?>
                    </div>
                  </section>
			<?endforeach;?>
                </div>
              </div>
</div>
              </div>