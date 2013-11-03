<?php
session_start();
unset($_SESSION["fb_207332529439206_code"]);
unset($_SESSION["fb_207332529439206_access_token"]);
unset($_SESSION["fb_207332529439206_user_id"]); 
$fb_id = $_GET["fb_id"];
  $url = "/yahoo_hack/index.php?fb_id=$fb_id&func=logout";
 print("<script> top.location.href='$url'</script>");
?>
