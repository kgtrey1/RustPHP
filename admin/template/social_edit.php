<?php
    $data = new Social_manager();
    $discord = $data->get_social('1');
    $steam = $data->get_social('2');
    $rust = $data->get_social('3');
?>

<html>
    <div class="col-lg-4 d-flex">
        <div class="element-container">        
            <h3>Discord</h3>
            <div id="discord-result"></div>
            <div class="form-group">
                <label for="discord-link">Lien :</label>
                <input type="text" class="form-control" id="discord-link" value="<?php echo($discord['link']); ?>">
            </div>
            <div class="form-group">
                <label for="rustservers-link">Description :</label>
                <textarea class="form-control" id="discord-content"><?php echo($discord['content']); ?></textarea>
            </div>
            <input type="button" id="edit-discord" class="btn btn-success float-lg-right" value="Modifier">
        </div>
    </div>
    <div class="col-lg-4 d-flex">
        <div class="element-container">        
            <h3>Steam</h3>
            <div id="steam-result"></div>
            <div class="form-group">
                <label for="steam-link">Lien :</label>
                <input type="text" class="form-control" id="steam-link" value="<?php echo($steam['link']); ?>">
            </div>
            <div class="form-group">
                <label for="steam-content">Description :</label>
                <textarea class="form-control" id="steam-content"><?php echo($steam['content']); ?></textarea>
            </div>
            <input type="button" id="edit-steam" class="btn btn-success float-lg-right" value="Modifier">
        </div>
    </div>
    <div class="col-lg-4 d-flex">
        <div class="element-container">        
            <h3>Rust</h3>
            <div id="rust-result"></div>
            <div class="form-group">
                <label for="rust-link">Lien :</label>
                <input type="text" class="form-control" id="rust-link" value="<?php echo($rust['link']); ?>">
            </div>
            <div class="form-group">
                <label for="rust-content">Description :</label>
                <textarea class="form-control" id="rust-content"><?php echo($rust['content']); ?></textarea>
            </div>
            <input type="button" id="edit-rust" class="btn btn-success float-lg-right" value="Publier une news">
        </div>
    </div>
</html>