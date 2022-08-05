<?
include_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/classes/general/captcha.php");
$cpt1 = new CCaptcha();
$captchaPass1 = COption::GetOptionString("main", "captcha_password", "");
if(strlen($captchaPass1) <= 0){
    $captchaPass = randString(10);
    COption::SetOptionString("main", "captcha_password", $captchaPass1);
}
$cpt1->SetCodeCrypt($captchaPass1);
?>