<?php

class Test extends CI_Controller {

    public function index() {
        $data = date('Y-m-d');
        $time = date('H:i:s')+3;
        print_r('$data='.$data.'<br>');
        print_r('$data='.$time.'<br>');
    }

    //put your code here
}
