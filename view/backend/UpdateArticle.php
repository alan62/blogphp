<?php
$title = 'Modifier un article';
$metaDescription = "Votre texte a besoin d'être modifié ? En un clic, corrigez vos erreurs, rajoutez de la consistance à votre récit, puis publiez votre article corrigé.";
$ogUrl = 'https://alanbeaucheron.ovh/projet4/index.php?action=updateArticle';
$ogTitle = 'Modifier un article';
$ogDescription = "Votre texte a besoin d'être modifié ? En un clic, corrigez vos erreurs, rajoutez de la consistance à votre récit, puis publiez votre article corrigé.";
/* début de la variable $content */
ob_start();
?>

<div class="container" id="bloc-page-updateArticle">

    <h1 id="update-article-title" class="mt-3 mb-5">Modifier un article <span class="text-muted">(<?= $status ?>)</span></h1>
    <?php if ($error) {
        echo $error;
    }
    ?>
    <form id="form-article" action="index.php?action=updateArticle&id=<?= $article->getId() ?>" method="post">
        <div class="form-group">
            <label for="title">Titre <small id="pseudodHelpBlock" class="text-muted">(Privilégiez un titre court)</small></label><br />
            <input type="text" class="form-control" name="title" id="title" placeholder="Saisissez votre titre ici" aria-describedby="pseudodHelpBlock" value="<?= $article->getTitle() ?>" required /><br />
        </div>
        <div class="form-group">
            <label for="text">Texte</label><br />
            <textarea name="text" class="form-control" id="text" rows="10" placeholder="Saisissez votre texte ici" required><?= $article->getContent() ?></textarea><br />
        </div>
        <button type="submit" name="submit" class="btn btn-primary float-left float-sm-right mr-3 mb-2">Publier en ligne</button>
        <button type="submit" name="draft" class="btn btn-outline-secondary float-left float-sm-right mr-3 mb-2">Sauvegarder en brouillon</button>
    </form>
</div>

<?php
$content = ob_get_clean(); // fin du contenu de la variable $content
$script =  '
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
<script src="public/js/article.js"></script>
';
// appel du template
require('Template.php');
?>