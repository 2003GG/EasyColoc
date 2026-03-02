<aside class="sidebar">
  <div class="sidebar-logo">Co<span>Loc</span></div>
  <nav class="sidebar-nav">
    <div class="nav-section">
      <span class="nav-label">Navigation</span>
      @if(auth()->user()->role_id==2)
      <a href="{{ route('dashboard') }}" class="nav-item"><svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/></svg>Tableau de bord</a>

      <a href="{{ route('colocation.index') }}" class="nav-item"><svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>Ma Colocation</a>
      <a href="{{ route('depense.store') }}" class="nav-item"><svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 100 7h5a3.5 3.5 0 110 7H6"/></svg>Dépenses</a>
      <!-- <a href="balances.html" class="nav-item"><svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><line x1="3" y1="6" x2="21" y2="6"/><path d="M3 6l9 6 9-6"/><line x1="3" y1="18" x2="21" y2="18"/></svg>Balances</a> -->
      <a href="{{route('invitation.index')}}" class="nav-item"><svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>Invitations <span class="nav-badge">2</span></a>
    </div>
    @else
    @endif
    <div class="nav-section">
      <span class="nav-label">Administration</span>
      @if(auth()->user()->role_id==2)
             <a href="{{ route('categorie.index') }}" class="nav-item"><svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="5" cy="6" r="2"/><circle cx="5" cy="12" r="2"/><circle cx="5" cy="18" r="2"/><line x1="10" y1="6" x2="20" y2="6"/><line x1="10" y1="12" x2="20" y2="12"/><line x1="10" y1="18" x2="20" y2="18"/></svg>Catégories</a>

      @else
      <a href="{{route('users.index')}}" class="nav-item active"><svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="3"/><path d="M19.07 4.93a10 10 0 010 14.14M4.93 4.93a10 10 0 000 14.14"/></svg>Dashboard Admin</a>

       @endif

       <form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit" class="nav-item" style="width:100%; background:none; border:none; cursor:pointer; text-align:left;">
        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4"/>
            <polyline points="16 17 21 12 16 7"/>
            <line x1="21" y1="12" x2="9" y2="12"/>
        </svg>
        Se déconnecter
    </button>
</form>
    </div>
  </nav>
  <div class="sidebar-footer"><div class="user-card"><div class="avatar avatar-sage">MA</div><div style="flex:1;min-width:0"><div style="font-size:0.8rem;font-weight:500;color:#E5E7EB">{{ auth()->user()->name }}</div><div style="font-size:0.65rem;color:var(--sage);font-weight:500">{{ auth()->user()->role->role }} ★★★★★</div></div></div></div>
</aside>
