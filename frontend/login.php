<?php
session_start();

// Include the database connection file.
// Adjust the path as necessary depending on your project structure.
require_once '../backend/db.php';

/**
 * Function to validate user credentials.
 *
 * @param string $username The username input.
 * @param string $password The plain text password input.
 * @param PDO    $pdo      The PDO connection instance.
 *
 * @return mixed The user record (as an associative array) on success, or false if invalid.
 */
function loginUser($username, $password, $pdo) {
    $sql = "SELECT id, username, password FROM user WHERE username = :username";
    $stmt = $pdo->prepare($sql);
    // Bind the parameter securely to prevent SQL injection.
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verify the password using password_verify which works with hashed passwords.
    if ($user && password_verify($password, $user['password'])) {
        return $user;
    }
    return false;
}

// Process the form submission.
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $user = loginUser($username, $password, $pdo);

    if ($user) {
        // Successful login: store user data in session and redirect.
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        
        if($user == "adminvk"){
          header("Location: host.php"); // Redirect to a protected page.
          exit();
        }else{
          header("Location: index.php"); // Redirect to a protected page.
          exit();
        }

    } else {
        $error = "Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - PNM VK</title>
    <!-- Include Bootstrap CSS from a CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
       <div class="row justify-content-center">
         <div class="col-md-6">
           <div class="card">
             <div class="card-header text-center">
                <h3>Login</h3>
             </div>
             <div class="card-body">
                <!-- Display error message if login fails -->
                <?php if (isset($error)): ?>
                    <div class="alert alert-danger" role="alert">
                      <?php echo $error; ?>
                    </div>
                <?php endif; ?>
                <form method="POST" action="">
                   <div class="mb-3">
                      <label for="username" class="form-label">Username</label>
                      <input type="text" class="form-control" id="username" name="username" required>
                   </div>
                   <div class="mb-3">
                      <label for="password" class="form-label">Password</label>
                      <input type="password" class="form-control" id="password" name="password" required>
                   </div>
                   <button type="submit" class="btn btn-primary w-100">Login</button>
                </form>
             </div>
           </div>
         </div>
       </div>
    </div>
    <!-- Include Bootstrap JS and its dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
