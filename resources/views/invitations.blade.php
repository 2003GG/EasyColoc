<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>CoLoc — Invitations</title>
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
  .btn-sm{padding:6px 12px;font-size:0.75rem;border-radius:8px}
  .card{background:white;border-radius:16px;border:1px solid #F0EDE8;overflow:hidden}
  .card-header{padding:20px 24px;border-bottom:1px solid #F5F0E8;display:flex;align-items:center;justify-content:space-between}
  .card-title{font-family:'Syne',sans-serif;font-weight:700;font-size:1rem;color:var(--charcoal)}
  .status{display:inline-flex;align-items:center;gap:5px;font-size:0.7rem;font-weight:600;padding:3px 10px;border-radius:20px}
  .status::before{content:'';width:6px;height:6px;border-radius:50%;flex-shrink:0}
  .status-active{background:#DCFCE7;color:#15803D}
  .status-active::before{background:#22C55E}
  .status-cancelled{background:#F3F4F6;color:#6B7280}
  .status-cancelled::before{background:#9CA3AF}
  .status-pending{background:#FEF3C7;color:#B45309}
  .status-pending::before{background:#F59E0B}
  .section-title{font-family:'Syne',sans-serif;font-weight:700;font-size:1.1rem;color:var(--charcoal)}
  .section-sub{font-size:0.8rem;color:var(--muted);margin-top:2px}
  table{width:100%;border-collapse:collapse}
  th{text-align:left;font-size:0.7rem;font-weight:600;text-transform:uppercase;letter-spacing:0.08em;color:var(--muted);padding:12px 16px;background:#F9FAFB;border-bottom:1px solid #F0EDE8}
  td{padding:14px 16px;font-size:0.875rem;border-bottom:1px solid #F5F0E8;vertical-align:middle}
  tr:last-child td{border-bottom:none}
  tr:hover td{background:#FAFAF7}
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
  .toast.success{background:var(--sage-dark)}.toast.error{background:var(--red)}
  @keyframes slideUp{from{opacity:0;transform:translateY(20px)}to{opacity:1;transform:translateY(0)}}
</style>
</head>
<body>
@include('header');

<main class="main">
  <div class="topbar">
    <div class="topbar-title">Invitations</div>
    <div class="topbar-actions">
      <button class="btn btn-primary btn-sm" onclick="openModal('modal-invite')">
        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
        Inviter un membre
      </button>
    </div>
  </div>

  <div class="page">
    <!-- Received -->
    <div style="margin-bottom:12px">
      <div class="section-title">Invitations reçues</div>
      <div class="section-sub">Colocations qui vous ont invité</div>
    </div>
    <div style="display:grid;grid-template-columns:repeat(2,1fr);gap:16px;margin-bottom:32px">



      <div class="card" style="border-left:4px solid var(--accent)">


       @foreach(auth()->user()->receiver()->where('status','waiting')->get() as $userInvitation)

        <div style="padding:20px">
          <div style="display:flex;align-items:flex-start;justify-content:space-between;margin-bottom:10px">
            <div>
              <div style="font-family:'Syne',sans-serif;font-weight:700;font-size:1rem;margin-bottom:4px">{{ $userInvitation->colocation->name }}</div>
            </div>
            <span class="status status-pending"></span>
          </div>
          <div style="font-size:0.8rem;color:var(--muted);margin-bottom:16px">2 membres · Actif depuis 2 mois</div>
          <div style="display:flex;gap:8px">
            @if (auth()->user()->colocation_id==null)

            <form action="{{ route('accept.invitation',[$userInvitation,'colocationId'=>$userInvitation->colocation->id]) }}" method="POST">
                @csrf
                @method('PUT')
            <button type="submit" class="btn btn-sage btn-sm" style="flex:1" onclick="showToast('Impossible : vous êtes déjà dans une colocation active','error')">✓ Accepter</button>
            </form>
            <form action="{{ route('refuser.invitation',$userInvitation) }}" method="POST">
                @csrf
                @method('PUT')
            <button type="submit" class="btn btn-ghost btn-sm" style="flex:1" onclick="showToast('Invitation refusée','error')">✕ Refuser</button>
            </form>
            @else
        <div style="background:#FEF3C7;border:1px solid #F59E0B;color:#B45309;padding:14px 18px;border-radius:12px;font-size:0.85rem;display:flex;align-items:center;gap:10px;margin-bottom:24px">
            <span style="font-size:1.2rem">⚠️</span>
            <span>Vous êtes déjà membre de la colocation <strong>{{ auth()->user()->colocation->name }}</strong>. Vous ne pouvez pas accepter d'autres invitations.</span>
        </div>
             @endif
          </div>
        </div>

        @endforeach

      </div>
    </div>



    <div style="margin-bottom:16px">
      <div class="section-title">Invitations envoyées</div>
      <div class="section-sub">Depuis "Les Goûters du Jeudi"</div>
    </div>
    <div class="card">
      <table>
        <thead><tr><th>Colocation Name</th><th>Statut</tr></thead>
        <tbody>
        @foreach(auth()->user()->sender()->get() as $userInvitation)
          <tr>
            <td>{{ $userInvitation->colocation->name }}</td>

            @if($userInvitation->status == 'waiting')
                <td><span class="status status-pending">{{ $userInvitation->status }}</span></td>
            @elseif($userInvitation->status == 'accepted')
                <td><span class="status status-active">{{ $userInvitation->status }}</span></td>
            @else
                <td><span class="status status-cancelled">{{ $userInvitation->status }}</span></td>
            @endif

          </tr>
         @endforeach

        </tbody>
      </table>
    </div>
  </div>
</main>

<!-- Modal -->
<div class="modal-overlay" id="modal-invite">
    <form action="{{ route('invitation.send') }}" method="POST">
        @csrf
        @method('post')
  <div class="modal">
    <div class="modal-header"><div class="modal-title">📧 Inviter un membre</div><button class="close-btn" onclick="closeModal('modal-invite')">✕</button></div>
    <div class="modal-body">
      <div style="text-align:center;color:var(--muted);font-size:0.8rem;margin:12px 0">— ou envoyez par email —</div>
      <div class="form-group"><label>Adresse email</label><input type="email" name="email" placeholder="colocataire@email.com"></div>
    </div>
    <div class="modal-footer">
      <button class="btn btn-ghost" onclick="closeModal('modal-invite')">Annuler</button>
      <button type="submit" class="btn btn-primary" onclick="closeModal('modal-invite');showToast('Invitation envoyée !','success')">Envoyer</button>
    </div>
  </div>
  </form>
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
