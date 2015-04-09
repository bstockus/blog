<form class="form-horizontal" method="POST" action="<?php echo_global_url($url); ?>">
  <?php echo textInputFormControl('category_name', 'Name', 'Category Name', $category['category_name'], $errors); ?>
  <?php echo submitFormControl($submit, global_url($redirect)); ?>
</form>