<?php
    // Starting db connection
    require_once "db.php";

    // Fetching values from colleges
    $stmt1 = "SELECT * FROM colleges";
    $prep1 = $conn -> prepare ($stmt1);
    $prep1 -> execute();
    $result1 = $prep1 -> fetchAll(PDO::FETCH_ASSOC);

    //Auto generated ID
    class IDGenerator {
        private $counter;        
        private $conn;
    
        public function __construct($conn) {
            $this->conn = $conn;
            $this->initializeCounter();
        }
    
        private function initializeCounter() {            
            $this->counter = $this->getCurrentMaxFromDatabase() + 1;
        }
    
        private function getCurrentMaxFromDatabase() {
            $stmt = "SELECT MAX(deptid) AS max_counter FROM departments";
            $result = $this->conn->query($stmt);
    
            $row = $result->fetch(PDO::FETCH_ASSOC);
            $maxCounter = $row['max_counter'];
    
            return $maxCounter ? (int)$maxCounter : 0;
        }
    
        public function generateID() {                    
            $newID = $this->counter++; 
        
            return $newID;
        }
    }
    
    $idGenerator = new IDGenerator($conn); 
    $newID = $idGenerator->generateID();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      
        $deptid = $_POST['deptid'];
        $deptfullname = $_POST['deptfullname'];
        $deptshortname = $_POST['deptshortname'];
        $deptcollid = $_POST['deptcollid'];
    
        $stmt = $conn->prepare("INSERT INTO departments (deptid, deptfullname, deptshortname, deptcollid) VALUES (:deptid, :deptfullname, :deptshortname, :deptcollid)");
        $stmt->bindParam(':deptid', $deptid);
        $stmt->bindParam(':deptfullname', $deptfullname);
        $stmt->bindParam(':deptshortname', $deptshortname);
        $stmt->bindParam(':deptcollid', $deptcollid);
        $stmt->execute();
        header("Location: department-listing.php");
        exit();
    }
    $conn = null;
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
        
        h4 {
           margin-top: 3%;
           text-align: center;
        }

        .formdiv {
            margin-top: 3%;
            border: 1px solid black;
            width: 700px;
            padding:10px;
        }

        .entry {
            width: 550px; 
            margin-top: 3%;
            margin-left: 60px;
        }

        .formbtn1{
            width:200px;
            margin-left: 15px;
            border-color: black;
            color: black;
        }

        .formbtn1:hover{
            border-color: white;
            color: white;
        }

        .formbtn2{
            width:200px;
            margin-left: 120px;
            border-color: black;
            color: black;
        }

        .formbtn2:hover{
            border-color: white;
            color: white;
        }

        .viewdiv{
            width:480px;
            margin-top: 1%;
            margin-left: 1%;
            text-align: start;
        }

        .viewbtn{
            width: 90px;
            border-color: black;
            color: black;
        }

        .viewbtn:hover{
            border-color: white;
            color: white;
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

    <div class="container viewdiv">
        <button type="submit" class="btn btn-outline-warning viewbtn" onclick="window.location.href='department-listing.php'">Back</button>
    </div>

    <div class="container formdiv">
        <h4>Department Information Data Entry</h4>

        <form action="" method="post" class="entry">

        <div class="form-floating mb-3">
            <select name="deptcollid" id="deptcollid" class="form-control" onchange="updatePrograms()" required>
                <option value="" class="form-control">-- Select College --</option>
                <?php foreach ($result1 as $row1){ ?>
                <option value= "<?php echo $row1["collid"]?>" class="form-control">
                    <?php echo $row1["collfullname"]?>
                </option>
                <?php } ?>
            </select>
            <label for="deptcollid">Department's College</label>
        </div>

        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="deptid" name="deptid" value="<?php echo $newID?>" readonly>
            <label for="deptid">Department ID</label>
        </div>

        <div class="form-floating mb-3">
            <input type="text" class="form-control" name="deptfullname" id="deptfullname" required>
            <label for="deptfullname">Department Name</label>
        </div>

        <div class="form-floating mb-3">
            <input type="text" class="form-control" name="deptshortname" id="deptshortname">
            <label for="deptshortname">Abbreviation</label>
        </div>

        <button type="submit" id="submitButton" class="btn btn-outline-warning formbtn1">Add</button>
        <button type="button" class="btn btn-outline-warning formbtn2" onclick="clearField()">Clear</button><br><br>
         
        </form>
    </div>

    <script>
        function clearField() { 
            document.getElementById('deptid').value = '';
            document.getElementById('deptfullname').value = '';
            document.getElementById('deptshortname').value = '';
            document.getElementById('deptcollid').value = '';
        }
    </script>
</body>
</html>
