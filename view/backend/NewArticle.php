<?php
$title = 'Ajouter un nouvel article';
$metaDescription = "Mettez en valeur votre texte et vos idées grâce aux nombreux outils et publiez votre nouvel article.";
$ogUrl = 'https://alanbeaucheron.ovh/projet4/index.php?action=newArticle';
$ogTitle = 'Ajouter un nouvel article';
$ogDescription = "Mettez en valeur votre texte et vos idées grâce aux nombreux outils et publiez votre nouvel article.";
/* début de la variable $content */
ob_start();
?>

<div class="container" id="bloc-page-newArticle">

    <h1 id="new-article-title" class="mt-3 mb-5">Ajouter un nouvel article</h1>
    <?php if ($error) {
        echo $error;
    }
    ?>
    <form id="form-article" action="index.php?action=newArticle" method="post">
        <div class="form-group">
            <label for="title">Titre <small id="pseudodHelpBlock" class="text-muted">(Privilégiez un titre court)</small></label><br />
            <input type="text" class="form-control" name="title" id="title" placeholder="Saisissez votre titre ici" aria-describedby="pseudodHelpBlock" required /><br />
        </div>
        <div class="form-group">
            <label for="text">Texte</label><br />
            <textarea name="text" class="form-control" id="text" rows="08" placeholder="Saisissez votre texte ici" required></textarea><br />
        </div>
        <button type="submit" name="submit" class="btn btn-info float-left float-sm-right mr-3 mb-2">Publier en ligne</button>
        <button type="submit" name="draft" class="btn btn-outline-secondary float-left float-sm-right mr-3 mb-2">Sauvegarder en brouillon</button>
    </form>
</div>

<?php
$content = ob_get_clean(); // fin du contenu de la variable $content

$script = '<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>';
// appel du template
require('Template.php');
?>