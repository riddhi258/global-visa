<?php
// Include your processing file. Make sure this file handles POST data, sets $success/$error, and defines $country_list
include 'index.php';
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Assessment Form</title>
    <!-- Google reCAPTCHA -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div>
        <div style="text-align: center; margin-bottom: 20px;">
            <img src="logo1.png" alt="logo" style="max-width:200px;">
            <h2>Student Inquiry Form</h2>
        </div>

        <div class="card">
            <!-- Feedback Messages -->
            <div class="feedback">
                <?php if (!empty($success)) echo "<div class='success'>" . htmlspecialchars($success) . "</div>"; ?>
                <?php if (!empty($error)) echo "<div class='error'>" . htmlspecialchars($error) . "</div>"; ?>
            </div>

            <!-- Form -->
            <form action="index.php" method="post" enctype="multipart/form-data" novalidate>
                <div class="form-grid">
                    <!-- Name -->
                    <div class="field">
                        <label for="name">Name <span class="req">*</span></label>
                        <input id="name" type="text" name="name" placeholder="Enter full name" required
                               value="<?php echo htmlspecialchars($_POST['name'] ?? ''); ?>">
                    </div>

                    <!-- Email -->
                    <div class="field">
                        <label for="email">Email <span class="req">*</span></label>
                        <input id="email" type="email" name="email" placeholder="Enter email" required
                               value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>">
                    </div>

                    <!-- Location -->
                    <div class="field">
                        <label for="location">Current Location <span class="req">*</span></label>
                        <select id="location" name="location" required>
                            <option value="">Select Location</option>
                            <?php
                            $posted = $_POST['location'] ?? '';
                            foreach ($country_list as $country) {
                                $country_safe = htmlspecialchars($country, ENT_QUOTES, 'UTF-8');
                                $selected = ($posted === $country) ? ' selected' : '';
                                echo "<option value=\"$country_safe\"$selected>$country_safe</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <!-- Mobile -->
                    <div class="field">
                        <label for="mobile">Mobile Number <span class="req">*</span></label>
                        <input id="mobile" type="text" name="mobile" placeholder="+X XX XXXXXXXX" required
                               value="<?php echo htmlspecialchars($_POST['mobile'] ?? ''); ?>">
                    </div>
                </div>

                <!-- Inquiry -->
                <div class="field">
                    <label for="inquiry">My Today's Inquiry about? <span class="req">*</span></label>
                    <select id="inquiry" name="inquiry" required>
                        <option value="">Select service type</option>
                        <option value="Student Visa" <?php if (($_POST['inquiry'] ?? '') === 'Student Visa') echo 'selected'; ?>>
                            Student Visa
                        </option>
                    </select>
                </div>

                <!-- Source -->
                <div class="field">
                    <label for="source">Where do you find us? <span class="req">*</span></label>
                    <select id="source" name="source" required>
                        <option value="">Select source</option>
                        <option value="Website" <?php if (($_POST['source'] ?? '') === 'Website') echo 'selected'; ?>>Website</option>
                        <option value="Referral" <?php if (($_POST['source'] ?? '') === 'Referral') echo 'selected'; ?>>Referral</option>
                        <option value="Social Media" <?php if (($_POST['source'] ?? '') === 'Social Media') echo 'selected'; ?>>Social Media</option>
                    </select>
                </div>

                <!-- Message -->
                <div class="field full">
                    <label for="message">Message</label>
                    <textarea id="message" name="message" placeholder="Enter personal message" rows="4"><?php echo htmlspecialchars($_POST['message'] ?? ''); ?></textarea>
                </div>

                <!-- Terms & Newsletter -->
                <div class="field checkbox-group full">
                    <label class="checkbox">
                        <input type="checkbox" name="consent" value="1" <?php if (isset($_POST['consent'])) echo 'checked'; ?> required>
                        <div>I agree to the Terms and Conditions and Privacy Policy. <span class="req">*</span></div>
                    </label>
                    <label class="checkbox">
                        <input type="checkbox" name="newsletter" value="1" <?php if (isset($_POST['newsletter'])) echo 'checked'; ?>>
                        <div>Yes, I would like to signup for Growmore immigration newsletter.</div>
                    </label>
                    <div class="note">By submitting you agree to our Terms and Privacy Policy.</div>
                </div>

                <!-- Buttons -->
                <div class="btn-row">
                    <button type="button" class="btn btn-cancel" onclick="window.history.back();">Cancel</button>
                    <button type="submit" name="submit" class="btn btn-save">Save</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
