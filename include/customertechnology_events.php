<?php
class eventclass_customertechnology extends eventsBase {
	function eventclass_customertechnology() {
		// fill list of events
		$this->events ["BeforeAdd"] = true;
		
		// onscreen events
	}
	
	// handlers
	
	// Before record Added
	function BeforeAdd(&$values, &$message, $inline, &$pageObject) {
		
		// Place event code here.
		$strCuatomerName = $values['Name'];
		
		global $conn;
		$sql = 'select OracIeID from customer_header where `Name` = "' . $strCuatomerName . '"';
		
		$rs = db_query($sql,$conn);
		while ($data = db_fetch_array($rs))
			$strOracleID = $data['OracIeID'];		
			$values['CategoryID'] = $strOracleID;
			
		// Use "Add Action" button to add code snippets.
		;
	} // function BeforeShowList
		  
	// onscreen events
}
?>
