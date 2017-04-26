/********************************************************
 	Data Management Functions 
********************************************************/
var UPDATE_TIME = '2016-12-22' + 'T' + '17:50:00'; // military time, and leading zeros needed
function saveSemesters() {
	if (typeof(Storage) !== "undefined") {
		localStorage.setItem('Semesters', JSON.stringify(SEMESTERS));
		localStorage.setItem('Viewing', JSON.stringify(VIEWING));
	}
	return;
}

function loadSemesters() {
	/* Try To Get Previous User Data */
	var retrievedObject = localStorage.getItem('Semesters'); // Semesters
	if (retrievedObject !== null) { // exists
		SEMESTERS = JSON.parse(retrievedObject);
	}

	retrievedObject = localStorage.getItem('Viewing'); // Viewing
	if (retrievedObject !== null) { // exists
		VIEWING = JSON.parse(retrievedObject);
	}

	var updateDay =  (new Date(UPDATE_TIME).getTime() + 14400000)/8.64e7; // convert to my timezone
	var database = localStorage.getItem('Database');
	var subjects = localStorage.getItem('Subjects');
	if ((database === null) || (subjects === null) || infoOutOfDate(updateDay)) { // doesnt exists, or (add out of date check)
		var string = (function () {/*
			<div style="text-align:center;">
				<h2 style="color:#79e50d;">Welcome to CoursePlanner!</h2>
				This is an independent program developed by two students:<br>
					<b>Nawar&nbsp;Ismail</b> and <b>Devon&nbsp;Fazekas-Thomas.</b><br>
				<br>
				Here, you will find a very useful tool to help you plan your courses as efficiently and seamlessly as possible.
				Please maximize your browser (and zoom in to 100%) to ensure an optimal viewing experience.<br>
				<br>
				If you have any questions or concerns, please let us know!<br>
				<hr>
				<b>We are retrieving the most recent data, this may take several seconds.
				You will be notified when this is finished. Thank you for your patience.<b>
				<hr>
				<strong>Please VERIFY all information before making decisions. We have done our best to ensure 
				that our information is correct, we can't predict everything! We are not responsible for any incorrect information. 
				If you do notice any errors please let us know, so we can fix them!</strong><br><br>
				<strong>We are NOT affiliated with the University of Guelph in anyway.</strong>
			</div>
		*/}).toString().match(/[^]*\/\*([^]*)\*\/\}$/)[1].replace(/(\r\n|\n|\r)/gm,"");
		bootbox.alert({message: string, backdrop: true, size: 'medium', callback: function() {
				bootbox.alert({message: "Success! You may now continue.", backdrop: true, size: 'small'});
		}}).on("shown.bs.modal", function(e) {
			$(this).scrollTop(0);

			/* Get Database */
			// If !stored or !updated, pull from server, put into DATABASE & local storage
			// else (if stored and updated) put into DATABASE & SUBJECTS 
			// Safe guard against disabled cookies (Later)
			$.ajax({
		        type: "POST",
		        url: "php/getDatabase.php" ,
		        success : function(data) {
		        	if (data.length < 100000) {// should try to grab subjects, and neglect db.
		        		console.log(data);
		        		bootbox.alert({message: "Could not access the database, sorry.", backdrop: true, size: 'small'});
		        		return;
		        	}
		        	var rows = data.split('|%');
		        	rows.pop();
		        	for (var i = 0; i < rows.length; i++) {
		        		var entries = rows[i].split('|');
		        		DATABASE.push(new databaseConstruct(entries));

		        		/* Grabs subjects */
		        		var position = SUBJECTS.map(function(e) { return e.subject; }).indexOf(entries[0]);
		        		if (position < 0) { // If not already inputed
		        			if (entries[0].length > 1) {
		        				var code = entries[1].split('*')[0];
		        				SUBJECTS.push(new subjectsConstruct(entries[0], code));
		        			}
		        		}
		        	}
		        	localStorage.setItem('Subjects', JSON.stringify(SUBJECTS));
		        	localStorage.setItem('Database', JSON.stringify(DATABASE));
					localStorage.setItem('LastUpdate', updateDay);
		        	assignDropdowns();
		        	displayPlans();
		        },
		        error: function(data) {
		    		bootbox.alert({message: "<div style='text-align:center;'><h3>Could Not Access Database.</h3><br>Try Refreshing the Page or Try a Different Browser.<br>"+
		    			" The program will may not work properly.</div>", backdrop: true, size: 'medium'});
		    	}
		    });
		});
	} else {
		DATABASE = JSON.parse(database);
		SUBJECTS = JSON.parse(subjects);
		assignDropdowns();
		displayPlans();
	}
	return;
}


