<?php
defined('MOODLE_INTERNAL') || die();

require_once('../../config.php');
require_once('lib.php');

$id = required_param('id', PARAM_INT); // Course Module ID
$cm = get_coursemodule_from_id($id, 0, 0, true);
$course = $DB->get_record('course', array('id' => $cm->course), '*', MUST_EXIST);
$hackathon = $DB->get_record('hackathon', array('id' => $cm->instance), '*', MUST_EXIST);

require_login($course);
$context = context_module::instance($cm->id);
CourseFormat::set_course_page_url($course);

$USERid = $USER->id;
$groupid = 0;
if ($hackathon->groupmode !== 0) {
    $groupid = groups_get_usergroups($USERid, $course->id)[0] ?? 0;
}

// Handle submission
if ($data = $mform->get_data()) {
    $submission = new stdClass();
    $submission->hackathonid = $hackathon->id;
    $submission->userid = $USERid;
    $submission->groupid = $groupid;
    $submission->slides_url = $data->slides_url;
    $submission->video_url = $data->video_url;
    $submission->site_url = $data->site_url;
    $submission->repo_url = $data->repo_url;
    $submission->submitted = 1;
    $submission->timecreated = time();
    $submission->timemodified = time();

    if ($DB->record_exists('hackathon_submissions', array('hackathonid' => $hackathon->id, 'userid' => $USERid))) {
        $DB->update_record('hackathon_submissions', $submission);
    } else {
        $DB->insert_record('hackathon_submissions', $submission);
    }
    redirect(new moodle_url('/mod/hackathon/view.php', array('id' => $id)), 'Submission saved');
}

// Submission form
require_once('submit_form.php');
$mform = new mod_hackathon_submit_form();
echo $OUTPUT->header();
echo $mform->display();
echo $OUTPUT->footer();
