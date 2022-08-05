<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
// echo "<pre>"; print_r($arResult); echo "</pre>";
?>

	<div class="container">
		<div class="awards-item-page__title"><?=$arResult['NAME']?></div>
		<div class="awards-item-page__content row">
			<div class="awards-item-page__images-block col col-12 col-md-4">
				<div class="awards-item-page__images-slider__top my-gallery" <? if (count($arResult["IMAGES"]) > 1) : ?>id="awards-item-page__images-slider__top"<?php endif;?>>
					<? if (count($arResult["IMAGES"]) < 2) { ?>
                            <div class="rel-block">
                                <figure>
                                    <a href="<?=$arResult["IMAGES"][0]?>"><img src="<?=$arResult["IMAGES"][0]?>" alt="">
                                        <div class="slider-item__icons">
                                            <div class="slider-item__icons-wrap">
                                                <svg width="28" height="28">
                                                    <use xlink:href="#i-loop" href="#i-loop"></use>
                                                </svg>
                                            </div>
                                        </div>
                                    </a>
                                </figure>
                            </div>
					<? } else { ?>
						<? foreach($arResult["IMAGES"] as $src) { ?>
							<div class="slider-item">
								<figure><a href="<?=$src?>"><img src="<?=$src?>" alt="">
										<div class="slider-item__icons">
											<div class="slider-item__icons-wrap">
												<svg width="28" height="28">
													<use xlink:href="#i-loop" href="#i-loop"></use>
												</svg>
											</div>
										</div></a></figure>
							</div>
					<? }} ?>
				</div>
				<? if (count($arResult["IMAGES"]) > 1) { ?>
					<div class="awards-item-page__images-slider__bottom">
						<ul id="awards-item-page__images-slider__bottom">
							<? foreach($arResult["IMAGES"] as $src) { ?>
							<li><img src="<?=$src?>"></li>
							<? } ?>
						</ul>
					</div>
				<? } ?>
			</div>

			<div class="awards-item-page__text-block col col-12 col-md-8">
				<div class="awards-item-page__text-block__content">
					<?=$arResult['DETAIL_TEXT']?>
				</div>
				<div class="awards-item-page__text-block__btn-group"><a class="btn btn-primary-inverse btn-round <?=$arResult["PREV_ELEMENT"] != 'javascript:void(0);' ? '' : 'disabled'?>" href="<?=$arResult["PREV_ELEMENT"]?>">
						<svg width="7" height="12">
							<use xlink:href="#i-chevron-left" href="#i-chevron-left"></use>
						</svg></a><a class="btn btn-primary-inverse btn-round <?=$arResult["NEXT_ELEMENT"] != 'javascript:void(0);' ? '' : 'disabled'?>" href="<?=$arResult["NEXT_ELEMENT"]?>">
						<svg width="7" height="12">
							<use xlink:href="#i-chevron-right" href="#i-chevron-right"></use>
						</svg></a>


					<?if (CSite::InDir('/company/awards_and_appreciation/aw/')){ ?>
<a class="btn btn-primary-inverse" href="/company/awards_and_appreciation/">К списку наград</a>
					<?}else{?>
<a class="btn btn-primary-inverse" href="http://sterra.doxsw.com/company/awards_and_appreciation/?tab=appreciation">К списку благодарностей</a>
					<?}?>
</div>
			</div>
		</div>
	</div>
