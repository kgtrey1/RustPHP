<?php
    require_once($_SERVER["DOCUMENT_ROOT"] . "/class/vote_plugin.class.php");

  $rustservers = new Vote_plugin("rustservers");
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css">
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/popper.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
</head>
<body>
    <div class="wrapper">
    <!-- Sidebar -->
    <nav id="sidebar">
        <div class="sidebar-header">
            <h3>RUSTPHP</h3>
        </div>

        <ul class="list-unstyled components">
            <li class="active">
                <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Home</a>
                <ul class="collapse list-unstyled" id="homeSubmenu">
                    <li>
                        <a href="#">Home 1</a>
                    </li>
                    <li>
                        <a href="#">Home 2</a>
                    </li>
                    <li>
                        <a href="#">Home 3</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#">About</a>
            </li>
            <li>
                <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Pages</a>
                <ul class="collapse list-unstyled" id="pageSubmenu">
                    <li>
                        <a href="#">Page 1</a>
                    </li>
                    <li>
                        <a href="#">Page 2</a>
                    </li>
                    <li>
                        <a href="#">Page 3</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#">Portfolio</a>
            </li>
            <li>
                <a href="#">Contact</a>
            </li>
        </ul>

    </nav>
    <!-- Page Content -->

        <div class="container-fluid" style="border: 1px solid red;">

                <div class = "row">
                    <div class="col-lg-6" style="border:1px solid green">
                        <div id="rustservers-result"></div>
                        Configuration de rust-servers:<br><br><br>

                        <div class="form-group">
                            <label for="rustservers-link">Lien :</label>
                            <input type="text" class="form-control" id="rustservers-link" value="<?php echo $rustservers->link(); ?>">
                        </div>

                        <div class="form-group">
                            <label for="rustservers-link">Récompense :</label>
                            <input type="text" class="form-control" id="rustservers-reward" value="<?php echo $rustservers->reward(); ?>">
                        </div>

                        <div class="form-group">
                            <label for="rustservers-link">Commande :</small></label>
                            <input type="text" class="form-control" id="rustservers-command" value="<?php echo $rustservers->command(); ?>">
                        </div>

                        <p>
                            Remplacez le nom de l'utilisateur par |username| afin de donner la récompense au votant. Exemple: inventory.giveto |playername| rifle.ak 1 pour donner un AK47 au votant.
                        </p>


                        <div class="form-group">
                            <label for="rustservers-link">Clé API :</small></label>
                            <input type="text" class="form-control" id="rustservers-sitekey" value="<?php echo $rustservers->site_key(); ?>">
                        </div>


                        <div class="form-group">
                            <label for="rustservers-link">Description :</small></label>
                            <textarea class="form-control" id="rustservers-desc"> <?php echo $rustservers->desc(); ?> </textarea>
                        </div>
                            <button type="button" id="rustservers-update" class="btn btn-success">Mettre à jour</button>
                            <br>
                            <br>
                    </div>
                </div>

    </div>

</div>

</body>
</html>
<script type="text/javascript">
$(document).ready(function(){
    $("#rustservers-update").click(function(e){
        e.preventDefault();
        
        $.post(
            'script/update_rustservers.php',
            {
                query : "rustservers",
                link : $("#rustservers-link").val(),
                reward : $("#rustservers-reward").val(),
                command : $("#rustservers-command").val(),
                site_key : $("#rustservers-sitekey").val(),
                desc : $("#rustservers-desc").val()
            },
            function(data){

                if (data == "error")
                {
                     $("#rustservers-result").html("<p class='alert alert-danger' role='alert'>Impossible de contacter l'API.</p>");
                     $("#rustservers-query").prop('value', "VÃ©rifier mon vote");
                }
                else
                {

                    $("#rustservers-result").html("<p class='alert alert-danger' role='alert'>"+ data +"</p>");
                }
            },
         );
    });
});
</script>