<?php
session_start();
include('dbconfig.php');

require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$folioQuery = "INSERT INTO input_db (folio_id,issue_date,expired_date,PJ,Keterangan) VALUES ('$folio_id','$issue_date','$expiry_date','$PJ','$Keterangan')";
// $datacheck = "SELECT * FROM input_db WHERE folio_id in (SELECT folio_id FROM input_db)";

if(isset($_POST['save_excel_data']))
{
    $fileName = $_FILES['import_file']['name'];
    $file_ext = pathinfo($fileName, PATHINFO_EXTENSION);

    $allowed_ext = ['xls','csv','xlsx'];

    if(in_array($file_ext, $allowed_ext))
    {
        $inputFileNamePath = $_FILES['import_file']['tmp_name'];
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileNamePath);
        $data = $spreadsheet->getActiveSheet()->toArray();

        $count = "0";
        foreach($data as $row)
        {
            if($count > 0)
            {
                $folio_id = $row['0'];
                $issue_date = $row['1'];
                $expiry_date = $row['2'];
                $PJ = $row['3'];
                $Keterangan = $row['4'];

                // $studentQuery = "INSERT INTO students (fullname,email,phone,course) VALUES ('$fullname','$email','$phone','$course')";
                $inputtosql = mysqli_query($conn, $folioQuery);
                // $comparetodb = mysqli_query($conn, $datacheck);
                $msg = true;
            }
            else
            {
                $count = "1";
            }
        }

        if(isset($msg))
        {
            $_SESSION['message'] = "Successfully Imported";
            header('Location: index.php');
            exit(0);
        }
        else
        {
            $_SESSION['message'] = "Not Imported";
            header('Location: index.php');
            exit(0);
        }
    }
    else
    {
        $_SESSION['message'] = "Invalid File";
        header('Location: index.php');
        exit(0);
    }
}
?>