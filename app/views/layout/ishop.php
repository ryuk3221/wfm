<?php

use wfm\View;

?>
  <?php $this->getPart('parts/header');?>

  <?= debug($this->content);?>

  <?php $this->getDbLogs();?>

  <?php $this->getPart('parts/footer');?>