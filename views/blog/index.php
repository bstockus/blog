<h2>
    Blog
</h2>

<div class='row'>
    
    <div class='col-md-9'>

<?php
        foreach($posts as $post) {
?>
            <h4>
                <a href="<?php echo_global_url('blog/posts/' . $post['post_id']); ?>">
                    <?php echo($post['post_title']); ?>
                </a>
            </h4>
            <p><?php echo($post['post_description']); ?></p>
            <p>
                Category: 
                <span class="label label-info">
                    <a href="<?php echo_global_url('blog/categories/' . $post['category_id']); ?>">
                        <?php echo($post['category_name']); ?>
                    </a>
                </span>
            	| <i class="fa fa-user"></i> <a href="<?php echo_global_url('blog/users/' . $post['user_id']); ?>">
            	    <?php echo($post['user_display_name']); ?>
            	</a> 
            	| <i class="fa fa-calendar-o"></i> <?php echo(date('D d F Y', strtotime($post['post_date']))); ?>
             	| <i class="fa fa-comments"></i> <a href="#">No Comments</a>
               	| <i class="fa fa-share"></i> <a href="#">No Shares</a>
            </p>
<?php
        }
?>
        
    </div>
    
    <div class='col-md-3'>
        
        <h3>Categories</h3>
        
        <ul class='list-unstyled'>
<?php
            foreach($categories as $category) {
?>
                <li>
                    <a href="<?php echo_global_url('blog/categories/' . $category['category_id']); ?>">
                        <?php echo $category['category_name']; ?>
                    </a>
                </li>
<?php
            }
?>
        </ul>
        
    </div>
    
</div>