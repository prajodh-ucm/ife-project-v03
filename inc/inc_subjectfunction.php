
<?php
function showSubjectList(){
    global $subjects;
     foreach ($subjects as $subject){
        echo "<option>" . $subject['SUBJECT'] . $subject['PROFESSOR'] . "</option>";
    }
}
function fetchCurrentdateSubjects() {
    
    $dbClass = new DatabaseClass();
    $result = new ResultClass();
    $query = " SELECT X.STUDENT_CLASS_XREF_ID,S.SUBJECT_NAME AS SUBJECT,CONCAT(P.PROFESSOR_FNAME,' ',P.PROFESSOR_LNAME) AS PROFESSOR
                  FROM CLASS C, SUBJECT S, PROFESSOR P, STUDENT_CLASS_XREF X
                  WHERE C.SEMESTER_ID = (SELECT SEMESTER_ID FROM SEMESTER
                                          WHERE CURRENT_DATE BETWEEN SEMESTER_SART_DATE AND SEMESTER_END_DATE)
                    AND S.SUBJECT_ID = C.SUBJECT_ID
                    AND P.PROFESSOR_ID = C.PROFESSOR_ID
                         AND C.CLASS_ID = X.CLASS_ID
                         AND X.STUDENT_ID = 1";
    try {
        $queryResult = $dbClass->Select($query);
        $result->setSuccess(true);
        $dbOutput = array();
        while($row = $queryResult->fetch_assoc()) {
            array_push($dbOutput,$row);
        }
        $result->setOutput($dbOutput);
    } catch (Exception $e) {
        $result->setSuccess(false);
        $dbErrors = array();
        array_push($dbErrors,$e->getMessage());
        $result->setErrors($dbErrors);
    }
    return $result;
}

function showSelectedsubjects(){
    $subject = array("subject"=>"internet for enterprise", "professor"=>"Dr paravasthu");
    $subjectsArray[] = $subject;
    $subject = array("subject"=>"Project Management", "professor"=>"Dr Silvana faja");
    $subjectsArray[] = $subject;
    $subject = array("subject"=>"Legal Environment Issues", "professor"=>"Dr Sam");
    $subjectsArray[] = $subject;
    $rowNumber = 0;
    foreach ($subjectsArray as $row){
        $rowNumber++;
        $d5rowNumber = sprintf('%05d',$rowNumber);
        echo '<div class="row list-item">';
        echo '  <div class= "col-md-1"> </div>';
        echo '	<div class="col-md-4">';
        echo '		<span class="label label-primary" name="subjectName' . $d5rowNumber . '">' . $row['subject'] . '</span>';
        echo '	</div>';
        echo '	<div class="col-md-4">';
        echo '		<span class="label label-primary" name="subjectProfessor' . $d5rowNumber . '">' . $row['professor']. '</span>';
        echo '	</div>';
        echo '	<div class="col-md-1">';
        echo '		<span class="label label-primary">';
        echo '          <input type="radio" name="subjectDelete" value="' . 'deleteSubject'  . $d5rowNumber . '">';
        echo '      </span>';
        echo '	</div>';
        echo '</div>';
    }//first we will write fetch subject list function
    // $query = " SELECT S.SUBJECT_NAME AS SUBJECT,CONCAT(P.PROFESSOR_FNAME," ",P.PROFESSOR_LNAME) AS PROFESSOR
    
}
function fetchSubjectList() {
    
    $dbClass = new DatabaseClass();
    $result = new ResultClass();
    $query = " SELECT S.SUBJECT_NAME AS SUBJECT,CONCAT(P.PROFESSOR_FNAME,' ',P.PROFESSOR_LNAME) AS PROFESSOR
	                   FROM CLASS C, SUBJECT S, PROFESSOR P
	                   WHERE C.SEMESTER_ID = (SELECT SEMESTER_ID FROM SEMESTER
	                       WHERE CURRENT_DATE BETWEEN SEMESTER_SART_DATE AND SEMESTER_END_DATE)
	                           AND S.SUBJECT_ID = C.SUBJECT_ID
	                               AND P.PROFESSOR_ID = C.PROFESSOR_ID";
    try {
        $queryResult = $dbClass->Select($query);
        $result->setSuccess(true);
        $dbOutput = array();
        while($row = $queryResult->fetch_assoc()) {
            array_push($dbOutput,$row);
        }
        $result->setOutput($dbOutput);
    } catch (Exception $e) {
        $result->setSuccess(false);
        $dbErrors = array();
        array_push($dbErrors,$e->getMessage());
        $result->setErrors($dbErrors);
    }
    return $result;
}
?>