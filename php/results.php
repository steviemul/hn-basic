<?php

class PagingInfo {
  public $pageNum;
  public $pages;

  function __construct($pageNum, $pages) {
    $this->pageNum = intval($pageNum);
    $this->pages = intval($pages);
    $this->url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
  }
}

class HNResult {

  public $items;
  public $pagingInfo;

  function __construct($items, $pageNum, $limit, $totalResults) {
    $this->items = $items;
    $this->pagingInfo = new PagingInfo($pageNum, intval($totalResults / $limit) + 1);
  }

}

?>