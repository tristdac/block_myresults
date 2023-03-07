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
 * MYRESULTS BLOCK
 *
 * @package    block_myresults
 * @copyright  2017 Tristan daCosta
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
if (!$DB_DEBUG) {
    // Include config.php
    require_once('../../config.php');
    // require_once(dirname(__FILE__) . '/../../config.php');

    // Set page context
    $PAGE->set_context(context_system::instance());

    // Fetch context
    $context = \context_system::instance();
}

  
$DB_DEBUG = get_config('block_myresults', 'debugdb');

$debug = '<div class="card card-block" style="margin-top:70px;margin: 2rem;"><h3>MyResults Debugging Info</h3>';

        if (strpos($USER->username, 'ec') !== false) {
            $config = get_config('block_myresults');

            // $config->show_ga_codes = explode(',', $config->show_ga);
            $hasresults = '';
            $gradeitems = '';
            if (!$config->dbport) {
                $config->dbport = '3306';
            }

            $debug .= '<p><strong>Saved settings:</strong></br>';
            $debug .= 'DB HOST: '.$config->dbhost.'</br>';
            $debug .= 'DB PORT: '.$config->dbport.'</br>';
            $debug .= 'DB NAME: '.$config->dbname.'</br>';
            $debug .= 'DB TABLE: '.$config->dbtable.'</br>';
            $debug .= 'DB USER: '.$config->dbuser.'</br>';
            // $debug .= 'GROUP AWARDS TO SHOW: '.$config->show_ga.'</br>';
            $debug .= '</p>';

            $courselookup = 'SELECT MatricNo, CoursePeriodCode AS CPC, CoursePeriodTitle, CourseOutcomeCode, sub_type, Session, SubjectWithdrawDate FROM '.$config->dbtable.' WHERE MatricNo = "'.$USER->username.'" GROUP BY CPC ORDER BY Session DESC, SubjectWithdrawDate ASC';
            $link = mysqli_connect($config->dbhost,$config->dbuser,$config->dbpass,$config->dbname,$config->dbport);

            if (!$link) {
                $gradeitems .= 'Oops... we&#39;re having trouble retrieving results at the moment. Please try again later. If the problem persists, please contact your system administrator. <span style="opacity:0.5;">' . mysqli_connect_errno().'</p>';
            }
            else {
                $cpresults_raw = mysqli_query($link, $courselookup);
            if (mysqli_error($link)) {
                $gradeitems .= 'Oops... we&#39;re having trouble retrieving results at the moment. Please try again later. If the problem persists, please contact your system administrator. <span style="opacity:0.5;">' . mysqli_errno($link).'</p>';
            }
            $cpresults = array();
            while($row1 = mysqli_fetch_array($cpresults_raw)){
                    $cpresults[] = $row1;
            }

            // DEBUG
            $debug .= '<p><strong>DB Connection</strong></br>';
            if (!$link) {
                $debug .= 'Connect Error ('. mysqli_connect_errno() . ') ' . mysqli_connect_error(). "\n";
            } else {
                $debug .= 'Connected... ' . mysqli_get_host_info($link) . "\n";
            }
            $debug .= '</p>';

            $debug .= '<p><strong>Course SQL</strong></br>';
            $debug .= '$courselookup: <textarea rows = "5" cols = "100" style="display: block;">'.$courselookup.'</textarea></br>';
            if (!mysqli_query($link, $courselookup)) {
                $debug .= 'Error: '. mysqli_error($link);
            } else {
                $debug .= 'Success</br>';
                $debug .= 'Resulting Row Info: <textarea rows = "5" cols = "100" style="display: block;">'.print_r($cpresults_raw, true).'</textarea></br>';
                if ($cpresults) {
                    $debug .= 'Query Output (after fetch_array): <textarea rows = "5" cols = "100" style="display: block;">'.print_r($cpresults, TRUE).'</textarea></br>';
                } else {
                    $debug .= 'empty - no result';
                }
            }
        
            if (!empty($cpresults)) {

                $gradeitems .= '<div id="candidate"><h4>Candidate Details</h4><br>Results recorded by Edinburgh College for '.$USER->firstname.' '.$USER->lastname.'</span></div>';
                // $gradeitems .= $intro;
                $gradeitems .= '<div id="help" class="modal fade" role="dialog" aria-hidden="true" style="display: none;"><div class="modal-dialog"><div class="modal-content"><div class="modal-header" style="background-color:'.get_config('block_myresults', 'modalbg').';"><button type="button" class="closing" data-dismiss="modal">×</button><h4 class="modal-title" style="margin:10px;color:#fff;"><i class="fa '.get_config('block_myresults', 'fa_icon').'"></i> '.get_string('understanding_heading', 'block_myresults').'</h4></div><div class="modal-body">'.get_string('understanding_content', 'block_myresults').'</div><div class="modal-footer"><button type="button" class="btn btn-default" data-dismiss="modal">Close</button></div></div></div></div>';

                $gradeitems .= '<div id="accordion">
                                    <div class="card">';

                $i = 1;
                foreach ($cpresults as $cpresult) {
                    $cpcode = str_replace("/","-",$cpresult['CPC']);
                    $outcomecode = $cpresult['CourseOutcomeCode'];
                    $outcome_date_eu = str_replace("/","-",$cpresult['SubjectWithdrawDate']);
                    $outcomedate = strtotime($outcome_date_eu);
                    $today = strtotime('now');
                    if ($outcomedate > $today) {
                        $outcome = 'inprogress';
                    }
                    else {
                        if (!$outcomecode) {
                            $outcomecode = 0;
                        }
                        $outcome = 'other'; 
                        if ($outcomecode == 1) {
                            $outcome = 'notattended';
                        }        
                        if (($outcomecode > 1) && ($outcomecode < 5) || ($outcomecode == 10)) { 
                            $outcome = 'withdrawn';
                        }
                        if ($outcomecode == 5) {
                            $outcome = 'transferred';
                        }
                        if ($outcomecode == 7) {
                            $outcome = 'unsuccessful';
                        }
                        if ($outcomecode == 8) {
                            $outcome = 'passed';
                        }
                        if ($outcomecode == 14) {
                            $outcome = 'completed';
                        }
                        if (($outcomecode == 17) || ($outcomecode == 18)) {
                            $outcome = 'progressed';
                        }
                        if ($outcomecode == 20) {
                            $outcome = 'notprogressed';
                        }
                        if ($outcomecode == 22) {
                            $outcome = 'firstyear';
                        }
                        if (($outcomecode == 23) || ($outcomecode == 24)) {
                            $outcome = 'unknown';
                        }
                    }

                    // if (!in_array($cpresult["CPC"], $config->show_ga_codes)) {
                    //     $sqlmod = "SELECT SubjectCode, SubjectName, Pass, PassCode, SubjectWithdrawDate, Result, Level FROM ".$config->dbtable." 
                    //     WHERE MatricNo = '".$USER->username."' AND CoursePeriodCode = '".$cpresult['CPC']."' AND sub_type NOT LIKE 'GA' AND SubjectName NOT LIKE '%attendance only%' AND EnrolmentStatus NOT IN ('Pending','For Deletion', 'Pre-Enrolled Conditional', 'Pre-Enrolled Unconditional') AND (EnrolmentStatus NOT LIKE 'Cancelled%' OR EnrolmentStatus IS NULL) ORDER BY Result DESC, SubjectName ASC";
                    // }
                    // if (in_array($cpresult["CPC"], $config->show_ga_codes)) {
                        $sqlmod = "SELECT SubjectCode, SubjectName, sub_type, Pass, PassCode, SubjectWithdrawDate, Result, Level FROM ".$config->dbtable." 
                        WHERE MatricNo = '".$USER->username."' AND CoursePeriodCode = '".$cpresult['CPC']."' AND SubjectName NOT LIKE '%attendance only%' AND EnrolmentStatus NOT IN ('Pending','For Deletion', 'Pre-Enrolled Conditional', 'Pre-Enrolled Unconditional') AND (EnrolmentStatus NOT LIKE 'Cancelled%' OR EnrolmentStatus IS NULL) ORDER BY FIELD(sub_type, 'GA') DESC, Result DESC, SubjectName ASC";
                    // }
                    $moduleresults_raw = mysqli_query($link, $sqlmod);
                    if (mysqli_error($link)) {
                        $gradeitems .= 'Oops... we&#39;re having trouble retrieving results at the moment. Please try again later. If the problem persists, please contact your system administrator. <span style="opacity:0.5;">' . mysqli_errno($link).'</p>';
                        if (!$DB_DEBUG) {
                            continue;
                        }
                    }
                    $moduleresults = array();
                    while($row = mysqli_fetch_array($moduleresults_raw)){
                        $moduleresults[] = $row;
                    }
                    if ($moduleresults_raw->num_rows > 0){
                        $showmore = 'yes';
                    }
                    else {
                        $showmore = 'no';
                    }

                    $debug .= '<p><strong>Module SQL '.$i.' - '.$cpresult['CPC'].'</strong></br>';
                    $debug .= '$sqlmod: <textarea rows = "5" cols = "100" style="display: block;">'.$sqlmod.'</textarea></br>';
                    if (!mysqli_query($link, $sqlmod)) {
                        $debug .= 'Error: '. mysqli_error($link);
                    } else {
                        $debug .= '<span style="color:green;"><strong>Success!</strong></span></br>';
                        $debug .= 'Resulting Row Overview: <textarea rows = "5" cols = "100" style="display: block;">'.print_r($moduleresults_raw, true).'</textarea></br>';
                        if ($cpresults) {
                            $debug .= 'Query Output (after fetch_array): <textarea rows = "5" cols = "100" style="display: block;">'.print_r($moduleresults, TRUE).'</textarea></br>';
                        } else {
                            $debug .= 'Empty - no result';
                        }
                    }
                    $debug .= 'Show more: '.$showmore;

                    // $gradeitems .= '<div class="panel panel-default" id="panel-'.$cpcode.'" >
                    //     <div class="panel-heading">';
                            
                            $gradeitems .= '
                            <div class="card-cont">
                            <div class="card-header" id="heading'.$cpcode.'">
                              <h5 class="mb-0">
                              <h4><i class="fa fa-graduation-cap"></i> 
                                  '.$cpresult["CoursePeriodTitle"].'</h4>
                                  <span class="sesh"><i class="fa fa-calendar"></i> '.$cpresult["Session"].'</span>
                                <button class="btn btn-link" data-toggle="collapse" data-target="#'.$cpcode.'" aria-expanded="true" aria-controls="collapseOne">Toggle Module Results <i class="fa fa-chevron-down"></i>
                                </button>
                              </h5>';
                              if ($config->enableoutcomes) {
                                $gradeitems .= '<div class="resultbox '.$outcome.'">   </div>';
                                }
                            $gradeitems .= '</div>';



                        $gradeitems .= '<div id="'.$cpcode.'"class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                            <div class="card-body">';




                        $gradeitems .= '<div class="table-wrapper">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        
                                        <th>Unit Name</th>
                                        <th>Completion Date</th>
                                        <th>Status</th>
                                        <th>Level Up/Down</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>';
                
                
             

                                foreach ($moduleresults as $moduleresult) {
                                    $result_date_eu = str_replace("/","-",$moduleresult['SubjectWithdrawDate']);
                                    $result_date_ts = strtotime($result_date_eu);
                                    $result_date_ts_allowance = strtotime('+'.$config->allowance.' week', $result_date_ts);
                                    $result_date_hr = date("jS F Y", strtotime($result_date_eu));
                                    $today_ts = strtotime("now");
                                    if ($moduleresult['Pass'] == 'Pass') {
                                        $result = $moduleresult['Pass'];
                                    }
                                    if ($moduleresult['Pass'] == 'Fail') {
                                        $result = $moduleresult['Pass'];
                                    }
                                    if ($moduleresult['Pass'] == 'No Result') {
                                        $result = $moduleresult['Pass'];
                                    }
                                    if ($moduleresult['Pass'] == 'Candidate withdrawn') {
                                        $result = 'Withdrawn';
                                    }                           
                                    if (($moduleresult['Pass'] == 'A') || ($moduleresult['Pass'] == 'B') || ($moduleresult['Pass'] == 'C')) {
                                        $result = $moduleresult['Pass'];
                                    }
                                    if (($moduleresult['PassCode'] == '1') || ($moduleresult['PassCode'] == '2')) {
                                        $result = "A";
                                    }
                                    if (($moduleresult['PassCode'] == '3') || ($moduleresult['PassCode'] == '4')) {
                                        $result = "B";
                                    }
                                    if (($moduleresult['PassCode'] == '5') || ($moduleresult['PassCode'] == '6')) {
                                        $result = "C";
                                    }
                                    if ($moduleresult['PassCode'] == '7') {
                                        $result = "Fail";
                                    }
                                    if (($moduleresult['PassCode'] == '8') || ($moduleresult['PassCode'] == '9')) {
                                        $result = "Fail";
                                    }
                                    $modcode = substr($moduleresult['SubjectCode'], 0, strpos($moduleresult['SubjectCode'], '/'));

                                    if (!$moduleresult['Level']) {
                                        $level = '-';
                                    } else {
                                        $level = '<span class="wd_date"><i class="fa fa-refresh"></i> '.$moduleresult['Level'].' <a href="#levelhelp" data-toggle="modal" data-backdrop="static"><i class="fa-question-circle" style="color:#1a8fad"></i></a></span>';
                                    }
                                    $gradeitems .= '<tr data-status="active">
                                                    
                                                    <td>'.$moduleresult["SubjectName"].' '.$modcode;
                                                    if ($moduleresult['sub_type'] === 'GA') {
                                                        $gradeitems .= '<br><span class="ga"><i class="fa fa-trophy"></i> Group Award</span>';
                                                    }
                                                    $gradeitems .= '</td>
                                                    <td>'.$result_date_hr.'</td>
                                                    <td><span class="label-'.$result.'">'.$result.'</span>';
                                    if ($config->enableoverdue == TRUE) {
                                        if (($moduleresult['Pass'] == 'No Result') && ($today_ts > $result_date_ts_1week) && ($outcome != 'withdrawn') &&  ($outcome != 'transferred') && ($cpresult['CourseOutcomeCode'] != '1')) {
                                                $gradeitems .= '<div class="overdue"><i class="fa fa-clock-o"></i> Awaiting Result</div>';
                                        }
                                    }
                                    $gradeitems .= '</td><td>'.$level.'</td>
                                        <td></td>
                                    </tr>';

                                    if (($moduleresult['PassCode'] > 0) && ($moduleresult['PassCode'] < 10)) {
                                        // $gradeitems .= '<div class="modresult '.$moduleresult['Pass'].' tooltip" style="color:'.$resultcolor.';background:'.$resultbg.';"><i class="fa fa-'.$resulticon.'"></i><span class="tooltiptext">'.$result.'</span>';
                                    }
                                    else {
                                    
                                        if (strlen($moduleresult['Pass']) > 1) {
                                        // $gradeitems .= '<div class="modresult '.$moduleresult['Pass'].' tooltip" style="color:'.$resultcolor.';background:'.$resultbg.';"><i class="fa fa-'.$resulticon.'"></i><span class="tooltiptext">'.$moduleresult['Pass'].'</span>';
                                        }
                                        else {
                                            // $gradeitems .= '<div class="modresult '.$moduleresult["Pass"].' tooltip" style="color:'.get_config('block_myresults', 'passfont').';background:'.$resultbg.';"><div><span>'.$moduleresult["Pass"].'</span><span class="tooltiptext">'.$result.'</span></div></div>';
                                        }
                                        
                                    }

                                    

                                }
                            $gradeitems .= '</tbody>
                                        </table>
                                <a id="help_btn" data-toggle="modal" data-target="#help"><i class="fa '.get_config('block_myresults', 'fa_icon').'"></i> Understanding Your Results</a>
                                </div></div>

                        </div></div>';
                    $i++;
                    }
                $gradeitems .= '</div></div></div></div>';
                $gradeitems .= '</div></div></div></div>';
                $gradeitems .= '<div class="modal fade" id="levelhelp" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <button type="button" class="closing" data-dismiss="modal" aria-hidden="true">x</button>
                                      <h4 class="modal-title">What is levelling?</h4>
                                    </div>
                                    <div class="modal-body">
                                        '.get_string('levelhelp', 'block_myresults').'
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-default" data-dismiss="modal">'.get_string('gotit', 'block_myresults').'</button>
                                    </div>
                                  </div>
                                </div>
                              </div>';
                $gradeitems .= '<script>
                                    $("div.modresult").each(function() {
                                        if($("div.overdue", this).length > 0) {
                                            $(".fa-ban", this).css("margin-top", "-10px");
                                        }
                                    });
                                </script>';
                
            mysqli_close($link);
            } // END "if no results"
            else {
                $gradeitems .= "Oops, its looks like we don't have any results for you yet.";
            }
        } // END "else error"
    } // END "if student"
    $debug .= '</div>';

if ($DB_DEBUG) {
    $gradeitems = $debug;
}

echo($gradeitems);

?>
