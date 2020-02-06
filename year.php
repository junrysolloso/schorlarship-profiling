<option>Select Year</option>
<?php
$TodayYear = date('m:d:y');
$Year = date('Y',strtotime($TodayYear));
$YearAgo = 2005;
$YearDiff = $Year - $YearAgo;
for($i=0;$i<=$YearDiff;$i++){?>
    <option value="<?php echo ($YearAgo + $i) .'-'. ($YearAgo + $i +1)?>"><?php echo ($YearAgo + $i) .'-'. ($YearAgo + $i +1)?></option>
<?php } ?>