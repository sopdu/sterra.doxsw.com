<?php
class sopdu {
    public function Log($data, $title = ''){
        define('DEBUG_FILE_NAME', date('Y-m-d').'.log');
        if(!DEBUG_FILE_NAME){ return false; }
        $log = "\n------------------------\n";
        $log .= date("Y.m.d G:i:s")."\n";
        #$log .= $this->GetUser()."\n";
        $log .= (strlen($title) > 0 ? $title : 'DEBUG')."\n";
        $log .= print_r($data, 1);
        $log .= "\n------------------------\n";
        file_put_contents(__DIR__."/".DEBUG_FILE_NAME, $log, FILE_APPEND);
        #file_put_contents($_SERVER["DOCUMENT_ROOT"]."/ils_log/".DEBUG_FILE_NAME, $log, FILE_APPEND);
        return;
    }
    public function dump($value){
        $filePath = $_SERVER["DOCUMENT_ROOT"].'/ilsDump.txt';
        $file = fopen($filePath, "w");
        fwrite($file, print_r($value, 1));
        #fclose(); // не удалять - надо тестировать
        return;
    }
}
?>