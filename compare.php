<?php
include('dbconfig.php');

$db = $conn;
$table_name = "input_db";
$columns = ['folio_id', 'issue_date', 'expired_date', 'PJ', 'Keterangan'];
$fetchdata = fetch_data($db, $table_name, $columns);
$truncate_data = mysqli_query($db, 'TRUNCATE TABLE `excel-sql`.`input_db`');

function fetch_data($db, $table_name, $columns)
{
    if(empty($db)){
        $msg= "Database connection error";
    }
        
    elseif (empty($columns) || !is_array($columns)) {
        $msg="columns Name must be defined in an indexed array";
    }
        
    else {
        $columnName = implode(", ", $columns);
        $datacheck = "SELECT * FROM input_db WHERE EXISTS (SELECT folio_id FROM pools_db WHERE input_db.folio_id = pools_db.folio_id)";
        $result = mysqli_query($db, $datacheck);


        if($result== true){ 
            if (mysqli_num_rows($result) > 0) {
                $table_row= mysqli_fetch_all($result, MYSQLI_ASSOC);
                $msg= $table_row;
            } 

            else {
                $msg= "Belum ada yang di-Klaim"; 
            }
        }
            
        else{
            $msg= mysqli_error($db);
        }
    }
    return $msg;
}
?>