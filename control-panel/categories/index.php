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
$categories = $da->get_categories();

echo($pu->get_header($meta_title));
echo($pu->get_control_panel_navigation("CATEGORIES"));
echo($pu->get_content_start());
echo($pu->get_banner("Control Panel"));
?>

<h2>
    <span class='pull-right'>
        <a href='<?php echo_global_url('control-panel/categories/create.php'); ?>' class='btn btn-success btn-md' role='button'>
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
            <td><strong><?php echo $category['category_name']; ?></strong></td>
            <td>
                <span class='pull-right'>
                    <a href="<?php echo_global_url('control-panel/categories/edit.php?id=' . $category['category_id']); ?>" class="btn btn-primary btn-xs" role="button">
                        <i class="fa fa-pencil-square-o"></i> Edit
                    </a>
                    <a href="<?php echo_global_url('control-panel/categories/remove.php?id=' . $category['category_id']); ?>" class="btn btn-danger btn-xs" role="button">
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