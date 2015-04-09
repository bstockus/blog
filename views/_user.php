<?php

$au = new AdminUtils();
$user = "";

if ($au->user_authenticated()) {
?>

<li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class='fa fa-user'></i> <?php echo $_SESSION['user_display_name']; ?> <span class="caret"></span></a>
    <ul class="dropdown-menu" role="menu">
        <li><a href="<?php echo_global_url('logout?redirect=/'); ?>">Logout</a></li>
<?php
        if ($navbar === 'control-panel') {
?>
            <li><a href="<?php echo_global_url(''); ?>">Site</a></li>
<?php
        } else {
?>
            <li><a href="<?php echo_global_url('admin'); ?>">Control Panel</a></li>
<?php
        }
?>
    </ul>
</li>
<?php
}
?>