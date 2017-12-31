<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hacker News PHP</title>
    <meta charset="utf-8">
    <meta name="description" content="hnphp">

    <link rel="manifest" href="/manifest.json">

    <meta name="theme-color" content="#283593">

    <style>
      html, body {
        margin:0;
        padding:0;
        font-family: Arial, Helvetica, sans-serif;
      }

      .container {
        width:100%;
        margin:auto;
      }

      nav {
        width:100%;
        border-bottom:1px solid #CCC;
      }

      nav ul {
        padding:0;
        margin:0;
      }

      nav ul li {
        display:inline-block;
      }

      nav ul li a {
        text-decoration: none;
        margin:15px;
        display:block;
      }

      @media (min-width: 768px) {
        .container {
          width:80%;
        }
      }

      sm-post {
        display:block;
        min-height:60px;
      }

      sm-post h1 {
        font-size:14px;
        font-weight:500;
      }

      [hidden] {
        opacity:0;
        pointer-events:none;
        height:0;
      }

      sm-paging {
        display:block;
        margin:auto;
        padding:15px;
        text-align:center;
        border-bottom:1px solid #CCC;
      }

      a[disabled] {
        pointer-events:none;
        text-decoration:none;
        pointer:default;
        color:#AAA;
      }

    </style>
  </head>
  <body>
    <sm-view>
      <div class="container">
        <nav class="nav">
          <ul>
            <li><a href="/top/1">Top</a></li>
            <li><a href="/new/1">New</a></li>
            <li><a href="/show/1">Show</a></li>
            <li><a href="/ask/1">Ask</a></li>
            <li><a href="/jobs/1">Jobs</a></li>
          </ul>
        </nav>
        <main class="news">
          <?php 
            if ($responderResult->path == 'item') {
              include('item.php');
            }
            else {
              include('posts.php'); 
            }
          ?>

        </main>
      </div>
    </sm-view>
    <script type="application/javascript">
      if ('serviceWorker' in navigator) {
        navigator.serviceWorker.register('/sw.js');
      }
    </script>

    <?php if (supportsWebComponents() == false) { ?>
      <script src="/webcomponents/webcomponents-lite.js"></script>
    <?php } ?>
    
    <script type="application/javascript" src="/webcomponents/custom-elements-es5-adapter.js"></script>
    <script type="application/javascript" src="/dist/js/index.js"></script>

  </body>
</html>