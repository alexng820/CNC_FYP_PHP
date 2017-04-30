<?php
$year=$_GET['year'];
$month=$_GET['month'];
$dom = new DomDocument;
$dom->loadHtmlFile('http://www.officeholidays.com/calendars/year_planner/index.php?planner_year='.$year.'&planner_country=Hong%20Kong');

$xpath = new DomXPath($dom);

// collect header names
// $headerNames = array();
// foreach ($xpath->query('//table[@id="index:srednjiKursLista"]//th') as $node) {
    // $headerNames[] = $node->nodeValue;
// }

// collect data
$headerNames = array();
$headerNames[] = "Date";
$headerNames[] = "HolidayName";
foreach ($xpath->query('//table[@class="info-table"]/tr[@class="holiday"]') as $node) {
    $rowData = array();
    foreach ($xpath->query('td', $node) as $cell) {
        $rowData = explode(': ',$cell->nodeValue);
    }

    $data[] = array_combine($headerNames, $rowData);
}

$result=array();
$letters = array('Jan ', 'Feb ','Mar ', 'Apr ','May ', 'Jun ','Jul ', 'Aug ','Sep ', 'Oct ','Nov ', 'Dec ');

$letters2 = array('1/', '2/','3/', '4/','5/', '6/','7/', '8/','9/', '10/','11/', '12/');
$y=0;
for($i =0;$i<sizeof($data);$i++ ){
	$temp=str_replace($letters,$letters2,$data[$i]['Date']);
	$t=explode('/',$temp);
	if($month==$t[0]){
		$result[$y]['Date']=$t[1]."-".$t[0]."-".$year;	
		$result[$y]['Day']=$t[1];
		$result[$y]['Month']=$t[0];	
		$result[$y]['Year']=$year;
		$result[$y]['HolidayName']=$data[$i]['HolidayName'];
		$y++;
	}
}

echo json_encode($result);

?>