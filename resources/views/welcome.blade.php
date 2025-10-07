<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Welcome — Graduation Project</title>
    <style>
        :root {
            --bg: #0f1724;
            --card: #0b1220;
            --accent: #f59e0b;
            --muted: #94a3b8;
            --white: #f8fafc;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
            background: linear-gradient(180deg, #07101a 0%, #0f1724 100%);
            color: var(--white);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
        }

        .card {
            width: 100%;
            max-width: 800px;
            background: linear-gradient(180deg, rgba(255, 255, 255, 0.02), rgba(255, 255, 255, 0.01));
            border: 1px solid rgba(255, 255, 255, 0.04);
            border-radius: 14px;
            padding: 28px;
            box-shadow: 0 10px 30px rgba(2, 6, 23, 0.6);
        }

        h1 {
            margin: 0 0 12px 0;
            font-size: 1.8rem;
        }

        p.lead {
            margin: 0 0 18px 0;
            color: var(--muted);
        }

        .badge {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.02);
            padding: 10px 14px;
            border-radius: 10px;
            font-weight: 600;
            font-size: 0.95rem;
            margin-bottom: 12px;
            display: inline-block;
        }

        .small {
            font-size: 0.85rem;
            color: var(--muted);
        }

        footer {
            margin-top: 18px;
            color: var(--muted);
            font-size: 0.85rem;
        }

        @media (max-width: 520px) {
            h1 {
                font-size: 1.4rem;
            }

            .card {
                padding: 18px;
            }
        }
    </style>
</head>

<body>
    <main class="card">
        <header>
            <h1>Welcome to the Graduation Project</h1>
            <p class="lead">This is a simple landing page for the main domain. You can see the current time below.</p>
        </header>

        <section>
            <div class="badge" id="current-time">Fetching current time...</div>
            <div class="small" id="timezone">Time zone: --</div>
        </section>

        <footer>
            This is just a landing page. No automatic redirection occurs.
        </footer>
    </main>

    <script>
        // Display current local time
        function formatDateTime(d) {
            const options = {
                year: 'numeric',
                month: 'short',
                day: 'numeric',
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit',
                hour12: false
            };
            return d.toLocaleString('en-US', options);
        }

        const timeEl = document.getElementById('current-time');
        const tzEl = document.getElementById('timezone');

        function updateTime() {
            const now = new Date();
            timeEl.textContent = formatDateTime(now);
            tzEl.textContent = 'Time zone: ' + Intl.DateTimeFormat().resolvedOptions().timeZone;
        }


        updateTime();
        setInterval(updateTime, 1000); // update every second
    </script>
</body>

</html>