<?php
if (empty($_SESSION['id'])) {
    $connected = false;
} else {
    $connected = true;
}
?>

<?php
/* variables à remplir */
$title = htmlspecialchars($article->getTitle());
$metaDescription = "Plongez dans l'un des chapitres du nouveau roman interactif de Jean Forteroche, intitulé \"Billet simple pour l'Alaska\" et publié en ligne.";
$ogUrl = 'https://alan.beaucheron.ovh/projet4/index.php?action=view$id=' . $article->getId();
$ogTitle = htmlspecialchars($article->getTitle()) .  " | Le site officiel de Jean Forteroche";
$ogDescription = "Plongez dans l'un des chapitres du nouveau roman interactif de Jean Forteroche, intitulé \"Billet simple pour l'Alaska\" et publié en ligne.";
/* début de la variable $content */
ob_start();
?>

<header id="view-header">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h1 class="display-4 main-title text-center text-black d-inline-block position-relative"><strong>Billet simple pour l'Alaska</strong></h1>
            </div>
        </div>
    </div>
</header>

<article id="view-article">
    <div class="container-fluid bg-white">
        <div class="row">
            <div class="col-10 offset-1 mb-5 mt-5 article-content">
                <h2 class="text-center text-black text-break"><?= $article->getTitle() ?></h2>
                <div class="text-justify mb-5">Publié le <?= $article->getDate_creation() ?></div>
                <div class="text-justify article-text text-reader"><?= $article->getContent() ?></div>
            </div>
        </div>
    </div>
</article>

<section id="comments">
    <div class="container bg-dark">
        <div class="row">
            <div class="col-lg-10 offset-lg-1 mb-5 mt-5">
                <h5 class="text-center mt-4 mb-5 text-white">Commentaires</h5>
                <?php if (empty($comments)) { ?><p class="text-center text-black">Pas de commentaires à afficher. Laissez le vôtre !</p><?php } ?>
                <?php
                $CommentEven = false;
                foreach ($comments as $comment) {
                    $CommentEven = !$CommentEven;
                    $cssClass = $comment->getReport() > 0 ? "reported " : "";
                    $cssClass .= $CommentEven ? "bg-comment" : ""; ?>
                    <div class="comment <?= $cssClass ?>">
                        <div class="row">
                            <div class="col-md-4">
                                <p id="comment<?= $comment->getId() ?>" class="mt-3 mr-3"><span class="pseudo-comment"><?= $comment->getPseudo() ?></span><br /><small class="text-muted">Publié le <?= date_format(date_create($comment->getDate_comment()), 'd/m/Y à H:i:s') ?></small></p>
                            </div>
                            <div class="col-md-8">
                                <p class="comment-content mt-3 ml-3 mr-3"> <?= $comment->getComment() ?> </p>
                            </div>
                            <div class="col-md-2 mt-1"><a href="index.php?action=view&comment=<?= $comment->getId() ?>&article=<?= $comment->getId_article() ?>&event=report" class="btnreport btn-danger btn-sm mr-5<?php if ($comment->getReport() > 0) { ?> disabled" aria-disabled="true" <?php } ?> role="button"><?php if ($comment->getReport() > 0) { ?> Signalé <?php } else { ?> Signaler <?php } ?></a></div>
                            <?php if ($connected) { ?>
                                <div class="col-md-2 mt-1"><a href="index.php?action=admin&comment=<?= $comment->getId() ?>&event=delete&article_id=<?= $article->getId() ?>" class="btndelete btn-danger">Supprimer</a></div>
                            <?php } ?>
                        </div>

                    </div>
                <?php
                } ?>
            </div>
        </div>
    </div>
</section>

<section id="comment-form">
    <div class="container bg-dark">
        <div class="row">
            <div class="col-lg-10 offset-lg-1 mb-5 mt-5">
                <h5 class="text-center mt-4 mb-5 text-white">Laissez un commentaire</h5>
                <form id="form-com" action="index.php?action=view&id=<?= $article->getId() ?>" method="post">
                    <div class="form-group">
                        <label for="form-pseudo" class="text-white">Votre pseudo <span>(moins de 255 caractères)</span></label>
                        <input type="text" class="form-control" name="form-pseudo" id="form-pseudo" placeholder="Pseudo" required>
                    </div>
                    <div class="form-group">
                        <label for="form-comment" class="text-white mt-2">Votre commentaire</label>
                        <textarea class="form-control" name="form-comment" id="form-comment" rows="3" placeholder="Commentaire" required></textarea>
                    </div>
                    <div class="col-lg-12 text-center">
                        <button type="submit" class="btn btn-info mt-4 px-4">Envoyer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<?php
$content = ob_get_clean(); // fin du contenu de la variable $content

// appel du template
require('Template.php');
?>