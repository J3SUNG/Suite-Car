<?php

/* list_view.twig */
class __TwigTemplate_421a2289d25d85157a1cb3c5e2adae30063152a8491c41afebddb0cd5c5347fa extends Twig_Template
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
                                <a href=\"home\">
                                    <img src=\"images/icon/logo.png\" alt=\"Suite Car\" />
                                </a>
                            </div>
                            <div class=\"header-wrap\">
                                <div class=\"header-button\">         
                                    <a href=\"team\" class=\"nav\">Team</a>
                                    <a href=\"maps\" class=\"nav\">Map</a>
                                    <a href=\"air_chart\" class=\"nav\">Air Chart</a>
                                    <a href=\"heart_chart\" class=\"nav\">Heart Chart</a>
                                    <a href=\"list_view\" class=\"nav\">List View</a>
                                    <div class=\"account-wrap\">
                                        <div class=\"account-item clearfix js-item-menu\">
                                            <div class=\"image\">
                                                <img src=\"images/icon/avatar-03.jpg\" alt=\"J3SUNG\" />
                                            </div>
                                            <div class=\"content\">
                                                <a class=\"js-acc-btn\" href=\"#\">";
        // line 88
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
        // line 99
        echo twig_escape_filter($this->env, (isset($context["username"]) ? $context["username"] : null), "html", null, true);
        echo "</a>
                                                        </h5> 
                                                        <span class=\"email\">";
        // line 101
        echo twig_escape_filter($this->env, (isset($context["email"]) ? $context["email"] : null), "html", null, true);
        echo "</span>
                                                    </div>
                                                </div>
                                                <div class=\"account-dropdown__body\">
                                                    <div class=\"account-dropdown__item\">
                                                        <a href=\"change_password_page\">
                                                            <i class=\"zmdi zmdi-account\"></i>Password Change
                                                        </a>
                                                    </div>
                                                    <div class=\"account-dropdown__item\">
                                                        <a href=\"id_cancelation_page\">
                                                            <i class=\"zmdi zmdi-settings\"></i>ID Cancellation
                                                        </a>
                                                    </div>
                                                    <div class=\"account-dropdown__item\">
                                                        <a href=\"signout\">
                                                            <i class=\"zmdi zmdi-power\"></i>Sign Out
                                                        </a>
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
                <div class = \"list_view_title m-t-150\">
                    <h1>List View<h1>
                </div><br><br>
                ";
        // line 145
        echo "            </div>
        </div>
        
        <script type=\"text/javascript\">
            var user_no = ";
        // line 149
        echo twig_escape_filter($this->env, (isset($context["user_no"]) ? $context["user_no"] : null), "html", null, true);
        echo ";
            \$now = new Date();
            \$(function(){ 
                \$.ajax({
                url: \"/charts/receive_combobox\",
                    dataType:\"text\",
                    async: false,
                    type : \"GET\",
                    data : {
                        \"user_no\" : user_no,
                        \"type\" : 2
                    },
                    success : function(data) {
                        \$data = JSON.parse(data);
                        addBox(\$data);
                    },
                    error : function(data) {
                        alert(\"There is something wrong@.\");
                    }
                });
            })

            function addBox(data){
                for(var index in data) {
                    var sensor_no = data[index].sensor_no;
                    var sname = data[index].sname;
                    var type = data[index].type;
                    var url;
                    if(type == 'A'){
                        url = \"images/wind.gif\";
                    }
                    else{
                        url = \"images/heart.gif\";
                    }
                    var newDivHtml = \"<div class = \\\"list_view_div\\\"> <div class = \\\"list_view_box\\\"> <div class = \\\"list_view_image\\\"> <img class = \\\"list_view_image_circle\\\" src=\\\"\" + url + \"\\\" alt=\\\"Suite Car\\\"> </div> <div class = \\\"list_view_text\\\"> <div> Sensor_no : \" + sensor_no + \" </div> <div class = \\\"m-t-30\\\"> Sensor Name : \" + sname + \" </div> <div class = \\\"m-t-30\\\"> type : \" + type + \" </div> </div> </div> </div>\";
                    document.body.innerHTML = document.body.innerHTML + \"\" + newDivHtml;
                }
                sensor_no = \$(\"#combo option:selected\").val();
            } 
        </script>
        
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

    </body>

</html>";
    }

    public function getTemplateName()
    {
        return "list_view.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  168 => 149,  162 => 145,  127 => 101,  122 => 99,  108 => 88,  19 => 1,);
    }
}
/* <html lang="en">*/
/*     <head>*/
/*         <script type='text/javascript' src='http://code.jquery.com/jquery.min.js'></script>*/
/*         <script type="text/javascript" src="https://www.google.com/jsapi"></script>*/
/*         <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>*/
/*         <!-- Required meta tags-->*/
/*         <meta charset="UTF-8">*/
/*         <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">*/
/*         <meta name="description" content="au theme template">*/
/*         <meta name="author" content="Hau Nguyen">*/
/*         <meta name="keywords" content="au theme template">*/
/*         */
/*         <!-- Title Page-->*/
/*         <title>Suite Car</title>*/
/* */
/*         <!-- Fontfaces CSS-->*/
/*         <link href="css/font-face.css" rel="stylesheet" media="all">*/
/*         <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">*/
/*         <link href="vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">*/
/*         <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">*/
/* */
/*         <!-- Bootstrap CSS-->*/
/*         <link href="vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">*/
/* */
/*         <!-- Vendor CSS-->*/
/*         <link href="vendor/animsition/animsition.min.css" rel="stylesheet" media="all">*/
/*         <link href="vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">*/
/*         <link href="vendor/wow/animate.css" rel="stylesheet" media="all">*/
/*         <link href="vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">*/
/*         <link href="vendor/slick/slick.css" rel="stylesheet" media="all">*/
/*         <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">*/
/*         <link href="vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">*/
/*         <link href="vendor/vector-map/jqvmap.min.css" rel="stylesheet" media="all">*/
/* */
/*         <!-- Main CSS-->*/
/*         <link href="css/theme.css" rel="stylesheet" media="all">*/
/* */
/*     </head>*/
/* */
/*     <body class="animsition">*/
/*         <div class="page-wrapper">*/
/*             <!-- HEADER MOBILE-->*/
/*             <header class="header-mobile d-block d-lg-none">*/
/*                 <div class="header-mobile__bar">*/
/*                     <div class="container-fluid">*/
/*                         <div class="header-mobile-inner">*/
/*                             <a class="logo" href="index.html">*/
/*                                 <img src="images/icon/logo.png" alt="CoolAdmin" />*/
/*                             </a>*/
/*                             <button class="hamburger hamburger--slider" type="button">*/
/*                                 <span class="hamburger-box">*/
/*                                     <span class="hamburger-inner"></span>*/
/*                                 </span>*/
/*                             </button>*/
/*                         </div>*/
/*                     </div>*/
/*                 </div>*/
/*             </header>*/
/*             <!-- END HEADER MOBILE-->*/
/* */
/*             <!-- MENU SIDEBAR-->*/
/*             <!-- END MENU SIDEBAR-->*/
/* */
/*             <!-- PAGE CONTAINER-->*/
/*             <div class="page-container">*/
/*                 <!-- HEADER DESKTOP-->*/
/*                 <header id="header-desktop">*/
/*                     <div class="section__content section__content--p30">*/
/*                         <div class="container-fluid">*/
/*                             <div class="logo">*/
/*                                 <a href="home">*/
/*                                     <img src="images/icon/logo.png" alt="Suite Car" />*/
/*                                 </a>*/
/*                             </div>*/
/*                             <div class="header-wrap">*/
/*                                 <div class="header-button">         */
/*                                     <a href="team" class="nav">Team</a>*/
/*                                     <a href="maps" class="nav">Map</a>*/
/*                                     <a href="air_chart" class="nav">Air Chart</a>*/
/*                                     <a href="heart_chart" class="nav">Heart Chart</a>*/
/*                                     <a href="list_view" class="nav">List View</a>*/
/*                                     <div class="account-wrap">*/
/*                                         <div class="account-item clearfix js-item-menu">*/
/*                                             <div class="image">*/
/*                                                 <img src="images/icon/avatar-03.jpg" alt="J3SUNG" />*/
/*                                             </div>*/
/*                                             <div class="content">*/
/*                                                 <a class="js-acc-btn" href="#">{{username}}</a>*/
/*                                             </div>*/
/*                                             <div class="account-dropdown js-dropdown">*/
/*                                                 <div class="info clearfix">*/
/*                                                     <div class="image">*/
/*                                                         <a href="#">*/
/*                                                             <img src="images/icon/avatar-03.jpg" alt="J3SUNG" />*/
/*                                                         </a>*/
/*                                                     </div>*/
/*                                                     <div class="content">*/
/*                                                         <h5 class="name">*/
/*                                                             <a href="#">{{username}}</a>*/
/*                                                         </h5> */
/*                                                         <span class="email">{{email}}</span>*/
/*                                                     </div>*/
/*                                                 </div>*/
/*                                                 <div class="account-dropdown__body">*/
/*                                                     <div class="account-dropdown__item">*/
/*                                                         <a href="change_password_page">*/
/*                                                             <i class="zmdi zmdi-account"></i>Password Change*/
/*                                                         </a>*/
/*                                                     </div>*/
/*                                                     <div class="account-dropdown__item">*/
/*                                                         <a href="id_cancelation_page">*/
/*                                                             <i class="zmdi zmdi-settings"></i>ID Cancellation*/
/*                                                         </a>*/
/*                                                     </div>*/
/*                                                     <div class="account-dropdown__item">*/
/*                                                         <a href="signout">*/
/*                                                             <i class="zmdi zmdi-power"></i>Sign Out*/
/*                                                         </a>*/
/*                                                     </div>*/
/*                                                 </div>*/
/*                                             </div>*/
/*                                         </div>*/
/*                                     </div>*/
/*                                 </div>*/
/*                             </div>*/
/*                         </div>*/
/*                     </div>*/
/*                 </header>*/
/*                 <!-- END HEADER DESKTOP-->*/
/*                 <div class = "list_view_title m-t-150">*/
/*                     <h1>List View<h1>*/
/*                 </div><br><br>*/
/*                 {# <div class = "list_view_div">*/
/*                     <div class = "list_view_box">*/
/*                         <div class = "list_view_image">*/
/*                             <img class = "list_view_image_circle" src="images/home.PNG" alt="Suite Car">*/
/*                         </div> */
/*                         <div class = "list_view_text">*/
/*                             <div> Sensor_no :  </div>*/
/*                             <div class = "m-t-30"> Sensor Name :  </div>*/
/*                             <div class = "m-t-30"> type :  </div>*/
/*                         </div>*/
/*                     </div>*/
/*                 </div> #}*/
/*             </div>*/
/*         </div>*/
/*         */
/*         <script type="text/javascript">*/
/*             var user_no = {{user_no}};*/
/*             $now = new Date();*/
/*             $(function(){ */
/*                 $.ajax({*/
/*                 url: "/charts/receive_combobox",*/
/*                     dataType:"text",*/
/*                     async: false,*/
/*                     type : "GET",*/
/*                     data : {*/
/*                         "user_no" : user_no,*/
/*                         "type" : 2*/
/*                     },*/
/*                     success : function(data) {*/
/*                         $data = JSON.parse(data);*/
/*                         addBox($data);*/
/*                     },*/
/*                     error : function(data) {*/
/*                         alert("There is something wrong@.");*/
/*                     }*/
/*                 });*/
/*             })*/
/* */
/*             function addBox(data){*/
/*                 for(var index in data) {*/
/*                     var sensor_no = data[index].sensor_no;*/
/*                     var sname = data[index].sname;*/
/*                     var type = data[index].type;*/
/*                     var url;*/
/*                     if(type == 'A'){*/
/*                         url = "images/wind.gif";*/
/*                     }*/
/*                     else{*/
/*                         url = "images/heart.gif";*/
/*                     }*/
/*                     var newDivHtml = "<div class = \"list_view_div\"> <div class = \"list_view_box\"> <div class = \"list_view_image\"> <img class = \"list_view_image_circle\" src=\"" + url + "\" alt=\"Suite Car\"> </div> <div class = \"list_view_text\"> <div> Sensor_no : " + sensor_no + " </div> <div class = \"m-t-30\"> Sensor Name : " + sname + " </div> <div class = \"m-t-30\"> type : " + type + " </div> </div> </div> </div>";*/
/*                     document.body.innerHTML = document.body.innerHTML + "" + newDivHtml;*/
/*                 }*/
/*                 sensor_no = $("#combo option:selected").val();*/
/*             } */
/*         </script>*/
/*         */
/*         <!-- Map -->*/
/*         <script async defer*/
/*         src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA4E2DLjl0PUtVHjQruVcL0GJgmamn4UgY&callback=initMap">*/
/*         </script>*/
/*         <!-- Jquery JS-->*/
/*         <script src="vendor/jquery-3.2.1.min.js"></script>*/
/*         <!-- Bootstrap JS-->*/
/*         <script src="vendor/bootstrap-4.1/popper.min.js"></script>*/
/*         <script src="vendor/bootstrap-4.1/bootstrap.min.js"></script>*/
/*         <!-- Vendor JS       -->*/
/*         <script src="vendor/slick/slick.min.js">*/
/*         </script>*/
/*         <script src="vendor/wow/wow.min.js"></script>*/
/*         <script src="vendor/animsition/animsition.min.js"></script>*/
/*         <script src="vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">*/
/*         </script>*/
/*         <script src="vendor/counter-up/jquery.waypoints.min.js"></script>*/
/*         <script src="vendor/counter-up/jquery.counterup.min.js">*/
/*         </script>*/
/*         <script src="vendor/circle-progress/circle-progress.min.js"></script>*/
/*         <script src="vendor/perfect-scrollbar/perfect-scrollbar.js"></script>*/
/*         <script src="vendor/chartjs/Chart.bundle.min.js"></script>*/
/*         <script src="vendor/select2/select2.min.js">*/
/*         </script>*/
/*         <script src="vendor/vector-map/jquery.vmap.js"></script>*/
/*         <script src="vendor/vector-map/jquery.vmap.min.js"></script>*/
/*         <script src="vendor/vector-map/jquery.vmap.sampledata.js"></script>*/
/*         <script src="vendor/vector-map/jquery.vmap.world.js"></script>*/
/*         <script src="vendor/vector-map/jquery.vmap.brazil.js"></script>*/
/*         <script src="vendor/vector-map/jquery.vmap.europe.js"></script>*/
/*         <script src="vendor/vector-map/jquery.vmap.france.js"></script>*/
/*         <script src="vendor/vector-map/jquery.vmap.germany.js"></script>*/
/*         <script src="vendor/vector-map/jquery.vmap.russia.js"></script>*/
/*         <script src="vendor/vector-map/jquery.vmap.usa.js"></script>*/
/* */
/*         <!-- Main JS-->*/
/*         <script src="js/main.js"></script>*/
/* */
/*     </body>*/
/* */
/* </html>*/
