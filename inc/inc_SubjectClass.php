<?php
class inc_SubjectClass
{
    private $subjectId;
    private $year;
    private $semester;
    private $course;
    private $name;
    private $professorFName;
    private $professorLName;
    private $description;
    
    public function __construct($subjectId, $year, $semester, $course, $name, $professorFName, $professorLName, $description) {
        $this->subjectId = $subjectId;
        $this->year = $year;
        $this->semester = $semester;
        $this->course = $course;
        $this->name = $name;
        $this->professorFName = $professorFName;
        $this->professorLName = $professorLName;
        $this->description = $description;
    }
    
    public function getSubjectId() {
        return $this->subjectId;
    }
    
    public function setSubjectID($sid) {
        $this->subjectId = $sid;
    }
    
    public function getYear() {
        return $this->year;
    }
    
    public function setYear ($yr) {
        $this->year = $yr;
    }
    
    public function getSemester() {
        return $this->semester;
    }
    
    public function setSemester ($sem) {
        $this->semester = $sem;
    }
    
    public function getCourse() {
        return $this->course;
    }
    
    public function setCourse($crs) {
        $this->course = $crs;
    }
    
    public function getName() {
        return $this->name;
    }
    
    public function setName($nme) {
        $this->name = $nme;
    }
    
    public function getProfessorFName() {
        return $this->professorFName;
    }
    
    public function setProfessorFName($fname) {
        $this->professorFName = $fname;
    }
    
    public function getProfessorLName() {
        return $this->professorLName;
    }
    
    public function setProfessorLName($lName) {
        $this->professorLName = $lName;
    }
    
    public function getDescription() {
        return $this->description;
    }
    
    public function setDescription($desc) {
        $this->description = $desc;
    }
}
?>
