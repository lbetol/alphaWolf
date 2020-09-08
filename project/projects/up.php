<?php
namespace abox;
require("../../lib/std.php");
umask('0000');
$a = new Pics($_FILES['pic0']['name']);
$a->path(__DIR__."/files/".post('codigo').'/');
$a->force();
if((int)$a->query()==1) echo 1;
else echo $a->log().$a->path();
?>

