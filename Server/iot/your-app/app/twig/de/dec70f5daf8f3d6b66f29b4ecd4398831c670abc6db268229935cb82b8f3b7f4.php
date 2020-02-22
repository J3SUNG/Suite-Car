<?php

/* forgotten.twig */
class __TwigTemplate_a576e934f6085239d1ba9ddb0fcad3df8253de57395c14177f154b44a42b1e48 extends Twig_Template
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
        .signup_box {
            margin:auto;
            height:100%;
            width:550px;
            background-color: white;
        }
        .mini_img_logo {
            display: block;
            margin: auto;
            width:330px;
            height:auto;
        }
        .hr_w {
            border:solid 0.4px;
            width: 450px;
            margin-bottom: 18px;
        }
        .forgotten_info {
            text-align: center;
        }
        .forgotten_input {
            margin-top: 50px;
        }
        .forgotten_button {
            background-color: #27ae60;
            border: none;
            border-radius: 5px;
            width: 130px;
            height: 30px;
            text-align: center;
            color: white;
            float: right;
        }
        input {
            border: none;
            width: 450px;
            font-size: 17px;
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
        #cancel {
            margin-right: 50px;
        }
        #find {
            margin-right: 20px;
        }
        </style>
    </head>
    <body class = \"body\">
        <div class = \"signup_box\">
            <img class = \"mini_img_logo\" src=\"images/logo.png\" alt=\"logo\"><br>
            <div class = \"forgotten_info\">
                <div class = \"forgotten_input\">
                    <form action = \"forgotten_check\">    
                        <input class = \"input_text\" type = \"text\" name=\"username\" placeholder=\"Username\">
                        <hr class = \"hr_w\"><br>
                        <input class = \"input_text\" type = \"text\" name=\"email\" placeholder=\"Email Address\"><br>
                        <hr class = \"hr_w\"><br>
                        <button type=\"button\" onclick=\"location.href='login'\" class = \"forgotten_button\" id = \"cancel\">CANCLE</button>
                        <button type=\"submit\" class = \"forgotten_button\" id = \"find\">FIND</button>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>";
    }

    public function getTemplateName()
    {
        return "forgotten.twig";
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
/*         .signup_box {*/
/*             margin:auto;*/
/*             height:100%;*/
/*             width:550px;*/
/*             background-color: white;*/
/*         }*/
/*         .mini_img_logo {*/
/*             display: block;*/
/*             margin: auto;*/
/*             width:330px;*/
/*             height:auto;*/
/*         }*/
/*         .hr_w {*/
/*             border:solid 0.4px;*/
/*             width: 450px;*/
/*             margin-bottom: 18px;*/
/*         }*/
/*         .forgotten_info {*/
/*             text-align: center;*/
/*         }*/
/*         .forgotten_input {*/
/*             margin-top: 50px;*/
/*         }*/
/*         .forgotten_button {*/
/*             background-color: #27ae60;*/
/*             border: none;*/
/*             border-radius: 5px;*/
/*             width: 130px;*/
/*             height: 30px;*/
/*             text-align: center;*/
/*             color: white;*/
/*             float: right;*/
/*         }*/
/*         input {*/
/*             border: none;*/
/*             width: 450px;*/
/*             font-size: 17px;*/
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
/*         #cancel {*/
/*             margin-right: 50px;*/
/*         }*/
/*         #find {*/
/*             margin-right: 20px;*/
/*         }*/
/*         </style>*/
/*     </head>*/
/*     <body class = "body">*/
/*         <div class = "signup_box">*/
/*             <img class = "mini_img_logo" src="images/logo.png" alt="logo"><br>*/
/*             <div class = "forgotten_info">*/
/*                 <div class = "forgotten_input">*/
/*                     <form action = "forgotten_check">    */
/*                         <input class = "input_text" type = "text" name="username" placeholder="Username">*/
/*                         <hr class = "hr_w"><br>*/
/*                         <input class = "input_text" type = "text" name="email" placeholder="Email Address"><br>*/
/*                         <hr class = "hr_w"><br>*/
/*                         <button type="button" onclick="location.href='login'" class = "forgotten_button" id = "cancel">CANCLE</button>*/
/*                         <button type="submit" class = "forgotten_button" id = "find">FIND</button>*/
/*                     </form>*/
/*                 </div>*/
/*             </div>*/
/*         </div>*/
/*     </body>*/
/* </html>*/
