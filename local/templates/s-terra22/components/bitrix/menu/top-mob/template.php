<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?php // echo "<pre>"; print_r($arResult); echo "</pre>"; ?>

<?if (!empty($arResult)):?>

<div class="header-pane__nav">
	<div class="header-menu">
		<section class="header-menu-section" data-section="account">
			<header class="header-menu-section__header">
                <!--<a class="header-menu-section__title" href="https://www.s-terra.ru/auth/">Личный кабинет</a>-->
			</header>
		</section>
		<?foreach($arResult as $arItem):?>
			<?if(!empty($arItem["PARAMS"]["OUT_DIV_CLASS"])):?>
				<div class="<?=$arItem["PARAMS"]["OUT_DIV_CLASS"]?>">
			<?endif;?>
			<section class="header-menu-section" data-section="<?=$arItem["PARAMS"]["DATA_SECTION"]?>">
				<header class="header-menu-section__header">
					<a class="header-menu-section__title" href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a>
					<?if(!empty($arItem['IS_PARENT'])):?>
						<button class="icon-btn header-menu-section__toggler">
							<svg width="12" height="7">
								<use xlink:href="#i-chevron-bottom" href="#i-chevron-bottom"></use>
							</svg>
						</button>
					<?endif;?>
				</header>
				<?if(!empty($arItem['IS_PARENT'])):?>
					<div class="header-menu-section__items">
						<ul>
							<?foreach($arItem["CHILDREN"] as $ar1Item):?>
								<li<?//=($ar1Item["SELECTED"] ? ' class="active"' : '')?> data-level="1">
									<a class="" href="<?=$ar1Item["LINK"]?>"><?=$ar1Item["TEXT"]?></a>
										<?if(!empty($ar1Item['IS_PARENT'])):?>
                                            <button class="icon-btn header-menu-section__toggler deep-toggler">
                                                <svg width="12" height="7">
                                                    <use xlink:href="#i-chevron-bottom" href="#i-chevron-bottom"></use>
                                                </svg>
                                            </button>
											<ul>
                                                <?foreach($ar1Item["CHILDREN"] as $ar2Item):?>
                                                    <?if(!empty($ar2Item['IS_PARENT'])):?>
                                                        <?foreach($ar2Item["CHILDREN"] as $ar3Item):?>
                                                            <li<?=($ar3Item["SELECTED"] ? ' class="active"' : '')?> data-level="2">
                                                                <a class="" href="<?=$ar3Item["LINK"]?>"><?=$ar3Item["TEXT"]?></a>
                                                            </li>
                                                        <?endforeach;?>
                                                    <?else:?>
                                                        <li<?=($ar2Item["SELECTED"] ? ' class="active"' : '')?> data-level="2">
                                                            <a class="" href="<?=$ar2Item["LINK"]?>"><?=$ar2Item["TEXT"]?></a>
                                                        </li>
                                                    <?endif;?>
                                                <?endforeach;?>
											</ul>
										<?endif;?>
								</li>
							<?endforeach;?>
						</ul>
					</div>
				<?endif;?>
			</section>
			<?if(!empty($arItem["PARAMS"]["OUT_DIV_CLASS"])):?>
				</div>
			<?endif;?>
		<?endforeach;?>
	</div>
</div>

<?endif?>
