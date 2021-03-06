<?php
class eventclass_customerallocation extends eventsBase {
	
	function eventclass_customerallocation() {
		// fill list of events
		$this->events ["BeforeMoveNextList"] = true;
		
		$this->events ["BeforeEdit"] = true;
		
		$this->events ["BeforeAdd"] = true;
		
		$this->events ["BeforeProcessRowList"] = true;
		
		$this->events ["BeforeShowAdd"] = true;
	
		// onscreen events
		$this->events ["customerallocation_snippet3"] = true;
		$this->events ["customerallocation_snippet6"] = true;
		$this->events ["customerallocation_snippet1"] = true;
	}
	
	// handlers
	
	// List page: After record processed
	function BeforeMoveNextList(&$data, &$row, &$record, &$pageObject) {
		
		if ( false == empty( $values["EndDate"] ) && $data["EndDate"] <= Now ())
			$record ["EndDate_style"] = 'style="background:orange"';
		
		if ($data ["StartDate"] >= Now ())
			$record ["StartDate_style"] = 'style="background:#CFFFCF"';
		
		if ($data ["Override"] > "0")
			$record ["Override_style"] = 'style="background:Red"';
			// $record["Override_value"]="<span style=\"width:55px;font-size:16px;background:red;color:white\">".$record["Override_value"]."</span>";
			
		// Place event code here.
			// Use "Add Action" button to add code snippets.
		;
	} // function BeforeMoveNextList
	  // Before record updated
	function BeforeEdit(&$values, $where, &$oldvalues, &$keys, &$message, $inline, &$pageObject) {
		if ($values ["Override"] > .0)
			$values ["Allocation"] = $values ["Override"];
		
		if (false == isset ( $values ["Contract_End"] ) && toPHPTime ( $values ["EndDate"] ) > toPHPTime ( $values ["Contract_End"] )) {
			$message = "End date can not exceed the Contract End Date.";
			return false;
		} else {
			return true;
		}
		
		/* if ( ( false == isset ( $values ["Contract_End"] ) || false == isset ( $values ["EndDate"] ) ) && ( toPHPTime ( $values ["StartDate"] ) > toPHPTime ( $values ["EndDate"] ) || toPHPTime ( $values ["StartDate"] ) > toPHPTime ( $values ["Contract_End"] ) ) ) {
			$message = "Start date can not be later than End date.";
			return false;
		} else {
			return true;
		} */
		
		if ( false == isset ( $values ["EndDate"] ) && toPHPTime ( $values ["StartDate"] ) > toPHPTime ( $values ["EndDate"] ) ) {
			$message = "Start date can not be later than End date.";
			return false;
		} else {
			return true;
		}
		// Place event code here.
		// Use "Add Action" button to add code snippets.
		
		return true;
		
		;
	} // function BeforeEdit
	  // Before record added
	function BeforeAdd(&$values, &$message, $inline, &$pageObject) {
		global $conn;
		$strSql = 'SELECT OracIeID, Name, Size, Stage, Contract_Start, Contract_end, TransStartDate, TransEndDate, SteadyState from customer_header where OracIeID = "' . $values ["OracleID"] . '"';
		$rs = db_query($strSql, $conn);
		while ($data = db_fetch_array($rs)) {
			$TransStartDate = $data['TransStartDate'];
			$TransEndDate = $data['TransEndDate'];
			$steadyStateDate = $data['SteadyState'];
			$stage = $data['Stage'];
		}
		
		if( '3' == $stage && $values['Stage'] < 90 ) {
			//print_r($pageObject); exit;
			$message = "Customer Stage cannot be changed from steady state to transition ";
			return false;
		} else {
			return true;
		}
		
		if( ( '2' == $stage || 'Transition' == $values['Stage'] )&& false == is_null( $TransStartDate ) && false == is_null( $steadyStateDate ) ) {
			$message = " Start Date should be in between Transition Start Date and Staedy State Date";
			return false;
		} else {
			return true;
		}

		if (false == empty ( $values ["OracleID"] ) && false == empty ( $values ["Contract_End"] ) && toPHPTime ( $values ["EndDate"] ) > toPHPTime ( $values ["Contract_End"] )) {
			$message = "End date can not exceed the Contract End Date.";
			return false;
		} else {
			return true;
		}
		// Place event code here.
		// Use "Add Action" button to add code snippets.
		if ((false == is_null ( $values ["CustomerName"] ) || false == is_null ( $values ["OracleID"] || false == isset ( $values ["Contract_End"] ) || false == isset ( $values ["EndDate"] ) ) ) && toPHPTime ( $values ["StartDate"] ) > toPHPTime ( $values ["EndDate"] || toPHPTime ( $values ["StartDate"] ) > toPHPTime ( $values ["Contract_End"] ) ) ) {
			$message = "Start date can not be later than End date.";
			return false;
		} else {
			return true;
		}
		;
	} // function BeforeAdd
	  
