<form class="form-horizontal" method="POST" action="<?php echo_global_url($url); ?>">
    <div class="form-group <?php echo(isset($errors['image_filename']) ? "has-error" : ""); ?>">
        <label for="inputFileName" class="col-sm-2 control-label">Filename</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="inputFileName" placeholder="Image Filename" name="image_filename" value="<?php echo $image['image_filename']; ?>">
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="image_active" <?php echo($image['image_active'] === "yes" ? "checked='true'" : "") ?>> Active
                </label>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default">Save</button>
        </div>
    </div>
</form>