<?

###Von Ralls 01/09/2017 - Sorting through contents of a CSV file and decoding stuff --- I am hoping it is going to be ->be sure to drink your ovaltine<-#####
###This is pretty gnarly, but I figured that we wanted to just do it as fast as possible as if we were in some kind of customer service scenario############

$the_data = $fields = array(); $i = 0;
//open the file -read only
$our_big_file = @fopen("sample_data.csv", "r");
//if our file is there let's do someting with it.
if ($our_big_file) {
    while (($row = fgetcsv($our_big_file)) !== false) {
        if (empty($fields)) {
            $fields = $row;
            continue;
        }
        foreach ($row as $k=>$value) {
	    
            $the_data[$i][$fields[$k]] = $value;
	    
        }
        $i++;
    }
    if (!feof($our_big_file)) {
        echo "Error: unexpected fgets() fail\n";
    }
    fclose($our_big_file);
   
//see how big the array is so we can loop through it  -Von 01/09/2017
    $how_big = sizeof($the_data);
    $loop = 0;
    while ( $loop <= $how_big )
    {
        $this_date =  $the_data[$loop]["created_at"];
        $sd = 1403441999;  //This is 06/22/2014 12:59:59 I guess we could convert on the fly but I was in a hurry (customer service) so I used a converter :)  -Von  01/09/2017
       $ed = 1405987200;  //This is 07/22/2014 00:00:00
      
       if ($this_date > $sd && $this_date < $ed)
       {
            
            $the_sentence[$this_date] = $the_data[$loop]["word"];
            
       }
       
             $loop++;
        
        
    }
    //we need to sort so we can see the real sentence  -Von 01/09/2017
      ksort($the_sentence);
     
foreach ($the_sentence as $key => $val) {
    echo "$key = $val\n";
}
   

}


?>

