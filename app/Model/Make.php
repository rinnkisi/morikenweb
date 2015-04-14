<?php
class Make extends AppModel{
    public $useTable = 'makes';
    public function kansuu(){
    $make = $this->find('all');
//        foreach($Make as $make):
//        debug($make['Make']['make']);
//        endforeach;
        return $make;
    }
}