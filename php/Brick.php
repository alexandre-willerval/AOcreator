<?php
class Brick {
  protected $id, $title, $category, $file, $firstUser, $lastUser, $firstCreated, $lastModified;
  
  public function __construct($id) {
    $brick = $_SESSION["bdd"]->getBrick($id);
    $this->id = $brick["id"];
    $this->title = stripslashes($brick["title"]);
    $this->category = stripslashes($brick["category"]);
  }
  
  protected function getId() {
    return $this->id;
  }
  
  public function getTitle() {
    return $this->title;
  }
  
  public function hasCategory($category) {
    return ($this->category==$category);
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
  
  protected static function add($pageName, $message, $type) {
    if(!isset($_FILES["file"]) || $_FILES["file"]["name"]=="") {
      $pageName = "AOlibrary";
      $message = "Erreur : Aucun fichier sélectionné...";
      $type = "danger";
    } elseif(substr($_FILES["file"]["name"], -5)!=".docx") {
      $pageName = "AOlibrary";
      $message = "Erreur : Seul le format .docx est autorisé.";
      $type = "danger";
    } elseif($_FILES["file"]["error"]==2 || $_FILES["file"]["error"]==3) {
      $pageName = "AOlibrary";
      $message = "Erreur : Seul les fichiers inférieur à 10Mo sont autorisés.";
      $type = "danger";
    } else {
      $brickId = $_SESSION["bdd"]->getBrickId();
      $filepath = "bricks/".$brickId.".docx";
      if(move_uploaded_file($_FILES["file"]["tmp_name"], $filepath)) {
        $brick = Array("file"=>$filepath, "firstUser"=>$_SESSION["user"]->getEmail(), "firstCreated"=>date("Y-m-d H:i:s"));
        $_SESSION["bdd"]->addBrick($brick);
        $_SESSION["brick"] = new Brick($brickId);
        $pageName = "AOlibrary";
        $message = "Fichier correctement uploadé !";
        $type = "success";
      } else {
        $pageName = "AOlibrary";
        $message = "Une erreur s'est produite lors du téléchargement de ton fichier, merci de réessayer.";
        $type = "danger";
      }
    }
    return array($pageName, $message, $type);
  }
  
  protected static function edit($pageName, $message, $type) {
    if(!isset($_POST["brick_id"]) || !is_numeric($_POST["brick_id"])) {
      $pageName = "AOlibrary";
      $message = "Erreur : Les données ont été corrompues, merci de réessayer.";
      $type = "danger";
    } else {
      $_SESSION["brick"] = new Brick($_POST["brick_id"]);
      $pageName = "AOlibrary";
      $message = "";
      $type = "success";
    }
    return array($pageName, $message, $type);
  }
  
  protected static function update($pageName, $message, $type) {
    if(!isset($_POST["title"]) || !isset($_POST["category"]) || $_POST["title"]=="" || $_POST["category"]=="") {
      $pageName = "AOlibrary";
      $message = "Erreur : Des champs sont manquants, merci de réessayer.";
      $type = "danger";
    } else {
      $title = addslashes($_POST["title"]);
      $category = addslashes($_POST["category"]);
      $info = Array("id"=>$_SESSION["brick"]->getId(), "title"=>$title, "category"=>$category, "lastUser"=>$_SESSION["user"]->getEmail(), "lastModified"=>date("Y-m-d H:i:s"));
      $_SESSION["bdd"]->updateBrick($info);
      unset($_SESSION["brick"]);
      $pageName = "AOlibrary";
      $message = "Brique correctement sauvegardée";
      $type = "success";
    }
    return array($pageName, $message, $type);
  }
  
  protected static function delete($pageName, $message, $type) {
    if(!isset($_POST["brick_id"]) || !is_numeric($_POST["brick_id"])) {
      $pageName = "AOlibrary";
      $message = "Erreur : Les données ont été corrompues, merci de réessayer.";
      $type = "danger";
    } else {
      $info = Array("id"=>$_POST["brick_id"], "deleted"=>1, "lastUser"=>$_SESSION["user"]->getEmail(), "lastModified"=>date("Y-m-d H:i:s"));
      $_SESSION["bdd"]->deleteBrick($info);
      $pageName = "AOlibrary";
      $message = "Brique correctement supprimée";
      $type = "success";
    }
    return array($pageName, $message, $type);
  }
  
  protected static function restore($pageName, $message, $type) {
    if($_SESSION["user"]->getRights() < 2) {
      $pageName = "AOlibrary";
      $message = "Tu n'as pas les droits nécessaires, connecte-toi d'abord !";
      $type = "danger";
    } elseif(!isset($_POST["brick_id"]) || !is_numeric($_POST["brick_id"])) {
      $pageName = "AOlibrary";
      $message = "Erreur : Les données ont été corrompues, merci de réessayer.";
      $type = "danger";
    } else {
      $info = Array("id"=>$_POST["brick_id"], "deleted"=>0, "lastUser"=>$_SESSION["user"]->getEmail(), "lastModified"=>date("Y-m-d H:i:s"));
      $_SESSION["bdd"]->deleteBrick($info);
      $pageName = "AOlibrary";
      $message = "Brique à nouveau disponible";
      $type = "success";
    }
    return array($pageName, $message, $type);
  }
}
?>