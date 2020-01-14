<?php
/* variables à remplir */
$title = 'Inscription';
$metaDescription = "Procédez à votre inscription en remplissant le formulaire d'inscription.";
$ogUrl = 'https://alanbeaucheron.ovh/projet4/index.php?action=inscription';
$ogTitle = 'Inscription';
$ogDescription = "Procédez à votre inscription en remplissant le formulaire d'inscription.";
/* début de la variable $content */
ob_start();
?>

<div id="inscription-wrapper">
    <div id="inscription-form">
        <div class="container">
            <div class="row">
                <div class="col-md-6 offset-md-3 col-xl-4 offset-xl-4 mt-4 bg-light shadow">
                    <h1 class="text-center pt-3">Lancez-vous !</h1>
                    <?php if ($error) {
                        echo $error;
                    } ?>
                    <form id="form-inscription" action="index.php?action=inscription" method="post">
                        <div class="form-group mt-4">
                            <label for="mail">Adresse mail</label><br />
                            <input type="text" class="form-control" name="mail" id="mail" placeholder="Votre adresse mail" required>
                        </div>
                        <div class="form-group">
                            <label for="pseudo">Identifiant <small id="pseudodHelpBlock" class="text-muted">(doit être inférieur à 30 caractères)</small></label><br />
                            <input type="text" class="form-control" name="pseudo" id="pseudo" placeholder="Choisissez votre identifiant" aria-describedby="pseudodHelpBlock" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Mot de passe <small id="passwordHelpBlock" class="text-muted">(doit être inférieur à 30 caractères)</small></label>
                            <input type="password" class="form-control" name="password" id="password" placeholder="Créez votre mot de passe" aria-describedby="passwordHelpBlock" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Confirmez votre mot de passe</label>
                            <input type="password" class="form-control" name="confirmedPassword" id="confirmed-password" placeholder="Confirmez votre mot de passe" required>
                        </div>
                        <button type="submit" class="btn btn-info mt-4 mb-4 btn-block">Créez votre compte</button>
                    </form>
                </div>
            </div>
        </div>

    </div>

</div>


<header id="inscription-header"></header>


<?php
$content = ob_get_clean(); // fin du contenu de la variable $content

// appel du template
require('Template.php');
?>