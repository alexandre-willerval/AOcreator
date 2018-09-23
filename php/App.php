<?php
class App {
  public function __construct() {
    include "conf.php";
    $_SESSION["bdd"] = new Bdd($DB_CONF);
    $_SESSION["user"] = new User();
    $_SESSION["frameworks"] = $FRAMEWORKS;
  }
  
  public function createPage() {
    $pageName = "accueil";
    $message = "";
    $type = "";
    list($pageName, $message, $type) = $this->processPage($pageName, $message, $type);
    list($pageName, $message, $type) = $this->processAction($pageName, $message, $type);
    $_SESSION["page"] = new Page($pageName, $message, $type);
  }
  
  protected function processPage($pageName, $message, $type) {
    
    //check if the requested page exists
    if(isset($_GET["page"])) {
      $pageName = addslashes($_GET["page"]);
      $pageList = $_SESSION["bdd"]->getPageList();
      if(!in_array($pageName, $pageList)) {
        $pageName = "accueil";
        $message = "La page demandée n'existe pas.";
        $type = "danger";
      }
    }
    
    //check if the user has the rights to see the requested page
    if($_SESSION["user"]->getRights() < $_SESSION["bdd"]->getPageDisplay($pageName)) {
      $pageName = "connexion";
      if(isset($_GET["page"]) && $message == "") {
        $message = "Tu n'as pas les droits nécessaires pour accéder à la page demandée. Merci de te connecter.";
      }
      $type = "danger";
    }
    
    //return values
    return array($pageName, $message, $type);
  }
  
  protected function processAction($pageName, $message, $type) {
    
    //check if there is an action to process, and if so calls the appropriate function
    if(isset($_GET["action"])) {
      switch($_GET["action"]) {
        case "connexion":
          list($pageName, $message, $type) = Login::connexion($pageName, $message, $type);
          break;
        case "deconnexion":
          list($pageName, $message, $type) = Login::deconnexion($pageName, $message, $type);
          break;
        case "AOadmin":
          list($pageName, $message, $type) = Helper::AOadmin($pageName, $message, $type);
          break;
        case "AOlibrary":
          list($pageName, $message, $type) = Brick::AOlibrary($pageName, $message, $type);
          break;
        case "AOhistory":
          list($pageName, $message, $type) = Helper::AOhistory($pageName, $message, $type);
          break;
        case "AOcreator":
          list($pageName, $message, $type) = Proposal::AOcreator($pageName, $message, $type);
          break;
        default:
          $message = '<span class="glyphicon glyphicon-warning-sign" aria-hidden="true"></span> Action invalide !';
          $type = "danger";
      }
    }
    
    //return values
    return array($pageName, $message, $type);
  }
}
?>