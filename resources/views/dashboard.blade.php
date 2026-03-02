<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CoLoc — Tableau de bord</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Syne:wght@400;500;600;700;800&family=DM+Sans:wght@300;400;500&display=swap"
        rel="stylesheet">
    <style>
        :root {
            --sage: #8BAF8B;
            --sage-light: #C4D9C4;
            --sage-dark: #4A7A4A;
            --cream: #F5F0E8;
            --warm-white: #FAFAF7;
            --charcoal: #1C1C1E;
            --charcoal-light: #2C2C2E;
            --muted: #6B7280;
            --accent: #E8845A;
            --red: #D65050;
            --gold: #C9A84C;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0
        }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--warm-white);
            color: var(--charcoal);
            min-height: 100vh
        }

        .sidebar {
            background: var(--charcoal);
            width: 260px;
            min-height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            display: flex;
            flex-direction: column;
            z-index: 50
        }

        .sidebar-logo {
            padding: 28px 28px 0;
            font-family: 'Syne', sans-serif;
            font-weight: 800;
            font-size: 1.5rem;
            color: var(--cream);
            letter-spacing: -0.03em
        }

        .sidebar-logo span {
            color: var(--sage)
        }

        .sidebar-nav {
            padding: 32px 16px;
            flex: 1
        }

        .nav-section {
            margin-bottom: 24px
        }

        .nav-label {
            font-size: 0.65rem;
            font-weight: 600;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: #555;
            padding: 0 12px;
            margin-bottom: 6px;
            display: block
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 12px;
            border-radius: 10px;
            color: #9CA3AF;
            font-size: 0.875rem;
            cursor: pointer;
            transition: all 0.15s;
            margin-bottom: 2px;
            text-decoration: none
        }

        .nav-item:hover {
            background: rgba(255, 255, 255, 0.06);
            color: #E5E7EB
        }

        .nav-item.active {
            background: var(--sage-dark);
            color: #fff
        }

        .nav-item svg {
            width: 18px;
            height: 18px;
            opacity: 0.8;
            flex-shrink: 0
        }

        .nav-item.active svg {
            opacity: 1
        }

        .nav-badge {
            margin-left: auto;
            background: var(--accent);
            color: white;
            font-size: 0.65rem;
            font-weight: 700;
            padding: 2px 6px;
            border-radius: 20px;
            min-width: 18px;
            text-align: center
        }

        .sidebar-footer {
            padding: 16px;
            border-top: 1px solid rgba(255, 255, 255, 0.06)
        }

        .user-card {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 12px;
            border-radius: 10px;
            cursor: pointer;
            transition: background 0.15s
        }

        .user-card:hover {
            background: rgba(255, 255, 255, 0.06)
        }

        .avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Syne', sans-serif;
            font-weight: 700;
            font-size: 0.8rem;
            flex-shrink: 0
        }

        .avatar-sage {
            background: var(--sage-dark);
            color: white
        }

        .main {
            margin-left: 260px;
            min-height: 100vh
        }

        .topbar {
            background: white;
            border-bottom: 1px solid #F0EDE8;
            padding: 0 32px;
            height: 64px;
            display: flex;
            align-items: center;
            gap: 16px;
            position: sticky;
            top: 0;
            z-index: 40
        }

        .topbar-title {
            font-family: 'Syne', sans-serif;
            font-weight: 700;
            font-size: 1.1rem;
            color: var(--charcoal);
            flex: 1
        }

        .topbar-actions {
            display: flex;
            align-items: center;
            gap: 10px
        }

        .page {
            padding: 32px
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 9px 18px;
            border-radius: 10px;
            font-size: 0.8rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.15s;
            border: none;
            font-family: 'DM Sans', sans-serif;
            white-space: nowrap
        }

        .btn-sage {
            background: var(--sage-dark);
            color: white
        }

        .btn-sage:hover {
            background: #3A6A3A;
            transform: translateY(-1px)
        }

        .btn-ghost {
            background: transparent;
            color: var(--muted);
            border: 1px solid #E5E7EB
        }

        .btn-ghost:hover {
            background: #F9FAFB;
            color: var(--charcoal)
        }

        .btn-sm {
            padding: 6px 12px;
            font-size: 0.75rem;
            border-radius: 8px
        }

        .card {
            background: white;
            border-radius: 16px;
            border: 1px solid #F0EDE8;
            overflow: hidden
        }

        .card-header {
            padding: 20px 24px;
            border-bottom: 1px solid #F5F0E8;
            display: flex;
            align-items: center;
            justify-content: space-between
        }

        .card-title {
            font-family: 'Syne', sans-serif;
            font-weight: 700;
            font-size: 1rem;
            color: var(--charcoal)
        }

        .stat-card {
            background: white;
            border-radius: 16px;
            border: 1px solid #F0EDE8;
            padding: 24px;
            position: relative;
            overflow: hidden
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 80px;
            height: 80px;
            border-radius: 0 0 0 80px;
            opacity: 0.08
        }

        .stat-card.green::before {
            background: var(--sage-dark)
        }

        .stat-card.orange::before {
            background: var(--accent)
        }

        .stat-card.gold::before {
            background: var(--gold)
        }

        .stat-card.red::before {
            background: var(--red)
        }

        .stat-label {
            font-size: 0.75rem;
            font-weight: 500;
            color: var(--muted);
            text-transform: uppercase;
            letter-spacing: 0.06em;
            margin-bottom: 8px
        }

        .stat-value {
            font-family: 'Syne', sans-serif;
            font-weight: 800;
            font-size: 2rem;
            color: var(--charcoal);
            line-height: 1;
            margin-bottom: 4px
        }

        .stat-sub {
            font-size: 0.75rem;
            color: var(--muted)
        }

        .stat-icon {
            position: absolute;
            top: 20px;
            right: 20px;
            width: 36px;
            height: 36px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem
        }

        .stat-icon.green {
            background: #DCFCE7
        }

        .stat-icon.orange {
            background: #FEF3C7
        }

        .stat-icon.gold {
            background: #FEF9C3
        }

        .stat-icon.red {
            background: #FEF2F2
        }

        .expense-row {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 14px 24px;
            border-bottom: 1px solid #F5F0E8;
            transition: background 0.1s
        }

        .expense-row:hover {
            background: #FAFAF7
        }

        .expense-row:last-child {
            border-bottom: none
        }

        .expense-cat {
            width: 40px;
            height: 40px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            flex-shrink: 0
        }

        .expense-details {
            flex: 1
        }

        .expense-title {
            font-weight: 500;
            font-size: 0.875rem
        }

        .expense-meta {
            font-size: 0.75rem;
            color: var(--muted)
        }

        .expense-amount {
            font-family: 'Syne', sans-serif;
            font-weight: 700;
            font-size: 1rem;
            color: var(--charcoal);
            text-align: right
        }

        .expense-share {
            font-size: 0.7rem;
            color: var(--muted);
            text-align: right
        }

        .chart-row {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 12px
        }

        .chart-label {
            font-size: 0.75rem;
            color: var(--muted);
            width: 80px;
            text-align: right;
            flex-shrink: 0
        }

        .chart-bar {
            flex: 1;
            height: 28px;
            background: #F5F0E8;
            border-radius: 8px;
            overflow: hidden
        }

        .chart-fill {
            height: 100%;
            border-radius: 8px;
            display: flex;
            align-items: center;
            padding-left: 10px;
            font-size: 0.7rem;
            font-weight: 600;
            color: white
        }

        .modal-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(4px);
            z-index: 100;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.2s
        }

        .modal-overlay.open {
            opacity: 1;
            pointer-events: all
        }

        .modal {
            background: white;
            border-radius: 20px;
            width: 100%;
            max-width: 480px;
            max-height: 90vh;
            overflow-y: auto;
            transform: translateY(20px);
            transition: transform 0.2s;
            box-shadow: 0 25px 60px rgba(0, 0, 0, 0.2)
        }

        .modal-overlay.open .modal {
            transform: translateY(0)
        }

        .modal-header {
            padding: 24px 28px 20px;
            border-bottom: 1px solid #F0EDE8;
            display: flex;
            align-items: center;
            justify-content: space-between
        }

        .modal-title {
            font-family: 'Syne', sans-serif;
            font-weight: 700;
            font-size: 1.1rem
        }

        .modal-body {
            padding: 24px 28px
        }

        .modal-footer {
            padding: 16px 28px 24px;
            display: flex;
            gap: 10px;
            justify-content: flex-end
        }

        .close-btn {
            background: none;
            border: none;
            cursor: pointer;
            color: var(--muted);
            font-size: 1.2rem;
            padding: 4px;
            border-radius: 6px
        }

        .form-group {
            margin-bottom: 18px
        }

        label {
            display: block;
            font-size: 0.75rem;
            font-weight: 600;
            color: var(--charcoal);
            margin-bottom: 6px;
            letter-spacing: 0.03em
        }

        input,
        select,
        textarea {
            width: 100%;
            padding: 10px 14px;
            border: 1.5px solid #E5E7EB;
            border-radius: 10px;
            font-size: 0.875rem;
            font-family: 'DM Sans', sans-serif;
            color: var(--charcoal);
            background: white;
            outline: none;
            transition: border-color 0.15s, box-shadow 0.15s
        }

        input:focus,
        select:focus,
        textarea:focus {
            border-color: var(--sage-dark);
            box-shadow: 0 0 0 3px rgba(74, 122, 74, 0.1)
        }

        textarea {
            resize: vertical;
            min-height: 80px
        }

        .toast-container {
            position: fixed;
            bottom: 24px;
            right: 24px;
            z-index: 200;
            display: flex;
            flex-direction: column;
            gap: 8px
        }

        .toast {
            background: var(--charcoal);
            color: white;
            padding: 12px 18px;
            border-radius: 12px;
            font-size: 0.8rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 10px;
            animation: slideUp 0.3s ease;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
            max-width: 300px
        }

        .toast.success {
            background: var(--sage-dark)
        }

        .toast.error {
            background: var(--red)
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(20px)
            }

            to {
                opacity: 1;
                transform: translateY(0)
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(16px)
            }

            to {
                opacity: 1;
                transform: translateY(0)
            }
        }

        .fade-in {
            animation: fadeInUp 0.4s ease both
        }

        .fade-in-1 {
            animation-delay: 0.05s
        }

        .fade-in-2 {
            animation-delay: 0.1s
        }

        .fade-in-3 {
            animation-delay: 0.15s
        }

        .fade-in-4 {
            animation-delay: 0.2s
        }

        ::-webkit-scrollbar {
            width: 6px
        }

        ::-webkit-scrollbar-thumb {
            background: #D1D5DB;
            border-radius: 3px
        }
    </style>
