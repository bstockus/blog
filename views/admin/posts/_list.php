<table class="table table-condensed">
    <tr>
        <th>Date</th>
        <th>Title</th>
        <th>Active?</th>
        <th></th>
    </tr>

<?php
    foreach ($posts as $post) {
?>
        <tr>
            <td><?php echo $post['post_date']; ?></td>
            <td><strong><?php echo htmlspecialchars($post['post_title']); ?></strong></td>
            <td>
<?php
                if ($post['post_active'] === "yes") {
                    echo "Y";
                } else {
                    echo "N";
                }
?>
            <td>
                <span class='pull-right'>
                    <a href="<?php echo_global_url('admin/posts/' . $post['post_id'] . "/edit"); ?>" class="btn btn-primary btn-xs" role="button">
                        <i class="fa fa-pencil-square-o"></i> Edit
                    </a>
                    <a href="<?php echo_global_url('admin/posts/' . $post['post_id']. "/remove"); ?>" class="btn btn-danger btn-xs" role="button">
                        <i class="fa fa-trash"></i> Remove
                    </a>
                </span>
            </td>
        </tr>
<?php
    }
?>
    
</table>