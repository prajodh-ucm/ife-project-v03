<?php

include_once './inc/inc_DatabaseClass.php';
include_once './inc/inc_ResultClass.php';


function getNotesForClass($stduentClassXrefId) {

    $result = new ResultClass();
    $dbClass = new DatabaseClass();
    $query = " SELECT NOTE_ID, TITLE, DATE FROM NOTE WHERE STUDENT_CLASS_XREF_ID = "  . $stduentClassXrefId;
    try {
        $queryResult = $dbClass->Select($query);
        $result->setSuccess(true);
        $dbOutput = array();
        while($row = $queryResult->fetch_assoc()) {
            $note = new NoteClass($row);
            array_push($dbOutput,$note);
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



function processUserActionOnNotesList() {
    $selectedIndex = (int) substr($_POST[$actionOnNote],-5);
    $titleIndex = 'notesListTitle' . $selectedIndex;
    $dateIndex = 'notesListDate' . $selectedIndex;
    $selectedNoteTitle = $_POST[titleIndex];
    $selectedNoteDate = $_POST[dateIndex];
    $selectedAction = substr($_POST['notesListAction'],0,strpos($_POST['notesListAction'],'Note'));
        
    if ($selectedAction == 'delete') {
        $result = processDeleteNote();
        if ($result->isSuccess()) {
            $result = fetchNotesForSubject();
            $result->setMessage ('Message with title ' . $selectedNoteTitle . ' and date ' . $selectedNoteDate);
        }
    } else {
        $result = fetchOneNote();
    }
    return $result;
}

function processDeleteNotes() {
    
    $result = new ResultClass();
    return $result;
    
}

function processCreateNote($studentClassXrefId, $noteTitle, $noteDate, $noteText) {
    
    $result = new ResultClass();
    $dbClass = new DatabaseClass();
    $query = "INSERT INTO NOTE (NOTE_ID, STUDENT_CLASS_XREF_ID, TITLE, DATE, TEXT) VALUES (NULL, " . $studentClassXrefId . ", '" . $noteTitle . "', '" . $noteDate . "', '" . $noteText . "')";         
    try {
        $queryResult = $dbClass->Action($query);
        $result->setSuccess(true);
        $result->setMessage("Note Created");
    } catch (Exception $e) {
        $result->setSuccess(false);
        $dbErrors = array();
        array_push($dbErrors,$e->getMessage());
        $result->setErrors($dbErrors);
    }
    return $result;
}

function processUpdateNote($noteId, $noteTitle, $noteDate, $noteText) {
    
    $result = new ResultClass();
    $dbClass = new DatabaseClass();
    $query = " UPDATE NOTE SET TITLE = '" . $noteTitle . "' ,TEXT = '" . $noteText . "' WHERE NOTE_ID = "  . $noteId;
    try {
        $queryResult = $dbClass->Action($query);
        $result->setSuccess(true);
        $result->setMessage("Note Updated");
    } catch (Exception $e) {
        $result->setSuccess(false);
        $dbErrors = array();
        array_push($dbErrors,$e->getMessage());
        $result->setErrors($dbErrors);
    }
    return $result;
}

function processUserActionOnNoteList ($selectedId, $selectedAction) {
    
    switch ($selectedAction) {
        case 'view':
        case 'update':
            return selectNote($selectedId);
            break;
        case 'delete':
            return deleteNote($selectedId);
            break;
    }
    
}

function selectNote($noteId) {
    
    $result = new ResultClass();
    $dbClass = new DatabaseClass();
    $query = " SELECT NOTE_ID, TITLE, DATE, TEXT FROM NOTE WHERE NOTE_ID = "  . $noteId;
    try {
        $queryResult = $dbClass->Select($query);
        $result->setSuccess(true);
        $dbOutput = array();
        while($row = $queryResult->fetch_assoc()) {
            $note = new NoteClass($row);
            array_push($dbOutput,$note);
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

function deleteNote($noteId) {
    
    $result = new ResultClass();
    $dbClass = new DatabaseClass();
    $query = " DELETE FROM NOTE WHERE NOTE_ID = "  . $noteId;
    try {
        $queryResult = $dbClass->Action($query);
        $result->setSuccess(true);
        $result->setMessage("Note Deleted");
    } catch (Exception $e) {
        $result->setSuccess(false);
        $dbErrors = array();
        array_push($dbErrors,$e->getMessage());
        $result->setErrors($dbErrors);
    }
    return $result;
    
    
}

?>