<?php
class User {
  protected $rights, $forename, $surname, $email, $thumbnailUrl, $thumbnail, $job, $team, $phone, $address, $firstConnection, $lastConnection, $cookie;
  
  public function __construct() {
    $this->rights = 0;
    $this->email = "-";
  }
  
  public function connexion($json) {
    $this->forename = $json->name->givenName;
    $this->surname = $json->name->familyName;
    $this->email = $json->jive->username;
    $this->thumbnailUrl = $json->thumbnailUrl;
    $this->job = $json->jive->profile[0]->value;
    $this->team = $json->jive->profile[1]->value;
    $this->phone = $json->phoneNumbers[0]->value;
    $this->address = nl2br($json->jive->profile[5]->value);
    $this->lastConnection = date("Y-m-d H:i:s");
    
    if($_SESSION["bdd"]->isUserRegistred($this->email)) {
      $user = array("email"=>$this->email, "thumbnailUrl"=>$this->thumbnailUrl, "job"=>$this->job, "team"=>$this->team, "phone"=>$this->phone, "address"=>$this->address, "lastConnection"=>$this->lastConnection);
      $result = $_SESSION["bdd"]->updateUser($user);
      $this->rights = $result["rights"];
      $this->thumbnail = $result["thumbnail"];
      $this->firstConnection = $result["firstConnection"];
      $this->cookie = $result["cookie"];
      setlocale(LC_TIME, "fr_FR.utf8");
      $lastConnection = strftime("%A %d %B %Y à %Hh%Mmin", strtotime($result["lastConnection"]));
      if($this->thumbnailUrl == $result["thumbnailUrl"]) {
        $thumbnail = false;
      } else {
        $thumbnail = $result["id"];
      }
    } else {
      $this->rights = 1;
      $this->thumbnail = "users/default.png";
      $this->firstConnection = date("Y-m-d H:i:s");
      $this->cookie = md5("test");
      $lastConnection = false;
      $thumbnail = $_SESSION["bdd"]->addUser($this->toArray());
    }
    return Array($this->forename, $lastConnection, $thumbnail, $this->thumbnailUrl);
  }
  
  protected function toArray() {
    foreach($this as $key => $value) {
      $result[$key] = $value;
    }
    return $result;
  }
  
  public function setThumbnail($thumbnail) {
    $this->thumbnail = $thumbnail;
    $info = Array("email"=>$this->email, "thumbnail"=>$thumbnail);
    $_SESSION["bdd"]->setThumbnail($info);
  }
  
  public function getRights() {
    return $this->rights;
  }
  
  public function getName() {
    return $this->forename;
  }
  
  public function getCompleteName() {
    return $this->forename." ".$this->surname;
  }
    
  public function getThumbnail() {
    return $this->thumbnail;
  }
  
  public function getJob() {
    return $this->job;
  }

  public function getTeam() {
    return $this->team;
  }
  
  public function getPhone() {
    return $this->phone;
  }
  
  public function getEmail() {
    return $this->email;
  }
    
  public function getAddress() {
    return $this->address;
  }
  
  public function getFirstConnection() {
    setlocale(LC_TIME, "fr_FR.utf8");
    return strftime("%A %d %B %Y à %Hh%Mmin", strtotime($this->firstConnection));
  }
  
  public function getLastConnection() {
    setlocale(LC_TIME, "fr_FR.utf8");
    return strftime("%A %d %B %Y à %Hh%Mmin", strtotime($this->lastConnection));
  }
}
?>