
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Masterclass Settings Login</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .login-card {
            width: 100%;
            max-width: 420px;
            background: #ffffff;
            border-radius: 14px;
            padding: 35px;
            box-shadow: 0 5px 25px rgba(0, 0, 0, 0.07);
        }

        .login-icon {
            width: 54px;
            height: 54px;
            background: #eff6ff;
            color: #1d4ed8;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 22px;
        }

        h2 {
            margin: 0 0 10px;
            color: #172554;
            font-size: 24px;
        }

        .subtitle {
            color: #64748b;
            font-size: 14px;
            line-height: 1.6;
            margin-bottom: 28px;
        }

        label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 9px;
        }

        .password-wrapper {
            position: relative;
            margin-bottom: 22px;
        }

        .password-wrapper input {
            width: 100%;
            padding: 13px 75px 13px 14px;
            border: 1px solid #cbd5e1;
            border-radius: 7px;
            font-size: 15px;
            outline: none;
            transition: border-color 0.2s;
        }

        .password-wrapper input:focus {
            border-color: #1d4ed8;
        }

        .toggle-password {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #1d4ed8;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
        }

        .login-btn {
            width: 100%;
            padding: 14px;
            border: none;
            border-radius: 7px;
            background: #1d4ed8;
            color: white;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s;
        }

        .login-btn:hover {
            background: #1e40af;
        }

        .login-btn:disabled {
            opacity: 0.65;
            cursor: not-allowed;
        }

        .error-message {
            background: #fef2f2;
            color: #dc2626;
            border: 1px solid #fecaca;
            padding: 12px 14px;
            border-radius: 7px;
            font-size: 13px;
            line-height: 1.5;
            margin-bottom: 20px;
        }

        .footer-text {
            text-align: center;
            margin-top: 25px;
            font-size: 12px;
            color: #94a3b8;
        }

        @media (max-width: 480px) {
            .login-card {
                padding: 25px;
            }

            h2 {
                font-size: 21px;
            }
        }
    </style>

</head>

<body>

<div class="login-card">

    <!-- LOGIN ICON -->

    <div class="login-icon">

        <svg
            width="27"
            height="27"
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
            stroke-width="1.8"
            stroke-linecap="round"
            stroke-linejoin="round"
        >
            <rect
                x="4"
                y="11"
                width="16"
                height="10"
                rx="2"
            />

            <path
                d="M8 11V7a4 4 0 0 1 8 0v4"
            />

            <path d="M12 15v2" />

        </svg>

    </div>


    <!-- HEADING -->

    <h2>Masterclass Settings</h2>

    <p class="subtitle">
        Enter your password to access the masterclass
        date management dashboard.
    </p>


    <!-- ERROR MESSAGE -->

    <?php
        $error = $this->session->flashdata('error');
    ?>

    <?php if ($error): ?>

        <div class="error-message" role="alert">

            <?= html_escape($error); ?>

        </div>

    <?php endif; ?>


    <!-- LOGIN FORM -->

    <form
        id="loginForm"
        method="POST"
        action="<?= site_url('masterclass-settings/login'); ?>"
    >

        <label for="password">
            Password
        </label>

        <div class="password-wrapper">

            <input
                type="password"
                id="password"
                name="password"
                placeholder="Enter your password"
                autocomplete="current-password"
                required
                autofocus
            >

            <button
                type="button"
                class="toggle-password"
                id="togglePassword"
                aria-label="Show password"
            >
                Show
            </button>

        </div>


        <!-- CSRF TOKEN -->

        <?php if ($this->config->item('csrf_protection')): ?>

            <input
                type="hidden"
                name="<?= html_escape($this->security->get_csrf_token_name()); ?>"
                value="<?= html_escape($this->security->get_csrf_hash()); ?>"
            >

        <?php endif; ?>


        <!-- LOGIN BUTTON -->

        <button
            type="submit"
            class="login-btn"
            id="loginBtn"
        >
            Login to Dashboard
        </button>

    </form>


    <div class="footer-text">
        The IoT Academy | Masterclass Management
    </div>

</div>


<script>

/* =========================================
   SHOW / HIDE PASSWORD
========================================= */

const passwordInput = document.getElementById("password");

const togglePassword = document.getElementById("togglePassword");

togglePassword.addEventListener("click", function () {

    const isPassword =
        passwordInput.type === "password";

    passwordInput.type =
        isPassword ? "text" : "password";

    togglePassword.textContent =
        isPassword ? "Hide" : "Show";

    togglePassword.setAttribute(
        "aria-label",
        isPassword ? "Hide password" : "Show password"
    );

});


/* =========================================
   PREVENT DOUBLE SUBMISSION
========================================= */

const loginForm = document.getElementById("loginForm");

const loginBtn = document.getElementById("loginBtn");

loginForm.addEventListener("submit", function () {

    if (!loginForm.checkValidity()) {
        return;
    }

    loginBtn.disabled = true;

    loginBtn.textContent = "Logging in...";

});

</script>

</body>
</html>
