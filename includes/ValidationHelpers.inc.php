<?php

function validateNotEmptyAndMaxLength($paramValid, $object, $fieldName, &$errors, $name, $maxLength) {
    $valid = $paramValid;
    if ($object[$fieldName] === "") {
        $valid = false;
        $errors[$fieldName] = "{$name} can't be empty.";
    } else if (strlen($object[$fieldName]) > $maxLength) {
        $valid = false;
        $errors[$fieldName] = "{$name} can't be longer than {$maxLength} characters in length.";
    }
    return $valid;
}

function validateNotEmpty($paramValid, $object, $fieldName, &$errors, $name) {
    $valid = $paramValid;
    if ($object[$fieldName] === "") {
        $valid = false;
        $errors[$fieldName] = "{$name} can't be empty.";
    }
    return $valid;
}