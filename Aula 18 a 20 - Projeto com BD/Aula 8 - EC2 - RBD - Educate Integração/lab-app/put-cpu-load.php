<?php
  # Start PHP Session to keep track of whether or not load is getting generated
  session_start();
  
  echo "<meta http-equiv=\"refresh\" content=\"5,URL=/load.php\" />";

  $idleCpu = exec('vmstat 1 2 | awk \'{ for (i=1; i<=NF; i++) if ($i=="id") { getline; getline; print $i }}\'');

  if ($idleCpu > 50) {

    echo exec('dd if=/dev/zero bs=100M count=500 | gzip | gzip -d  > /dev/null &');
    echo "Generating CPU Load! (auto refresh in 5 seconds)";
  }
  else {
    echo "Under High CPU Load! (auto refresh in 5 seconds)";
  }
?>
