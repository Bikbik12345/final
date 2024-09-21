<?php
require '../connect/dbcon.php';
session_start();

// Check if the user is logged in
if (isset($_SESSION['id'])) {
    $user_id = $_SESSION['id'];

    try {
        // Fetch the user's details from the database using user_id
        $stmt = $pdoConnect->prepare("SELECT UserName, FullName, PassWord, image FROM user WHERE id = :user_id");
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            $email = $user['UserName'];
            $full_name = $user['FullName'];
            $profile_image = $user['image'];
        } else {
            // Handle the case where user details are not found
            echo "User details not found.";
            exit();
        }
    } catch (PDOException $e) {
        // Handle database connection error or query failure
        echo "Error: " . $e->getMessage();
        exit();
    }
} else {
    // Redirect to the login page if the user is not logged in
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/efa820665e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="styles/edit_profile.css">
    <title>Edit Profile</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .edit-profile-container {
            max-width: 600px;
            margin: 10px auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .edit-profile-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .edit-profile-header h2 {
            margin: 0;
            font-size: 24px;
        }

        .edit-profile-form {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .edit-profile-form label {
            font-weight: bold;
        }

        .edit-profile-form input[type="text"],
        .edit-profile-form input[type="email"],
        .edit-profile-form input[type="password"] {
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .edit-profile-form input[type="file"] {
            margin-top: 5px;
        }

        .edit-profile-form input[type="submit"],
        .edit-profile-form button {
            padding: 10px 20px;
            border: none;
            background: #0A5831;
            color: white;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        .edit-profile-form input[type="submit"]:hover,
        .edit-profile-form button:hover {
            background: #084423;
        }

        .back-button-container {
            text-align: left;
            margin-top: 20px;
        }

        .back-button-container button {
            padding: 10px 20px;
            border: none;
            background: #ddd;
            color: #333;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .back-button-container button:hover {
            background-color: #ccc;
        }
    </style>
</head>

<body>
    <div class="edit-profile-container">
        <div class="edit-profile-header">
            <h2>Edit Profile</h2>
        </div>
        <form action="update_profile.php" method="POST" enctype="multipart/form-data" class="edit-profile-form">
            <label for="full_name">Full Name:</label>
            <input type="text" id="full_name" name="full_name" value="<?php echo htmlspecialchars($full_name); ?>" required>

            <label for="email">Email:</label>
            <input style="color: gray;" type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required readonly>
          
            <label for="old_password">Old Password:</label>
            <input type="password" id="old_password" name="old_password" required>

            <label for="new_password">New Password:</label>
            <input type="password" id="new_password" name="new_password">

            <label for="profile_image">Profile Image:</label>
            <input type="file" id="profile_image" name="profile_image" accept="image/*">

            <input type="submit" value="Save Changes">
        </form>
        
        <!-- Back button -->
        <div class="back-button-container">
            <button onclick="goBack()">Back</button>
        </div>

        <script>
            function goBack() {
                window.history.back();
            }
        </script>
    </div>
</body>

</html>
