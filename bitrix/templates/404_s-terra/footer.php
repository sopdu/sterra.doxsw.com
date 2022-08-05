<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
IncludeTemplateLangFile(__FILE__);
?>

<div class="clearfix"></div>
		</div>
		<div class="clearfix"></div>

		<p id="back-top"><a href="#top"></a></p>
		<footer>
			<div id="footer" class="full soft-grey">
<div id="footer-bottom" class="kilo">

				<?$APPLICATION->IncludeComponent("bitrix:main.include", ".default", array(
					"AREA_FILE_SHOW" => "file",
					"PATH" => "/include/include_area/footer_logo.php",
					"EDIT_TEMPLATE" => ""
					),
					false
				);?>

	<div class="two_four" style="margin-left: 60px;">
					<?$APPLICATION->IncludeComponent("bitrix:main.include", ".default", array(
					"AREA_FILE_SHOW" => "file",
					"PATH" => "/include/include_area/address.php",
					"EDIT_TEMPLATE" => ""
					),
					false
				);?>
				</div>

				<div class="four">
					<p class="right">
					 © ООО «С-Терра СиЭсПи», <?=date("Y")?><br>
					 Все права защищены.
					</p>
				</div>

				<div class="clearfix"></div>
				<br />

			</div>


			<div class="clearfix"></div>
		</footer>
	</body>
</html>
<?
$meta_keywords =$APPLICATION->GetPageProperty("keywords");
if (!strlen($meta_keywords)>0)
	$APPLICATION->SetPageProperty("keywords",$APPLICATION->GetTitle() );
$meta_keywords =$APPLICATION->GetPageProperty("description");
if (!strlen($meta_keywords)>0)
	$APPLICATION->SetPageProperty("description",$APPLICATION->GetTitle());
?>