<?php
global $common_email_fields;

global $is_pdf;


//================================
// for test
//$img_src =  site_url() . '/assets/img/logo.jpg'   ;

// for realise
$img_src =  site_url() . '/wp-content/plugins/alex-extra-core/assets/img/logo.jpg'   ;

if(isset($is_pdf)  && $is_pdf === true ) :
?>
<!doctype html>
<html lang="ru">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>PDF</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
        <style>
            *{
                box-sizing: border-box;
                letter-spacing: 0.3px !important;
                /*font-family:  Arial , Verdana , Tahoma, sans-serif;*/
                font-family: 'Roboto', sans-serif;
            }
            body{
                color: #555;
                background-color: lightgreen;
            }
            /*[style*="Raleway"] {font-family: 'Raleway', arial, sans-serif !important;}*/
            .mail-wrapper{
                max-width: 100%;
                width: 600px;
                margin: 40px  auto 40px auto;
                background-color: #fff;

            }
            .mail-header{
                max-width: 600px;
                width:600px;
                margin: 0 auto 30px auto;
                border-bottom: 1px solid rgba(0 , 0 , 0 , 0.7);
                background-color: #eee;
            }
            .mail-header img{
                max-width: 100%;
                width: 100px;
                height: 100px;
                margin-bottom: 30px;
                margin-top: 40px;
                margin-left: 20px;
                display: inline-block;


            }
            .mail-content{
                display: block;
                width: 600px;
                max-width: 600px;
                margin: 0 auto;
            }
            .mail-content ul{
                max-width: 100%;
                text-decoration: none;
                list-style: none;
                padding:0;
                margin: 0;
            }
            .data-row{
                max-width: 100%;
                display: block;
                padding:15px 10px 15px 10px;
                list-style: none;
                text-decoration: none;

            }
            .data-row:nth-of-type(odd){
                background-color: #eee;
            }
            .data-row:after{
                display: table;
                clear: both;
                content: '';
            }
            .row-title{
                width:  265px;
                display: block;
                float: left;
            }
            .row-value{
                float:left;
                /*width: 300px;*/
                padding-right: 5px;
                display:block;
                max-width: 300px;
            }
            .row-value a{
                color: #555;
                text-decoration: none;
                transition: color 0.3s ease-in-out;
                letter-spacing: 0.3px;
            }
            .row-value a:hover{
                color: #333;
                transition: color 0.3s ease-in-out;
            }
            .row-value span ,
            .row-title span{
                letter-spacing: 0.3px !important;
                display: block;


            }
            .row-value span{
            }
        </style>

    </head>
    <body>
        <div class="mail-wrapper">
            <div class="mail-header">
                <a href="<?php  echo site_url(); ?>">
                    <img style="max-height:100px !important; max-width:100px !important;text-align: center;" width="600" src="<?php  echo $img_src; ?>" alt="banner"/>
                </a>
            </div>
            <div class="mail-content">
                <ul>
                    <?php if(isset($common_email_fields['alex_user_name']) ):  ?>
                            <li class="data-row">
                                <div class="row-title">
                                    <span>
                                        Имя отправителя:
                                    </span>
                                </div>
                                <div class="row-value">
                                    <span>
										<?php esc_html_e($common_email_fields['alex_user_name']);  ?>
                                    </span>
                                </div>
                            </li>
                    <?php  endif;  ?>
	                <?php if(isset($common_email_fields['alex_email'])  ) :  ?>
                        <li class="data-row">
                            <div class="row-title">
                                   <span>
                                        Email отправителя:
                                    </span>
                            </div>
                            <div class="row-value">
                                <a
                                   href="mailto:<?php esc_html_e($common_email_fields['alex_email']);  ?>">
		                            <?php esc_html_e($common_email_fields['alex_email']);  ?>
                                </a>
                            </div>
                        </li>
	                <?php  endif;  ?>
	                <?php if(isset($common_email_fields['alex_tel'])  )  :  ?>
                        <li class="data-row">
                            <div class="row-title">
                                 <span>
                                     Номер телефона отправителя:
                                 </span>
                            </div>
                            <div class="row-value">
                                <a
                                   href="tel:<?php esc_html_e($common_email_fields['alex_tel']);  ?>">
		                            <?php esc_html_e($common_email_fields['alex_tel']);  ?>
                                </a>
                            </div>
                        </li>
	                <?php  endif;  ?>
	                <?php if(isset($common_email_fields['alex_message'])  )  :  ?>
                        <li class="data-row">
                            <div class="row-title">
                                <span>
                                    Сообщение:
                                 </span>
                            </div>
                            <div class="row-value">
                                <span>
                                            <?php esc_html_e($common_email_fields['alex_message']);  ?>
                                 </span>
                            </div>
                        </li>
	                <?php  endif;  ?>
	                <?php if(isset($common_email_fields['alex_single_material_title'])
	                         && !empty($common_email_fields['alex_single_material_title']) ) :  ?>
                        <li class="data-row">
                            <div class="row-title">
                                 <span>
                                       Тема:
                                 </span>
                            </div>
                            <div class="row-value">
                                <span>
											<?php esc_html_e($common_email_fields['alex_single_material_title']) ; ?>
                                </span>
                            </div>
                        </li>
	                <?php  endif;  ?>
                </ul>
            </div>
        </div>
    </body>
