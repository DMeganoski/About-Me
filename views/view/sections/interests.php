<?php
if (!defined('APPLICATION'))
    exit();
$Interests = $EnabledSections['Interests'];
?><table id="interinfo">
    	    <tr>
    		<td colspan="3" class=tablelabel><h2>Interests</h2></td>
    	    </tr>
    	    <tr>
    		<td colspan="3" class="bordertop"></td>
    	    </tr>
    <?php if (!empty($Interests['OtherInterests']['Value'])) { ?>
		    <tr>
			<td class="label"><? echo $Interests['OtherInterests']['Label']; ?>:</td>
		    </tr>
		    <tr>
			<td class="info"><?php echo $Interests['OtherInterests']['Value'] ?></td>
		    </tr>
    <?php } if (!empty($Interests['Music']['Value'])) { ?>
		    <tr>
			<td class="label"><? echo $Interests['Music']['Label']; ?>:</td>
		    </tr>
		    <tr>
			<td class="info"><?php echo $Interests['Music']['Value'] ?></td>
		    </tr>
    <?php } if (!empty($Interests['Games']['Value'])) { ?>
		    <tr>
			<td class="label"><? echo $Interests['Games']['Label']; ?>:</td>
		    </tr>
		    <tr>
			<td class="info"><?php echo $Interests['Games']['Value'] ?></td>
		    </tr>
    <?php } if (!empty($Interests['Movies']['Value'])) { ?>
		    <tr>
			<td class="label"><? echo $Interests['Movies']['Label']; ?>:</td>
		    </tr>
		    <tr>
			<td class="info"><?php echo $Interests['Movies']['Value'] ?></td>
		    </tr>
    <?php } if (!empty($Interests['Television']['Value'])) { ?>
		    <tr>
			<td class="label"><? echo $Interests['Television']['Label']; ?>:</td>
		    </tr>
		    <tr>
			<td class="info"><?php echo $Interests['Television']['Value'] ?></td>
		    </tr>
    <?php } if (!empty($Interests['Books']['Value'])) { ?>
		    <tr>
			<td class="label"><? echo $Interests['Books']['Label']; ?>:</td>
		    </tr>
		    <tr>
			<td class="info"><?php echo $Interests['Books']['Value'] ?></td>
		    </tr>
    <?php } ?>
    	    <tr>
    		<td class="borderbottom"></td>
    	    </tr>
    	</table>