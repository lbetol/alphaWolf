<?php
namespace abox;
require_once "includes.php";
sess("root",__DIR__."/");
$user = user();
if(!$user){ if(cook("user")){ sess("user",cook("user")); } }
if($user){ $i = (int)qcell("Users","view")+1; qin("UPDATE Users set view=$i where code='$user'"); }
$sc=schema();?> 
<!DOCTYPE xhtml>
<html lang="pt-BR">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="description" content="">
        <meta name="Alberto Barrios" content="Alphabox Dev Team">
        <!--script src="lib/chart/Chart.bundle.js"></script-->
        <script src="lib/jquery.min.js"></script>
        <script src="lib/jqui.min.js"></script>
        <!--script src="lib/std.min.js"></script-->
        <script src="lib/std.js"></script>
        <script src="project/usr.js"></script>
        <script src="lib/d3js/d3.js"></script>
        <!--link href="lib/std.min.css" rel="stylesheet"-->
        <link href="lib/std.css" rel="stylesheet">
        <link href="project/usr.css" rel="stylesheet">
        <link rel="icon" type="image/png" href="img/abox/icon_light.png">
        <title>AlphaWolf</title>
    </head>
    <body class="bmain fmain ab-f11px rbt">

    </body>
     <script type="text/javascript">
        abox.Schema = <?=json_encode($sc,JSON_PRETTY_PRINT);?>
    </script>
    <style type="text/css">
        .bmain    { background: <?=$sc->backmain    ?>; }
        .bheader  { background: linear-gradient(to right,<?=$sc->backheader0?>,<?=$sc->backheader1?>,<?=$sc->backheader2?>); }
        .bwindow  { background: <?=$sc->backwindow  ?>; }
        .bdialog  { background: <?=$sc->backdialog  ?>; }
        .bpanel   { background: <?=$sc->backpanel   ?>; }
        .bvariant { background: <?=$sc->variant     ?>; }
        .bspan    { background: <?=$sc->span        ?>; }
        .fpanel   { color     : <?=$sc->fontpanel   ?>; }
        .fmain    { color     : <?=$sc->fontmain    ?>; }
        .fheader  { color     : <?=$sc->fontheader  ?>; }
        .fvariant { color     : <?=$sc->variant     ?>; }
        .fspan    { color     : <?=$sc->span        ?>; }
        .fdisabled{ color     : <?=$sc->fontdisabled?>; }
    </style>
    <script>
        $(document).ready(function(){abox.USER='<?=user()?>'; __start(); });
    </script>
</html>
