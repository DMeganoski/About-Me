<?php
if (!defined('APPLICATION'))
    exit();
$Data = $EnabledSections["Career"];
?><table id="carinfo">
    	    <tr>
    		<td colspan="3" class=tablelabel><h2>Career</h2></td>
    	    </tr>
    	    <tr>
    		<td colspan="3" class="bordertop"></td>
    	    </tr>
    	    <tr><?php 
		    if (!empty($Data["Company"]['Value'])) { ?>
			<td class="label"><? echo $Data['Company']['Label'] ?>:</td><?php 
		    } if (!empty($Data["Position"]['Value'])) { 
			?><td class="label"><? echo $Data['Position']['Label'] ?>:</td><?php 
		    } 
    	    ?></tr>
    	    <tr>
		    <?php if (!empty($Data["Company"]['Value'])) { ?>
			<td class="info"><?php echo $Data["Company"]['Value'] ?></td>
		    <?php } if (!empty($Data["Position"]['Value'])) { ?>
			<td class="info"><?php echo $Data["Position"]['Value'] ?></td>
    <?php } ?>
    	    </tr>
    	    <tr>
    		<td colspan="3" class="borderbottom"></td>
    	    </tr>
    	</table>