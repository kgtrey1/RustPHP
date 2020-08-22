<html>
	<div class="col-lg-6 d-flex">
		<div class="element-container">
			<h3>Modifier une news</h3>
			<div id="edit-result"></div>
			<div id="news-menu">
				<div class="form-group">
					<label for="news-selecter">Selectionner une news:</label>
					<select class="form-control" id="news-selecter">
                        <?php
                            $news = new News_manager();
                            $list = $news->get_all_news_title();
                            $it = 0;
                            while ($list[$it]['title'] != NULL)
                            {
                                echo ("<option>" . htmlspecialchars($list[$it]['title']) . "</option>");
                                $it = $it + 1;
                            }
                        ?>
                    </select>
                </div>
                <button type="button" id="edit-news" class="btn btn-success">Modifier</button>
                <button type="button" id="delete-news" class="btn btn-danger">Supprimer la news</button>
            </div>
            <div id="news-editor">
            	<input type="text" class="form-control" id="edit-news-id" value="" hidden>
                <div class="form-group">
                    <label for="edit-news-title">Titre :</label>
                    <input type="text" class="form-control" id="edit-news-title">
                </div>
                <div class="form-group">
                    <label for="edit-news-summary">Résumé :</label>
                    <input type="text" class="form-control" id="edit-news-summary">
                </div>
                <div class="form-group">
                    <label for="edit-news-content" >Contenu :</small></label>
                    <textarea id="edit-news-content"></textarea>
                    <p hidden>A chaque retour à la ligne, veuillez écrire [br]. Cette incompatibilité sera supprimée dans les versions futures.</p>
                </div>
                <button type="button" id="cancel-edit-news" class="btn btn-danger">Annuler</button>
                <button type="button" id="push-edit-news" class="btn btn-success">Mettre à jour</button><br><br>
            </div>
        </div>
    </div>
</html>