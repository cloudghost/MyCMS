<?php
// Functions for use in front end


//Array iterator function index
$i = 0;
function get_header()
{
    require_once "lib/template/header.php";
}

function get_footer($addOnArr = null)
{
    global $controller;
    if (!empty($addOnArr)) {
        foreach ($addOnArr as $string) {
            $controller->view->jsListArr[count($controller->view->jsListArr)] = get_root_url() . "/assets/js/custom/" . $string;
        }
    }
    require_once "lib/template/footer.php";
}

function show_root_url()
{
    echo "http://" . $_SERVER["HTTP_HOST"];
}

function get_root_url()
{
    return "http://" . $_SERVER["HTTP_HOST"];
}

function get_sidebar($sidebarType)
{
    require_once "lib/template/sidebar_$sidebarType.php";
}

function set_title($title)
{
    cache::addCache("title", $title);
}

function get_title()
{
    echo cache::getCache("title");
}

function get_header_raw()
{
    require_once "lib/template/header_raw.php";
}

function arrayIterator($array)
{

    global $i;

    $arrayLength = count($array);
    if ($i < $arrayLength && $arrayLength !== 0) {
        $i++;
        return $array[$i - 1];
    } else if ($arrayLength === 0) {
        return "NO_RECORDS";
    } else {
        $i = 0;
        return false;
    }
}

function get_course_name($index, $lesson)
{
    global $controller;
    if (!empty($controller->view->timetableList[$index][$lesson])) {
        echo $controller->view->timetableList[$index][$lesson];
    }
}

function get_tmw_hw()
{
    global $controller;
    $result = arrayIterator($controller->view->toDueHomeworkList);

    if ($result === "NO_RECORDS") {
        echo '<tr><td colspan="5">没有作业</td></tr>';
        return 0;
    } else {
        return $result;
    }
}

function get_today_hw()
{
    global $controller;
    $result = arrayIterator($controller->view->newHomeworkList);
    if ($result === "NO_RECORDS") {
        echo '<tr><td colspan="5">没有作业</td></tr>';
        return 0;
    } else {
        return $result;
    }
}

function get_full_hw()
{
    global $controller;
    $result = arrayIterator($controller->view->allHomeworkList);
    if ($result === "NO_RECORDS") {
        echo '<tr><td colspan="5">没有作业</td>';
        return 0;
    } else {
        return $result;
    }
}

function get_hw_count()
{
    global $controller;
    echo count($controller->view->allHomeworkList);
}

function show_message()
{
    global $controller;
    $controller->view->showMessage();
}

function get_exam()
{
    global $controller;
    $result = arrayIterator($controller->view->examArr);
    if ($result === "NO_RECORDS") {
        echo "<tr></tr><td colspan='6'>没有考试</td></tr>";
        return 0;
    } else {
        return $result;
    }
}

function get_exam_count()
{
    global $controller;
    echo count($controller->view->examArr);
}

function get_calendar_list()
{
    global $controller;
    $result = arrayIterator($controller->view->calendarArr);
    return $result;
}

/*
 * used for retrieving information for PC sized screens.
 */
function get_course_name_manual($day, $lesson)
{
    global $controller;
    if (!empty($controller->view->timetableArr[$day][$lesson])) {
        echo $controller->view->timetableArr[$day][$lesson];;
    }
}

function get_course_count($course_arr)
{
    $count=0;
    foreach($course_arr as $day){
        foreach($day as $course){
            $count++;
        } 
    }
    return $count;
}

function get_course_name_by_day()
{
    global $controller;
    return arrayIterator($controller->view->timetableArr);
}

function extract_course_name($data, $lesson)
{
    if (!empty($data[$lesson])) {
        echo $data[$lesson];
    }
}

function get_js_list()
{
    global $controller;
    foreach ($controller->view->jsListArr as $urlString) {
        echo "<script src=\"$urlString\"></script>";
    }
}

function get_eca_list()
{
    $row = arrayIterator(cache::getCache("eca_list"));
    if (!empty($row) && $row !== "NO_RECORDS") {
        return $row;
    } else if ($row === "NO_RECORDS") {
        echo
        '<div class="am-cf am-padding">
            <div class="am-fl am-cf"><span class="am-badge am-badge-warning am-text-xl">没有找到相关ECA</span>
            </div>
        </div>';
        return false;
    } else {
        return false;
    }
}

function get_eca_leader()
{
    $ecaMembers = cache::getCache("members");
    foreach ($ecaMembers as $value) {
        if ($value["role"] === "owner") {
            return $value["user_eName"] . " ". $value["user_cName"] . " " . $value["user_sid"];
        }
    }

}

function get_eca_member_count()
{
    return count(cache::getCache("members"));
}

