<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Миграция ЦОД");
?><div class="twelve right article">
	<h1>Защищенная миграция ЦОД без остановки сервисов</h1>	
	<br>
<p>
 <a href="/upload/medialibrary/356/DataCenterMigration_doc.pdf" title="DataCenterMigration_doc.pdf" target="_blank">Скачать статью в PDF</a>
</p>
<p>
	 При необходимости физической миграции Центра Обработки Данных (ЦОД) или перемещении части сервисов из одного ЦОД в другой встает вопрос быстрого переезда с минимальными перерывами (или полным отсутствием таковых) в обеспечении пользовательского сервиса. При этом, сервисы ЦОДа далеко не всегда можно разбить на отдельные компоненты, работающие независимо.
</p>
<p>
	 Связь старого и нового ЦОДов на сетевом уровне (L3) часто не подходит для решения подобной задачи, т.к. требует модификации адресной схемы сети, что неизбежно влечет за собой существенные изменения в конфигурации большого количества устройств и, как следствие, возможные ошибки и перебои с предоставлением пользовательских сервисов.
</p>
<p>
	 Для решения подобной проблемы необходимо обеспечить высокоскоростное взаимодействие старого и нового ЦОДов на канальном уровне (L2) на протяжении всего процесса миграции. Т.к. в большинстве случаев передаваемые сведения являются конфиденциальными, то данный канал связи должен быть не только высокопроизводительным и надежным, но и защищенным. В противном случае, злоумышленник, получив доступ хотя бы в одной точке канала связи, может перехватить конфиденциальную информацию, в составе которой могут быть персональные данные, пароли, сведения, составляющие коммерческую тайну и так далее.
</p>
<div class="vrezka" style="width: 180px;">
	<p class="vrezka-title">
 <b>ПРЕИМУЩЕСТВА<br>
		 РЕШЕНИЯ:</b>
	</p>
	<ul>
		<li>Сертифицировано регуляторами</li>
		<li>Масштабируемость</li>
		<li>Легкость обновления</li>
		<li>Высокая скорость отработки отказов</li>
		<li>Надежность</li>
		<li>Экономическая эффективность</li>
	</ul>
</div>
<p>
	 Также важно учесть, что если в информационной системе компании обрабатывается информация, подлежащая обязательной защите в соответствии с российским законодательством (например, персональные данные), то для защиты канала связи необходимо использовать сертифицированные средства, прошедшие процедуру оценки регуляторами – ФСБ России и ФСТЭК России.
</p>
<p>
	 Компания «С-Терра СиЭсПи» предлагает высокопроизводительное сертифицированное решение для миграции ЦОД без остановки сервисов на базе VPN-шлюзов с установленным программным модулем «С-Терра&nbsp;L2».
</p>
<p>
	 Решение обеспечивает защищенный канал связи между ЦОДами на канальном уровне и предоставляет такие возможности, как:
</p>
<ul>
	<li>объединение ЦОДов в единый широковещательный сегмент;</li>
	<li>перенос виртуальных машин и/или физических серверов из одного ЦОД в другой без дополнительной перенастройки;</li>
	<li>индивидуальный перенос логически связанных друг с другом сервисов без нарушения работы системы в целом;</li>
	<li>миграция виртуальных машин из основного ЦОД в резервный с использованием технологии vMotion и SRM;</li>
	<li>обеспечение передачи VLAN-тегов, MPLS-меток, мультикаст-пакетов и всех необходимых служебных протоколов начиная от канального уровня и выше.</li>
</ul>
<p>
 <b>Уникальность решения</b> заключается не только <b>в его функциональных характеристиках</b>, но <b>и в производительности</b>, которая может достигать <b>10 и более Гбит/с</b> с временем задержки менее 5 мс. Благодаря этому, ЦОД даже в процессе миграции продолжает работать для пользователей сервисов с той же скоростью и временем отклика, что и раньше.
</p>
<p>
	 Основные преимущества данного решения:
