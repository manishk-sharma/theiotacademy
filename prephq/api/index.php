<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Content-Type, Authorization');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

include './classes/database.php';
include './classes/jwt.php';

$uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
$uri = explode('/', $uri);

$action = end($uri);

$bearer_token = get_bearer_token();
$is_jwt_valid = isset($bearer_token) ? is_jwt_valid($bearer_token) : false;
$is_admin_token_valid = false;

$database = new Database();

// Verify admin token if JWT is not valid
if (!$is_jwt_valid && isset($bearer_token)) {
    $admin = $database->verifyAdminToken($bearer_token);
    $is_admin_token_valid = ($admin !== false);
}

function get_json_body()
{
    $rest_json = file_get_contents('php://input');
    $data = json_decode($rest_json, true);
    if (!is_array($data)) {
        return_json(['status' => 0, 'error' => 'Invalid or malformed JSON input']);
    }
    return $data;
}

if ($action === 'register') {
    $_POST = get_json_body();

    $required = ['name', 'lastname', 'username', 'password', 'email'];
    foreach ($required as $field) {
        if (empty($_POST[$field])) {
            return_json(['status' => 0, 'error' => "Missing field: $field"]);
        }
    }

    if ($database->getUserByUsernameOrEmail($_POST['username']) || $database->getUserByUsernameOrEmail($_POST['email'])) {
        return_json(['status' => 0, 'error' => 'User already exists']);
    }

    $code = $database->createConfirmCodeForEmail($_POST['email'], 5);
    if (!$code) {
        return_json(['status' => 0, 'error' => 'Failed to generate confirmation code']);
    }

    // Send confirmation code via email
    $to = $_POST['email'];
    $subject = 'Your Confirmation Code';
    $name = $_POST['name'];
    // $message = "Hello {$_POST['name']},\nYour confirmation code is: {$code}\nThis code expires in 5 minutes.";
    $message = '
        <!DOCTYPE html>
        <html>
        <head>
          <meta charset="UTF-8">
          <title>prepHQ Verification Code</title>
        </head>
        <body style="background:#f3f9f8;margin:0;padding:0;">
          <table align="center" width="100%" cellpadding="0" cellspacing="0" style="max-width:600px;border-radius:8px;overflow:hidden;font-family:sans-serif;background-color:#f3f9f8;">
            <tr>
              <td style="background:#074568;padding:28px 0;text-align:center;">
                <img src="https://prephq.theiotacademy.co/email-template/img/logo.png" alt="prepHQ logo" style="max-height:46px;">
              </td>
            </tr>
            <tr>
              <td style="background:#E6FFF4;padding:0 24px;">
                <div style="width:100%;text-align:center;padding:27px 0 16px;">
                  <img src="https://prephq.theiotacademy.co/email-template/img/envelope.png" alt="envlope email"/>
                </div>
                <h2 style="color:#074568;text-align:center;font-size: 16px;margin: 30px 0;">Hello ' . htmlspecialchars($name) . ',</h2>
                <p style="font-size:1rem;text-align:center;color:#000;">
                  Use the code below to verify your sign-in to prepHQ.<br>
                  <b>Verification code:</b>
                </p>
                <div style="width:100%;text-align:center;padding:10px 0;">
                  <span style="display:inline-block;background: #57CC99;color:#074568;font-size:1rem;font-weight:bold;padding:5px 30px;border-radius:35px;letter-spacing:2px;">
                    ' . htmlspecialchars($code) . '
                  </span>
                </div>
                <p style="text-align:center;color:#000;padding:10px 0;">
                  This code expires in 5 minutes. If this wasn’t requested, please ignore this email and your account will remain secure.
                </p>
                <p style="text-align:center;color:#000;font-weight:bold; margin: 10px 0;padding-bottom: 10px;">
                  Thanks,<br>
                  The prepHQ Team
                </p>
              </td>
            </tr>
            <tr>
              <td style="padding:10px 0;text-align:center;background: #57CC99;">
                <span style="display: block;font-size:12px;color:#fff;font-weight: bold;font-style: italic;padding-bottom: 10px;">Follow On</span>
                <a href="https://www.instagram.com/prephq.tia/" style="margin:0 5px;"><img src="https://prephq.theiotacademy.co/email-template/img/instagram.png" alt="Instagram" width="21"></a>
                <a href="https://www.youtube.com/@prepHQ-b2k1r" style="margin:0 5px;"><img src="https://prephq.theiotacademy.co/email-template/img/youtube.png" alt="YouTube" width="21"></a>
                <a href="https://www.linkedin.com/company/prephqbytia" style="margin:0 5px;"><img src="https://prephq.theiotacademy.co/email-template/img/linkdin.png" alt="LinkedIn" width="21"></a>
                <a href="https://www.facebook.com/profile.php?id=61579814723823" style="margin:0 5px;"><img src="https://prephq.theiotacademy.co/email-template/img/facebook.png" alt="Facebook" width="21"></a>
                <a href="https://x.com/Prephq_tia" style="margin:0 5px;"><img src="https://prephq.theiotacademy.co/email-template/img/twiter.png" alt="Twitter" width="21"></a>
              </td>
            </tr>
          </table>
        </body>
        </html>
        ';
    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=UTF-8\r\n";
    $headers .= 'From: noreply@prephq.theiotacademy.co' . "\r\n" .
               'Reply-To: noreply@prephq.theiotacademy.co' . "\r\n" .
               'X-Mailer: PHP/' . phpversion();

    @mail($to, $subject, $message, $headers);

    // Generate short-lived JWT token with email and purpose
    $jwt_headers = ['alg' => 'HS256', 'typ' => 'JWT'];
    $payload = ['email' => $_POST['email'], 'purpose' => 'confirm', 'exp' => time() + 600]; // 10 mins
    $confirm_token = generate_jwt($jwt_headers, $payload);

    return_json(['status' => 1, 'confirm_token' => $confirm_token, 'message' => 'Code sent to email']);
}

