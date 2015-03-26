<h2>
    Create Category
</h2>

<form class="form-horizontal" method="POST" action="<?php echo_global_url("admin/categories"); ?>">
  <div class="form-group <?php echo(isset($errors['category_name']) ? "has-error" : ""); ?>">
    <label for="inputName" class="col-sm-2 control-label">Name</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="inputName" placeholder="Category Name" name="category_name" value="<?php echo $category['category_name']; ?>">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-default">Save</button>
    </div>
  </div>
</form>