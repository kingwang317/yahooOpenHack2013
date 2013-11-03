<?php
//
// uses the PHP SDK. Download from https://github.com/facebook/php-sdk
    
    header('Access-Control-Allow-Origin: *');
    header('Content-type: application/json');
    require 'facebook/facebook.php';
     
    //
    // from the facebook app page
    define('APP_ID', '207332529439206');
    define('APP_SECRET', '14d64423d737302ee09879ec8f1e76b5');
     
    //
    // new facebook object to interact with facebook
    $facebook = new Facebook(array(
     'appId' => APP_ID,
     'secret' => APP_SECRET,
    ));
 
 
    $userId = $facebook->getUser(); 

     
    if ($userId == 0 && isset($_GET["fb_id"])) { 
        $fb_id = $_GET["fb_id"];
        $url = "/yahoo_hack/fblogin.php?fb_id=$fb_id";
        // print('<script> top.location.href=\'' . $url . '\'</script>');
        echo json_encode(array("error" => "405","url" => "$url"));
    } 

    if (isset($_GET["fb_id"])) {
      $fb_id = $_GET["fb_id"]; 
      $result = $facebook->api("/$fb_id"); 
      if(array_key_exists('picture',$result)){
        $picture = array();
        foreach ($result as $key => $value ) { 
          if ($key == "picture") {
              $picture["picture"] = $value; 
          }else if ($key == "images") {
              $picture["images"] = $value[4]["source"]; 
          }else if ($key == "link") {
              $picture["link"] = $value; 
          }else if ($key == "name") {
              $picture["name"] = $value; 
          }
        };
        
        echo json_encode($picture);
      }else{
         
        echo json_encode(array("error" => "500","msg" => "no place info"));
      }

    } 
?>
  