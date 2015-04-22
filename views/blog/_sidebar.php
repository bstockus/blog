<h3>Categories</h3>

<ul class='list-unstyled sidebar-list'>
<?php
    foreach($sidebar_collections['categories'] as $category) {
        $active = false;
        if (isset($current_category_id) && $current_category_id == $category['category_id']) {
            $active = true;
?>
            <li class='active'>
<?php
        } else {
?>
            <li>
<?php
        }
?>
            <span class='pull-right'><span class='badge'>
                <?php echo $category['posts_count']; ?>
            </span></span>
<?php
        if (!$active) {
?>
            <a href="<?php echo_global_url('blog/categories/' . $category['category_id']); ?>">
<?php
        }
?>
        <?php sanitize_echo($category['category_name']); ?>
<?php
        if (!$active) {
?>
            </a>
<?php
        }
?>
        </li>
<?php
    }
?>
</ul>

<h3>Dates</h3>

<ul class='list-unstyled sidebar-list'>
<?php
    
    function extract_date_year($date) {
        return date('Y', strtotime($date['post_date']));
    }
    
    function extract_date_month($date) {
        return date('m', strtotime($date['post_date']));
    }
    
    foreach($sidebar_collections['dates'] as $date) {
        $active = false;
        if (isset($current_date) && $current_date['year'] == extract_date_year($date) && $current_date['month'] == extract_date_month($date)) {
            $active = true;
?>
            <li class='active'>
<?php
        } else {
?>
            <li>
<?php
        }
?>
        <span class='pull-right'><span class='badge'>
            <?php echo $date['posts_count']; ?>
        </span></span>
<?php
        if (!$active) {
?>
            <a href="<?php echo_global_url('blog/' . extract_date_year($date) . '/' . extract_date_month($date)); ?>">
<?php
        }
?>
        <?php echo date('F Y', strtotime($date['post_date'])); ?>
<?php
        if (!$active) {
?>
            </a>
<?php
        }
?>

        </li>
<?php
    }
?>
</ul>