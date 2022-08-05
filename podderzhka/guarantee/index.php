<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/submebuSecondLevelAsThirdForOther.css", true);
$APPLICATION->SetTitle("Гарантийное обслуживание");
?><div class="twelve right article">
	<h1><?=$APPLICATION->GetTitle();?></h1>
	 <?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	Array(
		"AREA_FILE_SHOW" => "file",
		"AREA_FILE_SUFFIX" => "inc",
		"EDIT_TEMPLATE" => "",
		"PATH" => "/include/static_page/guarantee.php"
	)
);?>
</div>
</div><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>