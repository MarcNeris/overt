"use strict";
var redips = {};

redips.init = function () {
	//var num = 10,

	var	rd = REDIPS.drag;
	// initialization
	rd.init();
	// REDIPS.drag settings
	rd.dropMode = 'multiple';			// dragged elements can be placed only to the empty cells
	rd.hover.colorTd = '#9BB3DA';	// set hover color
	rd.clone.keyDiv = false;			// enable cloning DIV elements with pressed SHIFT key
	// prepare node list of DIV elements in table2
	redips.divNodeList = document.getElementById('table2').getElementsByTagName('div');
	console.log(redips.divNodeList);
	// show / hide report buttons (needed for dynamic version - with index.php)
	//redips.reportButton();
	// element is dropped
	rd.event.dropped = function () {
		var	objOld = rd.objOld,					// original object
			targetCell = rd.td.target,			// target cell
			targetRow = targetCell.parentNode,	// target row
			i, objNew;							// local variables
		// if checkbox is checked and original element is of clone type then clone spread subjects to the week
	
		// print message only if target and source table cell differ
		if (rd.td.target !== rd.td.source) { 
			redips.printMessage('Salvando as alterações...');
		}
		redips.save();
		// show / hide report buttons
		//redips.reportButton();
	};

	// after element is deleted from the timetable, print message
	rd.event.deleted = function () {
		redips.save();
		redips.reportButton();
	};
	
	// if any element is clicked, then make all subjects in timetable visible
	rd.event.clicked = function () {
		redips.showAll();
	};
};


// save elements and their positions
redips.save = function () {
	var content = REDIPS.drag.saveContent('table2');
	window.location.href = 'db_save.php?' + content;
};

redips.printMessage = function (message) {
	document.getElementById('message').innerHTML = message;
};

redips.showAll = function () {
	var	i; // loop variable
	for (i = 0; i < redips.divNodeList.length; i++) {
		redips.divNodeList[i].style.visibility = 'visible';
	}
};

if (window.addEventListener) {
	window.addEventListener('load', redips.init, false);
}
else if (window.attachEvent) {
	window.attachEvent('onload', redips.init);
}