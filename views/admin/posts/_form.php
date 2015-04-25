<form class="form-horizontal" method="POST" action="<?php echo_global_url($url); ?>">
    <?php echo hiddenInputFormControl('redirect', $redirect); ?>
    <?php echo textInputFormControl('post_title', 'Title', 'Post Title', $post['post_title'], $errors); ?>
    <?php echo textInputFormControl('post_short_title', 'Short Title', 'Post Short Title', $post['post_short_title'], $errors); ?>
    <?php echo selectFormControl('category_id', 'Category', 'Select a Category', $categories, 'category_id', 'category_name', $post['category_id'], $errors); ?>
    <?php echo textareaFormControl('post_description', 'Description', 'Post Description', 3, $post['post_description'], $errors); ?>
    <?php echo checkboxInputFormControl('post_active', 'Active', $post['post_active']); ?>
    <?php echo selectFormControl('post_type', 'Type', 'Select a Type', array(array('name'=>"HTML", 'value'=>"html"), array('name'=>"MarkDown", 'value'=>"markdown")), 'value', 'name', $post['post_type'], $errors); ?>
    <?php echo textareaFormControl('post_content', 'Content', 'Post Content', 10, $post['post_content'], $errors); ?>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <span class='pull-right'>
                <button class="btn btn-info" id="btn-insert-image">Insert Image</button>
            </span>
            <button type="submit" class="btn btn-primary"><?php echo $submit; ?></button>
            <a class="btn btn-default" href="<?php echo_global_url($redirect); ?>">Cancel</a>
        </div>
    </div>
</form>