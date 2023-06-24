<?php

include "connect.php";
include "navbar.php";

$id = $_GET['id'];
$sql = "SELECT * FROM User WHERE id=$id"; 
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];
    $mobile = $_POST["mobile"];
    $gender = $_POST["gender"];
    $subject = $_POST["subject"];
    $image =  $row['image'];;

    if ($_FILES["image"]["error"] == 0) {
        $image = "uploads/" . $_FILES["image"]["name"];
        move_uploaded_file($_FILES["image"]["tmp_name"], $image);
    }


    $sql = "UPDATE User SET email='$email', password='$password', mobile='$mobile', image='$image', gender='$gender', subject='$subject' WHERE id=$id"; 

    if (mysqli_query($con, $sql)) {
        echo "<script>alert('Data updated successfully.')</script>";
    } else {
        echo "Error: " . mysqli_error($con);
    }

  
}


?>

<h2 class="text-center mt-3">Update User Data</h2>
<hr>
<div class="container">
<form method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label for="email">Email:</label>
        <input type="text" class="form-control" id="email" name="email" value="<?php echo $row['email']; ?>" required>
        <span id="emailError" class="error"></span>
    </div>

    <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" class="form-control" id="password" name="password" value="<?php echo $row['password']; ?>" required>
        <span id="passwordError" class="error"></span>
    </div>

    <div class="form-group">
        <label for="mobile">Mobile Number:</label>
        <input type="tel" class="form-control" id="mobile" name="mobile" value="<?php echo $row['mobile']; ?>" required>
        <span id="mobileError" class="error"></span>
    </div>

    <div class="form-group">
        <label for="image">Image:</label>
        <input type="file" class="form-control-file" id="image" name="image" >
        <img src="<?php echo $row['image']; ?>" width="200" height="200" alt="Current Image">
        <span id="imageError" class="error"></span>
    </div>

    <div class="form-group">
        <label for="gender">Gender:</label>
        <select class="form-control" id="gender" name="gender" required>
            <option value="">Select</option>
            <option value="male" <?php if ($row['gender'] == 'male') echo 'selected'; ?>>Male</option>
            <option value="female" <?php if ($row['gender'] == 'female') echo 'selected'; ?>>Female</option>
            <option value="other" <?php if ($row['gender'] == 'other') echo 'selected'; ?>>Other</option>
        </select>
        <span id="genderError" class="error"></span>
    </div>

    <div class="form-group">
        <label for="subject">Subject:</label>
        <textarea class="form-control" id="subject" name="subject" required><?php echo $row['subject']; ?></textarea>
        <span id="subjectError" class="error"></span>
    </div>


    <button type="submit" name="submit" class="btn btn-primary">Update</button>
</form>
</div>