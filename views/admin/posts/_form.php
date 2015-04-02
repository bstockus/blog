<form class="form-horizontal" method="POST" action="<?php echo_global_url($url); ?>">
    <?php echo textInputFormControl('post_title', 'Title', 'Post Title', $post['post_title'], $errors); ?>
    <div class="form-group">
        <label for="inputCategory" class="col-sm-2 control-label">Category</label>
        <div class="col-sm-10">
            <select class="form-control" name="category_id">
<?php
                foreach ($categories as $category) {
                    $value = $category['category_id'];
                    $name = $category['category_name'];
                    if ($category['category_id'] == $post['category_id']) {
                        echo "<option value='{$value}' selected='true'>{$name}</option>";
                    } else {
                        echo "<option value='{$value}'>{$name}</option>";
                    }
                }
?>
            </select>
        </div>
    </div>
    <?php echo textareaFormControl('post_description', 'Description', 'Post Description', 3, $post['post_description'], $errors); ?>
    <?php echo checkboxInputFormControl('post_active', 'Active', $post['post_active']); ?>
    <?php echo submitFormControl($submit); ?>
</form>