<?php
namespace abox{
require("../../../../../../lib/std.php");

$codeproj = post("codeproj");

$projeto  = qout('select * from Projects where code="'.$codeproj.'"',Types::ARRAY)[0];
$arch     = $projeto["arch"];
$maxstage = qout('select max(numf) from Stages where arch="'.$arch.'"',Types::ARRAY)[0];
$max      = $maxstage['max(numf)'];
}

namespace{
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>D3 Timeline Chart</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/prism/0.0.1/prism.min.css" />
    <link rel="stylesheet" href="https://rawgithub.com/Caged/d3-tip/master/examples/example-styles.css" />
    <link rel="stylesheet" href="../dist/timeline-chart.css" />
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <section flex flex-full-center>
        <div id="chart"></div>
    </section>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/0.0.1/prism.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/d3/3.5.16/d3.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/d3-tip/0.6.7/d3-tip.min.js"></script>
    <script src="../dist/timeline-chart.js"></script>

    <script id="code">

        'use strict';

        const element = document.getElementById('chart');
        const data = [{
<?php
$contr = $max;
$contr++;

for ($i=$stage["numf"]; $i < $contr; $i++) 
{
    $num  = qout('select * from Stages where arch="'.$arch.'" having numf="'.$i.'"' ,Types::ARRAY)[0];
    $name = $num["name"];

?>

            label: 'Fases',
            data: [{
                label: 'Fase <?=$i?> - <?=$name?>',
                type: TimelineChart.TYPE.INTERVAL,
                from: new Date([2016, 6, 1]),
                to: new Date([2016, 7, 1]),
                customClass: 'blue-interval'
            }, {
                type: TimelineChart.TYPE.POINT,
                at: new Date([2016, 10, 1])
            }, {
                type: TimelineChart.TYPE.POINT,
                at: new Date([2016, 11, 1])
            }]
        }];
<?php
}
?>

        const timeline = new TimelineChart(element, data, {
            enableLiveTimer: true,
            tip: function(d) {
                return d.at || `${d.from}<br>${d.to}`;
            }
        }).onVizChange(e => console.log(e));

    </script>
</body>

</html>
<?php
}
?>