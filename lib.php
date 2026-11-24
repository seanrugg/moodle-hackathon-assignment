<?php
defined('MOODLE_INTERNAL') || die();

function mod_hackathon_add_instance($courseid) {
    global $DB;
    $course = $DB->get_record('course', array('id' => $courseid), '*', MUST_EXIST);
    $hackathon = new stdClass();
    $hackathon->course = $courseid;
    $hackathon->name = 'New Hackathon Assignment';
    $hackathon->slides_mandatory = 1;
    $hackathon->video_mandatory = 0;
    $hackathon->site_mandatory = 0;
    $hackathon->repo_mandatory = 0;
    return $DB->insert_record('hackathon', $hackathon);
}

function mod_hackathon_update_grades($instance) {
    // Logic for updating grades goes here.
}
