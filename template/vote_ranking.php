<?php
	require ($_SERVER["DOCUMENT_ROOT"] . "/class/vote_ranking.class.php");

	$ranking = new vote_ranking();
	$list = $ranking->get_leaderboard();
?>

<html>
    <section id="vote-ranking">
	   <div class = "container vote-ranking-container d-flex justify-content-center">
	       <div class = "vote-ranking-table-container">
                <h3 class="vote-ranking-title">Meilleurs voteurs</h3>
                <table class ="table table-striped vote-ranking-table" align="center">
                    <tbody>
    				    <?php
    					   $it = 1;
    					   while ($list[$it][0] != NULL)
    					   {
    						  if ($list[$it + 1][0] != NULL)
    						  {
    							echo("<tr class='vote-ranking-row'>");
    							if ($it == 1)
            						echo "<td>#" . $it . " <i class='fas fa-trophy' style='color: orange;'></i></td>";
            					else if ($it == 2)
            						echo "<td>#" . $it . " <i class='fas fa-trophy' style='color: grey;'></i></td>";
            					else if ($it == 3)
            						echo "<td>#" . $it . " <i class='fas fa-trophy' style='color: peru;'></i></td>";
            					else
            						echo "<td>#" . $it . "</td>";
            					echo("<td class='text-muted'>" . $list[$it][0] . "</td>
            					     <td>" . $list[$it][1] . "</td>
        							 </tr>");
    						  }
    						  else
    						  {
    						  	echo("<tr class='vote-ranking-end-row'>");
    						  	if ($it == 1)
            						echo "<td>#" . $it . " <i class='fas fa-trophy' style='color: orange;'></i></td>";
            					else if ($it == 2)
            						echo "<td>#" . $it . " <i class='fas fa-trophy' style='color: grey;'></i></td>";
            					else if ($it == 3)
            						echo "<td>#" . $it . " <i class='fas fa-trophy' style='color: peru;'></i></td>";
            					else
            						echo "<td>#" . $it . "</td>";
            					echo("<td class='text-muted'>" . $list[$it][0] . "</td>
            						<td>" . $list[$it][1] . "</td>
        							</tr>");
    						  }
    						  $it = $it + 1;
        				    }
        			 ?>
    			     </tbody>
                </table>
		      </div>
	   </div>
    </section>
</html>