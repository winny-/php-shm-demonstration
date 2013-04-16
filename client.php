<?php
include ("config.php");

function get_line () {
	echo "MESSAGE> ";
	return trim (fgets (STDIN));
}

// shmop_delete ($shm_address);

$shm_id = shmop_open ($shm_address, "c", 0644, $shm_agreed_size);

while ($line = get_line ()) {
	$s = substr ($line, 0, $shm_agreed_size-1);

	// Replace the remaining shm message with whitespace otherwise parts of the 
	// previously written data will linger.
	for ($i = strlen ($s); $i <= $shm_agreed_size; $i++) {
		$s .= " ";
	}

	shmop_write ($shm_id, $s, 0);
}

shmop_close ($shm_id);
?>