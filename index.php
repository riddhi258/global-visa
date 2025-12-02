<?php

if (isset($_POST['submit'])) {

    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $location = trim($_POST['location'] ?? '');
    $mobile_local = trim($_POST['mobile'] ?? '');
    $inquiry = trim($_POST['inquiry'] ?? '');
    $source = trim($_POST['source'] ?? '');
    $message = trim($_POST['message'] ?? '');
    $consent = isset($_POST['consent']) ? 1 : 0;
    if ($name && $email && $location && $mobile_local && $inquiry && $source && $message && $consent) { 
        $name = filter_var($name, FILTER_SANITIZE_STRING);
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
        $location = filter_var($location, FILTER_SANITIZE_STRING);
        $mobile_local = filter_var($mobile, FILTER_SANITIZE_STRING);      
        $inquiry = filter_var($inquiry, FILTER_SANITIZE_STRING);
        $source = filter_var($source, FILTER_SANITIZE_STRING);  }

    if (!$consent) {
        $error = "You must agree to the Terms and Conditions.";
    }

    // PostgreSQL connection
    $conn = pg_connect("host=dpg-d4176qa4d50c73dtfcq0-a.oregon-postgres.render.com 
                    port=5432 
                    dbname=growmore_c1tn 
                    user=growmore_c1tn_user 
                    password=CjzTtIVUbsQgTVFzzlFa0vzGAOUnZggG 
                    sslmode=verify-full 
                    sslrootcert=/usr/local/share/ca-certificates/render-root.crt");

    if (!$conn) {
        die("❌ PostgreSQL Connection Failed: " . pg_last_error());
    }

    if (empty($error)) {
        $query = "INSERT INTO leads (name, email, location, mobile, inquiry, source, message) 
                  VALUES ($1, $2, $3, $4, $5, $6, $7)";
        $result = pg_query_params($conn, $query, [
            $name,
            $email,
            $location,
            $mobile_local,
            $inquiry,
            $source,
            $message
        ]);

        if ($result) {
            $success = "Form submitted successfully!";
            $_POST = [];
        } else {
            $error = "Error submitting form: " . pg_last_error($conn);
        }
    }

    pg_close($conn);
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Assessment Form</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div>
        <div>
            <img src="logo1.png" alt="logo" style="display:block; margin:0 auto 10px auto; max-width:200px;">
            <h2>Student Inquiry Form</h2>
        </div>
        <div class="card">
            <div class="feedback">
                <?php if (!empty($success))
                    echo "<div class='success'>" . htmlspecialchars($success) . "</div>"; ?>
                <?php if (!empty($error))
                    echo "<div class='error'>" . htmlspecialchars($error) . "</div>"; ?>
            </div>

            <form action="" method="post" enctype="multipart/form-data" novalidate>
                <div class="form-grid">
                    <div class="field">
                        <label for="name">Name <span class="req">*</span></label>
                        <input id="name" type="text" name="name" placeholder="Enter full name" required
                            value="<?php echo htmlspecialchars($_POST['name'] ?? ''); ?>">
                    </div>
                    <div class="field">
                        <label for="email">Email <span class="req">*</span></label>
                        <input id="email" type="email" name="email" placeholder="Enter email" required
                            value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>">
                    </div>
                    <div class="field">
                        <label for="location">Current Location <span class="req">*</span></label>
                        <select id="location" name="location" required>
                            <option value="">Select Location</option>
                            <?php
                            $posted = $_POST['location'] ?? '';
                            foreach ($country_list as $country) {
                                $country_safe = htmlspecialchars($country, ENT_QUOTES, 'UTF-8');
                                $selected = ($posted === $country) ? ' selected' : '';
                                echo "<option value=\"$country_safe\"$selected>$country_safe</option>\n";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="field">
                        <label for="mobile">Mobile Number <span class="req">*</span></label>
                        <input id="mobile" type="text" name="mobile" placeholder="+X XX XXXXXXXX" required
                            value="<?php echo htmlspecialchars($_POST['mobile'] ?? ''); ?>">
                    </div>
                </div>
                <div class="field">
                    <label for="inquiry">My Today's Inquiry about? <span class="req">*</span></label>
                    <select id="inquiry" name="inquiry" required>
                        <option value="">Select service type</option>
                        <option value="Student Visa" <?php if (($_POST['inquiry'] ?? '') === 'Student Visa')
                            echo 'selected'; ?>>Student Visa</option>
                    </select>
                </div>
                <div class="field">
                    <label for="source">Where do you find us? <span class="req">*</span></label>
                    <select id="source" name="source" required>
                        <option value="">Select source</option>
                        <option value="Website" <?php if (($_POST['source'] ?? '') === 'Website')
                            echo 'selected'; ?>>
                            Website</option>
                        <option value="Referral" <?php if (($_POST['source'] ?? '') === 'Referral')
                            echo 'selected'; ?>>
                            Referral</option>
                        <option value="Social Media" <?php if (($_POST['source'] ?? '') === 'Social Media')
                            echo 'selected'; ?>>Social Media</option>
                    </select>
                </div>
                <div class="field full">
                    <label for="message">Message</label>
                    <textarea id="message" name="message" placeholder="Enter personal message"
                        rows="4"><?php echo htmlspecialchars($_POST['message'] ?? ''); ?></textarea>
                </div>
                <div class="field checkbox-group full">
                    <label class="checkbox">
                        <input type="checkbox" name="consent" value="1" <?php if (isset($_POST['consent']))
                            echo 'checked'; ?> required>
                        <div>I agree to the Terms and Conditions and Privacy Policy. <span class="req">*</span></div>
                    </label>
                    <label class="checkbox">
                        <input type="checkbox" name="newsletter" value="1" <?php if (isset($_POST['newsletter']))
                            echo 'checked'; ?>>
                        <div>Yes, I would like to signup for Growmore immigration newsletter.</div>
                    </label>
                    <div class="note">By submitting you agree to our Terms and Privacy Policy.</div>
                    <div class="btn-row">
                        <button type="button" class="btn btn-cancel" onclick="window.history.back();">Cancel</button>
                        <button type="submit" name="submit" class="btn btn-save">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>

</html>