</p>
<ul>
	<li><b>Сертификация.</b> Установка программного модуля С-Терра L2 в шлюз безопасности С-Терра Шлюз не затрагивает сертифицированную часть продукта. Таким образом, заказчик получает полностью сертифицированное решение для защиты на канальном уровне, первое на российском рынке.</li>
	<li><b>Масштабируемость, легкость обновления, высокая скорость отработки отказов.</b> Решение соответствует всем современным требованиям к решениям Enterprise-класса: оно легко масштабируется по производительности, а отдельные его компоненты могут быть обновлены без остановки всего решения в целом. Решение корректно и быстро (менее 3 сек.) отрабатывает различные виды отказов.</li>
	<li><b>Надежность.</b> Решение уже более двух лет используется заказчиками на практике. Одним из главных его достоинств является надежность: за время эксплуатации не было отмечено ни одного сбоя.</li>
	<li><b>Экономическая эффективность.</b> После завершения процесса переезда ЦОД, используемые в решении продукты могут быть переведены в режим шифрования L3 и использоваться на других участках сети для сертифицированной защиты каналов связи и обеспечения удаленного защищенного доступа.</li>
</ul>
<p>
	 В состав решения входит комплект шлюзов безопасности С-Терра Шлюз с установленными программными модулями С-Терра L2, подготовленных для реализации данной задачи, специальная документация по интеграции и настройке оборудования в данном решении, комплект стандартной документации для продуктов С-Терра Шлюз. Для применения данного решения необходимо наличие коммутаторов, удовлетворяющих следующим требованиям:
</p>
<p style="margin-left: 26px;">
	 – поддержка протокола LACP или PAGP;<br>
	 – не менее 10x10 Gbps портов.
</p>
<p>
	 Минимальный комплект состоит из четырех шлюзов безопасности с установленными программными модулями С-Терра L2 и комплекта документации. Для его применения требуется наличие двух пар коммутаторов. Шлюзы используются для построения защищенного туннеля связи на канальном уровне. Такой туннель позволяет обеспечить конфиденциальность и целостность передаваемых данных даже в том случае, если промежуточное оборудование на канале было взломано злоумышленником. Коммутаторы выступают в роли балансировщиков трафика, обеспечивая масштабируемость и отказоустойчивость решения.
</p>
<h2>Пример защиты миграции ЦОД для канала 10 Гбит/с.</h2>
<p>
 <b>Исходные данные:</b> требуется защитить канал, связывающий старый и новый ЦОД на период переезда на уровне L2. Ширина канала, связывающая ЦОДы – до 10 Гбит/с. Передаваемый трафик – преимущественно TCP, IP-телефония отсутствует. Решение должно быть отказоустойчивым с временем отработки отказа менее 10 секунд.
</p>
<p>
 <b>Предлагаемое решение:</b>
</p>
<p>
	 Для решения данной задачи предлагается использовать 4 пары шлюзов С-Терра Шлюз 7000 High End с установленными программными модулями С-Терра L2 и две пары коммутаторов.
</p>
<p>
	 Схема решения представлена на рисунке:
</p>
<p>
 <img width="650" alt="DataCenterMigration.jpg" src="/upload/medialibrary/ae0/DataCenterMigration.jpg" height="242" title="DataCenterMigration.jpg" align="middle">
</p>
<p>
	 &nbsp;
</p>
<h2>Настройка оборудования и стоимость решения</h2>
<p>
	 Подробную информацию о компонентах данного решения можно получить в разделе <a href="/products/catalog/s-terra-shlyuz/" target="_blank">«Продукция»</a>
</p>
<p>
	 Подробную инструкцию по настройке компонентов решения Вы можете получить <a href="/upload/medialibrary/e55/ver_4_1_scn_1_24.pdf" title="ver_4_1_scn_1_24.pdf" target="_blank">здесь</a>.
</p>
<p>
	 Получить помощь в выборе оборудования и расчет стоимости решения для вашего ЦОД Вы можете, обратившись к нашим менеджерам:<br>
	 – по телефону <b>+7 499 940-90-61</b><br>
	 – или по электронной почте: <a href="mailto:sales@s-terra.ru">sales@s-terra.ru</a><br>
	 Вам обязательно помогут!
</p>
</div></div><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>