<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Модуль Cisco UCS-EN120");
?><div class="twelve right article">
	<h1>Модуль Cisco UCS-EN120</h1>
	<p>
 <img width="90" alt="icon_sterra-modul.png" src="/upload/medialibrary/00f/icon_sterra-modul.png" height="90" style="margin-right: 10px; margin-bottom: 10px; float: left;" title="icon_sterra-modul.png" class="floating">Модуль Cisco UCS-EN120 представляет собой программно-аппаратный комплекс для обеспечения сетевой безопасности корпоративной сети средних офисов, поддерживает до 500 IPsec туннелей.
	</p>
	<p>
 <b>Модуль устанавливается в маршрутизаторы Cisco ISR следующих моделей: 2911, 2921, 2951, 3925, 3925E, 3945, 3945E.</b> Их описание и необходимая документация доступны на сайте: <a href="http://www.cisco.com" target="_blank">www.cisco.com</a>.
	</p>
	<p>
 <img width="340" alt="mcm-950.jpg" src="/upload/medialibrary/d4f/mcm-950.jpg" height="203" style="margin-left: 10px; float: right;" title="mcm-950.jpg" align="right">
	</p>
	<p>
		 В составе маршрутизаторов Cisco ISR серий 3900, в которые можно установить от 2 до 4 модулей, Модуль Cisco UCS-EN120 может использоваться на узлах концентрации трафика множества региональных сетей, а также в крупных сетях удаленного доступа пользователей.
	</p>
	<p>
		 На Модуль <strong>устанавливается программное обеспечение</strong> «Программный комплекс <strong>С-Терра Шлюз</strong>. Версия 4.1».
	</p>
	<p>
		 Модуль позволяет совместить широкие возможности маршрутизатора и сертифицированную отечественную криптографию.
	</p>
	<h3>Функциональные возможности</h3>
 <br>

<ul class="accordeon">
	<li class="accord-list">
	<h3 class=" title faq_title">Надежная защита передаваемого трафика</h3>
	<div class="accord-content">
	<ul>
		<li>Шифрование и контроль целостности передаваемого трафика – по протоколам IPsec ESP и/или IPsec AH (RFC2401-2412), с использованием российских и зарубежных криптографических алгоритмов</li>
		<li>Маскировка топологии защищаемого сегмента сети<br>
 </li>
		<li>Аутентификация устройств – по протоколу IKE (RFC2401-2412)</li>
		<li>Интегрированный межсетевой экран, осуществляющий stateful-фильтрацию трафика</li>
		<li>Применяется комбинированное преобразование ESP_GOST-4M-IMIT в соответствии с документом «<a href="/upload/medialibrary/6af/tehnicheskaya-specifikacia-gost-28147-89-pri-shifrovanii-v-ipsec-esp.pdf" title="tehnicheskaya-specifikacia-gost-28147-89-pri-shifrovanii-v-ipsec-esp.pdf" target="_blank">ТЕХНИЧЕСКАЯ СПЕЦИФИКАЦИЯ ПО ИСПОЛЬЗОВАНИЮ ГОСТ 28147-89 ПРИ ШИФРОВАНИИ ВЛОЖЕНИЙ В ПРОТОКОЛЕ IPSEC ESP</a>»</li>
	</ul>
	</div>
 </li>
	<li class="accord-list">
	<h3 class=" title faq_title">Построение защищенных сетей любой сложности</h3>
	<div class="accord-content">
	<ul>
		<li>Полноценная поддержка инфраструктуры PKI</li>
		<li>Совместимость с продуктами российских и зарубежных производителей</li>
		<li>Широкие возможности для администратора: задание гибкой политики безопасности, определение различных наборов правил обработки открытого и шифрованного трафика, в т.ч. реализация сценария split tunneling</li>
		<li>Поддержка различных топологий, в том числе: точка-точка, звезда, иерархическое дерево, частично- и полносвязная топология</li>
		<li>Возможность построения нескольких эшелонов защиты, выделения зон с разным уровнем доверия, организации перешифрования и инспекции трафика в центре</li>
		<li>Возможность применения сценария на базе технологии, аналогичной DMVPN</li>
	</ul>
	</div>
 </li>
	<li class="accord-list">
	<h3 class=" title faq_title">Легкая интеграция в существующую инфраструктуру</h3>
	<div class="accord-content">
	<p>
		 Совместимость со всеми необходимыми протоколами для интеграции в современную сетевую инфраструктуру, в том числе:
	</p>
	<ul>
		<li>протокол RADIUS&nbsp;</li>
		<li>выдача IKECFG-адресов для С-Терра Клиент&nbsp;и С-Терра Клиент-М</li>
		<li>объединение устройств в кластер по протоколу VRRP</li>
		<li>динамическая маршрутизация RIP и OSPF (в том числе для сценария балансировки нагрузки RRI)</li>
		<li>VLAN, LACP</li>
		<li>GRE (в том числе для резервирования провайдеров)</li>
		<li>работа через NAT (NAT Traversal)</li>
		<li>событийное протоколирование через Syslog</li>
		<li>мониторинг SNMP</li>
	</ul>
	</div>
 </li>
	<li class="accord-list">
	<h3 class=" title faq_title">Высокая надежность и производительность</h3>
	<div class="accord-content">
	<ul>
		<li>Возможность оснащения резервными блоками питания и жесткими дисками, объединенными в RAID&nbsp;(для модуля с классом сертификации КС1)</li>
		<li>Поддержка сценариев обеспечения отказоустойчивости с резервированием шлюзов безопасности, сетевых интерфейсов и провайдерских каналов</li>
		<li>Поддержка режима сохранения защищенных туннелей при перезагрузке политики безопасности&nbsp;</li>
		<li>Производительность до 250 Мбит/с</li>
		<li>Возможность использования для защиты трафика, требовательного к задержкам и потерям пакетов, такого как IP-телефония и ВКС</li>
		<li>Поддержка QoS</li>
	</ul>
	</div>
 </li>
