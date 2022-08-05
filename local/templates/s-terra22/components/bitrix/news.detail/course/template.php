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
$APPLICATION->SetTitle($arResult["NAME"]);
?>
        <div class="support-course-item support-course-item-2">
          <div class="container">
            <div class="support-course-item-wrap">
              <div class="support-course-item__content">
                <div class="support-course-item__title"><?=$arResult["NAME"]?></div>
                <div class="support-course-item__blocks">
                  <div class="support-course-item__blocks__col">
                    <div class="support-course-item__block">
                      <div class="support-course-item__block__title">Место</div>
                      <div class="support-course-item__block__value"><?=$arResult["PROPERTIES"]["site"]["~VALUE"]?></div>
                    </div>
                    <div class="support-course-item__block">
                      <div class="support-course-item__block__title">Тренеры</div>
                      <div class="support-course-item__block__value"><?=$arResult["PROPERTIES"]["trener"]["VALUE"]?></div>
                    </div>
                    <div class="support-course-item__block">
                      <div class="support-course-item__block__title">Документ</div>
                      <div class="support-course-item__block__value"><?=$arResult["PROPERTIES"]["doc"]["VALUE"]?></div>
                    </div>
                  </div>
                  <div class="support-course-item__blocks__col">
                    <div class="support-course-item__block">
                      <div class="support-course-item__block__title">Длительность</div>
                      <div class="support-course-item__block__value"><?=$arResult["PROPERTIES"]["dlitelnost"]["VALUE"]?></div>
                    </div>
                      <?if($arResult["PROPERTIES"]["chena"]["VALUE"]):?>
                    <div class="support-course-item__block">
                      <div class="support-course-item__block__title">Стоимость участия 1 человека</div>
                      <div class="support-course-item__block__value"><?=$arResult["PROPERTIES"]["chena"]["VALUE"]?> ₽</div>
                    </div>
                      <?endif?>
                  </div>
                </div>
                  <?if($arResult['DETAIL_TEXT']):?>
                <div class="support-course-item__attention"><?=$arResult['DETAIL_TEXT']?></div>
                  <?endif;?>
                <div class="support-course-item__buttons"><a class="btn btn-primary btn-lg anchor" href="#vacancy-form">Записаться на курс</a>
					<?if($arResult["PROPERTIES"]["file"]["VALUE"]){?>
				<a target="_ blank" href="<?=CFile::GetPath($arResult["PROPERTIES"]["file"]["VALUE"]);?>" class="btn btn-primary-inverse btn-lg">
                    <svg class="btn-icon desktop">
                      <use href="/local/templates/s-terra22/images/icons/icon-sprite.svg#download-arrow"></use>
                    </svg>
                    <svg class="btn-icon mobile">
                      <use href="/local/templates/s-terra22/images/icons/icon-sprite.svg#download-arrow-mobile"></use>
                    </svg><span>Программа</span>
                  </a>
					<?}else{?>
					 <a target="_ blank" href="<?=$arResult["PROPERTIES"]["ssylka"]["VALUE"]?>" class="btn btn-primary-inverse btn-lg">
                    <svg class="btn-icon desktop">
                      <use href="/local/templates/s-terra22/images/icons/icon-sprite.svg#links-icon"></use>
                    </svg>
                    <svg class="btn-icon mobile">
                      <use href="/local/templates/s-terra22/images/icons/icon-sprite.svg#links-icon"></use>
                    </svg><span>Программа</span>
                  </a>
					<?}?>
                </div>
                <div class="support-course-item__list">
                  <div class="support-course-item__list__title">Слушателям для успешного участия в семинаре необходимо:</div>
                  <ul>
					  <?foreach($arResult["PROPERTIES"]["slysha_neobhodimo"]["VALUE"] as $slysha_neobhodimo){?>
                    <li><?=$slysha_neobhodimo?></li>
					  <?}?>
                  </ul>
					<a href="/support/education/courses/" class="btn btn-primary-inverse support-course-item__list__btn">К списку курсов</a>
                </div>
              </div>
              <div class="support-course-item__side">
                <div class="support-course-item__side__wrap">
                  <div class="support-course-item__side__title">Другие курсы</div>
                  <div class="support-course-item__side__container">

					  <?foreach ($arResult["MORE"] as $arItem):?>
					<a class="support-course-item__side__item" href="<?=$arItem['REF']?>">
                      <div class="support-course-item__side__item__text"><?=htmlspecialchars_decode($arItem["NAME"])?></div></a>
					<?endforeach;?>
                  <a href="/support/education/courses/" class="btn btn-primary-inverse support-course-item__side__btn">Все курсы</a>
                </div>
              </div>
            </div>
          </div>
        </div>




        <div class="vacancy-form" id="vacancy-form">
                <div class="container">
                    <div class="vacancy-form__content">
                        <div class="vacancy-form__title">Записаться на курс</div>
                        <form class="vacancy-form__element" id="vacant-form" action="/local/ajax/course.php" type="post" enctype="multipart/form-data">
                            <div class="form-field">
                                <label class="form-label">ФИО*</label>
                                <input class="form-control" type="text" name="name">
                            </div>
                            <div class="form-field">
                                <label class="form-label">Название компании*</label>
                                <input class="form-control" type="text" name="company">
                            </div>
                            <div class="vacancy-form-row">
                                <div class="form-field">
                                    <label class="form-label">Email*</label>
                                    <input class="form-control" type="text" name="email" placeholder="">
                                </div>
                                <div class="form-field">
                                    <label class="form-label">Номер телефона</label>
                                    <input class="form-control" data-mask="phone" type="text" name="phone" placeholder="+7(___)___-__-__" inputmode="number">
                                </div>
                            </div>
                            <div class="form-field">
                                <label class="form-label">Название курса</label>
                                <div class="custom-select">

                                    <select>
                                        <option value="0">Курс</option>
                                        <?
                                        $arSelect = Array("ID", "IBLOCK_ID", "NAME");//IBLOCK_ID и ID обязательно должны быть указаны, см. описание arSelectFields выше
                                        $arFilter = Array("IBLOCK_ID"=>23, "ACTIVE"=>"Y");
                                        $res = CIBlockElement::GetList(Array("SORT"=> "ASC"), $arFilter, false, Array("nPageSize"=>50), $arSelect);
                                        while($ob = $res->GetNextElement()){
                                            $arFields = $ob->GetFields();
                                            $arFields["NAME"] = htmlspecialchars_decode($arFields["NAME"]);
                                            ?>
                                            <option <?= ($arFields['NAME'] == $arResult['NAME']) ? 'selected' : ''?> <?=$arFields['NAME']?></option>
                                        <?}?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-field">
                                <label class="form-label">Комментарий</label>
                                <textarea class="form-control" name="comment" placeholder=""></textarea>
                            </div>
                            <div class="vacancy-form-footer">
                                <div class="form-field">
                                    <label class="checkbox">
                                        <input id="question-agreement" type="checkbox" name="agreement"><span class="checkbox-box"></span>
                                        <div class="checkbox-label">Даю согласие на обработку своих персональных данных в соответствии с <a target="_blank" href="/upload/medialibrary/6c7/politika_obrabotki_personal_dannyh_sterra_29-11-2019.pdf">Политикой обработки персональных данных ООО «С-Терра СиЭсПи»</a>.</div>
                                    </label>
                                </div>
                                <button class="btn btn-primary btn-lg btn-block" type="submit">Отправить</button>
                            </div>
                        </form>
                    </div>
                </div>
        </div>