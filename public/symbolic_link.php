<?php $target = '/home/deemaslifestyle/leafsbd.deemaslifestyle.com/storage/app/public/';

$shortcut = '/home/deemaslifestyle/leafsbd.deemaslifestyle.com/public/storage';
var_dump(symlink($target, $shortcut));
exit;
?>