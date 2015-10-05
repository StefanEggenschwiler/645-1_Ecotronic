<?php
include_once 'headerAdmin.inc';

$handle = fopen("translations/de.txt", "r");
$german;
$french;
if ($handle) {
    while (($line = fgets($handle)) !== false) {
        $german[] = explode('=',$line);
    }
    fclose($handle);
}

$handle = fopen("translations/fr.txt", "r");
if ($handle) {
    while (($line = fgets($handle)) !== false) {
        $french[] = explode('=',$line);
    }
    fclose($handle);
}
?>
<form method="post" action="testRedirect.php">
    <table>
        <tr>
            <th>English</th>
            <th>German</th>
            <th>French</th>
        </tr>
        <?php for($i = 0; $i < count($german); $i++) {
            echo "<tr><td><label href='#'>";
            echo $german[$i][0];
            echo "</label><input type='hidden' value='";
            echo $german[$i][0];
            echo "' name=\"cell_en_$i\"/> </td>";
            echo "<td> <input style=\"width:100%\" type=\"text\" value=\"";
            echo $german[$i][1];
            echo "\" name=\"cell_de_$i\" required></td>";
            echo "<td> <input style=\"width:100%\" type=\"text\" value=\"";
            echo $french[$i][1];
            echo "\" name=\"cell_fr_$i\" required></td>";
            echo "</tr>";
        }?>
    </table>
    <button type="submit" value="translationSubmit" name="action" >Save Changes</button>
</form>
</body>
