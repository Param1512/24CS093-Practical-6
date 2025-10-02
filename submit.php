<?php
// Function to sanitize input
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = sanitize_input($_POST['name']);
    $email = sanitize_input($_POST['email']);
    $phone = sanitize_input($_POST['phone']);

    // Open CSV file in append mode
    $file = fopen("registrations.csv", "a");
    if ($file) {
        fputcsv($file, [$name, $email, $phone]);
        fclose($file);
        echo "<h3 style='color:green; text-align:center;'>Registration Successful!</h3>";
        echo "<p style='text-align:center;'>Thank you, $name. Your registration has been recorded.</p>";
        echo "<p style='text-align:center;'><a href='index.html'>Go Back to Form</a></p>";
    } else {
        echo "<h3 style='color:red; text-align:center;'>Error!</h3>";
        echo "<p style='text-align:center;'>Could not save registration. Please try again.</p>";
        echo "<p style='text-align:center;'><a href='index.html'>Go Back to Form</a></p>";
    }
} else {
    echo "<h3 style='color:red; text-align:center;'>Invalid Access</h3>";
    echo "<p style='text-align:center;'><a href='index.html'>Go Back to Form</a></p>";
}
?>