elseif ($action === 'confirm') {
    if (!$is_jwt_valid) return_json(['status' => 0, 'error' => 'Invalid token']);
    $_POST = get_json_body();
    $code = trim($_POST['code'] ?? '');
    $user = $_POST['user'] ?? null;
    if (!$code || !$user || !is_array($user)) return_json(['status' => 0, 'error' => 'Invalid request']);
    $payload = getPayload($bearer_token);
    if (!isset($payload->email) || ($payload->purpose ?? '') !== 'confirm') return_json(['status' => 0, 'error' => 'Token not valid']);
    if (strtolower($payload->email) !== strtolower($user['email'] ?? '')) return_json(['status' => 0, 'error' => 'Email mismatch']);

    $valid = $database->validateConfirmCode($payload->email, $code);
    if (!$valid['valid']) {
        $database->deleteConfirmCode($payload->email);
        return_json(['status' => 0, 'error' => 'Invalid or expired code']);
    }
    if ($database->getUserByUsernameOrEmail($user['username']) || $database->getUserByUsernameOrEmail($user['email'])) {
        $database->deleteConfirmCode($payload->email);
        return_json(['status' => 0, 'error' => 'User already exists']);
    }
    $now = date('Y-m-d H:i:s');
    $userData = [
        'name' => trim($user['name']),
        'lastname' => trim($user['lastname']),
        'username' => trim($user['username']),
        // 'password' => password_hash($user['password'], PASSWORD_BCRYPT),
        'password' =>trim($user['password']),
        'email' => trim($user['email']),
        'status' => 1,
        'created_date' => $now
    ];
    $user_id = $database->register($userData);
    if (!$user_id) {
        $database->deleteConfirmCode($payload->email);
        return_json(['status' => 0, 'error' => 'User registration failed']);
    }
    $database->deleteConfirmCode($payload->email);

    $jwt_headers = ['alg' => 'HS256', 'typ' => 'JWT'];
    $auth_payload = ['user' => ['id' => $user_id, 'username' => $userData['username'], 'email' => $userData['email']]];
    $auth_token = generate_jwt($jwt_headers, $auth_payload);
    return_json(['status' => 1, 'token' => $auth_token, 'message' => 'User confirmed and created']);
}

elseif ($action === 'resend-code') {
    if (!$is_jwt_valid) {
        return_json(['status' => 0, 'error' => 'Invalid token']);
    }

    $payload = getPayload($bearer_token);
    if (!isset($payload->email) || ($payload->purpose ?? '') !== 'confirm') {
        return_json(['status' => 0, 'error' => 'Invalid token payload']);
    }

    $email = $payload->email;

    $code = $database->createConfirmCodeForEmail($email, 5);
    if (!$code) {
        return_json(['status' => 0, 'error' => 'Failed to generate new confirmation code']);
    }

    $to      = $email;
    $subject = 'Your Confirmation Code';
    $name = $_POST['name'];
    // $message = "Your new confirmation code is: $code\nIt will expire in 5 minutes.";
    $message = '
        <!DOCTYPE html>
        <html>
        <head>
          <meta charset="UTF-8">
          <title>prepHQ Verification Code</title>
        </head>
        <body style="background:#f3f9f8;margin:0;padding:0;">
          <table align="center" width="100%" cellpadding="0" cellspacing="0" style="max-width:600px;border-radius:8px;overflow:hidden;font-family:sans-serif;background-color:#f3f9f8;">
            <tr>
              <td style="background:#074568;padding:28px 0;text-align:center;">
                <img src="https://prephq.theiotacademy.co/email-template/img/logo.png" alt="prepHQ logo" style="max-height:46px;">
              </td>
            </tr>
            <tr>
              <td style="background:#E6FFF4;padding:0 24px;">
                <div style="width:100%;text-align:center;padding:27px 0 16px;">
                  <img src="https://prephq.theiotacademy.co/email-template/img/envelope.png" alt="envlope email"/>
                </div>
                <h2 style="color:#074568;text-align:center;font-size: 16px;margin: 30px 0;">Hello ' . htmlspecialchars($name) . ',</h2>
                <p style="font-size:1rem;text-align:center;color:#000;">
                  Use the code below to verify your sign-in to prepHQ.<br>
                  <b>New Verification code:</b>
                </p>
                <div style="width:100%;text-align:center;padding:10px 0;">
                  <span style="display:inline-block;background: #57CC99;color:#074568;font-size:1rem;font-weight:bold;padding:5px 30px;border-radius:35px;letter-spacing:2px;">
                    ' . htmlspecialchars($code) . '
                  </span>
                </div>
                <p style="text-align:center;color:#000;padding:10px 0;">
                  This code expires in 5 minutes. If this wasn’t requested, please ignore this email and your account will remain secure.
                </p>
                <p style="text-align:center;color:#000;font-weight:bold; margin: 10px 0;padding-bottom: 10px;">
                  Thanks,<br>
                  The prepHQ Team
                </p>
              </td>
            </tr>
            <tr>
              <td style="padding:10px 0;text-align:center;background: #57CC99;">
                <span style="display: block;font-size:12px;color:#fff;font-weight: bold;font-style: italic;padding-bottom: 10px;">Follow On</span>
                <a href="https://www.instagram.com/prephq.tia/" style="margin:0 5px;"><img src="https://prephq.theiotacademy.co/email-template/img/instagram.png" alt="Instagram" width="21"></a>
                <a href="https://www.youtube.com/@prepHQ-b2k1r" style="margin:0 5px;"><img src="https://prephq.theiotacademy.co/email-template/img/youtube.png" alt="YouTube" width="21"></a>
                <a href="https://www.linkedin.com/company/prephqbytia" style="margin:0 5px;"><img src="https://prephq.theiotacademy.co/email-template/img/linkdin.png" alt="LinkedIn" width="21"></a>
                <a href="https://www.facebook.com/profile.php?id=61579814723823" style="margin:0 5px;"><img src="https://prephq.theiotacademy.co/email-template/img/facebook.png" alt="Facebook" width="21"></a>
                <a href="https://x.com/Prephq_tia" style="margin:0 5px;"><img src="https://prephq.theiotacademy.co/email-template/img/twiter.png" alt="Twitter" width="21"></a>
              </td>
            </tr>
          </table>
        </body>
        </html>
        ';
    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=UTF-8\r\n";
    $headers .= 'From: noreply@prephq.theiotacademy.co' . "\r\n" .
               'Reply-To: noreply@prephq.theiotacademy.co' . "\r\n" .
               'X-Mailer: PHP/' . phpversion();

    @mail($to, $subject, $message, $headers);

    return_json(['status' => 1, 'message' => 'New code sent']);
}

