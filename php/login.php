
<?php
include('../connect.php');

$n1 = $_POST['n1'];
$n2 = $_POST['n2'];

$sql = "SELECT * FROM Parent WHERE (Name = '$n1' OR Email = '$n1')";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $shpassword = $row['Password'];

    if (password_verify($n2, $shpassword)) {
        session_start();
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $n1;
        header('Location: http://localhost/persnol-work/project/homePage.php?');
        exit;
    }
}

$sql = "SELECT * FROM Dietitian WHERE (Name = '$n1' OR Email = '$n1')";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $shpassword = $row['Password'];

    if (password_verify($n2, $shpassword)) {
        session_start();

        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $n1;

        
        header('Location: http://localhost/persnol-work/project/homePage.php');
        exit;
    }
}

$sql = "SELECT * FROM Admin WHERE (Name = '$n1' OR Email = '$n1')";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $shpassword = $row['Password'];

    if (password_verify($n2, $shpassword)) {
        session_start();
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $n1;
     
        header('Location: http://localhost/persnol-work/project/homePage.php');
        exit;
    }
}

echo "<p style='color: red;'>Invalid username or password</p>";
exit;
?>