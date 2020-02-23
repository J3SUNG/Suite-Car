<?php

/* login.twig */
class __TwigTemplate_aa63b290d30895c4a3dd823e2f087b22174a27c56f22f24e2cc38a07e8a8e11d extends Twig_Template
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
        <title>Suite Car</title>
        <style>
        .body {
            background-color: #27ae60;
        }
        .signin_box {
            margin:auto;
            margin-top:130px;
            height:300px;
            width:1100px;
            background-color: white;
        }
        .box_left {
            float:left;
            height:270px;
            width:440px;
            margin: 10px 40px 40px 40px;
        }
        .box_right {
            float:left;
            height:200px;
            width:410px;
            margin: 60px 40px 40px 90px;
        }
        .input_text {
            border:0px;
            font-size: 18px;
            margin-top: 5px;
        }
        .img_logo {
            width:450px;
            height:auto;
        }
        .home_message {
            text-align: right;
            font-size: 24px;
            font-weight: bold;
            color: #27ae60;
            font-family: Arial, Helvetica, sans-serif;
            margin-right: 10px;
        }
        .button {
            background-color: #27ae60;
            border: none;
            border-radius: 5px;
            width: 130px;
            height: 30px;
            text-align: center;
            color: white;
            float: right;
            margin-left: 20px;
        }
        .hr_w {
            border:solid 0.5px;
        }
        .hr_h {
            border:solid 0.3px;
            height: 280px;
            width: 0px;
            float: left;
        }
        input {
            width: 100%;
        }
        input:focus {
            outline: none;
        }
        button {
            cursor: pointer;
        }
        button:focus {
            outline: none;
        }
        </style>
    </head>
    <body class = \"body\">
        <div class = \"signin_box\">
            <div class = \"box_left\">
                <img class = \"img_logo\" src=\"images/logo.png\" alt=\"logo\">
                <br><br>
                <div class = \"home_message\">
                    For your PERFECT driving,<br>
                    Join us Right NOW!                        
                </div>
            </div>
            <hr class = hr_h>
            <div class = \"box_right\">
                <form action=\"signin\" method=\"post\">
                    <input class = \"input_text\" type = \"text\" name=\"username\" placeholder=\"Username\"> <br>
                    <hr class = \"hr_w\"><br>
                    <input class = \"input_text\" type = \"password\" name=\"password\" placeholder=\"Password\">
                    <hr class = \"hr_w\"><br>
                    <button class = \"button\">Sign In</button><br>
                </form>
                <button type = \"button\" onclick = \"location.href='forgotten'\" class = \"button\">Forgotten PW</button>
                <button type = \"button\" onclick = \"location.href='signup'\" class = \"button\">Sign Up</button>
            </div>
        </div>
    </body>
</html>";
    }

    public function getTemplateName()
    {
        return "login.twig";
    }

    public function getDebugInfo()
    {
        return array (  19 => 1,);
    }
}
/* <html>*/
/*     <head>*/
/*         <title>Suite Car</title>*/
/*         <style>*/
/*         .body {*/
/*             background-color: #27ae60;*/
/*         }*/
/*         .signin_box {*/
/*             margin:auto;*/
/*             margin-top:130px;*/
/*             height:300px;*/
/*             width:1100px;*/
/*             background-color: white;*/
/*         }*/
/*         .box_left {*/
/*             float:left;*/
/*             height:270px;*/
/*             width:440px;*/
/*             margin: 10px 40px 40px 40px;*/
/*         }*/
/*         .box_right {*/
/*             float:left;*/
/*             height:200px;*/
/*             width:410px;*/
/*             margin: 60px 40px 40px 90px;*/
/*         }*/
/*         .input_text {*/
/*             border:0px;*/
/*             font-size: 18px;*/
/*             margin-top: 5px;*/
/*         }*/
/*         .img_logo {*/
/*             width:450px;*/
/*             height:auto;*/
/*         }*/
/*         .home_message {*/
/*             text-align: right;*/
/*             font-size: 24px;*/
/*             font-weight: bold;*/
/*             color: #27ae60;*/
/*             font-family: Arial, Helvetica, sans-serif;*/
/*             margin-right: 10px;*/
/*         }*/
/*         .button {*/
/*             background-color: #27ae60;*/
/*             border: none;*/
/*             border-radius: 5px;*/
/*             width: 130px;*/
/*             height: 30px;*/
/*             text-align: center;*/
/*             color: white;*/
/*             float: right;*/
/*             margin-left: 20px;*/
/*         }*/
/*         .hr_w {*/
/*             border:solid 0.5px;*/
/*         }*/
/*         .hr_h {*/
/*             border:solid 0.3px;*/
/*             height: 280px;*/
/*             width: 0px;*/
/*             float: left;*/
/*         }*/
/*         input {*/
/*             width: 100%;*/
/*         }*/
/*         input:focus {*/
/*             outline: none;*/
/*         }*/
/*         button {*/
/*             cursor: pointer;*/
/*         }*/
/*         button:focus {*/
/*             outline: none;*/
/*         }*/
/*         </style>*/
/*     </head>*/
/*     <body class = "body">*/
/*         <div class = "signin_box">*/
/*             <div class = "box_left">*/
/*                 <img class = "img_logo" src="images/logo.png" alt="logo">*/
/*                 <br><br>*/
/*                 <div class = "home_message">*/
/*                     For your PERFECT driving,<br>*/
/*                     Join us Right NOW!                        */
/*                 </div>*/
/*             </div>*/
/*             <hr class = hr_h>*/
/*             <div class = "box_right">*/
/*                 <form action="signin" method="post">*/
/*                     <input class = "input_text" type = "text" name="username" placeholder="Username"> <br>*/
/*                     <hr class = "hr_w"><br>*/
/*                     <input class = "input_text" type = "password" name="password" placeholder="Password">*/
/*                     <hr class = "hr_w"><br>*/
/*                     <button class = "button">Sign In</button><br>*/
/*                 </form>*/
/*                 <button type = "button" onclick = "location.href='forgotten'" class = "button">Forgotten PW</button>*/
/*                 <button type = "button" onclick = "location.href='signup'" class = "button">Sign Up</button>*/
/*             </div>*/
/*         </div>*/
/*     </body>*/
/* </html>*/
