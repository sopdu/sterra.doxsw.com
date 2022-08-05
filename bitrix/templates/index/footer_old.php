<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
IncludeTemplateLangFile(__FILE__);
?>







<div class="clearfix"></div>
		</div>
		<div class="clearfix"></div>
		
		<p id="back-top"><a href="#top"><span></span></a></p>
		<footer>
			<div id="footer" class="full soft-grey">
				<?$APPLICATION->IncludeComponent(
					"bitrix:menu",
					"bottom_menu",
					Array(
						"ROOT_MENU_TYPE" => "bottom",
						"MENU_CACHE_TYPE" => "N",
						"MENU_CACHE_TIME" => "3600",
						"MENU_CACHE_USE_GROUPS" => "Y",
						"MENU_CACHE_GET_VARS" => array(),
						"MAX_LEVEL" => "2",
						"CHILD_MENU_TYPE" => "left",
						"USE_EXT" => "N",
						"DELAY" => "N",
						"ALLOW_MULTI_SELECT" => "N"
					)
				);?>
				
				<div class="clearfix"></div>
				
				<br />
			</div>
				
				
			<div id="footer-bottom" class="kilo">
				<?$APPLICATION->IncludeComponent("bitrix:main.include", ".default", array(
					"AREA_FILE_SHOW" => "file",
					"PATH" => "/include/include_area/footer_logo.php",
					"EDIT_TEMPLATE" => ""
					),
					false
				);?>
				<div class="two_four">
					<?$APPLICATION->IncludeComponent("bitrix:main.include", ".default", array(
					"AREA_FILE_SHOW" => "file",
					"PATH" => "/include/include_area/address.php",
					"EDIT_TEMPLATE" => ""
					),
					false
				);?>
				</div>
								


				
				<div class="four">
				<?$APPLICATION->IncludeComponent("bitrix:main.include", ".default", array(
					"AREA_FILE_SHOW" => "file",
					"PATH" => "/include/include_area/dependent.php",
					"EDIT_TEMPLATE" => ""
					),
					false
				);?>
				</div>
				

				
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