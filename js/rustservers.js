$(document).ready(function(){
    $("#rustservers-query").click(function(e){
        e.preventDefault();
        $("#rustservers-query").prop('disabled', true);
        $("#rustservers-query").prop('value', 'Chargement..');
        $.post(
            'script/vote.php',
            {
                query : "rustservers"
            },
            function(data){

                if (data == "error")
                {
                     $("#rustservers-result").html("<p class='alert alert-danger' role='alert'>Impossible de contacter l'API.</p>");
                     $("#rustservers-query").prop('value', "Vérifier mon vote");
                }
                else if (data == -42)
                {
                    $("#rustservers-result").html("<p class='alert alert-danger text-center' role='alert'>Le serveur est hors-ligne, réessayez plus tard.</p>");
                    $("#rustservers-query").prop('value', 'Vérifier mon vote');
                }
                else if (data == 0)
                {
                    $("#rustservers-result").html("<p class='alert alert-danger' role='alert' style='text-align: center;'>Vous n'avez pas voté.</p>");
                    $("#rustservers-query").prop('disabled', false);
                    $("#rustservers-query").prop('value', 'Vérifier mon vote');
                }
                else if (data == 1)
                {
                    $("#rustservers-result").html("<p class='alert alert-success' role='alert'>Vous pouvez réclamer votre récompense.</p>");
                    $("#rustservers-claim").prop('disabled', false);
                    $("#rustservers-query").prop('value', "J'ai voté");
                }
                else if (data == 2)
                {
                    $("#rustservers-result").html("<p class='alert alert-success' role='alert'>Vous avez déjà voté et réclamé votre récompense.</p>");
                    $("#rustservers-query").prop('value', "J'ai voté");
                }
            },
         );
    });
});