<?php
CModule::AddAutoloadClasses(
    '',
    [
        'captcha'   =>  '/local/classes/captcha.php',
        'sopdu'     =>  '/local/classes/sopdu.php'
    ]
);

function my_onBeforeResultAdd($WEB_FORM_ID, &$arFields, &$arrVALUES)
{
    global $APPLICATION;

    if ($_REQUEST['g-recaptcha-response']) {
        $httpClient = new \Bitrix\Main\Web\HttpClient;
        $result = $httpClient->post(
            'https://www.google.com/recaptcha/api/siteverify',
            array(
                'secret' => '6Lf9sVYhAAAAAG7kYaVhCf3PstmdWhxa_HKBOgqE',
                'secret' => '6Lf9sVYhAAAAAG7kYaVhCf3PstmdWhxa_HKBOgqE',
                'response' => $_REQUEST['g-recaptcha-response'],
                'remoteip' => $_SERVER['HTTP_X_REAL_IP']
            )
        );
        $result = json_decode($result, true);
        if ($result['success'] !== true) {
            $APPLICATION->throwException("Вы не прошли проверку");
            return false;
        }
    } else {
        $APPLICATION->ThrowException('Вы не прошли проверку');
        return false;
    }
}

AddEventHandler('form', 'onBeforeResultAdd', 'my_onBeforeResultAdd');