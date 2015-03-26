<h2>
    Create Post
</h2>

<form class="form-horizontal" method="POST" action="<?php echo_global_url("admin/posts"); ?>">
    <div class="form-group <?php echo(isset($errors['post_title']) ? "has-error" : ""); ?>">
        <label for="inputTitle" class="col-sm-2 control-label">Title</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="inputTitle" placeholder="Post Title" name="post_title" value="<?php echo $post['post_title']; ?>">
        </div>
    </div>
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
    <div class="form-group <?php echo(isset($errors['post_description']) ? "has-error" : ""); ?>">
        <label for="inputDescription" class="col-sm-2 control-label">Description</label>
        <div class="col-sm-10">
            <textarea class="form-control" name="post_description" placeholder="Post Description" rows="3"><?php echo $post['post_description']; ?></textarea>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="post_active" <?php echo($post['post_active'] === "yes" ? "checked='true'" : "") ?>> Active
                </label>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default">Save</button>
        </div>
    </div>
</form>