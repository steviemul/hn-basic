<?php
  $pageNum = $response->pagingInfo->pageNum;
  $pages = $response->pagingInfo->pages;
?>

<sm-paging data-sm="<?php echo encodeItem($response->pagingInfo)?>">
  &lt;
  <a class="previous" href="<?php echo $queryPath."/".($pageNum - 1) ?>" <?php if ($pageNum <= 1) {echo "disabled";}?>>prev</a>
  <span> <?php echo $pageNum ?></span>
  /
  <span><?php echo $pages ?> </span>
  <a class="next" href="<?php echo $queryPath."/".($pageNum + 1) ?>" <?php if ($pageNum >= $pages) {echo "disabled";}?>>next</a>
  &gt;
</sm-paging>

<sm-posts class="posts">
  <?php foreach ($response->items as $item) { ?>
    <sm-post data-sm="<?php echo encodeItem($item)?>">
      <?php include("post.php"); ?>
    </sm-post>
  <?php } ?>
</sm-posts>

<sm-item hidden="true"></sm-item>



