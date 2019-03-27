<?php
class Bdd {
  protected $pdo, $server, $user, $password, $database;
  
  public function __construct($DB_CONF) {
    $this->server = $DB_CONF['SERVER'];
    $this->user = $DB_CONF['USER'];
    $this->password = $DB_CONF['PASSWORD'];
    $this->database = "AOcreator";
    $this->connection();
  }
  
  protected function connection() {
    try {
      $this->pdo = new PDO("mysql:host=".$this->server.";dbname=".$this->database, $this->user, $this->password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
    } catch(Exception $e) {
      die("Erreur : ".$e->getMessage());
    }
  }
  
  protected function query($sql) {
    $query = $this->pdo->query($sql);
    $result = $query->fetchAll();
    $query->closeCursor();
    return $result;
  }
  
  protected function execute($data, $sql) {
    $query = $this->pdo->prepare($sql);
    $query->execute($data);
  }
  
  public function __sleep() {
    return ["server", "user", "password", "database"];
  }
  
  public function __wakeup() {
    $this->connection();
  }
  
  public function addLog($log) {
    $this->execute($log, "INSERT INTO logs VALUES(NULL, :user, :getPage, :getAction, :pageName, :message, :type, NULL)");
  }
  
  public function getPageList() {
    $result = $this->query("SELECT name FROM pages");
    for($i=0; $i<sizeOf($result); $i++) {
        $pageList[$i] = $result[$i]["name"];
    }
    return $pageList;
  }
  
  public function getPageDisplay($name) {
    $result = $this->query("SELECT display FROM pages WHERE name='".$name."'");
    return intval($result[0]["display"]);
  }
  
  public function getPage($name) {
    $result = $this->query("SELECT * FROM pages WHERE name='".$name."'");
    return $result[0];
  }
  
  public function getMenuList($visibility) {
    return $this->query("SELECT name, title, icon, description FROM pages WHERE visibility<=".$visibility);
  }
  
  public function isUserRegistred($email) {
    $result = $this->query("SELECT id FROM users WHERE email='".$email."'");
    return (sizeOf($result)>0);
  }
  
  public function addUser($user) {
    $this->execute($user, "INSERT INTO users VALUES(NULL, :forename, :surname, :email, :thumbnailUrl, :thumbnail, :job, :team, :phone, :address, :firstConnection, :lastConnection, :cookie, :rights)");
    $result = $this->query("SELECT id FROM users WHERE email='".$user["email"]."'");
    return $result[0]["id"];
  }
  
  public function updateUser($user) {
    $result = $this->query("SELECT id, thumbnailUrl, thumbnail, firstConnection, lastConnection, rights, cookie FROM users WHERE email='".$user["email"]."'");
    $this->execute($user, "UPDATE users SET thumbnailUrl = :thumbnailUrl, job = :job, team = :team, phone = :phone, address = :address, lastConnection = :lastConnection WHERE email = :email");
    return $result[0];
  }
  
  public function setThumbnail($info) {
    $this->execute($info, "UPDATE users SET thumbnail = :thumbnail WHERE email = :email");
  }
  
  public function getUserList() {
    return $this->query("SELECT id, forename, surname, email, thumbnail, firstConnection, lastConnection, rights FROM users");
  }
  
  public function getNumberUsers() {
    $result = $this->query("SELECT COUNT(id) AS nb FROM users");
    return intval($result[0]["nb"]);
  }
  
  public function setUserRights($rights) {
    $this->execute($rights, "UPDATE users SET rights = :rights WHERE id = :id");
  }
  
  public function getBrickList($deleted) {
    return $this->query("SELECT * FROM bricks WHERE deleted='".$deleted."' ORDER BY category, id");
  }
  
  public function getBrickId() {
    $result = $this->query("SELECT COUNT(id) AS nb FROM bricks");
    return intval($result[0]["nb"])+1;
  }
  
  public function addBrick($brick) {
    $this->execute($brick, "INSERT INTO bricks VALUES(NULL, NULL, NULL, :file, :firstUser, NULL, :firstCreated, NULL, 0)");
  }
  
  public function updateBrick($info) {
    $this->execute($info, "UPDATE bricks SET title = :title, category = :category, lastUser = :lastUser, lastModified = :lastModified WHERE id = :id");
  }
  
  public function deleteBrick($info) {
    $this->execute($info, "UPDATE bricks SET lastUser = :lastUser, lastModified = :lastModified, deleted = :deleted WHERE id = :id");
  }
  
  public function getBrick($id) {
    $result = $this->query("SELECT * FROM bricks WHERE id='".$id."'");
    return $result[0];
  }
  
  public function getNumberBricks() {
    $result = $this->query("SELECT COUNT(id) AS nb FROM bricks");
    return intval($result[0]["nb"]);
  }
  
  public function getProposalList() {
    return $this->query("SELECT * FROM proposals ORDER BY id DESC");
  }
  
  public function addProposal($proposal) {
    $this->execute($proposal, "INSERT INTO proposals VALUES(:id, :title, :clientName, :consultantName, :products, :user, :firstCreated, :lastModified, :file, :step)");
    $result = $this->query("SELECT COUNT(id) AS nb FROM proposals");
    return intval($result[0]["nb"]);
  }
  
  public function updateProposal($proposal) {
    $this->execute($proposal, "UPDATE proposals SET title = :title, clientName = :clientName, consultantName = :consultantName, products = :products, user = :user, firstCreated = :firstCreated, lastModified = :lastModified, file = :file, step = :step WHERE id = :id");
  }
  
  public function getProposal($id) {
    $result = $this->query("SELECT * FROM proposals WHERE id='".$id."'");
    return $result[0];
  }
  
  public function getNumberProposals() {
    $result = $this->query("SELECT COUNT(id) AS nb FROM proposals");
    return intval($result[0]["nb"]);
  }
}