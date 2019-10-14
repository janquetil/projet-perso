<?php

exec('python3 test.py 2>&1', $test);
foreach ($test as $value) {
  echo $value.'<br>';
}

?>
