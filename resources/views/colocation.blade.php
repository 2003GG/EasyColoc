<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>CoLoc — Ma Colocation</title>
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
  .topbar-actions{display:flex;align-items:center;gap:10px}
  .page{padding:32px}
  .btn{display:inline-flex;align-items:center;gap:8px;padding:9px 18px;border-radius:10px;font-size:0.8rem;font-weight:500;cursor:pointer;transition:all 0.15s;border:none;font-family:'DM Sans',sans-serif;white-space:nowrap}
  .btn-primary{background:var(--charcoal);color:white}
  .btn-sage{background:var(--sage-dark);color:white}
  .btn-sage:hover{background:#3A6A3A}
  .btn-ghost{background:transparent;color:var(--muted);border:1px solid #E5E7EB}
  .btn-ghost:hover{background:#F9FAFB;color:var(--charcoal)}
  .btn-danger{background:#FEF2F2;color:var(--red);border:1px solid #FECACA}
  .btn-danger:hover{background:#FEE2E2}
  .btn-sm{padding:6px 12px;font-size:0.75rem;border-radius:8px}
  .card{background:white;border-radius:16px;border:1px solid #F0EDE8;overflow:hidden}
  .card-header{padding:20px 24px;border-bottom:1px solid #F5F0E8;display:flex;align-items:center;justify-content:space-between}
  .card-title{font-family:'Syne',sans-serif;font-weight:700;font-size:1rem;color:var(--charcoal)}
  .card-body{padding:24px}
  .member-row{display:flex;align-items:center;gap:12px;padding:14px 0;border-bottom:1px solid #F5F0E8}
  .member-row:last-child{border-bottom:none}
  .member-info{flex:1}
  .member-name{font-weight:500;font-size:0.875rem}
  .member-meta{font-size:0.75rem;color:var(--muted);display:flex;align-items:center;gap:8px;margin-top:2px}
  .role-badge{font-size:0.65rem;font-weight:600;padding:2px 8px;border-radius:20px;text-transform:uppercase;letter-spacing:0.05em}
  .role-owner{background:#FEF3C7;color:#92400E}
  .role-member{background:#EFF6FF;color:#1E40AF}
  .role-admin{background:#F5F3FF;color:#6D28D9}
  .rep{display:inline-flex;align-items:center;gap:4px;font-family:'Syne',sans-serif;font-weight:700;font-size:0.8rem}
  .rep.pos{color:var(--sage-dark)}
  .rep.neg{color:var(--red)}
  .status{display:inline-flex;align-items:center;gap:5px;font-size:0.7rem;font-weight:600;padding:3px 10px;border-radius:20px}
  .status::before{content:'';width:6px;height:6px;border-radius:50%;flex-shrink:0}
  .status-active{background:#DCFCE7;color:#15803D}
  .status-active::before{background:#22C55E}
  .status-pending{background:#FEF3C7;color:#B45309}
  .status-pending::before{background:#F59E0B}
  .invite-card{background:linear-gradient(135deg,var(--charcoal) 0%,var(--charcoal-light) 100%);border-radius:16px;padding:24px;color:white;position:relative;overflow:hidden}
  .invite-card::before{content:'';position:absolute;top:-30px;right:-30px;width:120px;height:120px;background:var(--sage);border-radius:50%;opacity:0.15}
  .modal-overlay{position:fixed;inset:0;background:rgba(0,0,0,0.5);backdrop-filter:blur(4px);z-index:100;display:flex;align-items:center;justify-content:center;padding:20px;opacity:0;pointer-events:none;transition:opacity 0.2s}
  .modal-overlay.open{opacity:1;pointer-events:all}
  .modal{background:white;border-radius:20px;width:100%;max-width:480px;max-height:90vh;overflow-y:auto;transform:translateY(20px);transition:transform 0.2s;box-shadow:0 25px 60px rgba(0,0,0,0.2)}
  .modal-overlay.open .modal{transform:translateY(0)}
  .modal-header{padding:24px 28px 20px;border-bottom:1px solid #F0EDE8;display:flex;align-items:center;justify-content:space-between}
  .modal-title{font-family:'Syne',sans-serif;font-weight:700;font-size:1.1rem}
  .modal-body{padding:24px 28px}
  .modal-footer{padding:16px 28px 24px;display:flex;gap:10px;justify-content:flex-end}
  .close-btn{background:none;border:none;cursor:pointer;color:var(--muted);font-size:1.2rem;padding:4px}
  .form-group{margin-bottom:18px}
  label{display:block;font-size:0.75rem;font-weight:600;color:var(--charcoal);margin-bottom:6px}
  input,select,textarea{width:100%;padding:10px 14px;border:1.5px solid #E5E7EB;border-radius:10px;font-size:0.875rem;font-family:'DM Sans',sans-serif;color:var(--charcoal);background:white;outline:none;transition:border-color 0.15s,box-shadow 0.15s}
  input:focus,select:focus,textarea:focus{border-color:var(--sage-dark);box-shadow:0 0 0 3px rgba(74,122,74,0.1)}
  textarea{resize:vertical;min-height:80px}
  .toast-container{position:fixed;bottom:24px;right:24px;z-index:200;display:flex;flex-direction:column;gap:8px}
  .toast{background:var(--charcoal);color:white;padding:12px 18px;border-radius:12px;font-size:0.8rem;font-weight:500;display:flex;align-items:center;gap:10px;animation:slideUp 0.3s ease;box-shadow:0 8px 25px rgba(0,0,0,0.2);max-width:300px}
  .toast.success{background:var(--sage-dark)}
  .toast.error{background:var(--red)}
  @keyframes slideUp{from{opacity:0;transform:translateY(20px)}to{opacity:1;transform:translateY(0)}}
  @keyframes fadeInUp{from{opacity:0;transform:translateY(16px)}to{opacity:1;transform:translateY(0)}}
  .fade-in{animation:fadeInUp 0.4s ease both}
</style>
</head>
<body>

<aside class="sidebar">
  <div class="sidebar-logo">Co<span>Loc</span></div>
  <nav class="sidebar-nav">
    <div class="nav-section">
      <span class="nav-label">Navigation</span>
      <a href="dashboard.html" class="nav-item"><svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/></svg>Tableau de bord</a>
      <a href="colocation.html" class="nav-item active"><svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>Ma Colocation</a>
      <a href="depenses.html" class="nav-item"><svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 100 7h5a3.5 3.5 0 110 7H6"/></svg>Dépenses</a>
      <a href="balances.html" class="nav-item"><svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><line x1="3" y1="6" x2="21" y2="6"/><path d="M3 6l9 6 9-6"/><line x1="3" y1="18" x2="21" y2="18"/></svg>Balances</a>
      <a href="invitations.html" class="nav-item"><svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>Invitations <span class="nav-badge">2</span></a>
    </div>
    <div class="nav-section">
      <span class="nav-label">Administration</span>
      <a href="admin.html" class="nav-item"><svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="3"/><path d="M19.07 4.93a10 10 0 010 14.14M4.93 4.93a10 10 0 000 14.14"/></svg>Dashboard Admin</a>
      <a href="categories.html" class="nav-item"><svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="5" cy="6" r="2"/><circle cx="5" cy="12" r="2"/><circle cx="5" cy="18" r="2"/><line x1="10" y1="6" x2="20" y2="6"/><line x1="10" y1="12" x2="20" y2="12"/><line x1="10" y1="18" x2="20" y2="18"/></svg>Catégories</a>
    </div>
  </nav>
  <div class="sidebar-footer">
    <div class="user-card">
      <div class="avatar avatar-sage">MA</div>
      <div style="flex:1;min-width:0"><div style="font-size:0.8rem;font-weight:500;color:#E5E7EB">Marie Audrey</div><div style="font-size:0.65rem;color:var(--sage);font-weight:500">Owner · Admin ★★★★★</div></div>
    </div>
  </div>
</aside>

<main class="main">
  <div class="topbar">
    <div class="topbar-title">Ma Colocation</div>
    <div class="topbar-actions">
      <button class="btn btn-ghost btn-sm" onclick="openModal('modal-invite')">
        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M16 21v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><line x1="19" y1="8" x2="19" y2="14"/><line x1="22" y1="11" x2="16" y2="11"/></svg>
        Inviter un membre
      </button>
      <button class="btn btn-danger btn-sm" onclick="openModal('modal-cancel')">🗑 Annuler colocation</button>
    </div>
  </div>

  <div class="page">
    <div style="display:grid;grid-template-columns:1.2fr 1fr;gap:20px">

      <!-- Left -->
      <div style="display:flex;flex-direction:column;gap:16px">

        <!-- Coloc info card -->
        <div class="card fade-in">
          <div style="padding:24px">
            <div style="display:flex;align-items:center;gap:16px;margin-bottom:20px">
              <div style="width:60px;height:60px;background:linear-gradient(135deg,var(--sage-dark),var(--sage));border-radius:18px;display:flex;align-items:center;justify-content:center;font-size:1.8rem;flex-shrink:0">🏡</div>
              <div>
                <div style="font-family:'Syne',sans-serif;font-weight:800;font-size:1.3rem;color:var(--charcoal)">Les Goûters du Jeudi</div>
                <div style="display:flex;align-items:center;gap:8px;margin-top:6px">
                  <span class="status status-active">Active</span>
                  <span style="font-size:0.75rem;color:var(--muted)">Depuis le 15 Sept. 2025</span>
                </div>
              </div>
            </div>
            <div style="display:grid;grid-template-columns:1fr 1fr 1fr;gap:12px">
              <div style="background:var(--cream);border-radius:12px;padding:14px;text-align:center">
                <div style="font-family:'Syne',sans-serif;font-weight:800;font-size:1.4rem">4</div>
                <div style="font-size:0.7rem;color:var(--muted)">Membres</div>
              </div>
              <div style="background:var(--cream);border-radius:12px;padding:14px;text-align:center">
                <div style="font-family:'Syne',sans-serif;font-weight:800;font-size:1.4rem">23</div>
                <div style="font-size:0.7rem;color:var(--muted)">Dépenses</div>
              </div>
              <div style="background:var(--cream);border-radius:12px;padding:14px;text-align:center">
                <div style="font-family:'Syne',sans-serif;font-weight:800;font-size:1.1rem">1 284 €</div>
                <div style="font-size:0.7rem;color:var(--muted)">Total</div>
              </div>
            </div>
          </div>
        </div>

        <!-- Members -->
        <div class="card fade-in">
          <div class="card-header">
            <div class="card-title">Membres (4)</div>
          </div>
          <div style="padding:8px 24px">
            <div class="member-row">
              <div class="avatar avatar-sage">MA</div>
              <div class="member-info">
                <div class="member-name">Marie Audrey <span class="role-badge role-owner" style="margin-left:6px">Owner</span></div>
                <div class="member-meta"><span class="rep pos">★ +5</span> · Rejoint le 15 Sept. 2025</div>
              </div>
              <div style="font-family:'Syne',sans-serif;font-weight:700;color:var(--sage-dark);font-size:0.9rem">+68,50 €</div>
            </div>
            <div class="member-row">
              <div class="avatar avatar-accent">TM</div>
              <div class="member-info">
                <div class="member-name">Tom Martin</div>
                <div class="member-meta"><span class="rep pos">★ +2</span> · Rejoint le 22 Sept. 2025</div>
              </div>
              <div style="display:flex;align-items:center;gap:8px">
                <span style="font-family:'Syne',sans-serif;font-weight:700;color:var(--red);font-size:0.9rem">-43,50 €</span>
                <button class="btn btn-danger btn-sm" onclick="showToast('Tom Martin retiré','success')">Retirer</button>
              </div>
            </div>
            <div class="member-row">
              <div class="avatar" style="background:#EFF6FF;color:#1D4ED8">LD</div>
              <div class="member-info">
                <div class="member-name">Léa Dubois</div>
                <div class="member-meta"><span class="rep pos">★ +3</span> · Rejoint le 1 Oct. 2025</div>
              </div>
              <div style="display:flex;align-items:center;gap:8px">
                <span style="font-family:'Syne',sans-serif;font-weight:700;color:var(--sage-dark);font-size:0.9rem">+12,00 €</span>
                <button class="btn btn-danger btn-sm" onclick="showToast('Léa Dubois retirée','success')">Retirer</button>
              </div>
            </div>
            <div class="member-row">
              <div class="avatar avatar-gold">AB</div>
              <div class="member-info">
                <div class="member-name">Alex Bernard</div>
                <div class="member-meta"><span class="rep neg">★ -1</span> · Rejoint le 10 Oct. 2025</div>
              </div>
              <div style="display:flex;align-items:center;gap:8px">
                <span style="font-family:'Syne',sans-serif;font-weight:700;color:var(--red);font-size:0.9rem">-37,00 €</span>
                <button class="btn btn-danger btn-sm" onclick="showToast('Alex Bernard retiré','success')">Retirer</button>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Right -->
      <div style="display:flex;flex-direction:column;gap:16px">

        <!-- Invite link -->
        <div class="invite-card fade-in">
          <div style="font-size:0.7rem;font-weight:600;letter-spacing:0.1em;text-transform:uppercase;color:rgba(255,255,255,0.5);margin-bottom:6px;position:relative;z-index:1">Lien d'invitation actif</div>
          <div style="font-family:'Syne',sans-serif;font-weight:700;font-size:1rem;color:white;margin-bottom:12px;position:relative;z-index:1">Invitez vos colocataires</div>
          <div style="background:rgba(255,255,255,0.1);border-radius:10px;padding:10px 14px;font-size:0.75rem;color:rgba(255,255,255,0.7);font-family:monospace;word-break:break-all;margin-bottom:14px;position:relative;z-index:1">https://coloc.app/invite/tok_xK9mP2qL7nR4s8</div>
          <div style="display:flex;gap:8px;position:relative;z-index:1">
            <button class="btn btn-sage btn-sm" style="flex:1" onclick="showToast('Lien copié !','success')">📋 Copier</button>
            <button class="btn btn-sm" style="background:rgba(255,255,255,0.1);color:white;flex:1;border:none" onclick="openModal('modal-invite')">📧 Email</button>
          </div>
        </div>

        <!-- Pending invites -->
        <div class="card fade-in">
          <div class="card-header">
            <div class="card-title">Invitations en attente</div>
            <span class="nav-badge">1</span>
          </div>
          <div style="padding:12px 20px">
            <div style="display:flex;align-items:center;gap:12px;padding:10px 0;border-bottom:1px solid #F5F0E8">
              <div class="avatar" style="background:#4B5563;color:#9CA3AF">?</div>
              <div style="flex:1">
                <div style="font-size:0.85rem;font-weight:500">sarah.petit@gmail.com</div>
                <div style="font-size:0.72rem;color:var(--muted)">Invitée le 20 Fév. · Expire dans 5 jours</div>
              </div>
              <span class="status status-pending">En attente</span>
            </div>
            <div style="padding:10px 0">
              <button class="btn btn-ghost btn-sm" style="width:100%;justify-content:center" onclick="openModal('modal-invite')">+ Nouvelle invitation</button>
            </div>
          </div>
        </div>

        <!-- Quitter -->
        <div class="card fade-in" style="border-color:#FECACA">
          <div style="padding:20px">
            <div style="font-family:'Syne',sans-serif;font-weight:700;margin-bottom:6px;color:var(--charcoal)">⚠️ Zone de danger</div>
            <div style="font-size:0.8rem;color:var(--muted);margin-bottom:14px">En tant qu'Owner, annuler la colocation affectera tous les membres. Les soldes impactent les réputations.</div>
            <button class="btn btn-danger" style="width:100%;justify-content:center" onclick="openModal('modal-cancel')">🗑 Annuler la colocation</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>

<!-- Modal invite -->
<div class="modal-overlay" id="modal-invite">
  <div class="modal">
    <div class="modal-header"><div class="modal-title">📧 Inviter un membre</div><button class="close-btn" onclick="closeModal('modal-invite')">✕</button></div>
    <div class="modal-body">
      <div style="background:var(--cream);border-radius:12px;padding:16px;margin-bottom:20px">
        <div style="font-size:0.75rem;font-weight:600;margin-bottom:6px">Lien à partager</div>
        <div style="font-family:monospace;font-size:0.78rem;color:var(--muted);word-break:break-all;margin-bottom:10px">https://coloc.app/invite/tok_xK9mP2qL7nR4s8wF</div>
        <button class="btn btn-ghost btn-sm" onclick="showToast('Lien copié !','success')">📋 Copier</button>
      </div>
      <div style="text-align:center;color:var(--muted);font-size:0.8rem;margin:12px 0">— ou envoyez par email —</div>
      <div class="form-group"><label>Adresse email</label><input type="email" placeholder="colocataire@email.com"></div>
      <div class="form-group" style="margin-bottom:0"><label>Message (optionnel)</label><textarea placeholder="Bonjour ! Je t'invite à rejoindre notre colocation…" rows="3"></textarea></div>
    </div>
    <div class="modal-footer">
      <button class="btn btn-ghost" onclick="closeModal('modal-invite')">Annuler</button>
      <button class="btn btn-primary" onclick="closeModal('modal-invite');showToast('Invitation envoyée !','success')">Envoyer</button>
    </div>
  </div>
</div>

<!-- Modal cancel -->
<div class="modal-overlay" id="modal-cancel">
  <div class="modal">
    <div class="modal-header"><div class="modal-title" style="color:var(--red)">⚠️ Annuler la colocation</div><button class="close-btn" onclick="closeModal('modal-cancel')">✕</button></div>
    <div class="modal-body">
      <div style="background:#FEF2F2;border:1px solid #FECACA;border-radius:12px;padding:16px;margin-bottom:20px">
        <div style="font-weight:600;color:var(--red);margin-bottom:6px">Action irréversible</div>
        <div style="font-size:0.85rem;color:#7F1D1D">Annuler la colocation <strong>"Les Goûters du Jeudi"</strong> affectera tous les membres selon leurs soldes actuels.</div>
      </div>
      <div style="font-size:0.85rem;color:var(--muted);margin-bottom:16px">
        Conséquences sur les réputations :
        <ul style="margin-top:8px;padding-left:18px;display:flex;flex-direction:column;gap:4px">
          <li>Tom Martin → <strong style="color:var(--red)">-1</strong> (dette 43,50€)</li>
          <li>Alex Bernard → <strong style="color:var(--red)">-1</strong> (dette 37,00€)</li>
          <li>Léa Dubois → <strong style="color:var(--sage-dark)">+1</strong></li>
          <li>Marie Audrey → inchangée</li>
        </ul>
      </div>
      <div class="form-group" style="margin-bottom:0"><label>Tapez <strong>ANNULER</strong> pour confirmer</label><input type="text" placeholder="ANNULER"></div>
    </div>
    <div class="modal-footer">
      <button class="btn btn-ghost" onclick="closeModal('modal-cancel')">Retour</button>
      <button class="btn btn-danger" onclick="closeModal('modal-cancel');showToast('Colocation annulée','error')">Confirmer</button>
    </div>
  </div>
</div>

<div class="toast-container" id="toasts"></div>
<script>
  function openModal(id){document.getElementById(id).classList.add('open')}
  function closeModal(id){document.getElementById(id).classList.remove('open')}
  document.querySelectorAll('.modal-overlay').forEach(o=>o.addEventListener('click',e=>{if(e.target===o)o.classList.remove('open')}))
  function showToast(msg,type='success'){const c=document.getElementById('toasts'),t=document.createElement('div');t.className=`toast ${type}`;t.innerHTML=`<span>${type==='success'?'✓':'✕'}</span><span>${msg}</span>`;c.appendChild(t);setTimeout(()=>{t.style.opacity='0';t.style.transition='opacity 0.3s';setTimeout(()=>t.remove(),300)},3500)}
</script>
</body>
</html>
