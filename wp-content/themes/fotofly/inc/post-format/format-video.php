<?php 
$embed = get_post_meta(get_the_ID(),'fotofly_fn_video_embed', true);
?>

<?php if( !empty($embed) ) { ?>
<div class="post-type-wrapper">
    <div class="video">
        <?php echo stripslashes(htmlspecialchars_decode($embed)); ?>
    </div>
</div>
<?php }?>