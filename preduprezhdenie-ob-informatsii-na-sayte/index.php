<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Предупреждение об информации на сайте");
?>
<div class="attention-page page-main">
	<?$APPLICATION->IncludeComponent("bitrix:breadcrumb", ".default", Array(
        "START_FROM" => "1",
        "PATH" => "",
        "SITE_ID" => SITE_ID,
    ),
        false
    );?>
        <div class="container">
          <div class="text-container">
            <div class="attention-page-title">Предупреждение об информации на сайте</div>
            <div class="attention-page-content">
<?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"contacts",
	Array(
		"AREA_FILE_SHOW" => "file",
		"AREA_FILE_SUFFIX" => "inc",
		"EDIT_TEMPLATE" => "",
		"PATH" => "/include/static_page/preduprezhdenie_ob_informatsii_na_sayte.php"
	)
);?>
          </div>
        </div>
      </div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>