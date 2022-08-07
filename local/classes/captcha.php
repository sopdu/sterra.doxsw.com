<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/classes/general/captcha.php");

class captcha {
    /*
    private function ccaptha($captchaPass = ''){
        $cap = new CCaptcha();
        return $cap->SetCodeCrypt($captchaPass);
    }
    public function main(){
        $captchaPass = COption::GetOptionString("main", "captcha_password", "");
        if(strlen($captchaPass) <= 0){
            $captchaPass = randString(10);
            COption::SetOptionString("main", "captcha_password", $captchaPass);
        }
        return $this->ccaptha($captchaPass);
    }
    */
    public function main(){
        include_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/classes/general/captcha.php");
        $cpt = new CCaptcha();
        $captchaPass = COption::GetOptionString("main", "captcha_password", "");
        if(strlen($captchaPass) <= 0){
            $captchaPass = randString(10);
            COption::SetOptionString("main", "captcha_password", $captchaPass);
        }
        return $cpt->SetCodeCrypt($captchaPass);
    }
}