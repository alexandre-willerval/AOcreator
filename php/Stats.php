<?php
class Stats {
  protected $numberUsers, $numberBricks, $numberProposals, $numberExpress;
  
  public function __construct() {
    $this->numberUsers = $_SESSION["bdd"]->getNumberUsers(); 
    $this->numberBricks = $_SESSION["bdd"]->getNumberBricks();
    $this->numberProposals = $_SESSION["bdd"]->getNumberProposals();
    $this->numberExpress = "x";
  }
  
  public function getNumberUsers() {
    return $this->numberUsers;
  }
  
  public function getNumberBricks() {
    return $this->numberBricks;
  }
  
  public function getNumberProposals() {
    return $this->numberProposals;
  }
  
  public function getNumberExpress() {
    return $this->numberExpress;
  }
}
?>