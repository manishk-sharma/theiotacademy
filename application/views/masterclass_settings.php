
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Masterclass Date Settings</title>

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

        .settings-card {
            width: 100%;
            max-width: 520px;
            background: #fff;
            border-radius: 14px;
            padding: 30px;
            box-shadow: 0 5px 25px rgba(0,0,0,0.07);
        }

        .settings-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            margin-bottom: 20px;
        }

        h2 {
            margin: 0;
            color: #172554;
            font-size: 23px;
        }

        .logout-form {
            margin: 0;
            flex-shrink: 0;
        }

        .logout-btn {
            width: auto;
            background: #fee2e2;
            color: #dc2626;
            padding: 10px 16px;
            border: none;
            border-radius: 7px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
        }

        .logout-btn:hover {
            background: #fecaca;
        }

        .subtitle {
            color: #64748b;
            font-size: 14px;
            line-height: 1.6;
        }

        .current-date {
            background: #eff6ff;
            padding: 18px;
            border-radius: 8px;
            margin: 22px 0;
        }

        .current-date small {
            color: #64748b;
        }

        .current-date h3 {
            margin-bottom: 0;
            color: #1d4ed8;
            font-size: 19px;
        }

        .page-info {
            margin-top: 10px;
            font-size: 12px;
            color: #64748b;
            word-break: break-all;
        }

        .page-info a {
            color: #1d4ed8;
            text-decoration: none;
        }

        label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 8px;
            color: #1e293b;
        }

        input,
        select {
            width: 100%;
            padding: 12px;
            margin-bottom: 18px;
            border: 1px solid #cbd5e1;
            border-radius: 7px;
            font-size: 15px;
            background: #fff;
        }

        input:focus,
        select:focus {
            outline: none;
            border-color: #1d4ed8;
        }

        .save-btn {
            width: 100%;
            background: #1d4ed8;
            color: #fff;
            border: none;
            padding: 14px;
            border-radius: 7px;
            font-weight: 600;
            font-size: 15px;
            cursor: pointer;
        }

        .save-btn:hover {
            background: #1e40af;
        }

        button:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }

        #message {
            margin-top: 15px;
            font-size: 14px;
            line-height: 1.5;
        }

        .info-box {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 14px;
            margin-top: 20px;
            font-size: 13px;
            line-height: 1.7;
            color: #475569;
        }

        @media(max-width: 576px) {
            .settings-card {
                padding: 22px;
            }

            h2 {
                font-size: 19px;
            }

            .logout-btn {
                padding: 9px 12px;
            }
        }
    </style>

</head>

<body>

<div class="settings-card">

    <!-- HEADER WITH LOGOUT -->

    <div class="settings-header">

        <h2>Masterclass Date Settings</h2>

        <form
            class="logout-form"
            action="<?= site_url('masterclass-settings/logout'); ?>"
            method="POST"
        >

            <?php if ($this->config->item('csrf_protection')): ?>

                <input
                    type="hidden"
                    name="<?= html_escape($this->security->get_csrf_token_name()); ?>"
                    value="<?= html_escape($this->security->get_csrf_hash()); ?>"
                >

            <?php endif; ?>

            <button type="submit" class="logout-btn">
                Logout
            </button>

        </form>

    </div>


    <p class="subtitle">
        Select a masterclass page and update its date and time.
        Changes will apply to the selected landing page
        and future registrations.
    </p>


    <!-- SETTINGS FORM -->

    <form id="settingsForm">

        <!-- SELECT LANDING PAGE -->

        <label for="pageSlug">
            Select Masterclass Page
        </label>

        <select
            id="pageSlug"
            name="page_slug"
            required
        >

            <option value="da-genai-masterclass">
                DA GenAI Masterclass
            </option>

            <option value="data-analytics-gen-ai-masterclass">
                Data Analytics Gen AI Masterclass
            </option>

        </select>


        <!-- CURRENT DATE -->

        <div class="current-date">

            <small>
                Current Masterclass Schedule
            </small>

            <h3 id="currentDate">
                Loading...
            </h3>

            <div class="page-info">

                <a
                    href="#"
                    id="pageLink"
                    target="_blank"
                    rel="noopener noreferrer"
                >
                    View Landing Page
                </a>

            </div>

        </div>


        <!-- NEW DATE -->

        <label for="masterclassDate">
            Select New Date
        </label>

        <input
            type="date"
            id="masterclassDate"
            name="date"
            required
        >


        <!-- NEW TIME -->

        <label for="masterclassTime">
            Select Time (IST)
        </label>

        <input
            type="time"
            id="masterclassTime"
            name="time"
            required
        >

        <!-- WHATSAPP LINK -->

<label for="whatsappLink">
    WhatsApp Group Link
</label>

<input
    type="url"
    id="whatsappLink"
    name="whatsapp_link"
    placeholder="https://chat.whatsapp.com/..."
    required
>


        <!-- CSRF TOKEN -->

        <?php if ($this->config->item('csrf_protection')): ?>

            <input
                type="hidden"
                name="<?= html_escape($this->security->get_csrf_token_name()); ?>"
                value="<?= html_escape($this->security->get_csrf_hash()); ?>"
            >

        <?php endif; ?>


        <!-- SAVE BUTTON -->

        <button
            type="submit"
            id="saveBtn"
            class="save-btn"
        >
            Save Changes
        </button>

    </form>


    <!-- RESPONSE MESSAGE -->

    <div id="message" role="status"></div>


    <!-- INFORMATION -->

    <div class="info-box">

        <strong>Note:</strong>

        <br>

        Changing the date will update the selected masterclass
        page and its future registrations.

        <br>

        Existing registration history will remain unchanged.

    </div>

