<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Top Buyers - PARI ID</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        /* =========================
           BASE STYLES
           ========================= */
        body {
            font-family: 'Outfit', sans-serif;
            background: #f4f6fa;
        }
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .pb-safe { padding-bottom: env(safe-area-inset-bottom); }

        .bottom-nav {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.08);
            transition: transform .35s ease, opacity .25s ease;
        }

        .bottom-nav.hide {
            transform: translate(-50%, 120%);
            opacity: 0;
            pointer-events: none;
        }

        .nav-item { transition: transform .18s ease, background .18s ease; }
        .nav-icon {
            transition: all .18s ease;
            background: rgba(255, 255, 255, 0.9);
            color: #18181b;
            border: 1px solid rgba(229, 231, 235, 0.6);
        }
        .nav-item.active { transform: translateY(-6px); }
        .nav-item.active .nav-icon {
            background: #18181b;
            color: #ffffff;
            box-shadow: 0 10px 24px rgba(0,0,0,0.18);
            border-color: #18181b;
        }
        .nav-item:active .nav-icon { transform: scale(.96); }

        .mobile-header {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(229, 231, 235, 0.6);
        }

        html, body {
            height: 100%;
        }
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        main {
            flex: 1 0 auto;
        }
        footer {
            flex-shrink: 0;
        }

        /* ====== FIX FOOTER LAYER ======
           Footer kadang "ketutup" pseudo background yang fixed.
           Jadi footer kita naikin ke layer atas.
        */
        #footer{
            position: relative;
            z-index: 10;
        }

        /* =========================
           LEADERBOARD STYLES
           ========================= */
        :root {
            --bg-0: #ffffff;
            --bg-1: #f8fafc;
            --bg-2: #e8edff;

            --glass: rgba(255, 255, 255, 0.76);
            --glass-2: rgba(255, 255, 255, 0.62);
            --stroke: rgba(15, 23, 42, 0.08);
            --stroke-2: rgba(15, 23, 42, 0.05);
            --stroke-strong: rgba(15, 23, 42, 0.12);

            --text: #0f172a;
            --muted: #64748b;
            --muted-light: #94a3b8;

            --accent: #f97316;
            --accent-2: #7c3aed;

            --pink-primary: #ec4899;
            --pink-light: #fce7f3;

            --radius-xl: 28px;
            --radius-lg: 22px;
            --radius-md: 16px;

            --shadow: 0 20px 60px rgba(0, 0, 0, 0.08);
            --shadow-soft: 0 12px 30px rgba(0, 0, 0, 0.04);
            --shadow-card: 0 10px 40px rgba(0, 0, 0, 0.06);
            --shadow-card-inset: inset 0 1px 0 0 rgba(255, 255, 255, 0.7);

            --t: 260ms cubic-bezier(.2, .8, .2, 1);
        }

        .leaderboard-content {
            font-family: 'Poppins', sans-serif;
            color: var(--text);
            min-height: calc(100vh - 180px);
            background: transparent;
            isolation: isolate;
            position: relative;
            padding: 20px 0;

            /* ====== FIX STACKING ======
               Pastikan main ini nggak "mengalahkan" footer.
            */
            z-index: 0;
        }

        /* Background "blob" */
        .leaderboard-content::before {
            content: "";
            position: fixed;
            inset: -80px;
            z-index: -2;
            pointer-events: none;

            background:
                radial-gradient(1100px 620px at 12% -10%, rgba(236, 72, 153, 0.18), transparent 60%),
                radial-gradient(1000px 560px at 100% 0%, rgba(124, 58, 237, 0.12), transparent 62%),
                radial-gradient(980px 560px at 0% 110%, rgba(249, 115, 22, 0.10), transparent 62%),
                radial-gradient(1200px 680px at 88% 120%, rgba(236, 72, 153, 0.14), transparent 58%),
                linear-gradient(180deg, var(--bg-0) 0%, var(--bg-1) 45%, var(--bg-2) 100%);

            filter: saturate(1.02);
        }

        /* Dot pattern */
        .leaderboard-content::after {
            content: "";
            position: fixed;
            inset: 0;
            z-index: -1;
            pointer-events: none;

            background-image: radial-gradient(rgba(236, 72, 153, 0.10) 1px, transparent 0);
            background-size: 14px 14px;
            opacity: .10;
        }

        .container-leaderboard {
            max-width: 1200px;
            margin: 0 auto;
            padding: clamp(18px, 4vw, 52px);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Desktop default */
        .mobile-only { display: none; }

        /* APP BAR */
        .appbar {
            display: none;
            align-items: center;
            justify-content: center;
            gap: 12px;
            margin-bottom: 12px;
        }

        .appbar-title {
            flex: 1;
            text-align: center;
            font-size: .85rem;
            letter-spacing: .12em;
            text-transform: uppercase;
            color: var(--muted);
            font-weight: 700;
        }

        .appbar-btn { display: none !important; }

        .header {
            margin-top: 20px;
            text-align: center;
        }

        .eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            letter-spacing: .18em;
            text-transform: uppercase;
            font-size: .75rem;
            color: var(--muted);
            font-weight: 700;
        }

        .eyebrow .dot {
            width: 8px;
            height: 8px;
            border-radius: 999px;
            background: linear-gradient(135deg, var(--pink-primary), #f472b6);
            box-shadow: 0 0 0 6px rgba(236, 72, 153, 0.14);
        }

        .header h1 {
            margin-top: 14px;
            font-size: clamp(2.1rem, 4.6vw, 3.25rem);
            font-weight: 900;
            letter-spacing: -.02em;
            line-height: 1.05;
            background: linear-gradient(90deg, #0f172a 0%, #334155 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .header .meta {
            margin-top: 10px;
            font-size: 1.05rem;
            color: var(--muted);
            font-weight: 600;
        }

        .header .subtitle {
            margin: 10px auto 0;
            max-width: 720px;
            color: var(--muted);
            font-size: .98rem;
            line-height: 1.55;
        }

        .stats-container {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-top: 22px;
            justify-content: center;
        }

        .stat-chip {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 14px;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.92);
            border: 1px solid var(--stroke);
            backdrop-filter: blur(14px);
            box-shadow: var(--shadow-soft);
            font-weight: 600;
        }

        .stat-chip i { color: var(--pink-primary) }
        .stat-chip strong { font-weight: 900; color: var(--text); }
        .stat-chip span { color: var(--muted); font-size: .9rem }

        /* Top 3 */
        .top3-section {
            margin-top: 10px;
            position: relative;
            padding-bottom: 15px;
        }

        .top3-section::before {
            content: "";
            position: absolute;
            left: 50%;
            top: 42px;
            transform: translateX(-50%);
            width: min(900px, 92vw);
            height: 260px;
            background: radial-gradient(circle at 50% 80%, rgba(236, 72, 153, 0.08), transparent 70%);
            pointer-events: none;
            z-index: -1;
        }

        .section-title {
            text-align: center;
            margin-bottom: 18px;
            font-size: .85rem;
            letter-spacing: .18em;
            text-transform: uppercase;
            color: var(--muted);
            font-weight: 700;
        }

        .top3 {
            display: flex;
            align-items: flex-end;
            justify-content: center;
            gap: 32px;
            flex-wrap: wrap;
        }

        .podium-item {
            width: min(340px, 100%);
            text-align: center;
            position: relative;
            --pedestal: 168px;
            transition: var(--t);
        }

        .podium-item:hover { transform: translateY(-6px); }

        .podium-item.one { order: 2; --pedestal: 160px; }
        .podium-item.two { order: 1; --pedestal: 140px; }
        .podium-item.three { order: 3; --pedestal: 125px; }

        .podium-top {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
            margin-bottom: 14px;
        }

        .avatar-ring {
            position: relative;
            display: inline-grid;
            place-items: center;
            padding: 4px;
            border-radius: 999px;
            background:
                conic-gradient(from 180deg,
                rgba(236, 72, 153, 0.95),
                rgba(252, 231, 243, 0.95),
                rgba(236, 72, 153, 0.95)
                );
            box-shadow: 0 18px 44px rgba(236, 72, 153, 0.18);
        }

        .avatar-ring::before {
            content: "";
            position: absolute;
            inset: -18px;
            border-radius: 999px;
            background: radial-gradient(circle at center, rgba(236, 72, 153, 0.18), transparent 60%);
            opacity: .0;
            pointer-events: none;
        }

        .podium-item.one .avatar-ring::before { opacity: 1; }

        .podium-avatar {
            width: 80px;
            height: 80px;
            border-radius: 999px;
            object-fit: cover;
            background: linear-gradient(135deg, var(--pink-light), white);
            border: 2px solid rgba(255, 255, 255, 0.95);
            box-shadow: var(--shadow-card);
            display: block;
        }

        .podium-item.one .podium-avatar { width: 96px; height: 96px; }

        .place-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 6px 10px;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.9);
            border: 1px solid var(--stroke-strong);
            font-size: .75rem;
            letter-spacing: .16em;
            text-transform: uppercase;
            color: var(--muted);
            font-weight: 700;
        }

        .podium-name {
            font-size: 1.12rem;
            font-weight: 900;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 100%;
            color: var(--text);
        }

        .podium-score-mini { display: none; }

        .podium-pedestal {
            min-height: var(--pedestal);
            padding: 22px 18px 18px;
            border-radius: var(--radius-lg);
            border: 1px solid rgba(15, 23, 42, 0.10);
            backdrop-filter: blur(18px);
            box-shadow: var(--shadow-card-inset);
            filter: drop-shadow(0 10px 40px rgba(0, 0, 0, 0.06));
            background: linear-gradient(180deg, #ffffff 0%, #ffffff 70%, #f8fafc 100%);
            position: relative;
            overflow: hidden;
            clip-path: polygon(0 12%, 9% 0, 91% 0, 100% 12%, 100% 100%, 0 100%);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .podium-pedestal::before {
            content: "";
            position: absolute;
            inset: 0;
            background: radial-gradient(60% 70% at 50% 0%, rgba(255, 255, 255, 0.95), transparent 65%);
            opacity: .55;
            pointer-events: none;
        }

        .podium-pedestal > * { position: relative; z-index: 1; }

        .podium-item.one .podium-pedestal {
            background: linear-gradient(180deg, #ffffff 0%, #fff5fa 60%, #ffe4f1 100%);
            border-color: rgba(236, 72, 153, 0.24);
        }

        .pedestal-icon {
            width: 44px;
            height: 44px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid rgba(236, 72, 153, 0.15);
            background: rgba(255, 255, 255, 0.9);
            color: var(--pink-primary);
        }

        .pedestal-kicker {
            font-size: .76rem;
            letter-spacing: .16em;
            text-transform: uppercase;
            color: var(--muted);
            font-weight: 700;
        }

        .pedestal-score {
            font-size: 2.1rem;
            font-weight: 900;
            letter-spacing: -.02em;
            line-height: 1.05;
            color: var(--text);
        }

        .podium-item.one .pedestal-score {
            font-size: 2.6rem;
            color: var(--pink-primary);
        }

        .pedestal-sub {
            font-size: .86rem;
            color: var(--muted);
        }

        /* Ranking section */
        .ranking-section {
            margin-top: -30px;
            margin-bottom: 42px;
            position: relative;
            z-index: 2;
            transition: margin-top 0.3s ease;
        }

        .overlap-wrap { position: relative; }
        .top3-section { position: relative; z-index: 1; }

        .table-card {
            background: rgba(255, 255, 255, 0.86);
            border: 1px solid var(--stroke-strong);
            border-radius: var(--radius-xl);
            backdrop-filter: blur(16px);
            box-shadow:
                var(--shadow),
                inset 0 1px 0 0 rgba(255, 255, 255, 0.7),
                inset 0 -1px 0 0 rgba(0, 0, 0, 0.05);
            overflow: hidden;
            position: relative;
        }

        .table-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 18px 20px;
            border-bottom: 1px solid var(--stroke);
            background: linear-gradient(180deg, rgba(255, 255, 255, 0.95), rgba(248, 250, 252, 0.9));
        }

        .table-head h3 {
            font-size: 1.05rem;
            font-weight: 900;
            letter-spacing: .04em;
            color: var(--text);
        }

        .table-wrap { overflow: auto; padding: 0; }

        table.leader-table {
            width: 100%;
            border-collapse: collapse;
            max-width: none;
            margin: 0;
            min-width: 720px;
        }

        .leader-table thead th {
            text-align: left;
            font-size: .72rem;
            letter-spacing: .18em;
            text-transform: uppercase;
            color: var(--muted);
            padding: 14px 20px;
            font-weight: 700;
            border-bottom: 1px solid var(--stroke);
            background: rgba(248, 250, 252, 0.5);
        }

        .leader-table tbody td {
            padding: 14px 20px;
            border-top: 1px solid rgba(236, 72, 153, 0.08);
            color: var(--text);
            vertical-align: middle;
            font-weight: 600;
        }

        .leader-table tbody tr:hover { background: rgba(236, 72, 153, 0.04); }

        .cell-right { text-align: right; white-space: nowrap; }

        .unit {
            margin-left: 6px;
            font-weight: 800;
            font-size: .85rem;
            color: var(--muted-light);
        }

        .user-cell {
            display: flex;
            align-items: center;
            gap: 12px;
            min-width: 260px;
        }

        .row-avatar {
            width: 42px;
            height: 42px;
            border-radius: 999px;
            object-fit: cover;
            border: 2px solid rgba(255, 255, 255, 0.95);
            background: linear-gradient(135deg, var(--pink-light), white);
            box-shadow: 0 4px 12px rgba(236, 72, 153, 0.08);
        }

        .user-text { min-width: 0; display: flex; flex-direction: column; }

        .user-name {
            font-weight: 900;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            color: var(--text);
        }

        .leader-table tbody tr.highlight { background: rgba(236, 72, 153, 0.06); }

        .leader-table tbody tr.highlight td:first-child {
            color: var(--pink-primary);
            font-weight: 900;
        }

        .table-empty {
            padding: 26px 20px;
            text-align: center;
            color: var(--muted);
            font-weight: 600;
        }

        /* EMPTY STATE */
        .empty-state {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 26px 0 42px;
            text-align: center;
        }

        .empty-card {
            width: min(560px, 92vw);
            padding: 34px 28px 28px;
            border-radius: var(--radius-xl);
            border: 1px solid var(--stroke-strong);
            background: var(--glass);
            backdrop-filter: blur(18px);
            box-shadow: var(--shadow);
            position: relative;
            overflow: hidden;
        }

        .empty-card::before {
            content: "";
            position: absolute;
            inset: -1px;
            pointer-events: none;
            background:
                radial-gradient(520px 240px at 50% -10%, rgba(236, 72, 153, 0.16), transparent 62%),
                radial-gradient(520px 260px at 100% 110%, rgba(124, 58, 237, 0.12), transparent 62%),
                radial-gradient(520px 260px at 0% 120%, rgba(249, 115, 22, 0.08), transparent 62%);
            opacity: .95;
        }

        .empty-card > * { position: relative; z-index: 1; }

        .empty-icon {
            width: 68px;
            height: 68px;
            border-radius: 999px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(236, 72, 153, 0.14);
            color: var(--pink-primary);
            font-size: 28px;
            box-shadow: 0 14px 34px rgba(236, 72, 153, 0.18);
            margin: 0 auto;
        }

        .empty-state h3 {
            margin-top: 14px;
            font-size: 1.25rem;
            font-weight: 900;
            color: var(--text);
            letter-spacing: -0.01em;
        }

        .empty-state p {
            margin: 8px auto 0;
            max-width: 380px;
            font-size: 0.96rem;
            line-height: 1.6;
            color: var(--muted);
            font-weight: 600;
        }

        /* MOBILE list row styles */
        .leader-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 14px;
            padding: 14px 16px;
            border-top: 1px solid rgba(236, 72, 153, 0.08);
            background: transparent;
        }

        .leader-row:first-child { border-top: 0; }

        .leader-left {
            display: flex;
            align-items: center;
            gap: 12px;
            min-width: 0;
        }

        .leader-rank {
            width: 42px;
            font-weight: 800;
            color: var(--muted-light);
            font-size: .92rem;
            flex: 0 0 auto;
        }

        .leader-avatar {
            width: 44px;
            height: 44px;
            border-radius: 999px;
            object-fit: cover;
            border: 2px solid rgba(255, 255, 255, 0.95);
            box-shadow: 0 10px 24px rgba(236, 72, 153, 0.10);
            background: linear-gradient(135deg, var(--pink-light), white);
            flex: 0 0 auto;
        }

        .leader-name-mobile {
            font-weight: 900;
            color: var(--text);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 100%;
        }

        .leader-right { text-align: right; flex: 0 0 auto; }

        .leader-points {
            font-weight: 900;
            letter-spacing: -.02em;
            color: var(--pink-primary);
            white-space: nowrap;
        }

        .leader-unit-inline {
            margin-left: 6px;
            font-size: .78rem;
            font-weight: 900;
            letter-spacing: .14em;
            text-transform: uppercase;
            color: var(--muted-light);
        }

        .leader-row.is-highlight { background: rgba(236, 72, 153, 0.06); }

        /* =========================
           MOBILE FIX (CENTER HEADER)
           ========================= */
        @media (max-width: 768px) {
            .leaderboard-content::after {
                background-size: 10px 10px;
                opacity: .12;
            }

            .appbar {
                display: flex;
                justify-content: center;
            }

            .appbar-title {
                text-align: center;
            }

            .header {
                margin-top: 6px;
                text-align: center;
            }

            .eyebrow { display: none; }

            .header h1 {
                margin-top: 6px;
                -webkit-text-fill-color: unset;
                background: none;
                color: var(--text);
                font-size: 2.25rem;
                line-height: 1.05;
                text-align: center;
            }

            .header .meta {
                margin-top: 8px;
                font-size: .95rem;
                text-align: center;
            }

            .header .subtitle {
                margin-top: 8px;
                font-size: .92rem;
                text-align: center;
                margin-left: auto;
                margin-right: auto;
            }

            .stats-container { display: none; }

            .top3 {
                display: grid;
                grid-template-columns: 1fr 1.15fr 1fr;
                gap: 14px;
                align-items: end;
                justify-items: center;
                flex-wrap: unset;
            }

            .podium-item {
                width: 100%;
                max-width: 220px;
                transform: none !important;
            }

            .podium-pedestal { display: none; }

            .podium-top {
                gap: 10px;
                margin-bottom: 0;
            }

            .avatar-ring { order: 2; }

            .place-badge {
                order: 1;
                background: transparent;
                border: 0;
                padding: 0;
                font-size: .78rem;
                color: var(--muted);
                letter-spacing: .10em;
            }

            .podium-name {
                order: 3;
                font-size: .92rem;
                font-weight: 900;
                text-align: center;
                white-space: normal;
                line-height: 1.15;
                display: -webkit-box;
                -webkit-line-clamp: 2;
                -webkit-box-orient: vertical;
                overflow: hidden;
                max-width: 120px;
            }

            .podium-score-mini {
                order: 4;
                display: flex;
                flex-direction: column;
                align-items: center;
                gap: 2px;
                margin-top: 4px;
            }

            .podium-score-mini .num {
                font-weight: 900;
                font-size: 1.08rem;
                color: var(--pink-primary);
                letter-spacing: -.02em;
            }

            .podium-score-mini .label {
                font-weight: 900;
                font-size: .74rem;
                letter-spacing: .16em;
                text-transform: uppercase;
                color: var(--muted-light);
            }

            .desktop-only { display: none; }
            .mobile-only { display: block; }

            .top3-section::before {
                top: 28px;
                height: 220px;
                background: radial-gradient(circle at 50% 85%, rgba(236, 72, 153, 0.06), transparent 65%);
            }

            .leader-list.mobile-only {
                display: flex;
                flex-direction: column;
            }

            .top3-section {
                margin-top: 8px;
                padding-bottom: 5px;
            }

            .ranking-section { margin-top: 5px; }

            .table-card {
                background: transparent;
                border: 0;
                box-shadow: none;
                backdrop-filter: none;
                border-radius: 0;
            }

            .table-head { display: none; }
            .table-wrap { overflow: visible; }

            .leader-row {
                padding: 14px 0;
                margin: 0 4px;
                border-top: 1px solid rgba(236, 72, 153, 0.10);
            }

            .leader-row.is-highlight { background: transparent; }
            .leader-row.is-highlight .leader-points { color: var(--pink-primary); }

            .empty-card {
                padding: 28px 18px 24px;
            }

            .empty-icon {
                width: 62px;
                height: 62px;
                font-size: 26px;
            }
        }

        @media (max-width: 420px) {
            .container-leaderboard { padding: 16px; }
            .podium-name { max-width: 98px; }
            .leader-rank { width: 38px; }
            .top3-section {
                margin-top: 5px;
                padding-bottom: 3px;
            }

            .ranking-section { margin-top: 10px; }
        }

        @media (prefers-reduced-motion: reduce) {
            * {
                transition: none !important;
                animation: none !important;
                scroll-behavior: auto !important;
            }
        }
    </style>
</head>

<body class="bg-[#F6F8FA] min-h-screen flex flex-col text-zinc-900">
    <!-- Header Mobile -->
    <header class="md:hidden px-5 pt-6 pb-2 mobile-header sticky top-0 z-40 shadow-sm">
        <div class="flex justify-between items-center">
            <div>
                <p class="text-[10px] text-zinc-500 font-medium uppercase tracking-wide">Selamat Datang,</p>
                <h2 class="font-bold text-lg text-zinc-900 truncate max-w-[200px]">
                    {{ auth()->user()->name ?? 'Pengguna' }}
                </h2>
            </div>
            <a href="/profile"
               class="w-9 h-9 rounded-full overflow-hidden border border-zinc-200/60 bg-white/80 hover:bg-white transition flex items-center justify-center">
                <img
                    src="{{ auth()->user()->profile_photo
                        ? asset('storage/profile/' . auth()->user()->profile_photo)
                        : asset('images/default_pp.jpg') }}"
                    alt="Profile"
                    class="w-full h-full object-cover"
                >
            </a>
        </div>
    </header>

    <!-- Navbar Desktop -->
    <nav class="sticky top-0 z-50 bg-white/95 backdrop-blur-md border-b border-zinc-200/80 hidden md:block">
        <div class="container mx-auto max-w-6xl px-4 h-16 flex items-center justify-between">
            <div class="flex items-center gap-2">
                <a href="/home" class="flex items-center gap-2 hover:opacity-80 transition">
                    <img src="{{ asset('images/logo.jpg') }}" alt="PARI ID" class="hidden md:block h-8 w-auto object-contain">
                    <span class="md:hidden font-bold text-xl text-zinc-900">PARI ID X CYAA STORE </span>
                </a>
            </div>

            <div class="flex items-center gap-8">
                <a href="/home" class="text-sm font-medium text-zinc-500 hover:text-zinc-900">Home</a>
                <a href="/top-buyers" class="text-sm font-medium text-zinc-900">Top</a>
                <a href="/riwayat" class="text-sm font-medium text-zinc-500 hover:text-zinc-900">Riwayat</a>
                <a href="/redeem" class="text-sm font-medium text-zinc-500 hover:text-zinc-900">Redeem</a>
                <a href="/profile" class="text-sm font-medium text-zinc-500 hover:text-zinc-900">Akun</a>
                <a href="/information" class="text-sm font-medium text-zinc-500 hover:text-zinc-900">Info</a>
                @if(auth()->user()->role === 'admin')
                    <a href="/admin/dashboard" class="text-sm font-medium text-zinc-500 hover:text-zinc-900">Admin</a>
                @endif
            </div>

            <div class="flex items-center gap-4">
                <div class="text-right hidden lg:block">
                    <p class="text-xs text-zinc-500">Saldo Aktif</p>
                    <p class="font-bold text-sm">Rp {{ number_format(auth()->user()->saldo ?? 0, 0, ',', '.') }}</p>
                </div>
                <a href="/information"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                   class="px-4 py-2 bg-zinc-100 text-zinc-700 rounded-lg text-xs font-bold hover:bg-red-50 hover:text-red-600 transition">
                    Keluar
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                    @csrf
                </form>
            </div>
        </div>
    </nav>

    <!-- Main Content - Leaderboard -->
    <main class="leaderboard-content">
        <div class="container-leaderboard">
            <!-- Header -->
            <header class="header">
                <div class="appbar">
                    <div class="appbar-title">Leaderboard</div>
                </div>

                <div class="eyebrow"><span class="dot"></span>Leaderboard</div>
                <h1>TOP 10 </h1>
                <div class="meta">{{ $currentMonth }} {{ $currentYear }}</div>
                <p class="subtitle">Ranking Top 10 Buyer kesayangan Ayaa</p>

                <div class="stats-container">
                    <div class="stat-chip">
                        <i class="fa-solid fa-users"></i>
                        <strong>{{ $totalAllUsers }}</strong>
                        <span>Total User</span>
                    </div>

                    @if($topBuyers->count() > 0)
                    <div class="stat-chip">
                        <i class="fa-solid fa-star"></i>
                        <strong>{{ number_format($totalAllPoints) }}</strong>
                        <span>Total Poin</span>
                    </div>
                    @endif
                </div>
            </header>

            @if($topBuyers->count() > 0)
                @php
                    $topThree = $topBuyers->take(3)->values();
                    $remainingBuyers = $topBuyers->slice(3)->values();
                @endphp

                <div class="overlap-wrap">
                    <!-- Top 3 -->
                    <section class="top3-section">
                        <div class="section-title">Top 3 Buyer</div>

                        <div class="top3">
                            @foreach($topThree as $index => $point)
                                @php
                                    $rank = $index + 1;
                                    $user = $point->user;
                                    $rankClass = $rank == 1 ? 'one' : ($rank == 2 ? 'two' : 'three');
                                    $placeText = $rank == 1 ? '1st' : ($rank == 2 ? '2nd' : '3rd');

                                    $avatarUrl = $user->profile_photo
                                    ? asset('storage/profile/' . $user->profile_photo)
                                    : asset('images/default_pp.jpg');
                                @endphp

                                <div class="podium-item {{ $rankClass }}">
                                    <div class="podium-top">
                                        <div class="avatar-ring">
                                            <img
                                                src="{{ $avatarUrl }}"
                                                alt="{{ $user->name }}"
                                                class="podium-avatar"
                                                onerror="this.onerror=null; this.src='{{ asset('images/default_pp.jpg') }}'">
                                        </div>

                                        <div class="place-badge">{{ $placeText }}</div>
                                        <div class="podium-name">{{ $user->name }}</div>

                                        <div class="podium-score-mini">
                                            <div class="num">{{ number_format($point->points) }}</div>
                                            <div class="label">points</div>
                                        </div>
                                    </div>

                                    <div class="podium-pedestal">
                                        <div class="pedestal-icon"><i class="fa-solid fa-trophy"></i></div>
                                        <div class="pedestal-kicker">Poin Bulan Ini</div>
                                        <div class="pedestal-score">{{ number_format($point->points) }}</div>
                                        <div class="pedestal-sub">points</div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </section>

                    <!-- Ranking -->
                    <section class="ranking-section">
                        <div class="table-card">
                            <div class="table-head">
                                <h3>Top 100 Ranking</h3>
                            </div>

                            <div class="table-wrap">
                                @if($remainingBuyers->isEmpty())
                                    <div class="table-empty">
                                        Belum ada data ranking selain Top 3 untuk bulan ini.
                                    </div>
                                @else
                                    <!-- DESKTOP -->
                                    <table class="leader-table desktop-only">
                                        <thead>
                                            <tr>
                                                <th style="width:120px;">Rank</th>
                                                <th>Nama</th>
                                                <th style="text-align:right;">Poin</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($remainingBuyers as $index => $point)
                                                @php
                                                    $rank = $index + 4;
                                                    $user = $point->user;

                                                    $avatarUrl = $user->profile_photo
                                                    ? asset('storage/profile/' . $user->profile_photo)
                                                    : asset('images/default_pp.jpg');

                                                    $isHighlight = $rank <= 6;
                                                @endphp

                                                <tr class="{{ $isHighlight ? 'highlight' : '' }}">
                                                    <td><strong>#{{ $rank }}</strong></td>
                                                    <td>
                                                        <div class="user-cell">
                                                            <img
                                                                src="{{ $avatarUrl }}"
                                                                alt="{{ $user->name }}"
                                                                class="row-avatar"
                                                                onerror="this.onerror=null; this.src='{{ asset('images/default_pp.jpg') }}'">

                                                            <div class="user-text">
                                                                <div class="user-name">{{ $user->name }}</div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="cell-right">
                                                        {{ number_format($point->points) }}
                                                        <span class="unit">points</span>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                    <!-- MOBILE -->
                                    <div class="leader-list mobile-only">
                                        @foreach($remainingBuyers as $index => $point)
                                            @php
                                                $rank = $index + 4;
                                                $user = $point->user;

                                                $avatarUrl = $user->profile_photo
                                                ? asset('storage/profile/' . $user->profile_photo)
                                                : asset('images/default_pp.jpg');

                                                $isHighlight = $rank <= 6;
                                            @endphp

                                            <div class="leader-row {{ $isHighlight ? 'is-highlight' : '' }}">
                                                <div class="leader-left">
                                                    <div class="leader-rank">#{{ $rank }}</div>
                                                    <img
                                                        src="{{ $avatarUrl }}"
                                                        alt="{{ $user->name }}"
                                                        class="leader-avatar"
                                                        onerror="this.onerror=null; this.src='{{ asset('images/default_pp.jpg') }}'">

                                                    <div class="leader-name-mobile">{{ $user->name }}</div>
                                                </div>

                                                <div class="leader-right">
                                                    <div class="leader-points">
                                                        {{ number_format($point->points) }}
                                                        <span class="leader-unit-inline">points</span>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    </section>
                </div>

            @else
                <!-- EMPTY STATE -->
                <div class="empty-state">
                    <div class="empty-card">
                        <div class="empty-icon"><i class="fas fa-trophy"></i></div>
                        <h3>Belum Ada Data Ranking</h3>
                        <p>Belum ada pembelian pada bulan ini. Jadilah yang pertama!</p>
                    </div>
                </div>
            @endif
        </div>
    </main>

    <!-- Footer -->
    <footer id="footer" class="relative z-10 bg-zinc-900 text-zinc-400 py-12 border-t border-zinc-800">
        <div class="container mx-auto max-w-7xl px-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-10 mb-10">
                <div class="md:col-span-3">
                    <div class="flex items-center gap-3 mb-6">
                        <img src="{{ asset('images/logo1.png') }}" alt="Logo" class="h-10 w-auto rounded-xl hover:scale-105 transition">
                        <span class="font-bold text-xl tracking-tight text-white">PARI ID X CYAA STORE</span>
                    </div>
                    <p class="text-sm leading-relaxed mb-6 max-w-3xl">
                        PARI ID adalah Web platform terpercaya yang menyediakan berbagai produk digital dengan harga kompetitif.
                        Kami berkomitmen memberikan pelayanan terbaik kepada seluruh pelanggan dengan sistem yang aman,
                        transaksi cepat, dan dukungan pelanggan 24/7. Dapatkan kemudahan dalam pembelian pulsa, paket data,
                        token listrik, top up game, dan berbagai produk digital lainnya hanya dalam beberapa klik.
                    </p>

                    <div class="flex gap-4">
                        <a href="https://t.me/heyiniaya" target="_blank"
                           class="w-10 h-10 rounded-full bg-zinc-800 flex items-center justify-center hover:bg-sky-500 hover:text-white transition"
                           aria-label="Telegram">
                            <span class="iconify text-lg" data-icon="lucide:send"></span>
                        </a>
                        <a href="https://wa.me/+6283129320041?text=Halo+Admin+CYAA+STORE%2C+saya+butuh+bantuan." target="_blank"
                           class="w-10 h-10 rounded-full bg-zinc-800 flex items-center justify-center hover:bg-green-500 hover:text-white transition"
                           aria-label="WhatsApp">
                            <span class="iconify text-lg" data-icon="lucide:message-circle"></span>
                        </a>
                    </div>
                </div>

                <div class="bg-zinc-800/50 p-6 rounded-2xl border border-zinc-700">
                    <h4 class="font-bold text-white mb-6 text-lg flex items-center gap-2">
                        <span class="iconify" data-icon="lucide:shield"></span>
                        Legal & Informasi
                    </h4>
                    <ul class="space-y-4">
                        <li>
                            <a href="information" class="hover:text-white transition flex items-center gap-3 p-3 bg-zinc-900/50 rounded-xl hover:bg-zinc-800">
                                <span class="iconify text-lg" data-icon="lucide:file-text"></span>
                                <div>
                                    <p class="font-medium text-sm">Syarat & Ketentuan</p>
                                    <p class="text-xs text-zinc-500 mt-0.5">Ketentuan penggunaan layanan</p>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="/information" class="hover:text-white transition flex items-center gap-3 p-3 bg-zinc-900/50 rounded-xl hover:bg-zinc-800">
                                <span class="iconify text-lg" data-icon="lucide:shield-check"></span>
                                <div>
                                    <p class="font-medium text-sm">Kebijakan Privasi</p>
                                    <p class="text-xs text-zinc-500 mt-0.5">Data dan keamanan pengguna</p>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="/information" class="hover:text-white transition flex items-center gap-3 p-3 bg-zinc-900/50 rounded-xl hover:bg-zinc-800">
                                <span class="iconify text-lg" data-icon="lucide:help-circle"></span>
                                <div>
                                    <p class="font-medium text-sm">FAQ</p>
                                    <p class="text-xs text-zinc-500 mt-0.5">Pertanyaan umum</p>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-zinc-800 pt-8 text-center md:text-left flex flex-col md:flex-row justify-between items-center text-xs">
                <p class="mb-4 md:mb-0">&copy; 2025 PARI ID. Hak Cipta Dilindungi Undang-Undang. Seluruh konten dan layanan merupakan properti dari PARI ID.</p>
                <p class="text-zinc-500">v1.0</p>
            </div>
        </div>
    </footer>

    <!-- Bottom Navigation Mobile -->
    <nav class="fixed bottom-4 left-1/2 -translate-x-1/2 w-[calc(100%-2rem)] max-w-md rounded-3xl h-20 flex items-center justify-around z-50 md:hidden pb-safe bottom-nav">
        <a href="/home" class="nav-item flex items-center justify-center w-14 h-14 rounded-2xl relative">
            <div class="nav-icon w-12 h-12 rounded-2xl flex items-center justify-center">
                <span class="iconify text-xl" data-icon="lucide:home"></span>
            </div>
        </a>

        <a href="/riwayat" class="nav-item flex items-center justify-center w-14 h-14 rounded-2xl relative">
            <div class="nav-icon w-12 h-12 rounded-2xl flex items-center justify-center">
                <span class="iconify text-xl" data-icon="lucide:history"></span>
            </div>
        </a>

        <a href="/top-buyers" class="nav-item flex items-center justify-center w-14 h-14 rounded-2xl relative">
            <div class="nav-icon w-12 h-12 rounded-2xl flex items-center justify-center">
                <span class="iconify text-xl" data-icon="lucide:trophy"></span>
            </div>
        </a>

        @if(auth()->user()->role === 'admin')
            <a href="/admin/dashboard" class="nav-item flex items-center justify-center w-14 h-14 rounded-2xl relative">
                <div class="nav-icon w-12 h-12 rounded-2xl flex items-center justify-center">
                    <span class="iconify text-xl" data-icon="lucide:shield"></span>
                </div>
            </a>
        @else
            <a href="/bukti-garansi" class="nav-item flex items-center justify-center w-14 h-14 rounded-2xl relative">
                <div class="nav-icon w-12 h-12 rounded-2xl flex items-center justify-center">
                    <span class="iconify text-xl" data-icon="lucide:clipboard-list"></span>
                </div>
            </a>
        @endif

        <a href="/redeem" class="nav-item flex items-center justify-center w-14 h-14 rounded-2xl relative">
            <div class="nav-icon w-12 h-12 rounded-2xl flex items-center justify-center">
                <span class="iconify text-xl" data-icon="lucide:ticket-percent"></span>
            </div>
        </a>

        <a href="/information" class="nav-item flex items-center justify-center w-14 h-14 rounded-2xl relative">
            <div class="nav-icon w-12 h-12 rounded-2xl flex items-center justify-center">
                <span class="iconify text-xl" data-icon="lucide:info"></span>
            </div>
        </a>
    </nav>

    <script>
        // Script untuk navigasi bottom bar
        document.addEventListener('DOMContentLoaded', function() {
            const normalize = (p) => (p || '/').replace(/\/+$/, '') || '/';
            const currentPath = normalize(window.location.pathname);

            const items = Array.from(document.querySelectorAll('.nav-item'));
            const setActiveByHref = (href) => {
                items.forEach(i => i.classList.remove('active'));
                const el = document.querySelector(`.nav-item[href="${href}"]`);
                if (el) el.classList.add('active');
            };

            let matched = false;
            items.forEach(item => {
                const href = normalize(item.getAttribute('href'));
                if (currentPath === href) {
                    item.classList.add('active');
                    matched = true;
                }
            });

            if (!matched) {
                const map = [
                    { prefix: '/home', href: '/home' },
                    { prefix: '/bukti-garansi', href: '/bukti-garansi' },
                    { prefix: '/riwayat', href: '/riwayat' },
                    { prefix: '/top-buyers', href: '/top-buyers' },
                    { prefix: '/redeem', href: '/redeem' },
                    { prefix: '/information', href: '/information' },
                    { prefix: '/profile', href: '/profile' },
                    { prefix: '/admin', href: '/admin/dashboard' },
                ];

                for (const m of map) {
                    if (currentPath.startsWith(m.prefix)) {
                        setActiveByHref(m.href);
                        break;
                    }
                }
            }

            items.forEach(item => {
                item.addEventListener('click', () => {
                    items.forEach(i => i.classList.remove('active'));
                    item.classList.add('active');
                });
            });
        });
    </script>

    <script>
        // Script untuk hide bottom nav saat scroll ke footer
        document.addEventListener('DOMContentLoaded', () => {
            const bottomNav = document.querySelector('.bottom-nav');
            const footer = document.querySelector('#footer');

            if (!bottomNav || !footer) return;

            const observer = new IntersectionObserver(
                ([entry]) => {
                    if (entry.isIntersecting) {
                        bottomNav.classList.add('hide');
                    } else {
                        bottomNav.classList.remove('hide');
                    }
                },
                {
                    root: null,
                    threshold: 0.05
                }
            );

            observer.observe(footer);
        });
    </script>
</body>
</html>
