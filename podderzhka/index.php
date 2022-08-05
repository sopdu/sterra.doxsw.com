<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Поддержка");
?><div class="twelve right article productions textet">
	<h1><?=$APPLICATION->GetTitle();?></h1>
	 <?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	Array(
		"AREA_FILE_SHOW" => "file",
		"AREA_FILE_SUFFIX" => "inc",
		"EDIT_TEMPLATE" => "",
		"PATH" => "/include/static_page/podderzhka.php"
	)
);?>
</div>
</div><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>