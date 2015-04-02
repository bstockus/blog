<table  class="table table-condensed">
    <tr>
        <th>Filename</th>
        <th>Active?</th>
        <th></th>
    </tr>

<?php
    foreach ($images as $image) {
?>
        <tr>
            <td><strong><?php echo htmlspecialchars($image['image_filename']); ?></strong></td>
            <td>
<?php
                if ($image['image_active'] === "yes") {
                    echo "Y";
                } else {
                    echo "N";
                }
?>
            <td>
                <span class='pull-right'>
                    <a href="<?php echo_global_url('admin/images/' . $image['image_id'] . "/edit"); ?>" class="btn btn-primary btn-xs" role="button">
                        <i class="fa fa-pencil-square-o"></i> Edit
                    </a>
                    <a href="<?php echo_global_url('admin/images/' . $image['image_id'] . "/remove"); ?>" class="btn btn-danger btn-xs" role="button">
                        <i class="fa fa-trash"></i> Remove
                    </a>
                </span>
            </td>
        </tr>
<?php
    }
?>
    
</table>