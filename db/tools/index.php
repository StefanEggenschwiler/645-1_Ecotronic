<?php
require_once ('simple_html_dom.php');

$table = file_get_html('table.html');
$array = array();

echo "INSERT INTO `device`(`id`, `typeId`, `brandId`, `efficiencyClassId`, `image`, `model`, `price`, `energyPrice`, `energyConsumption`, `serialNumber`, `productionYear`, `manufacturerLink`, `shopLink`, `discount`, `discountStart`, `discountEnd`) VALUES ";
$typeId = 13;
$shopLink = "'http://www.melectronics.ch/'";
$brandId; $efficiencyClassId; $image; $model; $price; $energyPrice; $energyConsumption; global $manufacuterLink;

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
	global $manufacuterLink;
	switch($input) {
		case 'Bosch':
			$manufacuterLink = "'http://www.bosch.com/'";
			return 1;
			break;
		case 'Siemens':
			$manufacuterLink = "'http://www.siemens.com/'";
			return 2;
			break;
		case 'V-ZUG':
			$manufacuterLink = "'http://www.vzug.com/'";
			return 3;
			break;
		case 'Bauknecht':
			$manufacuterLink = "'http://www.bauknecht.ch/'";
			return 4;
			break;
		case 'Miele':
			$manufacuterLink = "'http://www.miele.ch/'";
			return 5;
			break;
		case 'Fors':
			$manufacuterLink = "'http://fors.ch/'";
			return 6;
			break;
		case 'Electrolux':
			$manufacuterLink = "'http://www.electrolux.ch/'";
			return 7;
			break;
		case 'Liebherr':
			$manufacuterLink = "'http://www.liebherr.com/'";
			return 8;
			break;
		case 'Electrolux / Fust':
			$manufacuterLink = "'http://www.fust.ch/'";
			return 9;
			break;
		case 'Gaggenau':
			$manufacuterLink = "'http://www.gaggenau.com/'";
			return 10;
			break;
		case 'AEG':
			$manufacuterLink = "'http://www.aeg.com/'";
			return 11;
			break;
		case 'Novamatic':
			$manufacuterLink = "'http://www.fust.ch/'";
			return 12;
			break;
		case 'Gorenje':
			$manufacuterLink = "'http://www.gorenje.com/'";
			return 13;
			break;
		case 'Samsung ':
			$manufacuterLink = "'http://www.samsung.ch/'";
			return 14;
			break;
		case 'Samsung':
			$manufacuterLink = "'http://www.samsung.ch/'";
			return 14;
			break;
		case 'Miele / FUST':
			$manufacuterLink = "'http://www.fust.ch/'";
			return 15;
			break;
		case 'Hoover':
			$manufacuterLink = "'http://www.hoover.com/'";
			return 16;
			break;
		case 'Blomberg':
			$manufacuterLink = "'http://www.blomberginternational.com/'";
			return 17;
			break;
		case 'Schulthess':
			$manufacuterLink = "'http://www.schulthess.ch/'";
			return 18;
			break;
		case 'Haier':
			$manufacuterLink = "'http://www.haier.com/'";
			return 19;
			break;
		case 'Solis':
			$manufacuterLink = "'http://www.solis.ch/'";
			return 20;
			break;
		case 'Primotecq':
			$manufacuterLink = "'http://www.primogroup.de/'";
			return 21;
			break;
		case 'Rotel':
			$manufacuterLink = "'http://www.rotel-haushaltsgeraete.ch/'";
			return 22;
			break;
		case 'Tefal':
			$manufacuterLink = "'http://www.tefal.com/'";
			return 23;
			break;
		case 'Melitta':
			$manufacuterLink = "'http://www.melitta.ch/'";
			return 24;
			break;
		case 'Russell Hobbs':
			$manufacuterLink = "'http://www.russellhobbs.com/'";
			return 25;
			break;
		case 'WMF':
			$manufacuterLink = "'http://www.wmf.com/'";
			return 26;
			break;
		case 'Braun':
			$manufacuterLink = "'http://www.braun.com/'";
			return 27;
			break;
		case 'Philips':
			$manufacuterLink = "'http://www.philips.com/'";
			return 28;
			break;
		case 'Unold':
			$manufacuterLink = "'http://www.unold.de/'";
			return 29;
			break;
		case 'Severin':
			$manufacuterLink = "'http://www.severin.com/'";
			return 30;
			break;
		case 'WESCO':
			$manufacuterLink = "'http://www.wesco.ch/'";
			return 31;
			break;
		case 'Necono AG':
			$manufacuterLink = "'http://www.neconoag.ch/'";
			return 32;
			break;
		case 'Venta':
			$manufacuterLink = "'http://www.venta-luftwaescher.de/'";
			return 33;
			break;
		case 'Stylies':
			$manufacuterLink = "'http://www.coplax.ch/de/elektro.htm'";
			return 34;
			break;
		case 'Stadler Form':
			$manufacuterLink = "'http://www.stadlerform.com/'";
			return 35;
			break;
		case 'Turmix':
			$manufacuterLink = "'http://www.turmix.ch/'";
			return 36;
			break;
		case 'Boneco':
			$manufacuterLink = "'http://www.boneco.com/'";
			return 37;
			break;
		case 'Solis':
			$manufacuterLink = "'http://www.solis.ch/'";
			return 38;
			break;
		case 'Stöckli':
			$manufacuterLink = "'http://www.stoeckli.ch/'";
			return 39;
			break;
		case 'Dirt Devil':
			$manufacuterLink = "'http://www.dirtdevil.com/'";
			return 40;
			break;
		case 'TRISA':
			$manufacuterLink = "'http://www.trisa.ch/'";
			return 41;
			break;
		case 'Kärcher':
			$manufacuterLink = "'http://www.kaercher.ch/'";
			return 42;
			break;
		case 'Rowenta':
			$manufacuterLink = "'http://www.rowenta.com/'";
			return 43;
			break;
		case 'Dyson':
			$manufacuterLink = "'http://www.dyson.com/'";
			return 44;
			break;
		case 'Mio-Star':
			$manufacuterLink = "'http://www.melectronics.ch/s/de/brand/MIO-STAR/'";
			return 45;
			break;
		case 'KISS':
			$manufacuterLink = "'http://www.gotec.ch/'";
			return 46;
			break;
		case 'NESPRESSO / Turmix':
			$manufacuterLink = "'https://www.nespresso.com/'";
			return 47;
			break;
		case 'NESPRESSO / Koenig':
			$manufacuterLink = "'https://www.nespresso.com/'";
			return 48;
			break;
		case 'DELIZIO':
			$manufacuterLink = "'http://www.delizio.ch/'";
			return 49;
			break;
		case 'Tchibo':
			$manufacuterLink = "'http://www.tchibo.ch/'";
			return 50;
			break;
		case 'NESPRESSO / DeLonghi':
			$manufacuterLink = "'https://www.nespresso.com/'";
			return 56;
			break;
		case 'Nespresso / DeLonghi':
			$manufacuterLink = "'https://www.nespresso.com/'";
			return 56;
			break;
		case 'Krups':
			$manufacuterLink = "'http://www.krups.com/'";
			return 52;
			break;
		case 'Koenig':
			$manufacuterLink = "'http://www.koenigworld.com/'";
			return 53;
			break;
		case 'Tchibo / Saeco':
			$manufacuterLink = "'http://www.tchibo.ch/'";
			return 57;
			break;
		case 'FUST':
			$manufacuterLink = "'http://www.fust.ch/'";
			return 55;
			break;
		default:
			$manufacuterLink = "@@@";
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
			case 0:
				$image = "'http://www.topten.ch/".$tr->find('img', $x)->src."'";
				break;
			case 1:
				$brandId = getBrandId($tr->find('td', $x)->plaintext);
				break;
			case 2:
				$model = "'".str_replace(array('\''), '',$tr->find('td', $x)->plaintext)."'";
				break;
			case 4:
				$price = str_replace(array('\''), '',$tr->find('td', $x)->plaintext);
				break;
			case 5:
				$energyPrice = str_replace(array('\''), '',$tr->find('td', $x)->plaintext);
				break;
			case 10:
				$efficiencyClassId = getEfficiencyClassId($tr->find('td', $x)->plaintext);
				break;
			case 9:
				$energyConsumption = $tr->find('td', $x)->plaintext;
		}
		$i++;
	}
	$output .= $typeId.", ".$brandId.", ".$efficiencyClassId.", ".$image.", ".$model.", ".$price.", ".$energyPrice.", ".
		$energyConsumption.", ".$serialNumber.", ".$productionYear.", ".$manufacuterLink.", ".$shopLink.", null, null, null),";
	echo $output;
}
echo ";";