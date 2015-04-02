<?php

function submitFormControl($label) {
    
return <<<EOD
<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-default">{$label}</button>
    </div>
</div>
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

?>