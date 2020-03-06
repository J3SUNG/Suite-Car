<?php

/* chart.twig */
class __TwigTemplate_c1e4b5f55442439acb76f38b7d9ac7a9b17e0538e14e6890f7267d38a35b5601 extends Twig_Template
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
        echo "<html lang=\"en\">

<head>
    <script type='text/javascript' src='http://code.jquery.com/jquery.min.js'></script>
    <script type=\"text/javascript\" src=\"https://www.google.com/jsapi\"></script>
    <script type=\"text/javascript\" src=\"http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js\"></script>
    <!-- Required meta tags-->
    <meta charset=\"UTF-8\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1, shrink-to-fit=no\">
    <meta name=\"description\" content=\"au theme template\">
    <meta name=\"author\" content=\"Hau Nguyen\">
    <meta name=\"keywords\" content=\"au theme template\">
    
    <!-- Title Page-->
    <title>Suite Car</title>

    <!-- Fontfaces CSS-->
    <link href=\"css/font-face.css\" rel=\"stylesheet\" media=\"all\">
    <link href=\"vendor/font-awesome-4.7/css/font-awesome.min.css\" rel=\"stylesheet\" media=\"all\">
    <link href=\"vendor/font-awesome-5/css/fontawesome-all.min.css\" rel=\"stylesheet\" media=\"all\">
    <link href=\"vendor/mdi-font/css/material-design-iconic-font.min.css\" rel=\"stylesheet\" media=\"all\">

    <!-- Bootstrap CSS-->
    <link href=\"vendor/bootstrap-4.1/bootstrap.min.css\" rel=\"stylesheet\" media=\"all\">

    <!-- Vendor CSS-->
    <link href=\"vendor/animsition/animsition.min.css\" rel=\"stylesheet\" media=\"all\">
    <link href=\"vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css\" rel=\"stylesheet\" media=\"all\">
    <link href=\"vendor/wow/animate.css\" rel=\"stylesheet\" media=\"all\">
    <link href=\"vendor/css-hamburgers/hamburgers.min.css\" rel=\"stylesheet\" media=\"all\">
    <link href=\"vendor/slick/slick.css\" rel=\"stylesheet\" media=\"all\">
    <link href=\"vendor/select2/select2.min.css\" rel=\"stylesheet\" media=\"all\">
    <link href=\"vendor/perfect-scrollbar/perfect-scrollbar.css\" rel=\"stylesheet\" media=\"all\">
    <link href=\"vendor/vector-map/jqvmap.min.css\" rel=\"stylesheet\" media=\"all\">

    <!-- Main CSS-->
    <link href=\"css/theme.css\" rel=\"stylesheet\" media=\"all\">

</head>

