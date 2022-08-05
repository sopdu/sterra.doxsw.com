<?
$path = explode('/', $APPLICATION->GetCurPage());
?>
<ul class="pressnews-page__filter">
    <a href="/press/news/" class="js-control-item pressnews-page__filter__item">
        <button class="pressnews-page__filter__button <?=$path[count($path)-2] == 'news' ? 'active' : ''?>" type="button" data-type="1">Новости</button>
    </a>
    <a href="/press/ads/" class="js-control-item pressnews-page__filter__item">
        <button class="pressnews-page__filter__button <?=$path[count($path)-2] == 'ads' ? 'active' : ''?>" type="button" data-type="2">Объявления</button>
    </a>
    <a href="/press/exhibitions_and_conferences/" class="js-control-item pressnews-page__filter__item">
        <button class="pressnews-page__filter__button <?=$path[count($path)-2] == 'exhibitions_and_conferences' ? 'active' : ''?>" type="button" data-type="3">Мероприятия</button>
    </a>
    <a href="/press/webinars/" class="js-control-item pressnews-page__filter__item">
        <button class="pressnews-page__filter__button <?=$path[count($path)-2] == 'webinars' ? 'active' : ''?>" type="button" data-type="4">Вебинары</button>
    </a>
    <a href="/press/publications/" class="js-control-item pressnews-page__filter__item">
        <button class="pressnews-page__filter__button <?=$path[count($path)-2] == 'publications' ? 'active' : ''?>" type="button" data-type="5">Публикации</button>
    </a>
</ul>
<style>
    .pressnews-page__filter__item{
        text-decoration: none;
    }
</style>