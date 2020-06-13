<?php

function request_is_post() {
	return $_SERVER['REQUEST_METHOD'] == 'POST';
}
function redirect_to($location){
	header("Location: " . $location);
	exit();
}
function redirect_in_time($location, $second){
  header( "Refresh:" . $second . "; url=" . $location, true, 303);
  exit();
}
// sanitize user input to prevent cross-site scripting attack
function h($string=""){
  return htmlspecialchars($string);
}
// escape special character from user input to prevent SQL injection
function db_escape($connection, $string){
  return mysqli_real_escape_string($connection, $string);
}

// connect to the database using the admin credential;
function db_connect(){
  return mysqli_connect('localhost', 'admin', 'answer22', 'artwork_schema');
}

function db_disconnect($connection){
  if (isset($connection)){
    mysqli_close($connection);
  }
}

// generate a string consist of random chararacters
function randomString($n) { 
    $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
    $randomString = ''; 
  
    for ($i = 0; $i < $n; $i++) { 
        $index = rand(0, strlen($chars) - 1); 
        $randomString .= $chars[$index]; 
    } 
    return $randomString; 
} 

//store username and a random string as token in cookies
function set_cookie($username,$token){
  setcookie('username',$username, time() + 3600);
  setcookie('token',$token, time() + 3600);
}
//store username and a random string as token in session
function set_session($username,$token){
  $_SESSION[$username] = [$token,'ss'];
}

//add time to existing cookies
function refresh_cookie(){
  if (check_cookie()){
    setcookie('username',$_COOKIE['username'], time() + 3600);
    setcookie('token',$_COOKIE['token'], time() + 3600);
  }
}

// check if cookie matchs
function check_cookie(){
  if (isset($_COOKIE['username']) and isset($_COOKIE['token']) and isset($_SESSION[$_COOKIE['username']])){
    if ($_COOKIE["token"] == $_SESSION[$_COOKIE['username']][0]) {
      return true;
    } 
  }
  return false;
}

function unset_session_cookie(){
  unset($_SESSION[$_COOKIE['username']]) ;
  setcookie('username', '', time() -3600);
  setcookie('token','', time() - 3600);
}

function next_artwork_id($db){
  $query = "SELECT max(artwork_id) FROM artwork;";
  $result = mysqli_query($db, $query);
  $largest_id =  mysqli_fetch_row($result)[0];

  if (isset($largest_id)){
    $next_id = $largest_id + 1;
  } else {
    $next_id = 1000001;
  }
  mysqli_free_result($result);
  return $next_id;
}

function insert_artwork($db, $artwork_id, $artwork_name, $artwork_des,$artwork_path, $artsit_id){
  $artwork_id = db_escape($db, $artwork_id);
  $artwork_name = "'" . db_escape($db, $artwork_name) . "'";
  $artwork_des = "'" . db_escape($db, $artwork_des) . "'";
  $artwork_path = "'" . db_escape($db, $artwork_path) . "'";
  $artsit_id = db_escape($db, $artsit_id);
  $insert_DML = "INSERT INTO artwork(artwork_id,artwork_name,artwork_des,artwork_date,artwork_path,artist_id) VALUES ($artwork_id, $artwork_name,$artwork_des, CURDATE(),$artwork_path, $artsit_id)";
  mysqli_query($db, $insert_DML);
}
//return path of image as a array
function get_imgs_path(){
  $db = db_connect();
  $query = "SELECT artwork_path FROM artwork";
  $result = mysqli_query($db, $query);

  $count = mysqli_num_rows($result);
  $arr = [];
  for ($i = 0; $i < $count; $i++){
    $subject = '"'.mysqli_fetch_row($result)[0].'"';
    array_push($arr, $subject);
  }
  db_disconnect($db);
  return "[" . implode(",", $arr) ."]";
}

function save_thumbnail($image,$file_name, $ext){
  if ($ext == 'png' || $ext =='PNG'){
    $im = imagecreatefrompng($image);
  } else if ($ext == 'jpg' || $ext == 'jpeg' || $ext == 'JPEG' || $ext == 'JPG'){
    $im = imagecreatefromjpeg($image);
  } else {
    exit("Error 4");
  }
  $size = min(imagesx($im), imagesy($im)); 
  if (imagesx($im) == imagesy($im)){
    return imagepng($im,'../img/artwork/thumbnail/'.$file_name);
  } else if (imagesx($im) > imagesy($im)){
    $x =  (imagesx($im) - $size)/2;
    $im2 = imagecrop($im, ['x' => $x, 'y' => 0, 'width' => $size, 'height' => $size]);
  } else {
    $y =  (imagesy($im) - $size)/2;
    $im2 = imagecrop($im, ['x' => 0, 'y' => $y, 'width' => $size, 'height' => $size]);
  }
  if ($im2 !== FALSE) {
    if (imagesx($im2)> 1200){
      $im2 = imagescale($im2, 1080, 1080); 
    }
    imagepng($im2,'../img/artwork/thumbnail/'.$file_name);
  } else {
    exit("Error 3");
  }
}


?>


