<!-- <option value="" selected hidden disabled>pilih</option> -->

<?php
defined('BASEPATH') OR exit('No direct script access allowed'); 

if(isset($select)){ foreach ($select as $key){  ?>
	<option value="<?php echo $key->id ?>"><?php echo $key->value ?></option>
	<?php } } ?>