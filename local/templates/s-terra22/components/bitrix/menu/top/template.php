<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?php // echo "<pre>"; print_r($arResult); echo "</pre>"; ?>

<?if (!empty($arResult)):?>

<div class="header__navigation">
	<!-- Элемент списка (может быть со вложенным списком)-->
	<!-- Секция меню в плашке на мобильных-->
	<nav class="header-navigation">
		<ul>
		<?foreach($arResult as $arItem):?>
			<?if(!empty($arItem['IS_PARENT'])):?>
			<li<?=($arItem["SELECTED"] ? ' class="active"' : '')?> data-submenu="<?=$arItem["PARAMS"]["DATA_SUBMENU"]?>">
				<a class="" href="<?=$arItem["LINK"]?>">
					<?=$arItem["TEXT"]?>
					<svg width="8" height="5">
						<use xlink:href="#i-chevron-bottom" href="#i-chevron-bottom"></use>
					</svg>
				</a>
				<div class="header-navigation-pane" data-pane="<?=$arItem["PARAMS"]["DATA_SUBMENU"]?>" hidden>
					<div class="header-navigation-pane__block">
						<div class="container">
							<div class="row header-section">
								<div class="col col-auto">
									<div class="header-section__info"><span class="header-section__name" href="#"><?=$arItem["TEXT"]?></span>
										<div class="header-section__description"><?=$arItem["PARAMS"]["DESC"]?></div>
									</div>
								</div>
								<div class="col col-auto">
									<div class="header-section__list">
										<ul class="<?=$arItem["PARAMS"]["UL_CLASS"]?>">
											<?foreach($arItem["CHILDREN"] as $ar1Item):?>
												<li<?//=($ar1Item["SELECTED"] ? ' class="active"' : '')?> data-level="1">
													<a class="" href="<?=$ar1Item["LINK"]?>"><?=$ar1Item["TEXT"]?></a>
													<?if(!empty($ar1Item['IS_PARENT'])):?>
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
												<?if(!empty($ar1Item["PARAMS"]["COL_BRAKE"])):?>
										</ul>
									</div>
								</div>
								<div class="col col-auto">
									<div class="header-section__list">
										<ul>
												<?endif;?>
											<?endforeach;?>
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</li>
			<?else:?>
				<li><a class="" href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></li>
			<?endif;?>
		<?endforeach;?>
		</ul>
	</nav>
</div>

<?endif?>
