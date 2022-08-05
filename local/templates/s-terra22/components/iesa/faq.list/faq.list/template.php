<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

?>
<div class="support-faq-page page-main">
<?$APPLICATION->IncludeComponent("bitrix:breadcrumb", ".default", Array(
        "START_FROM" => "1",
        "PATH" => "",
        "SITE_ID" => SITE_ID,
    ),
        false
    );?>
<div class="container">
          <div class="support-faq-page__title">Часто задаваемые вопросы (F.A.Q)</div>
          <div class="support-faq-page__wrap home-faq">
	 <div class="home-faq__accordion">
              <div class="accordion" id="home-faq">
			<?foreach($arResult['ITEMS'] as $arItem):?>
                <section class="home-faq-item accordion-item">
                  <header class="home-faq-item__header accordion-item-header accordion-trigger">
                    <h2 class="home-faq-item__title"><?=$arItem["NAME"]?></h2>
                    <div class="home-faq-item__state"></div>
                  </header>
				 <div class="accordion-item-panel">
					<?=$arItem['PREVIEW_TEXT']?>
					<div class="block">
					<?=$arItem['DETAIL_TEXT']?>
					</div>
                  </div>
                </section>
			<?endforeach?>
 </div>

            </div>
            <div class="support-faq__controll">
				<div class="support-faq__controll__wrap" data-action="/local/ajax/support_faq.php" data-method="GET" data-max-length="13">
                <div class="support-faq__controll__text js-control-text">Показано 10 из 13</div>
                <button class="support-faq__controll__btn js-control-more btn btn-primary-inverse">Еще 3</button>
              </div>
              <button class="btn-primary btn" data-ask-question>Задать вопрос</button>
            </div>
</div></div></div></div>