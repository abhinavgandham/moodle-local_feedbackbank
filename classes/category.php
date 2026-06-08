<?php

use core\persistent;

class category extends persistent {
    const TABLE = 'local_feedbackbank_category';

    protected static function define_properties(): array {
        return [
            'userid' => ['type' => PARAM_INT],
            'name'   => ['type' => PARAM_TEXT],
            'timecreated' => ['type' => PARAM_INT, 'default' => 0],
            'timemodified' => ['type' => PARAM_INT, 'default' => 0],
        ];
    }
}