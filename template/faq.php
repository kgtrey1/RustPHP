<?php
	try
	{
		$db = new PDO($db_host, $db_user, $db_pass);
	}
	catch (Exception $e)
	{
    die('Erreur : ' . $e->getMessage());
  }
	$query = $db->prepare('SELECT * FROM rp_faq ORDER BY id asc');
	$query->execute();
?>

<!DOCTYPE html>
<html>
  <head>
  </head>
  <body>
    <div class="container-fluid">
      <div class="container" style="background-color: #fff; padding-top:3%; padding-bottom: 6%;">
        <div class="row">

<div class="col-md-12">
<center>
  <div style="line-height: 60%; padding-top: 3%;">
    <h1>
    <center>  Besoin d'aide? </center>
  </h1>
        <p><b>Bienvenue au centre d'aide de <?php echo($server_name); ?>.</b> Ici tu pourras chercher une réponse à tes question.</p>
        <p>Si votre question concerne les règles ou que vous avez besoin d'aide:</p>
      </div>
     <button type="button" class="btn btn-info">Voir les règles</button>
        <button type="button" class="btn btn-danger">Contacter le support</button> </center>

    </div>

      </div>

      <Br> <br>
  			<div class="row">
          <div class="col-md-12">
            <div class="panel-group faq" id="accordion" role="tablist" aria-multiselectable="true">
              <?php
                $it = 1;
                while($result = $query->fetch())
                {
                  $id = "collapse" . $it;
              ?>
                <div class="panel panel-default">
                  <div class="panel-heading" role="tab">
                    <h4 class="panel-title">
                      <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="<?php echo("#" . $id); ?>" aria-expanded="true" aria-controls="<?php echo($id); ?>">
                        <?php echo($result['title']); ?>
                      </a>
                    </h4>
                  </div>
                  <div id="<?php echo($id); ?>" class="panel-collapse collapse" role="tabpanel">
                    <div class="panel-body">
                      <p> <?php echo($result['content']); ?> </p>
                    </div>
                  </div>
                </div>
              <?php
                  $it = $it + 1;
                }
                $query->closeCursor();
              ?>
            </div>
          </div>
        </div>
  		</div>

    </div>
  </body>
</html>
