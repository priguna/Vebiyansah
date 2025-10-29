<!-- <option value="" selected hidden disabled>pilih</option> -->
<option value="-">-</option>

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if(isset($select)){ foreach ($select as $key){  ?>      
	<option value="<?php echo $key->id ?>" <?php if(isset($id_data)){ if($id_data == $key->id) echo 'selected'; } ?>><?php echo $key->value ?></option>
<?php } 
} ?>