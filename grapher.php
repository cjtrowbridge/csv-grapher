<?php

function CSV($File){	
	$rows   = array_map('str_getcsv', file($File));
    $header = array_shift($rows);
    $csv    = array();
    foreach($rows as $row) {
        $csv[] = array_combine($header, $row);
    }
	return $csv;
}

function findCSVs(){
  $Files = glob("./*.csv");
  return $Files;
}

function ArrTabler($arr, $table_class = 'table tablesorter tablesorter-ice tablesorter-bootstrap', $table_id = null,$Sort = true,$OutputCallback = false){
  $return='';
  if($table_id==null){
    $table_id=md5(uniqid(true));
  }
  if(count($arr)>0){
    $return.="\n<div class=\"table-responsive\">\n";
    $return.= "\r\n".'	<table id="'.$table_id.'" class=" table'.$table_class.'">'."\n";
    $first=true;
    foreach($arr as $row){
      if($first){
        $return.= "		<thead>\n";
        $return.= "			<tr>\n";
        foreach($row as $key => $value){
          $return.= "				<th>".ucwords($key)."</th>\n";
        }
        $return.= "			</tr>\n";
        $return.= "		</thead>\n";
        $return.= "		<tbody>\n";
      }
      $first=false;
      $return.= "			<tr>\n";
      foreach($row as $key => $value){
        if($OutputCallback == false){
          $return.="<td>".$value."</td>";  
        }else{
          //TODO i dont think this will work like this but i dont need it to work at this point
          $return.="<td>".$OutputCallback($key, $value,$row)."</td>";
        }
        
      }
      $return.= "			</tr>\n";
    }
    $return.= "		</tbody>\n";
    $return.= "	</table>\n";
    $return.= "</div>\n";
    if($Sort){
      $return.= "<script>$('#".$table_id."').tablesorter({widgets: ['zebra', 'filter']});</script>\n";
    }else{
      $return.= "<script>$('#".$table_id."').tablesorter({widgets: ['zebra']});</script>\n";
    }
  }else{
    $return.="No Results Found.";
  }
  return $return;
}


?>
<!DOCTYPE html>
<html>
<head>
  <title>CSV Grapher</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.3/css/theme.bootstrap_4.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.3/css/theme.ice.min.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
  
<div class="container">
  <div class="row">
    <div class="col-12">
<?php
//Ok Begin

$CSVs = findCSVs();
foreach($CSVs as $CSV){
  $CSV = CSV($CSV);
  echo ArrTabler($CSV);
}

?>
    </div><!--End col-12 -->
  </div><!--End row-->
</div><!--End Container-->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js" integrity="sha384-3ceskX3iaEnIogmQchP8opvBy3Mi7Ce34nWjpBIwVTHfGYWQS9jwHDVRnpKKHJg7" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.3/js/jquery.tablesorter.min.js"></script>


</body>
</html>
