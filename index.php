<?php
define('ABS_PATH', __DIR__);

require_once('./applicants.service.php');
$users = get_users_from_database();


$jobTitle = (isset($_GET['jobTitle'])) ? $_GET['jobTitle'] :'';
echo ''. $jobTitle .'';

$experience = (isset($_GET['experienceNeeded'])) ? $_GET['experienceNeeded'] :'';
echo ''. $experience .'';

$level = (isset($_GET['positionLevel'])) ? $_GET['positionLevel'] :'';
echo ''. $level .'';

// $users = get_users_by_level($positionLevel);
$users = get_selected_users("mid", "3", ["C#"]);
include_once(ABS_PATH . '/views/head.view.php');
include_once(ABS_PATH . '/views/welcome.view.php');
include_once(ABS_PATH . '/views/form.view.php');

foreach ($users as $applicant){
    include(ABS_PATH . '/views/applicant-summary.view.php');
}
include_once(ABS_PATH . '/views/footer.view.php');


