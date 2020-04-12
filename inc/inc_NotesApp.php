
<?php 
include_once './inc/inc_ResultClass.php';
include_once './inc/inc_NoteClass.php';

include_once './inc/inc_CommonFunctions.php';
include_once './inc/inc_NotesDisplayFunctions.php';
include_once './inc/inc_NotesProcessFunctions.php';



// if we came here from dropdown on header : 
//    (a) Get list of notes for subject passed 
//    (b) no need to retain values from previous call as we are landing for the 1st time on this page (from header)
//    (c) By default we show notes list when we come to this page the 1st time
//    (d) Text in action button on notes-list page is "Submit"
if (notesTriggeredFromHeader()) {
    $result = checkInputFromHeader();
    $retainNote = false;
    $retainNoteList = false;
    $showNoteList = true;
    $action = 'Submit';
} else {
    $result = checkUserInputs();
    $retainNote = setRetainNoteFlag();
    $retainNoteList = setRetainNoteListFlag();
    $showNoteList = setShowNoteListFlag();
    $action = setAction();
}

?>
<div class="container-fluid">
	<form class="form-group" method="POST" action="notes.php">
		<!-- <div> -->
		<div style="display:none">
			<input type="text" name="studentClassXrefId" value="<?php echo $_POST['studentClassXrefId']; ?>" >
		</div>
		<div class="container-fluid medium-padding-top">
			<div class="row">
				<div class="col-md-10">
					<div class="row">
						<div class="col-md-2"></div>
						<div class="col-md-1">Subject</div>
						<div class="col-md-7"><?php echo getSubjectName(); ?></div>
					</div>
					<div class="row">
						<div class="col-md-2"></div>
						<div class="col-md-1">Professor</div>
						<div class="col-md-7"><?php echo getProfessor(); ?></div>
					</div>			
				</div>
    			<div class="col-md-2">
    				<button type="button" class="btn btn-warning button-100px-width" 
    				onclick="toggleCreateNoteList()" id="toggleCreateAndNoteList"><?php toggleCreateAndNoteListText(); ?></button>
    			</div>
			</div>
		</div>
		<div class="container-fluid midium-padding-top" id="listNotes" <?php hideNotesList(); ?> >
			<div class="row">
				<div class="col-md-6">
					<span class="label label-primary">Title</span>
				</div>
				<div class="col-md-2">
					<span class="label label-primary">Date</span>
				</div>
				<div class="col-md-1">
					<span class="label label-primary">View</span>
				</div>
				<div class="col-md-1">
					<span class="label label-primary">Update</span>
				</div>
				<div class="col-md-1">
					<span class="label label-primary">Delete</span>
				</div>			
			</div>
			<div>
				<?php
				if ($retainNoteList == false) {
				    if ($result->isSuccess()) {
				        $notesListData = $result->getOutput();
				        showNotesList();
				    } else {
				        echo $result->getErrors();
				    }
				} else {
				    $notesListData = getRetainedNotesList();
				    showNotesList();
				}
				?>
    		</div>
		</div>		
		<div class="container-fluid midium-padding-top" id="actionNote" <?php hideSingleNoteView(); ?> >
			<span class="invissible"><input type="text" name="noteId" value="<?php showNoteId(); ?>"></span>
			<div class="row">
				<div class="col-md-6">
					<span class="label label-primary">Title</span>
				</div>
				<div class="col-md-6">
					<span class="label label-primary">Date</span>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<input type="text" class="form-control" name="noteTitle" id="noteTitle" value="<?php showNoteTitle(); ?>" <?php makeNoteTitleReadOnly(); ?> >
				</div>			
				<div class="col-md-2">
					<input type="date" class="form-control" name="noteDate" id="noteDate" value="<?php showNoteDate(); ?>" <?php makeNoteDateReadOnly(); ?> >
				</div>
			</div>
			<div class="row small-padding-top">
				<div class="col-md-11">
					<span class="label label-primary">Notes</span>
				</div>
			</div>
			<div class="row">
				<div class="col-md-11">
					<textarea class="form-control" rows="13" placeholder="Enter your notes here" name="noteText" id="noteText" <?php makeNoteTextReadOnly(); ?> ><?php showNoteText(); ?></textarea>
				</div>
			</div>
		</div>
		<div class="container-fluid small-padding-top">
			<div class="row">
				<div class="col-md-7"></div>
				<div class="col-md-1">
					<input class="btn btn-dark <?php hideWhenViewingNote(); ?>" type="submit" id="action" value="<?php echo setActionButtonText() ?>" name="noteFormAction"> 
				</div>
				<div class="col-md-4"></div>
			</div>
		</div>
	</form>
</div>
