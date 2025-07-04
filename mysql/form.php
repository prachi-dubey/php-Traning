<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>User Form</title>
  <link rel="stylesheet" href="style.css"> <!-- Make sure this path is correct -->
</head>
<body>
  <div style="display: flex;">
    <div class="form-container">
      <h2>User Information Form</h2>
      <form action="form-handler.php" method="POST">
        <div class="form-field">
          <label for="name">Name:</label>
          <input type="text" name="name" id="name" required />
        </div>
        <div class="form-field">
          <label for="weight">Weight (kg):</label>
          <input type="text" name="weight" id="weight" required />
        </div>
        <div class="form-field">
          <label for="address">Address:</label>
          <input type="text" name="address" id="address" required />
        </div>
        <div class="form-field">
          <label for="phone_number">Phone Number:</label>
          <input type="text" name="phone_number" id="phone_number" required />
        </div>
        <input type="submit" value="Submit" />
      </form>
    </div>

    <!-- 🔄 Update Form -->
    <div class="form-container" style="margin-top: 40px;">
      <h2>Update User Weight</h2>
      <form action="form-handler.php" method="POST">
        <div class="form-field">
          <label for="name">User Name:</label>
          <input type="text" name="name" id="name" required />
        </div>
        <div class="form-field">
          <label for="new_weight">New Weight (kg):</label>
          <input type="text" name="new_weight" id="new_weight" required />
        </div>
        <input type="submit" name="update_user" value="Update Weight" />
      </form>
    </div>

    <!-- ❌ Delete Form -->
    <div class="form-container" style="margin-top: 40px;">
      <h2>Delete User</h2>
      <form action="form-handler.php" method="POST">
        <div class="form-field">
          <label for="delete_name">User Name:</label>
          <input type="text" name="delete_name" id="delete_name" required />
        </div>
        <input type="submit" name="delete_user" value="Delete User" />
      </form>
    </div>
  </div>
 
</body>
</html>
