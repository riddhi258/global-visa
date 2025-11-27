<?php
$country_list = [
    "Afghanistan",
    "Åland Islands",
    "Albania",
    "Algeria",
    "American Samoa",
    "Andorra",
    "Angola",
    "Anguilla",
    "Antarctica",
    "Antigua and Barbuda",
    "Argentina",
    "Armenia",
    "Aruba",
    "Australia",
    "Austria",
    "Azerbaijan",
    "Bahamas",
    "Bahrain",
    "Bangladesh",
    "Barbados",
    "Belarus",
    "Belgium",
    "Belize",
    "Benin",
    "Bermuda",
    "Bhutan",
    "Bolivia (Plurinational State of)",
    "Bonaire, Sint Eustatius and Saba",
    "Bosnia and Herzegovina",
    "Botswana",
    "Bouvet Island",
    "Brazil",
    "British Indian Ocean Territory",
    "Brunei Darussalam",
    "Bulgaria",
    "Burkina Faso",
    "Burundi",
    "Cabo Verde",
    "Cambodia",
    "Cameroon",
    "Canada",
    "Cayman Islands",
    "Central African Republic",
    "Chad",
    "Chile",
    "China",
    "Christmas Island",
    "Cocos (Keeling) Islands",
    "Colombia",
    "Comoros",
    "Congo",
    "Congo, Democratic Republic of the",
    "Cook Islands",
    "Costa Rica",
    "Côte d'Ivoire",
    "Croatia",
    "Cuba",
    "Curaçao",
    "Cyprus",
    "Czechia",
    "Denmark",
    "Djibouti",
    "Dominica",
    "Dominican Republic",
    "Ecuador",
    "Egypt",
    "El Salvador",
    "Equatorial Guinea",
    "Eritrea",
    "Estonia",
    "Eswatini",
    "Ethiopia",
    "Falkland Islands (Malvinas)",
    "Faroe Islands",
    "Fiji",
    "Finland",
    "France",
    "French Guiana",
    "French Polynesia",
    "French Southern Territories",
    "Gabon",
    "Gambia",
    "Georgia",
    "Germany",
    "Ghana",
    "Gibraltar",
    "Greece",
    "Greenland",
    "Grenada",
    "Guadeloupe",
    "Guam",
    "Guatemala",
    "Guernsey",
    "Guinea",
    "Guinea-Bissau",
    "Guyana",
    "Haiti",
    "Heard Island and McDonald Islands",
    "Holy See",
    "Honduras",
    "Hong Kong",
    "Hungary",
    "Iceland",
    "India",
    "Indonesia",
    "Iran (Islamic Republic of)",
    "Iraq",
    "Ireland",
    "Isle of Man",
    "Israel",
    "Italy",
    "Jamaica",
    "Japan",
    "Jersey",
    "Jordan",
    "Kazakhstan",
    "Kenya",
    "Kiribati",
    "Korea (Democratic People's Republic of)",
    "Korea, Republic of",
    "Kuwait",
    "Kyrgyzstan",
    "Lao People's Democratic Republic",
    "Latvia",
    "Lebanon",
    "Lesotho",
    "Liberia",
    "Libya",
    "Liechtenstein",
    "Lithuania",
    "Luxembourg",
    "Macao",
    "Madagascar",
    "Malawi",
    "Malaysia",
    "Maldives",
    "Mali",
    "Malta",
    "Marshall Islands",
    "Martinique",
    "Mauritania",
    "Mauritius",
    "Mayotte",
    "Mexico",
    "Micronesia (Federated States of)",
    "Moldova, Republic of",
    "Monaco",
    "Mongolia",
    "Montenegro",
    "Montserrat",
    "Morocco",
    "Mozambique",
    "Myanmar",
    "Namibia",
    "Nauru",
    "Nepal",
    "Netherlands",
    "New Caledonia",
    "New Zealand",
    "Nicaragua",
    "Niger",
    "Nigeria",
    "Niue",
    "Norfolk Island",
    "North Macedonia",
    "Northern Mariana Islands",
    "Norway",
    "Oman",
    "Pakistan",
    "Palau",
    "Palestine, State of",
    "Panama",
    "Papua New Guinea",
    "Paraguay",
    "Peru",
    "Philippines",
    "Pitcairn",
    "Poland",
    "Portugal",
    "Puerto Rico",
    "Qatar",
    "Réunion",
    "Romania",
    "Russian Federation",
    "Rwanda",
    "Saint Barthélemy",
    "Saint Helena, Ascension and Tristan da Cunha",
    "Saint Kitts and Nevis",
    "Saint Lucia",
    "Saint Martin (French part)",
    "Saint Pierre and Miquelon",
    "Saint Vincent and the Grenadines",
    "Samoa",
    "San Marino",
    "Sao Tome and Principe",
    "Saudi Arabia",
    "Senegal",
    "Serbia",
    "Seychelles",
    "Sierra Leone",
    "Singapore",
    "Sint Maarten (Dutch part)",
    "Slovakia",
    "Slovenia",
    "Solomon Islands",
    "Somalia",
    "South Africa",
    "South Georgia and the South Sandwich Islands",
    "South Sudan",
    "Spain",
    "Sri Lanka",
    "Sudan",
    "Suriname",
    "Svalbard and Jan Mayen",
    "Sweden",
    "Switzerland",
    "Syrian Arab Republic",
    "Taiwan, Province of China",
    "Tajikistan",
    "Tanzania, United Republic of",
    "Thailand",
    "Timor-Leste",
    "Togo",
    "Tokelau",
    "Tonga",
    "Trinidad and Tobago",
    "Tunisia",
    "Türkiye",
    "Turkmenistan",
    "Turks and Caicos Islands",
    "Tuvalu",
    "Uganda",
    "Ukraine",
    "United Arab Emirates",
    "United Kingdom of Great Britain and Northern Ireland",
    "United States of America",
    "United States Minor Outlying Islands",
    "Uruguay",
    "Uzbekistan",
    "Vanuatu",
    "Venezuela (Bolivarian Republic of)",
    "Viet Nam",
    "Virgin Islands (British)",
    "Virgin Islands (U.S.)",
    "Wallis and Futuna",
    "Western Sahara",
    "Yemen",
    "Zambia",
    "Zimbabwe",
];

