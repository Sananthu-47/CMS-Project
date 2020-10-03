<?php 
     deleteComment();
     approveComment();
     deneyComment();
?>
<table class="table table-striped table-bordered" style='border: 2px solid black;'>
    <thead>
        <tr>
            <th>ID</th>
            <th>Author</th>
            <th>Date</th>
            <th>Email</th>
            <th>Related Post</th>
            <th>Comment</th>
            <th>Status</th>
            <th>Approve</th>
            <th>Deney</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        <?php
            viewAllComments();
        ?>
    </tbody>
</table>

<script>

setTimeout(()=>{
    document.querySelector('.alert-cls').style.display="none";
}, 3000);
</script>

