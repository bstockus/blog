<h2>
    Contact
</h2>

<form class="form-horizontal" method="POST">
  <?php echo textInputFormControl('contact_name', "Name", "Your Name", $contact['contact_name'], $errors); ?>
  <?php echo textInputFormControl('contact_email', "Email", "Your Email Address", $contact['contact_email'], $errors); ?>
  <?php echo textareaFormControl('contact_comment', "Comment", "Your Comment", 10, $contact['contact_comment'], $errors); ?>
  <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
</form>