<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
// echo "<pre>"; print_r($arResult); echo "</pre>";
?>
<div class="vacancy-page-content">
	<div class="container">
		<div class="content-with-sidebar row">
			<div class="vacancy-content col col-12 col-md-8">
				<div class="vacancy-main">
					<div class="vacancy-main__title"><?=$arResult['NAME']?></div>
					<div class="vacancy-main__description">
                        <?if($arResult['PROPERTIES']['CITY']['VALUE'][0]):?>
						<div class="vacancy-main__description-item">
							<div class="title">Город</div>
							<div class="value"><?=$arResult['PROPERTIES']['CITY']['VALUE'][0].(isset($arResult['PROPERTIES']['CITY']['VALUE'][1]) ? " / ".$arResult['PROPERTIES']['CITY']['VALUE'][1] : "")?></div>
						</div>
                        <?endif?>
                        <?if($arResult['PROPERTIES']['SALARY']['VALUE']):?>
						<div class="vacancy-main__description-item">
							<div class="title">Зарплата</div>
							<div class="value"><?=$arResult['PROPERTIES']['SALARY']['VALUE']?></div>
						</div>
                        <?endif?>
					</div>
					<div class="vacancy-main__btn-group"><a class="btn btn-primary" href="#vacancy-form">Откликнуться</a>
						<a class="btn btn-primary-inverse" href="/contacts/">Контакты</a>
					</div>
					<?=$arResult['PREVIEW_TEXT']?>
					<div class="vacancy-main__contacts">
						<div class="vacancy-main__contacts__title">Контакты отдела персонала</div><a class="vacancy-main__contacts__phone-link" href="tel:+7 (499) 940-90-61">+7 (499) 940-90-61</a><a class="vacancy-main__contacts__email-link" href="mailto:hiring@s-terra.ru">hiring@s-terra.ru</a>
					</div>
				</div>
			</div>
			<div class="sidebar col col-12 col-md-4">
				<div class="vacancy-sidebar">
					<div class="vacancy-sidebar__title">Другие вакансии</div>
					<div class="vacancy-sidebar__content row">
						<? foreach($arResult["MORE"] as $arItem): ?>
						<div class="col col-12 col-sm-6 col-md-12">
							<a class="vacancy-sidebar__content-item" href="<?=$arItem["REF"]?>">
								<div class="vacancy-sidebar__content-item__subtitle"><?=$arItem["CITY"]?></div>
								<div class="vacancy-sidebar__content-item__title"><?=$arItem["NAME"]?></div>
							</a>
						</div>
						<?endforeach;?>
					</div>
					<a class="vacancy-sidebar__btn btn btn-primary-inverse" href="/company/rabota-u-nas/">Все вакансии</a>
				</div>
			</div>
		</div>
	</div>
</div>