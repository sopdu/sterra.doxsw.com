<?
function EditData ($DATA) 
{
	$MES = array( 
	"01" => "Января", 
	"02" => "Февраля", 
	"03" => "Марта", 
	"04" => "Апреля", 
	"05" => "Мая", 
	"06" => "Июня", 
	"07" => "Июля", 
	"08" => "Августа", 
	"09" => "Сентября", 
	"10" => "Октября", 
	"11" => "Ноября", 
	"12" => "Декабря"
	);
	$arData = explode(".", $DATA); 
	$d = ($arData[0] < 10) ? substr($arData[0], 1) : $arData[0];

	$newData = array('DAY'=>$d, 'MONTH'=>$MES[$arData[1]], 'YEARS'=>substr($arData[2], 0, 4)."г."); 
	return $newData;
}

function HumanBytes($size) {
    $filesizename = array(" Bytes", " KB", " MB", " GB", " TB", " PB", " EB", " ZB", " YB");
    return $size ? round($size / pow(1024, ($i = floor(log($size, 1024)))), 2) . $filesizename[$i] : '0 Bytes';
} 



function getFileExt($filename){
	return array_pop(explode('.', $filename));
}