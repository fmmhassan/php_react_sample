<?php
function response($data = [],$status = 200){
    if(is_array($data)){
        $responseData = $data;
    }
    else{
        $responseData = [$data];
    }
    http_response_code($status);
    echo json_encode($responseData);
}
?>