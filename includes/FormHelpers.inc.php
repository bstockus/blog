<?php

function submitFormControl($label, $redirect_url) {
    
return <<<EOD
<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-primary">{$label}</button>
        <a class="btn btn-default" href="{$redirect_url}">Cancel</a>
    </div>
</div>
EOD;

}

function hiddenInputFormControl($id, $value) {
return <<<EOD
<input type="hidden" name="{$id}" value="{$value}">
EOD;
}

function textInputFormControl($id, $label, $placeholder, $value, $errors) {
    
    $valid = isset($errors[$id]);
    $validation_class = $valid ? "has-error" : "";
    
    $validation_message = "";
    if ($valid) {
        $validation_message = "<p class='text-danger'>{$errors[$id]}</p>";
    }
    
return <<<EOD
<div class="form-group {$validation_class}">
    <label for="input-{$id}" class="col-sm-2 control-label">{$label}</label>
    <div class="col-sm-10">
        <input type="text" class="form-control" id="input-{$id}" placeholder="{$placeholder}" name="{$id}" value="{$value}">
        {$validation_message}
    </div>
    
</div>
EOD;
    
}

function textareaFormControl($id, $label, $placeholder, $rows, $value, $errors) {
    
    $valid = isset($errors[$id]);
    $validation_class = $valid ? "has-error" : "";
    
    $validation_message = "";
    if ($valid) {
        $validation_message = "<p class='text-danger'>{$errors[$id]}</p>";
    }
    
return <<<EOD
<div class="form-group {$validation_class}">
    <label for="input-{$id}" class="col-sm-2 control-label">{$label}</label>
    <div class="col-sm-10">
        <textarea class="form-control" id="input-{$id}" name="{$id}" placeholder="{$placeholder}" rows="{$rows}">{$value}</textarea>
        {$validation_message}
    </div>
    
</div>
EOD;
    
}

function checkboxInputFormControl($id, $label, $value) {
    
    $checked = $value === "yes" ? "checked='true'" : "";
    
return <<<EOD
<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        <div class="checkbox">
            <label>
                <input type="checkbox" name="{$id}" {$checked}> {$label}
            </label>
        </div>
    </div>
</div>
EOD;

}

function selectFormControl($id, $label, $placeholder, $items, $value_key, $label_key, $selected_value, $errors) {
    
    $valid = isset($errors[$id]);
    $validation_class = $valid ? "has-error" : "";
    
    $validation_message = "";
    if ($valid) {
        $validation_message = "<p class='text-danger'>{$errors[$id]}</p>";
    }
    
?>

    <div class="form-group <?php echo $validation_class; ?>">
        <label for="input-<?php echo $id; ?>" class="col-sm-2 control-label"><?php echo $label; ?></label>
        <div class="col-sm-10">
            <select class="form-control" name="<?php echo $id; ?>">
<?php
                if ($selected_value === null || $selected_value === "") {
                    echo "<option value='' selected='true'>{$placeholder}</option>";
                }
                foreach ($items as $item) {
                    $value = $item[$value_key];
                    $label = $item[$label_key];
                    if ($selected_value !== null && $selected_value !== "" && $item[$value_key] == $selected_value) {
                        echo "<option value='{$value}' selected='true'>{$label}</option>";
                    } else {
                        echo "<option value='{$value}'>{$label}</option>";
                    }
                }
?>
            </select>
            <?php echo $validation_message; ?>
        </div>
    </div>

<?php
    
}