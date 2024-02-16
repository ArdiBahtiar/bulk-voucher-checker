<?php
include('dbconfig.php');

$db = $conn;
$table_name = "input_db";
$columns = ['folio_id', 'issue_date', 'expired_date', 'pj', 'keterangan'];
$fetchdata = fetch_data($db, $table_name, $columns);
$truncate_data = pg_query($db, 'TRUNCATE TABLE public.input_db');

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
        $datacheck = "SELECT * FROM public.input_db WHERE EXISTS (SELECT folio_id FROM public.pools_db WHERE public.input_db.folio_id = public.pools_db.folio_id)";
        $result = pg_query($db, $datacheck);


        if($result== true){ 
            if (pg_num_rows($result) > 0) {
                $table_row= pg_fetch_all($result);
                $msg= $table_row;
            } 

            else {
                $msg= "Belum ada yang di-Klaim"; 
            }
        }
            
        else{
            $msg= pg_error($db);
        }
    }
    return $msg;
}
?>