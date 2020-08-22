<?php
    /*
    ** /admin/social.php for RustPHP
    **
    ** Made by kgtrey1
    ** Email admin@kgtrey1.eu
    **
    ** Started on 02-Oct-2018 by kgtrey1
    */

    require_once($_SERVER["DOCUMENT_ROOT"] . "/config/session.php");

    if (!user_is_connected() OR !user_is_admin())
    {
        header('Location: ../index.php');
    }
    else
    {
        $active_page = "social";
        require_once($_SERVER["DOCUMENT_ROOT"] . "/class/social_manager.class.php");
?>

<!DOCTYPE html>
<html>
    <head>
        <title>RustPHP - News</title>
        <meta charset="utf-8">
        <meta name="author" content="kgtrey1">
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" type="text/css" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css">
        <script type="text/javascript" src="js/jquery.min.js"></script>
        <script type="text/javascript" src="js/popper.min.js"></script>
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
    </head>
    <body>
        <div class="wrapper">
            <?php include_once($_SERVER["DOCUMENT_ROOT"] . "/admin/template/sidebar.php"); ?>
            <div class="container-fluid">
                <div class="row v-center">     
                    <?php
                        include_once($_SERVER["DOCUMENT_ROOT"] . "/admin/template/social_edit.php");
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>

<script type="text/javascript">
$(document).ready(function()
{
    $("#discord-result").hide();
    $("#steam-result").hide();
    $("#rust-result").hide();
    $("#edit-discord").click(function(e){e.preventDefault();
        $("#discord-result").html("<p class='alert alert-info text-center' role='alert'>Chargement...</p>");
        $("#discord-result").show();
        $("#edit-discord").prop('disabled', true);
        $("#edit-discord").prop('value', 'Chargement..');
        $.post('script/social_edit.php',
        {
            id : "discord",
            link : $("#discord-link").val(),
            content : $("#discord-content").val()
        },
        function(data)
        {
            if(data == 'SUCCESS')
            {
                $("#discord-result").html("<p class='alert alert-success text-center' role='alert'>Changements effectués.</p>");
                $("#edit-discord").prop('disabled', false);
                $("#edit-discord").prop('value', 'Modifier');
                setTimeout(function () {$("#discord-result").hide();}, 2000);
            }
            else
                alert(data);

        },);
    });
    $("#edit-steam").click(function(e){e.preventDefault();
        $("#steam-result").html("<p class='alert alert-info text-center' role='alert'>Chargement...</p>");
        $("#steam-result").show();
        $("#edit-steam").prop('disabled', true);
        $("#edit-steam").prop('value', 'Chargement..');
        $.post('script/social_edit.php',
        {
            id : "steam",
            link : $("#steam-link").val(),
            content : $("#steam-content").val()
        },
        function(data)
        {
            if(data == 'SUCCESS')
            {
                $("#steam-result").html("<p class='alert alert-success text-center' role='alert'>Changements effectués.</p>");
                $("#edit-steam").prop('disabled', false);
                $("#edit-steam").prop('value', 'Modifier');
                setTimeout(function () {$("#steam-result").hide();}, 2000);
            }
            else
                alert(data);

        },);
    });
    $("#edit-rust").click(function(e){e.preventDefault();
        $("#rust-result").html("<p class='alert alert-info text-center' role='alert'>Chargement...</p>");
        $("#rust-result").show();
        $("#edit-rust").prop('disabled', true);
        $("#edit-rust").prop('value', 'Chargement..');
        $.post('script/social_edit.php',
        {
            id : "rust",
            link : $("#rust-link").val(),
            content : $("#rust-content").val()
        },
        function(data)
        {
            if(data == 'SUCCESS')
            {
                $("#rust-result").html("<p class='alert alert-success text-center' role='alert'>Changements effectués.</p>");
                $("#edit-rust").prop('disabled', false);
                $("#edit-rust").prop('value', 'Modifier');
                setTimeout(function () {$("#rust-result").hide();}, 2000);
            }
            else
                alert(data);

        },);
    });
});

</script>




<?php
    }
?>