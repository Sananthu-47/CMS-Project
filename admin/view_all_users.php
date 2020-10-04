<?php 
    deleteUser();
?>
<table class="table table-striped table-bordered" style='border: 2px solid black;'>
    <thead>
        <tr>
            <th>Username</th>
            <th>Firstname</th>
            <th>lastname</th>
            <th>Email</th>
            <th>Image</th>
            <th>Logged in on</th>
            <th>Role</th>
            <th>Delete</th>
            <th>Edit</th>
        </tr>
    </thead>
    <tbody>
        <?php
           viewAllUser();
        ?> 
    </tbody>
</table>

<script>

</script>

