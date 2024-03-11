<?php

require_once 'Classes/PHPExcel.php';

/*
input : it takes excel file name and return the worksheet 
output : This gives us worksheet 
*/
function get_worksheet($fname){
    $reader = PHPExcel_IOFactory::createReaderForFile($fname);
    $excel_obj = $reader->load($fname);
    $workSheet = $excel_obj->getSheet('0');
    return $workSheet;
}
/*
input : date
output: this gives the day of that date
*/
function day_extractor_from_date($date){
    $time_stamp = strtotime($date);
    $day = date("l",$time_stamp);
    $date = date('d/m/Y',$time_stamp);
    return array($day,$date);
} 
/*
input : 1) date1 2)date2
output : list of date between date1 and date2
*/
function get_range_of_dates($date1,$date2){
    $starting_date = strtotime($date1);
    $ending_date = strtotime($date2);
    $date_array = array();
    for ($current_date = $starting_date; $current_date <= $ending_date; $current_date += (86400)){
        $date = date("Y/m/d",$current_date);
        array_push($date_array,$date);
    }
    return $date_array;
}
/*
input : Date	Day	Period	Semester	Branch	Subject
output : engagement record
*/
function expanding_record_on_period($date,$day,$period,$sem,$branch,$subject){
    for($i = 0; $i < count($period); $i++){
        // echo "<br>".$date." ".$day." ".$period[$i]." ".$sem." ".$branch." ".$subject;
    }
}

/*
This function takes input : 1) teachers name 2) work_sheet
output : it returns the subjects which teacher teach
*/
function subject_teacher_mapper($teacher_name,$wsheet){
    $subjects = array();
    $last_row = $wsheet->getHighestRow();
    for($x = 1; $x <= $last_row; $x++){
        $teacher_name_ws = $wsheet->getCell('B'.$x)->getValue();
        if(!strcasecmp($teacher_name,$teacher_name_ws)){
            array_push($subjects,$wsheet->getCell('A'.$x)->getValue());
        }
    }
    return $subjects;
}

/*
input : 1) subjects 2) day 3) work sheet  
*/
function period_finder_for_engagement($subject, $day , $wsheet){
    $day_mapping = array("Monday" => 2,
    "Tuesday" => 3,
    "Wednesday" => 4,
    "Thursday" => 5,
    "Friday" => 6,
    "Saturday" => 7);
    // $subject = $subjects[0];
    $periods = array();
    if ($day != "Sunday"){
        $day_index = $day_mapping[$day];
        // echo $day_index;
        $column_count = $wsheet->getHighestDataColumn();
        $count_column = PHPExcel_cell :: columnIndexFromString($column_count);
        
        for ($x = 0; $x < $count_column; $x++){
            $value = $wsheet->getCell(PHPExcel_cell :: stringFromColumnIndex($x).$day_index);
            // echo $value;
            $splited_value = explode("/",$value);
            for($y = 0; $y < count($splited_value);$y++){
                if ($splited_value[$y] == $subject){
                    if ($x <=4){
                        array_push($periods,$x-1);
                    }
                    elseif ($x > 4){
                        array_push($periods,$x-2);
                    }
                    
                }
            }
            
        }
    }
    return $periods;
    /*
    PHPExcel_cell :: columnIndexFromString($coumn_count)
    PHPExcel_cell :: stringFromColumnIndex($col)

    */
}
/*
input : 1) date
output : this print the enaggement record in proper format '
FORMAT OF ENGAGEMENT RECORD WE WANT
DATE | DAY | BRANCH |SEM | PERIOD | SUBJECT
*/

function data_printer($dates,$teacher_name){
    $value_count = 0;
    $s = "";
    $len_dates = count($dates);
    echo "<br>";
    $row_number = 0;
    
    for($date_count = 0; $date_count < $len_dates; $date_count++){
        $date = $dates[$date_count];
        $day = day_extractor_from_date($date)[0];
        $date_proper_format = day_extractor_from_date($date)[1];
        $branchs = array("CSE","EEE","ET&T","MECH","CIVIL");
        for($branch_count = 0; $branch_count < count($branchs); $branch_count++){
            $branch = $branchs[$branch_count];
            for($sem = 1; $sem <= 8; $sem++){
                $time_table = "./TimeTable/".$branch."_".$sem.".xlsx";
                $teacher_subject = "./TimeTable/".$branch."_".$sem."_subject_teachers.xlsx";
                if (file_exists($time_table) && file_exists($teacher_subject)){
               
                    $time_table_ws = get_worksheet($time_table);
                    $teacher_subject_ws = get_worksheet($teacher_subject);
                    $subjects = subject_teacher_mapper($teacher_name,$teacher_subject_ws);
                    for ($subject = 0; $subject < count($subjects); $subject++){
                        $sub = $subjects[$subject];
                        $periods = period_finder_for_engagement($sub,$day,$time_table_ws);
                        for($period = 0; $period < count($periods); $period++){
                            $period_number = $periods[$period];
                            $s = $s."<tr>
                            <input type = 'hidden' name = 'value".++$value_count."' value = '".$date_proper_format."'>
                            <input type = 'hidden' name = 'value".++$value_count."' value = '".$day."'>
                            <input type = 'hidden' name = 'value".++$value_count."' value = '".$period_number."'>
                            <input type = 'hidden' name = 'value".++$value_count."' value = '".$sem."'>
                            <input type = 'hidden' name = 'value".++$value_count."' value = '".$branch."'>
                            <input type = 'hidden' name = 'value".++$value_count."' value = '".$sub."'>
                            <th>".$date_proper_format."</th>
                            <th>".$day."</th>
                            <th>".$period_number."</th>
                            <th>".$sem."</th>
                            <th>".$branch."</th>
                            <th>".$sub."</th>
                            <th> <input type = 'text' name = value".++$value_count." >
                            </tr>";
                            $row_number++;
                        }
                    }
                }
            }
        }
        
        // for ($sem_count = 0;)
    }
    $str = "<tr> <input type = 'hidden' name = 'rownumber' value = '".$row_number."'></tr>";
    $s = $s.$str;
    return $s;
}


?>