<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex">
    <title>We'll Be Back Soon!</title>
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon_io/favicon-32x32.png') }}">
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon_io/favicon.svg') }}">
    <link rel="apple-touch-icon" href="{{ asset('favicon_io/apple-touch-icon.png') }}">
    <style>
        :root {
            color-scheme: light;
            --navy: #2e2e80;
            --green: #4caf50;
            --ink: #1a2440;
            --muted: #667085;
            --line: rgba(46, 46, 128, 0.12);
        }

        * {
            box-sizing: border-box;
        }

        html,
        body {
            margin: 0;
            min-height: 100%;
        }

        body {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: clamp(1.25rem, 4vw, 2.75rem);
            background:
                radial-gradient(circle at top left, rgba(79, 170, 245, 0.16), transparent 32%),
                radial-gradient(circle at bottom right, rgba(76, 175, 80, 0.14), transparent 28%),
                linear-gradient(180deg, #f6f8fc 0%, #eef3f8 100%);
            color: var(--ink);
            font-family: Graphik, "Graphik Web", "Helvetica Neue", "Segoe UI", ui-sans-serif, system-ui, sans-serif;
        }

        .panel {
            width: min(920px, 100%);
            overflow: hidden;
            background: #fff;
            border: 1px solid var(--line);
            border-radius: 1.5rem;
            box-shadow: 0 24px 60px rgba(24, 36, 74, 0.12);
        }

        .accent {
            height: 5px;
            background: linear-gradient(90deg, var(--navy) 0 48%, var(--green) 52% 100%);
        }

        .copy {
            padding: clamp(2.5rem, 7vw, 4.5rem) clamp(1.25rem, 5vw, 3.5rem) clamp(1.5rem, 4vw, 2.5rem);
            text-align: center;
        }

        .logo {
            display: block;
            width: auto;
            height: 46px;
            margin: 0 auto 1.75rem;
        }

        .status {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            margin: 0 0 1.15rem;
            padding: 0.4rem 0.8rem;
            border-radius: 999px;
            background: rgba(46, 46, 128, 0.06);
            color: var(--navy);
            font-size: 0.75rem;
            font-weight: 700;
            letter-spacing: 0.08em;
            line-height: 1;
            text-transform: uppercase;
        }

        .status::before {
            content: "";
            width: 0.5rem;
            height: 0.5rem;
            border-radius: 50%;
            background: var(--green);
        }

        h1 {
            margin: 0;
            color: var(--ink);
            font-size: clamp(1.85rem, 4vw, 2.55rem);
            font-weight: 700;
            letter-spacing: -0.03em;
            line-height: 1.2;
            text-wrap: balance;
        }

        .message {
            max-width: 36rem;
            margin: 1rem auto 0;
            color: var(--muted);
            font-size: clamp(1rem, 2vw, 1.05rem);
            line-height: 1.7;
            text-wrap: balance;
        }

        .plugs {
            padding: 0.5rem 0 clamp(2.5rem, 6vw, 3.5rem);
            background: #fff;
        }

        svg {
            display: block;
            width: 100%;
            height: auto;
        }
    </style>
</head>
<body>
    <main class="panel">
        <div class="accent" aria-hidden="true"></div>
        <div class="copy">
            <img class="logo" src="{{ asset('uploads/web-img/ibn-logo.webp') }}" alt="IBN Technologies" width="512" height="182">
            <p class="status">Scheduled maintenance</p>
            <h1>We'll Be Back Soon!</h1>
            <p class="message">We're performing scheduled maintenance to improve your experience. We apologize for the inconvenience and will be back shortly.</p>
        </div>
        <div class="plugs">
            <svg viewBox="0 0 1200 220" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false">
                <rect x="0" y="100" width="452" height="20" fill="#2e2e80"/>
                <rect x="748" y="100" width="452" height="20" fill="#4caf50"/>
                <rect x="430" y="56" width="108" height="108" rx="16" fill="#2e2e80"/>
                <rect x="662" y="56" width="108" height="108" rx="16" fill="#4caf50"/>
                <rect x="448" y="88" width="74" height="16" rx="4" fill="#6a6ac4"/>
                <rect x="448" y="116" width="74" height="16" rx="4" fill="#9a9ae0"/>
                <rect x="678" y="88" width="74" height="16" rx="4" fill="#81c784"/>
                <rect x="678" y="116" width="74" height="16" rx="4" fill="#b7e1b9"/>
                <rect x="522" y="88" width="46" height="16" rx="8" fill="#2e2e80"/>
                <rect x="522" y="116" width="46" height="16" rx="8" fill="#2e2e80"/>
                <rect x="632" y="88" width="46" height="16" rx="8" fill="#4caf50"/>
                <rect x="632" y="116" width="46" height="16" rx="8" fill="#4caf50"/>
            </svg>
        </div>
    </main>
</body>
</html>
