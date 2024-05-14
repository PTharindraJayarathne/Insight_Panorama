<?php

    function show_validation_error($validation, $field) {
        if ($validation->hasError($field)) {
            return $validation->getError($field);
        }
        else {
            return false;
        }
    }

?>