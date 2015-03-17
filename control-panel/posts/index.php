<?php
include("../../includes/common.inc.php");
require_once("../../includes/DataAccess.inc.php");
require_once("../../includes/PageUtils.inc.php");
require_once("../../includes/AdminUtils.inc.php");

// Make sure the user has been authenticated to view this page!
$au = new AdminUtils();
$au->user_authenticated(true);

$pu = new PageUtils();
$meta_title = "Categories";

$da = new DataAccess($link);
$posts = $da->get_posts();

echo($pu->get_header($meta_title));
echo($pu->get_control_panel_navigation("POSTS"));
echo($pu->get_content_start());
echo($pu->get_banner("Control Panel"));
?>

<h2>
    <span class='pull-right'>
        <a href='<?php echo_global_url('control-panel/posts/create.php'); ?>' class='btn btn-success btn-md' role='button'>
            <i class='fa fa-plus'></i> Post
        </a>
    </span>
    Posts
</h2>

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
            <td><strong><?php echo $post['post_title']; ?></strong></td>
            <td>
<?php
                if ($post['post_active'] === true) {
                    echo "Y";
                } else {
                    echo "N";
                }
?>
            <td>
                <span class='pull-right'>
                    <a href="<?php echo_global_url('control-panel/posts/edit.php?id=' . $post['post_id']); ?>" class="btn btn-primary btn-xs" role="button">
                        <i class="fa fa-pencil-square-o"></i> Edit
                    </a>
                    <a href="<?php echo_global_url('control-panel/posts/remove.php?id=' . $post['post_id']); ?>" class="btn btn-danger btn-xs" role="button">
                        <i class="fa fa-trash"></i> Remove
                    </a>
                </span>
            </td>
        </tr>
<?php
    }
?>
    
</table>
<?php

echo($pu->get_content_end());

echo($pu->get_footer());

?>