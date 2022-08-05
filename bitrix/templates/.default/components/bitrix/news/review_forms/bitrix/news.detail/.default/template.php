<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>
<?

$sendMail = 'pr@s-terra.ru';
$subject = 'Новый отзыв на вебинар';
$from = 'information@s-terra.ru';

$html_template_start = '
<html>
<head>
    <title>'.$subject.'</title>
</head>
<body style="font-family: Arial;">
            ';
$html_template_end = '
</body>
</html>
';

$lines = explode("\n", $arResult['PREVIEW_TEXT']);

function isQuestionType($question_type)
{
    $allow_types = array('TEXT','TEXTF','TEXTAREA','1-10','1-5','1-10F','1-5F','CHECKBOX');
    if (array_search($question_type, $allow_types)!==false) {
        return true;
    }
    return false;
}

$arrQuestion = array();

$open_component = false;
foreach ($lines as $key => $line) {
    $line = trim($line);
    if (substr($line, 0, 2)=='Q|') {
        $line = strip_tags($line);
        $question = explode('|', $line);
        $question_number = trim($question[1]);
        $question_text = trim(str_replace("&#39;", "", $question[2]));
        if (substr($question_text, 0, 2)=='i:') {

            $question_text = '<i>'.substr($question_text, 2).'</i>';
        }
        if (substr($question_text, 0, 2)=='b:') {
            $question_text = '<b>'.substr($question_text, 2).'</b>';
        }

        //Реализация открывающих и закрывающих тегов. Ныне не заюзана. Begin
        // $question_text = str_replace('i:','<i>', $question_text, $begin_cnt);
        // $question_text = str_replace(':i','</i>', $question_text, $end_cnt);
        // if ($begin_cnt>$end_cnt) {
        //     $diff = $begin_cnt-$end_cnt;
        //     for($i=0;$i<$diff;$i++) {
        //         $question_text.'</i>';
        //     }
        // }

        // $question_text = str_replace('b:','<b>', $question_text, $begin_cnt);
        // $question_text = str_replace(':b','</b>', $question_text, $end_cnt);
        // if ($begin_cnt>$end_cnt) {
        //     $diff = $begin_cnt-$end_cnt;
        //     for($i=0;$i<$diff;$i++) {
        //         $question_text.'</b>';
        //     }
        // }
        //Реализация открывающих и закрывающих тегов. Ныне не заюзана. End

        $question_type = trim($question[3]);

        if (isQuestionType($question_type) && $open_component!=true) {
            $arrQuestion[] = array(
                "TEXT" => $question_text,
                "TYPE" => $question_type,
                "NUMBER" => $question_number,
            );
            continue;
        }
        if (isQuestionType($question_type) && $open_component==true) {
            end($arrQuestion);
            $key = key($arrQuestion);
            if ($arrQuestion[$key]['TYPE']=='COMPONENT') {
                $arrQuestion[$key]['ITEMS'][] = array(
                    "TEXT" => $question_text,
                    "TYPE" => $question_type,
                );
            }
            continue;
        }
        if ($question_type=='[' && $open_component!=true) {
            $open_component = true;
            $arrQuestion[] = array(
                "TEXT" => $question_text,
                "TYPE" => 'COMPONENT',
                "NUMBER" => $question_number,
                "ITEMS" => array(),
            );
            continue;
        }
    } else {
        if (substr($line, 0, 1)==']') {
            $open_component = false;
        }
    }
}
?>
<?//if (!empty($arrQuestion) && !empty($_POST['question']) && !empty($_POST['webinar']) && !empty($_POST['personal'])):?>
<?if (!empty($arrQuestion) && !empty($_POST['question']) && !empty($_POST['personal'])):?>
    <?$response = '';?>
    <?foreach($_POST['question'] as $questionKey => $question):?>
        <? 
        if (!empty($arrQuestion[$questionKey]['TEXT'])) {
            $response .= '<strong>'.($questionKey+2).'. '.str_replace(array('b:',':b','i:',':i'), '', strip_tags($arrQuestion[$questionKey]['TEXT'])).'</strong><br/><br/>';
        }
        if (is_array($question)) {
            foreach ($question as $subQuestionKey => $subQuestion) {
                if (!empty($arrQuestion[$questionKey]['ITEMS'][$subQuestionKey])) {
                    $response .= '&nbsp;&nbsp;&nbsp;&nbsp;<strong>'.str_replace(array('b:',':b','i:',':i'), '', strip_tags($arrQuestion[$questionKey]['ITEMS'][$subQuestionKey]['TEXT'])).'</strong><br/>';
                    if ($arrQuestion[$questionKey]['ITEMS'][$subQuestionKey]['TYPE']=='CHECKBOX') {
                        $response .= '&nbsp;&nbsp;&nbsp;&nbsp;'.'Да'.'<br/><br/>';
                    } else {
                        $q = (!empty($subQuestion)) ? str_replace(array('b:',':b','i:',':i'), '',strip_tags($subQuestion)) : '-';
                        $response .= '&nbsp;&nbsp;&nbsp;&nbsp;'.$q.'<br/><br/>';
                    }
                    
                }
            }
        } else {
            if ($arrQuestion[$questionKey]['TYPE']=='CHECKBOX') {
                $response .= 'Да<br/><br/>';
            } else {
                $q = (!empty($question)) ? str_replace(array('b:',':b','i:',':i'), '',strip_tags($question)) : '-';
                $response .= $q."<br/><br/>";
            }
        }
        ?>
    <?endforeach;?>
    <?
    // if ($arResult['PROPERTIES']['WEBINAR']['VALUE']==$_POST['webinar']) {

        $userData = $_SERVER['HTTP_USER_AGENT']."\n".$_SERVER['REQUEST_URI'];

        $el = new CIBlockElement;

        $PROP = array();
        $PROP['FIO'] = filter_var($_POST['personal']['FIO'], FILTER_SANITIZE_STRING);
        $PROP['POSITION'] = filter_var($_POST['personal']['POSITION'], FILTER_SANITIZE_STRING);
        $PROP['COMPANY'] = filter_var($_POST['personal']['COMPANY'], FILTER_SANITIZE_STRING);
        $PROP['WORK_PHONE'] = filter_var($_POST['personal']['WORK_PHONE'], FILTER_SANITIZE_STRING);
        $PROP['MOBILE_PHONE'] = filter_var($_POST['personal']['MOBILE_PHONE'], FILTER_SANITIZE_STRING);
        $PROP['EMAIL'] = filter_var($_POST['personal']['EMAIL'], FILTER_SANITIZE_STRING);
        $PROP['WEBINAR'] = $arResult['PROPERTIES']['WEBINAR']['VALUE'];
        $PROP['USER_IP'] = $_SERVER['REMOTE_ADDR'];
        $PROP['USER_DATA'] = $userData;
        $PROP['FORM'] = $arResult['ID'];


        $contacts = '';
        $contacts .= '<strong>ФИО:</strong> '.$PROP['FIO'].'<br/>';
        $contacts .= '<strong>Должность:</strong> '.$PROP['POSITION'].'<br/>';
        $contacts .= '<strong>Компания:</strong> '.$PROP['COMPANY'].'<br/>';
        $contacts .= '<strong>Раб. телефон:</strong> '.$PROP['WORK_PHONE'].'<br/>';
        $contacts .= '<strong>Моб. телефон:</strong> '.$PROP['MOBILE_PHONE'].'<br/>';
        $contacts .= '<strong>E-mail:</strong> '.$PROP['EMAIL'].'<br/>';
        $message = $html_template_start."\n".$contacts."<br/>\n".$response."\n".$html_template_end;

        $arLoadProductArray = array(
            "IBLOCK_SECTION_ID" => false,
            "IBLOCK_ID"      => 43,
            "PROPERTY_VALUES"=> $PROP,
            "NAME"           => "Отзыв на вебинар",
            "ACTIVE"         => "Y",
            "PREVIEW_TEXT"   => $message,
        );

        if($PRODUCT_ID = $el->Add($arLoadProductArray)) {
            $subject = '=?UTF-8?B?' . base64_encode($subject) . '?=';
            $headers  = "MIME-Version: 1.0\r\n"; 
            $headers .= "Content-type: text/html; charset=utf-8\r\n";
            $headers .= "From: $from\r\n";
            mail($sendMail, $subject, $message, $headers);
            echo "<p style=\"color: red;text-align: center\">СПАСИБО! <br>До встречи на наших вебинарах!</p></div>";
        }
        else
            echo "Возникла ошибка при сохранении отзыва";
    // }
    ?>
