<?php

/* signup.twig */
class __TwigTemplate_2e97d39ff38a5bf88a501aba3429dfde1f7926d1342e0c43edeb8498bc618efa extends Twig_Template
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
        <script type='text/javascript' src='http://code.jquery.com/jquery.min.js'></script>
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
        .signup_info {
            text-align: center;
        }
        .signup_button {
            background-color: #27c96a;
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
        #submit {
            margin-right: 20px;
        }
        </style>
    </head>
    <body class = \"body\">
        <div class = \"signup_box\">
            <img class = \"mini_img_logo\" src=\"images/logo.png\" alt=\"logo\"><br>
            <!--<form action=\"signup_check\" method=\"post\">-->
                <div class = \"signup_info\">
                    <input class = \"input_text\" type = \"text\" name=\"username\" id=\"username\" placeholder=\"Username\">
                    <hr class = \"hr_w\">
                    <input class = \"input_text\" type = \"text\" name=\"email\" id=\"email\" placeholder=\"Email Address\"><br>
                    <hr class = \"hr_w\">
                    <input class = \"input_text\" type = \"password\" name=\"password\" id=\"password\" placeholder=\"Password\" > <br>
                    <hr class = \"hr_w\">
                    <input class = \"input_text\" type = \"password\" name=\"password_confirm\" id=\"password_confirm\" placeholder=\"Password_confirmation\"><br>
                    <hr class = \"hr_w\">
                    <div class = \"input_text\" type = \"text\" name=\"alert_notEqual\" id=\"alert_notEqual\">Incorrect Password</div>
                    <div class = \"input_text\" type = \"text\" name=\"alert_equal\" id=\"alert_equal\">Correct Password<br></div>
                    <input class = \"input_text\" type = \"text\" name=\"phone\" id=\"phone\" placeholder=\"Phone_number\"> <br>
                    <hr class = \"hr_w\">
                    <input class = \"input_text\" type = \"text\" name=\"first_name\" id=\"first_name\" placeholder=\"First_name\"><br>
                    <hr class = \"hr_w\">
                    <input class = \"input_text\" type = \"text\" name=\"last_name\" id = \"last_name\" placeholder=\"Last_name\"><br>
                    <hr class = \"hr_w\">
                    <button type = \"button\" onclick=\"location.href = 'login'\" class = \"signup_button\" id = \"cancel\">CANCEL</button>
                    <button type = \"submit\" class = \"signup_button\" id = \"submit\" disabled>SUBMIT</button>
                </div>
            <!--</form>-->
        </div>
    </body>
</html>

