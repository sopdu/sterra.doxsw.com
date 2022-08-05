<?
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/include/feedback/recaptchalib.php");

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

function submit_feedback_form(){
if ((isset($_POST['fio'])) && ($_POST['fio'] != "") && (isset($_POST['email'])) && ($_POST['email'] != "") && (isset($_POST['name_company'])) 
    && ($_POST['name_company'] != "") && (isset($_POST['date'])) && (isset($_POST['case'])) && ($_POST['case'] != "0") 
    && (isset($_POST['dep'])) && ($_POST['dep'] != "0") && (isset($_POST['mark'])) && (isset($_POST['comment'])) && ($_POST['comment'] != "")  ) {

    $captchaPassed = check_recaptcha_in_post();
	if ($captchaPassed == 1){
    	CModule::IncludeModule('iblock');
    	$el = new CIBlockElement;
    	$data = array(
        	'IBLOCK_ID'            => 38,
        	'NAME'                 => $_POST['fio'],
        	'DETAIL_TEXT'          => $_POST['comment'],
        	'PROPERTY_VALUES'      => array(
            	                   'COMPANY_NAME'      => $_POST['name_company'],
            	                   'CASE'              => $_POST['case'],
            	                   'OTHER_CASE'        => $_POST['othercasetext'],
            	                   'DEP'               => $_POST['dep'],
            	                   'DATE'              => $_POST['date'],
            	                   'MARK'              => $_POST['mark'],
            	                   'EMAIL'             => $_POST['email'],
            	                   'WANT_RECEIVE_NEWS' => (!empty($_POST['want_receive_news'])) ? 'Y' : '',
        	                       )
    	);

        if(!$id = $el->Add($data)) $error =  $el->LAST_ERROR;

        $filter = Array("GROUPS_ID"=> array(1));
        $rsUsers = CUser::GetList(($by="personal_country"), ($order="desc"), $filter); 
        $arEmail = array();
    
        while($arUser = $rsUsers->GetNext()){
            $arEmail[] = $arUser['EMAIL'];
        }

        $arEventFields = array(
                        "FIO"                   => $_POST['fio'],
                        "COMPANY_NAME"          => $_POST['name_company'],
                        "DEFAULT_EMAIL_FROM"    => $_POST['email'],
                        "CASE"                  => $_POST['case'],
                        "OTHER_CASE"            => $_POST['othercasetext'],
                        "DEP"                   => $_POST['dep'],
                        "MARK"                  => $_POST['mark'],
                        "DATE"                  => $_POST['date'],
                        "COMMENT"               => $_POST['comment'],
                        "EMAIL"                 => $_POST['email']
        );

        if (!empty($_POST['want_receive_news'])) {
            $arSelect = array("ID", "NAME", "PROPERTY_EMAIL");
            $arFilter = array("IBLOCK_ID"=>42, "ACTIVE"=>"Y", "PROPERTY_EMAIL" => trim($_POST['email']));
            $res = CIBlockElement::GetList(array(), $arFilter, false, array("nPageSize"=>1), $arSelect);
            if ($ob = $res->GetNextElement()) {
            } 
            else {
                $el = new CIBlockElement;
                if (!empty($_POST['fio'])) {
                    $fio = explode(' ',trim($_POST['fio']));
                    if (count($fio)>=3) {
                        $name = $fio[1];
                    } 
                    else {
                        $name = implode(' ',$fio);
                    }
                } 
                else {
                    $name = 'Подпиcчик';
                }

                $data = array(
                        'IBLOCK_ID'         => 42,
                        'NAME'              => $name,
                        'PROPERTY_VALUES'   =>array(
                                            'EMAIL' => $_POST['email'],
                        ),
                );

            if(!$id = $el->Add($data)) $error =  $el->LAST_ERROR;
            }
        }

        CEvent::Send('WORK_MARK', SITE_ID, $arEventFields);
        echo "submitted";
    }
    else {
        echo "wrong_captcha";
    }
}
else print('No data');
}

if (isset($_GET['action'])){
	$action = $_GET['action'];
	switch($action){

		case "submit":
			submit_feedback_form();
			break;	

		default:
			echo "action not defined";	
	}
}
?>