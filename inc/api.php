<?php

	date_default_timezone_set('America/Los_Angeles');

	require_once('Classes/PHPExcel.php');
	require_once('Classes/PHPExcel/Writer/Excel2007.php');
	require_once('Classes/PHPExcel/IOFactory.php');

	function getRegistration($inputFileName){
		//  Read your Excel workbook
		try {
			$inputFileType = PHPExcel_IOFactory::identify($inputFileName);
			$objReader     = PHPExcel_IOFactory::createReader($inputFileType);
			$objPHPExcel   = $objReader->load($inputFileName);
		} catch (Exception $e) {
			die('Download Excel-file on the server');
		}

		//  Get worksheet dimensions
		$sheet         = $objPHPExcel->getSheet(0);
		$highestRow    = $sheet->getHighestRow();
		$highestColumn = $sheet->getHighestColumn();

		//  Loop through each row of the worksheet in turn
		$_KARTINA_TV = array();
		for( $row = 1; $row <= 100; $row++ ){
			//  Read a row of data into an array
			$rowData = $sheet->rangeToArray('A' . $row . ':' . 'AA' . $row, NULL, TRUE, FALSE);
			foreach( $rowData[0] as $col=>$v ){
				if( $col == 0 && $v == null ) break;
				if( $col < 3 ){
					$_KARTINA_TV[($row-1)][$col] = $v;
				} else {
					if( 1 < $row  ){
						if( $col == 3 ){
							if( filter_var($v, FILTER_VALIDATE_INT) !== false ){
								$_KARTINA_TV[($row-1)][$col]     = $v == null ? null : date('d.m.Y', PHPExcel_Shared_Date::ExcelToPHP(($v+1))); // INT
								$_KARTINA_TV[($row-1)]['status'] = (date(PHPExcel_Shared_Date::ExcelToPHP(($v+1)))-time()) < 0 ? "#fee" : "";
							} else {
								$_KARTINA_TV[($row-1)][$col]     = $v == null ? null : $v;                                                      // DATE
								$_KARTINA_TV[($row-1)]['status'] = (strtotime($v)-strtotime(date('d.m.Y'))) < 0 ? "#fee" : "";
							}
						} else {
							if( $col == 7 ){
								if( filter_var($v, FILTER_VALIDATE_INT) !== false ){
									$_KARTINA_TV[($row-1)][$col]     = $v == null ? null : date('d.m.Y', PHPExcel_Shared_Date::ExcelToPHP(($v+1))); // INT
								} else {
									$_KARTINA_TV[($row-1)][$col]     = $v == null ? null : $v;                                                      // DATE
								}
							} else {
								$_KARTINA_TV[($row-1)][$col] = $v;
							}
						}
						if( ($col == 5 && $v != null) || ($col == 6 && $v != null) ) $_KARTINA_TV[($row-1)]['status'] = "#ffd";
					} else {
						$_KARTINA_TV[($row-1)][$col] = $v;
					}
				}
			}
		}
		
		return $_KARTINA_TV;
	}

	function editRegistration($inputFileName, $_KARTINA_TV, $_edit_id, $_edit_login, $_edit_password, $_edit_activation, $_edit_name, $_edit_email, $_edit_phone, $_edit_datatime){
		$objPHPExcel_2 = new PHPExcel();
		/*
		 *  Set properties
		 */
		//echo date('H:i:s') . " Set properties<br />";
		$objPHPExcel_2->getProperties()->setCreator("Runnable.com");
		$objPHPExcel_2->getProperties()->setLastModifiedBy("Runnable.com");
		$objPHPExcel_2->getProperties()->setTitle("Office 2007 XLSX Test Document");
		$objPHPExcel_2->getProperties()->setSubject("Office 2007 XLSX Test Document");
		$objPHPExcel_2->getProperties()->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.");
		/*
		 * Add some data
		 */
		//echo date('H:i:s') . " Add some data<br />";
		$objPHPExcel_2->setActiveSheetIndex(0);
		$objPHPExcel_2->getActiveSheet()->SetCellValue('A1', '№');
		$objPHPExcel_2->getActiveSheet()->SetCellValue('B1', 'логин');
		$objPHPExcel_2->getActiveSheet()->SetCellValue('C1', 'пароль');
		$objPHPExcel_2->getActiveSheet()->SetCellValue('D1', 'дата активации');
		$objPHPExcel_2->getActiveSheet()->SetCellValue('E1', 'name');
		$objPHPExcel_2->getActiveSheet()->SetCellValue('F1', 'email');
		$objPHPExcel_2->getActiveSheet()->SetCellValue('G1', 'phone');
		$objPHPExcel_2->getActiveSheet()->SetCellValue('H1', 'DataTime');
		for( $row = 1; $row <= (count($_KARTINA_TV)-1); $row++ ){
			$_row = $row + 1;
			$objPHPExcel_2->getActiveSheet()->SetCellValue("A$_row", $_KARTINA_TV[$row][0]);
			if($row == $_edit_id){
				$objPHPExcel_2->getActiveSheet()->SetCellValue("B$_row", $_edit_login);
				$objPHPExcel_2->getActiveSheet()->SetCellValue("C$_row", $_edit_password);
				$objPHPExcel_2->getActiveSheet()->SetCellValue("D$_row", $_edit_activation);
				$objPHPExcel_2->getActiveSheet()->SetCellValue("E$_row", $_edit_name);
				$objPHPExcel_2->getActiveSheet()->SetCellValue("F$_row", $_edit_email);
				$objPHPExcel_2->getActiveSheet()->SetCellValue("G$_row", $_edit_phone);
				$objPHPExcel_2->getActiveSheet()->SetCellValue("H$_row", $_edit_datatime);
			} else {
				$objPHPExcel_2->getActiveSheet()->SetCellValue("B$_row", $_KARTINA_TV[$row][1]);
				$objPHPExcel_2->getActiveSheet()->SetCellValue("C$_row", $_KARTINA_TV[$row][2]);
				$objPHPExcel_2->getActiveSheet()->SetCellValue("D$_row", $_KARTINA_TV[$row][3]);
				$objPHPExcel_2->getActiveSheet()->SetCellValue("E$_row", $_KARTINA_TV[$row][4]);
				$objPHPExcel_2->getActiveSheet()->SetCellValue("F$_row", $_KARTINA_TV[$row][5]);
				$objPHPExcel_2->getActiveSheet()->SetCellValue("G$_row", $_KARTINA_TV[$row][6]);
				$objPHPExcel_2->getActiveSheet()->SetCellValue("H$_row", $_KARTINA_TV[$row][7]);
			}
		}
		/*
		 * Rename sheet
		 */
		//echo date('H:i:s') . " Rename sheet<br />";
		$objPHPExcel_2->getActiveSheet()->setTitle('Mailing');
		/*
		 * Save Excel 2007 file
		 * These lines are commented just for this demo purposes This is how the excel file is written to the disk, but in this case we don't need them since the file was written at the first run
		 */
		//echo date('H:i:s') . " Write to Excel2007 format<br />";
		$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel_2);
		$objWriter->save($inputFileName);
	}

	function addRegistration($inputFileName, $_KARTINA_TV, $_add_name, $_add_email, $_add_phone, $_add_datatime){
		/*
		 * Create new PHPExcel object
		 */
		//echo date('H:i:s') . " Create new PHPExcel object<br />";
		$objPHPExcel_2 = new PHPExcel();
		/*
		 * Set properties
		 */
		//echo date('H:i:s') . " Set properties<br />";
		$objPHPExcel_2->getProperties()->setCreator("Runnable.com");
		$objPHPExcel_2->getProperties()->setLastModifiedBy("Runnable.com");
		$objPHPExcel_2->getProperties()->setTitle("Office 2007 XLSX Test Document");
		$objPHPExcel_2->getProperties()->setSubject("Office 2007 XLSX Test Document");
		$objPHPExcel_2->getProperties()->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.");
		/*
		 * Add some data
		 */
		//echo date('H:i:s') . " Add some data<br />";
		$objPHPExcel_2->setActiveSheetIndex(0);
		$objPHPExcel_2->getActiveSheet()->SetCellValue('A1', '№');
		$objPHPExcel_2->getActiveSheet()->SetCellValue('B1', 'логин');
		$objPHPExcel_2->getActiveSheet()->SetCellValue('C1', 'пароль');
		$objPHPExcel_2->getActiveSheet()->SetCellValue('D1', 'дата активации');
		$objPHPExcel_2->getActiveSheet()->SetCellValue('E1', 'name');
		$objPHPExcel_2->getActiveSheet()->SetCellValue('F1', 'email');
		$objPHPExcel_2->getActiveSheet()->SetCellValue('G1', 'phone');
		$objPHPExcel_2->getActiveSheet()->SetCellValue('H1', 'DataTime');
		for( $row = 1; $row <= (count($_KARTINA_TV)-1); $row++ ){
			$_row = $row + 1;
			$objPHPExcel_2->getActiveSheet()->SetCellValue("A$_row", $_KARTINA_TV[$row][0]);
			$objPHPExcel_2->getActiveSheet()->SetCellValue("B$_row", $_KARTINA_TV[$row][1]);
			$objPHPExcel_2->getActiveSheet()->SetCellValue("C$_row", $_KARTINA_TV[$row][2]);
			$objPHPExcel_2->getActiveSheet()->SetCellValue("D$_row", $_KARTINA_TV[$row][3]);
			$objPHPExcel_2->getActiveSheet()->SetCellValue("E$_row", $_KARTINA_TV[$row][4]);
			$objPHPExcel_2->getActiveSheet()->SetCellValue("F$_row", $_KARTINA_TV[$row][5]);
			$objPHPExcel_2->getActiveSheet()->SetCellValue("G$_row", $_KARTINA_TV[$row][6]);
			$objPHPExcel_2->getActiveSheet()->SetCellValue("H$_row", $_KARTINA_TV[$row][7]);
		}
		$_row = $row + 1;
		$objPHPExcel_2->getActiveSheet()->SetCellValue("A$_row", $row);
		$objPHPExcel_2->getActiveSheet()->SetCellValue("B$_row", '');
		$objPHPExcel_2->getActiveSheet()->SetCellValue("C$_row", '');
		$objPHPExcel_2->getActiveSheet()->SetCellValue("D$_row", '');
		$objPHPExcel_2->getActiveSheet()->SetCellValue("E$_row", $_add_name);
		$objPHPExcel_2->getActiveSheet()->SetCellValue("F$_row", $_add_email);
		$objPHPExcel_2->getActiveSheet()->SetCellValue("G$_row", $_add_phone);
		$objPHPExcel_2->getActiveSheet()->SetCellValue("H$_row", $_add_datatime);
		$_row = $_row + 1;
		$objPHPExcel_2->getActiveSheet()->SetCellValue("A$_row", '');
		$objPHPExcel_2->getActiveSheet()->SetCellValue("B$_row", '');
		$objPHPExcel_2->getActiveSheet()->SetCellValue("C$_row", '');
		$objPHPExcel_2->getActiveSheet()->SetCellValue("D$_row", '');
		$objPHPExcel_2->getActiveSheet()->SetCellValue("E$_row", '');
		$objPHPExcel_2->getActiveSheet()->SetCellValue("F$_row", '');
		$objPHPExcel_2->getActiveSheet()->SetCellValue("G$_row", '');
		$objPHPExcel_2->getActiveSheet()->SetCellValue("H$_row", '');
		/*
		 *  Rename sheet
		 */
		//echo date('H:i:s') . " Rename sheet<br />";
		$objPHPExcel_2->getActiveSheet()->setTitle('Mailing');
		/*
		 *  Save Excel 2007 file
		 *  These lines are commented just for this demo purposes This is how the excel file is written to the disk, but in this case we don't need them since the file was written at the first run
		 */
		//echo date('H:i:s') . " Write to Excel2007 format<br />";
		$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel_2);
		$objWriter->save($inputFileName);
	}

?>