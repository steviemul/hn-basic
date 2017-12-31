<sm-paging hidden="true"></sm-paging>
<sm-posts hidden="true"></sm-posts>

<sm-item data-sm="<?php echo encodeItem($response)?>">

<h1><a href="<?php echo $response->url ?>" target="_blank" rel="noopener"><?php echo $response->title ?></a></h1>
<div>
  <?php echo $response->score ?> points by <?php echo $response->by ?> | <?php echo getCommentsString($response) ?>
</div>

</sm-item>