elseif ($action === 'login') {
    $_POST = get_json_body();
    
    $identifier = $_POST['username'] ?? $_POST['email'] ?? null; // either username or email
    $password = $_POST['password'] ?? null;
            // md5($_POST['password'])

    if (empty($identifier) || empty($password)) {
        return_json(['status' => 0, 'error' => 'Missing username/email or password']);
    }

    if (
        $user = $database->loginUser($identifier, $password)
        // md5($password) if using hashed passwords
    ) {
        $headers = ['alg' => 'HS256', 'typ' => 'JWT'];
        $payload = ['user' => $user];
        $jwt = generate_jwt($headers, $payload);
        return_json(['status' => 1, 'token' => $jwt]);
    }
    return_json(['status' => 0, 'error' => 'Invalid credentials']);
}
elseif ($action === 'admin-login') {
    try {
        $_POST = get_json_body();

        $adminname = $_POST['username'] ?? '';
        $password  = $_POST['password'] ?? '';

        // Validate input
        if (empty($adminname) || empty($password)) {
            return_json(['status' => false, 'message' => 'Adminname and password are required']);
        }

        // Login admin
        $admin = $database->loginAdmin($adminname, $password);

        if (!$admin) {
            return_json(['status' => false, 'message' => 'Invalid adminname or password']);
        }

        // Generate Token
        $token = $database->generateAndUpdateAdminToken($admin['id']);

        if (!$token) {
            return_json(['status' => false, 'message' => 'Token generation failed']);
        }

      return_json([
            'status' => true,
            'message' => 'Login successful',
            'token'   => $token
        ]);

    } catch (Exception $e) {
        // Global Error Handling
        return_json([
            'status' => false,
            'message' => 'Server Error',
            'error'   => $e->getMessage()
        ]);
    }
}


elseif ($action === 'user') {
    if ($is_jwt_valid) {
        $username = getPayload($bearer_token)->user->username;
        if ($user = $database->getUserByUsernameOrEmail($username)) {
            return_json(['status' => 1, 'user' => $user]);
        }
    }
    return_json(['status' => 0, 'error' => 'Invalid token or user not found']);
}

elseif ($action === 'profileupdate') {
    if ($is_jwt_valid) {
        $_POST = get_json_body();

        $user_id = getPayload($bearer_token)->user->id;

        // ✅ Only allow safe editable fields
        $fields = [
            'name', 'lastname', 'email', 'username', 
            'usertype', 'countrycode', 'phone', 'city', 
            'portfolio', 'linkdin', 'github', 'codePen',
            'degreeOne', 'instituteOne', 'degreeTwo', 'instituteTwo',
            'organizationOne', 'designationOne', 'experienceonOne',
            'organizationTwo', 'designationTwo', 'experienceonTwo',
            'profile_image'
        ];
        $updated_data = [];

        foreach ($fields as $field) {
            if (isset($_POST[$field])) {
                // ✅ Basic sanitization
                $updated_data[$field] = trim(htmlspecialchars($_POST[$field]));
            }
        }

        if (!empty($updated_data)) {
            $updated_data['id'] = $user_id;
        
            if ($database->updateUser($updated_data)) {
                return_json(['status' => 1, 'message' => 'Profile updated successfully']);
                exit;
            }
            else {
                return_json(['status' => 0, 'error' => 'Update failed']);
                exit;
            }
        } 
        else {
            return_json(['status' => 0, 'error' => 'Nothing to update or update failed']);
            exit;
        }
    }

    return_json(['status' => 0, 'error' => 'Invalid token']);
}

