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
 * Class representing a category of a snippet.
 *
 * @package    local_feedbackbank
 * @author     Abhinav Gandham <abhinavgandham@gmail.com>
 * @copyright  2026 Abhinav Gandham
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class category extends persistent {
    /** Table name for the category persistent. */
    const TABLE = 'local_feedbackbank_category';

    /**
     * Method that defines the properties of the category persistent.
     *
     * @return array The array of properties for the category persistent.
     */
    protected static function define_properties(): array {
        return [
            'userid' => ['type' => PARAM_INT],
            'name'   => ['type' => PARAM_TEXT],
            'timecreated' => ['type' => PARAM_INT, 'default' => 0],
            'timemodified' => ['type' => PARAM_INT, 'default' => 0],
        ];
    }
}
