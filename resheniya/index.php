<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Решения");
?>

<?
LocalRedirect("/resheniya/industry_solutions/index.php");
?>

<!--
<div class="twelve right article productions text-page">
	<h1><?=$APPLICATION->GetTitle();?></h1>
	 <?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	Array(
		"AREA_FILE_SHOW" => "file",
		"AREA_FILE_SUFFIX" => "inc",
		"EDIT_TEMPLATE" => "",
		"PATH" => "/include/static_page/resheniya.php"
	)
);?>
</div>
-->

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>