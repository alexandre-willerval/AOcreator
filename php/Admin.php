<?php
class Admin {
  protected $userList;
  
  public function __construct() {
    $this->userList = $_SESSION["bdd"]->getUserList(); 
  }
  
  public function getUserList() {
    return $this->userList;
  }
  
  public static function AOadmin($pageName, $message, $type) {
    if($_SESSION["user"]->getRights() != 2) {
      $pageName = "accueil";
      $message = "Tu n'as pas les droits nécessaires : seul un administrateur peut modifier les droits des autres utilisateurs de l'application.";
      $type = "danger";
    } elseif(!isset($_POST["user_id"]) || !is_numeric($_POST["user_id"]) || !isset($_POST["user_rights"]) || !is_numeric($_POST["user_rights"])) {
      $pageName = "AOadmin";
      $message = "Les données ont été corrompues, impossible d'appliquer les droits demandés à l'utilisateur sélectionné.";
      $type = "danger";
    } else {
      $rights = ["id"=>$_POST["user_id"], "rights"=>$_POST["user_rights"]];
      $statut = Array("utilisateur bloqué", "utilisateur enregistré", "administrateur");
      $_SESSION["bdd"]->setUserRights($rights);
      $pageName = "AOadmin";
      $message = addslashes($_POST["user_name"])." est bien passé au statut d'".$statut[$_POST["user_rights"]].".";
      $type = "success";
    }
    return array($pageName, $message, $type);
  }
}
?>