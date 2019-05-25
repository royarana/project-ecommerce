<?php

    require_once API_SERVICE;
    require_once SITE_ROOT."/api/Libraries/phpexcel-1.8/Classes/PHPExcel.php";
    require_once SERVICE_FOLDER."UserService/CheckLogin.php";
/** Error reporting */
    error_reporting(E_ALL);
    ini_set('display_errors', TRUE);
    ini_set('display_startup_errors', TRUE);
    date_default_timezone_set('Europe/London');

	class GetItemsByTrans extends Controller {
        
		function __construct($body, $params, $get) {
            require_once MODELS."CartModel.php";
            parent::__construct($body, $params, $get, $CartModel);
        }

        function run() {
            $this->CartsModel->_orderBy = " ORDER BY carts.ID DESC";

            $this->CartsModel->join('users', 'users.id', 'carts.user_id');
            $this->CartsModel->select('carts.*, users.full_name as full_name');

            $items = $this->CartsModel->getRows();
            $objPHPExcel = new PHPExcel();
             // Add some data
            $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('A1', 'Trans #')
                        ->setCellValue('B1', 'Name')
                        ->setCellValue('C1', 'Date')
                        ->setCellValue('D1', 'Address')
                        ->setCellValue('E1', 'Total');

            $total =0;
            for($i = 0; $i < count($items); $i++) {
                $index = $i + 2;
                $row = $items[$i];
                $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue("A{$index}", $row["id"])
                        ->setCellValue("B{$index}", $row["full_name"])
                        ->setCellValue("C{$index}", $row["date_created"])
                        ->setCellValue("D{$index}",  $row["address"])
                        ->setCellValue("E{$index}", $row["total_price"]);
                $total += $row["total_price"];
            }
            // Rename =worksheet
            $lastIndex = count($items) +  5;
           
            $objPHPExcel->setActiveSheetIndex(0)
                         ->setCellValue("D{$lastIndex}",  "Total Sales: ")
                        ->setCellValue("E{$lastIndex}", $total);
                        
            $objPHPExcel->getActiveSheet()->setTitle('Sales Report');

            $BStyle = array(
              'borders' => array(
                'allborders' => array(
                  'style' => PHPExcel_Style_Border::BORDER_THIN
                )
              )
            );

            // Set active sheet index to the first sheet, so Excel opens this as the first sheet
            $objPHPExcel->setActiveSheetIndex(0);
            $objPHPExcel->getActiveSheet()->getStyle('A1:E1')->applyFromArray($BStyle);
            // Redirect output to a client’s web browsert (Excel2007)
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            $reprtName = "Reprt-".uniqid();
            header('Content-Disposition: attachment;filename="'.$reprtName.'.xlsx"');
            header('Cache-Control: max-age=0');
            // If you're serving to IE 9, then the following may be needed
            header('Cache-Control: max-age=1');
            // If you're serving to IE over SSL, then the following may be needed
            header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
            header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
            header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
            header ('Pragma: public'); // HTTP/1.0
            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
            $objWriter->save('php://output');
            exit;
        }
    }
    
    $controller = "GetItemsByTrans";
?>