</html>
<?php  else: ?>
<!DOCTYPE html
        PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Mail</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:300,400,500,600"/>
    <style>
        body {
            width: 100% !important;
            max-width: 100% !important;
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
            margin: 0;
            padding: 0;
            line-height: 100%;
        }
        [style*="Raleway"] {font-family: 'Raleway', arial, sans-serif !important;}
        img {
            outline: none;
            text-decoration: none;
            border:none;
            -ms-interpolation-mode: bicubic;
            margin: 0;
            padding: 0;
            display: block;
        }
        table td {
            border-collapse: collapse;
        }
        table {
            border-collapse: collapse;
            mso-table-lspace: 0pt;
            mso-table-rspace: 0pt;
        }

        .table-wrapper{
            margin: 0 auto;
            max-width: 100% !important;
        }
        .main-table{
            /*margin: 0;*/
        }
        .content-td{
            padding-top: 10px;
            padding-bottom: 40px;
        }
        .line{
            width: 600px;
        }
        .line td{
            padding-top: 15px;
            padding-bottom: 15px;
            width: 600px;
        }
        .line a{
            color:#555555;
            text-decoration: none;
            letter-spacing: 0.28px;
            font-weight: 400;
            font-size: 14px;
            transition: color 0.3s ease-in-out;
        }
        .line a:hover{
            transition: color: 0.3s ease-in-out;
            color: #000000;
        }
        .line span{
            color: #333333;
            letter-spacing: 0.28px;
            font-weight: 400;
            font-size: 14px;
            padding-left: 10px;
            display: inline-block;
            padding-right: 15px;
        }
        .bottom-divider.line{
            width: 600px;
            padding: 0 0 0 0;
        }
        .bottom-divider.line td{
            padding: 0 0 0 0;
        }
    </style>
