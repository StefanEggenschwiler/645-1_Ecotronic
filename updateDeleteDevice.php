<?php
include_once 'headerAdmin.inc';
require_once 'database/class.Model.php';
require_once 'dto/class.Type.php';
require_once 'dto/class.Brand.php';
require_once 'dto/class.Device.php';
require_once 'dto/class.EfficiencyClass.php';


if($_SERVER['REQUEST_METHOD'] == 'POST') {
    deleteDevice();
    updateDevice();
}


function deleteDevice() {

}

function updateDevice() {

}
?>


<div>
    <div id="container">

    </div>
</div>

</body>
