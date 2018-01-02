<?php 
  require_once("php/responder.php");
  require_once("php/utils.php");

  $OUTPUT_DIR = getcwd()."/data";

  $responder = new Responder("https://hacker-news.firebaseio.com/v0", $OUTPUT_DIR, 30);

  $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH); 

  $responderResult = $responder->respond($path);

  $response = $responderResult->data;
  $queryPath = "/".$responderResult->path;
?>

<?php

  if ($responderResult->is_api) {
    include('php/api.php');
  }
  else {
    include('php/html.php');
  }

?>