</div>


<script>

const API_BASE = window.location.origin;

const form = document.getElementById("settingsForm");

const pageSelect = document.getElementById("pageSlug");

const currentDate = document.getElementById("currentDate");

const dateInput = document.getElementById("masterclassDate");

const timeInput = document.getElementById("masterclassTime");
const whatsappInput = document.getElementById("whatsappLink");

const saveBtn = document.getElementById("saveBtn");

const message = document.getElementById("message");

const pageLink = document.getElementById("pageLink");

let isLoading = false;

let requestId = 0;


/* =========================================
   FETCH SELECTED PAGE DATE
========================================= */

async function loadMasterclassDate() {

    const pageSlug = pageSelect.value;

    const thisRequest = ++requestId;

    message.textContent = "";

    currentDate.textContent = "Loading...";

    dateInput.value = "";

    timeInput.value = "";

    saveBtn.disabled = true;

    isLoading = true;

    try {

        const response = await fetch(
            API_BASE +
            "/api/masterclass/date?page_slug=" +
            encodeURIComponent(pageSlug),
            {
                cache: "no-store",
                credentials: "same-origin"
            }
        );

        const data = await response.json();

        if (!response.ok || !data.success) {

            throw new Error(
                data.message || "Unable to load masterclass date"
            );

        }

        // Ignore outdated requests

        if (
            thisRequest !== requestId ||
            pageSelect.value !== pageSlug
        ) {
            return;
        }

        currentDate.textContent = data.formatted_date;

        pageLink.href = data.page_url || (
            API_BASE + "/" + pageSlug
        );
        
whatsappInput.value = data.whatsapp_link || "";
        // Convert API date to IST

        const date = new Date(data.date_time);

        if (Number.isNaN(date.getTime())) {
            throw new Error("Invalid date received from API");
        }

        const parts = new Intl.DateTimeFormat("en-GB", {

            timeZone: "Asia/Kolkata",

            year: "numeric",

            month: "2-digit",

            day: "2-digit",

            hour: "2-digit",

            minute: "2-digit",

            hourCycle: "h23"

        }).formatToParts(date);

        const values = {};

        parts.forEach(part => {
            values[part.type] = part.value;
        });

        dateInput.value =
            `${values.year}-${values.month}-${values.day}`;

        timeInput.value =
            `${values.hour}:${values.minute}`;

    } catch (error) {

        if (
            thisRequest === requestId &&
            pageSelect.value === pageSlug
        ) {

            currentDate.textContent = "Unable to load date";

            message.style.color = "red";

            message.textContent = error.message;

        }

    } finally {

        if (thisRequest === requestId) {

            isLoading = false;

            saveBtn.disabled = false;

        }

    }

}


/* =========================================
   CHANGE PAGE DROPDOWN
========================================= */

pageSelect.addEventListener("change", function() {

    loadMasterclassDate();

});


/* =========================================
   SAVE MASTERCLASS DATE
========================================= */

form.addEventListener("submit", async function(e) {

    e.preventDefault();

    if (isLoading) return;

    const pageSlug = pageSelect.value;

    const selectedDate = dateInput.value;

    const selectedTime = timeInput.value;
const whatsappLink = whatsappInput.value.trim();

if (!pageSlug || !selectedDate || !selectedTime || !whatsappLink) {
    message.style.color = "red";
    message.textContent =
        "Please select a page, date, time and WhatsApp link.";
    return;
}

    saveBtn.disabled = true;

    pageSelect.disabled = true;

    saveBtn.textContent = "Saving...";

    message.textContent = "";

    try {

        const formData = new FormData(form);

formData.set("page_slug", pageSlug);
formData.set("date", selectedDate);
formData.set("time", selectedTime);
formData.set("whatsapp_link", whatsappLink);

        const response = await fetch(
            API_BASE + "/api/masterclass/update-date",
            {
                method: "POST",
                body: formData,
                credentials: "same-origin",
                cache: "no-store"
            }
        );

        const data = await response.json();

        if (!response.ok || !data.success) {

            throw new Error(
                data.message || "Unable to update date"
            );

        }

        currentDate.textContent = data.formatted_date;

        message.style.color = "green";

        message.textContent =
            "Masterclass date updated successfully!";

        // Update CSRF token when returned by backend

        if (data.csrf_hash && data.csrf_token_name) {

            document.querySelectorAll(
                'input[name="' + data.csrf_token_name + '"]'
            ).forEach(input => {

                input.value = data.csrf_hash;

            });

        } else {

            // Refresh page for rotated CSRF token
            setTimeout(() => window.location.reload(), 1000);

        }

    } catch (error) {

        message.style.color = "red";

        message.textContent = error.message;

    } finally {

        saveBtn.disabled = false;

        pageSelect.disabled = false;

        saveBtn.textContent = "Save Changes";

    }

});


/* =========================================
   INITIAL LOAD
========================================= */

loadMasterclassDate();

</script>

</body>
</html>
