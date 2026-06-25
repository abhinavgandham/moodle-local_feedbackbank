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

require_once($CFG->dirroot . '/local/textsnippets/classes/manager.php');
require_once($CFG->dirroot . '/local/textsnippets/classes/snippet.php');

use core_external\external_api;
use core_external\external_function_parameters;
use core_external\external_multiple_structure;
use core_external\external_single_structure;
use core_external\external_value;

/**
 * External function to fetch the feedback snippets that belong to the current user.
 *
 * @package    local_textsnippets
 * @author     Abhinav Gandham <abhinavgandham@gmail.com>
 * @copyright  2026 Abhinav Gandham
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class get_snippets extends external_api {

    /**
     * Describes the parameters for execute.
     *
     * @return external_function_parameters
     */
    public static function execute_parameters(): external_function_parameters {
        return new external_function_parameters([]);
    }

    /**
     * Method that returns the list of snippets that belong to the current user.
     *
     * @return array The list of snippets that belong to the current user.
     */
    public static function execute(): array {
        self::validate_context(\context_system::instance());

        $snippets = manager::get_user_snippets();

        return array_map(fn (snippet $snippet) => [
            'id' => (int) $snippet->get('id'),
            'label' => $snippet->get('label'),
            'content' => $snippet->get('content'),
            'shared' => $snippet->is_shared(),
        ], $snippets);
    }

    /**
     * Describes the execute return value.
     *
     * @return external_multiple_structure
     */
    public static function execute_returns(): external_multiple_structure {
        return new external_multiple_structure(
            new external_single_structure([
                'id' => new external_value(PARAM_INT, 'The ID of the snippet'),
                'label' => new external_value(PARAM_TEXT, 'The label of the snippet'),
                'content' => new external_value(PARAM_RAW, 'The content of the snippet'),
                'shared' => new external_value(PARAM_BOOL, 'Whether the snippet is shared or not'),
            ])
        );
    }
}
