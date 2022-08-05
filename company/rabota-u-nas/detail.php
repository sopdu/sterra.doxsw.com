<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Награды детальная");

?>
<div class="vacancy-page">
<?$APPLICATION->IncludeComponent("bitrix:breadcrumb", ".default", Array(
		"START_FROM" => "1",
		"PATH" => "",
		"SITE_ID" => SITE_ID,
	),
	false
);?>
<?$APPLICATION->IncludeComponent(
	"bitrix:news.detail",
	"vacancy",
	Array(
		"COMPONENT_TEMPLATE" => "vacancy",
		"IBLOCK_TYPE" => "about",
		"IBLOCK_ID" => "4",
		"ELEMENT_ID" => $_REQUEST["ELEMENT_ID"],
		"ELEMENT_CODE" => $_REQUEST["ELEMENT_CODE"],
		"CHECK_DATES" => "Y",
		"FIELD_CODE" => array(0=>"PREVIEW_PICTURE",1=>"",),
		"PROPERTY_CODE" => array(0=>"MORE_VACANCIES",1=>"",),
		"IBLOCK_URL" => "",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_GROUPS" => "Y",
		"SET_TITLE" => "Y",
		"SET_CANONICAL_URL" => "N",
		"SET_BROWSER_TITLE" => "Y",
		"BROWSER_TITLE" => "-",
		"SET_META_KEYWORDS" => "Y",
		"META_KEYWORDS" => "-",
		"SET_META_DESCRIPTION" => "Y",
		"META_DESCRIPTION" => "-",
		"SET_STATUS_404" => "N",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"ADD_SECTIONS_CHAIN" => "N",
		"ADD_ELEMENT_CHAIN" => "Y",
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"USE_PERMISSIONS" => "N",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"USE_SHARE" => "N",
		"PAGER_TEMPLATE" => "blag",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"PAGER_TITLE" => "Страница",
		"PAGER_SHOW_ALL" => "N"
	)
);?>
</div>
	<div class="vacancy-form" id="vacancy-form">
		<div class="container">
			<div class="vacancy-form__content">
				<div class="vacancy-form__title">Откликнуться на вакансию</div>
				<form class="vacancy-form__element" id="vacant-form" action="/local/ajax/vacancy_pespond.php" type="post" enctype="multipart/form-data">
					<div class="form-field">
						<label class="form-label">ФИО*</label>
						<input class="form-control" type="text" name="name">
					</div>
					<div class="vacancy-form-row">
						<div class="form-field">
							<label class="form-label">Дата рождения*</label>
							<div class="input-with-icon">
								<input class="form-control js-datepicker" type="text" autocomplete="false" name="yearold" placeholder="00.00.0000">
								<svg width="18" height="20">
									<use xlink:href="#i-calendar" href="#i-calendar"></use>
								</svg>
							</div>
						</div>
						<div class="form-field">
							<label class="form-label">Город</label>
							<input class="form-control" type="text" name="city" placeholder="">
						</div>
					</div>
					<div class="vacancy-form-row">
						<div class="form-field">
							<label class="form-label">Email</label>
							<input class="form-control" type="text" name="email" placeholder="">
						</div><span class="separator">Или</span>
						<div class="form-field">
							<label class="form-label">Номер телефона</label>
							<input class="form-control" data-mask="phone" type="text" name="phone" placeholder="+7(___)___-__-__" inputmode="number">
						</div>
					</div>
					<div class="form-field">
						<label class="form-label">Резюме</label>
						<div id="drop-area-uploaded">
							<div class="uploaded-item"><span></span>
								<svg width="10" height="10">
									<use xlink:href="#i-close-icon" href="#i-close-icon"></use>
								</svg>
							</div>
						</div>
						<div id="drop-area">
							<input class="form-control-attachment" id="fileElem" type="file" name="attachment" placeholder="">
							<div class="drop-area-description">Перетяните резюме сюда или выберите файл для загрузки</div>
							<label class="btn btn-primary-inverse" for="fileElem">
								<div class="btn-icon">
									<svg width="18" height="19">
										<use xlink:href="#i-upload-icon" href="#i-upload-icon"></use>
									</svg>
								</div><span>Прикрепить файл</span>
							</label>
						</div>
					</div>
					<div class="form-field">
						<label class="form-label">Сопроводительное письмо</label>
						<textarea class="form-control" name="comment" placeholder="Не более 1000 знаков"></textarea>
					</div>
					<div class="vacancy-form-footer">
						<div class="form-field">
							<label class="checkbox">
								<input id="question-agreement" type="checkbox" name="agreement"><span class="checkbox-box"></span>
								<div class="checkbox-label">Даю согласие на обработку своих персональных данных в соответствии с <a href="#">Политикой обработки персональных данных ООО «С-Терра СиЭсПи»</a>.</div>
							</label>
						</div>
						<button class="btn btn-primary btn-block" type="submit">Отправить</button>
					</div>
				</form>
			</div>
		</div>
	</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>