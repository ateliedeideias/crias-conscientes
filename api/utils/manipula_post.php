<?php
class ManipulaPost {
  public function getPost() {       
    return file_get_contents('php://input');
  }

  public function getJsonPost() {
    $val=$this->getPost();
    if (is_null($val)||empty($val)) {
        return null;
    }
    
    return json_decode($val, true);
  }
}
?>