function infoOutOfDate(updateDay) {
	var currentDay = new Date().getTime()/8.64e7;
	var lastUpdated = localStorage.getItem('LastUpdate');
	if (lastUpdated === undefined) {
		console.log("No Last Updated Day :: Pulling information");
		return true;
	}
	if (updateDay == lastUpdated) {
		console.log("Last updated day is the same day as the update day :: Not Pulling information");
		return false;
	}
	if (currentDay > updateDay) {
		console.log("It is past the update day :: Pulling information");
		return true;
	}
	return false;
}





function initFilters() {
	var seen = [];
	for (var i = 0;  i < DATABASE.length; i++) {
		var credit = DATABASE[i].credits;
		if ($.inArray(credit, seen) === -1) {
			seen.push(credit);
		}
		
	}
	var seen = seen.sort();
	var string = '<br>';
	for (var i = 0; i < seen.length; i++) {
		var number = seen[i].replace(/[\[\]']+/g,''); // Removes []
		string += '<div class="w3-container w3-quarter"><label for="filterCredsOption'+i+'"><h5 style="display:inline;">'+
					number + ' &nbsp;</h5></label><input id="filterCredsOption'+i+'" checked class="fpFilter fpCredits" type="checkbox" value='+number+'></div>';
	}
	$('#filterCredits').html(string);

	/* Problems:
			FIXED: Unique Terms, oh no!, theres are errors! (3)
			FIXED: Some errors with lecture hour detection (4)
		Notes:
			We do take coreqs into account, "prereqs can be taken as coreqs" no mechanism, you have to override if thing's coreq is itself. (9)
			S-F,F-W,W-S, Very confusing, not worth it. People should be in 4th year anyway.
			^ Courses availablilty can span semesters
	*/


	
	// debugDatabase(4, true);
	function debugDatabase(detail, moreInfo) {
		seen = [];
		details = [];
		for (var i = 0;  i < DATABASE.length; i++) {
			var det = DATABASE[i][DETAILS[detail]];
			var store = det;
			if ($.inArray(store, seen) === -1) {
				seen.push(store);
				details.push(DATABASE[i]);
			}
			
		}
		console.log('Length: ', seen.length);
		for (var i = 0; i < seen.length; i++) {
			if (moreInfo) console.log(seen[i], details[i]);
			else console.log(seen[i]);
		}
	}
	return;
}




// http://stackoverflow.com/questions/3730510/javascript-sort-array-and-return-an-array-of-indicies-that-indicates-the-positi
function sortWithIndeces(toSort) {
	var len = toSort.length;
	var indices = [];
	for (var i = 0; i < len; ++i) {
		indices.push(i);
	}
	return indices.sort(function (a, b) { return toSort[a].accr < toSort[b].accr ? -1 : toSort[a].accr > toSort[b].accr ? 1 : 0; });
}


/***************************************************
	Assigning Dropdowns
***************************************************/
function assignDropdowns() { // NOT THE LEFT PANEL! ITS THE MIDDLE SUBJECTS
	initFilters();
	// var code = '<table style="border-collapse:collapse;border-spacing:0;width:100%;height:98%;table-layout:fixed;"><tr style="padding:0;margin:0;height:6.25%;">' + drawLeftPanelSubjects(0, 'NONE', 'NONE');
	// var name = '<table style="width:100%;height:100%;table-layout:fixed;"><tr style="padding:0;margin:0;">' + drawLeftPanelSubjects(-1, 'NONE', 'NONE');
	var sortedIndeces = [];
	var numColumns = 5;
	var numRows = Math.ceil((SUBJECTS.length+1) / numColumns);
	var height = 100 / (numRows);

	var code = '<div style="height:98%;"><div class="w3-row" style="height:'+height+'%;">'
	var name = '<div style="height:100%;"><div class="w3-row" style="height:'+height+'%;">'

	code += drawLeftPanelSubjects(0, "NONE", "NONE");
	name += drawLeftPanelSubjects(0, "NONE", "NONE");
	for (var i = 0; i < SUBJECTS.length; i++) {
		sortedIndeces.push(SUBJECTS[i]);
		name += drawLeftPanelSubjects(i, SUBJECTS[i].subject, SUBJECTS[i].subject);
	}
	sortedIndeces = sortWithIndeces(sortedIndeces);
	for (var i = 0; i < sortedIndeces.length; i++) {
		code += drawLeftPanelSubjects(i, SUBJECTS[sortedIndeces[i]].accr, SUBJECTS[sortedIndeces[i]].subject);
	}


	// $('#pickSubjectSubjectsCode').html(code + '</table>');
	$('#pickSubjectSubjectsCode').html(code + '</div></div>');
	$('#pickSubjectSubjectsName').html(name + '</table>');

	function drawLeftPanelSubjects(i, detail, subject) {
		var string = '';
		var subjectDetail = '<b style="color:#cccccc;font-size:15px;">' + detail[0] + '</b>' + detail.substring(1);
		var button = '<div class="w3-container w3-col" style="width:20%;padding:0;height:100%;">'+
					'<button class="btn btn-COLOR leftPanelSubjects" style="width:100%;height:100%;margin:0;overflow:hidden;" value='
					+subject.replaceAll(' ', '_')+'>'+subjectDetail+
				 '</button></div>';
		

		/* Ending Row */
		if ((i > 1) && ((i+1) % 5 == 0)) {
			button += '</div><div class="w3-row" style="height:'+height+'%;">';
		}

		/* Coloring */
		var color = 'primary';
		if (detail == 'NONE') color = 'danger';
		else if (detail[0] < 'F') color = 'warning';
		else if (detail[0] < 'L') color = 'success';
		else if (detail[0] < 'R') color = 'info';
		button = button.replaceAll('COLOR', color);
		return button;
		return button;


		// var button = '<td style="width:20%;padding:0;margin:0;height:100%;"><button style="padding:0;margin:0;min-height:30px;height:104%;width:100%;overflow:hidden;" class="btn btn-COLOR leftPanelSubjects" value=' +
		// 				 subject.replaceAll(' ', '_') + '>' + subjectDetail +
		//  	 			'</button></td>';
		// if ((i+1) % 5 == 0) {
		// 	button = '</tr><tr style="padding:0;margin:0;">' + button;
		// }
		
		
	}


	function drawLeftPanelSubjectsName(i, detail, subject) {
		var subjectDetail = '<b style="color:#cccccc;font-size:15px;">' + detail[0] + '</b>' + detail.substring(1);
		var button = '<td style="width:20%;padding:0;margin:0;"><button style="padding:0;margin:0;height:106%;width:100%;overflow:hidden;" class="btn btn-COLOR leftPanelSubjects" value=' +
						 subject.replaceAll(' ', '_') + '>' + subjectDetail +
		 	 			'</button></td>';
		if ((i+1) % 5 == 0) {
			button = '</tr><tr style="padding:0;margin:0;">' + button;
		}
		
		var color = 'primary';
		if (subject == 'NONE') color = 'danger';
		else if (subject[0] < 'F') color = 'warning';
		else if (subject[0] < 'L') color = 'success';
		else if (subject[0] < 'R') color = 'info';
		button = button.replaceAll('COLOR', color);
		return button;
	}

	/* Initialize Subject Drop Downs */ // Most likely can be removed
	var nameOptions = '<option value="default">Select a Subject by Name</option>';
	var accrOptions = '<option value="default">Select a Subject by Code</option>';
	removeOptions('#subjectByName');
	removeOptions('#subjectByCode');
	for (var i = 0; i < SUBJECTS.length; i++){
	   nameOptions += '<option value="'+ SUBJECTS[i].subject + '">' + SUBJECTS[i].subject + '</option>';
	   accrOptions += '<option value="'+ SUBJECTS[i].accr    + '">' + SUBJECTS[i].accr    + '</option>';
	}
	$('#subjectByName').append(nameOptions);
	$('#subjectByCode').append(accrOptions);

	$("#subjectByCode option:first").attr('disabled','disabled');
	$("#subjectByName option:first").attr('disabled','disabled');

	/* Initialize Course Drop Downs */
	removeOptions(COURSE_CODE);
	removeOptions(COURSE_NAME);
	$(COURSE_CODE).append('<option value="default">Select a Course by Code</option>');
	$(COURSE_NAME).append('<option value="default">Select a Course by Name</option>');
	$(COURSE_CODE + " option:first").attr('disabled','disabled');
	$(COURSE_NAME + " option:first").attr('disabled','disabled');

	return;
}

function initSemDropDowns() {
	var offerings = ["Winter", "Summer", "Fall"]; 
	var currentYear = new Date().getFullYear();

	for (var i = 0; i < offerings.length; i++) {
		$('#selTerm').append(
			'<option>' + offerings[i] + '</option>'
		);
	}

	for (var i = (currentYear - 10); i < (currentYear + 15); i++) {
		$('#selYear').append(
			'<option value="'+i+'">' + i + '</option>'
		);
	}

	$("#selYear")[0].selectedIndex = 10;
	$("#selTerm")[0].selectedIndex = 1;
	return;
}




$(document).on('click', '#alertMessages', function(e) {
	// Can't stop animations for somereason
	$(this).finish(); // Stops animation
	$(this).stop(true, false); // Stops animation
	$(this).clearQueue(); // Stops animation
	e.preventDefault(); // Stop click through
	// $(this).alert("close");
	
	$(this).hide();
});

function showAlert(color, message) { // example color: alert-success
	if (($('#toggleAlerts').val() == 0) || ($('#toggleAlerts').val() == 'false')) return;
	$("#alertMessages").removeClass();
	$("#alertMessages").addClass("alert " + color);
  	$("#alertMessages").alert();
  	$("#alertMessages").fadeTo(5000, 150).slideUp(1000, function(){
  		$("#alertMessages").slideUp(1000);
  		return;
	});
	$("#alertMessagesMessage").html(message);
	return;
}

function localStorageTest(){
    var test = 'test';
    try {
        localStorage.setItem(test, test);
        localStorage.removeItem(test);
        return true;
    } catch(e) {
        return false;
    }
}
/********************************************************
 	On Page Load Functions 
********************************************************/
$(document).ready(function() { // Put the hiding of the middle panel first
	// Warn and (check hopefully) if storage cleared
	/* Load Previous Data */
	/* Intialize */
	initSemDropDowns(); // Occurs before displayPlans.

	if (typeof(Storage) === "undefined" && typeof localStorage === 'undefined' && localStorageTest()) {
		bootbox.alert({message: "Please note, your browswer does not allow local storage. This needs to be enabled for the program to work correctly. "+
	    		"Please use an updated browswer and/or enable local storage, alternatively clear it.", backdrop: true, size: 'small'});
	    displayPlans();
	} else {
		loadSemesters();
	}

	$('#searchOverview').keyup(function() { // bind on ready
		var searched = $('#searchOverview').val().replace('*', '').toUpperCase();
		if (searched === '') {
			$('#searchOverviewResults').html('');
			return;
		}
		for (var i = 0; i < SEMESTERS.length; i++) {
			for (var j = 0; j < SEMESTERS[i].courses.length; j++) {
				var code = SEMESTERS[i].courses[j].courseCode;
				if (findString(code.replace('*', ''), searched)) {
					$('#searchOverviewResults').html(code + ' (' + (i+1) + ')');
					return;
				}
			}
		}
		$('#searchOverviewResults').html('No Results');
		
		
	});

	/* Default Settings */
	$('[data-toggle="tooltip"]').tooltip(); // Enabled tooltips
	$('[data-toggle="tooltip"]').tooltip({trigger : 'hover'});
	$("#alertMessages").hide();


	return;
});

