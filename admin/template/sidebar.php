<html>
	<nav id="sidebar">
        <div class="sidebar-header">
            <h3>RUSTPHP</h3>
        </div>
        <ul class="list-unstyled components">
            <li <?php if($active_page == "news") { echo("class='active'"); } ?>>
                <a href="news.php">News</a>
            </li>
            <li <?php if($active_page == "vote") { echo("class='active'"); } ?>>
                <a href="vote.php">Vote</a>
            </li>
            <li <?php if($active_page == "social") { echo("class='active'"); } ?>>
                <a href="social.php">Social</a>
            </li>
        </ul>
    </nav>
</html>