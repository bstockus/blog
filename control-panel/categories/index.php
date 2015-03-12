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
echo($pu->get_banner("Categories"));
echo($pu->get_control_panel_navigation("CATEGORIES"));

echo($pu->get_content_start());

?>

<a href="<?php echo_global_url('/control-panel/categories/create.php'); ?>">Create Category</a>

<table border="1">
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
                <a href="<?php echo_global_url('/control-panel/categories/edit.php?id=' . $category['category_id']); ?>">Edit</a>
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