<form class="form-horizontal" method="POST" action="<?php echo_global_url($url); ?>">
    <?php echo textInputFormControl('image_filename', 'Filename', 'Image Filename', $image['image_filename'], $errors); ?>
    <?php echo checkboxInputFormControl('image_active', 'Active', $image['image_active']); ?>
    <?php echo submitFormControl($submit); ?>
</form>