elseif ($action === 'upload-profile-image') {
    if ($is_jwt_valid) {
        $user_id = getPayload($bearer_token)->user->id;

        if (!isset($_FILES['profile_image']) || $_FILES['profile_image']['error'] !== 0) {
            return_json(['status' => 0, 'error' => 'No file uploaded']);
            exit;
        }

        $file = $_FILES['profile_image'];
        $allowedTypes = ['image/jpeg', 'image/png', 'image/webp', 'image/jpg'];
        $maxSize = 2 * 1024 * 1024; // 2MB

        if (!in_array($file['type'], $allowedTypes)) {
            return_json(['status' => 0, 'error' => 'Invalid file type']);
            exit;
        }

        if ($file['size'] > $maxSize) {
            return_json(['status' => 0, 'error' => 'File too large']);
            exit;
        }

        // Delete old profile image (if not default)
        $currentUser = $database->getUserById($user_id);
        if ($currentUser && !empty($currentUser['profile_image'])) {
            $oldPath = __DIR__ . '/../' . $currentUser['profile_image'];
            if (file_exists($oldPath) && strpos($currentUser['profile_image'], 'default') === false) {
                unlink($oldPath);
            }
        }

        // Ensure upload directory exists
        $uploadDir = __DIR__ . '/../uploads/profile_images/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        // Unique filename
        $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
        $newFileName = uniqid("profile_") . "." . strtolower($ext);
        $targetPath = $uploadDir . $newFileName;

        if (!move_uploaded_file($file['tmp_name'], $targetPath)) {
            return_json(['status' => 0, 'error' => 'File upload failed']);
            exit;
        }

        $dbPath = "uploads/profile_images/" . $newFileName;

        // Update user record in DB
        if ($database->updateUser(['id' => $user_id, 'profile_image' => $dbPath])) {
            $fullUrl = "https://prephq.theiotacademy.co/" . $dbPath;
            return_json(['status' => 'success', 'image' => $fullUrl]);
        } else {
            // Cleanup uploaded file if DB update fails
            if (file_exists($targetPath)) unlink($targetPath);
            return_json(['status' => 0, 'error' => 'Database update failed']);
        }
    } else {
        return_json(['status' => 0, 'error' => 'Invalid token']);
    }
}


elseif ($action === 'upload-resume') {
    if ($is_jwt_valid) {
        $user_id = getPayload($bearer_token)->user->id;

        if (!isset($_FILES['resume']) || $_FILES['resume']['error'] !== 0) {
            return_json(['status' => 0, 'error' => 'No file uploaded']);
            exit;
        }

        $file = $_FILES['resume'];
        $allowedTypes = [
            'application/pdf',
            'application/msword',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
        ];
        $maxSize = 2 * 1024 * 1024; // 2MB

        if (!in_array($file['type'], $allowedTypes)) {
            return_json(['status' => 0, 'error' => 'Invalid file type (only PDF, DOC, DOCX allowed)']);
            exit;
        }

        if ($file['size'] > $maxSize) {
            return_json(['status' => 0, 'error' => 'File too large']);
            exit;
        }

        // Create uploads directory if missing
        $uploadDir = __DIR__ . '/../uploads/resumes/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        // Unique filename
        $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
        $newFileName = uniqid("resume_") . "." . strtolower($ext);
        $targetPath = $uploadDir . $newFileName;

        if (!move_uploaded_file($file['tmp_name'], $targetPath)) {
            return_json(['status' => 0, 'error' => 'File upload failed']);
            exit;
        }

        // Relative path for DB
        date_default_timezone_set('Asia/Kolkata');
        $currentDate = date('Y-m-d H:i:s');
        $dbPath = "uploads/resumes/" . $newFileName;
        $updateData = [
            'id' => $user_id,
            'resume' => $dbPath,
            'resume_date' => $currentDate,
        ];
        if ($database->updateUser($updateData)) {
            return_json([
                'status' => 'success',
                'resume' => $dbPath,
                'resumeDate' => $currentDate,
            ]);
        } else {
            return_json(['status' => 0, 'error' => 'Database update failed']);
            if (file_exists($targetPath)) {
                unlink($targetPath);
            }
        }
    } else {
        return_json(['status' => 0, 'error' => 'Invalid token']);
    }
}

elseif ($action === 'delete-resume') {
    if ($is_jwt_valid) {
        $user_id = getPayload($bearer_token)->user->id;
        $currentUser = $database->getUserById($user_id);

        if (!$currentUser || empty($currentUser['resume'])) {
            return_json(['status' => 0, 'error' => 'No resume found to delete']);
            exit();
        }

        $resumePath = realpath(__DIR__ . '/../' . $currentUser['resume']);
        if ($resumePath && file_exists($resumePath) && strpos($currentUser['resume'], 'default') === false) {
            if (!unlink($resumePath)) {
                error_log("Failed to delete resume file: $resumePath");
                return_json(['status' => 0, 'error' => 'Failed to delete resume file']);
                exit();
            }
        } else {
            return_json(['status' => 0, 'error' => 'Resume file does not exist']);
            exit();
        }

        $updateData = [
            'id' => $user_id,
            'resume' => null,
            'resume_date' => null,
        ];
        if ($database->updateUser($updateData)) {
            return_json(['status' => 'success', 'message' => 'Resume deleted successfully']);
        } else {
            return_json(['status' => 0, 'error' => 'Failed to update database']);
        }
    } else {
        return_json(['status' => 0, 'error' => 'Invalid token']);
    }
}



