<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>You're in — Thank You</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;600;700&family=IBM+Plex+Sans:wght@400;500&family=IBM+Plex+Mono:wght@400;500&display=swap"
        rel="stylesheet" />
    <style>
        :root {
            --blue-900: #142b6b;
            --blue-700: #1e40af;
            --blue-500: #3b63e0;
            --blue-100: #eaf0fe;
            --blue-050: #f5f8ff;
            --ink: #16213e;
            --muted: #5b6785;
            --white: #ffffff;
            --line: #d9e2f7;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html,
        body {
            height: 100%;
        }

        body {
            font-family:
                "IBM Plex Sans",
                -apple-system,
                sans-serif;
            background: var(--white);
            color: var(--ink);
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 24px;
            background-image:
                radial-gradient(circle at 15% 10%,
                    var(--blue-050) 0%,
                    transparent 45%),
                radial-gradient(circle at 90% 85%,
                    var(--blue-050) 0%,
                    transparent 40%);
        }

        .card {
            width: 100%;
            max-width: 560px;
            background: var(--white);
            border: 1px solid var(--line);
            border-radius: 18px;
            padding: 56px 48px 48px;
            box-shadow: 0 30px 60px -30px rgba(20, 43, 107, 0.18);
        }

        .waypoint {
            display: flex;
            align-items: center;
            gap: 0;
            margin-bottom: 40px;
        }

        .node {
            width: 14px;
            height: 14px;
            border-radius: 50%;
            flex-shrink: 0;
        }

        .node.filled {
            background: var(--blue-700);
            box-shadow: 0 0 0 4px var(--blue-100);
        }

        .node.pending {
            background: var(--white);
            border: 2px solid var(--blue-500);
            animation: pulse 2.2s ease-in-out infinite;
        }

        .track {
            flex: 1;
            height: 2px;
            background: var(--line);
            position: relative;
            overflow: hidden;
            margin: 0 10px;
        }

        .track::after {
            content: "";
            position: absolute;
            inset: 0;
            background: var(--blue-700);
            transform: scaleX(0);
            transform-origin: left;
            animation: draw 1.1s 0.3s cubic-bezier(0.65, 0, 0.35, 1) forwards;
        }

        @keyframes draw {
            to {
                transform: scaleX(1);
            }
        }

        @keyframes pulse {

            0%,
            100% {
                box-shadow: 0 0 0 0 rgba(59, 99, 224, 0.35);
            }

            50% {
                box-shadow: 0 0 0 6px rgba(59, 99, 224, 0);
            }
        }

        .waypoint-labels {
            display: flex;
            justify-content: space-between;
            font-family: "IBM Plex Mono", monospace;
            font-size: 11px;
            letter-spacing: 0.02em;
            color: var(--muted);
            margin-top: 10px;
            margin-bottom: 36px;
        }

        h1 {
            font-family: "Space Grotesk", sans-serif;
            font-weight: 600;
            font-size: 32px;
            line-height: 1.25;
            color: var(--blue-900);
            margin-bottom: 16px;
            max-width: 22ch;
        }

        p.body-text {
            font-size: 16px;
            line-height: 1.65;
            color: var(--muted);
            max-width: 42ch;
            margin-bottom: 28px;
        }

        p.body-text strong {
            color: var(--ink);
            font-weight: 500;
        }

        .eta {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-family: "IBM Plex Mono", monospace;
            font-size: 13px;
            color: var(--blue-700);
            background: var(--blue-050);
            border: 1px solid var(--blue-100);
            padding: 10px 16px;
            border-radius: 10px;
            margin-bottom: 36px;
        }

        .divider {
            height: 1px;
            background: var(--line);
            margin-bottom: 28px;
        }

        .footer-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 16px;
        }

        .footer-text {
            font-size: 14px;
            color: var(--muted);
        }

        .footer-text a {
            color: var(--blue-700);
            text-decoration: none;
            font-weight: 500;
        }

        .footer-text a:hover {
            text-decoration: underline;
        }

        @media (max-width: 480px) {
            .card {
                padding: 40px 26px 32px;
            }

            h1 {
                font-size: 26px;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            .track::after {
                animation: none;
                transform: scaleX(1);
            }

            .node.pending {
                animation: none;
            }
        }
    </style>
    <!-- Meta Pixel Code -->
    <script>
        ! function(f, b, e, v, n, t, s) {
            if (f.fbq) return;
            n = f.fbq = function() {
                n.callMethod ?
                    n.callMethod.apply(n, arguments) : n.queue.push(arguments)
            };
            if (!f._fbq) f._fbq = n;
            n.push = n;
            n.loaded = !0;
            n.version = '2.0';
            n.queue = [];
            t = b.createElement(e);
            t.async = !0;
            t.src = v;
            s = b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t, s)
        }(window, document, 'script',
            'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '422496948788512');
        fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none"
            src="https://www.facebook.com/tr?id=422496948788512&ev=PageView&noscript=1" /></noscript>
    <!-- End Meta Pixel Code -->
</head>

<body>
    <main class="card">
        <div class="waypoint" aria-hidden="true">
            <div class="node filled"></div>
            <div class="track"></div>
            <div class="node pending"></div>
        </div>
        <div class="waypoint-labels">
            <span>Form submitted</span>
            <span>Team reaches out</span>
        </div>

        <h1>We have received your details</h1>

        <p class="body-text">
            Thanks for sharing your details — we've got them. Our program team will
            review your submission and
            <strong>connect with you within 24 hours</strong>
            to walk through next steps.
        </p>

        <div class="eta">⏱ Expected response: within 24 hours</div>

        <div class="divider"></div>

        <div class="footer-row">
            <p class="footer-text">
                Didn't mean to sign up, or have a question in the meantime?
                <br />
                Reach us at
                <a href="mailto:info@theiotacademy.co">info@theiotacademy.co</a>
            </p>
        </div>
    </main>
</body>

</html>