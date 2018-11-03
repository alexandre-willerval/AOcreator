<?php
  function getClass($class) {
    require "php/".$class.".php";
  }
  spl_autoload_register("getClass");

  session_start();
  if(!isset($_SESSION["app"])) { 
    $_SESSION["app"] = new App();
  }
  $_SESSION["page"] = $_SESSION["app"]->createPage();

  $_SESSION["page"]->loadHtml();
?>