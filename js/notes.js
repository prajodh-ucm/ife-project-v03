function toggleCreateNoteList() {
	var currentText = document.getElementById("toggleCreateAndNoteList").innerHTML;
	if (currentText == 'New note') {
		document.getElementById("toggleCreateAndNoteList").innerHTML = 'Go back ';
		document.getElementById("listNotes").style.display = "none";
		document.getElementById("actionNote").style.display = "block";
		document.getElementById("noteTitle").value = "";
		document.getElementById("noteTitle").removeAttribute('readonly');
		document.getElementById("noteDate").value = "";
		document.getElementById("noteDate").removeAttribute('readonly');
		document.getElementById("noteText").innerHTML = "";
		document.getElementById("noteText").removeAttribute('readonly');
		document.getElementById("action").value = "Create";	
		document.getElementById("action").style.display = "block";		
	} else {
		document.getElementById("toggleCreateAndNoteList").innerHTML = 'New note';
		document.getElementById("listNotes").style.display = "block";
		document.getElementById("action").value = "Submit";
		document.getElementById("actionNote").style.display = "none";
		document.getElementById("action").style.display = "block";
	}
}