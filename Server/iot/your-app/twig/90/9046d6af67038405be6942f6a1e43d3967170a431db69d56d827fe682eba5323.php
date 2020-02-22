<?php

/* charts/example-chart.phtml */
class __TwigTemplate_958a4ef8cbf54851e33251d8f2024357c9ffa267df09d5d4263da45555d65a87 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<html>
<head>
<script type=\"text/javascript\" src=\"https://www.google.com/jsapi\"></script>
<script type=\"text/javascript\" src=\"http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js\"></script>
<script type=\"text/javascript\">
    google.load(\"visualization\", \"1\", {packages:[\"corechart\"]});
    google.setOnLoadCallback(drawChart);
    function drawChart() {
        var jsonData = \$.ajax({
            url: \"/charts/chartdata-as-json\",
            dataType:\"json\",
            async: false
            }).responseText;
    // Create our data table out of JSON data loaded from server.
    var data = new google.visualization.DataTable(jsonData);
    var options = {
        width: 800, height: 480,
        title: 'Company Performance'
    };
    var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
    chart.draw(data, options);
}
</script>
</head>
<body>
<div id=\"chart_div\"></div>
</body>
</html>";
    }

    public function getTemplateName()
    {
        return "charts/example-chart.phtml";
    }

    public function getDebugInfo()
    {
        return array (  19 => 1,);
    }
}
/* <html>*/
/* <head>*/
/* <script type="text/javascript" src="https://www.google.com/jsapi"></script>*/
/* <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>*/
/* <script type="text/javascript">*/
/*     google.load("visualization", "1", {packages:["corechart"]});*/
/*     google.setOnLoadCallback(drawChart);*/
/*     function drawChart() {*/
/*         var jsonData = $.ajax({*/
/*             url: "/charts/chartdata-as-json",*/
/*             dataType:"json",*/
/*             async: false*/
/*             }).responseText;*/
/*     // Create our data table out of JSON data loaded from server.*/
/*     var data = new google.visualization.DataTable(jsonData);*/
/*     var options = {*/
/*         width: 800, height: 480,*/
/*         title: 'Company Performance'*/
/*     };*/
/*     var chart = new google.visualization.LineChart(document.getElementById('chart_div'));*/
/*     chart.draw(data, options);*/
/* }*/
/* </script>*/
/* </head>*/
/* <body>*/
/* <div id="chart_div"></div>*/
/* </body>*/
/* </html>*/
