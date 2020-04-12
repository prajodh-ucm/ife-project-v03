<?php

include_once './inc/inc_CommonFunctions.php';
include_once './inc/inc_ResultClass.php';
include_once './inc/inc_NoteClass.php';

$selectedAction = "";
$selectedIndex = 0;
$submittedAction = "";

function getStudentClassXrefId () {
    return $_POST['studentClassXrefId'];
}

function toggleCreateAndNoteListText() {
    global $showNoteList;
    echo ($showNoteList ? "New note" : "Go back");
}

function hideNotesList() {
    global $showNoteList;
    echo (!$showNoteList) ? 'style="display:none"' : '';
}

function hideSingleNoteView() {
    global $showNoteList;
    echo ($showNoteList) ? 'style="display:none"' : '';
}

function notesTriggeredFromHeader() {
    return CheckRoundTrip('launchNotesFromHeader');
}

function setActionButtonText()     {
    global $action;
    echo $action;
}

function showNotesList() {
    global $notesListData;
    $rowNum = 0;
    foreach ($notesListData as $note) {
        $rowNum++;
        $d5rowNum = sprintf('%05d',$rowNum);
        echo '<div class="row list-item">';
        echo '	<div class="col-md-6">';
        echo '		<span class="label label-primary" name="noteListTitle' . $d5rowNum . '">' . $note->getTitle() . '</span>';
        echo '      <input class="invissible" name="noteListIdhidden' . $d5rowNum . '" value="' . $note->getNoteId() . '"/>';
        echo '      <input class="invissible" name="noteListTitlehidden' . $d5rowNum . '" value="' . $note->getTitle() . '"/>';
        echo '	</div>';
        echo '	<div class="col-md-2">';
        echo '		<span class="label label-primary" name="noteListDate' . $d5rowNum . '">' . $note->getDate() . '</span>';
        echo '      <input class="invissible" name="noteListDatehidden' . $d5rowNum . '" value="' . $note->getDate() . '"/>';
        echo '	</div>';
        echo '	<div class="col-md-1">';
        echo '		<span class="label label-primary">';
        echo '          <input type="radio" name="noteListAction" value="' . 'viewNote'  . $d5rowNum . '">';
        echo '      </span>';
        echo '	</div>';
        echo '	<div class="col-md-1">';
        echo '		<span class="label label-primary">';
        echo '          <input type="radio" name="noteListAction" value="' . 'updateNote'  . $d5rowNum . '">';
        echo '      </span>';
        echo '	</div>';
        echo '	<div class="col-md-1">';
        echo '		<span class="label label-primary">';
        echo '          <input type="radio" name="noteListAction" value="' . 'deleteNote'  . $d5rowNum . '">';
        echo '      </span>';
        echo '	</div>';
        echo '</div>';
    }
}

function getRetainedNotesList() {
    
    $rowNum = 1;
    $noteListData = array();
    
    while (isset($_POST['noteListIdhidden' . sprintf('%05d',$rowNum)])) {
        
        $d5rowNum = sprintf('%05d',$rowNum);
        $idIndex = 'noteListIdhidden' . $d5rowNum;
        $titleIndex = 'noteListTitlehidden' . $d5rowNum;
        $dateIndex = 'noteListDatehidden' . $d5rowNum;
        
        $row = array("id" => $_POST[$idIndex], "title" => $_POST[$titleIndex], "date" => $_POST[$dateIndex]);
        $note = new NoteClass($row);
        array_push($noteListData,$note);
        $rowNum++;
    }
    return $noteListData;
}

function checkInputFromHeader() {
    
    $result = new ResultClass();
    $studentClassXrefId = $_POST['studentClassXrefId'];
    if (!is_numeric($studentClassXrefId)) {
        $result->setSuccess(false);
        $result->setErrors("Invalid number passed from page");
        return $result;
    } else {
        return getNotesForClass($studentClassXrefId);
    }
}

