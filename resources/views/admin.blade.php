<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>CoLoc — Administration</title>
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
  .avatar-red{background:var(--red);color:white}
  .main{margin-left:260px;min-height:100vh}
  .topbar{background:white;border-bottom:1px solid #F0EDE8;padding:0 32px;height:64px;display:flex;align-items:center;gap:16px;position:sticky;top:0;z-index:40}
  .topbar-title{font-family:'Syne',sans-serif;font-weight:700;font-size:1.1rem;color:var(--charcoal);flex:1}
  .topbar-actions{display:flex;align-items:center;gap:10px}
  .page{padding:32px}
  .btn{display:inline-flex;align-items:center;gap:8px;padding:9px 18px;border-radius:10px;font-size:0.8rem;font-weight:500;cursor:pointer;transition:all 0.15s;border:none;font-family:'DM Sans',sans-serif;white-space:nowrap}
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
  .stat-card{background:white;border-radius:16px;border:1px solid #F0EDE8;padding:24px;position:relative;overflow:hidden}
  .stat-card::before{content:'';position:absolute;top:0;right:0;width:80px;height:80px;border-radius:0 0 0 80px;opacity:0.08}
  .stat-card.green::before{background:var(--sage-dark)}.stat-card.orange::before{background:var(--accent)}.stat-card.gold::before{background:var(--gold)}.stat-card.red::before{background:var(--red)}
  .stat-label{font-size:0.75rem;font-weight:500;color:var(--muted);text-transform:uppercase;letter-spacing:0.06em;margin-bottom:8px}
  .stat-value{font-family:'Syne',sans-serif;font-weight:800;font-size:2rem;color:var(--charcoal);line-height:1;margin-bottom:4px}
  .stat-sub{font-size:0.75rem;color:var(--muted)}
  .stat-icon{position:absolute;top:20px;right:20px;width:36px;height:36px;border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:1rem}
  .stat-icon.green{background:#DCFCE7}.stat-icon.orange{background:#FEF3C7}.stat-icon.gold{background:#FEF9C3}.stat-icon.red{background:#FEF2F2}
  .role-badge{font-size:0.65rem;font-weight:600;padding:2px 8px;border-radius:20px;text-transform:uppercase;letter-spacing:0.05em}
  .role-owner{background:#FEF3C7;color:#92400E}
  .role-member{background:#EFF6FF;color:#1E40AF}
  .role-admin{background:#F5F3FF;color:#6D28D9}
  .rep{display:inline-flex;align-items:center;gap:4px;font-family:'Syne',sans-serif;font-weight:700;font-size:0.8rem}
  .rep.pos{color:var(--sage-dark)}.rep.neg{color:var(--red)}
  .status{display:inline-flex;align-items:center;gap:5px;font-size:0.7rem;font-weight:600;padding:3px 10px;border-radius:20px}
  .status::before{content:'';width:6px;height:6px;border-radius:50%;flex-shrink:0}
  .status-active{background:#DCFCE7;color:#15803D}.status-active::before{background:#22C55E}
  .status-cancelled{background:#F3F4F6;color:#6B7280}.status-cancelled::before{background:#9CA3AF}
  .status-banned{background:#FEF2F2;color:#DC2626}.status-banned::before{background:#EF4444}
  .admin-hl{background:linear-gradient(90deg,#F5F3FF 0%,transparent 40%)}
  table{width:100%;border-collapse:collapse}
  th{text-align:left;font-size:0.7rem;font-weight:600;text-transform:uppercase;letter-spacing:0.08em;color:var(--muted);padding:12px 16px;background:#F9FAFB;border-bottom:1px solid #F0EDE8}
  td{padding:14px 16px;font-size:0.875rem;border-bottom:1px solid #F5F0E8;vertical-align:middle}
  tr:last-child td{border-bottom:none}
  tr:hover td{background:#FAFAF7}
  .notif-dot{width:8px;height:8px;border-radius:50%;flex-shrink:0;display:inline-block}
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
@include('header');

<main class="main">
  <div class="topbar">
    <div class="topbar-title">Administration Globale</div>
    <div class="topbar-actions">
      <span class="role-badge role-admin" style="font-size:0.7rem;padding:4px 12px">🛡 Global Admin</span>
    </div>
  </div>

  <div class="page">
    <!-- Global stats -->
    <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:16px;margin-bottom:28px">
      <div class="stat-card green fade-in fade-in-1"><div class="stat-icon green">🏠</div><div class="stat-label">Colocations</div><div class="stat-value">47</div><div class="stat-sub">12 actives ce mois</div></div>
      <div class="stat-card orange fade-in fade-in-2"><div class="stat-icon orange">👤</div><div class="stat-label">Utilisateurs</div><div class="stat-value">183</div><div class="stat-sub">+8 cette semaine</div></div>
      <div class="stat-card gold fade-in fade-in-3"><div class="stat-icon gold">💰</div><div class="stat-label">Dépenses totales</div><div class="stat-value">94 K€</div><div class="stat-sub">Toute la plateforme</div></div>
      <div class="stat-card red fade-in fade-in-4"><div class="stat-icon red">🚫</div><div class="stat-label">Bannis</div><div class="stat-value">3</div><div class="stat-sub">Utilisateurs désactivés</div></div>
    </div>

    <div style="display:grid;grid-template-columns:1.6fr 1fr;gap:20px">
      <!-- Users table -->
      <div class="card">
        <div class="card-header">
          <div class="card-title">Gestion utilisateurs</div>
          <div style="display:flex;gap:8px;align-items:center">
            <input placeholder="Rechercher…" style="width:150px;padding:6px 12px;font-size:0.8rem;border-radius:8px;border:1.5px solid #E5E7EB;outline:none">
          </div>
        </div>
        <table>
         @foreach ($users as $user)
<tr class="border-b border-gray-100 hover:bg-gray-50 transition-colors duration-150">

    <td class="px-6 py-4 whitespace-nowrap">
        <div class="flex items-center gap-3">

            <span class="text-sm font-medium text-gray-900">{{ $user->name }}</span>
        </div>
    </td>

    <td class="px-6 py-4 whitespace-nowrap">
        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">
            {{ $user->role->role }}
        </span>
    </td>

    <td class="px-6 py-4 whitespace-nowrap">
        <div class="flex items-center gap-1 text-sm">
            <span class="text-yellow-400">★</span>
            <span class="text-gray-700 font-medium">{{ $user->note }}</span>
        </div>
    </td>



    <td class="px-6 py-4 whitespace-nowrap">
        @if($user->condition == 'notbanne')
        <form action="{{ route('user.banne',$user) }}" method="POST">
        @csrf
         @method('put')
            <button type="submit" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-semibold bg-red-50 text-red-500 border border-red-200 hover:bg-red-500 hover:text-white hover:border-red-500 transition-all duration-200 cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"/><line x1="4.93" y1="4.93" x2="19.07" y2="19.07"/>
                </svg>
                Bannir
            </button>
            </form>
        @else
            <form action="{{ route('user.Inbannie',$user) }}" method="POST">
                @csrf
                @method('put')
                <button type="submit"  class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-semibold bg-green-50 text-green-500 border border-green-200 hover:bg-green-500 hover:text-white hover:border-green-500 transition-all duration-200 cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20 6L9 17l-5-5"/>
                    </svg>
                    Débannir
                </button>
            </form>
        @endif
    </td>

</tr>
@endforeach
        </table>
      </div>

      <!-- Right -->
      <div style="display:flex;flex-direction:column;gap:16px">
        <div class="card">
          <div class="card-header"><div class="card-title">Colocations</div></div>
          <div style="padding:8px 20px">
            <div style="display:flex;align-items:center;justify-content:space-between;padding:12px 0;border-bottom:1px solid #F5F0E8">
              <div><div style="font-size:0.85rem;font-weight:600">colocation</div><div style="font-size:0.72rem;color:var(--muted)">4 membres · Owner: Marie A.</div></div>
            <span class="status status-active">status</span>
            </div>

          </div>
        </div>


      </div>
    </div>
  </div>
</main>
<div class="toast-container" id="toasts"></div>

</body>
</html>
