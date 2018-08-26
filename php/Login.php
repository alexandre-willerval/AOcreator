<?php
class Login {
  public static function connexion($pageName, $message, $type) {
    if($_SESSION["user"]->getRights() > 0) {
      $pageName = "accueil";
      $message = "Tu es déjà connecté, tu ne peux pas te connecter une seconde fois ! Déconnecte-toi d'abord...";
      $type = "danger";
    } elseif(!isset($_POST["email"]) || $_POST["email"]=="" || !isset($_POST["password"]) || $_POST["password"]=="") {
      $pageName = "connexion";
      $message = "Tu dois saisir une adresse email ET un mot de passe.";
      $type = "danger";
    } else {
      $url = "https://plazza.orange.com/api/core/v3/people/@me";
      $email = addslashes($_POST["email"]);
      $password = addslashes($_POST["password"]);
      $curl = curl_init();  
      curl_setopt($curl, CURLOPT_HEADER, false);  
      curl_setopt($curl, CURLOPT_FAILONERROR, true);  
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($curl, CURLOPT_ENCODING, "UTF-8");
      curl_setopt($curl, CURLOPT_URL, $url); 
      curl_setopt($curl, CURLOPT_USERPWD, $email.":".$password);
      $result = curl_exec($curl);
      if(curl_error($curl)) {
        if(curl_error($curl) == "The requested URL returned error: 401 Unauthorized") {
          $pageName = "connexion";
          $message = "Adresse email ou mot de passe invalide.";
          $type = "danger";
        } else {
          $pageName = "connexion";
          $message = "Une erreur inconnue s'est produite, merci de réessayer.";
          $type = "danger";
        }
      } else {
        list($name, $lastConnection, $thumbnail, $thumbnailUrl) = $_SESSION["user"]->connexion(json_decode($result));
        if($thumbnail) {
          Login::downloadThumbnail($thumbnail, $thumbnailUrl, $email, $password);
        }
        $pageName = "accueil";
        if($lastConnection) {
          $message = "Bonjour ".$name.". Ta dernière connexion date du ".$lastConnection.". C'est un plaisir de te retrouver sur AOcreator !";
        } else {
          $message = "Bienvenue ".$name.". C'est ta première connexion sur AOcreator, ravi que tu te joignes à nous dans cette belle aventure !";
        }
        $type = "success";
        /*if(isset($_POST["remember"]) && $_POST["remember"]=="on") {
          setcookie("connexion", "", time()+30*24*3600, null, null, false, true);
        }*/
      }
      curl_close($curl);
    }
    return array($pageName, $message, $type);
  }
  
  public static function downloadThumbnail($thumbnail, $thumbnailUrl, $email, $password) {
    $allowedContentType = Array("image/png", "image/jpeg", "image/gif");
    $extention = Array(".png", ".jpg", ".gif");
    $curl_2 = curl_init();  
    curl_setopt($curl_2, CURLOPT_HEADER, false);  
    curl_setopt($curl_2, CURLOPT_FAILONERROR, true);  
    curl_setopt($curl_2, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl_2, CURLOPT_ENCODING, "UTF-8");
    curl_setopt($curl_2, CURLOPT_URL, $thumbnailUrl); 
    curl_setopt($curl_2, CURLOPT_USERPWD, $email.":".$password);
    $result_2 = curl_exec($curl_2);
    $contentType = curl_getinfo($curl_2, CURLINFO_CONTENT_TYPE);
    if(curl_error($curl_2) || !in_array($contentType, $allowedContentType)) {
      $thumbnail_result = "users/default.png";
    } else {
      $thumbnail_result = "users/".$thumbnail.$extention[array_search($contentType, $allowedContentType)];
      $file = fopen($thumbnail_result, "wb");
      curl_setopt($curl_2, CURLOPT_FILE, $file);
      curl_exec($curl_2);
      fclose($file);
    }
    curl_close($curl_2);
    $_SESSION["user"]->setThumbnail($thumbnail_result);
  }
  
  public static function deconnexion($pageName, $message, $type) {
    /*if(isset($_COOKIE["connexion"])) {
      setcookie("connexion", "", time()-3600, null, null, false, true);
    }*/
    $_SESSION["user"] = new User();
    if(isset($_SESSION["brick"])) { 
      unset($_SESSION["brick"]); 
    }
    if(isset($_SESSION["proposal"])) { 
      unset($_SESSION["proposal"]); 
    }
    return array("connexion", "Tu as été correctement déconnecté.", "success");
  }
}
?>