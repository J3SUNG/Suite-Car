<?php

/* id_cancelation_page.twig */
class __TwigTemplate_4efc5162707aba16a9873331c536701b868608b9ee3069e0d956bacea90396be extends Twig_Template
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
        echo "<!DOCTYPE html>
<html lang=\"en\">

<head>
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
                                <a href=\"team\" class=\"nav\">TEAM</a>
                                <a href=\"maps\" class=\"nav\">MAP</a>
                                <a href=\"air_chart\" class=\"nav\">Air Chart</a>
                                <a href=\"heart_chart\" class=\"nav\">Heart Chart</a>
                                <div class=\"account-wrap\">
                                    <div class=\"account-item clearfix js-item-menu\">
                                        <div class=\"image\">
                                            <img src=\"images/icon/avatar-03.jpg\" alt=\"J3SUNG\" />
                                        </div>
                                        <div class=\"content\">
                                            <a class=\"js-acc-btn\" href=\"#\">J3SUNG</a>
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
                                                        <a href=\"#\">J3SUNG</a>
                                                    </h5> 
                                                    <span class=\"email\">wptjd6141@naver.com</span>
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

            <div class=\"main-content\">
                <div class=\"section__content section__content--p30\">
                    <div class=\"container-fluid\">
                        <div class=\"row\">
                            <div class=\"col-md-12 m-t-20\">
                                <div class = \"signup_box\">
                                    <form action=\"changePassword\" method=\"post\">
                                        <div class = \"signup_info\">
                                            <br><img class=\"warning\" src=\"images/icon/warning.png\" alt=\"J3SUNG\" />
                                            <h2 class=\"title\">ID Cancellation</h2><br><br><br>
                                            <input class = \"input_text\" type = \"text\" name=\"username\" placeholder=\"username\">
                                            <hr class = \"hr_w\">
                                            <input class = \"input_text\" type = \"password\" name=\"Password\" placeholder=\"Password\"> <br>
                                            <hr class = \"hr_w\">
                                            <input class = \"input_text\" type = \"password\" name=\"confirmPassword\" placeholder=\"Password Confirm\"><br>
                                            <hr class = \"hr_w\"><br>
                                            <button type = \"button\" onclick=\"location.href = 'login'\" class = \"signup_button\" id = \"cancel\">CANCEL</button>
                                            <button type = \"submit\" class = \"signup_button\" id = \"submit\">SUBMIT</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class=\"row\">
                            <div class=\"col-md-12\">
                                <div class=\"copyright\">
                                    <p>.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
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

</html>
<!-- end document-->";
    }

    public function getTemplateName()
    {
        return "id_cancelation_page.twig";
    }

    public function getDebugInfo()
    {
        return array (  19 => 1,);
    }
}
/* <!DOCTYPE html>*/
/* <html lang="en">*/
/* */
/* <head>*/
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
/*                             <a href="home">*/
/*                                 <img src="images/icon/logo.png" alt="Suite Car" />*/
/*                             </a>*/
/*                         </div>*/
/*                         <div class="header-wrap">*/
/*                             <div class="header-button">         */
/*                                 <a href="team" class="nav">TEAM</a>*/
/*                                 <a href="maps" class="nav">MAP</a>*/
/*                                 <a href="air_chart" class="nav">Air Chart</a>*/
/*                                 <a href="heart_chart" class="nav">Heart Chart</a>*/
/*                                 <div class="account-wrap">*/
/*                                     <div class="account-item clearfix js-item-menu">*/
/*                                         <div class="image">*/
/*                                             <img src="images/icon/avatar-03.jpg" alt="J3SUNG" />*/
/*                                         </div>*/
/*                                         <div class="content">*/
/*                                             <a class="js-acc-btn" href="#">J3SUNG</a>*/
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
/*                                                         <a href="#">J3SUNG</a>*/
/*                                                     </h5> */
/*                                                     <span class="email">wptjd6141@naver.com</span>*/
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
/*             <div class="main-content">*/
/*                 <div class="section__content section__content--p30">*/
/*                     <div class="container-fluid">*/
/*                         <div class="row">*/
/*                             <div class="col-md-12 m-t-20">*/
/*                                 <div class = "signup_box">*/
/*                                     <form action="changePassword" method="post">*/
/*                                         <div class = "signup_info">*/
/*                                             <br><img class="warning" src="images/icon/warning.png" alt="J3SUNG" />*/
/*                                             <h2 class="title">ID Cancellation</h2><br><br><br>*/
/*                                             <input class = "input_text" type = "text" name="username" placeholder="username">*/
/*                                             <hr class = "hr_w">*/
/*                                             <input class = "input_text" type = "password" name="Password" placeholder="Password"> <br>*/
/*                                             <hr class = "hr_w">*/
/*                                             <input class = "input_text" type = "password" name="confirmPassword" placeholder="Password Confirm"><br>*/
/*                                             <hr class = "hr_w"><br>*/
/*                                             <button type = "button" onclick="location.href = 'login'" class = "signup_button" id = "cancel">CANCEL</button>*/
/*                                             <button type = "submit" class = "signup_button" id = "submit">SUBMIT</button>*/
/*                                         </div>*/
/*                                     </form>*/
/*                                 </div>*/
/*                             </div>*/
/*                         </div>*/
/*                         <div class="row">*/
/*                             <div class="col-md-12">*/
/*                                 <div class="copyright">*/
/*                                     <p>.</p>*/
/*                                 </div>*/
/*                             </div>*/
/*                         </div>*/
/*                     </div>*/
/*                 </div>*/
/*             </div>*/
/*         </div>*/
/*     </div>*/
/*     */
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
/* </body>*/
/* */
/* </html>*/
/* <!-- end document-->*/
