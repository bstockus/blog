<?php
foreach($posts as $post) {
?>
    <h4>
<?php
        if ($post['post_active'] === 'no') {
?>
            <span class='label label-danger'>INACTIVE</span> 
<?php
        }
?>
        <a href="<?php echo_global_url('blog/posts/' . $post['post_id']); ?>">
            <?php echo($post['post_title']); ?>
        </a>
    </h4>
    <p><?php echo($post['post_description']); ?></p>
    <p>
<?php
        if (isset($edits_allowed) && $edits_allowed === true) {
?>
            <span class='pull-right'>
                <a href="<?php echo_global_url('admin/posts/' . $post['post_id'] . "/edit?redirect=" . $this_url); ?>" class="btn btn-primary btn-xs" role="button">
                    <i class="fa fa-pencil-square-o"></i> Edit
                </a>
                <a href="<?php echo_global_url('admin/posts/' . $post['post_id']. "/remove?redirect=" . $this_url); ?>" class="btn btn-danger btn-xs" role="button">
                    <i class="fa fa-trash"></i> Remove
                </a>
            </span>
<?php
        }
?>
        Category: 
            <a href="<?php echo_global_url('blog/categories/' . $post['category_id']); ?>">
                <?php echo($post['category_name']); ?>
            </a>
    	| <i class="fa fa-user"></i> <a href="<?php echo_global_url('blog/users/' . $post['user_id']); ?>">
    	    <?php echo($post['user_display_name']); ?>
    	</a> 
    	| <i class="fa fa-calendar-o"></i> 
    	    <a href="<?php echo_global_url('blog/' . date('Y', strtotime($post['post_date'])) . '/' . date('m', strtotime($post['post_date']))); ?>">
    	        <?php echo(date('D d F Y', strtotime($post['post_date']))); ?>
    	    </a>
     	| <i class="fa fa-comments"></i> <a href="#">No Comments</a>
       	| <i class="fa fa-share"></i> <a href="#">No Shares</a>
    </p>
    <hr>
<?php
}
?>