</ul>
	<h3>Преимущества</h3>
	<ul>
		<li>Высоконадежная платформа в компактном форм-факторе</li>
		<li>Не требует дополнительного места в серверной стойке</li>
		<li>Позволяет сократить нормативные требования по энергопотреблению и теплоотводу</li>
	</ul>
	<h3>Маршрутизаторы Cisco для установки модуля</h3>
	<p>
		 Сетевой Модуль Cisco UCS-EN120 может устанавливаться в конфигурируемые слоты для сетевых модулей размером single-wide на маршрутизаторах Cisco&nbsp;2911, 2921, 2951, 3925, 3925E, 3945, 3945E.
	</p>
	<h3>Протоколы и технологии</h3>
	<table style="width: 100%;">
	<tbody>
	<tr>
		<th style="width: 30%;">
			 Наименование
		</th>
		<th>
			 Спецификация
		</th>
	</tr>
	<tr>
		<td>
			 Криптографические библиотеки
		</td>
		<td>
			<p>
 <img width="59" alt="4-1_st.png" src="/upload/medialibrary/81c/4-1_st.png" height="27" style="vertical-align: middle;" title="4-1_st.png"> встроенная, С-Терра ST
			</p>
			<p>
 <img width="59" alt="4-1_cp.png" src="/upload/medialibrary/7de/4-1_cp.png" height="27" style="vertical-align: middle;" title="4-1_cp.png"> внешняя, КриптоПро CSP 3.6R4, 3.9
			</p>
		</td>
	</tr>
	<tr>
		<td>
			 Информационные обмены протокола IKE
		</td>
		<td>
			 Main mode<br>
			 Aggressive mode<br>
			 Quick mode<br>
			 Transaction Exchanges<br>
			 Informational Exchanges<br>
			 VKO ГОСТ Р 34.10-2001<br>
 <img width="34" alt="4-1_st.png" src="/upload/medialibrary/81c/4-1_st.png" height="16" style="margin-right: 2px; vertical-align: middle;" title="4-1_st.png">VKO_GOSTR3410_2012_256 в соответствии с&nbsp;документом «<a href="/upload/medialibrary/9bb/rekomendacii-po-standartizacii-kriptografia.pdf" title="rekomendacii-po-standartizacii-kriptografia.pdf" target="_blank">РЕКОМЕНДАЦИИ ПО СТАНДАРТИЗАЦИИ...</a>»
		</td>
	</tr>
	<tr>
		<td>
			 Режимы аутентификации в протоколе IKE
		</td>
		<td>
			 Preshared key<br>
			 RSA digital signature<br>
			 DSA digital signature<br>
			 ГОСТ Р 34.10-2001<br>
 <img width="34" alt="4-1_st.png" src="/upload/medialibrary/81c/4-1_st.png" height="16" style="margin-right: 2px; vertical-align: middle;" title="4-1_st.png">ГОСТ Р 34.10-2012
		</td>
	</tr>
	<tr>
		<td>
			 Алгоритмы шифрования, ЭП и контроля целостности
		</td>
		<td>
			<p>
				 Шифрование: DES, AES, ГОСТ28147-89
			</p>
			<p>
				 ЭП: DSA, RSA, ГОСТ Р 34.10-2001,&nbsp;<img width="34" alt="4-1_st.png" src="/upload/medialibrary/81c/4-1_st.png" height="16" title="4-1_st.png" style="margin-right: 2px; vertical-align: middle;">ГОСТ Р 34.10-2012
			</p>
			<p>
				 Контроль целостности: MD5, SHA1, комбинированное преобразование ESP_GOST-4M-IMIT, ГОСТ Р 34.11-94,&nbsp;<img width="34" alt="4-1_st.png" src="/upload/medialibrary/81c/4-1_st.png" height="16" title="4-1_st.png" style="margin-right: 2px; vertical-align: middle;">ГОСТ Р 34.11-2012
			</p>
		</td>
	</tr>
	<tr>
		<td>
			 Мониторинг доступности удаленного узла
		</td>
		<td>
			 Dead Peer Detection (DPD) протокол (draft-ietf-ipsec-dpd-04)
		</td>
	</tr>
	<tr>
		<td>
			 Событийное протоколирование
		</td>
		<td>
			 Syslog
		</td>
	</tr>
	<tr>
		<td>
			 Сбор статистики
		</td>
		<td>
			 SNMP v.1, v.2c
		</td>
	</tr>
	<tr>
		<td>
			 Формат сертификатов публичных ключей
		</td>
		<td>
			 X.509 v.3 (RSA, DSA, ГОСТ). Учтены изменения в соответствии с "Приказ ФСБ России от 27.12.2011 № 795" и "ГОСТ Р ИСО 17090-2-2010 Информатизация здоровья. Инфраструктура с открытым ключом"
		</td>
	</tr>
	<tr>
		<td>
			 Формат запроса на регистрацию сертификата при генерации ключевой пары
		</td>
		<td>
			 Certificate Enrollment Request (CER), упакованный в PKCS#10 base 64 или bin формат
		</td>
	</tr>
	<tr>
		<td>
			 Способы получения сертификатов
		</td>
		<td>
			 Протоколы IKE, LDAP v.3 <br>
			 Импорт из файла (bin и base64, PKCS#7 bin и base64, PKCS#12 bin и base64)
		</td>
	</tr>
	<tr>
		<td>
			 Способ получения ключевой пары
		</td>
		<td>
			 Генерация с помощью утилит криптопровайдера, входящих в состав продукта, с выдачей CER<br>
			 Генерация внешним PKI сервисом с доставкой на сменных ключевых носителях<br>
			 Генерация внешним PKI сервисом с доставкой через PKSC#12 (DSA, RSA)
		</td>
	</tr>
	<tr>
		<td>
			 Список отозванных сертификатов
		</td>
		<td>
			 Обработка Certificate Revocation List (CRL) опциональна <br>
			 Поддерживается CRL v.2. <br>
			 Способы получения CRL: <br>
			 &nbsp; &nbsp; протокол LDAP v.3<br>
			 &nbsp; &nbsp; импорт из файла (bin и base64, PKCS#7 bin и base64, PKCS#12 bin и base64)
		</td>
	</tr>
	<tr>
		<td>
			 Механизмы обеспечения отказоустойчивости
		</td>
		<td>
			 VRRP, RRI, GRE+OSPF (резервирование провайдеров)
		</td>
	</tr>
	<tr>
		<td>
			 Работа через NAT
		</td>
		<td>
			 NAT Traversal Encapsulation (инкапсуляция IPsec в UDP) в соответствии с NAT-T по draft-ietf-ipsec-nat-t-ike-03(02) и draft-ietf-ipsec-udp-encaps-03(02)
		</td>
	</tr>
	<tr>
		<td>
			 Протоколы динамической маршрутизации
		</td>
		<td>
			 RIPv2, OSPF
		</td>
	</tr>
	<tr>
		<td>
			 Прочие сетевые протоколы и сервисы
		</td>
		<td>
			 DHCP (клиент и сервер), VLAN, NAT, LACP
		</td>
	</tr>
	</tbody>
	</table>
	<p>
		 &nbsp;
	</p>
	<h3>Управление</h3>
	<ul>
		<li>Система централизованного управления С-Терра КП –&nbsp;централизованно удаленно</li>
		<li>Консоль маршрутизатора Cisco</li>
		<li>Графический интерфейс Cisco Security Manager (CSM), который входит в состав Cisco Security Management Suite –&nbsp;централизованно удаленно</li>
		<li>Протокол SSH с помощью интерфейса командной строки, в интерфейсе которой используется подмножество команд Cisco IOS –&nbsp;локально или удаленно</li>
		<li>Web-based интерфейс управления –&nbsp;удаленно</li>
	</ul>
	<h3>Совместимость</h3>
	<ul>
		<li>Токены производства компании Aladdin: eToken PRO32k, eToken PRO64k, eToken NG-FLASH, eToken PRO (Java)</li>
		<li>Токены производства компании Актив: Рутокен S, Рутокен ЭЦП</li>
		<li>В части реализации протоколов IPsec/IKE и их расширений –&nbsp;с Cisco IOS v.12.4 и v.15.x.x</li>
		<li>Все продукты компании "С-Терра СиЭсПи" независимо от версии</li>
		<li>Модуль NME-RVPN в исполнении МСМ</li>
	</ul>
	<h3>Сертификаты</h3>
	<p>
 <a href="/upload/iblock/adb/fstec_3370_gate.jpg" target="_blank">Сертификат ФСТЭК России № 3370&nbsp;(МЭ-3, НДВ-3, ОУД 4+)</a>
	</p>
	<p>
		 Формуляр, согласованный ФСТЭК России (АС 1В, ГИС до 1 кл. вкл., ПДн 1-4 ур.)
	</p>
	<p>
 <img width="34" alt="4-1_st.png" src="/upload/medialibrary/81c/4-1_st.png" height="16" style="margin-right: 3px; vertical-align: middle;" title="4-1_st.png">Встроенная криптобиблиотека С-Терра ST
	</p>
	<ul>
		<li><a href="/upload/medialibrary/0e4/fsb_114-2515_gate-st-kc1.jpg" target="_blank">Сертификат ФСБ России № СФ/114-2515&nbsp;(КС1)</a></li>
		<li><a href="/upload/medialibrary/dc6/fsb_515-2661_gate-st-fw.jpg" target="_blank">Сертификат ФСБ России № СФ/515-2661&nbsp;(МЭ4) для исполнения 3-1 (КС1)</a></li>
	</ul>
	<p>
 <img width="34" alt="4-1_cp.png" src="/upload/medialibrary/7de/4-1_cp.png" height="16" style="margin-right: 3px; vertical-align: middle;" title="4-1_cp.png">Внешняя криптобиблиотека КРИПТО-ПРО CSP
	</p>
	<ul>
		<li><a href="/upload/medialibrary/f31/114-3044_исп3-2_КС1.jpg" title="fsb-114-3044_gate_КС1.jpg" target="_blank">Сертификат ФСБ России № СФ/114-3044&nbsp;(КС1)</a></li>
		<li><a href="/upload/medialibrary/355/fsb_515-2656_gate-cp-fw.jpg" target="_blank">Сертификат ФСБ России № СФ/515-2656 (МЭ4) для исполнения 3-2 (КС1)</a></li>
	</ul>
	 <!-- Начало блока с кнопкой "Документация по продукту" -->
	<div class="twelve">
 <a href="http://doc.s-terra.ru/rh_output/4.1/Module_Cisco/output/index.htm" class="doc_button" target="_blank">Документация по этому продукту
		<div class="icons icon-arrow-right-news">
		</div>
 </a>
	</div>
	 <!-- Конец блока с кнопкой "Документация по продукту" -->
</div></div><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>