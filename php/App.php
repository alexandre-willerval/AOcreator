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
    $this->logActivity($pageName, $message, $type);
    return new Page($pageName, $message, $type);
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
        $type = "danger";
      }
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
          list($pageName, $message, $type) = Admin::AOadmin($pageName, $message, $type);
          break;
        case "AOlibrary":
          list($pageName, $message, $type) = Library::AOlibrary($pageName, $message, $type);
          break;
        case "AOhistory":
          list($pageName, $message, $type) = History::AOhistory($pageName, $message, $type);
          break;
        case "AOcreator_step1":
          list($pageName, $message, $type) = Proposal::AOcreator_step1($pageName, $message, $type);
          break;
        case "AOcreator_step2":
          list($pageName, $message, $type) = Proposal::AOcreator_step2($pageName, $message, $type);
          break;
        default:
          $message = 'Erreur : Action invalide !';
          $type = "danger";
      }
    }
    
    //return values
    return array($pageName, $message, $type);
  }
  
  function logActivity($pageName, $message, $type) {
    $log['user'] = $_SESSION["user"]->getEmail();
    if(isset($_GET["page"])) {
      $log['getPage'] = addslashes($_GET["page"]);
    } else {
      $log['getPage'] = '-';
    }
    if(isset($_GET["action"])) {
      $log['getAction'] = addslashes($_GET["action"]);
    } else {
      $log['getAction'] = '-';
    }
    $log['pageName'] = $pageName;
    $log['message'] = $message;
    $log['type'] = $type;
    $_SESSION["bdd"]->addLog($log);
  }
}
?>