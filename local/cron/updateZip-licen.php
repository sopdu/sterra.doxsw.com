<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

class updateZip{
    private $settings = Array(
        'iblock' => 22
    );

    private function getItems(){
        $items = CIBlockElement::GetList(
            Array('SORT' => 'ASC'),
            Array('IBLOCK_ID' => $this->settings['iblock'], 'ACTIVE' => 'Y'),
            false,
            false,
            Array('PROPERTY_FILE_FOR_SAVE')
        );
        return $items;
    }

    private function createZip($items){
        $zip = new ZipArchive();
        $DelFilePath="lic.zip";
        if(file_exists($_SERVER['DOCUMENT_ROOT']."/".$DelFilePath)) {
            unlink ($_SERVER['DOCUMENT_ROOT']."/".$DelFilePath);
        }
        if ($zip->open($_SERVER['DOCUMENT_ROOT']."/".$DelFilePath, ZIPARCHIVE::CREATE) != TRUE) {
            die ("Could not open archive");
        }
        while ($fileItem = $items->Fetch()){
            if (!$fileItem['PROPERTY_FILE_FOR_SAVE_VALUE']) continue;
            $path = $_SERVER['DOCUMENT_ROOT'].CFile::GetPath($fileItem['PROPERTY_FILE_FOR_SAVE_VALUE']);
            $pathArr = explode('/', $path);
            $fileName = $pathArr[count($pathArr)-1];
            echo "<pre>";
            print_r($fileName);
            echo "</pre>";
            $zip->addFile($path, $fileName);
        }
        $zip->close();
    }

    public function main(){
        CModule::IncludeModule('iblock');
        $items = $this->getItems();
        $this->createZip($items);
    }
}
$updateZip = new updateZip;
$updateZip->main();
?>