<body class=\"animsition\">
    <div class=\"page-wrapper\">
        <!-- HEADER MOBILE-->
        <header class=\"header-mobile d-block d-lg-none\">
            <div class=\"header-mobile__bar\">
                <div class=\"container-fluid\">
                    <div class=\"header-mobile-inner\">
                        <a class=\"logo\" href=\"index.html\">
                            <img src=\"images/icon/logo.png\" alt=\"CoolAdmin\" />
                        </a>
                        <button class=\"hamburger hamburger--slider\" type=\"button\">
                            <span class=\"hamburger-box\">
                                <span class=\"hamburger-inner\"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
        </header>
        <!-- END HEADER MOBILE-->

        <!-- MENU SIDEBAR-->
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class=\"page-container\">
            <!-- HEADER DESKTOP-->
            <header id=\"header-desktop\">
                <div class=\"section__content section__content--p30\">
                    <div class=\"container-fluid\">
                        <div class=\"logo\">
                            <a href=\"#\">
                                <img src=\"images/icon/logo.png\" alt=\"Suite Car\" />
                            </a>
                        </div>
                        <div class=\"header-wrap\">
                            <div class=\"header-button\">         
                                <a href=\"maps\" class=\"nav\">MAP</a>
                                <a href=\"charts\" class=\"nav\">CHART</a>
                                <div class=\"account-wrap\">
                                    <div class=\"account-item clearfix js-item-menu\">
                                        <div class=\"image\">
                                            <img src=\"images/icon/avatar-03.jpg\" alt=\"J3SUNG\" />
                                        </div>
                                        <div class=\"content\">
                                            <a class=\"js-acc-btn\" href=\"#\">";
        // line 86
        echo twig_escape_filter($this->env, (isset($context["username"]) ? $context["username"] : null), "html", null, true);
        echo "</a>
                                        </div>
                                        <div class=\"account-dropdown js-dropdown\">
                                            <div class=\"info clearfix\">
                                                <div class=\"image\">
                                                    <a href=\"#\">
                                                        <img src=\"images/icon/avatar-03.jpg\" alt=\"J3SUNG\" />
                                                    </a>
                                                </div>
                                                <div class=\"content\">
                                                    <h5 class=\"name\">
                                                        <a href=\"#\">";
        // line 97
        echo twig_escape_filter($this->env, (isset($context["username"]) ? $context["username"] : null), "html", null, true);
        echo "</a>
                                                    </h5> 
                                                    <span class=\"email\">";
        // line 99
        echo twig_escape_filter($this->env, (isset($context["email"]) ? $context["email"] : null), "html", null, true);
        echo "</span>
                                                </div>
                                            </div>
                                            <div class=\"account-dropdown__body\">
                                                <div class=\"account-dropdown__item\">
                                                    <a href=\"change_password_page\">
                                                        <i class=\"zmdi zmdi-account\"></i>Password Change</a>
                                                </div>
                                                <div class=\"account-dropdown__item\">
                                                    <a href=\"id_cancelation_page\">
                                                        <i class=\"zmdi zmdi-settings\"></i>ID Cancellation</a>
                                                </div>
                                                <div class=\"account-dropdown__item\">
                                                    <a href=\"signout\">
                                                        <i class=\"zmdi zmdi-power\"></i>Sign Out</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- END HEADER DESKTOP-->

            <div class=\"main-content\" id=\"back_maps\">
                <div class=\"section__content section__content--p30\">
                    <div class=\"container-fluid\">
                        <div class=\"row\">
                            <div class=\"col-md-12 m-t-20\">
                                <!-- MAP DATA-->
                                <div id=\"chart_div\">
                                    <script type=\"text/javascript\">
                                        google.load(\"visualization\", \"1\", {packages:[\"corechart\"]});
                                        google.setOnLoadCallback(drawChart);
                                        var CO = 0;
                                        var O3 = 0;
                                        var SO2 = 0;
                                        var NO2 = 0;
                                        var PM25 = 0;
                                        function drawChart() {
                                            var jsonData = \$.ajax({
                                                url: \"/charts/chart2_json\",
                                                dataType:\"text\",
                                                async: false,
                                                type : \"GET\",
                                                data : {
                                                    \"CO\" : CO,
                                                    \"O3\" : O3,
                                                    \"SO2\" : SO2,
                                                    \"NO2\" : NO2,
                                                    \"PM25\" : PM25
                                                }

                                            }).responseText;
                                            //alert(jsonData);
                                            // Create our data table out of JSON data loaded from server.
                                            var data = new google.visualization.DataTable(jsonData);
                                            var options = {
                                                width: 800, height: 400,
                                                title: 'Real Time Data',
                                                series: {
                                                    0: { color: '#ff111d' },
                                                    1: { color: '#c784de' },
                                                    2: { color: '#f1ca3a' },
                                                    3: { color: '#2980b9' },
                                                    4: { color: '#e67e22' }
                                                }
                                            };
                                            var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
                                            chart.draw(data, options);
                                        }

                                        setInterval(drawChart, 1000);

                                        \$(function(){ 
                                            \$(\"#button_CO\").click(function(){ 
                                                if(CO == 0){
                                                    \$(\"#button_CO\").css('background-color', 'orange');
                                                    CO = 1;
                                                }
                                                else{
                                                    \$(\"#button_CO\").css('background-color', '#27AE60');
                                                    CO = 0;
                                                }
                                                \$.ajax({
                                                   url: \"/charts/chart2_json\",
                                                    dataType:\"text\",
                                                    async: false,
                                                    type : \"GET\",
                                                    data : {
                                                        \"CO\" : CO,
                                                        \"O3\" : O3,
                                                        \"SO2\" : SO2,
                                                        \"NO2\" : NO2,
                                                        \"PM25\" : PM25
                                                    },
                                                    success : function(data) {
                                                        
                                                    },
                                                    error : function(data) {
                                                        alert(\"There is something wrong.\");
                                                    }
                                                });
                                            }) 
                                        })
                                        \$(function(){ 
                                            \$(\"#button_O3\").click(function(){ 
                                                if(O3 == 0){
                                                    O3 = 1;
                                                    \$(\"#button_O3\").css('background-color', 'orange');
                                                }
                                                else{
                                                    O3 = 0;
                                                    \$(\"#button_O3\").css('background-color', '#27AE60');
                                                }
                                                \$.ajax({
                                                   url: \"/charts/chart2_json\",
                                                    dataType:\"text\",
                                                    async: false,
                                                    type : \"GET\",
                                                    data : {
                                                        \"CO\" : CO,
                                                        \"O3\" : O3,
                                                        \"SO2\" : SO2,
                                                        \"NO2\" : NO2,
                                                        \"PM25\" : PM25
                                                    },
                                                    success : function(data) {
                                                        
                                                    },
                                                    error : function(data) {
                                                        alert(\"There is something wrong.\");
                                                    }
                                                });
                                            }) 
                                        })
                                        \$(function(){ 
                                            \$(\"#button_SO2\").click(function(){ 
                                                if(SO2 == 0){
                                                    SO2 = 1;
                                                    \$(\"#button_SO2\").css('background-color', 'orange');
                                                }
                                                else{
                                                    SO2 = 0;
                                                    \$(\"#button_SO2\").css('background-color', '#27AE60');
                                                }
                                                \$.ajax({
                                                   url: \"/charts/chart2_json\",
                                                    dataType:\"text\",
                                                    async: false,
                                                    type : \"GET\",
                                                    data : {
                                                        \"CO\" : CO,
                                                        \"O3\" : O3,
                                                        \"SO2\" : SO2,
                                                        \"NO2\" : NO2,
                                                        \"PM25\" : PM25
                                                    },
                                                    success : function(data) {
                                                        
                                                    },
                                                    error : function(data) {
                                                        alert(\"There is something wrong.\");
                                                    }
                                                });
                                            }) 
                                        })
                                        \$(function(){ 
                                            \$(\"#button_NO2\").click(function(){ 
                                                if(NO2 == 0){
                                                    NO2 = 1;
                                                    \$(\"#button_NO2\").css('background-color', 'orange');
                                                }
                                                else{
                                                    NO2 = 0;
                                                    \$(\"#button_NO2\").css('background-color', '#27AE60');
                                                }
                                                \$.ajax({
                                                   url: \"/charts/chart2_json\",
                                                    dataType:\"text\",
                                                    async: false,
                                                    type : \"GET\",
                                                    data : {
                                                        \"CO\" : CO,
                                                        \"O3\" : O3,
                                                        \"SO2\" : SO2,
                                                        \"NO2\" : NO2,
                                                        \"PM25\" : PM25
                                                    },
                                                    success : function(data) {
                                                        
                                                    },
                                                    error : function(data) {
                                                        alert(\"There is something wrong.\");
                                                    }
                                                });
                                            }) 
                                        })
                                        \$(function(){ 
                                            \$(\"#button_PM25\").click(function(){ 
                                                if(PM25 == 0){
                                                    PM25 = 1;
                                                    \$(\"#button_PM25\").css('background-color', 'orange');
                                                }
                                                else{
                                                    PM25 = 0;
                                                    \$(\"#button_PM25\").css('background-color', '#27AE60');
                                                }
                                                \$.ajax({
                                                   url: \"/charts/chart2_json\",
                                                    dataType:\"text\",
                                                    async: false,
                                                    type : \"GET\",
                                                    data : {
                                                        \"CO\" : CO,
                                                        \"O3\" : O3,
                                                        \"SO2\" : SO2,
                                                        \"NO2\" : NO2,
                                                        \"PM25\" : PM25
                                                    },
                                                    success : function(data) {
                                                        
                                                    },
                                                    error : function(data) {
                                                        alert(\"There is something wrong.\");
                                                    }
                                                });
                                            }) 
                                        })
                                    </script>
                                </div>
                                
                                <div id = \"air_submit\">
                                    <button type = \"button\" class = \"air_button\" id = \"button_CO\">CO</button>
                                    <button type = \"button\" class = \"air_button\" id = \"button_O3\">O3</button>
                                    <button type = \"button\" class = \"air_button\" id = \"button_SO2\">SO2</button>
                                    <button type = \"button\" class = \"air_button\" id = \"button_NO2\">NO2</button>
                                    <button type = \"button\" class = \"air_button\" id = \"button_PM25\">PM25</button>
                                </div>

                                <!-- END MAP DATA-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Map -->
    <script async defer
    src=\"https://maps.googleapis.com/maps/api/js?key=AIzaSyA4E2DLjl0PUtVHjQruVcL0GJgmamn4UgY&callback=initMap\">
    </script>
    <!-- Jquery JS-->
    <script src=\"vendor/jquery-3.2.1.min.js\"></script>
    <!-- Bootstrap JS-->
    <script src=\"vendor/bootstrap-4.1/popper.min.js\"></script>
    <script src=\"vendor/bootstrap-4.1/bootstrap.min.js\"></script>
    <!-- Vendor JS       -->
    <script src=\"vendor/slick/slick.min.js\">
    </script>
    <script src=\"vendor/wow/wow.min.js\"></script>
    <script src=\"vendor/animsition/animsition.min.js\"></script>
    <script src=\"vendor/bootstrap-progressbar/bootstrap-progressbar.min.js\">
    </script>
    <script src=\"vendor/counter-up/jquery.waypoints.min.js\"></script>
    <script src=\"vendor/counter-up/jquery.counterup.min.js\">
    </script>
    <script src=\"vendor/circle-progress/circle-progress.min.js\"></script>
    <script src=\"vendor/perfect-scrollbar/perfect-scrollbar.js\"></script>
    <script src=\"vendor/chartjs/Chart.bundle.min.js\"></script>
    <script src=\"vendor/select2/select2.min.js\">
    </script>
    <script src=\"vendor/vector-map/jquery.vmap.js\"></script>
    <script src=\"vendor/vector-map/jquery.vmap.min.js\"></script>
    <script src=\"vendor/vector-map/jquery.vmap.sampledata.js\"></script>
    <script src=\"vendor/vector-map/jquery.vmap.world.js\"></script>
    <script src=\"vendor/vector-map/jquery.vmap.brazil.js\"></script>
    <script src=\"vendor/vector-map/jquery.vmap.europe.js\"></script>
    <script src=\"vendor/vector-map/jquery.vmap.france.js\"></script>
    <script src=\"vendor/vector-map/jquery.vmap.germany.js\"></script>
    <script src=\"vendor/vector-map/jquery.vmap.russia.js\"></script>
    <script src=\"vendor/vector-map/jquery.vmap.usa.js\"></script>

    <!-- Main JS-->
    <script src=\"js/main.js\"></script>

    <script type = \"text/javascript\">
    var myLocation = new Array();
    var centerLocation = new Array();

    \$.map_update = (function(){
        \$.ajax({
            type : \"POST\",
            url : \"./db_data_for_map\",
            dataType : \"json\",
            succes : function(data) {
                alert(data[0]['latitude']);
                for(i = 0; i < data.length; i++) {
                    myLocation = {
                        latitude : data[i]['latitude'],
                        longtitude : data[i]['longtitude']
                    }
                    
                }
                centerLocation = {
                    latitude : data[0]['latitude'],
                    longtitude : data[0]['longtitude']
                }
            },
            error : function(data) {
                alert(\"There is something wrong. \");
            }
        });
    });
    </script>

</body>

</html>
<!-- end document-->
<!--
<script type='text/javascript'>
var myLocation[];
var currentLocation[];
function initMap() {
        var myLatLng = {lat: -25.363, lng: 131.044};

        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 4,
          center: myLatLng
        });

        var marker = new google.maps.Marker({
          position: myLatLng,
          map: map,
          title: 'Hello World!'
        });
      }

\$.map_update = (function(){
    \$.ajax({
        type : \"POST\",
        url : \"./db_data_for_map\",
        dataType : \"json\",
        success : function(data) {
            myLocation = {
                lat : data['latitude'],
                lot : data['longitude']
            },
            centerLocation = {
                lat : data['latitude'],
                lot : data['longitude']
            }
        },
        error : function(data) {
            alert(\"There is something wrong.\");
        }
    });
});
</script>
-->";
    }

    public function getTemplateName()
    {
        return "chart.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  125 => 99,  120 => 97,  106 => 86,  19 => 1,);
    }
}
/* <html lang="en">*/
/* */
/* <head>*/
/*     <script type='text/javascript' src='http://code.jquery.com/jquery.min.js'></script>*/
/*     <script type="text/javascript" src="https://www.google.com/jsapi"></script>*/
/*     <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>*/
/*     <!-- Required meta tags-->*/
/*     <meta charset="UTF-8">*/
/*     <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">*/
/*     <meta name="description" content="au theme template">*/
/*     <meta name="author" content="Hau Nguyen">*/
/*     <meta name="keywords" content="au theme template">*/
/*     */
/*     <!-- Title Page-->*/
/*     <title>Suite Car</title>*/
/* */
/*     <!-- Fontfaces CSS-->*/
/*     <link href="css/font-face.css" rel="stylesheet" media="all">*/
/*     <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">*/
/*     <link href="vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">*/
/*     <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">*/
/* */
/*     <!-- Bootstrap CSS-->*/
/*     <link href="vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">*/
/* */
/*     <!-- Vendor CSS-->*/
/*     <link href="vendor/animsition/animsition.min.css" rel="stylesheet" media="all">*/
/*     <link href="vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">*/
/*     <link href="vendor/wow/animate.css" rel="stylesheet" media="all">*/
/*     <link href="vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">*/
/*     <link href="vendor/slick/slick.css" rel="stylesheet" media="all">*/
/*     <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">*/
/*     <link href="vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">*/
/*     <link href="vendor/vector-map/jqvmap.min.css" rel="stylesheet" media="all">*/
/* */
/*     <!-- Main CSS-->*/
/*     <link href="css/theme.css" rel="stylesheet" media="all">*/
/* */
/* </head>*/
/* */
/* <body class="animsition">*/
/*     <div class="page-wrapper">*/
/*         <!-- HEADER MOBILE-->*/
/*         <header class="header-mobile d-block d-lg-none">*/
/*             <div class="header-mobile__bar">*/
/*                 <div class="container-fluid">*/
/*                     <div class="header-mobile-inner">*/
/*                         <a class="logo" href="index.html">*/
/*                             <img src="images/icon/logo.png" alt="CoolAdmin" />*/
/*                         </a>*/
/*                         <button class="hamburger hamburger--slider" type="button">*/
/*                             <span class="hamburger-box">*/
/*                                 <span class="hamburger-inner"></span>*/
/*                             </span>*/
/*                         </button>*/
/*                     </div>*/
/*                 </div>*/
/*             </div>*/
/*         </header>*/
/*         <!-- END HEADER MOBILE-->*/
/* */
/*         <!-- MENU SIDEBAR-->*/
/*         <!-- END MENU SIDEBAR-->*/
/* */
/*         <!-- PAGE CONTAINER-->*/
/*         <div class="page-container">*/
/*             <!-- HEADER DESKTOP-->*/
/*             <header id="header-desktop">*/
/*                 <div class="section__content section__content--p30">*/
/*                     <div class="container-fluid">*/
/*                         <div class="logo">*/
/*                             <a href="#">*/
/*                                 <img src="images/icon/logo.png" alt="Suite Car" />*/
/*                             </a>*/
/*                         </div>*/
/*                         <div class="header-wrap">*/
/*                             <div class="header-button">         */
/*                                 <a href="maps" class="nav">MAP</a>*/
/*                                 <a href="charts" class="nav">CHART</a>*/
/*                                 <div class="account-wrap">*/
/*                                     <div class="account-item clearfix js-item-menu">*/
/*                                         <div class="image">*/
/*                                             <img src="images/icon/avatar-03.jpg" alt="J3SUNG" />*/
/*                                         </div>*/
/*                                         <div class="content">*/
/*                                             <a class="js-acc-btn" href="#">{{username}}</a>*/
/*                                         </div>*/
/*                                         <div class="account-dropdown js-dropdown">*/
/*                                             <div class="info clearfix">*/
/*                                                 <div class="image">*/
/*                                                     <a href="#">*/
/*                                                         <img src="images/icon/avatar-03.jpg" alt="J3SUNG" />*/
/*                                                     </a>*/
/*                                                 </div>*/
/*                                                 <div class="content">*/
/*                                                     <h5 class="name">*/
/*                                                         <a href="#">{{username}}</a>*/
/*                                                     </h5> */
/*                                                     <span class="email">{{email}}</span>*/
/*                                                 </div>*/
/*                                             </div>*/
/*                                             <div class="account-dropdown__body">*/
/*                                                 <div class="account-dropdown__item">*/
/*                                                     <a href="change_password_page">*/
/*                                                         <i class="zmdi zmdi-account"></i>Password Change</a>*/
/*                                                 </div>*/
/*                                                 <div class="account-dropdown__item">*/
/*                                                     <a href="id_cancelation_page">*/
/*                                                         <i class="zmdi zmdi-settings"></i>ID Cancellation</a>*/
/*                                                 </div>*/
/*                                                 <div class="account-dropdown__item">*/
/*                                                     <a href="signout">*/
/*                                                         <i class="zmdi zmdi-power"></i>Sign Out</a>*/
/*                                                 </div>*/
/*                                             </div>*/
/*                                         </div>*/
/*                                     </div>*/
/*                                 </div>*/
/*                             </div>*/
/*                         </div>*/
/*                     </div>*/
/*                 </div>*/
/*             </header>*/
/*             <!-- END HEADER DESKTOP-->*/
/* */
/*             <div class="main-content" id="back_maps">*/
/*                 <div class="section__content section__content--p30">*/
/*                     <div class="container-fluid">*/
/*                         <div class="row">*/
/*                             <div class="col-md-12 m-t-20">*/
/*                                 <!-- MAP DATA-->*/
/*                                 <div id="chart_div">*/
/*                                     <script type="text/javascript">*/
/*                                         google.load("visualization", "1", {packages:["corechart"]});*/
/*                                         google.setOnLoadCallback(drawChart);*/
/*                                         var CO = 0;*/
/*                                         var O3 = 0;*/
/*                                         var SO2 = 0;*/
/*                                         var NO2 = 0;*/
/*                                         var PM25 = 0;*/
/*                                         function drawChart() {*/
/*                                             var jsonData = $.ajax({*/
/*                                                 url: "/charts/chart2_json",*/
/*                                                 dataType:"text",*/
/*                                                 async: false,*/
/*                                                 type : "GET",*/
/*                                                 data : {*/
/*                                                     "CO" : CO,*/
/*                                                     "O3" : O3,*/
/*                                                     "SO2" : SO2,*/
/*                                                     "NO2" : NO2,*/
/*                                                     "PM25" : PM25*/
/*                                                 }*/
/* */
/*                                             }).responseText;*/
/*                                             //alert(jsonData);*/
/*                                             // Create our data table out of JSON data loaded from server.*/
/*                                             var data = new google.visualization.DataTable(jsonData);*/
/*                                             var options = {*/
/*                                                 width: 800, height: 400,*/
/*                                                 title: 'Real Time Data',*/
/*                                                 series: {*/
/*                                                     0: { color: '#ff111d' },*/
/*                                                     1: { color: '#c784de' },*/
/*                                                     2: { color: '#f1ca3a' },*/
/*                                                     3: { color: '#2980b9' },*/
/*                                                     4: { color: '#e67e22' }*/
/*                                                 }*/
/*                                             };*/
/*                                             var chart = new google.visualization.LineChart(document.getElementById('chart_div'));*/
/*                                             chart.draw(data, options);*/
/*                                         }*/
/* */
/*                                         setInterval(drawChart, 1000);*/
/* */
/*                                         $(function(){ */
/*                                             $("#button_CO").click(function(){ */
/*                                                 if(CO == 0){*/
/*                                                     $("#button_CO").css('background-color', 'orange');*/
/*                                                     CO = 1;*/
/*                                                 }*/
/*                                                 else{*/
/*                                                     $("#button_CO").css('background-color', '#27AE60');*/
/*                                                     CO = 0;*/
/*                                                 }*/
/*                                                 $.ajax({*/
/*                                                    url: "/charts/chart2_json",*/
/*                                                     dataType:"text",*/
/*                                                     async: false,*/
/*                                                     type : "GET",*/
/*                                                     data : {*/
/*                                                         "CO" : CO,*/
/*                                                         "O3" : O3,*/
/*                                                         "SO2" : SO2,*/
/*                                                         "NO2" : NO2,*/
/*                                                         "PM25" : PM25*/
/*                                                     },*/
/*                                                     success : function(data) {*/
/*                                                         */
/*                                                     },*/
/*                                                     error : function(data) {*/
/*                                                         alert("There is something wrong.");*/
/*                                                     }*/
/*                                                 });*/
/*                                             }) */
/*                                         })*/
/*                                         $(function(){ */
/*                                             $("#button_O3").click(function(){ */
/*                                                 if(O3 == 0){*/
/*                                                     O3 = 1;*/
/*                                                     $("#button_O3").css('background-color', 'orange');*/
/*                                                 }*/
/*                                                 else{*/
/*                                                     O3 = 0;*/
/*                                                     $("#button_O3").css('background-color', '#27AE60');*/
/*                                                 }*/
/*                                                 $.ajax({*/
/*                                                    url: "/charts/chart2_json",*/
/*                                                     dataType:"text",*/
/*                                                     async: false,*/
/*                                                     type : "GET",*/
/*                                                     data : {*/
/*                                                         "CO" : CO,*/
/*                                                         "O3" : O3,*/
/*                                                         "SO2" : SO2,*/
/*                                                         "NO2" : NO2,*/
/*                                                         "PM25" : PM25*/
/*                                                     },*/
/*                                                     success : function(data) {*/
/*                                                         */
/*                                                     },*/
/*                                                     error : function(data) {*/
/*                                                         alert("There is something wrong.");*/
/*                                                     }*/
/*                                                 });*/
/*                                             }) */
/*                                         })*/
/*                                         $(function(){ */
/*                                             $("#button_SO2").click(function(){ */
/*                                                 if(SO2 == 0){*/
/*                                                     SO2 = 1;*/
/*                                                     $("#button_SO2").css('background-color', 'orange');*/
/*                                                 }*/
/*                                                 else{*/
/*                                                     SO2 = 0;*/
/*                                                     $("#button_SO2").css('background-color', '#27AE60');*/
/*                                                 }*/
/*                                                 $.ajax({*/
/*                                                    url: "/charts/chart2_json",*/
/*                                                     dataType:"text",*/
/*                                                     async: false,*/
/*                                                     type : "GET",*/
/*                                                     data : {*/
/*                                                         "CO" : CO,*/
/*                                                         "O3" : O3,*/
/*                                                         "SO2" : SO2,*/
/*                                                         "NO2" : NO2,*/
/*                                                         "PM25" : PM25*/
/*                                                     },*/
/*                                                     success : function(data) {*/
/*                                                         */
/*                                                     },*/
/*                                                     error : function(data) {*/
/*                                                         alert("There is something wrong.");*/
/*                                                     }*/
/*                                                 });*/
/*                                             }) */
/*                                         })*/
/*                                         $(function(){ */
/*                                             $("#button_NO2").click(function(){ */
/*                                                 if(NO2 == 0){*/
/*                                                     NO2 = 1;*/
/*                                                     $("#button_NO2").css('background-color', 'orange');*/
/*                                                 }*/
/*                                                 else{*/
/*                                                     NO2 = 0;*/
/*                                                     $("#button_NO2").css('background-color', '#27AE60');*/
/*                                                 }*/
/*                                                 $.ajax({*/
/*                                                    url: "/charts/chart2_json",*/
/*                                                     dataType:"text",*/
/*                                                     async: false,*/
/*                                                     type : "GET",*/
/*                                                     data : {*/
/*                                                         "CO" : CO,*/
/*                                                         "O3" : O3,*/
/*                                                         "SO2" : SO2,*/
/*                                                         "NO2" : NO2,*/
/*                                                         "PM25" : PM25*/
/*                                                     },*/
/*                                                     success : function(data) {*/
/*                                                         */
/*                                                     },*/
/*                                                     error : function(data) {*/
/*                                                         alert("There is something wrong.");*/
/*                                                     }*/
/*                                                 });*/
/*                                             }) */
/*                                         })*/
/*                                         $(function(){ */
/*                                             $("#button_PM25").click(function(){ */
/*                                                 if(PM25 == 0){*/
/*                                                     PM25 = 1;*/
/*                                                     $("#button_PM25").css('background-color', 'orange');*/
/*                                                 }*/
/*                                                 else{*/
/*                                                     PM25 = 0;*/
/*                                                     $("#button_PM25").css('background-color', '#27AE60');*/
/*                                                 }*/
/*                                                 $.ajax({*/
/*                                                    url: "/charts/chart2_json",*/
/*                                                     dataType:"text",*/
/*                                                     async: false,*/
/*                                                     type : "GET",*/
/*                                                     data : {*/
/*                                                         "CO" : CO,*/
/*                                                         "O3" : O3,*/
/*                                                         "SO2" : SO2,*/
/*                                                         "NO2" : NO2,*/
/*                                                         "PM25" : PM25*/
/*                                                     },*/
/*                                                     success : function(data) {*/
/*                                                         */
/*                                                     },*/
/*                                                     error : function(data) {*/
/*                                                         alert("There is something wrong.");*/
/*                                                     }*/
/*                                                 });*/
/*                                             }) */
/*                                         })*/
/*                                     </script>*/
/*                                 </div>*/
/*                                 */
/*                                 <div id = "air_submit">*/
/*                                     <button type = "button" class = "air_button" id = "button_CO">CO</button>*/
/*                                     <button type = "button" class = "air_button" id = "button_O3">O3</button>*/
/*                                     <button type = "button" class = "air_button" id = "button_SO2">SO2</button>*/
/*                                     <button type = "button" class = "air_button" id = "button_NO2">NO2</button>*/
/*                                     <button type = "button" class = "air_button" id = "button_PM25">PM25</button>*/
/*                                 </div>*/
/* */
/*                                 <!-- END MAP DATA-->*/
/*                             </div>*/
/*                         </div>*/
/*                     </div>*/
/*                 </div>*/
/*             </div>*/
/*         </div>*/
/*     </div>*/
/*     */
/*     <!-- Map -->*/
/*     <script async defer*/
/*     src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA4E2DLjl0PUtVHjQruVcL0GJgmamn4UgY&callback=initMap">*/
/*     </script>*/
/*     <!-- Jquery JS-->*/
/*     <script src="vendor/jquery-3.2.1.min.js"></script>*/
/*     <!-- Bootstrap JS-->*/
/*     <script src="vendor/bootstrap-4.1/popper.min.js"></script>*/
/*     <script src="vendor/bootstrap-4.1/bootstrap.min.js"></script>*/
/*     <!-- Vendor JS       -->*/
/*     <script src="vendor/slick/slick.min.js">*/
/*     </script>*/
/*     <script src="vendor/wow/wow.min.js"></script>*/
/*     <script src="vendor/animsition/animsition.min.js"></script>*/
/*     <script src="vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">*/
/*     </script>*/
/*     <script src="vendor/counter-up/jquery.waypoints.min.js"></script>*/
/*     <script src="vendor/counter-up/jquery.counterup.min.js">*/
/*     </script>*/
/*     <script src="vendor/circle-progress/circle-progress.min.js"></script>*/
/*     <script src="vendor/perfect-scrollbar/perfect-scrollbar.js"></script>*/
/*     <script src="vendor/chartjs/Chart.bundle.min.js"></script>*/
/*     <script src="vendor/select2/select2.min.js">*/
/*     </script>*/
/*     <script src="vendor/vector-map/jquery.vmap.js"></script>*/
/*     <script src="vendor/vector-map/jquery.vmap.min.js"></script>*/
/*     <script src="vendor/vector-map/jquery.vmap.sampledata.js"></script>*/
/*     <script src="vendor/vector-map/jquery.vmap.world.js"></script>*/
/*     <script src="vendor/vector-map/jquery.vmap.brazil.js"></script>*/
/*     <script src="vendor/vector-map/jquery.vmap.europe.js"></script>*/
/*     <script src="vendor/vector-map/jquery.vmap.france.js"></script>*/
/*     <script src="vendor/vector-map/jquery.vmap.germany.js"></script>*/
/*     <script src="vendor/vector-map/jquery.vmap.russia.js"></script>*/
/*     <script src="vendor/vector-map/jquery.vmap.usa.js"></script>*/
/* */
/*     <!-- Main JS-->*/
/*     <script src="js/main.js"></script>*/
/* */
/*     <script type = "text/javascript">*/
/*     var myLocation = new Array();*/
/*     var centerLocation = new Array();*/
/* */
/*     $.map_update = (function(){*/
/*         $.ajax({*/
/*             type : "POST",*/
/*             url : "./db_data_for_map",*/
/*             dataType : "json",*/
/*             succes : function(data) {*/
/*                 alert(data[0]['latitude']);*/
/*                 for(i = 0; i < data.length; i++) {*/
/*                     myLocation = {*/
/*                         latitude : data[i]['latitude'],*/
/*                         longtitude : data[i]['longtitude']*/
/*                     }*/
/*                     */
/*                 }*/
/*                 centerLocation = {*/
/*                     latitude : data[0]['latitude'],*/
/*                     longtitude : data[0]['longtitude']*/
/*                 }*/
/*             },*/
/*             error : function(data) {*/
/*                 alert("There is something wrong. ");*/
/*             }*/
/*         });*/
/*     });*/
/*     </script>*/
/* */
/* </body>*/
/* */
/* </html>*/
/* <!-- end document-->*/
/* <!--*/
/* <script type='text/javascript'>*/
/* var myLocation[];*/
/* var currentLocation[];*/
/* function initMap() {*/
/*         var myLatLng = {lat: -25.363, lng: 131.044};*/
/* */
/*         var map = new google.maps.Map(document.getElementById('map'), {*/
/*           zoom: 4,*/
/*           center: myLatLng*/
/*         });*/
/* */
/*         var marker = new google.maps.Marker({*/
/*           position: myLatLng,*/
/*           map: map,*/
/*           title: 'Hello World!'*/
/*         });*/
/*       }*/
/* */
/* $.map_update = (function(){*/
/*     $.ajax({*/
/*         type : "POST",*/
/*         url : "./db_data_for_map",*/
/*         dataType : "json",*/
/*         success : function(data) {*/
/*             myLocation = {*/
/*                 lat : data['latitude'],*/
/*                 lot : data['longitude']*/
/*             },*/
/*             centerLocation = {*/
/*                 lat : data['latitude'],*/
/*                 lot : data['longitude']*/
/*             }*/
/*         },*/
/*         error : function(data) {*/
/*             alert("There is something wrong.");*/
/*         }*/
/*     });*/
/* });*/
/* </script>*/
/* -->*/
