<?php

class CurlModel extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function simple_get() {
        $responce = $this->curl->simple_get('https://api.skypicker.com/locations?term=PRG&locale=en-US&location_types=airport&limit=1000&active_only=true&sort=name');
        var_dump($responce);
        return $responce;
    }

    function simple_post() {
        $responce = $this->curl->simple_post('curl_test/message', array('message' => 'Sup buddy'));

        echo '<h1>Simple Post</h1>';
        echo '<p>--------------------------------------------------------------------------</p>';

        if ($responce) {

            echo $responce;


            echo '<br/><p>--------------------------------------------------------------------------</p>';
            echo '<h3>Debug</h3>';
            echo '<pre>';
            print_r($this->curl->info);
            echo '</pre>';
        } else {
            echo '<strong>cURL Error</strong>: ' . $this->curl->error_string;
        }
    }

    function message() {
        echo "<h2>Posted Message</h2>";
        echo $_POST['message'];
    }

    function get_message() {
        echo "<h2>Get got!</h2>";
    }

    function advance() {
        $this->curl->create('curl_test/cookies')
                ->set_cookies(array('message' => 'Im advanced :-p'));

        $responce = $this->curl->execute();

        echo '<h1>Advanced</h1>';
        echo '<p>--------------------------------------------------------------------------</p>';

        if ($responce) {

            echo $responce;

            echo '<br/><p>--------------------------------------------------------------------------</p>';
            echo '<h3>Debug</h3>';
            echo '<pre>';
            print_r($this->curl->info);
            echo '</pre>';
        } else {
            echo '<strong>cURL Error</strong>: ' . $this->curl->error_string;
        }
    }

    function cookies() {
        echo "<h2>Cookies</h2>";
        print_r($_COOKIE);
    }

    //put your code here
}