function checkUserInputs() {
    
    global $selectedAction, $selectedIndex, $submittedAction;
    $submittedAction = $_POST['noteFormAction'];
    
    $result = new ResultClass();
    switch ($submittedAction) {
        case "Submit":
            if (isset($_POST['noteListAction'])) {
                $selectedAction = substr($_POST['noteListAction'],0,strpos($_POST['noteListAction'],'Note'));
                $selectedIndex = substr($_POST['noteListAction'],-5);
                $selectedIdIndex =  'noteListIdhidden' . $selectedIndex;
                $selectedId = $_POST[$selectedIdIndex];
                $result = processUserActionOnNoteList($selectedId, $selectedAction );
                if ($result->isSuccess() and $selectedAction == 'delete' ) {
                    $result = getNotesForClass($_POST['studentClassXrefId']);
                }
            } else {
                $result->setSuccess(false);
                $result->setErrors(array ("No row selected"));
            }
            break;
        case "Create":
            $noteTitle = $_POST['noteTitle'];
            $noteDate = $_POST['noteDate'];
            $noteText = $_POST['noteText'];
            $studentClassXrefId = $_POST['studentClassXrefId'];
            $result = processCreateNote($studentClassXrefId, $noteTitle, $noteDate, $noteText);
            if ($result->isSuccess()) {
                $result = getNotesForClass($_POST['studentClassXrefId']);
            }
            break;
        case "Update":
            $noteId = $_POST['noteId'];
            $noteTitle = $_POST['noteTitle'];
            $noteDate = $_POST['noteDate'];
            $noteText = $_POST['noteText'];
            $result = processUpdateNote($noteId, $noteTitle, $noteDate, $noteText);
            if ($result->isSuccess()) {
                $result = getNotesForClass($_POST['studentClassXrefId']);
            }
            break;
    }
    return $result;
}

function showNoteId() {
    global $result, $showNoteList, $retainNote;
    if ($showNoteList) {
        echo "";
    } else {
        if ($retainNote) {
            echo $_POST['noteId'];
        } else {
            echo (($result->getOutput())[0])->getNoteId();
        }
    }
}

function showNoteTitle() {
    global $result, $showNoteList, $retainNote;
    if ($showNoteList) {
        echo "";
    } else {
        if ($retainNote) {
            echo $_POST['noteTitle'];
        } else {
            echo (($result->getOutput())[0])->getTitle();
        }
    }
}

function showNoteDate() {
    global $result, $showNoteList, $retainNote;
    if ($showNoteList) {
        echo "";
    } else {
        if ($retainNote) {
            echo $_POST['noteTitle'];
        } else {
            echo (($result->getOutput())[0])->getDate();
        }
    }
}

function showNoteText() {
    global $result, $showNoteList, $retainNote;
    if ($showNoteList) {
        echo "";
    } else {
        if ($retainNote) {
            echo $_POST['noteTitle'];
        } else {
            echo (($result->getOutput())[0])->getText();
        }
    }
}


function setRetainNoteFlag() {
    global $result, $submittedAction;
    return ($submittedAction == 'Submit') ? false : !($result->isSuccess());
}

function setRetainNoteListFlag() {
    global $result, $submittedAction, $selectedAction;
    if ($result->isSuccess() == false) {
        return false;
    } else {
        if (($submittedAction == 'Submit') and ($selectedAction != 'delete')) {
            return true;
        } else {
            return false;
        }
    }
}

function setShowNoteListFlag() {
    global $result, $submittedAction;
    
    if ($submittedAction != 'Submit') {
        return $result->isSuccess();
    }
    
    if (!isset($_POST['noteListAction'])) {
        return true;
    }
    
    if ($result->isSuccess() == false) {
        return true;
    } else {
        $selectedAction = substr($_POST['noteListAction'],0,strpos($_POST['noteListAction'],'Note'));
        return ($selectedAction == 'delete') ? true : false;
    }
}

function setAction() {
    global $result, $retainNote, $retainNoteList, $showNoteList, $submittedAction;
    $action = "";
    if ($showNoteList) {
        $action = "Submit";
    } else if ($submittedAction == 'Submit') {
        $noteListAction = substr($_POST['noteListAction'],0,strpos($_POST['noteListAction'],'Note'));
        switch ($noteListAction) {
            case 'view':
                $action = "View";
                break;
            case 'update':
                $action = "Update";
                break;
        }
    } else {
        $action = $_POST['noteFormAction'];
    }
    return $action;
}


function makeNoteTitleReadOnly() {
    global $action;
    if ($action == 'View') {
        echo " readonly ";
    }
}

function makeNoteDateReadOnly() {
    global $action;
    if (($action == 'View') or ($action == 'Update')) {
        echo " readonly ";
    }
}
    
function makeNoteTextReadOnly() {
    global $action;
    if ($action == 'View') {
        echo " readonly ";
    }
    
}

function hideWhenViewingNote() {
    global $action;
    if ($action == 'View') {
        echo " invissible ";
    }
}

//---------------------------------------------------


function getSubjectName () {
    return "Advanced Analysis & Design";
}


function getProfessor () {
    return "Narasimha Paravasthu";
}

//---------------------------------------------------




function noNotesFoundMessage() {
    echo '<div class="row">';
    echo '	<div class="col-md-3"></div>';
    echo '	<div class="col-md-6">No data found</div>';
    echo '	<div class="col-md-3"></div>';
    echo '</div>';
}

?>