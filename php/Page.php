<?php
class Page {
  protected $name, $visibility, $display, $title, $message, $type, $content, $retour;
  
  public function __construct($name, $message, $type) {
    $data = $_SESSION["bdd"]->getPage($name);
    $this->name = $name;
    $this->visibility = $data["visibility"];
    $this->display = $data["display"];
    $this->title = $data["title"];
    $this->message = $message;
    $this->type = $type;
    $this->content = $data["content"];
    $this->retour = $data["retour"];
  }
  
  public function loadHtml() {
    include "html/template.php";
  }
  
  public function loadHead() {
    include "html/head.php";
  }
  
  public function loadMenu() {
    include "html/menu.php";
  }
  
  public function getName() {
    return $this->name;
  }
  
  public function getTitle() {
    return $this->title;
  }
  
  public function hasMessage() {
    return (strlen($this->message)>0);
  }
  
  public function getType() {
    return $this->type;
  }
  
  public function getMessage() {
    return $this->message;
  }
  
  public function loadContent() {
    include $this->content;
  }
  
  public function hasRetour() {
    return $this->retour;
  }
}
?>