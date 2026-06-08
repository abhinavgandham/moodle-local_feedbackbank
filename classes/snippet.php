<?php

use core\persistent;

class snippet extends persistent {
    const TABLE = 'local_feedbackbank_snippet';

    protected static function define_properties(): array {
        return [
            'userid'     => ['type' => PARAM_INT],
            'categoryid' => ['type' => PARAM_INT, 'null' => NULL_ALLOWED, 'default' => null],
            'label'      => ['type' => PARAM_TEXT],
            'content'    => ['type' => PARAM_RAW],
            'timecreated' => ['type' => PARAM_INT, 'default' => 0],
            'timemodified' => ['type' => PARAM_INT, 'default' => 0],
            'shared'     => ['type' => PARAM_INT, 'default' => 0],
        ];
    }

    public function is_shared(): bool {
        return (bool) $this->get('shared');
    }
}
