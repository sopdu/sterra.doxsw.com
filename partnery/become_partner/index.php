<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/include/bp-feedback/recaptchalib.php");
$APPLICATION->SetTitle("Стать партнером");
$APPLICATION->SetAdditionalCSS("/include/bp-feedback/form-styles.css");
$APPLICATION->AddHeadScript("/include/bp-feedback/form-actions.js");
//$APPLICATION->AddHeadScript("/include/bp-feedback/refreshcaptcha.js");
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
if(isset($_POST['fio'])){

	$captchaPassed = check_recaptcha_in_post();
	if ($captchaPassed == 1 && isset($_POST['processing']) && $_POST['processing'] == 'yes'){
		CModule::IncludeModule('iblock');
		$el = new CIBlockElement;
		$data = array(
			'IBLOCK_ID'      => 33,
			'NAME' => $_POST['fio'],
			'DETAIL_TEXT' => $_POST['comment'],
			'PROPERTY_VALUES' => array(
				'COMPANY_NAME'=> $_POST['name_company'],
				'JOB'		  => $_POST['your_position'],
				'PHONE'		  => $_POST['phone'],
				'EMAIL'		  => $_POST['email'],
				'FILE'        => $_FILES['FILE']
			)
		);

		if(!$id = $el->Add($data))
		  $error =  $el->LAST_ERROR;


		$arFilter = Array("IBLOCK_ID"=>33, "ID"=>$id);
		$file = CIBlockElement::GetList(array(), $arFilter, false, false,array('PROPERTY_FILE'))->GetNext();

		$file = CFile::GetPath($file["PROPERTY_FILE_VALUE"]);

	

		$filter = Array("GROUPS_ID"=> array(1));
		$rsUsers = CUser::GetList(($by="personal_country"), ($order="desc"), $filter); 
		$arEmail = array();
	
		while($arUser = $rsUsers->GetNext()){
	
			$arEmail[] = $arUser['EMAIL'];
		}

		$arEventFields = array(
			"FIO"      			  => $_POST['fio'],
			"NAME_COMPANY"  	  => $_POST['name_company'],
			"DEFAULT_EMAIL_FROM"  => $_POST['email'],//$arEmail,
			"POSITION"	  		  => $_POST['your_position'],
			"PHONE"	  			  => $_POST['phone'],	
			"COMMENT" 			  => $_POST['comment'],
			"EMAIL"				  => $_POST['email'],
			"FILE"				  => $file		
		);
	
		CEvent::Send('BECOME_PARTNER', SITE_ID, $arEventFields);
		echo "<p style=\"color: green;text-align: center\">Ваша заявка успешно отправлена!</p>";
	}
	else {
		echo "<p style=\"color: green;text-align: center\">Неверное значение reCaptcha!</p>";
	}
}
?>



<?$APPLICATION->IncludeComponent("bitrix:main.include", ".default", array(
	"AREA_FILE_SHOW" => "file",
	"PATH" => "/include/become_partner.php",
	"EDIT_TEMPLATE" => ""
	),
	false
);?>

<div class="twelve right pageform soft-grey  atcivation">	
	<h3><?=$APPLICATION->GetTitle();?></h3>
	<p>Обратите внимание, что все поля являются обязательными для заполнения.<br><br></p>

	
	<form enctype="multipart/form-data" name="activation" action="/partnery/become_partner/index.php" method="POST" class="pageform-container">

		<div class="unit">
			<label>
				<span class="sparkl">*</span>Фамилия, Имя, Отчество
			</label><br />
			<input id="valid-lic"  name="fio" type="text" class="need-valid"  onkeyup="checkParams()"/><br />
			<p class="error invis">Поле пустое</p>
			<p class="mesage">Например Смирнов Петр Ильич</p>
		</div>


		<div class="unit">
			<label>
				<span class="sparkl">*</span>Название компании 
			</label><br />
			<input id="valid-org" name="name_company" type="text" class="need-valid"  onkeyup="checkParams()"/><br />
			<p class="error invis">Поле пустое</p>
			<p class="mesage">Например: ООО «Альфа»</p>
		</div>


		<div class="unit">
			<label>
				<span class="sparkl">*</span>Занимаемая должность 
			</label><br />
			<input id="valid-ser" name="your_position" type="text" class="need-valid" onkeyup="checkParams()" /><br />
			<p class="error invis">Поле пустое</p>
			<p class="mesage">Например IT Директор</p>
		</div>
		
		
		<div class="unit">
			<label>
				<span class="sparkl">*</span>Телефон
			</label><br />
			<input id="phone" name="phone" type="text" class="need-valid" onchange="checkParams()" /><br />
			<p class="error invis">Поле пустое</p>
			<p class="mesage">Например +7-(909)-000-00-00</p>
		</div>
		
		<div class="unit">
			<label>
				<span class="sparkl">*</span>Адрес электронной почты
			</label><br />
			<input id="email" name="email" type="text" class="need-valid" onchange="checkParams()" /><br />
			<p class="error invis">Введен неверный еmail, введите
			<br />
			в формате myemail@gmail.com</p>	
			<p class="mesage">Например myemail@gmail.com</p>
		</div>
		
		<div class="unit">
			<label>
				<span class="sparkl">*</span>Копия лицензии ФСБ
			</label><br />
			<input class="need-valid" type="file"  id="fsbFile" name="FILE" style="margin-top:8px;" onchange="checkParams()">	<br />
			<p class="error invis">Необходимо загрузить файл с лицензией</p>	
			<p class="mesage"></p>	
		</div>


		<div class="unit">
			<label>
				<span class="sparkl"></span>Дополнительная информация
			</label><br />
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
				<input type="submit" name="submit" class="blue icons" id="submit-bp-button" value="Отправить заявку" disabled/>	
			</div>
		
	</form>		

</div>		

<!-- Pikadate -->
<script src="<?=SITE_TEMPLATE_PATH?>/lib/picker.js"></script>
<script src="<?=SITE_TEMPLATE_PATH?>/lib/picker.date.js"></script>
<script src="<?=SITE_TEMPLATE_PATH?>/lib/picker.time.js"></script>
<script src="<?=SITE_TEMPLATE_PATH?>/demo/scripts/demo.js"></script>
<!--link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/demo/styles/css/main.css"-->
<link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/lib/themes/default.css" id="theme_base">
<link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/lib/themes/default.date.css" id="theme_date"> 

</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
