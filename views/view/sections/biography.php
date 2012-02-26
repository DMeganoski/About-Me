<?php
if (!defined('APPLICATION'))
    exit();
if (!empty($EnabledSections['Biography']['Biography']['Value'])) {
    ?><table id="bioinfo">
        <tr>
    	<td class="tablelabel"><h2>Biography</h2></td>
        </tr>
        <tr>
    	<td class="bordertop"></td>
        </tr>
        <tr>
    	<td class="info"><?php echo $EnabledSections['Biography']['Biography']['Value']; ?>
    	</td>
        </tr>
        <tr>
    	<td class="borderbottom"></td>
        </tr>
    </table><?php
}