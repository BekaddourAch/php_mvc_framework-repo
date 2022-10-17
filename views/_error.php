<?php  

$this->title = 'Error';
?>
<h1> <?php  echo $exception->getCode()?> - <?php $exception->getMessage(); ?></h1>