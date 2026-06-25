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

defined('MOODLE_INTERNAL') || die();

require_once(__DIR__ . '/../../lib/formslib.php');
require_once(__DIR__ . '/classes/snippet.php');
require_once(__DIR__ . '/classes/category.php');

/**
 * Form class for creating a snippet in the feedback bank.
 *
 * @package    local_textsnippets
 * @author     Abhinav Gandham <abhinavgandham@gmail.com>
 * @copyright  2026 Abhinav Gandham
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class createsnippet_form extends \moodleform {
    /**
     * Method that defines the form elements for creating a snippet, including label, content, category, and shared status.
     */
    public function definition() {
        $mform = $this->_form;

        $mform->addElement('text', 'label', get_string('label', 'local_textsnippets'));
        $mform->setType('label', PARAM_TEXT);
        $mform->addRule('label', null, 'required', null, 'client');

        $mform->addElement('editor', 'content', get_string('content'));
        $mform->setType('content', PARAM_RAW);
        $mform->addRule('content', null, 'required', null, 'client');

        $mform->addElement('text', 'category', get_string('category'));
        $mform->setType('category', PARAM_TEXT);
        $mform->addRule('category', null, 'required', null, 'client');

        $mform->addElement('checkbox', 'shared', get_string('shared', 'local_textsnippets'));
        $mform->setType('shared', PARAM_BOOL);

        $buttonarray = [
            $mform->createElement('submit', 'submitbutton', get_string('addsnippet', 'local_textsnippets')),
            $mform->createElement('cancel', 'cancel', get_string('resetbutton', 'local_textsnippets')),
        ];
        $mform->addGroup($buttonarray, 'buttonar', '', [' '], false);
        $mform->closeHeaderBefore('buttonar');
    }
}
