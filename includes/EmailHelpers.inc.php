<?php

require 'vendor/autoload.php';
use Mailgun\Mailgun;

function sendMessage($to, $subject, $text){
    # Instantiate the client.
    $mgClient = new Mailgun('key-6b55216487a2b6109acdb18a84241324');
    $domain = "mp.bryanstockus.net";
    
    # Make the call to the client.
    $result = $mgClient->sendMessage("$domain",
                      array('from'    => 'BryanStockus.Net <postmaster@mp.bryanstockus.net>',
                            'to'      => "<{$to}>",
                            'subject' => "{$subject}",
                            'text'    => "{$text}"));
}
