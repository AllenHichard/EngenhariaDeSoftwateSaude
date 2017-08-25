<?php
/**
 * Created by PhpStorm.
 * User: dcandrade
 * Date: 3/22/16
 * Time: 2:15 AM
 */


  function __autoload($class_name)
  {
      require_once $class_name . '.php';
  }


ini_set('display_errors', 1);

$dal = new CampanhaDAL();
$ids =  $dal->getIdsCampanhasRelacionadas(4,2);

foreach($ids as $id){
    echo $id . "_";
}
?>