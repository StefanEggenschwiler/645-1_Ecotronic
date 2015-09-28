<?php
require_once ('simple_html_dom.php');

$table = file_get_html('table.html');
$array = array();

$typeId = 13;
$imageColumn = 0;
$brandColumn = 0;
$modelColumn = 0;
$priceColumn = 0;
$energyPriceColumn = 0;
$efficiencyClassColumn = 0;
$energyConsumptionColumn = 0;
$shopLink = "'http://www.melectronics.ch/'";
$brandId; $efficiencyClassId; $image; $model; $price; $energyPrice; $energyConsumption; global $manufacturerLink;

echo "INSERT INTO `device`(`id`, `typeId`, `brandId`, `efficiencyClassId`, `image`, `model`, `price`, `energyPrice`, `energyConsumption`, `serialNumber`, `productionYear`, `manufacturerLink`, `shopLink`, `discount`, `discountStart`, `discountEnd`) VALUES ";

function generateSerialNumber() {
	$chars = array(0,1,2,3,4,5,6,7,8,9,'A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
	$length = 20; // Length of the serial number
	$serial = '';
	$max = count($chars)-1;
	for($i=0;$i<$length;$i++){
		$serial .= (!($i % 5) && $i ? '-' : '').$chars[rand(0, $max)];
	}
	return $serial;
}

function getBrandId($input)
{
	global $manufacturerLink;
	switch($input) {
		case 'Bosch':
			$manufacturerLink = "'http://www.bosch.com/'";
			return 1;
			break;
		case 'Siemens':
			$manufacturerLink = "'http://www.siemens.com/'";
			return 2;
			break;
		case 'V-ZUG':
			$manufacturerLink = "'http://www.vzug.com/'";
			return 3;
			break;
		case 'Bauknecht':
			$manufacturerLink = "'http://www.bauknecht.ch/'";
			return 4;
			break;
		case 'Miele':
			$manufacturerLink = "'http://www.miele.ch/'";
			return 5;
			break;
		case 'Fors':
			$manufacturerLink = "'http://fors.ch/'";
			return 6;
			break;
		case 'Electrolux':
			$manufacturerLink = "'http://www.electrolux.ch/'";
			return 7;
			break;
		case 'Liebherr':
			$manufacturerLink = "'http://www.liebherr.com/'";
			return 8;
			break;
		case 'Electrolux / Fust':
			$manufacturerLink = "'http://www.fust.ch/'";
			return 9;
			break;
		case 'Gaggenau':
			$manufacturerLink = "'http://www.gaggenau.com/'";
			return 10;
			break;
		case 'AEG':
			$manufacturerLink = "'http://www.aeg.com/'";
			return 11;
			break;
		case 'Novamatic':
			$manufacturerLink = "'http://www.fust.ch/'";
			return 12;
			break;
		case 'Gorenje':
			$manufacturerLink = "'http://www.gorenje.com/'";
			return 13;
			break;
		case 'Samsung ':
			$manufacturerLink = "'http://www.samsung.ch/'";
			return 14;
			break;
		case 'Samsung':
			$manufacturerLink = "'http://www.samsung.ch/'";
			return 14;
			break;
		case 'Miele / FUST':
			$manufacturerLink = "'http://www.fust.ch/'";
			return 15;
			break;
		case 'Hoover':
			$manufacturerLink = "'http://www.hoover.com/'";
			return 16;
			break;
		case 'Blomberg':
			$manufacturerLink = "'http://www.blomberginternational.com/'";
			return 17;
			break;
		case 'Schulthess':
			$manufacturerLink = "'http://www.schulthess.ch/'";
			return 18;
			break;
		case 'Haier':
			$manufacturerLink = "'http://www.haier.com/'";
			return 19;
			break;
		case 'Solis':
			$manufacturerLink = "'http://www.solis.ch/'";
			return 20;
			break;
		case 'Primotecq':
			$manufacturerLink = "'http://www.primogroup.de/'";
			return 21;
			break;
		case 'Rotel':
			$manufacturerLink = "'http://www.rotel-haushaltsgeraete.ch/'";
			return 22;
			break;
		case 'Tefal':
			$manufacturerLink = "'http://www.tefal.com/'";
			return 23;
			break;
		case 'Melitta':
			$manufacturerLink = "'http://www.melitta.ch/'";
			return 24;
			break;
		case 'Russell Hobbs':
			$manufacturerLink = "'http://www.russellhobbs.com/'";
			return 25;
			break;
		case 'WMF':
			$manufacturerLink = "'http://www.wmf.com/'";
			return 26;
			break;
		case 'Braun':
			$manufacturerLink = "'http://www.braun.com/'";
			return 27;
			break;
		case 'Philips':
			$manufacturerLink = "'http://www.philips.com/'";
			return 28;
			break;
		case 'Unold':
			$manufacturerLink = "'http://www.unold.de/'";
			return 29;
			break;
		case 'Severin':
			$manufacturerLink = "'http://www.severin.com/'";
			return 30;
			break;
		case 'WESCO':
			$manufacturerLink = "'http://www.wesco.ch/'";
			return 31;
			break;
		case 'Necono AG':
			$manufacturerLink = "'http://www.neconoag.ch/'";
			return 32;
			break;
		case 'Venta':
			$manufacturerLink = "'http://www.venta-luftwaescher.de/'";
			return 33;
			break;
		case 'Stylies':
			$manufacturerLink = "'http://www.coplax.ch/de/elektro.htm'";
			return 34;
			break;
		case 'Stadler Form':
			$manufacturerLink = "'http://www.stadlerform.com/'";
			return 35;
			break;
		case 'Turmix':
			$manufacturerLink = "'http://www.turmix.ch/'";
			return 36;
			break;
		case 'Boneco':
			$manufacturerLink = "'http://www.boneco.com/'";
			return 37;
			break;
		case 'Solis':
			$manufacturerLink = "'http://www.solis.ch/'";
			return 38;
			break;
		case 'Stöckli':
			$manufacturerLink = "'http://www.stoeckli.ch/'";
			return 39;
			break;
		case 'Dirt Devil':
			$manufacturerLink = "'http://www.dirtdevil.com/'";
			return 40;
			break;
		case 'TRISA':
			$manufacturerLink = "'http://www.trisa.ch/'";
			return 41;
			break;
		case 'Kärcher':
			$manufacturerLink = "'http://www.kaercher.ch/'";
			return 42;
			break;
		case 'Rowenta':
			$manufacturerLink = "'http://www.rowenta.com/'";
			return 43;
			break;
		case 'Dyson':
			$manufacturerLink = "'http://www.dyson.com/'";
			return 44;
			break;
		case 'Mio-Star':
			$manufacturerLink = "'http://www.melectronics.ch/s/de/brand/MIO-STAR/'";
			return 45;
			break;
		case 'KISS':
			$manufacturerLink = "'http://www.gotec.ch/'";
			return 46;
			break;
		case 'NESPRESSO / Turmix':
			$manufacturerLink = "'https://www.nespresso.com/'";
			return 47;
			break;
		case 'NESPRESSO / Koenig':
			$manufacturerLink = "'https://www.nespresso.com/'";
			return 48;
			break;
		case 'DELIZIO':
			$manufacturerLink = "'http://www.delizio.ch/'";
			return 49;
			break;
		case 'Tchibo':
			$manufacturerLink = "'http://www.tchibo.ch/'";
			return 50;
			break;
		case 'NESPRESSO / DeLonghi':
			$manufacturerLink = "'https://www.nespresso.com/'";
			return 56;
			break;
		case 'Nespresso / DeLonghi':
			$manufacturerLink = "'https://www.nespresso.com/'";
			return 56;
			break;
		case 'Krups':
			$manufacturerLink = "'http://www.krups.com/'";
			return 52;
			break;
		case 'Koenig':
			$manufacturerLink = "'http://www.koenigworld.com/'";
			return 53;
			break;
		case 'Tchibo / Saeco':
			$manufacturerLink = "'http://www.tchibo.ch/'";
			return 57;
			break;
		case 'FUST':
			$manufacturerLink = "'http://www.fust.ch/'";
			return 55;
			break;
		default:
			$manufacturerLink = "@@@";
			return $input;
	}
}

function getEfficiencyClassId($input)
{
	switch($input) {
		case 'A':
			return 1;
			break;
		case 'A+':
			return 2;
			break;
		case 'A++':
			return 3;
			break;
		case 'A+++':
			return 4;
			break;
		case 'A+++/A':
			return 5;
			break;
		case 'A+++/B':
			return 6;
			break;
		default:
			return "@@@";
			break;
	}
}

for($x = 0; $x < count($table->find('tr', 0)->find('td')); $x++) {
	$output = "<br><br>(NULL, ";
	$i = 0;
	$serialNumber = "'".generateSerialNumber()."'";
	$productionYear = rand(1970, 2015);

	foreach($table ->find('tr') as $tr){ // Foreach row in the table!
		switch($i) {
			case $imageColumn:
				$image = "'http://www.topten.ch/".$tr->find('img', $x)->src."'";
				break;
			case $brandColumn:
				$brandId = getBrandId($tr->find('td', $x)->plaintext);
				break;
			case $modelColumn:
				$model = "'".str_replace(array('\''), '',$tr->find('td', $x)->plaintext)."'";
				break;
			case $priceColumn:
				$price = str_replace(array('\''), '',$tr->find('td', $x)->plaintext);
				break;
			case $energyPriceColumn:
				$energyPrice = str_replace(array('\''), '',$tr->find('td', $x)->plaintext);
				break;
			case $efficiencyClassColumn:
				$efficiencyClassId = getEfficiencyClassId($tr->find('td', $x)->plaintext);
				break;
			case $energyConsumptionColumn:
				$energyConsumption = $tr->find('td', $x)->plaintext;
		}
		$i++;
	}
	$output .= $typeId.", ".$brandId.", ".$efficiencyClassId.", ".$image.", ".$model.", ".$price.", ".$energyPrice.", ".
		$energyConsumption.", ".$serialNumber.", ".$productionYear.", ".$manufacturerLink.", ".$shopLink.", null, null, null),";
	echo $output;
}