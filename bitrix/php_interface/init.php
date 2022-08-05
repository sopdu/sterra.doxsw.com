<?if(file_exists($_SERVER['DOCUMENT_ROOT']."/bitrix/php_interface/include/constants.php")){
	require_once($_SERVER['DOCUMENT_ROOT']."/bitrix/php_interface/include/constants.php");
}

if(file_exists($_SERVER['DOCUMENT_ROOT']."/bitrix/php_interface/include/function.php")){
	require_once($_SERVER['DOCUMENT_ROOT']."/bitrix/php_interface/include/function.php");
}
/**
AddEventHandler('main', 'OnEpilog', '_Check404Error',1);
function _Check404Error()
{
   if (defined("ERROR_404") && ERROR_404=="Y")
   {
      global $APPLICATION;
    $APPLICATION->RestartBuffer();
    CHTTP::SetStatus("404 Not Found");
	include($_SERVER["DOCUMENT_ROOT"]."/bitrix/templates/404_s-terra/header.php");
   }
}
*/