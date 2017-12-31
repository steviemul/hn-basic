<?php

function supportsWebComponents() {
  $ua = $_SERVER['HTTP_USER_AGENT'];

  if (strpos($ua, 'Chrome') !== false) {
    return true;
  }

  return false;
}

function encodeItem($item) {

  $json = json_encode($item);

  return base64_encode($json);
}

function getCommentsString($item) {

  if (array_key_exists("kids", $item)) {
    $text = sizeof($item->kids)." comments";
  }
  else {
    $text = "discuss";
  }

  return "<a href=\"/item/".$item->id."\">".$text."</a>";
}

?>