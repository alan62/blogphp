<?php
$title = 'Jean Forteroche, écrivain facétieux';
$metaDescription = "Portrait de Jean Forteroche, romancier qui aime manier l'absurde et les personnages pittoresques.";
$ogUrl = 'https://alanbeaucheron.ovh/projet4/index.php?action=biographie';
$ogTitle = 'Jean Forteroche, écrivain facétieux';
$ogDescription = "Portrait de Jean Forteroche, romancier qui aime manier l'absurde et les personnages pittoresques.";
/* début de la variable $content */
ob_start();
?>

<header id="biographie-header">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h1 class="display-4 main-title text-center text-black d-inline-block position-relative"><strong>Jean Forteroche</strong></h1>
            </div>
        </div>
    </div>
</header>

<article id="biographie-article">
    <div class="container-fluid">
        <div class="row">
            <div class="col-5 offset-3 col-sm-4 offset-sm-2 col-md-2 offset-md-5 article-picture">
                <img src="https://alanbeaucheron.ovh/projet4/public/images/jean.png" class="img-fluid" alt="Photo de Jean Forteroche" />
            </div>
        </div>
    </div>
    <div class="container-fluid bg-white pt-5 pb-5">
        <div class="row">
            <h2 class="title-bio text-center text-black">Écrivain facétieux, saltimbanque des mots</h2>
            <div class="pt-5 pt-md-3 col-5 offset-3 col-md-6 offset-md-3 text-justify article-content text-reader">
                Il est de notoriété publique que Jean Forteroche n'aime guère parler de lui, qui plus est à la troisième personne du singulier.<br />
                Seulement, dans la mesure où la page que vous parcourez s'intitule sobrement "Biographie", nous serions bien embêtés si je décidais de ne pas honorer le contrat qui vous a précisément amené ici. J'en suis tout à fait capable, n'en doutez pas, cher lecteur avisé. Et je pourrais continuer des heures durant à deviser sur le bien-fondé de ma pudeur, ou encore sur le fameux contrat qui m'oblige à temporairement la souiller. <br />
                C'est pour cette raison que je m'adresserai à vous comme je m'adresserai à un vieil ami. On a plus grand chose à cacher à un vieil ami, si ce n'est cette part de mystère qui vous rend irrésistiblement intéressant. Car celui qui aime parler de lui suscitera très vite le désintérêt, et celui qui ne dit rien, l'ennui. Distribuer avec minutie les parcelles de son histoire, c'est bien là tout l'art de l'écrivain.<br />
                Ainsi, mon vieil ami, il ne vous a pas échappé que je suis écrivain et qu'en qualité d'écrivain, j'écris des livres, dans lesquels je transpose mon goût pour l'absurde et les personnages pittoresques. Certains appelleront cela une signature, d'autres une façon de cacher l'angoisse de la médiocrité.<br />
                Il est d'usage de citer les créations qui m'ont permis de vivre de ma plume, alors je me permettrais d'évoquer "Double meurtre à Doubleville" (1993), "L'homme qui parlait aux truites" (1997), "Le burn-out de l'épouvantail" (2008) et, plus récemment, "Billet simple pour l'Alaska", un roman dont vous pourrez suivre la progression en direct sur ce blog.<br />
                Sinon, quand je n'écris pas, j'affectionne le jardinage et l'entretien de mon portager,
                pour ses vertus apaisantes, et passer du temps avec mes enfants, pour l'exact contraire.<br />
                <br />
                Bienvenue à toi, vieil ami, et bonne lecture.<br />
                <br />
                Jean Forteroche
            </div>
        </div>
    </div>
</article>

<?php
$content = ob_get_clean(); // fin du contenu de la variable $content 
// appel du template
require('Template.php');
?>