</head>

<body>

    <!-- Sidebar -->
@include('header');

    <!-- Main -->
    <main class="main">
        <div class="topbar">
            <div class="topbar-title">Tableau de bord</div>
            <div class="topbar-actions">
                <span style="font-size:0.8rem;color:var(--muted)">Lundi 23 Fév. 2026</span>
                @if(auth()->user()->role_id==2)
                <button class="btn btn-sage btn-sm" onclick="openModal('modal-depense')">
                    <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5"
                        viewBox="0 0 24 24">
                        <line x1="12" y1="5" x2="12" y2="19" />
                        <line x1="5" y1="12" x2="19" y2="12" />
                    </svg>
                    Ajouter dépense
                </button>
                @else
                @endif
            </div>
        </div>

        <div class="page">
            <!-- Welcome banner -->
            <div style="background:linear-gradient(135deg,var(--charcoal) 0%,#2d4a2d 100%);border-radius:20px;padding:28px 32px;margin-bottom:28px;display:flex;align-items:center;justify-content:space-between;position:relative;overflow:hidden"
                class="fade-in">
                <div
                    style="position:absolute;top:-40px;right:-40px;width:200px;height:200px;background:var(--sage);border-radius:50%;opacity:0.08">
                </div>
                <div
                    style="position:absolute;bottom:-60px;right:80px;width:160px;height:160px;background:var(--accent);border-radius:50%;opacity:0.06">
                </div>
                <div>
                    <div style="color:rgba(255,255,255,0.6);font-size:0.8rem;margin-bottom:4px">Bonjour 👋</div>
                    <div
                        style="font-family:'Syne',sans-serif;font-weight:800;font-size:1.5rem;color:white;margin-bottom:6px">
                        {{ auth()->user()->name }}</div>
                        @if(auth()->user()->colocation!=null)
                    <div style="color:rgba(255,255,255,0.7);font-size:0.85rem">Colocation <strong
                            style="color:#C4D9C4">{{ auth()->user()->colocation->name }}</strong> · 4 membres actifs
                        </div>
                        @else
                          <div style="color:rgba(255,255,255,0.7);font-size:0.85rem">Colocation <strong
                            style="color:#C4D9C4">you are not in any colocation</strong> · 4 membres actifs
                        </div>
                        @endif

                </div>
                <div style="text-align:right;position:relative;z-index:1">
                    <div style="color:rgba(255,255,255,0.6);font-size:0.75rem;margin-bottom:4px">Votre solde</div>
                    <div style="font-family:'Syne',sans-serif;font-weight:800;font-size:2.2rem;color:#86EFAC">{{ auth()->user()->solde }} €
                    </div>
                    <div style="color:rgba(255,255,255,0.5);font-size:0.75rem">On vous doit de l'argent</div>
                </div>
            </div>

            <!-- KPI Stats -->
            <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:16px;margin-bottom:28px">
                <div class="stat-card green fade-in fade-in-1">
                    <div class="stat-icon green">💸</div>

                    <!-- if (auth()->user()->colocation()->depense()->montant==null) -->
                    <!-- <div class="stat-label">Total dépenses</div>
                           <div class="stat-value">totalDepenses</div> -->

                <!-- else -->
                    <div class="stat-label">Total dépenses</div>
                           <div class="stat-value">0</div>
                    <!-- endif -->
                </div>
                <div class="stat-card orange fade-in fade-in-2">
                    <div class="stat-icon orange">👥</div>
                    <div class="stat-label">Membres</div>
                    <div class="stat-value">4</div>
                    <div class="stat-sub">1 invitation en attente</div>
                </div>
                <div class="stat-card gold fade-in fade-in-3">
                    <div class="stat-icon gold">⚖️</div>
                    <div class="stat-label">Part individuelle</div>
                    <div class="stat-value">321 €</div>
                    <div class="stat-sub">Moyenne ce mois</div>
                </div>
                <div class="stat-card red fade-in fade-in-4">
                    <div class="stat-icon red">🏆</div>
                    <div class="stat-label">Réputation</div>
                    <div class="stat-value">+5</div>
                    <div class="stat-sub">★★★★★ Excellent</div>
                </div>
            </div>

            <!-- Bottom grid -->
            <div style="display:grid;grid-template-columns:1.4fr 1fr;gap:20px">
                <!-- Recent expenses -->
             <div class="card fade-in fade-in-2">
    <div class="card-header">
        <div class="card-title">Dépenses récentes</div>
        <a href="depenses.html" class="btn btn-ghost btn-sm">Voir tout →</a>
    </div>
    <div>
        @if(auth()->user()->colocation)
            @foreach ($depenses as $depense)
            <div class="expense-row">
                <div class="expense-cat" style="background:#F0FDF4">💸</div>
                <div class="expense-details">
                    <div class="expense-title">{{ $depense->titre }}</div>
                    <div class="expense-meta">Payé par
                        <strong>{{ $depense->payer }}</strong> · {{ $depense->date }}
                    </div>
                </div>
                <div style="text-align:right">
                    <div class="expense-amount" style="color:var(--sage-dark)">{{ $depense->montant }} €</div>
                    <div class="expense-share">
                        @if($depense->status == 'payed')
                            <span style="color:#15803D">✓ Payé</span>
                        @else
                            <span style="color:var(--accent)">En attente</span>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        @else
            <div style="padding:32px;text-align:center">
                <div style="font-size:2rem;margin-bottom:8px">🏠</div>
                <div style="color:var(--muted);font-size:0.85rem">Vous n'êtes pas encore dans une colocation.</div>
            </div>
        @endif
    </div>
