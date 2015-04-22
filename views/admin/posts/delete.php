<h2>
    Delete Post
    <small><?php echo $post['post_title']; ?></small>
</h2>

<h4>Are you sure you want to delete the post <?php echo $post['post_title']; ?>?</h4>

<form method="POST">
    
    <input type="hidden" name="redirect" value="<?php echo $redirect; ?>">
    <button type="submit" class="btn btn-danger">Yes</button>
    <a href="<?php echo_global_url($redirect); ?>" class="btn btn-default">No</a>

</form>