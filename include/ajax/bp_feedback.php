<?
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/include/bp-feedback/recaptchalib.php");

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

function submit_bp_feedback_form(){
if (isset($_POST['fio'])){

    $captchaPassed = check_recaptcha_in_post();
	if ($captchaPassed == 1){
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

        if(!$id = $el->Add($data)) $error =  $el->LAST_ERROR;

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
		echo "submitted";
	} else {
		echo "wrong captcha";
	}
}
else print('No data');
}

if (isset($_GET['action'])){
	$action = $_GET['action'];
	switch($action){

		case "submit":
			submit_bp_feedback_form();
			break;	

		default:
			echo "action not defined";	
	}
}
?>