</div>

                <!-- Right column -->
                <div style="display:flex;flex-direction:column;gap:16px">
                    <!-- Balance card -->
                    <div style="background:linear-gradient(135deg,#DCFCE7 0%,#F0FFF4 100%);border:1px solid #BBF7D0;border-radius:16px;padding:20px"
                        class="fade-in fade-in-3">
                        <div
                            style="font-size:0.75rem;font-weight:600;color:#15803D;margin-bottom:12px;text-transform:uppercase;letter-spacing:0.06em">
                            💰 Mon solde</div>
                        <div style="font-family:'Syne',sans-serif;font-weight:800;font-size:2rem;color:#15803D">+68,50 €
                        </div>
                        <div style="font-size:0.8rem;color:#16A34A;margin-top:4px">2 personnes vous doivent de l'argent
                        </div>
                        <div style="margin-top:16px;display:flex;flex-direction:column;gap:8px">
                            <div style="display:flex;align-items:center;justify-content:space-between;font-size:0.8rem">
                                <span style="color:#374151">Tom → Vous</span>
                                <span style="font-weight:700;color:#15803D">+43,50 €</span>
                            </div>
                            <div style="display:flex;align-items:center;justify-content:space-between;font-size:0.8rem">
                                <span style="color:#374151">Alex → Vous</span>
                                <span style="font-weight:700;color:#15803D">+25,00 €</span>
                            </div>
                        </div>
                        <a href="balances.html" class="btn btn-ghost btn-sm"
                            style="margin-top:14px;width:100%;justify-content:center">Voir les remboursements →</a>
                    </div>

                    <!-- Category chart -->
                    <div class="card fade-in fade-in-4">
                        <div class="card-header">
                            <div class="card-title">Par catégorie</div>
                        </div>
                        <div style="padding:16px 20px">
                            <div class="chart-row">
                                <div class="chart-label">Loyer</div>
                                <div class="chart-bar">
                                    <div class="chart-fill" style="width:62%;background:var(--sage-dark)">800 €</div>
                                </div>
                            </div>
                            <div class="chart-row">
                                <div class="chart-label">Factures</div>
                                <div class="chart-bar">
                                    <div class="chart-fill" style="width:26%;background:var(--accent)">193 €</div>
                                </div>
                            </div>
                            <div class="chart-row">
                                <div class="chart-label">Courses</div>
                                <div class="chart-bar">
                                    <div class="chart-fill" style="width:16%;background:var(--gold)">116 €</div>
                                </div>
                            </div>
                            <div class="chart-row" style="margin-bottom:0">
                                <div class="chart-label">Divers</div>
                                <div class="chart-bar">
                                    <div class="chart-fill" style="width:10%;background:#8B5CF6">65 €</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

   <!-- Modal dépense -->