function get_eca_register_date()
{
    $theDate = new DateTime(cache::getCache("eca_register_date"));
    return $theDate->format("Y-m-d");

}
/*
function is_user_eca_leader($sid = null)
{
    if ($sid == null) {
        $sid = $_SESSION["user"]["sidRaw"];
    }
    $ownerSid = cache::getCache("eca_owner_sid");
    if ($sid == $ownerSid) {
        return 1;
    } else {
        return 0;
    }
}

function is_user_eca_admin($sid = null)
{
    if ($sid == null) {
        $sid = $_SESSION["user"]["sidRaw"];
    }
    $ecaMembers = cache::getCache("members");
    foreach ($ecaMembers as $member) {
        if ($member["user_sid"] == $sid) {
            if ($member["role"] === "admin") {
                return 1;
            } else {
                return 0;
            }
        } else {
            return 0;
        }
    }
}

function is_user_admin_or_leader($sid = null)
{
    if (is_user_eca_leader($sid) || is_user_eca_admin($sid)) {
        return 1;
    } else {
        return 0;
    }
}
*/
function get_user_male_percentage()
{
    $ecaMembers = cache::getCache("members");
    $totalCount = count($ecaMembers);
    $mCount = 0;
    foreach ($ecaMembers as $member) {
        if ($member["user_gender"] === "m") {
            $mCount += 1;
        }
    }
    return $mCount / $totalCount * 100;
}

function get_user_female_percentage()
{
    $ecaMembers = cache::getCache("members");
    $totalCount = count($ecaMembers);
    $fCount = 0;
    foreach ($ecaMembers as $member) {
        if ($member["user_gender"] === "f") {
            $fCount += 1;
        }
    }
    return $fCount / $totalCount * 100;
}

function get_user_uknown_percentage()
{
    $ecaMembers = cache::getCache("members");
    $totalCount = count($ecaMembers);
    $nCount = 0;
    foreach ($ecaMembers as $member) {
        if ($member["user_gender"] === "n") {
            $nCount += 1;
        }
    }
    return $nCount / $totalCount * 100;
}

function get_member_year_count($year)
{
    $ecaMembers = cache::getCache("members");
    $count = 0;
    foreach ($ecaMembers as $member) {
        if ($member["user_year"] === $year) {
            $count++;
        }
    }
    return $count;
}

function get_eca_members()
{
    return arrayIterator(cache::getCache("members"));
}

function is_member_current_user($sid)
{
    if ($sid == $_SESSION["user"]["sidRaw"]) {
        return 1;
    } else {
        return 0;
    }
}

function is_user_member_view()
{
    $members = cache::getCache("members");
    $return = false;
    foreach ($members as $member) {
        if ($member["user_sid"] == $_SESSION["user"]["sidRaw"]) {
            $return = true;
        }
    }
    return $return;
}

function is_user_member_list($ecaId)
{
    $return = false;
    foreach (cache::getCache("user_joined_eca") as $ecaList) {
        if ($ecaList[0] == $ecaId) {
            $return = true;
        }
    }
    return $return;
}

function get_user_joined_eca()
{
    $eca = arrayIterator(cache::getCache("userEcaList"));
    if ($eca !== "NO_RECORDS") {
        return $eca;
    } else {
        echo
        <<<EOT
        <div class='am-panel am-panel-default'>
            <div class='am-panel-bd'>
                <span class='am-text-xl am-badge am-badge-warning'>  你还没有加入任何ECA</span>
            </div>
        </div>
EOT;
    }
}

function get_news_list()
{
    $row = arrayIterator(cache::getCache("news_list"));
    if (!empty($row) && $row !== "NO_RECORDS") {
        return $row;
    } else if (($row === "NO_RECORDS") || !(cache::getCache("news_list"))) {
        echo '<div class="am-cf am-padding">
            <div class="am-fl am-cf"><span class="am-badge am-badge-secondary am-text-xl">没有新闻</span>
            </div>
        </div>';
        return false;
    } else {
        return false;
    }
}

function get_today_news()
{
    $beginToday = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
    $sql = "SELECT `news_id` FROM `news` WHERE `news_submit_time`>='{$beginToday}'";
    require_once "lib/db/database.class.php";
    database::connect();
    $arr = database::queryAndArray($sql);
    return isset($arr) ? count($arr) : 0;
}

function get_new_post()
{
    require_once "lib/db/database.class.php";
    database::connect();
    $sid = database::sanitize($_SESSION["user"]["sidRaw"]);
    $sql = "SELECT count(*) FROM `noticetouser` WHERE `user_sid`='{$sid}'";
    $arr = database::queryAndOne($sql);
    return !empty($arr) ? $arr[0] : false;
}/*
function get_post_list()
{
    $row2 = arrayIterator(cache::getCache("post_list"));
    if (!empty($row2) && $row2 !== "NO_RECORDS") {
        return $row2;
    } else if (($row2 === "NO_RECORDS") || !(cache::getCache("post_list"))) {
        return false;
    } else {
        return false;
    }
}*/
function get_new_post_list()
{
    $row = arrayIterator(cache::getCache("new_post_list"));
    if (!empty($row) && $row !== "NO_RECORDS") {
        return $row;
    } else if (($row === "NO_RECORDS") || !(cache::getCache("new_post_list"))) {
        return false;
    } else {
        return false;
    }
}
function get_attendance_list()
{
    $row = arrayIterator(cache::getCache("attendance"));
    if (!empty($row) && $row !== "NO_RECORDS") {
        return $row;
    } else if (($row === "NO_RECORDS") || !(cache::getCache("post_list"))) {
        return false;
    } else {
        return false;
    }
}
function get_attended($att)
{
	$count=0;
    foreach($att as $val){
		if($val==1){
			++$count;
		}
	}
	return $count;
}