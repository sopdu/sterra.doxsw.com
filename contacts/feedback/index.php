<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Оставить отзыв");
?>

<?$APPLICATION->SetAdditionalCSS("/include/feedback/form-styles.css");?>
<?$APPLICATION->AddHeadScript("/include/feedback/form-actions.js");?>
<?$APPLICATION->AddHeadScript("/include/feedback/refreshcaptcha.js");?>
<?$APPLICATION->AddHeadScript("https://www.google.com/recaptcha/api.js");?>

<div class="twelve right pageform soft-grey atcivation">
    <h3>Заполните, пожалуйста, форму:</h3>
    <p style="font-size: 12px;">Обратите внимание, что все поля являются обязательными для заполнения.</p>
    <form enctype="multipart/form-data" name="feedback" action="/include/ajax/feedback.php?action=submit" method="POST" class="pageform-container" id="form">
        <div class="unit">
            <label>Фамилия, Имя, Отчество</label>
            <br />
            <input id="valid-usr" name="fio" type="text" class="need-valid" onkeyup="checkParams()" />
            <br />
            <p class="error invis">Поле пустое</p>
            <p class="mesage">Например: Смирнов Петр Ильич</p>
        </div>
        <div class="unit">
            <label>Адрес электронной почты</label>
            <br />
            <input id="email" name="email" type="text" class="need-valid" onchange="checkParams()" />
            <br />
            <p class="error invis">Введите e-mail в формате myemail@gmail.com</p>
            <p class="mesage">Например: myemail@gmail.com</p>
        </div>
        <div class="unit">
            <label>Название компании</label>
            <br />
            <input id="valid-org" name="name_company" type="text" class="need-valid" onkeyup="checkParams()" />
            <br />
            <p class="error invis">Поле пустое</p>
            <p class="mesage">Например: ООО «Альфа»</p>
        </div>
        <div class="unit">
            <label>Дата запроса</label>
            <br />
            <input id="valid-dat" name="date" class="fieldset__input js__datepicker need-valid" type="text" onkeyup="checkParams()">
            <img style="float: right;position: absolute;vertical-align:text-bottom;margin-left:-25px;margin-top: 8px;" src="/img/smiles/pict-calendar.png" /><br />
            <p class="error invis">Укажите дату</p>
            <p class="mesage">Например: 01.01.2016</p>
        </div>
        
        <div class="clearfix"></div>

        <div class="unit">
            <label>Причина обращения в компанию</label>
            <br />
            <select name="case" id="case" class="need-valid" onChange="izmen(); checkParams();">
                <option value="0">Выбрать из списка</option>
                <option value="Необходимость в техподдержке">Необходимость в техподдержке</option>
                <option value="Консультация по выбору продукта">Консультация по выбору продукта</option>
                <option value="Вопросы применения продукта">Вопросы применения продукта</option>
                <option value="Запрос коммерческого предложения">Запрос коммерческого предложения</option>
                <option value="OtherCase">Другое (введите в поле ниже):</option>
            </select>
            <br />
            <div id="OtherCase"><!-- Начало скрытого поля другой причины обращения -->
                <input type="text" name="othercasetext" />
            </div><!-- Конец скрытого поля другой причины обращения-->
        </div>
        
        <div class="unit">
            <label>Подразделение, куда обращались</label>
            <br />
            <select name="dep" id="dep" class="need-valid" onChange="checkParams()">
                <option value="0">Выбрать подразделение</option>
                <option value="Отдел продаж">Отдел продаж</option>
                <option value="Технический консалтинг">Технический консалтинг</option>
                <option value="Техническая поддержка">Техническая поддержка</option>
                <option value="Отдел логистики">Отдел логистики</option>
            </select>
            <br />
        </div>
        
        <div class="clearfix"></div>
        
        <br /><br />
        
        <div class="unit">
            <label>Оценить обслуживание</label>
            <br />
            <div class="smile" style="margin-left:40px;"><img src="/img/smiles/smile-very-good.png" /><br>Великолепно<br>
                <input type="radio" value="Великолепно" name="mark" checked>
            </div>
            <div class="smile"><img src="/img/smiles/smile-good.png" /><br>Хорошо<br>
                <input type="radio" value="Хорошо" name="mark">
            </div>
            <div class="smile"><img src="/img/smiles/smile-norma.png" /><br>Нормально<br>
                <input type="radio" value="Нормально" name="mark">
            </div>
            <div class="smile"><img src="/img/smiles/smile-bad.png" /><br>Плохо<br>
                <input type="radio" value="Плохо" name="mark">
            </div>
            <div class="smile"><img src="/img/smiles/smile-very-bad.png" /><br>Хуже некуда<br>
                <input type="radio" value="Хуже некуда" name="mark">
            </div>
            <br />
        </div>
        <div class="clearfix"></div>
        <div class="unit">
            <label>Ваше мнение (Вы можете как выразить благодарность, так и&nbsp;пожаловаться)</label>
            <textarea name="comment" rows="5" cols="80" class="textarea"></textarea>
        </div>
<div class="clearfix"></div><br />
        <div class="unit">
            <input type="checkbox" name="want_receive_news" checked="checked" id="codabra-want" class="codabra-elements">
<label for="codabra-want">Хочу получать С-Терра Новости</label>
        </div>
<div class="clearfix"></div><br />
        <div class="unit">
            <input type="checkbox" name="processing" id="codabra-processing" class="codabra-elements" onChange="checkParams();">
<label for="codabra-processing">
Даю согласие на обработку своих персональных данных в&nbsp;соответствии<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;с&nbsp;<a title="Скачать документ" href="/upload/medialibrary/6c7/politika_obrabotki_personal_dannyh_sterra_29-11-2019.pdf" target="_blank">Политикой обработки персональных данных ООО «С-Терра СиЭсПи»</a>.
</label>
        </div>
        <div class="clearfix"></div>
        </br>
        <div class="clearfix"></div>
        <div class="unit"><div class="g-recaptcha" data-sitekey="6LenyCQUAAAAANk2CfCd23N-hwAw3n7C93xoBjKs" data-callback="checkParams"></div></div>
        <div class="clearfix"></div>
        <div class="position">
            <input type="submit" name="submit" class="blue icons" id="submit-button" value="Отправить отзыв" style="padding: 5px 35px 6px 13px;" disabled />
        </div>

    </form>
</div>

<!-- Pikadate -->
<script src="<?=SITE_TEMPLATE_PATH?>/lib/picker.js"></script>
<script src="<?=SITE_TEMPLATE_PATH?>/lib/picker.date.js"></script>
<script src="<?=SITE_TEMPLATE_PATH?>/lib/picker.time.js"></script>
<script src="<?=SITE_TEMPLATE_PATH?>/demo/scripts/demo.js"></script>
<link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/lib/themes/default.css" id="theme_base">
<link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/lib/themes/default.date.css" id="theme_date">

</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
