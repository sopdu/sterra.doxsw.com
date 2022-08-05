<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
IncludeTemplateLangFile(__FILE__);
?>

<div class="clearfix"></div>
		</div>
		<div class="clearfix"></div>

		<p id="back-top"><a href="#top"><span></span></a></p>
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

	<!--<div class="two_four" style="margin-left: 60px;">-->
			<div class="two_four">
					<?$APPLICATION->IncludeComponent("bitrix:main.include", ".default", array(
					"AREA_FILE_SHOW" => "file",
					"PATH" => "/include/include_area/address.php",
					"EDIT_TEMPLATE" => ""
					),
					false
				);?>
				</div>

<!--<div class="four">-->
	<div style="display: block; width: 230px; height: 0px;">
					<p style="margin: 0px;">
					 © ООО «С-Терра СиЭсПи», <?=date("Y")?><br>
					 Все права защищены.</p><br>
		<div class="btnnote" style="margin: 5px 0px 0px 0px; text-decoration: underline; height: 10px;"> 
					Предупреждение об информации на сайте.


		<div class="tooltip">
			Вся информация, представленная на сайте, не является публичной офертой, определяемой положениями <b>Статьи&nbsp;437</b> Гражданского кодекса РФ.<br><br> 
			Компания «С-Терра СиЭсПи» оставляет за собой право вносить изменения в&nbsp;любые материалы, размещенные на сайте, без предварительного уведомления, за исключением случаев, прописанных в иных документах.<br><br>
			Компания «С-Терра СиЭсПи» не несёт ответственности за негативные последствия, включая ущерб или упущенную выгоду, возникшие в&nbsp;результате использования материалов данного сайта.
		</div>
		</div>
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