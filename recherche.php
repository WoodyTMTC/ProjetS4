<?php declare(strict_types = 1);
require_once "autoload.php";
$authentication = new SecureUserAuthentication();
if (!$authentication->isUserConnected()) {
	http_response_code(401);
    header("Location: connexion.php");
    die();
}

$authentication = new SecureUserAuthentication();
$user = $authentication->getUser();
$idUser = $user->getIdUser();
$firstName = $user->getFirstName();
$lastName = $user->getLastName();
$header = SportUtilities::getHeaderPage($user);

//Création de la page
$page = new WebPage("Recherche");
$page->appendJsUrl("https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js");
$page->appendJsUrl("js/ajaxrequest.js");
$page->appendCssUrl("css/main.css");
$page->appendCssUrl("css/recherche.css");
$page->appendToHead(<<<HTML
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
HTML);

$page->appendContent(<<<HTML

$header

<div id="ensemble" class="d-flex flex-row p-2">
    <div class="d-flex flex-column p-2 mx-auto h-100 align-self-center">
        <div>
        <form method="POST" class="justify-content-center align-items-center" id="rechercheVille" name="rechercheVille" action="recherche.php" style="display: initial; z-index:1;">
            <label class="mx-3 align-self-center">
                <input name="rechercher" method="POST" type="text" id="rechercher" placeholder="Rechercher par ville" style="width: 324px; height: 30px;">
            </label>
        </div>
        <div>
            Personnes
        </div>
    </div>
</div>

HTML);

echo $page->toHTML();