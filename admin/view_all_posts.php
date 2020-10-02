<?php 
     deletePost();
?>
<form action="" method="post">

<table class="table table-striped table-bordered" style='border: 2px solid black;'>
<div class="col-md-6 col-10 m-1">
<?php 
if(isset($_POST['selectArray']))
{
    selectBox($_POST['selectArray']);
}
?>
    <select name="bulk_options" id="" class="custom-select col-10 col-md-6">
    <option value="">---Select a task---</option>
    <option value="Draft">Draft</option>
    <option value="Publish">Publish</option>
    <option value="Delete">Delete</option>
    <option value="Clone">Clone post</option>
    </select>
    <input type="submit" name="submit"  class="btn btn-success text-white text-center conform" value="Apply">
</div>
    <thead>
        <tr>
        <th class="d-flex flex-column text-center"><label for="selectAll">Select All </label> <input  type="checkbox" name="selectAll" id="select-all"></th>
            <th>ID</th>
            <th>Author</th>
            <th>Category</th>
            <th>Title</th>
            <th>Posted at</th>
            <th>Total comment</th>
            <th>Image</th>
            <th>Tags</th>
            <th>Status</th>
            <th>Delete</th>
            <th>Edit</th>
        </tr>
    </thead>
    <tbody>
        <?php
            viewAllPost();
        ?>
    </tbody>

</table>
</form>