</head>
<body style="margin: 0; padding: 0; max-width: 100%; ">
<div style="font-size:0px;font-color:#ffffff;opacity:0;visibility:hidden;width:0;height:0;display:none;">Ferrara design mail</div>
<table class="table-wrapper" cellpadding="0" cellspacing="0" width="100%" bgcolor="#80daa6">
    <tr>
        <td width="600">
            <table class="main-table table-600" cellpadding="0" cellspacing="0" width="600" align="center">
                <tr>
                    <td height="30"></td>
                </tr>
                <tr>
                    <td class="banner-td">
                        <a href="<?php  echo site_url(); ?>">
                            <img style="max-height:100px !important; max-width:100px !important;text-align: center;" width="100" height="100" src="<?php  echo $img_src; ?>" alt="banner"/>
                        </a>
                    </td>
                </tr>
                <tr>
                    <td width="600" bgcolor="#80daa6" class="content-td">
                        <table class="table-600" cellspacing="0" cellpadding="0" align="center" width="600">
							<?php if(isset($common_email_fields['alex_user_name']) ):  ?>
                                <tr class="line" bgcolor="#eeeeee">
                                    <td>
                                        <span style="font-family: Arial, Helvetica, sans-serif, 'Raleway'; " >
                                            &nbsp;&nbsp;Имя отправителя:
                                        </span>
                                    </td>
                                    <td class="line" >
                                        <span style="font-family: Arial, Helvetica, sans-serif, 'Raleway'  ;">
                                            <?php esc_html_e($common_email_fields['alex_user_name']);  ?>
                                        </span>
                                    </td>
                                </tr>
							<?php
							endif;
							if(isset($common_email_fields['alex_email'])  ) :  ?>
                                <tr class="line" bgcolor="#ffffff">
                                    <td>
                                    <span style="font-family: Arial, Helvetica, sans-serif, 'Raleway';" >
                                        &nbsp;&nbsp;Email отправителя:
                                    </span>
                                    </td>
                                    <td>
                                        <a style="font-family: Arial, Helvetica, sans-serif, 'Raleway'  ;"
                                           href="mailto:<?php esc_html_e($common_email_fields['alex_email']);  ?>">
											<?php esc_html_e($common_email_fields['alex_email']);  ?>
                                        </a>
                                    </td>
                                </tr>
							<?php
							endif;
							if(isset($common_email_fields['alex_tel'])  )  :  ?>
                                <tr class="line" bgcolor="#eeeeee">
                                    <td>
                                        <span style="font-family: Arial, Helvetica, sans-serif, 'Raleway';" >
                                            &nbsp;&nbsp;Номер телефона отправителя:
                                        </span>
                                    </td>
                                    <td>
                                        <a style="font-family: Arial, Helvetica, sans-serif, 'Raleway'  ;"
                                           href="tel:<?php esc_html_e($common_email_fields['alex_tel']);  ?>">
											<?php esc_html_e($common_email_fields['alex_tel']);  ?>
                                        </a>
                                    </td>
                                </tr>
							<?php
							endif;
							if(isset($common_email_fields['alex_message'])  )  :  ?>
                                <tr class="line" bgcolor="#ffffff">
                                    <td valign="top">
                                        <span style="font-family: Arial, Helvetica, sans-serif, 'Raleway';" >
                                            &nbsp;&nbsp;Сообщение:
                                        </span>
                                    </td>
                                    <td>
                                        <span style="font-family: Arial, Helvetica, sans-serif, 'Raleway';">
                                            <?php esc_html_e($common_email_fields['alex_message']);  ?>
                                        </span>
                                    </td>
                                </tr>
							<?php
							endif;
							if(isset($common_email_fields['alex_single_material_title'])
							   && !empty($common_email_fields['alex_single_material_title']) ) : ?>
                                <tr class="line" bgcolor="#eeeeee">
                                    <td>
                                        <span style="font-family: Arial, Helvetica, sans-serif, 'Raleway';" >
                                           &nbsp;&nbsp;Тема:
                                        </span>
                                    </td>
                                    <td>
                                        <span style="font-family: Arial, Helvetica, sans-serif, 'Raleway';">
											<?php esc_html_e($common_email_fields['alex_single_material_title']) ; ?>
                                        </span>
                                    </td>
                                </tr>
							<?php   endif; ?>
                            <tr class="bottom-divider line">
                                <td  height="5" bgcolor="#abbdc1"></td>
                                <td height="5" bgcolor="#abbdc1"></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>
</html>
<?php  endif;