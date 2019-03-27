<?php
class Library {
  
  public function __construct() {
    
  }
  
  public function getbrickList() {
    return $_SESSION["bdd"]->getBrickList(0);
  }
  
  public function getDeletedList() {
    return $_SESSION["bdd"]->getBrickList(1);
  }
  
  public static function AOlibrary($pageName, $message, $type) {
    if($_SESSION["user"]->getRights() < 1) {
      $pageName = "accueil";
      $message = "Tu n'as pas les droits nécessaires, connecte-toi d'abord !";
      $type = "danger";
    } elseif(!isset($_POST["action"]) || $_POST["action"]=="") {
      $pageName = "AOlibrary";
      $message = "Erreur : Les données ont été corrompues, merci de réessayer.";
      $type = "danger";
    } else {
      switch(addslashes($_POST["action"])) {
        case "add":
          list($pageName, $message, $type) = Brick::add($pageName, $message, $type);
          break;
        case "edit":
          list($pageName, $message, $type) = Brick::edit($pageName, $message, $type);
          break;
        case "update":
          list($pageName, $message, $type) = Brick::update($pageName, $message, $type);
          break;
        case "delete":
          list($pageName, $message, $type) = Brick::delete($pageName, $message, $type);
          break;
        case "restore":
          list($pageName, $message, $type) = Brick::restore($pageName, $message, $type);
          break;
        default:
          $pageName = "AOlibrary";
          $message = "Erreur : Impossible d'effectuer l'action demandée, merci de réessayer.";
          $type = "danger";
      }
    }
    return array($pageName, $message, $type);
  }
}
?>