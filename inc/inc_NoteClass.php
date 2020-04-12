<?php
class NoteClass
{
    private $noteId;
    private $studentClassXrefId;
    private $title;
    private $date;
    private $text;
    
    public function __construct($row) {
        $this->noteId = null;
        $this->studentClassXrefId = null;
        $this->title = null;
        $this->date = null;
        $this->text = null;
        
        if (isset($row)) {
            if (array_key_exists('NOTE_ID',$row)) {
                $this->noteId = $row['NOTE_ID'];
            }
            if (array_key_exists('TITLE',$row)) {
                $this->title = $row['TITLE'];
            }
            if (array_key_exists('DATE',$row)) {
                $this->date = $row['DATE'];
            }
            if (array_key_exists('TEXT',$row)) {
                $this->text = $row['TEXT'];
            }
            if (array_key_exists('id',$row)) {
                $this->noteId = $row['id'];
            }
            if (array_key_exists('title',$row)) {
                $this->title = $row['title'];
            }
            if (array_key_exists('date',$row)) {
                $this->date = $row['date'];
            }
        } 
    }
    
    public function getNoteId() {
        return $this->noteId;
    }
        
    public function getStudentClassXrefId() {
        return $this->studentClassXrefId;
    }
    
    public function getTitle() {
        return $this->title;
    }
    
    public function setTitle($ttl) {
        $this->title = $ttl;
    }
    
    public function getDate() {
        return $this->date;
    }
    
    public function setDate($dt) {
        $this-date> $dt;
    }
    
    public function getText() {
        return $this->text;
    }
    
    public function setText($txt) {
        $this->text = $txt;
    }
}
?>
