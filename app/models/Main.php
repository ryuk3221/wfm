<?php

namespace app\models;

use RedBeanPHP\R;


class Main extends AppModel {

  public function get_hits($lang, $limit) {
    // return R::getAll("SELECT p.* , pd.* FROM product p JOIN product_description pd on p.id = pd.product_id WHERE p.status = 1 AND p.hit = 1 AND pd.language_id = ? LIMIT $limit", [$lang]);
    return R::getAll("SELECT * FROM product JOIN product_description on product.id = product_description.product_id WHERE status = 1 AND hit = 1 AND language_id = 1  LIMIT $limit");
  }

}

?>