	// List page: Before record processed
	function BeforeProcessRowList(&$data, &$pageObject) {
		if ($data ["Override"] > "0%")
			$record ["Override_style"] = 'style="background:Red"';
			
			// Place event code here.
			// Use "Add Action" button to add code snippets.
		
		return true;
		;
	} // function BeforeProcessRowList
	  
	// Before display
	function BeforeShowAdd(&$xt, &$templatefile, &$pageObject) {
		$values ["Allocation"] = $values ["Override"];

		global $conn;
		$CustomerNameList = array();
		$modelAllocationDetails = array();
		$strSql = 'SELECT 
		 				OracIeID, Name, Size, Stage, Contract_Start, Contract_end, Engagement_status, SteadyState, Overall_Temp, PrimaryTimeZone, `Onshore Support` as OnshoreSupport, TransStartDate, TransEndDate 
		 			FROM 
		 				customer_header 
		 			WHERE 
		 				Engagement_status <> "Terminated" 
		 			ORDER BY 
		 				Name';
		 $rs = db_query($strSql, $conn);
		 while ($data = db_fetch_array($rs))
		 	$CustomerNameList[] = $data;
		 
		 $strSql1 = 'SELECT * from Stage2 order by CategoryID';
		 $rs1 = db_query($strSql1, $conn );
		 while( $data1 = db_fetch_array($rs1) )
		 	$modelAllocationDetails[] = $data1;
		 
		 $pageObject->setProxyValue("CustomerNameList", $CustomerNameList);
		 $pageObject->setProxyValue("AllocationModelDetails", $modelAllocationDetails);
		  
		// Place event code here.
		// Use "Add Action" button to add code snippets.
		;
	} // function BeforeShowAdd

	// onscreen events
	function customerallocation_snippet3(&$params) {
		
		if( false == is_null( $_SESSION['UserName'] ) ) {
			$userName = $_SESSION['UserName'];
		}

		if( false == is_null( $_SESSION['UserID']) ) {
			$userID = $_SESSION["UserID"];
			$groupID = $_SESSION["UserRights"][$userID][".Groups"][0];
		}

		$str = "<select onchange=\"window.location.href=this.options[this." . "selectedIndex].value;\"><option value=\"\">Please select</option>";
		
		// select values from database
		
		global $conn;
		$strSQL1 = "SELECT DISTINCT td.SupervisorID, td.FullName FROM customerallocation ca JOIN tbl_director td ON( ca.Supervisor = td.SupervisorID ) WHERE td.FullName = '" . $userName . "'";
		$rs = db_query($strSQL1,$conn);
		while ($data = db_fetch_array($rs))
			$supervisorID = $data['SupervisorID'];
		
		if( !IsAdmin() && '5' == $groupID ) {
			$strSQL = "select DISTINCT RSAName from customerallocation order by RSAName";
		} elseif( !IsAdmin() && '6' == $groupID ) {
			$strSQL = "select DISTINCT RSAName from customerallocation where RSAName = '" . $userName . "' OR Supervisor = '" . $supervisorID . "' OR Supervisor IN ( SELECT EmployeeID FROM employee_header eh where eh.SupervisorID = '" . $supervisorID . "' ) order by RSAName";
		} elseif( !IsAdmin() && '7' == $groupID ) {
			$strSQL = "select DISTINCT RSAName from customerallocation where RSAName = '" . $userName . "' OR Supervisor = '" . $supervisorID . "' order by RSAName";
		} elseif( !IsAdmin() && '1' == $groupID ) {
			$strSQL = "select DISTINCT RSAName from customerallocation where RSAName = '" . $userName . "' order by RSAName";
		} else {
			$strSQL = "select DISTINCT RSAName from customerallocation order by RSAName";
			//$strSQL = "select FirstName, LastName from employee_header WHERE EmployeeStatus == 'Yes' order by EmployeeID";
		}
		
		$rs = db_query ( $strSQL, $conn );
		
		while ( $data = db_fetch_array ( $rs ) )
			
			$str .= "<option value='customerallocation_list.php?q=(RSAName~equals~" . 

			$data ["RSAName"] . ")'>" . $data ["RSAName"] . "</option>";
		
		$str .= "</select>";
		
		echo $str;
		;
	}
	function customerallocation_snippet6(&$params) {
		
		if( false == is_null( $_SESSION['UserName'] ) ) {
			$userName = $_SESSION['UserName'];
		}

		if( false == is_null( $_SESSION['UserID']) ) {
			$userID = $_SESSION["UserID"];
			$groupID = $_SESSION["UserRights"][$userID][".Groups"][0];
		}
		
		$str = "<select style=\"width:300px;\" onchange=\"window.location.href=this.options[this." . "selectedIndex].value;\"><option value=\"\">Please select</option>";
		
		// select values from database
		
		global $conn;
		$strSQL1 = "SELECT DISTINCT td.SupervisorID, td.FullName FROM customerallocation ca JOIN tbl_director td ON( ca.Supervisor = td.SupervisorID ) WHERE td.FullName = '" . $userName . "'";
		$rs = db_query($strSQL1,$conn);
		while ($data = db_fetch_array($rs))
			$supervisorID = $data['SupervisorID'];
		if( !IsAdmin() && '5' == $groupID ) {
			$strSQL = "select DISTINCT CustomerName from customerallocation order by CustomerName";
		} elseif( !IsAdmin() && '6' == $groupID ) {
			$strSQL = "select DISTINCT CustomerName from customerallocation where RSAName = '" . $userName . "' OR Supervisor = '" . $supervisorID . "' OR Supervisor IN ( SELECT EmployeeID FROM employee_header eh where eh.SupervisorID = '" . $supervisorID . "' ) order by CustomerName";
		} elseif( !IsAdmin() && '7' == $groupID ) {
			$strSQL = "select DISTINCT CustomerName from customerallocation where RSAName = '" . $userName . "' OR Supervisor = '" . $supervisorID . "' order by CustomerName";
		} elseif( !IsAdmin() && '1' == $groupID ) {
			$strSQL = "select DISTINCT CustomerName from customerallocation where RSAName = '" . $userName . "' order by CustomerName";
		} else {
			$strSQL = "select DISTINCT CustomerName from customerallocation order by CustomerName";
		}
		
		$rs = db_query ( $strSQL, $conn );
		
		while ( $data = db_fetch_array ( $rs ) )
			
			$str .= "<option value='customerallocation_list.php?q=(CustomerName~equals~" . 

			$data ["CustomerName"] . ")'>" . $data ["CustomerName"] . "</option>";
		
		$str .= "</select>";
		
		echo $str;
		
		// Place event code here.
		// Use "Add Action" button to add code snippets.
		;
	}

