<?php 
include_once('function.php');
include_once('todo.php');
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <title>Todos</title>
  </head>
  <body>
    <div class="container">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <h2 class="text-center pt-5 pb-4">Todo List App</h2>                
                <?php                
                  if (isset($_GET['success']) && $_GET['success']!='') {
                ?>
                  <div class="alert alert-info" role="alert">
                    <?php echo $_GET['success'] ?>
                 </div>
                 <?PHP } ?>
                 <?php                
                  if (isset($_GET['error']) && $_GET['error']!='') {
                ?>
                  <div class="alert alert-danger" role="alert">
                    <?php echo $_GET['error'] ?>
                 </div>
                 <?PHP } ?>
                 
                
                <form method="POST" class="input-group pt-3 mb-3">
                    <input type="text" name="inputodo" value="<?php echo (isset($_GET['action']) && $_GET['action']=='edit' && $_GET['user_id']!='') ? $fetch_datas[0]['task'] : ''?>"class="form-control input-txt" placeholder="Input Todos" aria-label="Recipient's username" aria-describedby="basic-addon2">
                    <button type="submit" name="submit" value="add" class="input-group-text btn btn-dark" id="basic-addon2">Save</button>
                    <input type="hidden" name="action" value="<?php echo (isset($_GET['action']) && $_GET['action']=='edit') ? "edit" : "add" ?>">
                    <input type="hidden" name="user_id" value="<?php echo (isset($_GET['user_id']) && $_GET['user_id']!='') ? $_GET['user_id'] : "" ?>">
                </form>
                <?php if (isset($_GET['action']) && $_GET['action']=='edit') {
                ?>
                  <a class="btn btn-dark float-end" href="todo_app.php">Back</a>

                <?php } ?>
                
                <h3 class="mt-5 pb-2">Your Todo Lists</h3>
                <table class="table table-dark">
                  <thead>                    
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Task</th>                      
                      <th scope="col">Create Date</th>
                      <th scope="col">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    if (!empty($results)) {
                    foreach ($results as $result) {
                      
                    ?>
                    <tr>
                      <td><?php echo $result['id'] ?></td>
                      <td><?php echo $result['task'] ?></td>
                      <td><?php echo $result['created_date'] ?></td>
                      <td>
                      
                      <a href="todo_app.php?action=edit&user_id=<?php echo $result['id'] ?>"><i class="bi bi-pencil-square"></i></a>
                      <a onclick="return confirm('Are you sure you want to delete this user?');" href="todo_app.php?action=delete&user_id=<?php echo $result['id'] ?>"><i class="bi bi-x-square btn-outline-danger"></i></a>  
                      </td>                      
                    </tr>
                   <?php } } ?>
                  </tbody>
                </table>
            </div>
        </div>

    </div>
    

    

    

  </body>
</html>