elseif ($action === 'get-user') {
    if ($is_jwt_valid) {
        $user_id = getPayload($bearer_token)->user->id;

        if (!$user) {
            return_json(['status' => 0, 'error' => 'User not found']);
            exit;
        }

        $user['resumeDate'] = isset($user['resume_date']) ? $user['resume_date'] : null;

        return_json(['status' => 'success', 'user' => $user]);
    } else {
        return_json(['status' => 0, 'error' => 'Invalid token']);
    }
}

//reset passwor api code start
elseif ($action === 'request_reset') {
    $_POST = get_json_body();

    $identifier = $_POST['username'] ?? $_POST['email'] ?? null; // Either username or email

    if (empty($identifier)) {
        return_json(['status' => 0, 'error' => 'Missing username or email']);
    }

    // Try to find user by username or email
    $user = $database->getUserByUsernameOrEmail($identifier);

    if (!$user) {
        return_json(['status' => 0, 'error' => 'User not found']);
    }

    $code = $database->createConfirmCodeForEmail($user['email'], 5);
    if (!$code) {
        return_json(['status' => 0, 'error' => 'Failed to generate reset code']);
    }

    // Send reset code via email
    $to = $user['email'];
    $subject = 'Your Password Reset Code';
    $name = $user['name'];
    // $message = "Hello {$user['name']},\nYour password reset code is: {$code}\nThis code expires in 5 minutes.";
    $message = '
        <!DOCTYPE html>
        <html>
        <head>
          <meta charset="UTF-8">
          <title>prepHQ Verification Code</title>
        </head>
        <body style="background:#f3f9f8;margin:0;padding:0;">
          <table align="center" width="100%" cellpadding="0" cellspacing="0" style="max-width:600px;border-radius:8px;overflow:hidden;font-family:sans-serif;background-color:#f3f9f8;">
            <tr>
              <td style="background:#074568;padding:28px 0;text-align:center;">
                <img src="https://prephq.theiotacademy.co/email-template/img/logo.png" alt="prepHQ logo" style="max-height:46px;">
              </td>
            </tr>
            <tr>
              <td style="background:#E6FFF4;padding:0 24px;">
                <div style="width:100%;text-align:center;padding:27px 0 16px;">
                  <img src="https://prephq.theiotacademy.co/email-template/img/envelope.png" alt="envlope email"/>
                </div>
                <h2 style="color:#074568;text-align:center;font-size: 16px;margin: 30px 0;">Hello ' . htmlspecialchars($name) . ',</h2>
                <p style="font-size:1rem;text-align:center;color:#000;">
                  Use the code below to verify your sign-in to prepHQ.<br>
                  <b>Password Reset Verification code:</b>
                </p>
                <div style="width:100%;text-align:center;padding:10px 0;">
                  <span style="display:inline-block;background: #57CC99;color:#074568;font-size:1rem;font-weight:bold;padding:5px 30px;border-radius:35px;letter-spacing:2px;">
                    ' . htmlspecialchars($code) . '
                  </span>
                </div>
                <p style="text-align:center;color:#000;padding:10px 0;">
                  This code expires in 5 minutes. If this wasn’t requested, please ignore this email and your account will remain secure.
                </p>
                <p style="text-align:center;color:#000;font-weight:bold; margin: 10px 0;padding-bottom: 10px;">
                  Thanks,<br>
                  The prepHQ Team
                </p>
              </td>
            </tr>
            <tr>
              <td style="padding:10px 0;text-align:center;background: #57CC99;">
                <span style="display: block;font-size:12px;color:#fff;font-weight: bold;font-style: italic;padding-bottom: 10px;">Follow On</span>
                <a href="https://www.instagram.com/prephq.tia/" style="margin:0 5px;"><img src="https://prephq.theiotacademy.co/email-template/img/instagram.png" alt="Instagram" width="21"></a>
                <a href="https://www.youtube.com/@prepHQ-b2k1r" style="margin:0 5px;"><img src="https://prephq.theiotacademy.co/email-template/img/youtube.png" alt="YouTube" width="21"></a>
                <a href="https://www.linkedin.com/company/prephqbytia" style="margin:0 5px;"><img src="https://prephq.theiotacademy.co/email-template/img/linkdin.png" alt="LinkedIn" width="21"></a>
                <a href="https://www.facebook.com/profile.php?id=61579814723823" style="margin:0 5px;"><img src="https://prephq.theiotacademy.co/email-template/img/facebook.png" alt="Facebook" width="21"></a>
                <a href="https://x.com/Prephq_tia" style="margin:0 5px;"><img src="https://prephq.theiotacademy.co/email-template/img/twiter.png" alt="Twitter" width="21"></a>
              </td>
            </tr>
          </table>
        </body>
        </html>
        ';
    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=UTF-8\r\n";
    $headers .= 'From: noreply@prephq.theiotacademy.co' . "\r\n" .
               'Reply-To: noreply@prephq.theiotacademy.co' . "\r\n" .
               'X-Mailer: PHP/' . phpversion();

    @mail($to, $subject, $message, $headers);

    // Generate a JWT for reset confirmation
    $jwt_headers = ['alg' => 'HS256', 'typ' => 'JWT'];
    $payload = [
        'email' => $user['email'],
        'purpose' => 'reset',
        'exp' => time() + 600 // 10 mins
    ];
    $confirm_token = generate_jwt($jwt_headers, $payload);

    return_json(['status' => 1, 'confirm_token' => $confirm_token, 'message' => 'Reset code sent to email']);
}

