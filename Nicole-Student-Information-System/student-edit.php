<?php
    // Starting db connection
    require_once "db.php";

    // Fetching values from colleges
    $stmt1 = "SELECT * FROM colleges";
    $prep1 = $conn -> prepare ($stmt1);
    $prep1 -> execute();
    $result1 = $prep1 -> fetchAll(PDO::FETCH_ASSOC);

    // Fetching values from programs
    $stmt2 = "SELECT * FROM programs";
    $prep2 = $conn -> prepare ($stmt2);
    $prep2 -> execute();
    $result2 = $prep2 -> fetchAll(PDO::FETCH_ASSOC);

    // Fetching values from students
    $studid = $_GET['studid'];
    $stmt = $conn->prepare("SELECT studid, studlastname, studfirstname, studmidname, collfullname, progfullname, studyear, studcollid, studprogid FROM students
    INNER JOIN colleges ON studcollid = collid
    INNER JOIN programs ON studprogid = progid
    WHERE studid = :studid");
    $stmt->bindParam(':studid', $studid, PDO::PARAM_INT);
    $stmt->execute();
    $studentData = $stmt->fetch(PDO::FETCH_ASSOC);  

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
       
        $student_ID = $_POST['studentID'];
        $first_name = $_POST['firstName'];
        $middle_name = $_POST['middleName'];
        $last_name = $_POST['lastName'];
        $college = $_POST['college'];
        $program = $_POST['program'];
        $year = $_POST['year'];
        

        $stmt = $conn->prepare("UPDATE students SET
            studfirstname = :studfirstname,
            studlastname = :studlastname,
            studmidname = :studmidname,
            studprogid = :studprogid,
            studcollid = :studcollid,
            studyear = :studyear
            WHERE studid = :studid");

        $stmt->bindParam(':studid', $student_ID);
        $stmt->bindParam(':studfirstname', $first_name);
        $stmt->bindParam(':studlastname', $last_name);
        $stmt->bindParam(':studmidname', $middle_name);
        $stmt->bindParam(':studprogid', $program);
        $stmt->bindParam(':studcollid', $college);
        $stmt->bindParam(':studyear', $year);
        $stmt->execute();
        header("Location: student-listing.php");
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

        h4 {
            text-align: center;
        }

        .formDiv {
            margin-top: 3%;
            border: 1px solid black;
            width: 700px;
            padding-bottom: 20px;
            padding-top: 20px;
        }

        .entry {
            width: 550px; 
            margin-top: 20px;
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
        <button type="submit" class="btn btn-outline-warning viewbtn" onclick="window.location.href='student-listing.php'">Back</button>
    </div>

    <div class="container formDiv">
        <h4>Student Information Data Entry</h4>
        <form action="" method="post" class="entry" onsubmit="return confirmAction()">

            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="studentID" name="studentID" value="<?php echo $studentData['studid']; ?>" readonly>
                <label for="studentID">Student ID</label>
            </div>

            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="firstName" id="firstName" value="<?php echo $studentData['studfirstname']; ?>" required>
                <label for="firstName">First Name</label>
            </div>

            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="middleName" id="middleName" value="<?php echo $studentData['studmidname']; ?>">
                <label for="middleName">Middle Name</label>
            </div>

            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="lastName" id="lastName" value="<?php echo $studentData['studlastname']; ?>" required>
                <label for="lastName">Last Name</label>
            </div>

            <div class="form-floating mb-3">
                <select name="college" id="college" class="form-control" onchange="updatePrograms()" required>
                    <?php foreach ($result1 as $row1): ?>
                        <option value="<?php echo $row1["collid"] ?>" class="form-control"  <?php echo ($row1["collid"] == $studentData['studcollid']) ? 'selected' : '' ?>  required>
                            <?php echo $row1["collfullname"] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <label for="college">College</label>
            </div>
            
            <div class="form-floating mb-3">
                <select name="program" id="program" class="form-control" required>
                    <?php foreach ($result2 as $row2): ?>
                        <option value="<?php echo $row2["progid"] ?>" class="form-control" <?php echo ($row2["progid"] == $studentData['studprogid']) ? 'selected' : '' ?>>
                            <?php echo $row2["progfullname"] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <label for="program">Program</label>
            </div>

            <div class="form-floating mb-3">
                <input type="number" class="form-control" name="year" id="year" value="<?php echo $studentData['studyear']; ?>" min="1" max="5" required>
                <label for="year">Year</label>
            </div>

            <button type="submit" class="btn btn-outline-warning formbtn1">Save changes</button>
            <button type="button" class="btn btn-outline-warning formbtn2" onclick="clearField()">Clear</button>

        </form>
    </div>
    
    <script>
        var allColleges = <?php echo json_encode($result1); ?>;
        var allPrograms = <?php echo json_encode($result2); ?>;

        function confirmAction() {
            return confirm("Are you sure you want to save changes?");
        }

        function clearField() {
            document.getElementById('firstName').value = '';
            document.getElementById('middleName').value = '';
            document.getElementById('lastName').value = '';
            document.getElementById('college').value = '';
            document.getElementById('program').value = '';
            document.getElementById('year').value = '';
        }

        function updatePrograms() {
            var collegeId = document.getElementById('college').value;
            var programDropdown = document.getElementById('program');
        
            programDropdown.innerHTML = '';

            var filteredPrograms = allPrograms.filter(function(program) {
                return program.progcollid == collegeId;
            });

            filteredPrograms.forEach(function(program) {
                var option = document.createElement('option');
                option.value = program.progid;
                option.text = program.progfullname;
                programDropdown.add(option);
            });
        }
    </script>
</body>
</html>

