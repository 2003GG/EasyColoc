<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>CoLoc — Dépenses</title>

<script src="https://cdn.tailwindcss.com"></script>
<link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">

<style>
:root{
  --ocean:#0EA5E9;
  --ocean-light:#BAE6FD;
  --ocean-dark:#0369A1;
  --ocean-deep:#0C4A6E;
  --warm-white:#F8FAFC;
  --cream:#F0F9FF;
  --charcoal:#0F172A;
  --muted:#64748B;
  --accent:#38BDF8;
  --red:#EF4444;
  --gold:#F59E0B;
}

*{box-sizing:border-box;margin:0;padding:0}
body{
  font-family:'DM Sans',sans-serif;
  background:var(--warm-white);
  color:var(--charcoal);
  min-height:100vh
}

/* Sidebar */
.sidebar{
  background:var(--ocean-deep);
  width:260px;
  min-height:100vh;
  position:fixed;
  left:0;
  top:0;
  display:flex;
  flex-direction:column;
  z-index:50
}
.sidebar-logo{
  padding:28px 28px 0;
  font-family:'Syne',sans-serif;
  font-weight:800;
  font-size:1.5rem;
  color:white;
}
.sidebar-logo span{color:var(--accent)}

.sidebar-nav{padding:32px 16px;flex:1}
.nav-label{
  font-size:0.65rem;
  font-weight:600;
  letter-spacing:0.12em;
  text-transform:uppercase;
  color:#93C5FD;
  padding:0 12px;
  margin-bottom:6px;
  display:block
}
.nav-item{
  display:flex;
  align-items:center;
  gap:12px;
  padding:10px 12px;
  border-radius:10px;
  color:#BFDBFE;
  font-size:0.875rem;
  cursor:pointer;
  transition:all 0.15s;
  margin-bottom:2px;
  text-decoration:none
}
.nav-item:hover{
  background:rgba(255,255,255,0.08);
  color:white
}
.nav-item.active{
  background:var(--ocean-dark);
  color:white
}
.nav-badge{
  margin-left:auto;
  background:var(--accent);
  color:white;
  font-size:0.65rem;
  font-weight:700;
  padding:2px 6px;
  border-radius:20px
}

/* Main */
.main{margin-left:260px;min-height:100vh}
.topbar{
  background:white;
  border-bottom:1px solid #E2E8F0;
  padding:0 32px;
  height:64px;
  display:flex;
  align-items:center;
  gap:16px;
  position:sticky;
  top:0;
  z-index:40
}
.topbar-title{
  font-family:'Syne',sans-serif;
  font-weight:700;
  font-size:1.1rem;
  flex:1
}

/* Buttons */
.btn{
  display:inline-flex;
  align-items:center;
  gap:8px;
  padding:9px 18px;
  border-radius:10px;
  font-size:0.8rem;
  font-weight:500;
  cursor:pointer;
  border:none
}
.btn-primary{background:var(--ocean-dark);color:white}
.btn-sage{background:var(--ocean);color:white}
.btn-danger{
  background:#FEE2E2;
  color:var(--red);
  border:1px solid #FCA5A5
}
.btn-sm{padding:6px 12px;font-size:0.75rem}

/* Cards */
.card{
  background:white;
  border-radius:16px;
  border:1px solid #E2E8F0;
  overflow:hidden
}
.card-header{
  padding:20px 24px;
  border-bottom:1px solid #F1F5F9;
  display:flex;
  align-items:center;
  justify-content:space-between
}
.card-title{
  font-family:'Syne',sans-serif;
  font-weight:700;
  font-size:1rem
}
.card-body{padding:24px}

/* Pills */
.pill{
  padding:6px 14px;
  border-radius:20px;
  font-size:0.75rem;
  cursor:pointer;
  border:1.5px solid #CBD5E1;
  background:white;
  color:var(--muted)
}
.pill:hover{
  border-color:var(--ocean-dark);
  color:var(--ocean-dark)
}
.pill.active{
  background:var(--ocean-dark);
  border-color:var(--ocean-dark);
  color:white
}

/* Progress */
.progress-bar{
  height:6px;
  background:#E2E8F0;
  border-radius:10px;
  overflow:hidden
}
.progress-fill{
  height:100%;
  border-radius:10px;
  background:var(--ocean)
}

/* Modal */
.modal-overlay{
  position:fixed;
  inset:0;
  background:rgba(0,0,0,0.5);
  display:flex;
  align-items:center;
  justify-content:center;
  opacity:0;
  pointer-events:none;
  transition:opacity 0.2s
}
.modal-overlay.open{opacity:1;pointer-events:all}
.modal{
  background:white;
  border-radius:20px;
  width:100%;
  max-width:480px;
  transform:translateY(20px);
  transition:0.2s
}
.modal-overlay.open .modal{transform:translateY(0)}
.modal-header{
  padding:24px 28px 20px;
  border-bottom:1px solid #E2E8F0;
  display:flex;
  justify-content:space-between
}
.modal-body{padding:24px 28px}
.modal-footer{
  padding:16px 28px 24px;
  display:flex;
  gap:10px;
  justify-content:flex-end
}

/* Toast */
.toast-container{
  position:fixed;
  bottom:24px;
  right:24px;
  display:flex;
  flex-direction:column;
  gap:8px
}
.toast{
  background:var(--ocean-dark);
  color:white;
  padding:12px 18px;
  border-radius:12px;
  font-size:0.8rem
}
</style>
</head>
<body>



<script>
function openModal(id){document.getElementById(id).classList.add('open')}
function closeModal(id){document.getElementById(id).classList.remove('open')}
function showToast(msg){
  const c=document.querySelector('.toast-container');
  const t=document.createElement('div');
  t.className='toast';
  t.innerText=msg;
  c.appendChild(t);
  setTimeout(()=>t.remove(),3000)
}
function setPill(el){
  document.querySelectorAll('.pill').forEach(p=>p.classList.remove('active'));
  el.classList.add('active')
}
</script>

</body>
</html>
