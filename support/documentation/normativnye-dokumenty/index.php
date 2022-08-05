<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/submebuSecondLevelAsThirdForOther.css", true);
$APPLICATION->SetTitle("Нормативные документы");
?><!--<div class="twelve right article">
	<h1>Нормативные документы</h1>
 <br>
	<hr>
	<h2>Законы РФ</h2>
	<ul>
                <li><a target="_blank" href="https://rg.ru/2017/07/31/bezopasnost-dok.html">ФЗ РФ от 26.07.2017 № 187-ФЗ</a> «О безопасности критической информационной инфраструктуры Российской Федерации»</li>
		<li><a target="_blank" href="http://www.rg.ru/2011/05/06/license-dok.html">ФЗ РФ от 04.05.2011 № 99-ФЗ</a> «О лицензировании отдельных видов деятельности»</li>
		<li><a target="_blank" href="http://www.rg.ru/2006/07/29/personaljnye-dannye-dok.html">ФЗ РФ от 27.07.2006 № 152-ФЗ</a> «О персональных данных»</li>
		<li><a target="_blank" href="http://www.rg.ru/2006/07/29/informacia-dok.html">ФЗ РФ от 27.07.2006 № 149-ФЗ</a> «Об информации, информационных технологиях и о защите информации»</li>
		<li><a target="_blank" href="http://www.rg.ru/2002/12/27/tehreglament-dok.html">ФЗ РФ от 27.12.2002 № 184-Ф3</a> «О техническом регулировании»</li>
		<li><a target="_blank" href="http://base.garant.ru/12116419/#help">ФЗ РФ от 18.07.1999 № 183-ФЗ</a> «Об экспортном контроле»</li>
	</ul>
	<hr>
	<h2>Указы Президента РФ</h2>
	<ul>
		<li><a target="_blank" href="http://www.rg.ru/2015/05/26/rosset-dok.html">Указ Президента РФ от 22.05.2015 № 260</a> «О некоторых вопросах информационной безопасности Российской Федерации»</li>
		<li><a target="_blank" href="http://base.garant.ru/70107655/">Указ Президента РФ от 17.12.2011 № 1661</a> «Об утверждении списка товаров и технологий двойного назначения, которые могут быть использованы при создании вооружений и военной техники и в отношении которых осуществляется экспортный контроль»</li>
	</ul>
	<hr>
	<h2>Постановления Правительства РФ</h2>
	<ul>
		<li><a target="_blank" href="http://www.garant.ru/products/ipo/prime/doc/71776120/">ПП РФ от 08.02.2018 № 127</a> «Об утверждении Правил категорирования объектов КИИ РФ, а также перечня показателей критериев значимости объектов КИИ РФ и их значений»</li>
		<li><a target="_blank" href="http://www.garant.ru/products/ipo/prime/doc/71783452/">ПП РФ от 17.02.2018 № 162</a> «Об утверждении Правил осуществления госконтроля в области обеспечения безопасности значимых объектов КИИ РФ»</li>
		<li><a target="_blank" href="http://www.rg.ru/2012/11/07/pers-dannye-dok.html">ПП РФ от 01.11.2012 № 1119</a> «Об утверждении требований к защите персональных данных при их обработке в информационных системах персональных данных»</li>
		<li><a target="_blank" href="http://www.rg.ru/2012/07/02/podpis-dok.html">ПП РФ от 25.06.2012 № 634</a> «О видах электронной подписи, использование которых допускается при обращении за получением государственных и муниципальных услуг »</li>
		<li><a target="_blank" href="http://www.rg.ru/2012/04/24/shifry-site-dok.html">ПП РФ от 16.04.2012 № 313</a> «Об утверждении положения о лицензировании деятельности по разработке, производству, распространению шифровальных (криптографических) средств, информационных систем и телекоммуникационных систем, защищенных с использованием шифровальных (криптографических) средств, выполнению работ, оказанию услуг в области шифрования информации, техническому обслуживанию шифровальных (криптографических) средств, информационных систем и телекоммуникационных систем, защищенных с использованием шифровальных (криптографических) средств (за исключением случая, если техническое обслуживание шифровальных (криптографических) средств, информационных систем и телекоммуникационных систем, защищенных с использованием шифровальных (криптографических) средств, осуществляется для обеспечения собственных нужд юридического лица или индивидуального предпринимателя)»</li>
		<li><a target="_blank" href="http://www.rg.ru/2007/11/10/it-akkreditacia-dok.html">ПП РФ от 06.11.2007 № 758</a> «О государственной аккредитации организаций, осуществляющих деятельность в области информационных технологий»</li>
		<li><a target="_blank" href="http://base.garant.ru/102670/">ПП РФ от 26.06.1995 № 608</a> «О сертификации средств защиты информации»</li>
		<li><a target="_blank" href="http://government.ru/docs/20650/">ПП РФ от 16.11.2015 № 1236</a> «Об установлении запрета на допуск иностранного программного обеспечения при закупках для государственных и муниципальных нужд»</li>
	</ul>
	<hr>
	<h2>Документы уполномоченных федеральных органов</h2>
	<ul>
		<li><a target="_blank" href="https://rg.ru/2018/02/26/fstek-prikaz235-site-dok.html">Приказ ФСТЭК России от 21.12.2017 № 235</a> «Об утверждении Требований к созданию систем безопасности значимых объектов критической информационной инфраструктуры Российской Федерации и обеспечению их функционирования»</li>
		<li><a target="_blank" href="https://rg.ru/2018/03/28/fstek-prikaz239-site-dok.html">Приказ ФСТЭК России от 25.12.2017 № 239</a> «Об утверждении Требований по обеспечению безопасности значимых объектов критической информационной инфраструктуры Российской Федерации»</li>
		<li><a target="_blank" href="http://www.rg.ru/2014/09/17/zashita-dok.html">Приказ ФСБ России от 10.07.2014 № 378</a> «Об утверждении состава и содержания организационных и технических мер по обеспечению безопасности персональных данных при их обработке в информационных системах персональных данных с использованием средств криптографической защиты информации, необходимых для выполнения установленных Правительством Российской Федерации требований к защите персональных данных для каждого из уровней защищенности»</li>
		<li><a target="_blank" href="http://www.rg.ru/2012/02/14/elpodpis-site-dok.html">Приказ ФСБ России от 27.12.2011 № 796</a> «Об утверждении Требований к средствам электронной подписи и Требований к средствам удостоверяющего центра»</li>
		<li><a target="_blank" href="http://www.rg.ru/2012/01/28/elektrokluch-site-dok.html">Приказ ФСБ России от 27.12.2011 № 795</a> «Об утверждении Требований к форме квалифицированного сертификата ключа проверки электронной подписи»</li>
		<li><a target="_blank" href="http://www.rg.ru/2010/10/22/vidak-dok.html">Совместный Приказ ФСБ России № 416, ФСТЭК России № 489 от 31.08.2010</a> «Об утверждении требований о защите информации, содержащейся в информационных системах общего пользования»</li>
		<li><a target="_blank" href="http://www.rg.ru/2005/03/19/kriptozaschita-dok.html">Приказ ФСБ России от 09.02.2005 № 66</a> «Об утверждении Положения о разработке, производстве, реализации и эксплуатации шифровальных (криптографических) средств защиты информации (Положение ПКЗ-2005)»</li>
		<li><a target="_blank" href="http://base.garant.ru/183628/">Приказ ФАПСИ от 13.06.2001 № 152</a>&nbsp;«Об утверждении инструкции об организации и обеспечении безопасности хранения, обработки и передачи по каналам связи с использованием средств криптографической защиты информации с ограниченным доступом, не содержащей сведений, составляющих государственную тайну»</li>
		<li><a target="_blank" href="http://www.rg.ru/2013/05/22/soderjanie-dok.html">Приказ ФСТЭК России от 18.02.2013 № 21</a> «Об утверждении Состава и содержания организационных и технических мер по обеспечению безопасности персональных данных при их обработке в информационных системах персональных данных» (Зарегистрировано в Минюсте России 14.05.2013 № 28375)</li>
		<li><a target="_blank" href="http://www.rg.ru/2013/06/26/gostajna-dok.html">Приказ ФСТЭК России от 11.02.2013 № 17</a> «Об утверждении Требований о защите информации, не составляющей государственную тайну, содержащейся в государственных информационных системах» (Зарегистрировано в Минюсте России 31.05.2013 № 28608)</li>
		<li><a href="http://base.garant.ru/188294/" title="Prikaz_FSB_11.09.2000_N-489.pdf" target="_blank">Приказ ФСБ РФ от 11.09.2000 № 489</a> «Об утверждении положения об аккредитации органов по сертификации и испытательных центров (лабораторий) в системах сертификации Федеральной службы безопасности Российской Федерации».<br>
		 Аккредитация в системе сертификации: Система сертификации средств криптографической защиты информации (РОСС RU.0001.030001)</li>
	</ul>
	<hr>
	<h2>Нормативно-правовые акты для подключения к СМЭВ</h2>
	<ul>
		<li><a target="_blank" href="http://minsvyaz.ru/ru/documents/4797/">Приказ Минкомсвязи России от 23.06.2015 № 210</a> «Об утверждении Технических требований к взаимодействию информационных систем в единой системе межведомственного электронного взаимодействия»</li>
		<li><a target="_blank" href="http://smev.gosuslugi.ru/portal/api/files/get/80937">Регламент 3.4. Приложение 3.</a> «Требования к сети передачи данных участников информационного обмена»</li>
	</ul>
	<hr>
	<h2>Методические материалы</h2>
	<ul>
		<li><a target="_blank" href="http://www.fsb.ru/files/PDF/Metodicheskie_recomendacii.pdf">Методические рекомендации по разработке нормативных правовых актов, определяющих угрозы безопасности персональных данных, актуальные при обработке персональных данных в информационных системах персональных данных, эксплуатируемых при осуществлении соответствующих видов деятельности.</a> Утверждены руководством 8 Центра ФСБ России 31 марта 2015 года.</li>
		<li><a target="_blank" href="http://www.rfcmd.ru/sphider/docs/InfoSec/RD_FSTEK_requirements.htm">Методические документы «Специальные требования и рекомендации по технической защите конфиденциальной информации».</a> Государственная техническая комиссия при Президенте Российской Федерации. Решение Коллегии Гостехкомиссии России № 7.2/02.03.2001</li>
	</ul>
         <hr>
	<h2>Другое</h2>
        <ul>
               <li><a target="_blank" href="http://wwwold.tc26.ru/news/detail.php?ID=247">Порядок перехода к использованию национального стандарта ГОСТ Р 34.10-2012 в средствах ЭП</a></li>
               <li><a target="_blank" href="http://wwwold.tc26.ru/standard/draft/%D0%9F%D1%80%D0%B8%D0%BD%D1%86%D0%B8%D0%BF%D1%8B_14.11.2016.pdf">Принципы разработки и модернизации шифровальных (криптографических) средств защиты информации</a></li>
       </ul>
	<hr>
