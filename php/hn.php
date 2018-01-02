<?php

require_once("results.php");

class HN {

  private $baseUrl = "";
  private $outputDir = "";
  
  private $POST_URLS = [
    "/top" => "/topstories.json",
    "/new" => "/newstories.json",
    "/ask" => "/askstories.json",
    "/show" => "/showstories.json",
    "/jobs" => "/jobstories.json"
  ];

  function __construct($baseUrl, $outputDir) {
    $this->baseUrl = $baseUrl;
    $this->outputDir = $outputDir;
  }

  function getPosts($path) {

    $stem = $this->POST_URLS[$path];
    $filePath = $this->outputDir.$stem;

    if (file_exists($filePath)) {
      $response = file_get_contents($filePath);
    }
    else {
      $url = $this->baseUrl.$this->POST_URLS[$path];

      $response = file_get_contents($url);

      file_put_contents($filePath, $response);
    }
   
    return json_decode($response);
  }

  function getItem($item, $path) {
    $filePath = $this->outputDir.$path."/".$item.".json";

    if (file_exists($filePath)) {
      $response = file_get_contents($filePath);
    }
    else {
      $url = $this->baseUrl."/item/".$item.".json";

      $response = file_get_contents($url);

      if (!is_dir($this->outputDir.$path)) {
        mkdir($this->outputDir.$path);
      }

      file_put_contents($filePath, $response);
    }
    
    return json_decode($response);
  }

  function getItems($path, $pageNum, $limit) {
    $start = ($pageNum - 1) * $limit;
    $allposts = $this->getPosts($path);

    $items = array();

    $posts = array_slice($allposts, $start, $limit);

    foreach ($posts as $post) {
      $details = $this->getItem($post, $path);
      array_push($items, $details);
    }

    return new HNResult($items, $pageNum, $limit, sizeof($allposts));
  }
}

?>
