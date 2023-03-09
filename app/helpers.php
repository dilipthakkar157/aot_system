<?php 

function generateToken($characters, $length){
    $charactersLength = strlen($characters);
    $token = '';
    for ($i = 0; $i < $length; $i++) {
        $token .= $characters[random_int(0, $charactersLength - 1)];
    }
    return $token;
}

function sendRegistrationMail($email_data,$template,$subject){
    \Mail::send($template, $email_data, function($message) use ($email_data,$subject) {
        $message->to($email_data['email'], $email_data['name'])->subject
            ($subject);
        $message->from('dilipthakkar157@gmail.com','Dilip Thakkar');
    });
}

?>