<form class="form-horizontal" method="POST" action="<?php echo_global_url($url); ?>">
    <?php echo textInputFormControl('post_title', 'Title', 'Post Title', $post['post_title'], $errors); ?>
    <?php echo selectFormControl('category_id', 'Category', 'Select a Category', $categories, 'category_id', 'category_name', $post['category_id'], $errors); ?>
    <?php echo textareaFormControl('post_description', 'Description', 'Post Description', 3, $post['post_description'], $errors); ?>
    <?php echo checkboxInputFormControl('post_active', 'Active', $post['post_active']); ?>
    <?php echo textareaFormControl('post_content', 'Content', 'Post Content', 10, $post['post_content'], $errors); ?>
    <?php echo submitFormControl($submit); ?>
</form>