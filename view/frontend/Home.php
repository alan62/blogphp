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
    <div class="jumbotron p-4 p-md-5 text-white rounded bg-info">
    <div class="col-md-12">
      <h1 class="display-4 font-italic text-center">Un billet pour Alaska</h1>
      <p class="lead my-3 text-center">Sur ce site vous aurez la possibilité de lire le roman chapitre par chapitre tout en ayant la possibilité de me donner votre ressenti par commentaire ou via le formulaire de contact.</p>
    </div>
  </div>
</header>

<section id="home-project-alaska">
    <div class="row mb-2">
    <div class="col-md-4 offset-1">
        <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
            <p class="lead text-justify">Retrouvez l'ensemble des chapitres qui compose le roman "Billet simple pour l'Alaska", par ordre de publication.<br />
                <br />
                <u>Le résumé</u> : Deux amis décident de visiter l'Alaska. Si vous souhaitez en savoir plus je vous invite à lire les chapitres.<br />
                <br />
                Bonne lecture !</p>
            <hr>
            <?php foreach ($articles as $article) { ?>
                <article class="mb-5 mt-5">
                    <h3><?= $article->getTitle() ?></h3>
                    <p>Publié le <?= date_format(date_create($article->getDate()), 'd/m/Y')  ?></p>
                    <div class="text-justify"><?= substr($article->getContent(), 0, 250) ?>[...]</div>
                    <a href="index.php?action=view&id=<?= $article->getId() ?>" title="Lire la suite de l'article" class="btn btn-info mb-2" role="button">Lire la suite</a>
                    <hr>
                </article>
            <p class="card-text mb-auto">Chaque chapitre du roman sera publié en ligne.</p>
        </div>
        <div class="col d-none d-lg-block">
            <img class="img1 rounded-circle" src="http://alanbeaucheron.ovh/projet4/public/images/roman-en-ligne.jpg" alt="romanenligne">
         <?php
            }
            ?>
        </div>
        </div>
    </div>
    <div class="col-md-4 offset-2">
        <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
            <div class="col p-4 d-flex flex-column position-static">
            <h3 class="mb-0">Intéraction</h3>
            <p class="mb-auto">Vous aurez la possibilité de commenter chaque chapitre pour donner votre point de vue sur le déroulement de l'histoire, des personnages...</p>
        </div>
        <div class="col-auto d-none d-lg-block">
            <img class="img2 rounded-circle" src="http://alanbeaucheron.ovh/projet4/public/images/roman-interactif.jpg" alt="romaninteractif">       
            </div>
        </div>
    </div>
  </div>
</section>

<?php
$content = ob_get_clean(); // fin du contenu de la variable $content
// appel du template
require 'Template.php';
?>