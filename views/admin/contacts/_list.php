<table  class="table table-condensed">
    <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Comment</th>
    </tr>

<?php
    foreach ($contacts as $contact) {
?>
        <tr>
            <td><strong><?php echo htmlspecialchars($contact['contact_name']); ?></strong></td>
            <td><a href="mailto:<?php echo $contact['contact_email']; ?>"><?php echo $contact['contact_email']; ?></a></td>
            <td><?php echo htmlspecialchars($contact['contact_comment']); ?></td>
        </tr>
<?php
    }
?>
    
</table>