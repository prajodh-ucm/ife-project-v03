<?php
class ResultClass {
    private $success;
    private $output;
    private $errors;
    private $message;

    function __construct() {
        $this->success = null;
        $this->output = null;
        $this->errors = null;
        $this->message = null;
    }
    
    public function setSuccess($flag) {
        $this->success = $flag;
    }
    
    public function setOutput ($output) {
        $this->output = $output; 
    }
    
    public function setErrors ($errors) {
        $this->output = $errors;
    }
    
    public function setMessage ($message) {
        $this->message = $message;
    }
    
    public function isSuccess() {
        return $this->success;
    }
    public function getOutput() {
        return $this->output;
    }
    
    public function getErrors() {
        return $this->errors;
    }
    
    public function getMessage() {
        return $this->message;
    }
    
    public function append ($anotherResult) {
/*        if (($this->isSuccess() != true ) or (!$anotherResult->isSuccess() != true)) {
            $this->setSuccess(false);
        }
        if (($anotherResult->isSuccess() = true) and ($anotherResult) {
            
        }
*/
    }    
}
?>