	function customerallocation_snippet1(&$params) {
		
		if( false == is_null( $_SESSION['UserName'] ) ) {
			$userName = $_SESSION['UserName'];
		}
		
		if( false == is_null( $_SESSION['UserID']) ) {
			$userID = $_SESSION["UserID"];
			$groupID = $_SESSION["UserRights"][$userID][".Groups"][0];
		}

		$str= "<select onchange=\"window.location.href=this.options[this." . "selectedIndex].value;\"><option value=\"\">Please select</option>";
		
		//select values from database
		
		global $conn;
		$strSQL1 = "SELECT DISTINCT td.SupervisorID, td.FullName FROM customerallocation ca JOIN tbl_director td ON( ca.Supervisor = td.SupervisorID ) WHERE td.FullName = '" . $userName . "'";
		$rs = db_query($strSQL1,$conn);
		while ($data = db_fetch_array($rs))
			$supervisorID = $data['SupervisorID'];

		if( !IsAdmin() && '5' == $groupID) {
			$strSQL = "select DISTINCT td.SupervisorID, td.FullName from customerallocation ca LEFT JOIN tbl_director td ON( ca.Supervisor = td.SupervisorID ) order by Supervisor";
		} elseif( !IsAdmin() && '6' == $groupID ) {
			$strSQL = "select DISTINCT td.SupervisorID, td.FullName from customerallocation ca LEFT JOIN tbl_director td ON( ca.Supervisor = td.SupervisorID ) where ca.RSAName = '" . $userName . "' OR Supervisor = '" . $supervisorID . "' OR Supervisor IN ( SELECT EmployeeID FROM employee_header eh where eh.SupervisorID = '" . $supervisorID . "' ) order by Supervisor";
		} elseif( !IsAdmin() && '7' == $groupID ) {
			$strSQL = "select DISTINCT td.SupervisorID, td.FullName from customerallocation ca LEFT JOIN tbl_director td ON( ca.Supervisor = td.SupervisorID ) where ca.RSAName = '" . $userName . "' OR Supervisor = '" . $supervisorID . "' order by Supervisor";
		} elseif( !IsAdmin() && '1' == $groupID) {
			$strSQL = "select DISTINCT td.SupervisorID, td.FullName from customerallocation ca LEFT JOIN tbl_director td ON( ca.Supervisor = td.SupervisorID ) where ca.RSAName = '" . $userName . "' order by Supervisor";
		} else {
			$strSQL = "select DISTINCT td.SupervisorID, td.FullName from customerallocation ca LEFT JOIN tbl_director td ON( ca.Supervisor = td.SupervisorID ) order by Supervisor";
		}

		$rs = db_query($strSQL,$conn);
		
		while ($data = db_fetch_array($rs))
		
		
			$str.="<option value='customerallocation_list.php?q=(Supervisor~equals~".
		
			$data["SupervisorID"].")'>".$data["FullName"]."</option>";
		
			$str.="</select>";
		
			echo $str;
		
		// Place event code here.
		;
	}
}
?>