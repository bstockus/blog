<h2>
    Delete Image
    <small><?php echo $image['image_filename']; ?></small>
</h2>

<h4>Are you sure you want to delete the image <?php echo $image['image_filename']; ?>?</h4>

<form method="POST">
    
    <input type="hidden" name="redirect" value="<?php echo $redirect; ?>">
    <button type="submit" class="btn btn-danger">Yes</button>
    <a href="<?php echo_global_url($redirect); ?>" class="btn btn-default">No</a>

</form>