elseif ($action === 'verify_code') {
    if (!$is_jwt_valid) return_json(['status' => 0, 'error' => 'Invalid token']);
    $_POST = get_json_body();
    $code = trim($_POST['code'] ?? '');

    if (!$code) return_json(['status' => 0, 'error' => 'Missing code']);

    $payload = getPayload($bearer_token);

    // Check JWT: purpose must be 'reset'; JWT must contain 'email'
    if (!isset($payload->email) || ($payload->purpose ?? '') !== 'reset') {
        return_json(['status' => 0, 'error' => 'Token not valid for password reset']);
    }

    $email = $payload->email;

    // Validate code
    $valid = $database->validateConfirmCode($email, $code);

    if (!$valid['valid']) {
        $database->deleteConfirmCode($email);
        return_json(['status' => 0, 'error' => 'Invalid or expired code']);
    }

    // Success: code is valid for this email
    // Optionally create a new JWT for password reset step
    $jwt_headers = ['alg' => 'HS256', 'typ' => 'JWT'];
    $payload2 = [
        'email' => $email,
        'purpose' => 'reset_verified',
        'exp' => time() + 600 // 10 min to complete reset
    ];
    $reset_token = generate_jwt($jwt_headers, $payload2);

    // Delete the code after successful verification (optional, prevents reuse)
    $database->deleteConfirmCode($email);

    return_json([
        'status' => 1,
        'reset_token' => $reset_token,
        'message' => 'Code verified, proceed to set new password'
    ]);
}

elseif ($action === 'reset_password') {
    if (!$is_jwt_valid) return_json(['status' => 0, 'error' => 'Invalid token']);
    
    $_POST = get_json_body();
    $username = trim($_POST['username'] ?? '');
    $new_password = trim($_POST['new_password'] ?? '');

    if (!$username || !$new_password) {
        return_json(['status' => 0, 'error' => 'Missing required fields']);
    }

    $payload = getPayload($bearer_token);

    if (!isset($payload->email) || ($payload->purpose ?? '') !== 'reset_verified') {
        return_json(['status' => 0, 'error' => 'Invalid token purpose']);
    }

    $user = $database->getUserByUsernameOrEmail($username);
    if (!$user || strtolower($user['email']) !== strtolower($payload->email)) {
        return_json(['status' => 0, 'error' => 'User not found or email mismatch']);
    }

    // $hashedPassword = password_hash($new_password, PASSWORD_BCRYPT);
    $hashedPassword = $new_password;

    $updateSuccess = $database->updateUser([
        'id' => $user['id'],
        'password' => $hashedPassword,
    ]);

    if (!$updateSuccess) {
        return_json(['status' => 0, 'error' => 'Failed to update password']);
    }

    return_json(['status' => 1, 'message' => 'Password reset successful']);
}




//reset passwor api code end

elseif ($action === 'contactus') {
    $_POST = get_json_body();

    $firstname = trim($_POST['firstname'] ?? '');
    $lastname  = trim($_POST['lastname'] ?? '');
    $countryCode     = trim($_POST['countryCode'] ?? '');
    $phone     = trim($_POST['phone'] ?? '');
    $email     = trim($_POST['email'] ?? '');
    $message   = trim($_POST['message'] ?? '');

    if (!$firstname || !$lastname || !$countryCode || !$phone || !$email || !$message) {
        return_json(['status' => 0, 'error' => 'All fields are required']);
    }

    $contact = [
        'firstname'   => $firstname,
        'lastname'    => $lastname,
        'countryCode'       => $countryCode,
        'phone'       => $phone,
        'email'       => $email,
        'message'     => $message,
        'status'      => 0,
        'created_at'  => date('Y-m-d H:i:s'),
    ];

    // Save message to database using correct method
    if ($contact_id = $database->saveContactMessage($contact)) {
        $contact['id'] = $contact_id;

        // Send email
        $to = 'prephq@theiotacademy.co';
        $subject = 'PrepHq Contact Form Submission';
        $headers = "From: {$email}\r\nReply-To: {$email}\r\nContent-Type: text/html; charset=UTF-8";
        $body = "<strong>First Name:</strong> {$firstname}<br>
                 <strong>Last Name:</strong> {$lastname}<br>
                 <strong>Phone No:</strong> {$countryCode}- {$phone}<br>
                 <strong>Email:</strong> {$email}<br>
                 <strong>Message:</strong><br>" . nl2br(htmlspecialchars($message));

        if (mail($to, $subject, $body, $headers)) {
            return_json(['status' => 1, 'message' => 'Message sent and saved successfully']);
        } else {
            return_json(['status' => 0, 'error' => 'Message saved, but failed to send email']);
        }
    }

    return_json(['status' => 0, 'error' => 'Failed to save contact message']);
}

