<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$APPLICATION->AddHeadScript("/include/publication/tooglepublication.js");?>




<div class="twelve right">
<br><br>
<div class="twelve publication">
<? $table_year = date_parse($arResult["ITEMS"][0]["DISPLAY_ACTIVE_FROM"])[year]; $table_year++; ?>
<? $i=0; ?>
<?foreach($arResult["ITEMS"] as $arItem):?>
<? $iter_year = date_parse($arItem["DISPLAY_ACTIVE_FROM"])[year]; ?>
<? if ($iter_year < $table_year): ?>
    <? $table_year = $iter_year; ?>
    <? if ($i>0): ?>
        </div><br><br>
    <?endif;?>
    <h3 onclick="hideshowpublish('<?=$table_year?>yearcontainer')"><a href="javascript:void(0)"><?=$table_year?>&nbsp;год</a></h3>
    <div id="<?=$table_year?>yearcontainer" <? if ($i>0): ?> style="display: none" <?endif;?> >
    <? $i++ ?>
    <br>
    <table  style="width: 100%;">
    <tr>
    <th style="width: 12%;" align="center"><strong>Месяц</strong></th>
    <th style="width: 28%;" align="center"><strong>Название публикации</strong></th>
    <th style="width: 18%;" align="center"><strong>Автор</strong></th>
    <th style="width: 18%;" align="center"><strong>Источник</strong></th>
    <th style="width: 12%;" align="center"><strong>Просмотр</strong></th>
    <th style="width: 14%;" align="center"><strong>Скачать</strong></th>
    </tr>
    </table>
<?endif;?>

        <table style="width: 100%;">
                <tr>
                    <td>
                        <?if(!empty($arItem['PROPERTIES']['DATE_STRING']['VALUE'])):?><?=$arItem['PROPERTIES']['DATE_STRING']['VALUE']?>
                        <?else:?><?=$arItem["DISPLAY_ACTIVE_FROM"]?><?endif?>
                    </td>
                    <td>
                        <?echo $arItem["NAME"]?>
                    </td>
                    <td>
                        <?=$arItem['PROPERTIES']['AUTOR']['VALUE']?>
                    </td>
                    <td>
                        <?=$arItem['PROPERTIES']['SOURSE']['VALUE']?>
                    </td>
                    <td>
                    <?if(!empty($arItem['PROPERTIES']['SAVE_FILE']['VALUE']['SRC'])):?>
                        <a href="<?=$arItem['PROPERTIES']['SAVE_FILE']['VALUE']['SRC']?>"><div class="icons icon-download eye"></div></a>
                    <?endif?>
                    </td>
                    <td>
                    <?if($arItem['PROPERTIES']['SAVE_FILE']['VALUE']):?>
                        <a href="/include/save_file.php?filename=<?=$arItem['PROPERTIES']['SAVE_FILE']['VALUE']['ID']?>"><div class="icons icon-download view"></div></a>
                        <br />
                        <i><?=HumanBytes($arItem['PROPERTIES']['SAVE_FILE']['VALUE']['FILE_SIZE'])?></i>
                    <?endif?>
                    </td>
                </tr>
        </table>

<?endforeach;?>
        <?if(count($arResult["ITEMS"])==0):?>
            По Вашему запросу публикаций не найдено
        <?endif;?>
</div>
</div>
