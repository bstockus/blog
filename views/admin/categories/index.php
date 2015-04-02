<h2>
    <span class='pull-right'>
        <a href='<?php echo_global_url('admin/categories/create'); ?>' class='btn btn-success btn-md' role='button'>
            <i class='fa fa-plus'></i> Category
        </a>
    </span>
    Categories
</h2>

<table  class="table table-condensed">
    <tr>
        <th>Category</th>
        <th></th>
    </tr>

<?php
    foreach ($categories as $category) {
?>
        <tr>
            <td><strong><?php echo htmlspecialchars($category['category_name']); ?></strong></td>
            <td>
                <span class='pull-right'>
                    <a href="<?php echo_global_url('admin/categories/' . $category['category_id'] . "/edit"); ?>" class="btn btn-primary btn-xs" role="button">
                        <i class="fa fa-pencil-square-o"></i> Edit
                    </a>
                    <a href="<?php echo_global_url('admin/categories/' . $category['category_id'] . "/remove"); ?>" class="btn btn-danger btn-xs" role="button">
                        <i class="fa fa-trash"></i> Remove
                    </a>
                </span>
            </td>
        </tr>
<?php
    }
?>
    
</table>