elseif ($action === 'newsletterSubscribe') {
    $_POST = get_json_body();
    $email = trim($_POST['email'] ?? '');

    if (!$email) {
        return_json(['status' => 0, 'error' => 'Email is required']);
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return_json(['status' => 0, 'error' => 'Invalid email address']);
    }

    $result = $database->saveNewsletterSubscriber($email);

    if ($result === 'exists') {
        return_json(['status' => 0, 'error' => 'You have already subscribed.']);
    }

    if ($result) {
        // Send confirmation email
        $to = $email;
        $subject = 'Subscription Confirmed - PrepHQ';

        $headers = "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
        $headers .= "From: PrepHQ <prephq@theiotacademy.co>\r\n";
        $headers .= "Reply-To: prephq@theiotacademy.co\r\n";
        
        // $body = '
        //     <html>
        //     <head><title>Subscription Confirmation</title></head>
        //     <body>
        //         <p>Hi there,</p>
        //         <p>Thank you for subscribing to <strong>PrepHQ</strong> updates!</p>
        //         <p>You’ll now receive exclusive news, learning tips, and updates directly in your inbox.</p>
        //         <br>
        //         <p>Stay tuned!</p>
        //         <p><strong>- The IoT Academy Team</strong></p>
        //     </body>
        //     </html>
        // ';

        $body = '
        <!DOCTYPE html>
        <html>
        <head>
          <meta charset="UTF-8">
          <title>prepHQ Subscription Confirmation</title>
        </head>
        <body style="background:#f3f9f8;margin:0;padding:0;">
          <table align="center" width="100%" cellpadding="0" cellspacing="0" style="max-width:600px;border-radius:8px;overflow:hidden;font-family:sans-serif;background-color:#f3f9f8;">
            <tr>
              <td style="background:#074568;padding:28px 0;text-align:center;">
                <img src="https://prephq.theiotacademy.co/email-template/img/logo.png" alt="prepHQ logo" style="max-height:46px;">
              </td>
            </tr>
            <tr>
              <td style="background:#E6FFF4;padding:0 24px;">
                <div style="width:100%;text-align:center;padding:27px 0 16px;">
                  <img src="https://prephq.theiotacademy.co/email-template/img/envelope.png" alt="envlope email"/>
                </div>
                <h2 style="color:#074568;text-align:center;font-size: 16px;margin: 30px 0;">Hi there,</h2>
                <p style="font-size:1rem;text-align:center;color:#000;">
                  Thank you for subscribing to <b>PrepHQ</b> updates!
                </p>
                <p style="text-align:center;color:#000;padding:10px 0;">
                  You’ll now receive exclusive news, learning tips, and updates directly in your inbox.
                </p>
                <p style="text-align:center;color:#000;font-weight:bold; margin: 10px 0;padding-bottom: 10px;">
                  Thanks,<br>
                  The prepHQ Team
                </p>
              </td>
            </tr>
            <tr>
              <td style="padding:10px 0;text-align:center;background: #57CC99;">
                <span style="display: block;font-size:12px;color:#fff;font-weight: bold;font-style: italic;padding-bottom: 10px;">Follow On</span>
                <a href="https://www.instagram.com/prephq.tia/" style="margin:0 5px;"><img src="https://prephq.theiotacademy.co/email-template/img/instagram.png" alt="Instagram" width="21"></a>
                <a href="https://www.youtube.com/@prepHQ-b2k1r" style="margin:0 5px;"><img src="https://prephq.theiotacademy.co/email-template/img/youtube.png" alt="YouTube" width="21"></a>
                <a href="https://www.linkedin.com/company/prephqbytia" style="margin:0 5px;"><img src="https://prephq.theiotacademy.co/email-template/img/linkdin.png" alt="LinkedIn" width="21"></a>
                <a href="https://www.facebook.com/profile.php?id=61579814723823" style="margin:0 5px;"><img src="https://prephq.theiotacademy.co/email-template/img/facebook.png" alt="Facebook" width="21"></a>
                <a href="https://x.com/Prephq_tia" style="margin:0 5px;"><img src="https://prephq.theiotacademy.co/email-template/img/twiter.png" alt="Twitter" width="21"></a>
              </td>
            </tr>
          </table>
        </body>
        </html>
        ';

        // Optional: suppress errors in production with @mail()
        if (mail($to, $subject, $body, $headers)) {
            return_json(['status' => 1, 'message' => 'Subscribed successfully. Confirmation email sent.']);
        } else {
            return_json(['status' => 1, 'message' => 'Subscribed successfully. Email could not be sent.']);
        }
    }

    return_json(['status' => 0, 'error' => 'Something went wrong. Please try again.']);
}


elseif ($action === 'get-all-data') {
    $allData = $database->getAllDatabaseData();
    if ($allData === false) {
        return_json(['status' => 0, 'error' => 'Failed to fetch database data']);
    }
    return_json(['status' => 1, 'data' => $allData]);
}

