<?php
    //Staring db connection
    require_once "db.php";

    // Auto generated ID
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
            $stmt = "SELECT MAX(collid) AS max_counter FROM colleges";
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
      
        $collid = $_POST['collid'];
        $collfullname = $_POST['collfullname'];
        $collshortname = $_POST['collshortname'];
    
        $stmt = $conn->prepare("INSERT INTO colleges (collid, collfullname, collshortname) VALUES (:collid, :collfullname, :collshortname)");
        $stmt->bindParam(':collid', $collid);
        $stmt->bindParam(':collfullname', $collfullname);
        $stmt->bindParam(':collshortname', $collshortname);
        $stmt->execute();

        header("Location: college-listing.php");
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
    </style>
</head>
<body>
    <div class="horizontal-line1">

    </div>

    <div class="container header">
        <img src="images/slsuloogo.png" class="img-fluid" alt="image">

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
        <a class="active" href="college-listing.php">Colleges</a>
        <a class="link" href="department-listing.php">Departments</a>
        <a class="link" href="program-listing.php">Programs</a>
    </div>

    <div class="container viewdiv">
        <button type="button" class="btn btn-outline-warning viewbtn" onclick="window.location.href='college-listing.php'">Back</button>
    </div>

    <div class="container formdiv">
        <h4>College Information Data Entry</h4>

        <form action="" method="post" class="entry">

        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="collid" name="collid" value="<?php echo $newID?>" readonly>
            <label for="collid">College ID</label>
        </div>

        <div class="form-floating mb-3">
            <input type="text" class="form-control" name="collfullname" id="collfullname" required>
            <label for="collfullname">College Name</label>
        </div>

        <div class="form-floating mb-3">
            <input type="text" class="form-control" name="collshortname" id="collshortname" required>
            <label for="collshortname">Abbreviation</label>
        </div>

        <button type="submit" id="submitButton" class="btn btn-outline-warning formbtn1">Add</button>
        <button type="button" class="btn btn-outline-warning formbtn2" onclick="clearField()">Clear</button><br><br>
         
        </form>
    </div>

    <script>
        function clearField() { 
            document.getElementById('collid').value = '';
            document.getElementById('collfullname').value = '';
            document.getElementById('collshortname').value = '';
        }
    </script>
</body>
</html>
