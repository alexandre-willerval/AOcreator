<?php
class History {
  
  public function __construct() {
    
  }
  
  public function getProposalList() {
    return $_SESSION["bdd"]->getProposalList();
  }
  
  public static function AOhistory($pageName, $message, $type) {
    if($_SESSION["user"]->getRights() < 1) {
      $pageName = "accueil";
      $message = "Tu n'as pas les droits nécessaires, connecte-toi d'abord !";
      $type = "danger";
    } elseif(!isset($_POST["proposal_id"]) || !is_numeric($_POST["proposal_id"])) {
      $pageName = "AOhistory";
      $message = "Les données ont été corrompues, impossible de charger l'appel d'offre sélectionné.";
      $type = "danger";
    } else {
      $_SESSION["proposal"] = new Proposal($_POST["proposal_id"]);
      $pageName = "AOcreator";
      $message = "";
      $type = "success";
    }
    return array($pageName, $message, $type);
  }
}
?>