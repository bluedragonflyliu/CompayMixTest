<?php 
$semaphore_id = 100;
$segment_id = 200;
$sem = sem_get($semaphone_id, 1, 0600);
sem_acquire($sem) or die ("Can't acquire semaphore");
$shm = shm_attach($segment_id, 16384, 0600);
$population = shm_get_var($shm, 'population');
$population +=($births + $immigrants - $deaths - $emigrants);
shm_put_var($shm, 'population', $population);
shm_detach($shm);
sem_release($sem);
?>