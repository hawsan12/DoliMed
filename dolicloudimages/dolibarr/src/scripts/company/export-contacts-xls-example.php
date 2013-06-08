#!/usr/bin/php
<?php
/*
 * Copyright (C) 2004      Rodolphe Quiedeville <rodolphe@quiedeville.org>
 * Copyright (C) 2009-2011 Laurent Destailleur  <eldy@users.sourceforge.net>
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 */

/**
 *      \file       scripts/company/export-contacts-xls-example.php
 *      \ingroup    company
 *      \brief      Script file to export contacts into an Excel file
 */

$sapi_type = php_sapi_name();
$script_file = basename(__FILE__);
$path=dirname(__FILE__).'/';

// Test if batch mode
if (substr($sapi_type, 0, 3) == 'cgi') {
	echo "Error: You ar usingr PH for CGI. To execute ".$script_file." from command line, you must use PHP for CLI mode.\n";
	exit;
}

if (! isset($argv[1]) || ! $argv[1]) {
	print "Usage: $script_file now\n";
	exit;
}
$now=$argv[1];

// Recupere env dolibarr
$version='1.10';

require_once($path."../../htdocs/master.inc.php");
//require_once(PHP_WRITEEXCEL_PATH."/class.writeexcel_workbook.inc.php");
//require_once(PHP_WRITEEXCEL_PATH."/class.writeexcel_worksheet.inc.php");

require_once(PHPEXCEL_PATH."/PHPExcel.php");
//require_once(PHPEXCEL_PATH."/PHPExcel/Writer/Excel2007.php");
require_once(PHPEXCEL_PATH."/PHPExcel/Writer/Excel5.php");



$fname = DOL_DATA_ROOT.'/export-contacts.xls';

//$objPHPExcel = new writeexcel_workbook($fname);
$objPHPExcel = new PHPExcel();
$objPHPExcel->getProperties()->setCreator("Maarten Balliauw");
$objPHPExcel->getProperties()->setLastModifiedBy("Maarten Balliauw");
$objPHPExcel->getProperties()->setTitle("Test Document");
$objPHPExcel->getProperties()->setSubject("Test Document");
$objPHPExcel->getProperties()->setDescription("Test document, generated using PHP classes.");


//$page = &$objPHPExcel->addworksheet('Export Dolibarr');
$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setTitle('Contacts');

//$page->set_column(0,4,18); // A

$sql = "SELECT distinct c.name as lastname, c.firstname, c.email, s.nom as name";
$sql.= " FROM ".MAIN_DB_PREFIX."socpeople as c";
$sql.= " LEFT JOIN ".MAIN_DB_PREFIX."societe as s on s.rowid = c.fk_soc";

$resql=$db->query($sql);
if ($resql)
{
	$num = $db->num_rows($resql);

	print "Lines ".$num."\n";

	$i = 0;
	$j = 1;

	$objPHPExcel->getActiveSheet()->SetCellValue('A1', $langs->trans("Firstname"));
	$objPHPExcel->getActiveSheet()->SetCellValue('B1', $langs->trans("Lastname"));
	$objPHPExcel->getActiveSheet()->SetCellValue('C1', $langs->trans("Email"));
	$objPHPExcel->getActiveSheet()->SetCellValue('D1', $langs->trans("ThirdPart"));

	while ($i < $num)
	{
		$obj = $db->fetch_object($resql);

    	$objPHPExcel->getActiveSheet()->SetCellValue('A'.($i+2), $obj->firstname);
    	$objPHPExcel->getActiveSheet()->SetCellValue('B'.($i+2), $obj->lastname);
    	$objPHPExcel->getActiveSheet()->SetCellValue('C'.($i+2), $obj->email);
    	$objPHPExcel->getActiveSheet()->SetCellValue('D'.($i+2), $obj->name);

		$j++;
		$i++;
	}
}


//$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
$objWriter = new PHPExcel_Writer_Excel5($objPHPExcel);
$objWriter->save($fname);

//$objPHPExcel->close();

print 'File '.$fname.' was generated.'."\n";

?>