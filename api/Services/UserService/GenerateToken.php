<?php
    function GenerateToken($email) {
        $uuid = uniqid();
        return sha1("{$email}{$uuid}");
    }
?>