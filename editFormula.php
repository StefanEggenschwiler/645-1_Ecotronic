<?php
include_once 'headerAdmin.inc';

$handle = fopen("database/formula.txt", "r");
$variables;

if ($handle) {
    while (($line = fgets($handle)) !== false) {
        $variables[] = explode('=',$line);
    }
    fclose($handle);
}

?>
<form method="post" action="redirect.php">
    <?php
        echo mb_convert_encoding('&#916;', 'UTF-8', 'HTML-ENTITIES')."e * ";
        echo "<input type=\"number\" name=\"formulaConstant\" value=\"";
        echo floatval($variables[0][1]);
        echo "\" size=\"5\" min=\"0\" max=\"1\" step=\"0.01\" required>";
        echo " ".mb_convert_encoding('&#8804;', 'UTF-8', 'HTML-ENTITIES')." ";
        echo "<input type=\"number\" name=\"formulaMaxDiscount\" value=\"";
        echo floatval($variables[1][1]);
        echo "\" size=\"5\" min=\"0\" max=\"1\" step=\"0.01\" required>";
    ?>
    <button type="submit" value="formulaSubmit" name="action" >Save Changes</button>
</form>
</body>