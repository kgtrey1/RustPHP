$(document).ready(function()
{
    var wbbOpt = { buttons: "bold,italic,underline,|,img,link,|,justifyleft,justifycenter,justifyright,|,quote,bullist,numlist,|,fontcolor,fontsize" }
    $("#add-news-content").wysibb(wbbOpt);
    $("#edit-news-content").wysibb(wbbOpt);
    $("#news-editor").hide();

    $("#add-news").click(function(e){e.preventDefault();
        $("#add-news").prop('disabled', true);
        $("#add-news").prop('value', 'Chargement..');
        $.post('script/news_add.php',
        {
            title : $("#add-news-title").val(),
            summary : $("#add-news-summary").val(),
            content : $("#add-news-content").bbcode()
        },
        function(data)
        {
            if (data == "SUCCESS")
            {
                $("#add-news-result").html("<p class='alert alert-success text-center' role='alert'>Votre news à bien été publiée. Vous allez être redirigé..</p>");
                setTimeout(function () {location.reload();}, 1000);
            }
            else if (data == "error_admin")
            {
                $("#add-news-result").html("<p class='alert alert-danger text-center' role='alert'>Vous devez être connecté pour publier une news.</p>");
                $("#add-news").prop('disabled', false);
                $("#add-news").prop('value', 'Publier une news');
            }
            else
            {
                $("#add-news-result").html("<p class='alert alert-danger text-center' role='alert'>Une erreur est survenue, contactez le webmaster.</p>");
                $("#add-news").prop('disabled', false);
                $("#add-news").prop('value', 'Publier une news');
            }
        },);
    });

    $("#edit-news").click(function(e){e.preventDefault();
        $.post('script/news_get.php',
        {
            title : $('#news-selecter option:selected').val(),
            dataType: "JSON"
        },
        function(data)
        {
            if (data.title != "error" && data.summary != "error" && data.content != "error")
            {
                $("#news-editor").show();
                $("#edit-news-id").prop("value", data.id);
                $("#edit-news-title").prop("value", data.title);
                $("#edit-news-summary").prop("value", data.summary);
                $("#edit-news-content").prop("value", data.content);
                $("#news-menu").hide();
            }
            else if (data == "error_admin")
            {
                $("#edit-result").html("<p class='alert alert-danger text-center' role='alert'>Vous devez être connecté pour effectuer cette action.</p>");
            }
            else
            {
                $("#edit-result").html("<p class='alert alert-danger text-center' role='alert'>Une erreur est survenue, contactez le webmaster.</p>");
            }
        },);
    });

    $("#delete-news").click(function(e){e.preventDefault();
        $("#delete-news").prop('disabled', true);
        $.post('script/news_delete.php',
        {
            title : $('#news-selecter option:selected').val()
        },
        function(data)
        {
            if (data == "SUCCESS")
            {
                $("#edit-result").html("<p class='alert alert-success text-center' role='alert'>Votre news a bien été supprimée. Vous allez être redirigé...</p>");
                setTimeout(function () {location.reload();}, 1000);
            }
            else if (data == "error_admin")
            {
                $("#edit-result").html("<p class='alert alert-danger text-center' role='alert'>Vous devez être connecté pour effectuer une action.</p>");
            }
            else
            {
                $("#edit-result").html("<p class='alert alert-danger text-center' role='alert'>Une erreur est survenue, contactez le webmaster.</p>");
            }
        },);
    });

    $("#push-edit-news").click(function(e){e.preventDefault();
        $("#push-edit-news").prop('disabled', true);
        $("#cancel-edit-news").prop('disabled', true);
        $.post('script/news_edit.php',
        {
            id : $("#edit-news-id").val(),
            title : $("#edit-news-title").val(),
            summary : $("#edit-news-summary").val(),
            content : $("#edit-news-content").bbcode()
        },
        function(data)
        {
            if (data == "SUCCESS")
            {
                $("#edit-result").html("<p class='alert alert-success text-center' role='alert'>Votre news a bien été éditée. Vous allez être redirigé...</p>");
                $("#edit-news-title").prop("value", "");
                $("#edit-news-summary").prop("value", "");
                $("#edit-news-content").htmlcode("<br>");
                $("#news-editor").hide();
                $("#news-menu").show();
                setTimeout(function () {location.reload();}, 1000);
            }
            else if (data == "error_admin")
            {
                $("#edit-result").html("<p class='alert alert-danger text-center' role='alert'>Vous devez être admin pour éditer une news.</p>");
                $("#push-edit-news").prop('disabled', false);
                $("#cancel-edit-news").prop('disabled', false);
            }
            else
            {
                $("#edit-result").html("<p class='alert alert-danger text-center' role='alert'>Une erreur est survenue, contactez le webmaster.</p>");
                $("#push-edit-news").prop('disabled', false);
                $("#cancel-edit-news").prop('disabled', false);
            }
        },);
    });

    $("#cancel-edit-news").click(function(e){ e.preventDefault();
        $("#edit-news-title").prop("value", "");
        $("#edit-news-summary").prop("value", "");
        $("#edit-news-content").htmlcode("<br>");
        $("#news-editor").hide();
        $("#news-menu").show();
    });
});