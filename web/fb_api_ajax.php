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

    //echo json_encode($_POST);
    //return;
    // $fb_id = $_GET["fb_id"];
    // echo $fb_id;
      // return;
    $scope = 'user_about_me,user_status,email,publish_actions,user_birthday,friends_birthday,read_stream,friends_photos,friends_location,user_photos,user_location,user_status,friends_status';
     
    $userId = $facebook->getUser(); 

    // $result = $facebook->api("/me");
    // print_r($result);
    // return;

    if ($userId == 0 && isset($_GET["fb_id"])) { 
        $fb_id = $_GET["fb_id"];
        $url = "/yahoo_hack/index.php?fb_id=$fb_id";
        // print('<script> top.location.href=\'' . $url . '\'</script>');
        echo json_encode(array("error" => "405","url" => "$url"));
        return;
    } 

    if (isset($_GET["fb_id"])) {
      $fb_id = $_GET["fb_id"];
         // $a = $facebook->api('/10200981428721945');
      $result = $facebook->api("/$fb_id");
      // echo json_encode($result);
      if(array_key_exists('place',$result)){
        $place = $result["place"];
        foreach ($place as $key => $value ) {
          // echo "key : $key, value : $value";
          if ($key == "location") {
              $value["lat"] = $value["latitude"];
              unset($value["latitude"]);
              $value["lon"] = $value["longitude"];
              unset($value["longitude"]);
              // print_r($value);
              $place["location"] = $value;
              unset($value["location"]);
          }
        }
        // $arr["lat"] = $arr["latitude"];
        // unset($arr["latitude"]);
        // $arr["lon"] = $arr["longitude"];
        // unset($arr["longitude"]);
        
        echo json_encode($place);
      }else{
         
        echo json_encode(array("error" => "500","msg" => "no place info"));
      }

    } 
?>
  