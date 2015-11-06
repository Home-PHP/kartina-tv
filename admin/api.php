<?php

	require_once('../inc/htmlMimeMail5/htmlMimeMail5.php');

	/* Set default timezone (will throw a notice otherwise) */
	ini_set('date.timezone', 'Europe/Kiev');
	date_default_timezone_set('America/Los_Angeles');

	/** PHPExcel */
	include '../inc/Classes/PHPExcel.php';

	/** PHPExcel_Writer_Excel2007 */
	include '../inc/Classes/PHPExcel/Writer/Excel2007.php'; //include 'Classes/PHPExcel/Writer/Excel5.php';

	/** PHPExcel_Reader */
	include '../inc/Classes/PHPExcel/IOFactory.php';



	if($_POST["delete-id"]){ $_delete_id = $_POST["delete-id"]; }else{ $_delete_id = null; }
	if($_POST["edit-id"]){ $_edit_id = $_POST["edit-id"]; }else{ $_edit_id = null; }
	if($_POST["edit-login"]){ $_edit_login = $_POST["edit-login"]; }else{ $_edit_login = null; }
	if($_POST["edit-password"]){ $_edit_password = $_POST["edit-password"]; }else{ $_edit_password = null; }
	if($_POST["edit-activation"]){ $_edit_activation = $_POST["edit-activation"]; }else{ $_edit_activation = null; }
	if($_POST["edit-name"]){ $_edit_name = $_POST["edit-name"]; }else{ $_edit_name = null; }
	if($_POST["edit-email"]){ $_edit_email = $_POST["edit-email"]; }else{ $_edit_email = null; }
	if($_POST["edit-phone"]){ $_edit_phone = $_POST["edit-phone"]; }else{ $_edit_phone = null; }
	if($_POST["edit-datatime"]){ $_edit_datatime = $_POST["edit-datatime"]; }else{ $_edit_datatime = null; }
	if($_POST["add-id"]){ $_add_id = $_POST["add-id"]; }else{ $_add_id = null; }
	if($_POST["add-login"]){ $_add_login = $_POST["add-login"]; }else{ $_add_login = null; }
	if($_POST["add-password"]){ $_add_password = $_POST["add-password"]; }else{ $_add_password = null; }
	if($_POST["add-activation"]){ $_add_activation = $_POST["add-activation"]; }else{ $_add_activation = null; }
	if($_POST["add-name"]){ $_add_name = $_POST["add-name"]; }else{ $_add_name = null; }
	if($_POST["add-email"]){ $_add_email = $_POST["add-email"]; }else{ $_add_email = null; }
	if($_POST["add-phone"]){ $_add_phone = $_POST["add-phone"]; }else{ $_add_phone = null; }
	if($_POST["add-datatime"]){ $_add_datatime = $_POST["add-datatime"]; }else{ $_add_datatime = null; }
	if($_POST["receiver-email"]){ $_receiver_email = $_POST["receiver-email"]; }else{ $_receiver_email = null; }
	if($_POST["edit-email-text"]){ $_edit_email_text = $_POST["edit-email-text"]; }else{ $_edit_email_text = null; }