<div class="modal-overlay" id="modal-depense">
    <div class="modal">
        <form action="{{ route('depense.store') }}" method="POST">
            @csrf
            @method('post')
            <div class="modal-header">
                <div class="modal-title">💸 Nouvelle dépense</div>
                <button type="button" class="close-btn" onclick="closeModal('modal-depense')">✕</button>
            </div>
            <div class="modal-body">

                <div class="form-group">
                    <label>Titre</label>
                    <input type="text" name="titre" placeholder="Ex: Courses Carrefour…">
                </div>

                <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px">
                    <div class="form-group">
                        <label>Montant (€)</label>
                        <input type="number" name="montant" placeholder="0,00" min="0" step="0.01">
                    </div>
                    <div class="form-group">
                        <label>Date</label>
                        <input type="date" name="date" value="{{ date('Y-m-d') }}">
                    </div>
                </div>

                <div class="form-group">
                    <label>Catégorie</label>
                    <select name="categorie">
                           @if(auth()->user()->colocation)
                    @foreach ($categories as $categorie)
                        <option value="{{ $categorie->id }}">{{ $categorie->title }}</option>
                    @endforeach
                @endif
                    </select>
                </div>

                <div class="form-group">
                    <label>Payé par</label>
                    <select name="payer">

                    @if(auth()->user()->colocation)
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            @endif
                    </select>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-ghost" onclick="closeModal('modal-depense')">Annuler</button>
                <button type="submit" class="btn btn-sage">Ajouter</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openModal(id) { document.getElementById(id).classList.add('open') }
    function closeModal(id) { document.getElementById(id).classList.remove('open') }

    // Close on overlay background click
    document.querySelectorAll('.modal-overlay').forEach(overlay => {
        overlay.addEventListener('click', function (e) {
            if (e.target === this) closeModal(this.id);
        });
    });
</script>
</body>

</html>
