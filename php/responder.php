<?php

require_once("hn.php");

class Response {
  public $is_api = FALSE;
  public $data = NULL;
  public $path;
}

class Responder {

  private $hn;
  private $itemsPerPage = 30;

  function __construct($baseUrl, $outputDir, $itemsPerPage) {
    $this->hn = new HN($baseUrl, $outputDir);
    $this->itemsPerPage = $itemsPerPage;
  }

  function respond($path) {
    $parts = explode("/", $path);
    $response = new Response();

    if ($parts[1] == '') {
      $parts[1] = 'top';
    }
    
    if ($parts[1] == 'api') {
      $response->is_api = TRUE;
      $parts = array_slice($parts, 1);
    }

    $response->path = $parts[1];

    if ($parts[1] == 'item') {
      $itemId = $parts[2];

      $response->data = $this->hn->getItem($itemId, "/item");
    }
    else {
      $pageNum = 1;

      if (sizeof($parts) == 3) {
        $pageNum = $parts[2];
      }

      $response->data = $this->hn->getItems("/".$parts[1], $pageNum, $this->itemsPerPage);
    }

    return $response;
  }
}

?>