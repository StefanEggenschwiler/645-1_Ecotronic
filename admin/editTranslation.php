<?php
include_once  $_SERVER['DOCUMENT_ROOT'].'/645-1_Ecotronic/header/headerAdmin.inc';

$handle = fopen("../translations/de.txt", "r");
if ($handle) {
    while (($line = fgets($handle)) !== false) {
        $german[] = explode('=',$line);
    }
    fclose($handle);
}

$handle = fopen("../translations/fr.txt", "r");
if ($handle) {
    while (($line = fgets($handle)) !== false) {
        $french[] = explode('=',$line);
    }
    fclose($handle);
}

$handle = fopen("../translations/it.txt", "r");
if ($handle) {
    while (($line = fgets($handle)) !== false) {
        $italian[] = explode('=',$line);
    }
    fclose($handle);
}
?>

<link rel="stylesheet" href="../css/editTranslations.css" type="text/css" media="all"/>

<div class="container">

    <form method="post" action="../redirect.php">
        <table id="editTranslationsTable">
            <tr>
                <th>English</th>
                <th>German</th>
                <th>French</th>
                <th>Italian</th>
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
                echo "<td> <input style=\"width:100%\" type=\"text\" value=\"";
                echo $italian[$i][1];
                echo "\" name=\"cell_it_$i\" required></td>";
                echo "</tr>";
            }?>
        </table>

        <span class="alignRight">
            <button type="submit" value="translationSubmit" name="action" id="saveChangesButton">Save Changes</button>
        </span>

</div>
</form>
</body>
