<?php require_once APPROOT. "/views/inc/header.php" ?>
	<?php flash("post_message"); ?>
	<div class="row mb-3">
		<div class="col-md-6">
			<h1>All Posts</h1>
		</div>
		<div class="col-md-6">
			<a href="<?php echo URLROOT; ?>/posts/add" class="btn btn-primary pull-right">
				<i class="fa fa-pencil"></i> Add Post
			</a>
		</div>
	</div>
	<?php foreach($data["posts"] as $posts): $ppl = $this->postModel->postPreviouslyLiked($posts->postId);?>
	<div class = "card bg-light mb-3">
		<div class="card-body mb-3 pl-5 pr-5 p-2">
			<h4 class="card-title"><?php echo $posts->title?></h4>
			<div class="bg-light mb-3">Written By <a href="<?php echo URLROOT;?>/posts/user/<?php echo $posts->name."/".$posts->userId;?>">
				<?php echo $posts->name; ?></a> On <?php echo $posts->postCreated; ?></div>
			<p class="card-text"><?php echo $posts->body; ?></p>
			
			<div>
				<a href="<?php echo URLROOT;?>/posts/show/<?php echo $posts->postId;?>" class="btn btn-dark pull-right ml-2">More</a>
				<a class="btn btn-primary pull-right ml-2" href="#!" id= "likebtn<?=$posts->postId;?>" onclick="add_like(<?=$posts->postId;?>)">
					<?= ($ppl ? "Liked" : "Like");?>
				</a>
				<a href="#!" data-toggle="modal" data-target="#likesModal" class="pull-right" onclick="show_likes(<?=$posts->postId;?>)">
					<small <?=($posts->likes > 0) ? 'data-toggle="tooltip" title="View likes" data-placement="top"' : '';?> >
						<span id="post_<?=$posts->postId;?>_likes">
							<?php if ($ppl && $posts->likes == 1):?>
								You
							<?php elseif ($ppl && $posts->likes == 2):?>
								You and 1 other 
							<?php elseif ($ppl && $posts->likes > 2):?>
								You and <?= $posts->likes - 1;?> others 
							<?php else: echo $posts->likes;?>
							<?php endif;?>
						</span> like this
					</small>
				</a>
			</div>
		</div>
	</div>
	<?php endforeach; ?>

	<!-- Like Modal -->
	<div class="modal fade" id="likesModal" tabindex="-1" role="dialog" aria-labelledby="likesModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="likesModalLabel">People who like this</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					
				</div>
				<div class="modal-footer">
				</div>
			</div>
		</div>
	</div>

<?php require_once APPROOT. "/views/inc/footer.php" ?>
