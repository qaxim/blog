<?php if ($data->num_rows > 0) { foreach($data as $d) { ?>
<div class="post">
<div class="catnviews">
<p class="tag">
<?php $catetory = $post['category_id'];
echo $mysqli->query("SELECT * FROM categories WHERE id = ".$catetory."")->fetch_object()->title; ?>
</p>
<p class="viewsp">
Page views &nbsp;
<img src="<?=root?>assets/front/img/views.svg" alt="" class="views_svg" />
<strong>&nbsp;<?=$d['hits']?></strong>
</p>
</div>
<h1 class="title"><?=$d['title']?></h1>
<?php include "app/views/front/partcials/author.php"?>

<?php if (getimagesize(root."uploads/posts/".$d['img']) !== false) {?>
<img src="<?=root?>uploads/posts/<?=$d['img']?>" class="img" alt="<?=$d['title']?>" />
<?php } else { ?>
<img src="<?=root?>assets/admin/img/no_img.png" class="img" alt="no image" />
<img src="" alt="" />
<?php } ?>

<div class="content">
<?=$d['content']?>
</div>
</div>
<?php } } else { include "404.php"; } ?>

<section class="post_articles">
<div class="articles contain">
<div class="row">
<?php include "app/views/front/partcials/post.php"?>
</div>
</div>
</section>