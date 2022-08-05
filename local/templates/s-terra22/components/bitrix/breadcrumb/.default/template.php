<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

/**
 * @global CMain $APPLICATION
 */

$strReturn = '<div class="breadcrumb"><div class="container"><ul class="breadcrumb__list"><a class="breadcrumb__link" href="/" title="Главная ">Главная</a>';
$itemSize = count($arResult);
for($index = 0; $index < $itemSize; $index++)
{
	$title = strip_tags($arResult[$index]["TITLE"]);

	if($arResult[$index]["LINK"] <> "" && $index != $itemSize-1)
	{
		$strReturn .= '<a class="breadcrumb__link-cursor"> / </a> <a class="breadcrumb__link" href="'.$arResult[$index]["LINK"].'" title="'.$title.'">'.$title.'</a>';
	}
	else
	{
		$strReturn .= '<span class="breadcrumb__link-current"> / '.$title.'</span>';
	}
}

$strReturn .= '</ul></div></div>';

return $strReturn;