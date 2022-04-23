<?php 
   $row  = $_POST['row'];
   $col = $_POST['col'];
   $grid = array();
   if ($row*$col < 5){
        for ($i=1;$i<$row*$col+1;$i++){
            $grid[$i]=true;
        }
   }else{
    for ($i=1;$i<$row*$col+1;$i++){
        $grid[$i]=false;
    }
       $count = 5;
       while($count != 0) {
           $num = rand(1, $row*$col+1);
           if($grid[$num] == false) {
               $grid[$num] = true;
               $count--;
           }
       }
   }
   header('Content-Type: application/json; charset=utf-8');
   echo json_encode($grid); 
?>