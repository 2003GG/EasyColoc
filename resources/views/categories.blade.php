<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>CoLoc — Catégories</title>
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
  .btn-ghost{background:transparent;color:var(--muted);border:1px solid #E5E7EB}
  .btn-ghost:hover{background:#F9FAFB;color:var(--charcoal)}
  .btn-danger{background:#FEF2F2;color:var(--red);border:1px solid #FECACA}
  .btn-danger:hover{background:#FEE2E2}
  .btn-sm{padding:6px 12px;font-size:0.75rem;border-radius:8px}
  .progress-bar{height:6px;background:#F0EDE8;border-radius:10px;overflow:hidden}
  .progress-fill{height:100%;border-radius:10px;transition:width 0.5s}
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
  input:focus,select:focus{border-color:var(--sage-dark);box-shadow:0 0 0 3px rgba(74,122,74,0.1)}
  .toast-container{position:fixed;bottom:24px;right:24px;z-index:200;display:flex;flex-direction:column;gap:8px}
  .toast{background:var(--charcoal);color:white;padding:12px 18px;border-radius:12px;font-size:0.8rem;font-weight:500;display:flex;align-items:center;gap:10px;animation:slideUp 0.3s ease;box-shadow:0 8px 25px rgba(0,0,0,0.2);max-width:300px}
  .toast.success{background:var(--sage-dark)}.toast.error{background:var(--red)}
  @keyframes slideUp{from{opacity:0;transform:translateY(20px)}to{opacity:1;transform:translateY(0)}}
  @keyframes fadeInUp{from{opacity:0;transform:translateY(16px)}to{opacity:1;transform:translateY(0)}}
  .fade-in{animation:fadeInUp 0.4s ease both}
  .fade-in-1{animation-delay:0.05s}.fade-in-2{animation-delay:0.1s}.fade-in-3{animation-delay:0.15s}
</style>
</head>
<body>
@include('header')

@if(auth()->user()->status=='owner')
<main class="main">
  <div class="topbar">
    <div class="topbar-title">Catégories de dépenses</div>
    <div class="topbar-actions">
      <button class="btn btn-primary btn-sm" onclick="openModal('modal-cat')">
        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
        Nouvelle catégorie
      </button>
    </div>
  </div>

  <div class="page">
    <!-- Summary bar -->
    <div style="background:white;border:1px solid #F0EDE8;border-radius:16px;padding:20px 28px;margin-bottom:24px;display:flex;align-items:center;gap:32px" class="fade-in">
      <div><div style="font-size:0.75rem;color:var(--muted);margin-bottom:4px">Catégories actives</div><div style="font-family:'Syne',sans-serif;font-weight:800;font-size:1.4rem">5</div></div>
      <div style="width:1px;height:40px;background:#F0EDE8"></div>
      <div><div style="font-size:0.75rem;color:var(--muted);margin-bottom:4px">Total ce mois</div><div style="font-family:'Syne',sans-serif;font-weight:800;font-size:1.4rem">1 143,69 €</div></div>
      <div style="width:1px;height:40px;background:#F0EDE8"></div>
      <div style="flex:1">
        <div style="font-size:0.75rem;color:var(--muted);margin-bottom:8px">Répartition</div>
        <div style="display:flex;gap:4px;height:8px;border-radius:10px;overflow:hidden">
          <div style="width:70%;background:var(--sage-dark)"></div>
          <div style="width:12%;background:var(--accent)"></div>
          <div style="width:10%;background:var(--gold)"></div>
          <div style="width:5%;background:#8B5CF6"></div>
          <div style="flex:1;background:#3B82F6"></div>
        </div>
        <div style="display:flex;gap:16px;margin-top:6px;font-size:0.7rem;color:var(--muted)">
          <span style="display:flex;align-items:center;gap:4px"><span style="width:8px;height:8px;border-radius:50%;background:var(--sage-dark);display:inline-block"></span>Loyer 70%</span>
          <span style="display:flex;align-items:center;gap:4px"><span style="width:8px;height:8px;border-radius:50%;background:var(--accent);display:inline-block"></span>Factures 12%</span>
          <span style="display:flex;align-items:center;gap:4px"><span style="width:8px;height:8px;border-radius:50%;background:var(--gold);display:inline-block"></span>Courses 10%</span>
        </div>
      </div>
    </div>

    <!-- Category grid -->
    <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:16px">

        @foreach ($categories as $categorie)

      <div style="background:white;border:1px solid #F0EDE8;border-radius:16px;overflow:hidden" class="fade-in fade-in-1">
        <div style="padding:20px;display:flex;align-items:center;gap:14px">
          <div style="width:48px;height:48px;background:#FEF3C7;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;flex-shrink:0">🛒</div>
          <div style="flex:1">
            <div style="font-weight:600;font-size:0.9rem;margin-bottom:2px">{{$categorie->title}}</div>
            <div style="font-size:0.75rem;color:var(--muted)">6 dépenses ce mois</div>
          </div>
          <div style="display:flex;gap:6px">
            <button class="btn btn-ghost btn-sm" onclick="showToast('Mode édition','success')">✏️</button>
            <button class="btn btn-danger btn-sm" onclick="showToast('Catégorie supprimée','error')">✕</button>
          </div>
        </div>
        <div style="background:#F9FAFB;padding:12px 20px;border-top:1px solid #F0EDE8">
          <div style="display:flex;justify-content:space-between;font-size:0.75rem;margin-bottom:6px"><span style="color:var(--muted)">Total</span><span style="font-weight:700">368,90 €</span></div>
          <div class="progress-bar"><div class="progress-fill" style="width:32%;background:#D97706"></div></div>
        </div>
      </div>
      @endforeach

      <!-- Add new -->
      <div style="background:white;border:2px dashed #D1D5DB;border-radius:16px;display:flex;align-items:center;justify-content:center;min-height:130px;cursor:pointer;transition:border-color 0.15s" onclick="openModal('modal-cat')" onmouseover="this.style.borderColor='var(--sage-dark)'" onmouseout="this.style.borderColor='#D1D5DB'">
        <div style="text-align:center;color:var(--muted)">
          <div style="font-size:2rem;margin-bottom:6px">+</div>
          <div style="font-size:0.8rem;font-weight:500">Ajouter une catégorie</div>
        </div>
      </div>
    </div>
  </div>
</main>
@else

{{-- Restricted View --}}
<div class="min-h-screen bg-gray-50 flex items-center justify-center p-6">
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-10 max-w-md w-full text-center">
        <div class="w-16 h-16 bg-red-50 rounded-full flex items-center justify-center mx-auto mb-4 text-3xl">
            🔒
        </div>
        <h2 class="text-xl font-bold text-gray-800 mb-2">Accès restreint</h2>
        <p class="text-gray-500 text-sm leading-relaxed">
            Vous n'avez pas les autorisations nécessaires pour créer ou gérer des catégories de dépenses.
            Contactez le propriétaire de la colocation pour obtenir l'accès.
        </p>
        <div class="mt-6 inline-flex items-center gap-2 bg-gray-100 text-gray-500 text-xs font-medium px-4 py-2 rounded-full">
            <span class="w-2 h-2 rounded-full bg-gray-400"></span>
            Statut : Membre
        </div>
    </div>
</div>

@endif

<!-- Modal -->
<div class="modal-overlay" id="modal-cat">
    <form action="{{route('categorie.store')}}" method="POST">
        @csrf
        @method('post')
  <div class="modal">
    <div class="modal-header"><div class="modal-title">🏷️ Nouvelle catégorie</div><button class="close-btn" onclick="closeModal('modal-cat')">✕</button></div>
    <div class="modal-body">
      <div class="form-group"><label>Nom de la catégorie</label><input type="text" name="title" placeholder="Ex: Transport, Courses, Loisirs…"></div>

    </div>
    <div class="modal-footer">
      <button class="btn btn-ghost" onclick="closeModal('modal-cat')">Annuler</button>
      <button type="submit" class="btn btn-primary" onclick="closeModal('modal-cat');showToast('Catégorie créée !','success')">Créer</button>
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
  function selectColor(el,color){document.querySelectorAll('[onclick^="selectColor"]').forEach(e=>e.style.border='2px solid transparent');el.style.border='2px solid var(--charcoal)'}
</script>
</body>
</html>
