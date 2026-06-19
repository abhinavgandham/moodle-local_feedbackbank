<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

use core\persistent;

/**
 * Snippet class representing a reusable feedback snippet.
 *
 * @package local_feedbackbank
 * @author Abhinav Gandham <abhinavgandham@gmail.com>
 * @copyright 2026 Abhinav Gandham
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class snippet extends persistent {
    /** Table name for the snippet persistent. */
    const TABLE = 'local_feedbackbank_snippet';

    /**
     * Method that defines the properties of the snippet persistent.
     *
     * @return array The array of properties for the snippet persistent.
     */
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

    /**
     * Method that checks if the snippet is shared or not.
     *
     * @return bool True if the snippet is shared, false otherwise.
     */
    public function is_shared(): bool {
        return (bool) $this->get('shared');
    }
}
