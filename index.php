<?php
include "connect.php";
include "navbar.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];
    $mobile = $_POST["mobile"];
    $gender = $_POST["gender"];
    $subject = $_POST["subject"];

    $image = "";
   

    if ($_FILES["image"]["error"] == 0) {
        $image = "uploads/" . $_FILES["image"]["name"];
        move_uploaded_file($_FILES["image"]["tmp_name"], $image);
    }
    
    // Email format validation
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Invalid email format. Please enter a valid email address.');</script>";
    } else {
        $existingEmailQuery = "SELECT * FROM user WHERE email = '$email'";
        $existingEmailResult = mysqli_query($con, $existingEmailQuery);
        
        if (mysqli_num_rows($existingEmailResult) > 0) {
            echo "<script>alert('Email already exists. Please choose a different email.');</script>";
        } else {
            if (!empty($email) && !empty($password) && !empty($mobile) && !empty($gender) && !empty($subject) && !empty($image)) {
                if(strlen($password)<6){
                    echo "<script>alert('Passowrd length should be 6 ');</script>";
            
                }else{

                    $sql = "INSERT INTO user (email, password, mobile, image, gender, subject) VALUES ('$email', '$password', '$mobile', '$image', '$gender', '$subject')";
                    if (mysqli_query($con, $sql)) {
                        echo "<script>alert('Data inserted successfully.')</script>";
                    } else {
                        echo "Error: " . mysqli_error($con);
                    }
                    mysqli_close($con);
                }

             
            } else {
                echo "<script>alert('All fields are required.');</script>";
            }
        }
    }
}


?>
<h1 class="text-center mt-3">CRUD</h1>
<hr>


<div class="container">
    <h2>User Registration Form</h2>
    <form method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="text" class="form-control" id="email" name="email" required>
            <span id="emailError" class="error"></span>
        </div>

        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" id="password" name="password" required>
            <span id="passwordError" class="error"></span>
        </div>

        <div class="form-group">
            <label for="mobile">Mobile Number:</label>
            <input type="tel" class="form-control" id="mobile" name="mobile" required>
            <span id="mobileError" class="error"></span>
        </div>

        <div class="form-group">
            <label for="image">Image:</label>
            <input type="file" class="form-control-file" id="image" name="image" required>
            <span id="imageError" class="error"></span>
        </div>

        <div class="form-group">
            <label for="gender">Gender:</label>
            <select class="form-control" id="gender" name="gender" required>
                <option value="">Select</option>
                <option value="male">Male</option>
                <option value="female">Female</option>
                <option value="other">Other</option>
            </select>
            <span id="genderError" class="error"></span>
        </div>

        <div class="form-group">
            <label for="subject">Subject:</label>
            <textarea class="form-control" id="subject" name="subject" required></textarea>
            <span id="subjectError" class="error"></span>
        </div>

        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>