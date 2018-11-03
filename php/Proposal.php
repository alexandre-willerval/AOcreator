<?php
class Proposal {
  protected $id, $title, $clientName, $consultantName, $products, $user, $firstCreated, $lastModified, $file, $step;
  
  public function __construct($id) {
    if($id==0) {
      $this->id = NULL; 
      $this->title = "";
      $this->clientName = "";
      $this->consultantName = "";
      $this->products = "";
      $this->user = $_SESSION["user"]->getEmail();
      $this->firstCreated = NULL;
      $this->lastModified = NULL;
      $this->file = NULL;
      $this->step = 1;
    } else {
      $proposal = $_SESSION["bdd"]->getProposal($id);
      $this->id = $proposal["id"];
      $this->title = stripslashes($proposal["title"]);
      $this->clientName = stripslashes($proposal["clientName"]);
      $this->consultantName = stripslashes($proposal["consultantName"]);
      $this->products = stripslashes($proposal["products"]);
      $this->user = $proposal["user"];
      $this->firstCreated = $proposal["firstCreated"];
      $this->lastModified = $proposal["lastModified"];
      $this->file = $proposal["file"];
      $this->step = $proposal["step"];
    }
  }
  
  protected function toArray() {
    foreach($this as $key => $value) {
      $result[$key] = $value;
    }
    return $result;
  }
  
  public function getTitle() {
    return $this->title;
  }
  
  public function getClientName() {
    return $this->clientName;
  }
  
  public function getConsultantName() {
    return $this->consultantName;
  }
  
  public function getProducts() {
    return $this->products;
  }
  
  public function getStep() {
    return $this->step;
  }
  
  public static function AOcreator_step1($pageName, $message, $type) {
    if($_SESSION["user"]->getRights() < 1) {
      $pageName = "accueil";
      $message = "Tu n'as pas les droits nécessaires, connecte-toi d'abord !";
      $type = "danger";
    } elseif(!isset($_POST["action1"]) || $_POST["action1"]=="") {
      $pageName = "AOcreator";
      $message = "Erreur : Les données ont été corrompues, merci de réessayer.";
      $type = "danger";
    } else {
      switch($_POST["action1"]) {
        case "create1":
          list($pageName, $message, $type) = $_SESSION["proposal"]->create($pageName, $message, $type);
          break;
        case "save1":
          list($pageName, $message, $type) = $_SESSION["proposal"]->save($pageName, $message, $type);
          break;
        case "reset1":
          list($pageName, $message, $type) = Proposal::reset($pageName, $message, $type);
          break;
        default:
          $pageName = "AOcreator";
          $message = "Erreur : Impossible d'effectuer l'action demandée, merci de réessayer.";
          $type = "danger";
      }
    }
    return Array($pageName, $message, $type);
  }
  
  public static function AOcreator_step2($pageName, $message, $type) {
    if($_SESSION["user"]->getRights() < 1) {
      $pageName = "accueil";
      $message = "Tu n'as pas les droits nécessaires, connecte-toi d'abord !";
      $type = "danger";
    } elseif(!isset($_POST["action2"]) || $_POST["action2"]=="") {
      $pageName = "AOcreator";
      $message = "Erreur : Les données ont été corrompues, merci de réessayer.";
      $type = "danger";
    } else {
      switch($_POST["action2"]) {
        case "create2":
          list($pageName, $message, $type) = $_SESSION["proposal"]->step3($pageName, $message, $type);
          break;
        case "save2":
          list($pageName, $message, $type) = $_SESSION["proposal"]->step3($pageName, $message, $type);
          break;
        case "reset2":
          list($pageName, $message, $type) = Proposal::reset($pageName, $message, $type);
          break;
        default:
          $pageName = "AOcreator";
          $message = "Erreur : Impossible d'effectuer l'action demandée, merci de réessayer.";
          $type = "danger";
      }
    }
    return Array($pageName, $message, $type);
  }
  
  protected function create($pageName, $message, $type) {
    if(!isset($_POST["title"]) || $_POST["title"]=="" || !isset($_POST["clientName"]) || $_POST["clientName"]=="") {
      $pageName = "AOcreator";
      $message = "Erreur : Saisis au moins un titre et un client !";
      $type = "danger";
    } else {
      $this->title = addslashes($_POST["title"]);
      $this->clientName = addslashes($_POST["clientName"]);
      $this->consultantName = addslashes($_POST["consultantName"]);
      $this->products = addslashes($_POST["products"]);
      $this->firstCreated = date("Y-m-d H:i:s");
      $this->step = 2;
      $this->id = $_SESSION["bdd"]->addProposal($this->toArray());
      $pageName = "AOcreator";
      $message = "";
      $type = "success";
    }
    return Array($pageName, $message, $type);
  }
  
  protected function save($pageName, $message, $type) {
    if(!isset($_POST["title"]) || $_POST["title"]=="" || !isset($_POST["clientName"]) || $_POST["clientName"]=="") {
      $pageName = "AOcreator";
      $message = "Erreur : Saisis au moins un titre et un client !";
      $type = "danger";
    } else {
      $this->title = addslashes($_POST["title"]);
      $this->clientName = addslashes($_POST["clientName"]);
      $this->consultantName = addslashes($_POST["consultantName"]);
      $this->products = addslashes($_POST["products"]);
      $this->lastModified = date("Y-m-d H:i:s");
      $_SESSION["bdd"]->updateProposal($this->toArray());
      $pageName = "AOcreator";
      $message = "Appel d'offre correctement sauvegardé.";
      $type = "success";
    }
    return Array($pageName, $message, $type);
  }
  
  protected function step3($pageName, $message, $type) {
    $this->step = 3;
    $this->lastModified = date("Y-m-d H:i:s");
    $_SESSION["bdd"]->updateProposal($this->toArray());
    $pageName = "AOcreator";
    $message = "";
    $type = "success";
    return Array($pageName, $message, $type);
  }
  
  protected static function reset($pageName, $message, $type) {
    unset($_SESSION["proposal"]);
    $pageName = "AOcreator";
    $message = "";
    $type = "success";
    return Array($pageName, $message, $type);
  }
}
?>