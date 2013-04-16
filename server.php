<?php
include ("config.php");

$shm_id = shmop_open ($shm_address, "a", 0444, $shm_agreed_size);

$shm_size = shmop_size ($shm_id);
$message = shmop_read ($shm_id, 0, $shm_size);
$old_message = "";

do {
	if ($message != $old_message) {
		echo "$message\n";
	}
	$old_message = $message;
} while ($message = shmop_read ($shm_id, 0, $shm_size));

shmop_close ($shm_id);
?>