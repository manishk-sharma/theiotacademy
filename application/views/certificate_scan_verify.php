<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate Verification | The IoT Academy</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <style>
        body { background: #f4f6f9; font-family: 'Segoe UI', sans-serif; }
        .verify-wrapper {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .verify-card {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 4px 24px rgba(0,0,0,0.10);
            padding: 40px 36px;
            max-width: 480px;
            width: 100%;
            text-align: center;
        }
        .verify-card img.logo {
            height: 52px;
            margin-bottom: 20px;
        }
        .badge-success-custom {
            background: #e6f9f0;
            color: #1a8a4a;
            border-radius: 20px;
            padding: 6px 18px;
            font-size: 14px;
            font-weight: 600;
            display: inline-block;
            margin-bottom: 18px;
        }
        .detail-row {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #f0f0f0;
            text-align: left;
            font-size: 15px;
        }
        .detail-row:last-child { border-bottom: none; }
        .detail-label { color: #888; font-weight: 500; min-width: 140px; }
        .detail-value { color: #222; font-weight: 600; }
        .btn-view-detail {
            margin-top: 24px;
            background: #0d6efd;
            color: #fff;
            border-radius: 24px;
            padding: 10px 32px;
            font-size: 15px;
            font-weight: 600;
            text-decoration: none;
            display: inline-block;
            transition: background 0.2s;
        }
        .btn-view-detail:hover { background: #0b5ed7; color: #fff; }
        .not-found { color: #dc3545; font-size: 18px; margin-top: 10px; }
        #loading { color: #555; font-size: 16px; margin-top: 10px; }
    </style>
</head>
<body>
<div class="verify-wrapper">
    <div class="verify-card">
        <img src="<?= base_url('assets/images/the-iot-logo-new.webp') ?>" alt="The IoT Academy" class="logo" />
        <div id="loading">Verifying certificate...</div>
        <div id="cert-details" style="display:none;">
            <div class="badge-success-custom">&#10003; Verification Successful</div>
            <div id="details-body"></div>
            <a href="https://www.theiotacademy.co/verify-certificate" target="_blank" class="btn-view-detail">View Detail</a>
        </div>
        <div id="cert-error" style="display:none;">
            <p class="not-found">&#10007; Certificate not found.</p>
            <a href="https://www.theiotacademy.co/verify-certificate" target="_blank" class="btn-view-detail mt-3">Visit IoT Academy</a>
        </div>
    </div>
</div>

<script>
    const token = "<?= htmlspecialchars($token) ?>";
    const apiUrl = "<?= base_url('certificate-token-data') ?>";

    fetch(apiUrl + "?token=" + encodeURIComponent(token))
        .then(r => r.json())
        .then(data => {
            document.getElementById('loading').style.display = 'none';
            if (data.status === 'success') {
                const rows = [
                    ['Name',            data.name],
                    ['Certificate ID',  data.certification_id],
                    ['Course / Domain', data.domain_name],
                    ['Issue Date',      data.issue_date],
                    ['Course Duration', data.course_start_date + ' — ' + data.course_end_date],
                ];
                let html = '';
                rows.forEach(([label, value]) => {
                    html += `<div class="detail-row">
                        <span class="detail-label">${label}</span>
                        <span class="detail-value">${value || '—'}</span>
                    </div>`;
                });
                document.getElementById('details-body').innerHTML = html;
                document.getElementById('cert-details').style.display = 'block';
            } else {
                document.getElementById('cert-error').style.display = 'block';
            }
        })
        .catch(() => {
            document.getElementById('loading').style.display = 'none';
            document.getElementById('cert-error').style.display = 'block';
        });
</script>
</body>
</html>