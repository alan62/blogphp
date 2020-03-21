<?php
if (empty($_SESSION['id'])) {
    $connected = false;
} else {
    $connected = true;
}
?>

<?php
$title = 'Accueil';
$metaDescription = "Bienvenue sur le site web de Jean Forteroche, écrivain. Découvrez son nouveau roman \"Billet simple pour l'Alaska\", publié en ligne.";
$ogUrl = 'https://alanbeaucheron.ovh/projet4/';
$ogTitle = 'Bienvenue sur le site web de Jean Forteroche';
$ogDescription = "Découvrez en ligne les chapitres du nouveau roman de Jean Forteroche, \"Billet simple pour l'Alaska\".";
/* début de la variable $content */
ob_start();
?>

<header id="home-header">
    <div class="jumbotron p-4 p-md-5 text-black rounded bg-transparent">
    <div class="col-md-12">
      <h1 class="display-4 text-center"><strong>Billet simple pour l'Alaska</strong></h1>
      <p class="lead my-3 text-center"><strong>Sur ce site vous aurez la possibilité de lire le roman chapitre par chapitre tout en ayant la possibilité de me donner votre ressenti par commentaire.</strong></p>
    </div>  
  </div>
</header>

<section id="billet-section">
    <div class="container ">
        <div class="row">
            <div class="col-10 offset-1 mb-2 mt-2">
                <p class="lead text-black text-justify"><strong>Retrouvez l'ensemble des chapitres qui compose le roman "Billet simple pour l'Alaska", par ordre de publication.<br />
                    <br />
                    <u>Le résumé</u> : Deux amis décident de visiter l'Alaska. Pour lire la suite consultez les chapitres.<br />
                    <br />
                    Bonne lecture !</strong></p>
                <hr>
                <?php foreach ($articles as $article) { ?>
                    <article class="mb-2 mt-2">
                        <h3><?= $article->getTitle() ?></h3>
                        <p>Publié le <?= date_format(date_create($article->getDate_creation()), 'd/m/Y')  ?></p>
                        <div class="text-justify"><?= substr($article->getContent(), 0, 255) ?>[...]</div>
                        <hr>
                        <a href="index.php?action=view&id=<?= $article->getId() ?>" title="Lire la suite de l'article" class="btn btn-info mb-2" role="button">Lire la suite</a>
                        <?php if ($connected) { ?>
                        <a href="index.php?action=updateArticle&id=<?= $article->getId() ?>" title="Modifier l'article" class="btn btn-info mb-2" role="button"><span class="fas fa-pen"></span></a>
                        
                        <?php 
                        }
                        ?>     
                    </article>
                <?php
            }
            ?>
            </div>
        </div>
</section>

<?php
$content = ob_get_clean(); // fin du contenu de la variable $content
// appel du template
require ('Template.php');
?>