<h1><a href="<?php echo $item->url ?>" target="_blank" rel="noopener"><?php echo $item->title ?></a></h1>
<div>
  <?php echo $item->score ?> points by <?php echo $item->by ?> | <?php echo getCommentsString($item) ?>
</div>
