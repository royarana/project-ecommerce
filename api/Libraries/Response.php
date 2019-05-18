<?php 
Class Response {

    function response($data, $message, $response = 202) {
        header('Content-Type: application/json');
        http_response_code($response);
        $response = array(
            "data" => $data,
            "message" => $message
        );
        echo json_encode($response);
        exit;
    }
}
?>