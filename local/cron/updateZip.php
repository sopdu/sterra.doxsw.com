<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

class updateZip{
    private $settings = Array(
        'iblock' => 60
    );

    private function getItems(){
        $arFilter = Array('IBLOCK_ID' => $this->settings['iblock']);
        if ($this->settings['type']) $arFilter['PROPERTY_TYPE'] = $this->settings['type'];
        $items = CIBlockElement::GetList(
            Array('SORT' => 'ASC'),
            $arFilter,
            false,
            false,
            Array('PROPERTY_FILE')
        );
        return $items;
    }

    private function createZip($items){
        $zip = new ZipArchive();

        if ($this->settings['fileName']) $DelFilePath = $this->settings['fileName'];
        else $DelFilePath="materials.zip";
        if(file_exists($_SERVER['DOCUMENT_ROOT']."/".$DelFilePath)) {
            unlink ($_SERVER['DOCUMENT_ROOT']."/".$DelFilePath);
        }
        if ($zip->open($_SERVER['DOCUMENT_ROOT']."/".$DelFilePath, ZIPARCHIVE::CREATE) != TRUE) {
            die ("Could not open archive");
        }
        while ($fileItem = $items->Fetch()){
            if (!$fileItem['PROPERTY_FILE_VALUE']) continue;
            $path = $_SERVER['DOCUMENT_ROOT'].CFile::GetPath($fileItem['PROPERTY_FILE_VALUE']);
            $pathArr = explode('/', $path);
            $fileName = $pathArr[count($pathArr)-1];
            echo "<pre>";
            print_r($fileName);
            echo "</pre>";
            $zip->addFile($path, $fileName);
        }
        $zip->close();
    }

    public function main($settings = []){
        $this->settings = array_merge($this->settings, $settings);
        CModule::IncludeModule('iblock');
        $items = $this->getItems();
        $this->createZip($items);
    }
}
$updateZip = new updateZip;
$updateZip->main();
$updateZip->main(['type' => 44, 'fileName' => 'materials-prez.zip']);
$updateZip->main(['type' => 45, 'fileName' => 'materials-print.zip']);
$updateZip->main(['type' => 46, 'fileName' => 'materials-corp.zip']);
?>