<?php
$folder='test';
$file = 'test-writefile.txt';
$path = '../../upload/';
if(!is_dir($path.$folder.'/')) {
    mkdir($path.$folder.'/',0777);
}
$fp = fopen($path.$folder.'/'.$file,'w+');
fwrite($fp, 'Cats chase mice');
fclose($fp);

?>OK