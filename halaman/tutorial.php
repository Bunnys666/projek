
<div class="halaman">
	<h2>SLUM AREA RANKING</h2>
	<p>CSV BASED DSS SYSTEM</p>
</div>

<style>


    .btn {
  display: inline-block;
  font-weight: 400;
  color: #212529;
  text-align: center;
  vertical-align: middle;
  cursor: pointer;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
  background-color: transparent;
  border: 1px solid transparent;
  padding: 0.375rem 0.75rem;
  font-size: 1rem;
  line-height: 1.5;
  border-radius: 0.25rem;
  transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}

.btn-primary {
  color: #fff;
  background-color: #007bff;
  border-color: #007bff;
  margin-bottom: 10px;
}

</style>


<form class="form-horizontal" action="" method="post" name="uploadCSV"
    enctype="multipart/form-data">
    <div class="input-row">
        <label class="col-md-4 control-label">Choose CSV File</label> <input
            type="file" name="file" id="file" accept=".csv">
        <button type="submit" id="submit" name="import"
            class="btn btn-primary">Import</button>
        <br />

    </div>
    
</form>

<form method="post">
    <input type="submit" name="calculate" id="calculate" value="calculate" class="btn btn-primary"  /><br/>
</form>



<?php

if (isset($_POST["import"])) {
    echo "<html><body><table>\n\n";
    
    $fileName = $_FILES["file"]["tmp_name"];
    
    
    if ($_FILES["file"]["size"] > 0) {
        $row = 1;
        $file = fopen($fileName, "r");
        
        $j=0;
        $x=0;
        while (($column = fgetcsv($file, 10000, ";")) !== FALSE) {
            $i=0;
            $j=0;
                echo "<tr>";
                        foreach ($column as $cell) {
                            
                            $subKriteria[$j++][$x] = $cell;
                            $angka[$i] = (isset($angka[$i]) ? $angka[$i]+($cell*$cell) : ($cell*$cell));
                                echo "<td>" . htmlspecialchars($cell) . "</td>";
                                $i++;
                        }
                        $x++;
                        echo "</tr>\n";
                                        
                            if (! empty($result)) {
                                $type = "success";
                                $message = "CSV Data Imported into the Database";
                            } else {
                                $type = "error";
                                $message = "Problem in Importing CSV Data";
                            }
                        }
                    }
}


    echo "\n</table></body></html>";


if (isset($subKriteria)){
   for($i=0;$i<count($angka);$i++){
        $angka[$i] = sqrt($angka[$i]);
    }


    $j=0;
    $i=0;
    foreach($subKriteria as $s1){
        $x=0;
        foreach($s1 as $s2){
            $normalisasi[$j][$x++] = $s2/$angka[$i];
        }
        $j++;
        $i++;
    }
    global $normalisasi;
     print_r($normalisasi);
    echo "<br>";
    $bobot = array("1","2","2","1","1","2","2","1","1","2","2","1","1","2","2","1");
    // print_r($bobot);
    echo "<br>";
}



// print_r($normalisasi);
$j=0;
$i=0;
foreach ($normalisasi as $no1) {
    $x=0;
    foreach ($no1 as $no2) {
         $v[$j][$x++] = $no1 * $bobot[$i];         
    }
    $j++;   
    $i++;
}
print_r($v);
print_r($normalisasi);

?>






<?php        
        // if(isset($_POST["calculate"])){
        //     echo "Hello, world!";
        //     print_r($normalisasi);            
        // }
?>        