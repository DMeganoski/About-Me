<?php
if (!defined('APPLICATION'))
    exit();

?><table id="eduinfo">
    	    <tr>
    		<td colspan="3" class="tablelabel"><h2>Education</h2></td>
    	    </tr>
    	    <tr>
    		<td colspan="3" class="bordertop"></td>
    	    </tr>
    	    <tr>
		    <?php if (!empty($this->AboutMe->HS)) { ?>
			<td class="label">High School:</td>
		    <?php } if (!empty($this->AboutMe->Col)) { ?>
			<td class="label">College:</td>
		    <?php } ?>
    	    </tr>
    	    <tr>
		    <?php if (!empty($this->AboutMe->HS)) { ?>
			<td class="info"><?php echo $this->AboutMe->HS ?></td>
		    <?php } if (!empty($this->AboutMe->Col)) { ?>
			<td class="info"><?php echo $this->AboutMe->Col ?></td>
    <?php } ?>
    	    </tr>
    	    <tr>
    		<td colspan="3" class="borderbottom"></td>
    	    </tr>
    	</table>
