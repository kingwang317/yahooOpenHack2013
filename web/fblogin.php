<?php

session_start();
// uses the PHP SDK. Download from https://github.com/facebook/php-sdk
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

$scope = 'user_about_me,user_status,email,publish_actions,user_birthday,friends_birthday,read_stream,friends_photos,friends_location,user_photos,user_location,user_status,friends_status';
//
// if user is logged in on facebook and already gave permissions
// to your app, get his data:
$userId = $facebook->getUser();
// $access_token = $facebook->getAccessToken();
//$_SESSION['access_token'] = $facebook->getAccessToken();
// echo $userId;
// print_r($_SESSION);
// return;
$fb_id = isset($_GET["fb_id"])?$_GET["fb_id"]:"";
// if ( $userId == 0) {
//   // echo "123";
//     $loginUrl = $facebook->getLoginUrl(array(
//           'scope' => $scope));
//     $_SESSION["loginUrl"] = $loginUrl;
//     // $fb_id = $_GET["fb_id"];
//     // print("<a href='$loginUrl&fb_id=$fb_id'>Login with Facebook</a>");
//     // print("<a href='$loginUrl'>Login with Facebook</a>");
// }else{
//   // echo "321";
//    $logoutUrl = $facebook->getLogoutUrl();
//    $_SESSION["logoutUrl"] = $logoutUrl;
//    // $url = "/yahoo_hack/fb_api_ajax.php?fb_id=$fb_id";
//    //  print('<script> top.location.href=\'' . $url . '\'</script>');
// }

if ($userId != 0) {
  // $params = array( 'next' => "/yahoo_hack/index.php?func=logout" );
  // $logoutUrl = $facebook->getLogoutUrl($params);
  $_SESSION['logoutUrl'] = "/yahoo_hack/index.php?func=logout";
} else {
  // $params = array( 'redirect_uri' => WEBROOT."/cms/plugin/member_en/do_FBlogin.php?1=1".$wiki_id."&page_id=".$cmsid );
  $loginUrl = $facebook->getLoginUrl();
  $_SESSION['loginUrl'] = str_replace("logout", "login", $loginUrl);
}


// if ($userId) {
//   $params = array( 'next' => "http://localhost:8888/facebook-php-sdk-master/examples/fblogin.php"
//                   ,'access_token' => $_SESSION['access_token'] );
//   $logoutUrl = $facebook->getLogoutUrl($params);
// } else {
//   $statusUrl = $facebook->getLoginStatusUrl();
//   $loginUrl = $facebook->getLoginUrl( array('scope' => $scope));
// }

// echo $userId;

// Login or logout url will be needed depending on current user state.
// if ($user) {
//   $params = array( 'next' => WEBROOT."/index.php?func=logout" );
//   $logoutUrl = $facebook->getLogoutUrl($params);
//   $_SERVER['FBLOGOUT'] = $logoutUrl;
// } else {
//   $params = array( 'redirect_uri' => WEBROOT."/cms/plugin/member_en/do_FBlogin.php?1=1".$wiki_id."&page_id=".$cmsid );
//   $loginUrl = $facebook->getLoginUrl($params);
//   $_SERVER['FBLOGIN'] = $loginUrl;
// }
 
?> 