if (isset($_POST['submit'])) {

    // Get form data safely
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $location = trim($_POST['location'] ?? '');
    $mobile = trim($_POST['mobile'] ?? '');
    $inquiry = trim($_POST['inquiry'] ?? '');
    $source = trim($_POST['source'] ?? '');
    $message = trim($_POST['message'] ?? '');

    // New checkbox fields
    $consent = isset($_POST['consent']) ? 1 : 0;       // required
    $newsletter = isset($_POST['newsletter']) ? 1 : 0;  // optional
    // mobile + country code (if you later add a country_code input)
    $country_code = trim($_POST['country_code'] ?? '');
    $mobile_local = trim($_POST['mobile'] ?? '');

    // normalize country code (allow "xx" or "+xx")
    if ($country_code !== '') {
        $country_code = preg_replace('/[^0-9+]/', '', $country_code);
        if (strpos($country_code, '+') !== 0) {
            $country_code = '+' . $country_code;
        }
    }

    // final mobile stored as "<+xx> <local>"
    $mobile = trim(($country_code ? $country_code . ' ' : '') . $mobile_local);

    // Validate required consent
    if (!$consent) {
        $error = "You must agree to the Terms and Conditions.";
    }

    // // Verify reCAPTCHA
    // $recaptcha_response = $_POST['g-recaptcha-response'] ?? '';
    // if (empty($error)) {
    //     if (empty($recaptcha_response)) {
    //         $error = "Please complete the CAPTCHA.";
    //     } else {
    //         $verify = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=" . urlencode($recaptcha_secret) . "&response=" . urlencode($recaptcha_response) . "&remoteip=" . urlencode($_SERVER['REMOTE_ADDR']));
    //         $captcha_success = json_decode($verify);
    //         if (!$captcha_success || !$captcha_success->success) {
    //             $error = "CAPTCHA verification failed. Please try again.";
    //         }
    //     }
    // }

    // Handle file upload (only if no previous error)
    // $cvFile = '';
    // if (empty($error) && isset($_FILES['cv']) && $_FILES['cv']['error'] === UPLOAD_ERR_OK) {
    //     $allowedTypes = ['pdf', 'doc', 'docx'];
    //     $fileExt = strtolower(pathinfo($_FILES['cv']['name'], PATHINFO_EXTENSION));
    //     if (in_array($fileExt, $allowedTypes)) {
    //         $uploadDir = 'uploads/';
    //         if (!is_dir($uploadDir)) {
    //             mkdir($uploadDir, 0777, true);
    //         }
    //         $cvFile = $uploadDir . time() . '_' . preg_replace('/[^A-Za-z0-9_\-\.]/', '_', basename($_FILES['cv']['name']));
    //         if (!move_uploaded_file($_FILES['cv']['tmp_name'], $cvFile)) {
    //             $error = "Failed to move uploaded file.";
    //         }
    //     } else {
    //         $error = "Invalid file type. Only PDF, DOC, DOCX allowed.";
    //     }
    // }

    if (empty($error)) {
        // Database connection
        $con = new mysqli('localhost', 'root', '', 'growmore');
        if ($con->connect_error) {
            die("Connection failed: " . $con->connect_error);
        }

        // NOTE: make sure your 'leads' table has 'consent' and 'newsletter' columns (INT or TINYINT)
        $stmt = $con->prepare("INSERT INTO leads (name, email, location, mobile, inquiry, source, message) VALUES (?, ?, ?, ?, ?, ?, ?)");
        if (!$stmt) {
            die("Prepare failed: " . $con->error);
        }

        // bind (8 strings, 2 integers)
        $stmt->bind_param("sssssss", $name, $email, $location, $mobile, $inquiry, $source, $message);

        if ($stmt->execute()) {
            $success = "Form submitted successfully!";
            // clear POST values to avoid re-populating form after success
            $_POST = [];
        } else {
            $error = "Error submitting form: " . $stmt->error;
        }

        $stmt->close();
        $con->close();
    }
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Assessment Form</title>
    <!-- Google reCAPTCHA -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <style>
        :root {
            --bg: #f3f6fa;
            --card: #ffffff;
            --muted: #9aa6b2;
            --input-bg: #f7f9fb;
            --primary: #009bff;
            --primary-dark: #0077d1;
            --shadow: 0 8px 30px rgba(20, 30, 50, 0.06);
            --radius: 12px;
        }

        html,
        body {
            height: 100%;
            margin: 0;
            font-family: Inter, system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
        }

        body {
            background: var(--bg);
            display: flex;
            align-items: flex-start;
            justify-content: center;
            padding: 36px 20px;
        }

        .card {
            width: 100%;
            max-width: 920px;
            background: var(--card);
            border-radius: var(--radius);
            padding: 34px;
            box-shadow: var(--shadow);
        }

        h2 {
            text-align: center;
            color: #1f3244;
            margin: 0 0 22px 0;
            font-size: 22px;
            letter-spacing: 0.2px;
        }

        .feedback {
            text-align: center;
            margin-bottom: 10px;
        }

        .success {
            color: #1b7a2f;
        }

        .error {
            color: #c33;
        }

        form {
            display: block;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 18px 28px;
            align-items: start;
        }


        label {
            display: block;
            font-weight: 600;
            font-size: 13px;
            margin-bottom: 8px;
            color: #33475b;
        }

        label .req {
            color: #d33;
            margin-left: 6px;
            font-weight: 700;
        }

        .field {
            width: 100%;
        }

        input[type="text"],
        input[type="email"],
        select,
        textarea,
        .file-input {
            width: 100%;
            height: 44px;
            border-radius: 10px;
            border: 1px solid transparent;
            background: var(--input-bg);
            padding: 10px 14px;
            box-sizing: border-box;
            font-size: 14px;
            color: #123;
            outline: none;
            box-shadow: inset 0 0 0 1px rgba(20, 30, 50, 0.04);
        }

        textarea {
            height: 110px;
            padding-top: 12px;
            resize: vertical;
            min-height: 100px;
            line-height: 1.4;
        }

        select {
            height: 44px;
            appearance: none;
            padding-right: 30px;
        }

        /* file input simple styling */
        input[type="file"] {
            width: 100%;
            height: 44px;
            border-radius: 10px;
            border: 1px solid transparent;
            background: var(--input-bg);
            padding: 10px 14px;
            box-sizing: border-box;
            font-size: 14px;
            color: #123;
            outline: none;
            box-shadow: inset 0 0 0 1px rgba(20, 30, 50, 0.04);
        }

        /* make some fields span full width */
        .full {
            grid-column: 1 / -1;
        }

        /* reCAPTCHA wrapper align left */
        .captcha-wrap {
            display: flex;
            justify-content: flex-start;
            align-items: flex-start;
            height: 64px;
            margin-top: 0;
        }

        .captcha-box {
            transform: scale(1);
            transform-origin: top left;
        }

        .checkbox-group {
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin-top: 6px;
        }

        .checkbox {
            display: flex;
            gap: 12px;
            align-items: flex-start;
            font-size: 13px;
            color: #465a6a;
            line-height: 1.3;
        }

        .checkbox input[type="checkbox"] {
            width: 18px;
            height: 18px;
            margin-top: 3px;
            accent-color: var(--primary);
        }

        .note {
            font-size: 13px;
            color: var(--muted);
            margin-top: 8px;
        }

        .btn-row {
            display: flex;
            gap: 12px;
            justify-content: flex-end;
            align-items: center;
            margin-top: 18px;
        }

        .btn {
            padding: 10px 18px;
            border-radius: 10px;
            font-weight: 600;
            cursor: pointer;
            border: 1px solid transparent;
            background: transparent;
        }

        .btn-cancel {
            background: #fff;
            color: #425563;
            border: 1px solid #e6e9ee;
            box-shadow: none;
        }

        .btn-save {
            background: var(--primary);
            color: #fff;
            border: none;
        }

        .btn-cancel:hover {
            background: #fbfbfd;
        }

        .btn-save:hover {
            background: var(--primary-dark);
        }

        /* responsive */
        @media (max-width:760px) {
            .form-grid {
                grid-template-columns: 1fr;
            }

            .captcha-wrap {
                justify-content: flex-start;
            }
        }
    </style>
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
                                // optional: use htmlspecialchars to be safe if names ever contain special chars
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
                            echo 'selected'; ?>>Referral</option>
                        <option value="Social Media" <?php if (($_POST['source'] ?? '') === 'Social Media')
                            echo 'selected'; ?>>Social Media</option>
                    </select>
                </div>

                <!-- <div class="field">
                        <label for="cv">Upload Document (CV)</label>
                        <input id="cv" type="file" name="cv" accept=".pdf,.doc,.docx">
                    </div> -->

                <div class="field full">
                    <label for="message">Message</label>
                    <textarea id="message" name="message" placeholder="Enter personal message"
                        rows="4"><?php echo htmlspecialchars($_POST['message'] ?? ''); ?></textarea>
                </div>

                <!-- <div class="field captcha-wrap full" style="margin-top:6px; justify-content: flex-start;">
                    <div class="captcha-box">
                        <div class="g-recaptcha" data-sitekey="<?php echo htmlspecialchars($recaptcha_site_key); ?>"></div>
                    </div>
                </div> -->

                <div class="field checkbox-group full">
                    <label class="checkbox">
                        <input type="checkbox" name="consent" value="1" <?php if (isset($_POST['consent']))
                            echo 'checked'; ?> required>
                        <div>I agree to the Terms and Conditions and Privacy Policy. <span class="req">*</span>
                        </div>
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
        </div>

        </form>
    </div>

    </div>

</body>

</html>