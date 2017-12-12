<?php
$content = get_the_content();
$thumbnail = get_the_post_thumbnail(null, 'thumbnail');
$thumbnailUrl = get_the_post_thumbnail_url(null, 'thumbnail');
$permalink = get_the_permalink();

?>

<div class="flex conts">
    
    <div class="content-article">
        <p> <?= apply_filters("the_content", $content); ?> </p>
        <?php if(!is_single()){?>
            <a href="<?= $permalink ?>">Lire l'article</a>
        <?php } ?>
        
    </div>
</div>