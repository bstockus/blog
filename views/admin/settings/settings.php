<h2>
    Settings
</h2>

<h4><?php echo $flash; ?></h4>

<form class="form-horizontal" method="POST" action="<?php echo_global_url('admin/settings'); ?>">
    <?php echo textInputFormControl('notification_email_address', 'Notification Email', 'Notification Email Address', $settings['notification_email_address'], $errors); ?>
    <?php echo textareaFormControl('homepage_content', 'Homepage', 'Homepage Content', 20, $settings['homepage_content'], $errors); ?>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
</form>