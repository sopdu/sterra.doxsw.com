<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<div class="twelve right">
<br><br>
<? $i = 2;?>
<? $k = 1;?>
<?foreach($arResult["ITEMS"] as $arItem):?>

<? if($i == 1):?>
<div>Последняя публикация</div>
<div><?echo $arItem["NAME"]?></div>
<div><?echo $arItem["DISPLAY_ACTIVE_FROM"];?></div>

<?$i = $i+1;?>
<?else:?>
<?if ($i == 2):?>
<h3><?$tgod = date("Y", strtotime($arItem["DISPLAY_ACTIVE_FROM"])); echo $tgod;?>&nbsp;год</h3>
<br>
<div class="twelve publication">
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

<?$i = $i+1;?>
<?endif;?>

<?$god = date("Y", strtotime($arItem["DISPLAY_ACTIVE_FROM"]));?>

<?if($god < $tgod):?>
<?$k = 1;?>
<br><br>
<h3><?$tgod = date("Y", strtotime($arItem["DISPLAY_ACTIVE_FROM"])); echo $tgod;?>&nbsp;год</h3>
<br>

<table style="width: 100%;">
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
<?if($k == 3):?>
<div class="clear"></div>
<? $k = 1 ?>
<?endif;?>

<?endif;?>
<?endforeach;?>
		<?if(count($arResult["ITEMS"])==0):?>
			По Вашему запросу публикаций не найдено
		<?endif;?>
</div>
