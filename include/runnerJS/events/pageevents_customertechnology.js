Runner.pages.PageSettings.addPageEvent("customertechnology",
		Runner.pages.constants.PAGE_EDIT, "afterPageReady", function(pageObj,
				proxy, pageid, inlineRow, inlineObject) {
			$("#revertLink" + inlineRow.id).hide();
			$("#saveLink" + inlineRow.id).hide();
		});
Runner.pages.PageSettings.addPageEvent("customertechnology",
		Runner.pages.constants.PAGE_ADD, "afterPageReady", function(pageObj,
				proxy, pageid, inlineRow, inlineObject) {
			$("#revertLink" + inlineRow.id).hide();
			$("#saveLink" + inlineRow.id).hide();
		});

Runner.pages.PageSettings.addPageEvent("customertechnology",
		Runner.pages.constants.PAGE_LIST, "afterPageReady", function(pageObj,
				proxy, pageid, inlineRow, inlineObject) {

	//$(".rnr-b-recordcontrols_new").hide();
	//$("#edit_selected"+pageid).hide();
	
	$("#view_custtech").on( 'click', function(){
		var checked = document.querySelectorAll('[name="selection[]"]:checked');
		if( checked.length == 0 ) {
			alert("Select atleast one record.");
		} else if( checked.length > 1 ) {
			alert("Select only one record");
		} else {
			var checkedId = checked[0].id;
			$("#"+checkedId).parent('td').prev().children('a').click();
		}
	} );
	
});
