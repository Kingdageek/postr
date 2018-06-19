<?php require_once APPROOT. "/views/inc/header.php";?>
	<!-- <?php flash("post_message"); ?> -->
    <a href="<?php echo URLROOT;?>/posts" class="btn btn-light"><i class= "fa fa-backward"></i> Back To All Posts</a>
	<div class="row mb-3">
		<div class="col-md-6">
			<h1><?php echo ($data["user"]->id == $_SESSION["user_id"]) ? "Your" : $data["user"]->name . "'s";?> Posts</h1>
		</div>
		<!-- <div class="col-md-6">
			<a href="<?php echo URLROOT; ?>/posts/add" class="btn btn-primary pull-right">
				<i class="fa fa-pencil"></i> Add Post
			</a>
		</div> -->
	</div>
	<?php foreach($data["posts"] as $posts): ?>
		<div class="card-body mb-3 p-2">
			<h4 class="card-title"><?php echo $posts->title?></h4>
			<div class="bg-light mb-3">Written By 
				<?php echo $data["user"]->name; ?> On <?php echo $posts->created_at; ?></div>
			<p class="card-text"><?php echo $posts->body; ?></p>
			<a class="btn btn-primary pull-right" href="<?php echo URLROOT;?>/posts/like/<?php echo $posts->id;?>">
  				Likes <span class="badge badge-light">4</span>
			</a>
			<a href="<?php echo URLROOT;?>/posts/show/<?php echo $posts->id;?>" class="btn btn-dark">More</a>
		</div>
	<?php endforeach; ?>
<?php require_once APPROOT. "/views/inc/footer.php";?>
