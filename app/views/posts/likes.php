<div style="border-bottom: solid 1px #ccc; padding: 1rem;">
<?php if (count($data['likes']) > 0):?>
<?php foreach ($data['likes'] as $post_likes):?>    
    <a href="<?= URLROOT;?>/posts/user/<?= $post_likes->name."/".$post_likes->userId;?>" style="text-decoration: none;font-size: 1em;">
        <?= $post_likes->name; ?>
    </a>  
<?php endforeach;?>
<?php else: ?>
    <p>There are currently no likes for this post.</p>
<?php endif;?>
</div>