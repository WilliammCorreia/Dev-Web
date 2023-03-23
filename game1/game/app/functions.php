<?php

    session_start();

    function dd($var) {
        echo"<pre>";
        var_dump($var);
        echo "</pre>";

        die();
    }

    function connect () {
        $link = new PDO(
            'mysql:dbname=game1;host=localhost',
            'root',
            ''
        );

        return $link;
    }   