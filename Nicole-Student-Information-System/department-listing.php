<?php
    //Starting db connection
    require_once "db.php";

    //Pagination
    $rows_per_page = 10;
    $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
    $offset = ($current_page - 1) * $rows_per_page;

    $stmt1 = "SELECT deptid, deptfullname, deptshortname, deptcollid FROM departments LIMIT :offset, :rows_per_page";
    $prep1 = $conn -> prepare ($stmt1);
    $prep1->bindParam(':offset', $offset, PDO::PARAM_INT);
    $prep1->bindParam(':rows_per_page', $rows_per_page, PDO::PARAM_INT);
    $prep1 -> execute();
    $result1 = $prep1 -> fetchAll(PDO::FETCH_ASSOC);

    $total_rows_stmt = $conn->query("SELECT COUNT(*) as count FROM departments");
    $total_rows = $total_rows_stmt->fetchColumn();

    $total_pages = ceil($total_rows / $rows_per_page);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIS</title>
    <link rel="icon" href="../USJR/images/slsuloogo.png" type="image">
    <link rel="stylesheet" href="bootstrap.min.css">
    <script defer src="bootstrap.bundle.min.js"></script>
    <style>

        body{
            padding-bottom: 5%;
        }

        .horizontal-line1 {
            top: 0;
            left: 0;
            width: 100%;
            height: 5px; 
            background-color: blue;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2); 
        }

        .horizontal-line2 {
            margin-top: 1%;
            left: 0;
            width: 100%;
            height: 60px; 
            background-color: blue;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
            align-items: center;
            padding-top: 12px;
            padding-left: 7.5%;
        }

        .header{
            margin-top: 1%; 
        }

        .formDiv{
            margin-top: 1%;
            border:1px solid black;
            height: auto;
        }

        .addbtn{
            width: 200px;
            border-color: black;
            color: black;
        }

        .addbtn:hover{
            border-color: white;
            color: white;
        }

        .profile{
            margin-left: 54.5%;
        }

        .drop{
            margin-left: -15px;
        }

        .drop, .drop:focus, .drop:active{
            outline: none; 
            border: none;  
        }

        .link{
            text-decoration: none;
            color: white;
            font-size: 20px;
            margin-right: 2%;
        }

        .active{
            pointer-events: none;
            color: white;
            font-size: 20px;
            text-decoration: underline;
            text-decoration-thickness: 1.5px;
            text-underline-offset: 5px;
            cursor: not-allowed;
            margin-right: 2%;
        }

        .space{
            margin-right: 3%;
        }

        .space1{
            margin-right: 1%;
        }

        .page-item.active .page-link {
            background-color: #FFC436;
            color: black;
            text-decoration: underline;
            border: 1px solid black;
            outline: none;
            
        }

        .page-item:not(.active) .page-link {
            background-color: white;
            color: black;
            outline: none;
        }

        .page-link:focus,
        .page-link:active {
            outline: none;
            box-shadow: none;
        }

        .nav{
            margin-left: 6%;
            margin-top: 2%;
            text-align: end;
            padding-top: 10px;
        }

        .img{
            margin-left: 0.52%;
        }
    </style>
</head>
<body>
    <div class="horizontal-line1">

    </div>

    <div class="container header">
        <img src="images/slsuloogo.png" class="img-fluid img" alt="image">

        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-person profile  " viewBox="0 0 16 16">
            <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664z"/>
        </svg>

        <button class="btn dropdown-toggle drop" type="button" data-bs-toggle="dropdown" aria-expanded="false">                
        </button>

        <ul class="dropdown-menu">          
            <li><a class="dropdown-item" href="login.php">Logout</a></li>
        </ul>
    </div>

    <div class="horizontal-line2">
        <a class="link" href="student-listing.php">Students</a>
        <a class="link" href="college-listing.php">Colleges</a>
        <a class="active" href="department-listing.php">Departments</a>
        <a class="link" href="program-listing.php">Programs</a>
    </div>

    <div class="container nav row">

        <div class="container col-md-6">
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item <?php echo ($current_page == 1) ? 'disabled' : ''; ?>">
                        <a class="page-link" href="?page=<?php echo ($current_page - 1); ?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>

                    <?php for ($i = 1; $i <= $total_pages; $i++) : ?>
                        <li class="page-item <?php echo ($i == $current_page) ? 'active' : ''; ?>">
                            <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                        </li>
                    <?php endfor; ?>

                    <li class="page-item <?php echo ($current_page == $total_pages) ? 'disabled' : ''; ?>">
                        <a class="page-link" href="?page=<?php echo ($current_page + 1); ?>" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>

        <div class="container col-md-4">
            <button type="submit" class="btn btn-outline-warning addbtn" onclick="window.location.href='department-entry.php'">Add Department</button>
        </div>

    </div>
    
    <div class="container formDiv">
        <form action="" method="post" >
            <table class="table">

                <thead>
                    <tr>
                    <th scope="col">Department ID</th>
                    <th scope="col">Department Name</th>
                    <th scope="col">Abbreviation</th>
                    <th scope="col">Department's College ID</th>
                    <th></th>
                    <th></th>
                    
                    </tr>
                </thead>

                <tbody>
                <?php foreach ($result1 as $row): ?>
                    <tr>
                        <td><?php echo $row['deptid']; ?></td>
                        <td><?php echo $row['deptfullname']; ?></td>
                        <td><?php echo $row['deptshortname']; ?></td>
                        <td><?php echo $row['deptcollid']; ?></td>
                        <td>
                            <a href="department-edit.php?deptid=<?php echo $row['deptid']; ?>" class="btn btn-primary btn-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                                </svg>
                            </a>
                        </td>
                        <td>
                            <a href="delete.php?deptid=<?php echo $row['deptid']; ?>" class="btn btn-danger btn-sm" onclick="return confirmAction()">                        
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                    <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5"/>
                                </svg>                        
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>

            </table>
        </form>
    </div>
    
    <script>

        function confirmAction() {
        return confirm("Are you sure you want to delete the information?");
        }

    </script>
</body>
</html>