<script type='text/javascript'>
\$(function(){
    \$(\"#alert_notEqual\").hide();
    \$(\"#alert_equal\").hide();

    \$('#password_confirm').keyup(function(event) {
        var password = \$('#password').val();
        var password_confirm = \$('#password_confirm').val();
        //compare two password
        if(password == password_confirm) {
            \$(\"#alert_equal\").show();
            \$(\"#alert_notEqual\").hide();
            document.getElementById(\"submit\").disabled = false;
        }
        else {
            \$(\"#alert_equal\").hide();
            \$(\"#alert_notEqual\").show();
            document.getElementById(\"submit\").disabled = true;
        }
    });

    \$(\"#submit\").click(function(event) {
        \$.ajax({
            type : \"POST\",
            url :\"/signup_check\",
            data : {
                \"username\" : \$('#username').val(),
                \"email\" : \$('#email').val(),
                \"password\" : \$('#password').val(),
                \"password_confirm\" : \$('#password_confirm').val(),
                \"phone\" : \$('#phone').val(),
                \"first_name\" : \$('#first_name').val(),
                \"last_name\" : \$('#last_name').val()
            },
            success : function(data) {
                alert(data);
                //alert(\"E-mail has been sent. Check your E-mail.\");
            },
            error : function (request, error) {
                alert(\" Can't do because: \" + error);
            }
        });
    });
});
</script>";
    }

    public function getTemplateName()
    {
        return "signup.twig";
    }

    public function getDebugInfo()
    {
        return array (  19 => 1,);
    }
}
/* <html>*/
/*     <head>*/
/*         <script type='text/javascript' src='http://code.jquery.com/jquery.min.js'></script>*/
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
/*         .signup_info {*/
/*             text-align: center;*/
/*         }*/
/*         .signup_button {*/
/*             background-color: #27c96a;*/
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
/*         #submit {*/
/*             margin-right: 20px;*/
/*         }*/
/*         </style>*/
/*     </head>*/
/*     <body class = "body">*/
/*         <div class = "signup_box">*/
/*             <img class = "mini_img_logo" src="images/logo.png" alt="logo"><br>*/
/*             <!--<form action="signup_check" method="post">-->*/
/*                 <div class = "signup_info">*/
/*                     <input class = "input_text" type = "text" name="username" id="username" placeholder="Username">*/
/*                     <hr class = "hr_w">*/
/*                     <input class = "input_text" type = "text" name="email" id="email" placeholder="Email Address"><br>*/
/*                     <hr class = "hr_w">*/
/*                     <input class = "input_text" type = "password" name="password" id="password" placeholder="Password" > <br>*/
/*                     <hr class = "hr_w">*/
/*                     <input class = "input_text" type = "password" name="password_confirm" id="password_confirm" placeholder="Password_confirmation"><br>*/
/*                     <hr class = "hr_w">*/
/*                     <div class = "input_text" type = "text" name="alert_notEqual" id="alert_notEqual">Incorrect Password</div>*/
/*                     <div class = "input_text" type = "text" name="alert_equal" id="alert_equal">Correct Password<br></div>*/
/*                     <input class = "input_text" type = "text" name="phone" id="phone" placeholder="Phone_number"> <br>*/
/*                     <hr class = "hr_w">*/
/*                     <input class = "input_text" type = "text" name="first_name" id="first_name" placeholder="First_name"><br>*/
/*                     <hr class = "hr_w">*/
/*                     <input class = "input_text" type = "text" name="last_name" id = "last_name" placeholder="Last_name"><br>*/
/*                     <hr class = "hr_w">*/
/*                     <button type = "button" onclick="location.href = 'login'" class = "signup_button" id = "cancel">CANCEL</button>*/
/*                     <button type = "submit" class = "signup_button" id = "submit" disabled>SUBMIT</button>*/
/*                 </div>*/
/*             <!--</form>-->*/
/*         </div>*/
/*     </body>*/
/* </html>*/
/* */
/* <script type='text/javascript'>*/
/* $(function(){*/
/*     $("#alert_notEqual").hide();*/
/*     $("#alert_equal").hide();*/
/* */
/*     $('#password_confirm').keyup(function(event) {*/
/*         var password = $('#password').val();*/
/*         var password_confirm = $('#password_confirm').val();*/
/*         //compare two password*/
/*         if(password == password_confirm) {*/
/*             $("#alert_equal").show();*/
/*             $("#alert_notEqual").hide();*/
/*             document.getElementById("submit").disabled = false;*/
/*         }*/
/*         else {*/
/*             $("#alert_equal").hide();*/
/*             $("#alert_notEqual").show();*/
/*             document.getElementById("submit").disabled = true;*/
/*         }*/
/*     });*/
/* */
/*     $("#submit").click(function(event) {*/
/*         $.ajax({*/
/*             type : "POST",*/
/*             url :"/signup_check",*/
/*             data : {*/
/*                 "username" : $('#username').val(),*/
/*                 "email" : $('#email').val(),*/
/*                 "password" : $('#password').val(),*/
/*                 "password_confirm" : $('#password_confirm').val(),*/
/*                 "phone" : $('#phone').val(),*/
/*                 "first_name" : $('#first_name').val(),*/
/*                 "last_name" : $('#last_name').val()*/
/*             },*/
/*             success : function(data) {*/
/*                 alert(data);*/
/*                 //alert("E-mail has been sent. Check your E-mail.");*/
/*             },*/
/*             error : function (request, error) {*/
/*                 alert(" Can't do because: " + error);*/
/*             }*/
/*         });*/
/*     });*/
/* });*/
/* </script>*/
