<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?php // echo "<pre>"; print_r($arResult); echo "</pre>"; ?>

<?if (!empty($arResult)):?>
	<div class="catalog-block__filter-col__items">
		<?foreach($arResult as $arItem):?>
		<div class="catalog-block__filter-col__items-block">
			<div class="catalog-block__filter-col__items-block__title"><?=$arItem["TEXT"]?></div>
				<?foreach($arItem["CHILDREN"] as $ar1Item):?>
				<div class="filter-dropdown">
					<div class="filter-dropdown-title">
                        <?if(count($ar1Item["CHILDREN"]) > 1):?>
						<svg width="12" height="7">
							<use xlink:href="#i-arrow-filter" href="#i-arrow-filter"></use>
						</svg>
                        <?endif?>
                        <a href="<?=$ar1Item["LINK"]?>"><?=$ar1Item["TEXT"]?></a>
					</div>
					<div class="filter-dropdown-container">
                        <?if(count($ar1Item["CHILDREN"]) > 1):?>
						<?foreach($ar1Item["CHILDREN"] as $ar2Item):?>
							<a class="filter-dropdown-item" href="<?=$ar2Item["LINK"]?>"><?=$ar2Item["TEXT"]?></a>
						<?endforeach;?>
                        <?endif?>
					</div>

				</div>
				<?endforeach;?>
		</div>
		<?endforeach;?>
	</div>
<?endif?>
