<?php

require_once(__DIR__ . '/../../config.php');
require_login();

$context = context_system::instance();
$PAGE->set_context($context);
$PAGE->set_url(new moodle_url('/local/feedbackbank/snippets.php'));
$PAGE->set_title("Feedback Bank");
$PAGE->set_heading("Feedback Bank");

echo $OUTPUT->header();

echo "Manage your reusable feedback snippets here.";

$table = new html_table();
$table->head = ['Label', 'Preview', 'Category', 'Visibility', 'Actions'];

echo html_writer::table($table);

echo $OUTPUT->footer();