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
$date = strtotime($arResult['ACTIVE_FROM']);
$this->addExternalJS('/local/templates/s-terra22/plugins/plyr/plyr.js');
$this->addExternalCSS('/local/templates/s-terra22/plugins/plyr/plyr.css');

$APPLICATION->SetTitle(strip_tags($arResult['NAME']));
?>
<div class="container">
            <div class="support-course-item-wrap">
        <div class="support-course-item__content">
				 <div class="support-course-item__title"><?=htmlspecialchars_decode($arResult['NAME'])?></div>
                 <div class="support-course-item__content__video">
                <div class="support-course-item__content__video__wrap">
                    <?if($arResult['PROPERTIES']['YOUTUBE']['VALUE']):?>
                   <div class="support-course-item__content__video__icon">
                        <iframe class="yt-video"  width="853" height="480" src="https://www.youtube.com/embed/<?=$arResult['PROPERTIES']['YOUTUBE']['VALUE']?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                    <?elseif ($arResult['PROPERTIES']['VIDEO']['VALUE']):?>
                     <div class="support-course-item__content__video__icon">
                        <video id="player" playsinline controls <?=$arResult['DETAIL_PICTURE']['SRC'] ? 'data-poster="'.$arResult['DETAIL_PICTURE']['SRC'].'"' : ''?> data-poster="<?$arResult['PREVIEW_PICTURE']?>">
                            <source src="<?=CFile::GetPath($arResult['PROPERTIES']['VIDEO']['VALUE'])?>" type="video/mp4">
                        </video>
                    </div>
                    <?endif;?>
				</div>
                 <?if($arResult['DETAIL_TEXT']):?>
				<div class="support-course-item__content__video__description"><?=$arResult['DETAIL_TEXT']?></div>
                 <?endif;?>
			<div class="support-course-item__content__video__buttons">
                        <?$rs=CIBlockElement::GetList(array("SORT" => "DESC"), array("ACTIVE"=>"Y", "IBLOCK_ID"=>$arResult["IBLOCK_ID"]), false, array("nElementID"=>$arResult["ID"], "nPageSize"=>1), array("ID", "DETAIL_PAGE_URL"));
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
					</div>
                </div>
            </div>
           <div class="support-course-item__side support-course-item__side__video">
				 <div class="support-course-item__side__wrap">
                <div class="support-course-item__side__title mobile">Другие видеоуроки</div>
                <div class="support-course-item__side__video__container">
                    <?
                    $itemsDB = CIBlockElement::GetList(
                        Array('SORT' => 'ASC'),
                        Array('!ID' => $arResult['ID'], 'IBLOCK_ID' => $arResult['IBLOCK_ID']),
                        false,
                        Array('nPageSize' => 3)
                    );
                    while ($arItem = $itemsDB->Fetch()):
                        $date = strtotime($arItem['ACTIVE_FROM'])?>
                   <div class="support-course-item__side__video__item">
						<a class="support-course-item__side__video__item__wrap" href="<?=$arItem['DETAIL_PAGE_URL']?>">
							<div class="support-course-item__side__video__item-image"><img class="pressnews-page__item__image" src="<?=CFile::GetPath($arItem['PREVIEW_PICTURE'])?>"></div>
                            <div class="support-course-item__side__video__item__title"><?=$arItem['NAME']?></div>
                        </a>
						</div>
                    <?endwhile;?>
                </div>
                <a href="/support/education/videouroki/" class="btn btn-primary-inverse support-course-item__side__video__btn">Все видеоуроки</a>
            </div>
        </div>
    </div>
</div>