/* 	echo "      delete-id: " . $_delete_id;
	echo "<br />        edit-id: " . $_edit_id;
	echo "<br />     edit-login: " . $_edit_login;
	echo "<br />  edit-password: " . $_edit_password;
	echo "<br />edit-activation: " . $_edit_activation;
	echo "<br />      edit-name: " . $_edit_name;
	echo "<br />     edit-email: " . $_edit_email;
	echo "<br />     edit-phone: " . $_edit_phone;
	echo "<br />  edit-datatime: " . $_edit_datatime;
	echo "<br />         add-id: " . $_add_id;
	echo "<br />      add-login: " . $_add_login;
	echo "<br />   add-password: " . $_add_password;
	echo "<br /> add-activation: " . $_add_activation;
	echo "<br />       add-name: " . $_add_name;
	echo "<br />      add-email: " . $_add_email;
	echo "<br />      add-phone: " . $_add_phone;
	echo "<br />   add-datatime: " . $_add_datatime;
	echo "<br />   receiver-email: " . $_receiver_email;
	echo "<br />   edit-email-text: " . $_edit_email_text;
	echo "<br />"; */



	function send_mail_client($email, $login, $password, $DataTime){
		$text = file_get_contents("../raport/text_email_client.txt"); //$text = file_get_contents("$_home/$_work/text_email_client.txt");
		$text = str_replace('__LOGIN__',$login,$text);
		$text = str_replace('__PASSWORD__',$password,$text);
		$text = str_replace('__DATATIME__',$DataTime,$text);

		$mailSend = new htmlMimeMail5();
		$helo = "Kartina.TV";
		$mailSend->setFrom('Kartina.TV <'.MAILUSER.'>');
		$mailSend->setTextCharset('utf-8');
		$mailSend->setHtmlCharset('utf-8');
		$mailSend->setHeadCharset('utf-8');
		$mailSend->setSubject('Видео-сервисКаrtina.TV (Протестировать)');
		$mailSend->setHTML($text);
		$mailSend->send(array($email),mail);
	}


	/*
	 * (Работа с Excel средствами PHP) http://tokmakov.msk.ru/blog/psts/7/
	 * URL: http://code.runnable.com/Uot2A2l8VxsUAAAR/read-a-simple-2007-xlsx-excel-file-for-php
	 * URL: https://github.com/PHPOffice/PHPExcel
	 * URL: http://ru.stackoverflow.com/questions/439773/phpexcel-работа-с-датой
	 *     ( http://stackoverflow.com/questions/10242879/read-excel-xlsx-file-using-simplexlsx-in-php )
	 * ******************************************
	 * PHP Excel - Read a simple 2007 XLSX Excel file
	 */

	//  Read your Excel workbook
	try {
		$inputFileType = PHPExcel_IOFactory::identify("$_home/$_work/$_xlsx_file_name.$_input_file_type");
		$objReader     = PHPExcel_IOFactory::createReader($inputFileType);
		$objPHPExcel   = $objReader->load("$_home/$_work/$_xlsx_file_name.$_input_file_type");
	} catch (Exception $e) {
		die('<font color="red">Загрузите Excel-файл на сервер</font>'); // die('<font color="red">Загрузите файл <u>' . pathinfo($inputFileName, PATHINFO_BASENAME) . '</u> на сервер</font>'); // die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME) . '": ' . $e->getMessage());
	}

	//  Get worksheet dimensions
	$sheet         = $objPHPExcel->getSheet(0);
	$highestRow    = $sheet->getHighestRow();
	$highestColumn = $sheet->getHighestColumn();

	//  Loop through each row of the worksheet in turn
	$_KARTINA_TV = array();
	for( $row = 1; $row <= 100; $row++ ){ // for ($row = 1; $row <= $highestRow; $row++) {
		//  Read a row of data into an array
		$rowData = $sheet->rangeToArray('A' . $row . ':' . 'AA' . $row, NULL, TRUE, FALSE); // $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE);
		foreach( $rowData[0] as $col=>$v ){
			if( $col == 0 && $v == null ) break;
			if( $col < 3 ){
				$_KARTINA_TV[($row-1)][$col] = $v; // echo "Row: ".$row."- Col: ".$col." = ".$v."<br />";
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



	/*
	 * PHP Excel - Create a simple 2007 XLSX Excel file
	 * ************************************************
	 * URL: http://code.runnable.com/UotpH3EQecETAAAR/create-a-simple-2007-xlsx-excel-file-for-php
	 *     ( http://www.zedwood.com/article/php-xlsx-spreadsheet-creator )
	 * URL: http://codeblow.com/questions/phpexcel-modify-existing-xlsx-file-with-multiple/
	 *     ( http://stackoverflow.com/questions/7594444/phpexcel-modify-existing-xlsx-file-with-multiple-worksheet )
	 * URL: http://habrahabr.ru/post/245233/
	 *     ( http://php.javascriptag.com/95_20297205/ )
	 */

	if($_POST["add-login"]){
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
		$objPHPExcel_2->getActiveSheet()->SetCellValue("B$_row", $_add_login);
		$objPHPExcel_2->getActiveSheet()->SetCellValue("C$_row", $_add_password);
		$objPHPExcel_2->getActiveSheet()->SetCellValue("D$_row", $_add_activation);
		$objPHPExcel_2->getActiveSheet()->SetCellValue("E$_row", ''); //$objPHPExcel_2->getActiveSheet()->SetCellValue("E$_row", $_add_name);
		$objPHPExcel_2->getActiveSheet()->SetCellValue("F$_row", ''); //$objPHPExcel_2->getActiveSheet()->SetCellValue("F$_row", $_add_email);
		$objPHPExcel_2->getActiveSheet()->SetCellValue("G$_row", ''); //$objPHPExcel_2->getActiveSheet()->SetCellValue("G$_row", $_add_phone);
		$objPHPExcel_2->getActiveSheet()->SetCellValue("H$_row", ''); //$objPHPExcel_2->getActiveSheet()->SetCellValue("H$_row", $_add_datatime);
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
		$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel_2); //$objWriter = new PHPExcel_Writer_Excel5($objPHPExcel_2);
		$objWriter->save("$_home/$_work/$_xlsx_file_name.$_input_file_type");
		/*
		 *  Echo done
		 */
		//echo date('H:i:s') . " Done writing file. It can be downloaded by <a href='ftp://kartina-tv.mediaplayer.com.ua/public_html/raport/NewKartinaTV.xlsx'>clicking here</a>";
	}

	if($_POST["edit-id"]){
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
		$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel_2); //$objWriter = new PHPExcel_Writer_Excel5($objPHPExcel_2);
		$objWriter->save("$_home/$_work/$_xlsx_file_name.$_input_file_type");
		/*
		 * Echo done
		 */
		//echo date('H:i:s') . " Done writing file. It can be downloaded by <a href='ftp://kartina-tv.mediaplayer.com.ua/public_html/raport/NewKartinaTV.xlsx'>clicking here</a>";
	}

	if($_POST["delete-id"]){
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
		$is_del = true;
		for( $row = 1; $row <= (count($_KARTINA_TV)-1); $row++ ){
			if($row == $_delete_id) {
				$row = $row + 1;
				$is_del = false;
			}
			if($is_del){
				$_row = $row + 1;
			} else {
				$_row = $row;
			}
			$objPHPExcel_2->getActiveSheet()->SetCellValue("A$_row", $_KARTINA_TV[$row][0]);
			$objPHPExcel_2->getActiveSheet()->SetCellValue("B$_row", $_KARTINA_TV[$row][1]);
			$objPHPExcel_2->getActiveSheet()->SetCellValue("C$_row", $_KARTINA_TV[$row][2]);
			$objPHPExcel_2->getActiveSheet()->SetCellValue("D$_row", $_KARTINA_TV[$row][3]);
			$objPHPExcel_2->getActiveSheet()->SetCellValue("E$_row", $_KARTINA_TV[$row][4]);
			$objPHPExcel_2->getActiveSheet()->SetCellValue("F$_row", $_KARTINA_TV[$row][5]);
			$objPHPExcel_2->getActiveSheet()->SetCellValue("G$_row", $_KARTINA_TV[$row][6]);
			$objPHPExcel_2->getActiveSheet()->SetCellValue("H$_row", $_KARTINA_TV[$row][7]);
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
		$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel_2); //$objWriter = new PHPExcel_Writer_Excel5($objPHPExcel_2);
		$objWriter->save("$_home/$_work/$_xlsx_file_name.$_input_file_type");

		// Echo done
		//echo date('H:i:s') . " Done writing file. It can be downloaded by <a href='ftp://kartina-tv.mediaplayer.com.ua/public_html/raport/NewKartinaTV.xlsx'>clicking here</a>";
	}

	if($_POST["receiver-email"]){
		$available_new_record = null;
		foreach( $_KARTINA_TV as $col=>$val ){
			if(!$val['status']){
				$available_new_record = $val;
				if( filter_var($val[0], FILTER_VALIDATE_INT) !== false ) break;
			}
		}

		if(filter_var($available_new_record[0], FILTER_VALIDATE_INT) !== false){
			send_mail_client($_receiver_email,$available_new_record[1],$available_new_record[2],$available_new_record[3]);
		//} else {
		//	fail_mail_client($_receiver_email);
		}
	}

	if($_POST["edit-email-text"]){
			$fs   = fopen("$_home/$_work/text_email_client.txt","w");
			$text = fputs($fs,$_edit_email_text);
			fclose($fs);
	}

?>