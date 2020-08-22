<?php
    /*
    ** /admin/script/news_add.php for RustPHP
    **
    ** Made by kgtrey1
    ** Email admin@kgtrey1.eu
    **
    ** Started on 01-Oct-2018 by kgtrey1
    */

    require_once($_SERVER["DOCUMENT_ROOT"] . "/config/session.php");

    if (!user_is_connected() OR !user_is_admin())
    {
        header('Location: ../index.php');
    }
    else
    {
        $active_page = "news";
        require_once($_SERVER["DOCUMENT_ROOT"] . "/class/news.class.php");
?>

<!DOCTYPE html>
<html>
    <head>
        <title>RustPHP - News</title>
        <meta charset="utf-8">
        <meta name="author" content="kgtrey1">
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="css/wbbtheme.css">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" type="text/css" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css">
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script type="text/javascript" src="js/popper.min.js"></script>
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
        <script type="text/javascript" src="js/jquery.wysibb.min.js"></script>
        <script type="text/javascript" src="js/news.js"></script>
    </head>
    <body>
        <div class="wrapper">
            <?php include_once($_SERVER["DOCUMENT_ROOT"] . "/admin/template/sidebar.php"); ?>
            <div class="container-fluid">
                <div class="row v-center">     
                    <?php
                        include_once($_SERVER["DOCUMENT_ROOT"] . "/admin/template/news_add.php");
                        include_once($_SERVER["DOCUMENT_ROOT"] . "/admin/template/news_edit.php");
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>

<?php
    }
?>