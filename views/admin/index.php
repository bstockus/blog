<div class="container">
    <h1 style="font-size: 100px; margin-top: 50px;" class="text-center">Admin Control Panel</h1>
    <div class="row" style="margin-top: 50px;">
        <div class="col-md-3">
            <p class="lead">Categories</p>
            <ul class='list-unstyled'>
                <li><a href="<?php echo_global_url('admin/categories/'); ?>">List Categories</a></li>
                <li><a href="<?php echo_global_url('admin/categories/create'); ?>">Create Category</a></li>
            </ul>
        </div>
        <div class="col-md-3">
            <p class="lead">Posts</p>
            <ul class="list-unstyled">
                <li><a href="<?php echo_global_url('admin/posts/'); ?>">List Posts</a></li>
                <li><a href="<?php echo_global_url('admin/posts/create'); ?>">Create Post</a></li>
            </ul>
        </div>
        <div class="col-md-3">
            <p class="lead">Images</p>
            <ul class='list-unstyled'>
                <li><a href="<?php echo_global_url('admin/images/'); ?>">List Images</a></li>
                <li><a href="<?php echo_global_url('admin/images/create'); ?>">Upload Image</a></li>
            </ul>
        </div>
        <div class="col-md-3">
            <p class="lead">Contacts</p>
            <ul class="list-unstyled">
                <li><a href="<?php echo_global_url('admin/contacts/'); ?>">List Contacts</a></li>
            </ul>
        </div>
    </div>
</div>