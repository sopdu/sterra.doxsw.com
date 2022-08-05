<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Стать партнером");

if(isset($_POST['submit'])):


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
		"DEFAULT_EMAIL_FROM"  => 'ssv@iesa.ru',//$arEmail,
		"POSITION"	  		  => $_POST['your_position'],
		"PHONE"	  			  => $_POST['phone'],	
		"COMMENT" 			  => $_POST['comment'],
		"EMAIL"				  => $_POST['email'],
		"FILE"				  => $file		
	);

	CEvent::Send('BECOME_PARTNER', SITE_ID, $arEventFields);
	echo "<p style=\"color: green;text-align: center\">Ваша заявка успешна отправлена!</p>";
else:
?>

<?$APPLICATION->IncludeComponent("bitrix:main.include", ".default", array(
	"AREA_FILE_SHOW" => "file",
	"PATH" => "/include/become_partner.php",
	"EDIT_TEMPLATE" => ""
	),
	false
);?>
<br />

<div class="twelve right pageform soft-grey  atcivation">	
	<h3>Стать партнером</h3>
	<p>Обратите внимание, что все поля являются обязательными для заполнения.</p>

	
	<form enctype="multipart/form-data" name="activation" action="<?=$_SERVER['PHP_SELF']?>" method="POST" class="pageform-container" id="form">
		
		<div class="unit">
			<label>
				<span class="sparkl">*</span>ФИО
			</label><br />
			<input id="valid-lic"  name="fio" type="text" class="need-valid" /><br />
			<p class="error invis">Поле пустое</p>
			<p class="mesage">Например Смирнов Петр Ильич</p>
		</div>
		
		
		<div class="unit">
			<label>
				<span class="sparkl">*</span>Название компании 
			</label><br />
			<input id="valid-org" name="name_company" type="text" class="need-valid" /><br />
			<p class="error invis">Поле пустое</p>
			<p class="mesage">Например: ООО «Альфа»</p>
		</div>
		
		
		<div class="unit">
			<label>
				<span class="sparkl">*</span>Ваша должность 
			</label><br />
			<input id="valid-ser" name="your_position" type="text" class="need-valid" /><br />
			<p class="error invis">Поле пустое</p>
			<p class="mesage">Например IT Директор</p>
		</div>
		
		
		<div class="unit">
			<label>
				<span class="sparkl">*</span>Телефон
			</label><br />
			<input id="phone" name="phone" type="text" class="need-valid" /><br />
			<p class="error invis">Поле пустое</p>
			<p class="mesage">Например 8-(909)-000-00-00</p>
		</div>
		
		<div class="unit">
			<label>
				<span class="sparkl">*</span>Email
			</label><br />
			<input id="email" name="email" type="text" class="need-valid" /><br />
			<p class="error invis">Введен неверный еmail, введите
			<br />
			в формате myemail@gmail.com</p>	
			<p class="mesage">Например myemail@gmail.com</p>
		</div>
		
		<div class="unit">
			<label>
				<span class="sparkl">*</span>Копия лицензии ФСБ
			</label><br />
			<input type="file" name="FILE" style="margin-top:8px;">	<br />
			<p class="mesage"></p>	
		</div>


		<div class="unit">
			<label>
				<span class="sparkl"></span>Дополнительная информация
			</label><br />
			<textarea name="comment" rows="5" cols="34" ></textarea>		
		</div>
	


		
		<div class="clearfix"></div>
		
		
			<div class="position">
				<input type="submit" name="submit" class="blue icons" value="Отправить заявку"/>	
			</div>
		
	</form>		
	
</div>		

<!-- Pikadate -->
<script src="<?=SITE_TEMPLATE_PATH?>/lib/picker.js"></script>
<script src="<?=SITE_TEMPLATE_PATH?>/lib/picker.date.js"></script>
<script src="<?=SITE_TEMPLATE_PATH?>/lib/picker.time.js"></script>
<script src="<?=SITE_TEMPLATE_PATH?>/demo/scripts/demo.js"></script>
<link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/demo/styles/css/main.css">
<link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/lib/themes/default.css" id="theme_base">
<link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/lib/themes/default.date.css" id="theme_date"> 

</div>
<?endif?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
