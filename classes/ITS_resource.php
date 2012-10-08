<?php
/*=====================================================================//
ITS_resource - search box class.
		ajax/ITS_resource.php

		Constructor: ITS_resource( ... )	

						ex. $search = new ITS_resource( ... );
								
	 Author(s): Greg Krudysz
	 Last Update: Sep-27-2012	 
//=====================================================================*/
class ITS_resource {
	
	public function __construct() {
		global $db_dsn,$tb_name;
		
		$this->db_dsn  = $db_dsn;
		$this->tb_name = $tb_name;
		
		// connect to database
		$mdb2 =& MDB2::connect($db_dsn);
		if (PEAR::isError($mdb2)){throw new Exception($this->mdb2->getMessage());}
		$this->mdb2 = $mdb2;
	}
	//=====================================================================//
	public function renderBox($rtb,$rid){
	//=====================================================================//
	    //if (empty($rating)) { $rating = 0; }
		//$box = '<hr class="ITS_search"><input id="ITS_search_box" type="text" name="keyword" rtb="'.$rtb.'" rid="'.$rid.'">'.
        //       '<div class="ITS_search"></div></p>';		
 		$box = '<input id="ITS_search_box" type="text" name="keyword" rtb="'.$rtb.'" rid="'.$rid.'">';              					 
               	 																	
		return $box;	
	}	
	//=====================================================================//
	public function renderResultsBox(){
	//=====================================================================//	
 		$box = '<hr class="ITS"><div class="ITS_search"></div>';              					 
               	 																	
		return $box;	
	}	
//=====================================================================//
} //eo:class
//=====================================================================//
?>