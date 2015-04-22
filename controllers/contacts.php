<?php

Flight::route('GET /contact', function (){
    $errors = array();
    $contact = array('contact_name'=>"", 'contact_email'=>"", 'contact_comment'=>"");
    render_page('contact', "Contact", "CONTACT", array('contact'=>$contact, 'errors'=>$errors));
});

Flight::route('POST /contact', function (){
    global $da;
    $errors = array();
    $contact = array('contact_name'=>"", 'contact_email'=>"", 'contact_comment'=>"");
    $valid = true;
    
    if (isset($_POST['contact_name'])) {
        $contact['contact_name'] = $_POST['contact_name'];
    }
    
    if (isset($_POST['contact_email'])) {
        $contact['contact_email'] = $_POST['contact_email'];
    }
    
    if (isset($_POST['contact_comment'])) {
        $contact['contact_comment'] = $_POST['contact_comment'];
    }
    
    $valid = validateNotEmptyAndMaxLength($valid, $contact, 'contact_name', $errors, 'Name', 50);
    $valid = validateNotEmptyAndMaxLength($valid, $contact, 'contact_email', $errors, 'Email', 255);
    $valid = validateNotEmpty($valid, $contact, 'contact_comment', $errors, 'Comment');
    
    if ($valid && !filter_var($contact['contact_email'], FILTER_VALIDATE_EMAIL)) {
        $valid = false;
        $errors['contact_email'] = "Please enter a valid email address.";
    }
    
    if ($valid) {
        # Send the commenter a message thanking them for their submission
        try {
            sendMessage($contact['contact_email'], "Thank you for your comment!", "{$contact['contact_name']},\nThank you for your comment, it was very much appreciated.\n\nBryan Stockus");
        } catch (Exception $e) {
            #Do Nothing for now, would probably want to log this error, but should not let it prevent the page from loading
            #as this is not a fatal error.
        }
        
        $comment_id = $da->create_contact($contact);
        
        try {
            $safe_comment = htmlspecialchars($contact['contact_comment']);
            sendMessage($da->get_notification_email_address(), "Comment Was Submitted!", "Name: {$contact['contact_name']}\nEmail: {$contact['contact_email']}\nComment: {$safe_comment}");
        } catch (Exception $e) {
            #Do Nothing for now, would probably want to log this error, but should not let it prevent the page from loading
            #as this is not a fatal error.
        }
        
        render_page('contact_submitted', "Contact Submitted", "CONTACT", array());
    } else {
        render_page('contact', "Contact", "CONTACT", array('contact'=>$contact, 'errors'=>$errors));
    }
    
});

Flight::route('GET /admin/contacts', function (){
    global $da;
    $contacts = $da->get_contacts();
    render_list_page('admin/contacts', 'index', 'Admin - Contacts', 'CONTACTS', array('contacts' => $contacts), 'control-panel');
});