// ======================= ADD JOB ==========================
elseif ($action === 'add-job') {

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        return_json(['status'=>false,'error'=>'Only POST allowed']);
    }

    // Token check (as per your system)
    if (!$is_jwt_valid && !$is_admin_token_valid) {
        return_json(['status'=>false,'error'=>'Unauthorized']);
    }

    // Get form data
    $position    = trim($_POST['position'] ?? '');
    $company     = trim($_POST['company'] ?? '');
    $min_year    = trim($_POST['min_year'] ?? '');
    $max_year    = trim($_POST['max_year'] ?? '');
    $location    = trim($_POST['location'] ?? '');
    $deadline    = trim($_POST['deadline'] ?? '');
    $description = $_POST['description'] ?? '';
    $apply_link  = trim($_POST['apply_link'] ?? ''); // REQUIRED ✔

    // Validation
    if (!$position || !$company || !$location || !$deadline || !$apply_link) {
        return_json(['status'=>false,'error'=>'Missing required fields']);
    }
    if (!is_numeric($min_year) || !is_numeric($max_year)) {
        return_json(['status'=>false,'error'=>'min_year and max_year must be numeric']);
    }
    if (!strtotime($deadline)) {
        return_json(['status'=>false,'error'=>'Invalid deadline date']);
    }

    // Prepare data array
    $job_data = [
        'position'    => $position,
        'company'     => $company,
        'min_year'    => intval($min_year),
        'max_year'    => intval($max_year),
        'location'    => $location,
        'deadline'    => $deadline,
        'description' => $description,
        'apply_link'  => $apply_link  // ✔ IMPORTANT
    ];

    $job_id = $database->addJob($job_data);

    if(!$job_id) return_json(['status'=>false,'error'=>'Insert failed']);

    return_json(['status'=>true,'message'=>'Job added successfully','job_id'=>$job_id]);
}




// GET JOB BY ID (Allow only GET request)
elseif ($action === 'get-job') {

    if($_SERVER['REQUEST_METHOD'] !== 'GET') {
        return_json([
            'status' => false,
            'message' => 'Only GET method allowed'
        ]);
    }

    $id = isset($_GET['id']) ? intval($_GET['id']) : null;

    if(!$id) return_json(['status'=>false,'message'=>'ID required']);

    $job = $database->getJobDetailsById($id);

    if(!$job) return_json(['status'=>false,'message'=>'Job not found']);

    return_json(['status'=>true,'data'=>$job]);
}


// ================== GET ALL JOBS (ONLY GET METHOD) ======================
elseif ($action === 'get-all-jobs') {

    // Allow only GET request
    if($_SERVER['REQUEST_METHOD'] !== 'GET') {
        return_json([
            'status' => false,
            'message' => 'Only GET method allowed'
        ]);
    }

    $jobs = $database->getAllJobs();

    if(!$jobs) return_json(['status'=>false,'message'=>'No jobs found']);

    return_json(['status'=>true,'data'=>$jobs]);
}


// ================== DELETE JOB BY ID ======================
elseif ($action === 'delete-job') {

    // Only DELETE allowed (optional but recommended)
    if ($_SERVER['REQUEST_METHOD'] !== 'DELETE') {
        return_json(['status'=>false,'message'=>'Only DELETE method allowed']);
    }

    // Token security same as add-job
    if (!$is_jwt_valid && !$is_admin_token_valid) {
        return_json(['status'=>false,'message'=>'Unauthorized Token']);
    }

    $id = isset($_GET['id']) ? intval($_GET['id']) : null;

    if(!$id) return_json(['status'=>false,'message'=>'ID required']);

    $result = $database->deleteJob($id);

    if($result){
        return_json(['status'=>true,'message'=>'Job deleted successfully']);
    } else {
        return_json(['status'=>false,'message'=>'Failed to delete or Job not found']);
    }
}

//======================edit-job=========================
elseif ($action === 'edit-job') {

    if ($_SERVER['REQUEST_METHOD'] !== 'PATCH') {
        return_json(['status'=>false,'error'=>'Only PATCH allowed']);
    }

    if (!$is_jwt_valid && !$is_admin_token_valid) {
        return_json(['status'=>false,'error'=>'Unauthorized']);
    }

    $data = json_decode(file_get_contents("php://input"), true);

    if(!$data) return_json(['status'=>false,'error'=>'Invalid or missing JSON body']);

    $id = $data['id'] ?? null;
    if(!$id) return_json(['status'=>false,'error'=>'Job ID required']);

    $job_data = ['id' => intval($id)];

    if(isset($data['position']))    $job_data['position']    = trim($data['position']);
    if(isset($data['company']))     $job_data['company']     = trim($data['company']);
    if(isset($data['min_year']))    $job_data['min_year']    = intval($data['min_year']);
    if(isset($data['max_year']))    $job_data['max_year']    = intval($data['max_year']);
    if(isset($data['location']))    $job_data['location']    = trim($data['location']);
    if(isset($data['deadline']))    $job_data['deadline']    = trim($data['deadline']);
    if(isset($data['description'])) $job_data['description'] = $data['description'];
    if(isset($data['apply_link']))  $job_data['apply_link']  = trim($data['apply_link']);

    if(count($job_data) === 1) {
        return_json(['status'=>false,'error'=>'No fields provided for update']);
    }

    $result = $database->editJob($job_data);

    // 🔥 updated section
    if(!$result) {
        $exists = $database->getJobDetailsById($id);
        if(!$exists) {
            return_json(['status'=>false,'error'=>'Job not found']);
        }
        return_json(['status'=>false,'error'=>'No change made or update failed']);
    }

    return_json(['status'=>true,'message'=>'Job updated successfully']);
}



else{
return_json(['status' => 0, 'error' => 'Invalid endpoint']);
}

function return_json($arr)
{
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Headers: *');
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($arr);
    exit();
}
