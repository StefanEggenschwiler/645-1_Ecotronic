<?php
include_once  $_SERVER['DOCUMENT_ROOT'].'/645-1_Ecotronic/header/headerAdmin.inc';
include $_SERVER['DOCUMENT_ROOT'].'/645-1_Ecotronic/functions/cryption.php';
require_once  $_SERVER['DOCUMENT_ROOT'].'/645-1_Ecotronic/database/class.Model.php';
require_once  $_SERVER['DOCUMENT_ROOT'].'/645-1_Ecotronic/dto/class.Type.php';

$model = new Model();
$types = $model->getAllTypes();
?>
<script type="text/javascript">
    $(function(){
        // Show the text box on click
        $('body').delegate('.editable', 'click', function(){
            var ThisElement = $(this);
            ThisElement.find('span').hide();
            ThisElement.find('.gridder_input').show().focus();
        });

        // Pass and save the textbox values on blur function
        $('body').delegate('.gridder_input', 'blur', function(){
            var ThisElement = $(this);
            ThisElement.hide();
            ThisElement.prev('span').show().html($(this).val()).prop('title', $(this).val());
            var UrlToPass = 'action=updateType&value='+ThisElement.val()+'&crypto='+ThisElement.prop('name');
            $.ajax({
                url : './database/ajax.php',
                type : 'POST',
                data : UrlToPass
            });
            return false;
        });

        // Same as the above blur() when user hits the 'Enter' key
        $('body').delegate('.gridder_input', 'keypress', function(e){
            if(e.keyCode == '13') {
                var ThisElement = $(this);
                ThisElement.hide();
                ThisElement.prev('span').show().html($(this).val()).prop('title', $(this).val());
            }
        });

        // Function for delete the record
        $('body').delegate('.gridder_delete', 'click', function(){
            var conf = confirm('Are you sure want to delete this type? Every devices with this type will be deleted too!');
            if(!conf) {
                return false;
            }
            var ThisElement = $(this);
            var UrlToPass = 'action=deleteType&value='+ThisElement.attr('href');
            $.ajax({
                url : './database/ajax.php',
                type : 'POST',
                data : UrlToPass,
                success: function() {
                    location.reload();
                }
            });
            return false;
        });

        // Add new record when the table is empty
        $('body').delegate('.gridder_insert', 'click', function(){
            $('#norecords').hide();
            $('#addnew').slideDown();
            return false;
        });

        // Add new record when the table in non-empty
        $('body').delegate('.gridder_addnew', 'click', function(){
            $('html, body').animate({ scrollTop: $('.box').offset().top}, 250); // Scroll to top gridder table
            $('#addnew').slideDown();
            return false;
        });

        // Cancel the insertion
        $('body').delegate('.gridder_cancel', 'click', function(){
            $('#addnew').slideUp();
            return false;
        });

        // Pass the values to ajax page to add the values
        $('body').delegate('#gridder_addrecord', 'click', function(){

            // Do insert vaidation here
            if($('#typeName').val() == '') {
                $('#typeName').focus();
                alert('Enter Type Name');
                return false;
            }

            // Pass the form data to the ajax page
            var data = $('#gridder_addform').serialize();
            $.ajax({
                url : './database/ajax.php',
                type : 'POST',
                data : data,
                success: function() {
                    location.reload();
                }
            });
            return false;
        });
    });
</script>

<div class="">
    <br />
    <div class="box">
        <div class="box-head">
            <h2 class="left">Types</h2>
        </div>
        <table class="as_gridder_table" width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr class="grid_header">
                <th style="width: 20px"></th>
                <th style="width: 20px"></th>
                <th>Type Name</th>
            </tr>

            <tr id="addnew">
                <td></td>
                <td></td>
                <td>
                    <form id="gridder_addform" method="post">
                        <input type="hidden" name="action" value="addType" />
                        <table width="25%">
                            <tr>
                                <td><input required type="text" name="typeName" id="typeName" class="gridder_add" /></td>
                                <td>&nbsp;
                                    <input type="submit" id="gridder_addrecord" value="" class="gridder_addrecord_button" title="Add" />
                                    <a href="cancel" id="gridder_cancel" class="gridder_cancel"><img src="../images/icons/delete.png" alt="Cancel" title="Cancel" /></a></td>
                            </tr>
                        </table>
                    </form>
                </td>
            </tr>
            <?php
            $i = 0;
            foreach ($types as $type) {
                $i = $i + 1;
                if($i % 2 == 0) {
                    echo '<tr class="even">';
                } else {
                    echo '<tr class="odd">';
                }
                echo '<td><a href="'.encrypt($type->getId()). '" class="gridder_delete"><img src="../images/icons/delete.png" alt="Delete" title="Delete" /></a></td>';
                echo '<td><a href="gridder_addnew" id="gridder_addnew" class="gridder_addnew"><img src="../images/icons/insert.png" alt="Add New" title="Add New" /></a></td>';
                echo '<td><div class="grid_content editable"><span style="width: 190px">'.$type->getTypeName().'</span>
                            <input type="text" class="gridder_input" style="width: 190px" name="'.encrypt("typeName|".$type->getId()).'" value="'.$type->getTypeName().'"></div></td>';
                echo '</tr>';
            }
            ?>
        </table>
    </div>
</div>