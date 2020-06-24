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


function getColor(){
  $Colors = array(
    'Black',
    'Navy',
    'DarkBlue',
    'MediumBlue',
    'Blue',
    'DarkGreen',
    'Green',
    'Teal',
    'DarkCyan',
    'DeepSkyBlue',
    'DarkTurquoise',
    'MediumSpringGreen',
    'Lime',
    'SpringGreen',
    'Aqua',
    'Cyan',
    'MidnightBlue',
    'DodgerBlue',
    'LightSeaGreen',
    'ForestGreen',
    'SeaGreen',
    'DarkSlateGray',
    'DarkSlateGrey',
    'LimeGreen',
    'MediumSeaGreen',
    'Turquoise',
    'RoyalBlue',
    'SteelBlue',
    'DarkSlateBlue',
    'MediumTurquoise',
    'Indigo',
    'DarkOliveGreen',
    'CadetBlue',
    'CornflowerBlue',
    'RebeccaPurple',
    'MediumAquaMarine',
    'DimGray',
    'DimGrey',
    'SlateBlue',
    'OliveDrab',
    'SlateGray',
    'SlateGrey',
    'LightSlateGray',
    'LightSlateGrey',
    'MediumSlateBlue',
    'LawnGreen',
    'Chartreuse',
    'Aquamarine',
    'Maroon',
    'Purple',
    'Olive',
    'Gray',
    'Grey',
    'SkyBlue',
    'LightSkyBlue',
    'BlueViolet',
    'DarkRed',
    'DarkMagenta',
    'SaddleBrown',
    'DarkSeaGreen',
    'LightGreen',
    'MediumPurple',
    'DarkViolet',
    'PaleGreen',
    'DarkOrchid',
    'YellowGreen',
    'Sienna',
    'Brown',
    'DarkGray',
    'DarkGrey',
    'LightBlue',
    'GreenYellow',
    'PaleTurquoise',
    'LightSteelBlue',
    'PowderBlue',
    'FireBrick',
    'DarkGoldenRod',
    'MediumOrchid',
    'RosyBrown',
    'DarkKhaki',
    'Silver',
    'MediumVioletRed',
    'IndianRed',
    'Peru',
    'Chocolate',
    'Tan',
    'LightGray',
    'LightGrey',
    'Thistle',
    'Orchid',
    'GoldenRod',
    'PaleVioletRed',
    'Crimson',
    'Gainsboro',
    'Plum',
    'BurlyWood',
    'LightCyan',
    'Lavender',
    'DarkSalmon',
    'Violet',
    'PaleGoldenRod',
    'LightCoral',
    'Khaki',
    'AliceBlue',
    'HoneyDew',
    'Azure',
    'SandyBrown',
    'Wheat',
    'Beige',
    'WhiteSmoke',
    'MintCream',
    'GhostWhite',
    'Salmon',
    'AntiqueWhite',
    'Linen',
    'LightGoldenRodYellow',
    'OldLace',
    'Red',
    'Fuchsia',
    'Magenta',
    'DeepPink',
    'OrangeRed',
    'Tomato',
    'HotPink',
    'Coral',
    'DarkOrange',
    'LightSalmon',
    'Orange',
    'LightPink',
    'Pink',
    'Gold',
    'PeachPuff',
    'NavajoWhite',
    'Moccasin',
    'Bisque',
    'MistyRose',
    'BlanchedAlmond',
    'PapayaWhip',
    'LavenderBlush',
    'SeaShell',
    'Cornsilk',
    'LemonChiffon',
    'FloralWhite',
    'Snow',
    'Yellow',
    'LightYellow',
    'Ivory'
  );
  $Range = count($Colors) - 1;
  $Pick = rand(0, $Range);
  return $Colors[$Pick];
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

function getColumn($CSV, $Index){
  $Output = array();
  foreach($CSV as $Row){
    $i = 0;
    foreach($Row as $Key => $Value){
      if($i == $Index){
        $Output[] = $Value;
        break;
      }
      $i++;
    }
  }
  return $Output;
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
	
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js" integrity="sha384-3ceskX3iaEnIogmQchP8opvBy3Mi7Ce34nWjpBIwVTHfGYWQS9jwHDVRnpKKHJg7" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.3/js/jquery.tablesorter.min.js"></script>

</head>
<body>
  
<div class="container">
  <div class="row">
    <div class="col-12">
      <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" id="linear-tab" data-toggle="pill" href="#linear" role="tab" aria-controls="linear" aria-selected="true">Linear Scale</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="logarithmic-tab" data-toggle="pill" href="#logarithmic" role="tab" aria-controls="logarithmic" aria-selected="false">Logarithmic Scale</a>
        </li>
      </ul>
      <div class="tab-content" id="tabContent">
        <div class="tab-pane fade show active" id="linear" role="tabpanel" aria-labelledby="linear-tab">
          <canvas id="linearGraph" class="mb-2"></canvas>
        </div>
        <div class="tab-pane fade" id="logarithmic" role="tabpanel" aria-labelledby="logarithmic-tab">
          <canvas id="logarithmicGraph" class="mb-2"></canvas>
        </div>
      </div>
		</div>
		<div class="col-12">
<?php
//Ok Begin

$CSVs = findCSVs();

foreach($CSVs as $CSV){
  $CSV = CSV($CSV);
  echo ArrTabler($CSV);
  
  $Data = array(
    'dates'   => array(),
    'dataset' => array()
  );
  
  
  var_dump($CSV);
	
  $Index = 0;
  $Headers = array();
  foreach($CSV as $Row){
    if($Index==0){
      foreach($Row as $Key => $Value){
        $Headers[]=$Key;
	$Data['dates'] = getColumn($CSV,0);
        $Data['dataset'][] = array(
          'label'       => $Key,
          'fill'        => 'false',
          'borderColor' => getColor(),
          'data'        => getColumn($CSV,(count($Headers)-1))
        );
      }
    }
    
    $Index++;
  }
  
  $JSON = json_encode($Data);
  
  ?>
    <script>
      window.data = '<?php echo $JSON; ?>';
    </script>
  <?php
  //Later it will make tabs for more files
  break;
}

?>
    </div><!--End col-12 -->
  </div><!--End row-->
</div><!--End Container-->

<script>
    var linearGraph = new Chart(document.getElementById("linearGraph").getContext("2d"), {
    type: "line",
    data: {
      labels: window.data.dates,
      datasets: window.data.dataset
    },
    options: {
      animation: {
        duration: 0 // general animation time
      },
      hover: {
          animationDuration: 0 // duration of animations when hovering an item
      },
      responsiveAnimationDuration: 0, // animation duration after a resize
      responsive: true,
      scales: {
        yAxes: [{
          type: "linear",
          display: true
        }]
      },
      legend: {
          display: false
      }
    }
  });
  var logarithmicGraph = new Chart(document.getElementById("logarithmicGraph").getContext("2d"), {
    type: "line",
    data: {
      labels: window.data.dates,
      datasets: window.data.dataset
    },
    options: {
      animation: {
        duration: 0 // general animation time
      },
      hover: {
          animationDuration: 0 // duration of animations when hovering an item
      },
      responsiveAnimationDuration: 0, // animation duration after a resize
      responsive: true,
      scales: {
        yAxes: [{
          type: "logarithmic",
          display: true
        }]
      },
      legend: {
          display: false
      }
    }
  });
</script>

</body>
</html>
