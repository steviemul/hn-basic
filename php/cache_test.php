<?php 
  $memcache = new Memcached();
  $memcache->addServer("127.0.0.1", 11211);

  $memcache->set('test_key', 'Hitting');

  $result = $memcache->get('test_key');

  if ($result) {
    echo 'Cache Working - '.$result;
  }
  else {
    echo 'Cache miss';
  }
?>