<?php
/**
 * Banner -for dev mode
 */
?>
    <!doctype html>
    <html lang="ru">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Dev Mode</title>
        <?php wp_head();  ?>
    </head>
    <body>
        <div class="" style="max-width:80vw;height: 100vh; background-color: #ddd;padding: 5rem;margin: 0 auto; ">
            <section style="margin: auto">
                <h1 style="text-align: center">Dev Mode</h1>
                <p style="margin: 0 auto;text-align: center;">Если вы имеете учетную запись , вы можете зайти на сайт
                    <a href="<?php echo site_url(). '/wp-login.php'  ?>">
                        ПО ССЫЛКЕ - нажмите ТУТ
                    </a>
                </p>
            </section>
        </div>

    <?php wp_footer();  ?>
    </body>
    </html>
<?php
exit;