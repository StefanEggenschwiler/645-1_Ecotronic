<?php
include_once  $_SERVER['DOCUMENT_ROOT'].'/645-1_Ecotronic/header/headerAdmin.inc';

$handle = fopen("../database/formula.txt", "r");

if ($handle) {
    while (($line = fgets($handle)) !== false) {
        $variables[] = explode('=',$line);
    }
    fclose($handle);
}

?>

<link rel="stylesheet" href="../css/editTranslations.css" type="text/css" media="all" xmlns="http://www.w3.org/1999/html"/>

<div class="container">

    <h1>Some information about the formula </h1></br>

    <p>

        <cite>Legend</cite> </br></br>
        a = Old Device </br>
        b = New Device </br>
        KWh = Consumption </br>
        T = Life Span </br>
        i = Indice </br> </br>
        x = Maximum discount defined by the administrator </br>
        &#916;e = (KWha - KWhb) * (Tb - Ta) </br></br></br></br></br></br>


        <cite>Formula & Condition</cite> </br></br>

        Formula :<b> &#916;e * i &#8804; x </br></b>
        Discount Condition : <b> 0 &#8804; x &#8804; 0.4 (maximum 40%)</b></br></br></br></br>
    </p>

    <p>
        <cite>Example</cite> </br></br>

        Device A = 10KWh, 2 years (old device)</br>
        Device B = 7KWh, 10 years, Price 5000.-, x=0.4 </br></br>
        Calculation = (10-7) * (10-2) * 0.05  &#8804; 0.4  </br>
        <b>Result </b> = <b>1.2</b> &#8804; 0.4 </br></br></br>

        Once you've the result of the formula :</br></br>
        <b>If  &#916;e is lower than x </b> -> Take  &#916;e  and calculate the final discount price</br>
        <b>Else </b> -> Take x (0.4) as the value to calculate the final discount price </br></br>

        Final Discounted price = Market Price B * (1-y) = 5000 * (1-0.4) =  <b>3000.- instead of 5000.-</b></br></br></br></br>

    </p>


    <form method="post" action="../redirect.php">
        <table id="editFormulaTable" border="3" >
            <tr><th>Formula =</th><th>&#916;e</th><th>*</th><th>Indice (i)</th><th>&#8804;</th><th>Max discount (x)</th></tr> <!--Headers, column names-->

            <tr><td></td><td>&#916;e</td><td>*</td><td><?php echo "<input style=\"text-align:center\" type=\"number\" name=\"formulaConstant\" value=\"";
                    echo floatval($variables[0][1]);
                    echo "\" size=\"5\" min=\"0\" max=\"1\" step=\"0.01\" required>"; ?></td><td>&#8804;</td><td><?php echo "<input style=\"text-align:center\" type=\"number\" name=\"formulaMaxDiscount\" value=\"";
                    echo floatval($variables[1][1]);
                    echo "\" size=\"5\" min=\"0\" max=\"1\" step=\"0.01\" required>"; ?></td></tr>

        </table>

    <span class="alignRight">
        <button type="submit" value="formulaSubmit" name="action" id="saveChangesButton">Save Changes</button>
    </span>

    </form>

</div>

</body>

<?php

if (isset ( $_SESSION ['message'] )) {
    $message = $_SESSION['message'];
    unset($_SESSION['message']);
    echo '<script type="text/javascript">alert("'.$message.'");</script>';

}

?>