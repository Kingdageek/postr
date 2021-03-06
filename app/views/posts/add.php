<?php require_once APPROOT. "/views/inc/header.php" ?>
      <a href="<?php echo URLROOT;?>/posts" class="btn btn-light"><i class= "fa fa-backward"></i> Back</a>
      <div class="card card-body bg-light mt-5">
       
        <h2>Add Post</h2>
        <p>Create a post below</p>
        <form class="" action="<?php echo URLROOT; ?>/posts/add" method="post">
          <div class="form-group">
          	<label for="title">Post Title:<sup> *</sup></label>
          	<input type="text" name="title" class="form-control form-control-lg 
          	<?php echo (!empty($data['title_err']) ? 'is_invalid' : ''); ?>" value= "<?php echo $data['title'];?>">
          	<span class="invalid-feedback"><?php echo $data['title_err'];?></span>
          </div>

          <div class="form-group">
          	<label for="body">Body:<sup> *</sup></label>
          	<textarea name="body" class="form-control form-control-lg 
          	<?php echo (!empty($data['body_err']) ? 'is_invalid' : ''); ?>" id="body">
              <?php echo $data['body'];?>
            </textarea>
          	<span class="invalid-feedback"><?php echo $data['body_err'];?></span>
          </div>          
          <input type="submit" class="btn btn-success" value="Create Post"></input>          	
        </form>
    </div>
<?php require_once APPROOT. "/views/inc/footer.php" ?>