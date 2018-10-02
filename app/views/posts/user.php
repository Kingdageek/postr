<?php require_once APPROOT. "/views/inc/header.php";?>
	<!-- <?php flash("post_message"); ?> -->
    <a href="<?php echo URLROOT;?>/posts" class="btn btn-light"><i class= "fa fa-backward"></i> Back To All Posts</a>
	<div class="row mb-3">
		<div class="col-md-6">
			<h1><?php echo ($data["user"]->id == $_SESSION["user_id"]) ? "Your" : $data["user"]->name . "'s";?> Posts</h1>
		</div>
		
	</div>
	<?php $i = 0;?>
	<?php foreach($data["posts"] as $posts): ?>
		<div class="card-body mb-3 p-2">
			<h4 class="card-title"><?php echo $posts->title?></h4>
			<div class="bg-light mb-3">Written By 
				<?php echo $data["user"]->name; ?> On <?php echo $posts->created_at; ?></div>
			<p class="card-text"><?php echo $posts->body; ?></p>
			<input type="hidden" id="pid<?=$i;?>" value="<?= $posts->id;?>">
			<button id="like--btn<?=$i;?>" class="btn btn-primary pull-right">
  				Like <span class="badge badge-light">4</span>
			</button>
			<a href="<?php echo URLROOT;?>/posts/show/<?php echo $posts->id;?>" class="btn btn-dark">More</a>
		</div>
	<?php $i++; ?>
	<?php endforeach; ?>
<?php require_once APPROOT. "/views/inc/footer.php";?>