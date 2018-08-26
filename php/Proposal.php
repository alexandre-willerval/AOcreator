<?php
class Proposal {
  protected $id, $title, $clientName, $user, $firstCreated, $lastModified, $file, $step;
  
  public function __construct($id) {
    if($id==0) {
      $this->id = NULL; //$_SESSION["bdd"]->getProposalId();
      $this->title = "";
      $this->clientName = "";
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
  
  public function getStep() {
    return $this->step;
  }
  
  public static function AOcreator($pageName, $message, $type) {
    if($_SESSION["user"]->getRights() < 1) {
      $pageName = "accueil";
      $message = "Tu n'as pas les droits nécessaires, connecte-toi d'abord !";
      $type = "danger";
    } elseif(!isset($_POST["action"]) || $_POST["action"]=="") {
      $pageName = "AOcreator";
      $message = "Erreur : Les données ont été corrompues, merci de réessayer.";
      $type = "danger";
    } else {
      switch($_POST["action"]) {
        case "create":
          list($pageName, $message, $type) = $_SESSION["proposal"]->create($pageName, $message, $type);
          break;
        case "save":
          list($pageName, $message, $type) = $_SESSION["proposal"]->save($pageName, $message, $type);
          break;
        case "reset":
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
      $message = "Erreur : Tu dois remplir tous les champs.";
      $type = "danger";
    } else {
      $this->title = addslashes($_POST["title"]);
      $this->clientName = addslashes($_POST["clientName"]);
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
      $message = "Erreur : Tu dois remplir tous les champs.";
      $type = "danger";
    } else {
      $this->title = addslashes($_POST["title"]);
      $this->clientName = addslashes($_POST["clientName"]);
      $this->lastModified = date("Y-m-d H:i:s");
      $_SESSION["bdd"]->updateProposal($this->toArray());
      $pageName = "AOcreator";
      $message = "Appel d'offre correctement sauvegardé.";
      $type = "success";
    }
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