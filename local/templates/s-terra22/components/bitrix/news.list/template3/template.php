<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
use Bitrix\Main\Localization\Loc;
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
			<?foreach($arResult["ITEMS"] as $arItem):
			$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
			$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => Loc::getMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
			?>
                <section class="home-faq-item accordion-item" id="<?=$this->GetEditAreaId($arItem['ID']);?>" >
                  <header class="home-faq-item__header accordion-item-header accordion-trigger">
                    <h2 class="home-faq-item__title"><?=$arItem["NAME"]?></h2>
                    <div class="home-faq-item__state"></div>
                  </header>
				 <div class="accordion-item-panel">
                     <div class="accordion-preview">
                         <?=$arItem['PREVIEW_TEXT']?>
                     </div>
					<div class="block">
					<?=$arItem['DETAIL_TEXT']?>
					</div>
                  </div>
                </section>
			<?endforeach;?>
 </div> 

            </div>
            <div class="support-faq__controll">
				<div class="support-faq__controll__wrap" data-action="/local/ajax/support_faq.php" data-method="GET" data-max-length="<?=$arResult['NAV_RESULT']->nSelectedCount?>" >
                <div class="support-faq__controll__text js-control-text"></div>
                <button class="support-faq__controll__btn js-control-more btn btn-primary-inverse">Еще 3</button>
              </div>
              <button class="btn-primary btn" data-ask-question>Задать вопрос</button>
			  </div>
</div></div></div></div>