<?php
/**
 *
 * @copyright 2007-2012 Xiaoqiang.
 * @author Xiaoqiang.Wu <jamblues@gmail.com>
 * @version 1.01
 */
 require_once (dirname(__FILE__)).'\echart\emysql.php';

 
error_reporting(E_ALL);
 
date_default_timezone_set('Asia/ShangHai');
 
/** PHPExcel_IOFactory */
require_once 'PHPExcel/IOFactory.php';
require_once 'PHPExcel.php'; 
 
// Check prerequisites
if (!file_exists("file.xls")) {
	exit("not found file.csv.\n");
}
if(filesize("file.xls")>100000){
    exit(" too large");
}
 
$reader = PHPExcel_IOFactory::createReader('Excel5'); //设置以Excel5格式(Excel97-2003工作簿)
$PHPExcel = $reader->load("file.xls"); // 载入excel文件
$sheet = $PHPExcel->getSheet(0); // 读取第一個工作表
$highestRow = $sheet->getHighestRow(); // 取得总行数
$highestColumm = $sheet->getHighestColumn(); // 取得总列数
// echo $highestRow;
/** 循环读取每个单元格的数据 */

 //$a=array();
 //$b=array();
 //$c=array();
 
for ($row = 2; $row <= $highestRow; $row++)
{
//行数是以第1行开始
    //for ($column = 'A'; $column <= $highestColumm; $column++)
    
    //{//列数是以A列开始
       // $dataset[] = $sheet->getCell($column.$row)->getValue();
        $a= $sheet->getCell('A'.$row)->getValue();//$column.$row.
        $b= $sheet->getCell('B'.$row)->getValue();
        $c= $sheet->getCell('C'.$row)->getValue();
        $d= $sheet->getCell('D'.$row)->getValue();
        $e= $sheet->getCell('E'.$row)->getValue();
        echo $a;
       // echo $row;
       $sql="INSERT INTO excel VALUES('$a','$b','$c','$d','$e')";
mysqli_query($db,$sql);
//    }
       // $sql="INSERT INTO excel VALUES('1','2')";
//print_r ($a);
 // $sql="INSERT INTO excel(exid)VALUES('$a[$row]')";
   // echo $value;
}


