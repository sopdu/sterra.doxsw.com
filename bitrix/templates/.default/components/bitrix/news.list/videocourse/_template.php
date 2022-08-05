<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$this -> setFrameMode(true);?>
          <div class="support-education-page__control">
            <div class="custom-select">
              <select>
                <option value="0">Кем выдан</option>
			<?$property_enums = CIBlockPropertyEnum::GetList(Array(), Array("IBLOCK_ID"=>56, "CODE"=>"VERSIA"));
						while($enum_fields = $property_enums->GetNext()):
						print_r($property_enums);
						?>
                <option selected><?=$enum_fields["VALUE"]?></option>
				  <pre><?print_r($enum_fields)?></pre>
				<?endwhile;?> 
              </select>
            </div>
<div class="search-field js-input-search-field">
              <div class="search-field__icon">
                      <svg width="14" height="14">
                        <use xlink:href="#i-search" href="#i-search"></use>
                      </svg>
              </div>
	<form action="/local/ajax/videocourse.php">
              <input class="js-input-search form-control" value="" placeholder="Поиск по названию" name="q" data-field autocomplete="off">
              <button class="js-input-search-clear icon-btn search-field__reset" type="button" data-reset></button>
	</form>
            </div>
          </div>
          <div class="support-education-page__content">
			  <?foreach ($arResult["ITEMS"] as $arItem):
						$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
						$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"));
				?>
			  
            <div class="support-education-page__video" id="<?=$this->GetEditAreaId($arItem['ID']);?>"><a class="support-education-page__video__item__wrap" href="<?=$arItem["DETAIL_PAGE_URL"]?>">
                <div class="support-education-page__video__item-image"><img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>"></div>
                <div class="support-education-page__video__item__title"><?=$arItem["NAME"]?></div></a></div>
		<?endforeach;?>
          </div></div>
