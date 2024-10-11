<div class="dropdown d-inline-block">
    <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
        <img src="<?= PATH ?>/assets/img/<?= \wfm\App::$app->getProperty('language')['code'] ?>.png" alt="">
    </a>
    <ul class="dropdown-menu" id="languages">
      
        <?php foreach ($this->languages as $k => $v): ?>
            <?php if (\wfm\App::$app->getProperty('language')['code'] !== $k):?>
              <li>
                <button class="dropdown-item" data-langcode="<?= $k ?>">
                    <img src="<?= PATH ?>/assets/img/<?= $k ?>.png" alt="">
                    <?= $v['title'] ?>
                </button>
              </li>
            <?php endif;?>
        <?php endforeach; ?>
    </ul>
</div>
