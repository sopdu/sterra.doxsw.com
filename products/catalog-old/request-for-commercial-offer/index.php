<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/include/bp-feedback/recaptchalib.php");
$APPLICATION->SetTitle("Заявка на персональное предложение");
$APPLICATION->AddHeadScript("/include/support/form-actions.js");
$APPLICATION->AddHeadScript("/include/support/header-actions.js");
$APPLICATION->SetAdditionalCSS("/include/support/form-styles.css");
$APPLICATION->AddHeadScript("https://www.google.com/recaptcha/api.js");

function callAPI($data = false){
	$ob = new CHTTP();
	$ob->SetAuthBasic("RequestUser", "fg67ujkl90as");
	$ob->setFollowRedirect(false);
	$strQueryText = $ob->Post("http://1cweb.s-terra.com/CA_test/hs/csp/Request1C", json_encode($data));
	if (strlen($strQueryText)<=0 || strpos($strQueryText, "401") !== false)
		return "Ошибка выполнения запроса.";
	else{
	   $resArray = json_decode($strQueryText, true);
		return $resArray["Ответ"];
	}
}

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

if(isset($_POST['submit'])){
	$offerName = $_POST['offerName'];
	$offerLink = $_POST['offerLink'];
}
else if (isset($_GET["name"])){
	$offerName = urldecode($_GET["name"]);
	$offerLink = "/products/catalog/".$_GET["offer"]."/";
}
else {
	$offerName = "С-Терра Шлюз, версия 4.3";
	$offerLink = "/products/catalog/s-terra-shlyuz-4-3/";
}

$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	".default",
	Array(
		"AREA_FILE_SHOW" => "file",
		"PATH" => "/include/static_page/request_for_commercial_offer.php",
		"EDIT_TEMPLATE" => "",
		"OFFER_NAME" => $offerName,
		"OFFER_LINK" => $offerLink
	),
true
);
if(isset($_POST['submit'])):

	$captchaPassed = check_recaptcha_in_post();
	if ($captchaPassed == 1 && isset($_POST['processing']) && $_POST['processing'] == 'yes'){

	$arEventFields = array(
		"Тема" => $offerName,
		"ФИО" => $_POST['fio'],
		"НазваниеКомпании" => $_POST['name_company'],
		"Почта" => $_POST['email'],
		"Телефон" => $_POST['phone'],
		"Описание" => $_POST['comment'],
	);
?>
<div class="twelve right article form_post_res" style="margin-bottom: 30px; color: #e42d24;"><?=callAPI($arEventFields)?></div>
<?
};
endif;
?>
<div class="twelve right pageform soft-grey atcivation">
	<h3>Заполните, пожалуйста, форму:</h3>
<br>
	<form name="support" action="<?=$_SERVER['PHP_SELF']?>" method="post" class="pageform-container">
<input id="slicensenumber" type="text" value="1" style="display: none;" readonly>
<input id="sposemp" type="text" value="1" style="display: none;" readonly>
<input id="offer-name" name="offerName" type="text" value="<?=$offerName?>" style="display: none;" readonly>
<input id="offer-link" name="offerLink" type="text" value="<?=$offerLink?>" style="display: none;" readonly>
	<!--input id="theme" name="theme" type="text" readonly style="display: none;" value-->
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
			 <label> <span class="sparkl"></span>Краткое описание задачи</label><br>
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

</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>