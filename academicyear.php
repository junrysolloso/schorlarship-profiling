<?php
$TodayYear = date('m:d:y');
$Year = date('Y',strtotime($TodayYear));
$AYToday = $Year .'-'. ($Year + 1);
?>
<option>Select Academic Year</option>
<option value="<?php echo $AYToday?>"><?php echo $AYToday?></option>