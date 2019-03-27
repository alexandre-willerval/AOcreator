<?php
class Stats {
  protected $numberUsers, $numberBricks, $numberProposals, $numberExpress, $connectionStats, $brickUseStats;
  
  public function __construct() {
    $this->numberUsers = $_SESSION["bdd"]->getNumberUsers(); 
    $this->numberBricks = $_SESSION["bdd"]->getNumberBricks();
    $this->numberProposals = $_SESSION["bdd"]->getNumberProposals();
    $this->numberExpress = "x";
    $this->connectionStats = $this->generateConnectionStats();
    $this->brickUseStats = $this->generateBrickUseStats();
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
  
  public function getXAxisConnectionStats() {
    $xAxis = array_keys($this->connectionStats);
    return $this->arrayToString($xAxis);
  }
  
  public function getYAxisConnectionStats() {
    $yAxis = array_values($this->connectionStats);
    return $this->arrayToString($yAxis);
  }
  
  public function getXAxisBrickUseStats() {
    $xAxis = array_keys($this->brickUseStats);
    return $this->arrayToString($xAxis);
  }
  
  public function getYAxisBrickUseStats() {
    $yAxis = array_values($this->brickUseStats);
    return $this->arrayToString($yAxis);
  }
  
  private function generateConnectionStats() {
    $stats = [];
    $x = new DateTime('-6 months');
    for($i=0; $i<26; $i++) {
      $x->modify('+7 days');
      $stats[$x->format('\SW Y')] = rand(0, 20);
    }
    return $stats;
  }
  
  private function generateBrickUseStats() {
    $stats = array("test"=>1, "truc"=>3, "muche"=>2);
    return $stats;
  }
  
  private function arrayToString($array) {
    return "['".implode("', '", $array)."']";
  }
}
?>