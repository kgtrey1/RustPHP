<?php
	require_once($_SERVER["DOCUMENT_ROOT"] . "/class/news.class.php");
    $data = new News_manager();
    $news = $data->get_latests_news();
    $news[1]['content'] = $data->news_to_html($news[1]['content']);
    $news[2]['content'] = $data->news_to_html($news[2]['content']);
?>

<html>
    <div class="container-fluid" id="news">
		<div class ="container news">
   			<h2 class="news-title"> Latest news : </h2>
			<div class="row">	
                <div class="col-sm-6">
    				<div class="card">
      					<div class="card-body">
        					<h5 class="card-title"><?php echo($news[1]['title']); ?></h5>
        					<p class="card-text"><?php echo($news[1]['summary']); ?></p>
							<button type="button" class="btn btn-dark" data-toggle="modal" data-target="#news-1">Lire</button>
                            <div class="modal fade" id="news-1" tabindex="-1" role="dialog">
  								<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    								<div class="modal-content">
      									<div class="modal-header">
        									<h5 class="modal-title"><?php echo($news[1]['title']); ?></h5>
        									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      									</div>
      									<div class="modal-body">
      										<p class="news-title-left"><?php echo('Posté par ' . $news[1]['author'] . ' le ' . $news[1]['date']); ?></p>
        									<?php echo($news[1]['content']); ?>
      									</div>
     				 					<div class="modal-footer">
        									<button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
										</div>
									</div>
  								</div>
							</div>
							<p class="news-date"><?php echo('Posté le ' . $news[1]['date'] . ' par ' . $news[1]['author']); ?></p>
      					</div>
    				</div>
  				</div>	
                <div class="col-sm-6">
    				<div class="card">
      					<div class="card-body">
        					<h5 class="card-title"><?php echo($news[2]['title']); ?></h5>
        					<p class="card-text"><?php echo($news[2]['summary']); ?></p>
							<button type="button" class="btn btn-dark" data-toggle="modal" data-target="#news-2">Lire</button>
                            <div class="modal fade" id="news-2" tabindex="-1" role="dialog">
  								<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    								<div class="modal-content">
      									<div class="modal-header">
        									<h5 class="modal-title"><?php echo($news[2]['title']); ?></h5>
        									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
     									</div>
      									<div class="modal-body">
      										<p class="news-title-left"><?php echo('Posté par ' . $news[2]['author'] . ' le ' . $news[2]['date']); ?></p>
        									<?php echo($news[2]['content']); ?>
      									</div>
      									<div class="modal-footer">
        									<button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
										</div>
    								</div>
  								</div>
							</div>
        					<p class="news-date"><?php echo('Posté le ' . $news[2]['date'] . ' par ' . $news[2]['author']); ?></p>
      					</div>
    				</div>
  				</div>
			</div>
		</div>
	</div>
</html>