<?endif;?>
<?if (!empty($arrQuestion) && empty($_POST['question'])):?>

<div class="four left">
    <div class="four left left-sidebar">
        <div class="sub-current">
            <p style="margin-top:0;">
            <?= 'Вебинар '.mb_strtolower(FormatDate("d F Y", MakeTimestamp($arResult['PROPERTIES']['WEBINAR_DATE']['VALUE'])), 'UTF-8'); ?>
            </p>
        </div>
    </div>
</div>
<div class="twelve right pageform soft-grey atcivation">
    <form action="" method="POST" class="pageform-container">
    <input type="hidden" name="webinar" value="<?=$arResult['PROPERTIES']['WEBINAR']['VALUE']?>">
    <p style="font-size: 12px; padding-bottom: 15px;"><?=(!empty($arResult['PROPERTIES']['FORM_DESCRIPTION']['~VALUE']['TEXT'])) ? $arResult['PROPERTIES']['FORM_DESCRIPTION']['~VALUE']['TEXT'] : 'Уважаемые коллеги!<br/>Для повышения качества проводимых мероприятий просим Вас оставить отзыв о вебинаре' ?></p>
    <h3 style="padding: 0 0 30px 0; line-height: 24px;"><?=(!empty($arResult['PROPERTIES']['FORM_TITLE']['~VALUE']['TEXT'])) ? $arResult['PROPERTIES']['FORM_TITLE']['~VALUE']['TEXT'] : 'Заполните, пожалуйста, форму:' ?></h3>

            <div>
                <br/>
                <h5><b>1. Представьтесь пожалуйста:</b></h5>
                <br/>
            </div>
            <div class="clearfix"></div>

    <div class="clearfix"></div>
    <div class="unit">
        <label for="form_fio">ФИО</label><br/>
        <input type="text" name="personal[FIO]" id="form_fio">
        <br/><br/>
    </div>
    <div class="unit">
        <label for="form_position">Должность</label><br/>
        <input type="text" name="personal[POSITION]" id="form_position">
        <br/><br/>
    </div>
    <div class="clearfix"></div>
    <div class="unit">
        <label for="form_company">Компания</label><br/>
        <input type="text" name="personal[COMPANY]" id="form_company">
        <br/><br/>
    </div>
    <div class="unit">
        <label for="form_work_phone">Раб. телефон</label><br/>
        <input type="text" name="personal[WORK_PHONE]" id="form_work_phone">
        <br/><br/>
    </div>
    <div class="clearfix"></div>
    <div class="unit">
        <label for="form_mobile_phone">Моб. телефон</label><br/>
        <input type="text" name="personal[MOBILE_PHONE]" id="form_mobile_phone">
        <br/><br/>
    </div>
    <div class="unit">
        <label for="form_email">E-mail</label><br/>
        <input type="text" name="personal[EMAIL]" id="form_email">
        <br/><br/>
    </div>
    <div class="clearfix"></div>
    
    <?foreach ($arrQuestion as $questionKey => $question):?>
        <?
        $question['TEXT'] = str_replace('b:','<b>', $question['TEXT'], $begin_cnt);
        $question['TEXT'] = str_replace(':b','</b>', $question['TEXT'], $end_cnt);
        if ($begin_cnt>$end_cnt) {
            $diff = $begin_cnt-$end_cnt;
            for($i=0;$i<$diff;$i++) {
                $question_text.'</b>';
            }
        }
        $question['TEXT'] = str_replace('i:','<i>', $question['TEXT'], $begin_cnt);
        $question['TEXT'] = str_replace(':i','</i>', $question['TEXT'], $end_cnt);
        if ($begin_cnt>$end_cnt) {
            $diff = $begin_cnt-$end_cnt;
            for($i=0;$i<$diff;$i++) {
                $question_text.'</i>';
            }
        }
        ?>
        <?if ($question['TYPE']=='COMPONENT'):?>
            <div>
                <br/>
                <h5><b><?=$question['NUMBER']?>.</b> <?=$question['TEXT']?></h5>
                <br/>
            </div>
            <div class="clearfix"></div>
            <?$i=0;?>
            <?foreach($question['ITEMS'] as $subQuestionKey => $subQuestion):?>
                <?
                $elementId = 'question_'.$questionKey.'_'.$subQuestionKey;
                $strId = 'id="'.$elementId.'"';
                $strName = 'name="question['.$questionKey.']['.$subQuestionKey.']"';
                switch ($subQuestion['TYPE']) {
                    case 'CHECKBOX':
                        echo '<div class="unit" style="width:41%;">'."\n";
                        echo '<label for="'.$elementId.'">'.$subQuestion['TEXT'].'</label>'."\n";
                        echo '<input style="float:left; margin-right:10px;" type="checkbox" '.$strId.' '.$strName.'>';
                        break;
                    case '1-10':
                        echo '<div class="unit" style="width:41%; margin-bottom:10px;">'."\n";
                        echo '<label for="'.$elementId.'" class="label-1-10">'.$subQuestion['TEXT'].'</label>'."\n";
                        echo '<input type="text" '.$strId.' '.$strName.' placeholder="1-10" maxlength="2" class="short_input" style="float:left; margin-top:-4px;">';
                        break;
                    case '1-5':
                        echo '<div class="unit" style="width:41%; margin-bottom:10px;">'."\n";
                        echo '<label for="'.$elementId.'" style="padding-left: 10px;">'.$subQuestion['TEXT'].'</label>'."\n";
                        echo '<input type="text" '.$strId.' '.$strName.' placeholder="1-5" maxlength="2" class="short_input" style="float:left; margin-top:-4px;">';
                        break;
                    case '1-10F':
                        echo '<div class="unit" style="width:82%; margin-bottom:10px;">'."\n";
                        echo '<label for="'.$elementId.'" style="padding-left: 10px;">'.$subQuestion['TEXT'].'</label>'."\n";
                        echo '<input type="text" '.$strId.' '.$strName.' placeholder="1-10" maxlength="2" class="short_input" style="float:left; margin-top:-4px;">';
                        break;
                    case '1-5F':
                        echo '<div class="unit" style="width:82%; margin-bottom:10px;">'."\n";
                        echo '<label for="'.$elementId.'" style="padding-left: 10px;">'.$subQuestion['TEXT'].'</label>'."\n";
                        echo '<input type="text" '.$strId.' '.$strName.' placeholder="1-5" maxlength="2" class="short_input" style="float:left;margin-top:-4px;">';
                        break;
                    case 'TEXTAREA':
                        echo '<div class="unit">'."\n";
                        echo '<label for="'.$elementId.'" style="float:left; margin-top:5px; margin-right:10px;">'.$subQuestion['TEXT'].'</label>'."\n";
					echo '<textarea '.$strId.' '.$strName.' style="resize: both; width: 432px; height: 70px;"></textarea>';
                        break;
                    case 'TEXTF':
                        echo '<div class="unit" style="width:82%;">'."\n";
                        echo '<label for="'.$elementId.'">'.$subQuestion['TEXT'].'</label><br/>'."\n";
                        echo '<input type="text" '.$strId.' '.$strName.' style="width:100%">';
                        break;
                    default:
                        echo '<div class="unit">'."\n";
                        echo '<label for="'.$elementId.'">'.$subQuestion['TEXT'].'</label><br/>'."\n";
                        echo '<input type="text" '.$strId.' '.$strName.'>';
                        break;
                }
                ?>
                <br/><br/>
                </div>
                
                <?$i++;?>
                <?
                if($i>=2) {
                    echo '<div class="clearfix"></div>';
                    $i = 0;
                }
                ?>
            <?endforeach;?>
            <div class="clearfix"></div>
        <?else:?>
            <div>
                <h5><b><?=$question['NUMBER']?>.</b> <?=$question['TEXT']?></h5>
                <br/>
            </div>
            <div class="clearfix"></div>
            <?
            switch ($question['TYPE']) {
                case 'CHECKBOX':
                    echo '<div class="unit">';
                    echo '<input type="checkbox" name="question['.$questionKey.']">';
                    echo '<br/><br/>';
                    echo '</div>';
                    break;
                case '1-10':
                    echo '<div class="unit">';
                    echo '<input type="text" name="question['.$questionKey.']" placeholder="1-10" maxlength="2" class="short_input">';
                    echo '<br/><br/>';
                    echo '</div>';
                    break;
                case '1-5':
                    echo '<div class="unit">';
                    echo '<input type="text" name="question['.$questionKey.']" placeholder="1-5" maxlength="2" class="short_input">';
                    echo '<br/><br/>';
                    echo '</div>';
                    break;
                case '1-10F':
                    echo '<div class="unit">';
                    echo '<input type="text" name="question['.$questionKey.']" placeholder="1-10" maxlength="2" class="short_input">';
                    echo '<br/><br/>';
                    echo '</div>';
                    break;
                case '1-5F':
                    echo '<div class="unit">';
                    echo '<input type="text" name="question['.$questionKey.']" placeholder="1-5" maxlength="2" class="short_input">';
                    echo '<br/><br/>';
                    echo '</div>';
                    break;
                case 'TEXTAREA':
                    echo '<div class="unit"">';
                    echo '<textarea name="question['.$questionKey.']" style="resize: both; width: 548px; height: 70px;"></textarea>';
                    echo '<br/><br/>';
                    echo '</div>';
                    break;
                case 'TEXTF':
                    echo '<div class="unit">';
                    echo '<input type="text" name="question['.$questionKey.']">';
                    echo '<br/><br/>';
                    echo '</div>';
                    break;
                default:
                    echo '<div class="unit">';
                    echo '<input type="text" name="question['.$questionKey.']">';
                    echo '<br/><br/>';
                    echo '</div>';
                    break;
            }
            ?>
            <div class="clearfix"></div>
        <?endif;?>
    <?endforeach;?>
    <div class="position">
        <input name="submit" class="blue icons" id="submit-button" value="Отправить отзыв" style="padding: 5px 35px 6px 13px;" type="submit">
    </div>
    </form>
</div>
<?endif;?>