</div></div>-->
<div class="support-documentation-page page-main">
	 <?$APPLICATION->IncludeComponent(
	"bitrix:breadcrumb",
	".default",
	Array(
		"PATH" => "",
		"SITE_ID" => SITE_ID,
		"START_FROM" => "1"
	)
);?>
	<div class="container">
		<div class="support-documentation__title">
			 Документация
		</div>
		<div class="support-documentation__banner">
			<div class="support-documentation__banner__image">
 <img src="/local/templates/s-terra22/images/support-main/main.png">
			</div>
			<div class="support-documentation__banner__text">
				<p>
					 У нас есть Портал документации, на&nbsp;котором собраны все документы по&nbsp;средствам защиты информации, в&nbsp;том числе лицензионные соглашения, формуляры ФСБ и&nbsp;ФСТЭК и&nbsp;правила пользования продукцией.
				</p>
 <a class="btn btn-accent" href="https://doc.s-terra.ru/" target="_blank">Перейти на портал</a>
			</div>
		</div>
        <ul class="support-documentation-page__filter" id="nav">
            <li class="support-documentation-page__filter__item"><a class="support-documentation-page__filter__button" type="button" data-type="1" href="/support/documentation/certificates/#nav">Сертификаты на продукцию</a></li>
            <li class="support-documentation-page__filter__item"><a class="support-documentation-page__filter__button" type="button" data-type="2" href="/support/documentation/licenses/#nav">Лицензии</a></li>
            <li class="support-documentation-page__filter__item"><a class="support-documentation-page__filter__button" type="button" data-type="3" href="/support/documentation/svidetelstva-na-po/#nav">Свидетельства на ПО</a></li>
            <li class="support-documentation-page__filter__item"><a class="support-documentation-page__filter__button active" type="button" data-type="4" href="/support/documentation/normativnye-dokumenty/#nav">Нормативные документы</a></li>
        </ul>
		 <?$APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"norm-doc",
	Array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array("",""),
		"FILTER_NAME" => "",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "20",
		"IBLOCK_TYPE" => "support",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "N",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "99999",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Новости",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"PROPERTY_CODE" => array("","FILE",""),
		"SET_BROWSER_TITLE" => "Y",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "Y",
		"SET_META_KEYWORDS" => "Y",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "Y",
		"SHOW_404" => "N",
		"SORT_BY1" => "SORT",
		"SORT_BY2" => "ACTIVE_FROM",
		"SORT_ORDER1" => "ASC",
		"SORT_ORDER2" => "DESC",
		"STRICT_SECTION_CHECK" => "N"
	)
);?>
	</div>
</div>
 <br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>