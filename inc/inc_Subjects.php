<?php 
include_once './inc/inc_subjectfunction.php';
include_once './inc/inc_DatabaseClass.php';
include_once './inc/inc_ResultClass.php';
?>

<div class="container-fluid medium-padding-top">
	<form class="form-group" action= "subjects.php" method="POST">
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-1">
				Subject:
			</div>
			<div class="col-md-5">
				<select class="form-control" id="sel1">
					<?php 
					  // fetchSubjectList();
					  $result= fetchSubjectList();
					  if ($result->isSuccess()) {
					      echo "subjects selected";
					      $subjects = $result->getOutput();
					      showSubjectList();
					  } else {
					      echo $result->getErrors();
					  }
					?>
  				</select>	
			</div>
			<div class="col-md-1"></div>
			<div class="col-md-1">
				<input class="btn btn-dark" type="submit" id="actionNote" value="Add" name="subjectButton">
			</div>	
		</div>
		<div class="row medium-padding-top">
			<div class= "col-md-1"> </div>
			<div class="col-md-4">
					<span class="label label-primary">Subject</span>
			</div>
			<div class="col-md-4">
					<span class="label label-primary">Professor</span>
			</div>
			<div class="col-md-1">
					<span class="label label-primary">Delete</span>
			</div>	
		</div>	
		<div>
			<?php 
		       showSelectedsubjects();
			?>
		</div>
	 </form>
</div>
	

</div>