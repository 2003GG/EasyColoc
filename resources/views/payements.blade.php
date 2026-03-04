<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>CoLoc — Paiements</title>
<link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
<style>
  :root{
    --sage:#8BAF8B;--sage-light:#C4D9C4;--sage-dark:#4A7A4A;
    --cream:#F5F0E8;--warm-white:#FAFAF7;--charcoal:#1C1C1E;
    --charcoal-light:#2C2C2E;--muted:#6B7280;--accent:#E8845A;
    --red:#D65050;--gold:#C9A84C
  }
  *{box-sizing:border-box;margin:0;padding:0}
  body{font-family:'DM Sans',sans-serif;background:var(--warm-white);color:var(--charcoal);min-height:100vh}

  /* ── Sidebar ── */
  .sidebar{background:var(--charcoal);width:260px;min-height:100vh;position:fixed;left:0;top:0;display:flex;flex-direction:column;z-index:50}
  .sidebar-logo{padding:28px 28px 0;font-family:'Syne',sans-serif;font-weight:800;font-size:1.5rem;color:var(--cream);letter-spacing:-0.03em}
  .sidebar-logo span{color:var(--sage)}
  .sidebar-nav{padding:32px 16px;flex:1}
  .nav-section{margin-bottom:24px}
  .nav-label{font-size:0.65rem;font-weight:600;letter-spacing:0.12em;text-transform:uppercase;color:#555;padding:0 12px;margin-bottom:6px;display:block}
  .nav-item{display:flex;align-items:center;gap:12px;padding:10px 12px;border-radius:10px;color:#9CA3AF;font-size:0.875rem;cursor:pointer;transition:all 0.15s;margin-bottom:2px;text-decoration:none}
  .nav-item:hover{background:rgba(255,255,255,0.06);color:#E5E7EB}
  .nav-item.active{background:var(--sage-dark);color:#fff}
  .nav-item svg{width:18px;height:18px;opacity:0.8;flex-shrink:0}
  .nav-item.active svg{opacity:1}
  .nav-badge{margin-left:auto;background:var(--accent);color:white;font-size:0.65rem;font-weight:700;padding:2px 6px;border-radius:20px}
  .sidebar-footer{padding:16px;border-top:1px solid rgba(255,255,255,0.06)}
  .avatar{width:36px;height:36px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-family:'Syne',sans-serif;font-weight:700;font-size:0.8rem;flex-shrink:0}

  /* ── Main ── */
  .main{margin-left:260px;min-height:100vh}
  .topbar{background:white;border-bottom:1px solid #F0EDE8;padding:0 32px;height:64px;display:flex;align-items:center;gap:16px;position:sticky;top:0;z-index:40}
  .topbar-title{font-family:'Syne',sans-serif;font-weight:700;font-size:1.1rem;color:var(--charcoal);flex:1}
  .page{padding:32px}

  /* ── Buttons ── */
  .btn{display:inline-flex;align-items:center;gap:8px;padding:9px 18px;border-radius:10px;font-size:0.8rem;font-weight:500;cursor:pointer;transition:all 0.15s;border:none;font-family:'DM Sans',sans-serif;white-space:nowrap;text-decoration:none}
  .btn-sage{background:var(--sage-dark);color:white}
  .btn-sage:hover{background:#3A6A3A}
  .btn-ghost{background:#F3F4F6;color:var(--charcoal)}
  .btn-ghost:hover{background:#E5E7EB}
  .btn-sm{padding:6px 14px;font-size:0.75rem;border-radius:8px}
  .btn-mark{display:inline-flex;align-items:center;gap:6px;padding:6px 14px;border-radius:8px;font-size:0.75rem;font-weight:500;font-family:'DM Sans',sans-serif;cursor:pointer;transition:all 0.15s;border:none}

  /* ── Cards ── */
  .card{background:white;border-radius:16px;border:1px solid #F0EDE8;overflow:hidden}
  .card-header{padding:20px 24px;border-bottom:1px solid #F5F0E8;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px}
  .card-title{font-family:'Syne',sans-serif;font-weight:700;font-size:1rem;color:var(--charcoal)}

  /* ── Status ── */
  .status{display:inline-flex;align-items:center;gap:5px;font-size:0.7rem;font-weight:600;padding:3px 10px;border-radius:20px}
  .status::before{content:'';width:6px;height:6px;border-radius:50%;flex-shrink:0}
  .status-paid{background:#DCFCE7;color:#15803D}.status-paid::before{background:#22C55E}
  .status-pending{background:#FEF3C7;color:#92400E}.status-pending::before{background:#F59E0B}
  .status-late{background:#FEE2E2;color:var(--red)}.status-late::before{background:var(--red)}

  /* ── Table ── */
  table{width:100%;border-collapse:collapse}
  th{text-align:left;font-size:0.7rem;font-weight:600;text-transform:uppercase;letter-spacing:0.08em;color:var(--muted);padding:12px 16px;background:#F9FAFB;border-bottom:1px solid #F0EDE8}
  td{padding:14px 16px;font-size:0.875rem;border-bottom:1px solid #F5F0E8;vertical-align:middle}
  tr:last-child td{border-bottom:none}
  tr:hover td{background:#FAFAF7}

  /* ── Category pills ── */
  .category-pill{font-size:0.68rem;font-weight:600;padding:2px 9px;border-radius:20px}
  .cat-loyer{background:#EFF6FF;color:#1D4ED8}
  .cat-courses{background:#F0FDF4;color:#16A34A}
  .cat-elec{background:#FFFBEB;color:#D97706}
  .cat-internet{background:#F5F3FF;color:#7C3AED}
  .cat-eau{background:#E0F2FE;color:#0369A1}
  .cat-menage{background:#FFF0F9;color:#C026D3}
  .cat-autre{background:#F3F4F6;color:#6B7280}

  /* ── Misc ── */
  .amount-big{font-family:'Syne',sans-serif;font-weight:800;font-size:1.6rem}
  .face-row{display:flex;align-items:center;gap:8px}
  .av-sm{width:28px;height:28px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-family:'Syne',sans-serif;font-weight:700;font-size:0.65rem}
  .av-sage{background:var(--sage-dark);color:white}
  .av-accent{background:var(--accent);color:white}
  .av-gold{background:var(--gold);color:white}
  .av-blue{background:#EFF6FF;color:#1D4ED8}
  .row-paid td{opacity:0.5}

  /* ── Animations ── */
  @keyframes fadeInUp{from{opacity:0;transform:translateY(16px)}to{opacity:1;transform:translateY(0)}}
  .fi{animation:fadeInUp 0.4s ease both}
  .fi-1{animation-delay:.05s}.fi-2{animation-delay:.1s}.fi-3{animation-delay:.15s}.fi-4{animation-delay:.2s}

  /* ── Filter tabs (CSS-only using :target) ── */
  /* Default = show all rows */
  #filter-all:checked ~ .main .row-paid,
  #filter-all:checked ~ .main tr[data-status]{display:table-row}

  #filter-pending:checked ~ .main .row-paid{display:none}
  #filter-paid:checked ~ .main tr[data-status="pending"],
  #filter-paid:checked ~ .main tr[data-status="late"]{display:none}
  #filter-paid:checked ~ .main tr[data-status="paid"]{display:table-row}

  /* Active filter button highlight */
  #filter-all:checked ~ .main label[for="filter-all"],
  #filter-pending:checked ~ .main label[for="filter-pending"],
  #filter-paid:checked ~ .main label[for="filter-paid"]{background:#E5E7EB;color:var(--charcoal)}

  /* ── Modal (CSS-only using :target) ── */
  .modal-overlay{display:none;position:fixed;inset:0;background:rgba(0,0,0,0.4);z-index:100;align-items:center;justify-content:center}
  .modal-overlay:target{display:flex}
  .modal-box{background:white;border-radius:20px;width:440px;padding:28px;box-shadow:0 24px 60px rgba(0,0,0,0.15);position:relative}
  .modal-title{font-family:'Syne',sans-serif;font-weight:700;font-size:1.1rem;margin-bottom:20px}
  .modal-close{position:absolute;top:20px;right:20px;background:#F3F4F6;border:none;width:30px;height:30px;border-radius:8px;cursor:pointer;font-size:1rem;display:flex;align-items:center;justify-content:center;text-decoration:none;color:var(--charcoal)}
  .field-group{display:flex;flex-direction:column;gap:14px}
  .field{display:flex;flex-direction:column;gap:5px}
  .field-row{display:grid;grid-template-columns:1fr 1fr;gap:12px}
  label.field-label{font-size:0.75rem;font-weight:600;color:var(--muted)}
  input,select{width:100%;padding:10px 14px;border:1px solid #E5E7EB;border-radius:10px;font-size:0.875rem;font-family:'DM Sans',sans-serif;outline:none}
  input:focus,select:focus{border-color:var(--sage-dark)}

  ::-webkit-scrollbar{width:6px}
  ::-webkit-scrollbar-thumb{background:#D1D5DB;border-radius:3px}

  /* Note banner */
  .note-banner{background:#FEF3C7;border:1px solid #FDE68A;border-radius:10px;padding:10px 14px;font-size:0.75rem;color:#92400E;margin-bottom:20px}
</style>
</head>
<body>
@include('layouts/header');
<main class="main">
  <div class="topbar">
    <div class="topbar-title">Paiements</div>
    <a href="#modal-add" class="btn btn-sage btn-sm">
      <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
      Ajouter un paiement
    </a>
  </div>

  <div class="page">

    <div class="note-banner">
      ℹ️ Version sans JavaScript — le filtrage fonctionne via CSS, le formulaire soumet normalement (sans traitement client-side). Les boutons "Payé / Non payé" nécessitent un backend pour persister.
    </div>

    <!-- Summary cards -->
    <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:14px;margin-bottom:28px">
      <div style="background:linear-gradient(135deg,#F5F0E8,#FDF8F0);border:1px solid #E8DFD0;border-radius:16px;padding:20px" class="fi fi-1">
        <div style="font-size:0.72rem;font-weight:600;text-transform:uppercase;letter-spacing:0.08em;color:var(--muted);margin-bottom:8px">Total ce mois</div>
        <div class="amount-big" style="color:var(--charcoal)">1 143,69 €</div>
        <div style="font-size:0.72rem;color:var(--muted);margin-top:2px">Février 2026</div>
      </div>
      <div style="background:linear-gradient(135deg,#FEF3C7,#FFFBEB);border:1px solid #FDE68A;border-radius:16px;padding:20px" class="fi fi-2">
        <div style="font-size:0.72rem;font-weight:600;text-transform:uppercase;letter-spacing:0.08em;color:#92400E;margin-bottom:8px">En attente</div>
        <div class="amount-big" style="color:#D97706">3</div>
        <div style="font-size:0.72rem;color:#B45309;margin-top:2px">Paiements à valider</div>
      </div>
      <div style="background:linear-gradient(135deg,#DCFCE7,#F0FFF4);border:1px solid #BBF7D0;border-radius:16px;padding:20px" class="fi fi-3">
        <div style="font-size:0.72rem;font-weight:600;text-transform:uppercase;letter-spacing:0.08em;color:#15803D;margin-bottom:8px">Payés</div>
        <div class="amount-big" style="color:#15803D">8</div>
        <div style="font-size:0.72rem;color:#16A34A;margin-top:2px">Ce mois-ci</div>
      </div>
      <div style="background:linear-gradient(135deg,#FEE2E2,#FFF5F5);border:1px solid #FECACA;border-radius:16px;padding:20px" class="fi fi-4">
        <div style="font-size:0.72rem;font-weight:600;text-transform:uppercase;letter-spacing:0.08em;color:var(--red);margin-bottom:8px">En retard</div>
        <div class="amount-big" style="color:var(--red)">1</div>
        <div style="font-size:0.72rem;color:var(--red);margin-top:2px">À relancer</div>
      </div>
    </div>

    <!-- Payments table -->
    <div class="card fi fi-2">
      <div class="card-header">
        <div>
          <div class="card-title">Liste des paiements</div>
          <div style="font-size:0.75rem;color:var(--muted);margin-top:2px">12 paiements ce mois</div>
        </div>
        <div style="display:flex;gap:8px;align-items:center">
          <label for="filter-all" class="btn btn-ghost btn-sm" style="cursor:pointer">Tous</label>
          <label for="filter-pending" class="btn btn-ghost btn-sm" style="cursor:pointer">En attente</label>
          <label for="filter-paid" class="btn btn-ghost btn-sm" style="cursor:pointer">Payés</label>
        </div>
      </div>

      <table>
        <thead>
          <tr>
            <th>Payé par</th><th>Montant</th><th>mon_part</th><th style="text-align:center">Action</th>
          </tr>
        </thead>
        <tbody>
        @foreach ($payements as $payement)
          <tr data-status="late">
            <td><div class="face-row"><div class="av-sm av-accent">TM</div><span style="font-size:0.82rem">{{$payement->payer}}</span></div></td>
            <td style="font-size:0.82rem;color:var(--muted)">{{$payement->montant}} €</td>
            <td style="font-size:0.82rem;color:var(--muted)">{{$payement->my_part}} €</td>
            <td style="text-align:center">
                @if ($payement->status=='notpaid')
              <a href="{{ route('payement.paid', ['payementId'=>$payement->id]) }}" class="btn-mark" style="background:#DCFCE7;color:#15803D">✓ Payé</a>
                @elseif($payement->status=='paid')

              @endif
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</main>

<!-- ── Modal: Add Payment ── -->
<div id="modal-add" class="modal-overlay">
  <div class="modal-box">
    <a href="#" class="modal-close">✕</a>
    <div class="modal-title">Nouveau paiement</div>
    <form action="#" method="get" class="field-group">
      <div class="field">
        <label class="field-label" for="m-desc">Description</label>
        <input id="m-desc" name="desc" placeholder="Ex: Loyer Mars, Courses, Internet…">
      </div>
      <div class="field-row">
        <div class="field">
          <label class="field-label" for="m-amount">Montant (€)</label>
          <input id="m-amount" name="amount" type="number" step="0.01" placeholder="0,00">
        </div>
        <div class="field">
          <label class="field-label" for="m-cat">Catégorie</label>
          <select id="m-cat" name="cat">
            <option>Loyer</option><option>Courses</option><option>Électricité</option><option>Internet</option><option>Autre</option>
          </select>
        </div>
      </div>
      <div class="field-row">
        <div class="field">
          <label class="field-label" for="m-from">Payé par</label>
          <select id="m-from" name="from">
            <option>Marie Audrey</option><option>Tom Martin</option><option>Léa Dubois</option><option>Alex Bernard</option>
          </select>
        </div>
        <div class="field">
          <label class="field-label" for="m-to">Pour</label>
          <select id="m-to" name="to">
            <option>Tous</option><option>Marie Audrey</option><option>Tom Martin</option><option>Léa Dubois</option><option>Alex Bernard</option>
          </select>
        </div>
      </div>
      <button type="submit" class="btn btn-sage" style="width:100%;justify-content:center;margin-top:4px">
        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
        Ajouter le paiement
      </button>
    </form>
  </div>
</div>

<!-- ── Modal: Confirm Pay ── -->
<div id="modal-pay" class="modal-overlay">
  <div class="modal-box" style="width:360px;text-align:center">
    <a href="#" class="modal-close">✕</a>
    <div style="font-size:2rem;margin-bottom:12px">✅</div>
    <div class="modal-title" style="text-align:center">Marquer comme payé</div>
    <p style="font-size:0.85rem;color:var(--muted);margin-bottom:20px">Cette action nécessite un backend pour persister l'état. Soumettez le formulaire pour envoyer la requête.</p>
    <form action="#" method="post" style="display:flex;gap:10px;justify-content:center">
      <a href="#" class="btn btn-ghost btn-sm">Annuler</a>
      <button type="submit" class="btn btn-sage btn-sm">Confirmer</button>
    </form>
  </div>
</div>

<!-- ── Modal: Confirm Unpay ── -->
<div id="modal-unpay" class="modal-overlay">
  <div class="modal-box" style="width:360px;text-align:center">
    <a href="#" class="modal-close">✕</a>
    <div style="font-size:2rem;margin-bottom:12px">↩️</div>
    <div class="modal-title" style="text-align:center">Marquer comme non payé</div>
    <p style="font-size:0.85rem;color:var(--muted);margin-bottom:20px">Cette action nécessite un backend pour persister l'état. Soumettez le formulaire pour envoyer la requête.</p>
    <form action="#" method="post" style="display:flex;gap:10px;justify-content:center">
      <a href="#" class="btn btn-ghost btn-sm">Annuler</a>
      <button type="submit" class="btn btn-red btn-sm">Confirmer</button>
    </form>
  </div>
</div>

</body>
</html>
