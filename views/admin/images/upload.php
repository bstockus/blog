<h2>
    Upload Image
</h2>

<?php
if ($error !== "") {
?>
    <h4><?php echo $error; ?></h4>
<?php
}
?>

<form class="form-horizontal" method="POST" action="<?php echo_global_url("admin/images"); ?>" enctype="multipart/form-data">
    <div class="form-group">
        <label for="inputName" class="col-sm-2 control-label">Title</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="inputName" placeholder="Image Filename" name="image_filename">
        </div>
    </div>
    <div class="form-group">
        <label for="inputFile" class="col-sm-2 control-label">File</label>
        <div class="col-sm-10">
            <input type="file" class="form-control" id="inputFile" name="image_file">
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="image_active"> Active
                </label>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-primary">Upload</button>
            <a class="btn btn-default" href="<?php echo_global_url('admin/images'); ?>">Cancel</a>
        </div>
    </div>
</form>