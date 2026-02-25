<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>CoLoc — Balances</title>
<script src="https://cdn.tailwindcss.com"></script>
<link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
<style>
  :root{--sage:#8BAF8B;--sage-light:#C4D9C4;--sage-dark:#4A7A4A;--cream:#F5F0E8;--warm-white:#FAFAF7;--charcoal:#1C1C1E;--charcoal-light:#2C2C2E;--muted:#6B7280;--accent:#E8845A;--red:#D65050;--gold:#C9A84C}
  *{box-sizing:border-box;margin:0;padding:0}
  body{font-family:'DM Sans',sans-serif;background:var(--warm-white);color:var(--charcoal);min-height:100vh}
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
  .user-card{display:flex;align-items:center;gap:10px;padding:10px 12px;border-radius:10px;cursor:pointer}
  .avatar{width:36px;height:36px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-family:'Syne',sans-serif;font-weight:700;font-size:0.8rem;flex-shrink:0}
  .avatar-sage{background:var(--sage-dark);color:white}
  .avatar-accent{background:var(--accent);color:white}
  .avatar-gold{background:var(--gold);color:white}
  .main{margin-left:260px;min-height:100vh}
  .topbar{background:white;border-bottom:1px solid #F0EDE8;padding:0 32px;height:64px;display:flex;align-items:center;gap:16px;position:sticky;top:0;z-index:40}
  .topbar-title{font-family:'Syne',sans-serif;font-weight:700;font-size:1.1rem;color:var(--charcoal);flex:1}
  .page{padding:32px}
  .btn{display:inline-flex;align-items:center;gap:8px;padding:9px 18px;border-radius:10px;font-size:0.8rem;font-weight:500;cursor:pointer;transition:all 0.15s;border:none;font-family:'DM Sans',sans-serif;white-space:nowrap}
  .btn-sage{background:var(--sage-dark);color:white}
  .btn-sage:hover{background:#3A6A3A}
  .btn-sm{padding:6px 12px;font-size:0.75rem;border-radius:8px}
  .card{background:white;border-radius:16px;border:1px solid #F0EDE8;overflow:hidden}
  .card-header{padding:20px 24px;border-bottom:1px solid #F5F0E8;display:flex;align-items:center;justify-content:space-between}
  .card-title{font-family:'Syne',sans-serif;font-weight:700;font-size:1rem;color:var(--charcoal)}
  .role-badge{font-size:0.65rem;font-weight:600;padding:2px 8px;border-radius:20px;text-transform:uppercase;letter-spacing:0.05em}
  .role-owner{background:#FEF3C7;color:#92400E}
  .status{display:inline-flex;align-items:center;gap:5px;font-size:0.7rem;font-weight:600;padding:3px 10px;border-radius:20px}
  .status::before{content:'';width:6px;height:6px;border-radius:50%;flex-shrink:0}
  .status-active{background:#DCFCE7;color:#15803D}
  .status-active::before{background:#22C55E}
  .rep{display:inline-flex;align-items:center;gap:4px;font-family:'Syne',sans-serif;font-weight:700;font-size:0.8rem}
  .rep.pos{color:var(--sage-dark)}.rep.neg{color:var(--red)}
  table{width:100%;border-collapse:collapse}
  th{text-align:left;font-size:0.7rem;font-weight:600;text-transform:uppercase;letter-spacing:0.08em;color:var(--muted);padding:12px 16px;background:#F9FAFB;border-bottom:1px solid #F0EDE8}
  td{padding:14px 16px;font-size:0.875rem;border-bottom:1px solid #F5F0E8;vertical-align:middle}
  tr:last-child td{border-bottom:none}
  tr:hover td{background:#FAFAF7}
  .toast-container{position:fixed;bottom:24px;right:24px;z-index:200;display:flex;flex-direction:column;gap:8px}
  .toast{background:var(--charcoal);color:white;padding:12px 18px;border-radius:12px;font-size:0.8rem;font-weight:500;display:flex;align-items:center;gap:10px;animation:slideUp 0.3s ease;box-shadow:0 8px 25px rgba(0,0,0,0.2);max-width:300px}
  .toast.success{background:var(--sage-dark)}.toast.error{background:var(--red)}
  @keyframes slideUp{from{opacity:0;transform:translateY(20px)}to{opacity:1;transform:translateY(0)}}
  @keyframes fadeInUp{from{opacity:0;transform:translateY(16px)}to{opacity:1;transform:translateY(0)}}
  .fade-in{animation:fadeInUp 0.4s ease both}
  .fade-in-1{animation-delay:0.05s}.fade-in-2{animation-delay:0.1s}.fade-in-3{animation-delay:0.15s}.fade-in-4{animation-delay:0.2s}
  ::-webkit-scrollbar{width:6px}::-webkit-scrollbar-thumb{background:#D1D5DB;border-radius:3px}
</style>
</head>
<body>
<aside class="sidebar">
  <div class="sidebar-logo">Co<span>Loc</span></div>
  <nav class="sidebar-nav">
    <div class="nav-section">
      <span class="nav-label">Navigation</span>
      <a href="dashboard.html" class="nav-item"><svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/></svg>Tableau de bord</a>
      <a href="colocation.html" class="nav-item"><svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>Ma Colocation</a>
      <a href="depenses.html" class="nav-item"><svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 100 7h5a3.5 3.5 0 110 7H6"/></svg>Dépenses</a>
      <a href="balances.html" class="nav-item active"><svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><line x1="3" y1="6" x2="21" y2="6"/><path d="M3 6l9 6 9-6"/><line x1="3" y1="18" x2="21" y2="18"/></svg>Balances</a>
      <a href="invitations.html" class="nav-item"><svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>Invitations <span class="nav-badge">2</span></a>
    </div>
    <div class="nav-section">
      <span class="nav-label">Administration</span>
      <a href="admin.html" class="nav-item"><svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="3"/><path d="M19.07 4.93a10 10 0 010 14.14M4.93 4.93a10 10 0 000 14.14"/></svg>Dashboard Admin</a>
      <a href="categories.html" class="nav-item"><svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="5" cy="6" r="2"/><circle cx="5" cy="12" r="2"/><circle cx="5" cy="18" r="2"/><line x1="10" y1="6" x2="20" y2="6"/><line x1="10" y1="12" x2="20" y2="12"/><line x1="10" y1="18" x2="20" y2="18"/></svg>Catégories</a>
    </div>
  </nav>
  <div class="sidebar-footer"><div class="user-card"><div class="avatar avatar-sage">MA</div><div style="flex:1;min-width:0"><div style="font-size:0.8rem;font-weight:500;color:#E5E7EB">Marie Audrey</div><div style="font-size:0.65rem;color:var(--sage);font-weight:500">Owner · Admin ★★★★★</div></div></div></div>
</aside>

<main class="main">
  <div class="topbar">
    <div class="topbar-title">Balances & Remboursements</div>
  </div>

  <div class="page">
    <!-- Balance cards -->
    <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:14px;margin-bottom:28px">
      <div style="background:linear-gradient(135deg,#DCFCE7 0%,#F0FFF4 100%);border:1px solid #BBF7D0;border-radius:16px;padding:20px" class="fade-in fade-in-1">
        <div style="display:flex;align-items:center;gap:10px;margin-bottom:10px">
          <div class="avatar avatar-sage">MA</div>
          <div><div style="font-size:0.8rem;font-weight:600">Marie Audrey</div><div style="font-size:0.7rem;color:#15803D">Owner</div></div>
        </div>
        <div style="font-family:'Syne',sans-serif;font-weight:800;font-size:1.6rem;color:#15803D">+68,50 €</div>
        <div style="font-size:0.72rem;color:#16A34A;margin-top:2px">À recevoir</div>
      </div>
      <div style="background:linear-gradient(135deg,#FEF2F2 0%,#FFF5F5 100%);border:1px solid #FECACA;border-radius:16px;padding:20px" class="fade-in fade-in-2">
        <div style="display:flex;align-items:center;gap:10px;margin-bottom:10px">
          <div class="avatar avatar-accent">TM</div>
          <div><div style="font-size:0.8rem;font-weight:600">Tom Martin</div><div style="font-size:0.7rem;color:var(--red)">À rembourser</div></div>
        </div>
        <div style="font-family:'Syne',sans-serif;font-weight:800;font-size:1.6rem;color:var(--red)">-43,50 €</div>
        <div style="font-size:0.72rem;color:var(--red);margin-top:2px">Doit de l'argent</div>
      </div>
      <div style="background:linear-gradient(135deg,#DCFCE7 0%,#F0FFF4 100%);border:1px solid #BBF7D0;border-radius:16px;padding:20px" class="fade-in fade-in-3">
        <div style="display:flex;align-items:center;gap:10px;margin-bottom:10px">
          <div class="avatar" style="background:#EFF6FF;color:#1D4ED8">LD</div>
          <div><div style="font-size:0.8rem;font-weight:600">Léa Dubois</div><div style="font-size:0.7rem;color:#15803D">À recevoir</div></div>
        </div>
        <div style="font-family:'Syne',sans-serif;font-weight:800;font-size:1.6rem;color:#15803D">+12,00 €</div>
        <div style="font-size:0.72rem;color:#16A34A;margin-top:2px">À recevoir</div>
      </div>
      <div style="background:linear-gradient(135deg,#FEF2F2 0%,#FFF5F5 100%);border:1px solid #FECACA;border-radius:16px;padding:20px" class="fade-in fade-in-4">
        <div style="display:flex;align-items:center;gap:10px;margin-bottom:10px">
          <div class="avatar avatar-gold">AB</div>
          <div><div style="font-size:0.8rem;font-weight:600">Alex Bernard</div><div style="font-size:0.7rem;color:var(--red)">À rembourser</div></div>
        </div>
        <div style="font-family:'Syne',sans-serif;font-weight:800;font-size:1.6rem;color:var(--red)">-37,00 €</div>
        <div style="font-size:0.72rem;color:var(--red);margin-top:2px">Doit de l'argent</div>
      </div>
    </div>

    <!-- Settlements -->
    <div class="card" style="margin-bottom:20px">
      <div class="card-header">
        <div>
          <div class="card-title">Qui doit à qui ? — Remboursements simplifiés</div>
          <div style="font-size:0.75rem;color:var(--muted);margin-top:2px">3 transactions nécessaires pour solder tous les comptes</div>
        </div>
      </div>
      <div style="padding:8px 24px">

        <div style="display:flex;align-items:center;gap:12px;padding:16px 0;border-bottom:1px solid #F5F0E8">
          <div class="avatar avatar-accent" style="width:44px;height:44px;flex-shrink:0">TM</div>
          <div style="flex:1">
            <div style="display:flex;align-items:center;gap:8px;flex-wrap:wrap;margin-bottom:4px">
              <span style="font-weight:600;font-size:0.9rem">Tom Martin</span>
              <svg width="16" height="16" fill="none" stroke="var(--muted)" stroke-width="2" viewBox="0 0 24 24"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
              <span style="font-weight:600;font-size:0.9rem">Marie Audrey</span>
            </div>
            <div style="font-size:0.75rem;color:var(--muted)">Solde dû suite aux dépenses de Février 2026</div>
          </div>
          <div style="text-align:right">
            <div style="font-family:'Syne',sans-serif;font-weight:800;font-size:1.2rem;color:var(--accent)">43,50 €</div>
            <button class="btn btn-sage btn-sm" style="margin-top:6px" onclick="showToast('Paiement de 43,50 € marqué comme payé ✓','success')">✓ Marquer payé</button>
          </div>
        </div>

        <div style="display:flex;align-items:center;gap:12px;padding:16px 0;border-bottom:1px solid #F5F0E8">
          <div class="avatar avatar-gold" style="width:44px;height:44px;flex-shrink:0">AB</div>
          <div style="flex:1">
            <div style="display:flex;align-items:center;gap:8px;flex-wrap:wrap;margin-bottom:4px">
              <span style="font-weight:600;font-size:0.9rem">Alex Bernard</span>
              <svg width="16" height="16" fill="none" stroke="var(--muted)" stroke-width="2" viewBox="0 0 24 24"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
              <span style="font-weight:600;font-size:0.9rem">Marie Audrey</span>
            </div>
            <div style="font-size:0.75rem;color:var(--muted)">Solde dû suite aux dépenses de Février 2026</div>
          </div>
          <div style="text-align:right">
            <div style="font-family:'Syne',sans-serif;font-weight:800;font-size:1.2rem;color:var(--accent)">25,00 €</div>
            <button class="btn btn-sage btn-sm" style="margin-top:6px" onclick="showToast('Paiement de 25,00 € marqué comme payé ✓','success')">✓ Marquer payé</button>
          </div>
        </div>

        <div style="display:flex;align-items:center;gap:12px;padding:16px 0">
          <div class="avatar avatar-gold" style="width:44px;height:44px;flex-shrink:0">AB</div>
          <div style="flex:1">
            <div style="display:flex;align-items:center;gap:8px;flex-wrap:wrap;margin-bottom:4px">
              <span style="font-weight:600;font-size:0.9rem">Alex Bernard</span>
              <svg width="16" height="16" fill="none" stroke="var(--muted)" stroke-width="2" viewBox="0 0 24 24"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
              <span style="font-weight:600;font-size:0.9rem">Léa Dubois</span>
            </div>
            <div style="font-size:0.75rem;color:var(--muted)">Solde résiduel à rembourser</div>
          </div>
          <div style="text-align:right">
            <div style="font-family:'Syne',sans-serif;font-weight:800;font-size:1.2rem;color:var(--accent)">12,00 €</div>
            <button class="btn btn-sage btn-sm" style="margin-top:6px" onclick="showToast('Paiement de 12,00 € marqué comme payé ✓','success')">✓ Marquer payé</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Detail table -->
    <div class="card">
      <div class="card-header"><div class="card-title">Détail des balances</div></div>
      <table>
        <thead>
          <tr><th>Membre</th><th>Total payé</th><th>Part théorique</th><th>Solde</th><th>Réputation</th><th>Statut</th></tr>
        </thead>
        <tbody>
          <tr>
            <td><div style="display:flex;align-items:center;gap:10px"><div class="avatar avatar-sage" style="width:32px;height:32px;font-size:0.7rem">MA</div><span style="font-weight:500">Marie Audrey</span><span class="role-badge role-owner" style="margin-left:4px">Owner</span></div></td>
            <td style="font-weight:600">922,00 €</td><td style="color:var(--muted)">321,10 €</td>
            <td style="font-family:'Syne',sans-serif;font-weight:700;color:var(--sage-dark)">+68,50 €</td>
            <td><span class="rep pos">★ +5</span></td><td><span class="status status-active">Actif</span></td>
          </tr>
          <tr>
            <td><div style="display:flex;align-items:center;gap:10px"><div class="avatar avatar-accent" style="width:32px;height:32px;font-size:0.7rem">TM</div><span style="font-weight:500">Tom Martin</span></div></td>
            <td style="font-weight:600">143,20 €</td><td style="color:var(--muted)">321,10 €</td>
            <td style="font-family:'Syne',sans-serif;font-weight:700;color:var(--red)">-43,50 €</td>
            <td><span class="rep pos">★ +2</span></td><td><span class="status status-active">Actif</span></td>
          </tr>
          <tr>
            <td><div style="display:flex;align-items:center;gap:10px"><div class="avatar" style="width:32px;height:32px;font-size:0.7rem;background:#EFF6FF;color:#1D4ED8">LD</div><span style="font-weight:500">Léa Dubois</span></div></td>
            <td style="font-weight:600">49,99 €</td><td style="color:var(--muted)">321,10 €</td>
            <td style="font-family:'Syne',sans-serif;font-weight:700;color:var(--sage-dark)">+12,00 €</td>
            <td><span class="rep pos">★ +3</span></td><td><span class="status status-active">Actif</span></td>
          </tr>
          <tr>
            <td><div style="display:flex;align-items:center;gap:10px"><div class="avatar avatar-gold" style="width:32px;height:32px;font-size:0.7rem">AB</div><span style="font-weight:500">Alex Bernard</span></div></td>
            <td style="font-weight:600">28,50 €</td><td style="color:var(--muted)">321,10 €</td>
            <td style="font-family:'Syne',sans-serif;font-weight:700;color:var(--red)">-37,00 €</td>
            <td><span class="rep neg">★ -1</span></td><td><span class="status status-active">Actif</span></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</main>
<div class="toast-container" id="toasts"></div>
<script>
  function showToast(msg,type='success'){const c=document.getElementById('toasts'),t=document.createElement('div');t.className=`toast ${type}`;t.innerHTML=`<span>${type==='success'?'✓':'✕'}</span><span>${msg}</span>`;c.appendChild(t);setTimeout(()=>{t.style.opacity='0';t.style.transition='opacity 0.3s';setTimeout(()=>t.remove(),300)},3500)}
</script>
</body>
</html>
