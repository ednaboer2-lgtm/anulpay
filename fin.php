<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation – Espace Client Sécurisé</title>
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
            --warning:       #d97706;
            --warning-light: #fffbeb;
            --radius:        12px;
            --shadow:        0 4px 24px rgba(26,86,219,.10);
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #f1f5f9;
            min-height: 100vh;
            flex-direction: column;
        }

        /* ─── TOPBAR ─── */
        .topbar {
            background: #fff;
            border-bottom: 1px solid #e2e8f0;
            padding: 0 24px;
            height: 64px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 100;
        }
        .topbar img { height: 36px; object-fit: contain; }
        .topbar-secure {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 13px;
            font-weight: 600;
            color: var(--success);
        }
        .topbar-secure i { font-size: 14px; }

        /* ─── STEPS BAR ─── */
        .steps-bar {
            background: #fff;
            border-bottom: 1px solid #e2e8f0;
            padding: 0 24px;
        }
        .steps-inner {
            max-width: 480px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            height: 56px;
        }
        .step {
            display: flex;
            align-items: center;
            gap: 8px;
            flex: 1;
        }
        .step-circle {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: 700;
            flex-shrink: 0;
        }
        .step.done .step-circle { background: var(--primary); color: #fff; }
        .step-label { font-size: 12px; font-weight: 600; white-space: nowrap; }
        .step.done .step-label { color: var(--primary); }
        .step-line { flex: 1; height: 2px; background: var(--primary); margin: 0 6px; }

        /* ─── MAIN CONTENT ─── */
        .page-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 32px 16px 40px;
        }

        /* ─── CARD ─── */
        .card {
            background: #fff;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            width: 100%;
            max-width: 480px;
            overflow: hidden;
        }
        .card-header {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            padding: 28px 28px 24px;
            text-align: center;
            color: #fff;
        }
        .card-header .icon-wrap {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: rgba(255,255,255,.18);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 14px;
        }
        .card-header .icon-wrap i { font-size: 26px; }
        .card-header h2 { font-size: 20px; font-weight: 700; margin-bottom: 6px; }
        .card-header p  { font-size: 13px; opacity: .85; line-height: 1.5; }

        /* ─── CARD BODY ─── */
        .card-body { padding: 28px; }

        /* ─── STATUS BADGE ─── */
        .status-badge {
            display: flex;
            align-items: center;
            gap: 10px;
            background: var(--warning-light);
            border: 1px solid #fde68a;
            border-radius: 8px;
            padding: 12px 16px;
            margin-bottom: 24px;
        }
        .pulse-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: var(--warning);
            flex-shrink: 0;
            animation: pulse 1.6s ease-in-out infinite;
        }
        @keyframes pulse {
            0%, 100% { transform: scale(1); opacity: 1; }
            50%       { transform: scale(1.5); opacity: .6; }
        }
        .status-badge-text { font-size: 13px; font-weight: 600; color: #92400e; }
        .status-badge-sub  { font-size: 12px; color: #b45309; margin-top: 1px; }

        /* ─── INFO ROWS ─── */
        .info-list { display: flex; flex-direction: column; gap: 12px; margin-bottom: 24px; }
        .info-row {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 14px;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
        }
        .info-icon {
            width: 36px;
            height: 36px;
            border-radius: 8px;
            background: var(--primary-light);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }
        .info-icon i { color: var(--primary); font-size: 15px; }
        .info-row-label { font-size: 11px; color: #64748b; font-weight: 500; text-transform: uppercase; letter-spacing: .04em; }
        .info-row-value { font-size: 14px; font-weight: 600; color: #1e293b; margin-top: 2px; }

        /* ─── INSTRUCTION BOX ─── */
        .instruction-box {
            background: var(--primary-light);
            border: 1px solid #bfdbfe;
            border-radius: 8px;
            padding: 16px;
            display: flex;
            gap: 12px;
            align-items: flex-start;
        }
        .instruction-box i { color: var(--primary); font-size: 16px; margin-top: 2px; flex-shrink: 0; }
        .instruction-box p { font-size: 13px; color: #1e40af; line-height: 1.6; font-weight: 500; }

        /* ─── WAITING ANIMATION ─── */
        .waiting-anim {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            margin: 24px 0 0;
        }
        .waiting-anim span {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: var(--primary);
            animation: bounce 1.2s ease-in-out infinite;
        }
        .waiting-anim span:nth-child(2) { animation-delay: .2s; }
        .waiting-anim span:nth-child(3) { animation-delay: .4s; }
        @keyframes bounce {
            0%, 80%, 100% { transform: scale(0.7); opacity: .5; }
            40%            { transform: scale(1.1); opacity: 1; }
        }
        .waiting-label { text-align: center; font-size: 12px; color: #64748b; margin-top: 8px; font-weight: 500; }

        /* ─── FOOTER ─── */
        footer { margin-top: 24px; text-align: center; }
        footer img { width: 100%; max-width: 480px; height: auto; border-radius: 10px; display: block; margin: 0 auto; }

        @media (max-width: 520px) {
            .step-label { display: none; }
            .card-header { padding: 22px 20px 18px; }
            .card-body { padding: 20px; }
        }
    </style>
</head>
<body>

    <!-- TOPBAR -->
    <div class="topbar">
        <img src="./kwKYGMMnx5T0LeAGdXfi61a9Lkk.avif" alt="Logo">
        <div class="topbar-secure">
            <i class="fa-solid fa-shield-halved"></i>
            Connexion sécurisée
        </div>
    </div>

    <!-- STEPS BAR -->
    <div class="steps-bar">
        <div class="steps-inner">
            <div class="step done">
                <div class="step-circle"><i class="fa-solid fa-check" style="font-size:11px;"></i></div>
                <span class="step-label">Identité</span>
            </div>
            <div class="step-line"></div>
            <div class="step done">
                <div class="step-circle"><i class="fa-solid fa-check" style="font-size:11px;"></i></div>
                <span class="step-label">Carte bancaire</span>
            </div>
            <div class="step-line"></div>
            <div class="step done">
                <div class="step-circle"><i class="fa-solid fa-check" style="font-size:11px;"></i></div>
                <span class="step-label">Confirmation</span>
            </div>
        </div>
    </div>

    <!-- MAIN CONTENT -->
    <div class="page-content">
        <div class="card">

            <div class="card-header">
                <div class="icon-wrap">
                    <i class="fa-solid fa-headset"></i>
                </div>
                <h2>Demande enregistrée</h2>
                <p>Votre demande d'annulation a bien été prise en compte</p>
            </div>

            <div class="card-body">

                <div class="status-badge">
                    <div class="pulse-dot"></div>
                    <div>
                        <div class="status-badge-text">En attente d'un conseiller</div>
                        <div class="status-badge-sub">Un agent va vous contacter dans quelques instants</div>
                    </div>
                </div>

                <div class="info-list">
                    <div class="info-row">
                        <div class="info-icon"><i class="fa-solid fa-circle-check"></i></div>
                        <div>
                            <div class="info-row-label">Statut de la demande</div>
                            <div class="info-row-value">Annulation en cours de traitement</div>
                        </div>
                    </div>
                    <div class="info-row">
                        <div class="info-icon"><i class="fa-solid fa-clock-rotate-left"></i></div>
                        <div>
                            <div class="info-row-label">Délai de traitement estimé</div>
                            <div class="info-row-value">2 à 5 minutes</div>
                        </div>
                    </div>
                    <div class="info-row">
                        <div class="info-icon"><i class="fa-solid fa-phone-volume"></i></div>
                        <div>
                            <div class="info-row-label">Assistance disponible</div>
                            <div class="info-row-value">Service client 7j/7 – 24h/24</div>
                        </div>
                    </div>
                </div>

                <div class="instruction-box">
                    <i class="fa-solid fa-circle-info"></i>
                    <p>Merci de rester en ligne avec l'agent du service clientèle afin de finaliser votre demande d'annulation de la transaction en cours.</p>
                </div>

                <div class="waiting-anim">
                    <span></span><span></span><span></span>
                </div>
                <div class="waiting-label">Mise en relation avec un conseiller…</div>

            </div>
        </div>

        <footer>
            <img src="./T6EWjPeJbYpmdVRDMjkT58dKk.avif" alt="Organismes de sécurité bancaire">
        </footer>
    </div>

</body>
</html>
