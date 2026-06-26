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

/**
 * Class representing the table containing the feedback snippets.
 *
 * @package    local_textsnippets
 * @author     Abhinav Gandham <abhinavgandham@gmail.com>
 * @copyright  2026 Abhinav Gandham
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class snippet_table extends \html_table {
    /**
     * Initialises the snippet table with empty snippets and categories.
     *
     * @param array $snippets The array of snippets.
     * @param array $categories The array of categories.
     */
    public function __construct(
        /** @var array The array of snippets. */
        public array $snippets = [],
        /** @var array The array of categories. */
        public array $categories = []
    ) {
    }

    /**
     * Method that fetches the user's snippets from the database and populates the snippets array.
     */
    private function get_snippets() {
        global $USER;
        $this->snippets = snippet::get_records(['userid' => $USER->id]);
    }

    /**
     * Method that fetches the user's categories from the database and populates the categories array.
     */
    private function get_categories() {
        global $USER;
        foreach (category::get_records(['userid' => $USER->id]) as $category) {
            $this->categories[$category->get('id')] = $category->get('name');
        }
    }

    /**
     * Method that renders the snippet table with the user's snippets with their categories and other data.
     */
    public function render() {
         self::get_snippets();
         self::get_categories();
         $this->head = [
             get_string('label', 'local_textsnippets'),
             get_string('preview'),
             get_string('category'),
             get_string('actions'),
         ];

         foreach ($this->snippets as $snippet) {
             $categoryid = $snippet->get('categoryid');

             $deleteurl = new moodle_url(
                 '/local/textsnippets/snippets.php',
                 ['action' => 'delete',
                 'id' => $snippet->get('id'),
                 'sesskey' => sesskey()]
             );

             $deletelink = html_writer::link($deleteurl, get_string('delete'), ['class' => 'btn btn-sm btn-danger']);

             $this->data[] = [
                $snippet->get('label'),
                shorten_text(format_text($snippet->get('content'), FORMAT_HTML), 100),
                $this->categories[$categoryid] ?? get_string('uncategorised', 'local_textsnippets'),
                $deletelink,
             ];
         }

         echo html_writer::table($this);
    }
}
