<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/include/bp-feedback/recaptchalib.php");
$APPLICATION->SetTitle("Запрос на регистрацию на портале технической поддержки");
$APPLICATION->AddHeadScript("/include/support/form-actions.js");
$APPLICATION->SetAdditionalCSS("/include/support/form-styles.css");
$APPLICATION->AddHeadScript("https://www.google.com/recaptcha/api.js");

function check_recaptcha_in_post(){
    $secret = "6LenyCQUAAAAAGTMjxRTSbl7Yk-n0cLfO7XIuDiM";
    $response = null;
    $reCaptcha = new ReCaptcha($secret);
    if ($_POST["g-recaptcha-response"]) {
        $response = $reCaptcha->verifyResponse(
            $_SERVER["REMOTE_ADDR"],
            $_POST["g-recaptcha-response"]
        );
    }
    if ($response != null and $response->success)
        return 1;
    else
        return 0;
}

if(isset($_POST['submit'])):

	$captchaPassed = check_recaptcha_in_post();
	if ($captchaPassed == 1 && isset($_POST['processing']) && $_POST['processing'] == 'yes'){

	$filter = Array("GROUPS_ID"=> array(1));
	$rsUsers = CUser::GetList(($by="personal_country"), ($order="desc"), $filter); 
	$arEmail = array();

	while($arUser = $rsUsers->GetNext()){
	
		$arEmail[] = $arUser['EMAIL'];
	}

	$arEventFields = array(
		"FIO"      			  => $_POST['fio'],
		"NAME_COMPANY"  	  => $_POST['name_company'],
		"DEFAULT_EMAIL_FROM"  => $_POST['email'],
		"POSITION"	  		  => $_POST['your_position'],
		"PHONE"	  			  => $_POST['phone'],	
		"COMMENT" 			  => $_POST['comment'],
		"NUMBER_LICENCE"	  => $_POST['number_lic'],
	);

CEvent::Send('Request_for_service_support', SITE_ID, $arEventFields);
	echo "<p style=\"color: green;text-align: center\">Ваша заявка успешно отправлена!</p>";

};

else:
?><?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	".default",
	Array(
		"AREA_FILE_SHOW" => "file",
		"PATH" => "/include/static_page/send_query.php",
		"EDIT_TEMPLATE" => ""
	),
true
);?>
<div class="twelve right pageform soft-grey atcivation">
	<h3>Заполните, пожалуйста, анкету:</h3>
	<p>
		 Обратите внимание, что все поля являются обязательными для заполнения.
	</p>
	<form name="support" action="<?=$_SERVER['PHP_SELF']?>" method="post" class="pageform-container">
		<div class="unit">
 <label> <span class="sparkl">*</span>Фамилия, Имя, Отчество </label><br>
 <input id="ssurnamename" name="fio" type="text" class="need-valid" onkeyup="checkParams()"><br>
			<p class="error invis">
				 Поле пустое
			</p>
			<p class="mesage">
				 Например Смирнов Петр Ильич
			</p>
		</div>
		<div class="unit">
 <label> <span class="sparkl">*</span>Название компании </label><br>
 <input id="sorgname" name="name_company" type="text" class="need-valid" onkeyup="checkParams()"><br>
			<p class="error invis">
				 Поле пустое
			</p>
			<p class="mesage">
				 Например: ООО «Альфа»
			</p>
		</div>
		<div class="unit">
 <label> <span class="sparkl">*</span>Занимаемая должность </label><br>
 <input id="sposemp" name="your_position" type="text" class="need-valid" onkeyup="checkParams()"><br>
			<p class="error invis">
				 Поле пустое
			</p>
			<p class="mesage">
				 Например IT Директор
			</p>
		</div>
		<div class="unit">
 <label> <span class="sparkl">*</span>Контактный телефон </label><br>
 <input id="sphonenumber" name="phone" type="text" class="need-valid" onkeyup="checkParams()"><br>
			<p class="error invis">
				Введите номер телефона
			</p>
			<p class="mesage">
				 Например +7-(909)-000-00-00
			</p>
		</div>
		<div class="unit">
 <label> <span class="sparkl">*</span>Адрес электронной почты</label><br>
 <input id="semail-from" name="email" type="text" class="need-valid" onkeyup="checkParams()"><br>
			<p class="error invis">
				 Введен неверный адрес, введите <br>
				 в формате myemail@example.com
			</p>
			<p class="mesage">
				 Например myemail@example.com
			</p>
		</div>
		<div class="unit">
 <label> <span class="sparkl">*</span>Номер лицензии </label><br>
 <input id="slicensenumber" name="number_lic" type="text" class="need-valid" onkeyup="checkParams()"><br>
			<p class="error invis">
				Пустое поле 
			</p>
			<p class="mesage">
			</p>
		</div>
		<div class="unit">
			 <label> <span class="sparkl"></span>Дополнительная информация </label><br>
			 <textarea name="comment" class="textareaStatPartnerom"></textarea>
		</div>

		<div class="clearfix"></div>
<div class="unit">
            <input type="checkbox" name="processing" id="codabra-processing" class="codabra-elements" value="yes" onChange="checkParams();">
			<label for="codabra-processing">
				Даю согласие на обработку своих персональных данных в&nbsp;соответствии<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;с&nbsp;<a title="Скачать документ" href="/upload/medialibrary/6c7/politika_obrabotki_personal_dannyh_sterra_29-11-2019.pdf" target="_blank">Политикой обработки персональных данных ООО «С-Терра СиЭсПи»</a>.</label>
        </div>
        <div class="clearfix"></div>
        </br>

        <div class="unit">
			<div class="g-recaptcha" data-sitekey="6LenyCQUAAAAANk2CfCd23N-hwAw3n7C93xoBjKs" data-callback="checkParams"></div>
		</div>

		<div class="clearfix"></div>
			<div class="position">
				 <input type="submit" name="submit" id="submit" class="blue icons" value="Отправить заявку" disabled>
			</div>
	</form>
</div>


 <!-- Pikadate -->
 <script src="<?=SITE_TEMPLATE_PATH?>/lib/picker.js"></script> 
<script src="<?=SITE_TEMPLATE_PATH?>/lib/picker.date.js"></script>
 <script src="<?=SITE_TEMPLATE_PATH?>/lib/picker.time.js"></script>
 <script src="<?=SITE_TEMPLATE_PATH?>/demo/scripts/demo.js"></script>

<link type="style/css" rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/lib/themes/default.css">
<link type="style/css" rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/lib/themes/default.date.css">

<?endif?>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
