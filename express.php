<?php
require "php/Doc.php";
require "php/Bdd.php";

if(!isset($_SERVER['HTTP_REFERER']) || $_SERVER['HTTP_REFERER'] != "http://84.39.45.145/AOcreator/index.php?page=AOexpress") {
  echo "Erreur : Tu n'as pas les droits nécessaires, connecte-toi d'abord !";
} else {
  if(!isset($_POST["username"])) {
    echo "Erreur : Les données ont été corrompues. Merci de réessayer.";
  } else {
    $isDocEmpty = true;
    $username =  addslashes($_POST["username"]);
    $doc = new Doc($username);
    $bdd = new Bdd();
    $brickList = $bdd->getBrickList();
    foreach($brickList as $brick) {
      if(isset($_POST[$brick["id"]]) && $_POST[$brick["id"]] == "on") {
        $isDocEmpty = false;
        $doc->merge($brick["file"]);
      }
    }
    if($isDocEmpty) {
      echo "Erreur : Tu dois sélectionner au moins une brique !";
    } else {
      $doc->output("AOexpress.docx");
    }
  }
}
?>