<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Access Denied</title>
  <link href="https://fonts.googleapis.com/css2?family=Space+Mono:wght@400;700&family=Syne:wght@400;600;800&display=swap" rel="stylesheet"/>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    * { font-family: 'Syne', sans-serif; }

    @keyframes scanline {
      0% { transform: translateY(-100%); }
      100% { transform: translateY(100vh); }
    }
    @keyframes blink {
      0%, 100% { opacity: 1; }
      50% { opacity: 0; }
    }
    @keyframes shake {
      0%, 100% { transform: translateX(0); }
      20% { transform: translateX(-6px); }
      40% { transform: translateX(6px); }
      60% { transform: translateX(-4px); }
      80% { transform: translateX(4px); }
    }
    @keyframes float {
      0%, 100% { transform: translateY(0px); }
      50% { transform: translateY(-12px); }
    }
    @keyframes glitch {
      0% { clip-path: inset(0 0 98% 0); transform: translateX(-4px); }
      10% { clip-path: inset(30% 0 50% 0); transform: translateX(4px); }
      20% { clip-path: inset(70% 0 10% 0); transform: translateX(-2px); }
      30%, 100% { clip-path: inset(0 0 0 0); transform: translateX(0); }
    }
    @keyframes fadeUp {
      from { opacity: 0; transform: translateY(24px); }
      to { opacity: 1; transform: translateY(0); }
    }
    @keyframes pulse-ring {
      0% { transform: scale(0.8); opacity: 1; }
      100% { transform: scale(2); opacity: 0; }
    }

    /* Breeze shimmer sweep */
    @keyframes breeze-sweep {
      0%   { transform: translateX(-120%) skewX(-15deg); }
      100% { transform: translateX(220%) skewX(-15deg); }
    }
    /* Arrow drift on hover */
    @keyframes arrow-drift {
      0%, 100% { transform: translateX(0); opacity: 0.7; }
      50%       { transform: translateX(5px); opacity: 1; }
    }
    /* Wind lines appear */
    @keyframes wind-line {
      0%, 100% { transform: scaleX(0); opacity: 0; }
      40%, 60% { transform: scaleX(1); opacity: 1; }
    }

    .scanline {
      pointer-events: none;
      position: fixed;
      inset: 0;
      z-index: 50;
      background: linear-gradient(transparent 50%, rgba(0,255,80,0.03) 50%);
      background-size: 100% 4px;
    }
    .scanline::after {
      content: '';
      position: absolute;
      left: 0; right: 0; height: 80px;
      background: linear-gradient(to bottom, transparent, rgba(0,255,80,0.06), transparent);
      animation: scanline 4s linear infinite;
    }
    .glitch-text::before {
      content: attr(data-text);
      position: absolute;
      left: 0; top: 0;
      color: #22c55e;
      animation: glitch 3s infinite;
    }
    .float-icon  { animation: float 3s ease-in-out infinite; }
    .blink       { animation: blink 1.2s step-end infinite; }
    .fade-up     { animation: fadeUp 0.7s ease forwards; }
    .card-shake  { animation: shake 0.5s ease 1s both; }
    .card-glow {
      box-shadow: 0 0 0 1px rgba(34,197,94,0.3),
                  0 0 40px rgba(34,197,94,0.12),
                  0 20px 60px rgba(0,0,0,0.3);
    }
    .pulse-ring {
      position: absolute; inset: -12px; border-radius: 9999px;
      border: 2px solid rgba(34,197,94,0.4);
      animation: pulse-ring 2s ease-out infinite;
    }
    .grid-bg {
      background-image:
        linear-gradient(rgba(34,197,94,0.06) 1px, transparent 1px),
        linear-gradient(90deg, rgba(34,197,94,0.06) 1px, transparent 1px);
      background-size: 40px 40px;
    }

    /* ── Breeze Logout Button ── */
    .btn-logout {
      position: relative;
      overflow: hidden;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
      width: 100%;
      padding: 14px 24px;
      border-radius: 12px;
      background: rgba(255,255,255,0.04);
      border: 1px solid rgba(255,255,255,0.18);
      color: #fff;
      font-family: 'Syne', sans-serif;
      font-weight: 700;
      font-size: 14px;
      letter-spacing: 0.05em;
      cursor: pointer;
      text-decoration: none;
      transition: border-color 0.3s, background 0.3s, box-shadow 0.3s, transform 0.15s;
    }
    .btn-logout:hover {
      border-color: rgba(255,255,255,0.45);
      background: rgba(255,255,255,0.09);
      box-shadow: 0 0 22px rgba(255,255,255,0.07);
    }
    .btn-logout:active { transform: scale(0.97); }

    /* Shimmer breeze sweep */
    .btn-logout::before {
      content: '';
      position: absolute;
      top: 0; left: 0;
      width: 50%; height: 100%;
      background: linear-gradient(
        90deg,
        transparent 0%,
        rgba(255,255,255,0.12) 50%,
        transparent 100%
      );
      transform: translateX(-120%) skewX(-15deg);
      transition: none;
    }
    .btn-logout:hover::before {
      animation: breeze-sweep 0.55s ease forwards;
    }

    /* Wind lines on the left */
    .btn-logout .wind-lines {
      position: absolute;
      left: 14px;
      display: flex;
      flex-direction: column;
      gap: 3px;
      opacity: 0;
      transition: opacity 0.3s;
    }
    .btn-logout:hover .wind-lines { opacity: 1; }
    .btn-logout .wind-lines span {
      display: block;
      height: 1.5px;
      background: rgba(255,255,255,0.5);
      border-radius: 9px;
      transform-origin: left;
      animation: wind-line 0.6s ease infinite;
    }
    .btn-logout .wind-lines span:nth-child(1) { width: 12px; animation-delay: 0s; }
    .btn-logout .wind-lines span:nth-child(2) { width: 8px;  animation-delay: 0.1s; margin-left: 3px; }
    .btn-logout .wind-lines span:nth-child(3) { width: 12px; animation-delay: 0.2s; }

    /* Arrow icon drift */
    .btn-logout .logout-arrow {
      transition: color 0.3s;
    }
    .btn-logout:hover .logout-arrow {
      animation: arrow-drift 0.6s ease infinite;
      color: #fff;
    }
  </style>
</head>
<body class="bg-neutral-950 min-h-screen flex items-center justify-center overflow-hidden grid-bg">

  <div class="scanline"></div>

  <div class="fixed inset-0 pointer-events-none">
    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[600px] h-[300px] bg-green-500/5 rounded-full blur-3xl"></div>
    <div class="absolute bottom-0 left-0 w-72 h-72 bg-green-900/20 rounded-full blur-3xl"></div>
    <div class="absolute top-20 right-10 w-40 h-40 bg-green-500/10 rounded-full blur-2xl"></div>
  </div>

  <div class="fixed top-0 left-0 w-24 h-24 border-l-2 border-t-2 border-green-500/30"></div>
  <div class="fixed top-0 right-0 w-24 h-24 border-r-2 border-t-2 border-green-500/30"></div>
  <div class="fixed bottom-0 left-0 w-24 h-24 border-l-2 border-b-2 border-green-500/30"></div>
  <div class="fixed bottom-0 right-0 w-24 h-24 border-r-2 border-b-2 border-green-500/30"></div>

  <div class="relative z-10 w-full max-w-lg mx-4">

    <div class="fade-up flex items-center justify-center gap-3 mb-6" style="animation-delay:0.1s;opacity:0">
      <div class="h-px flex-1 bg-gradient-to-r from-transparent to-green-500/50"></div>
      <span class="text-green-500/70 text-xs tracking-[0.3em] uppercase" style="font-family:'Space Mono',monospace">System Alert</span>
      <div class="h-px flex-1 bg-gradient-to-l from-transparent to-green-500/50"></div>
    </div>

    <div class="card-glow card-shake bg-neutral-900/90 backdrop-blur-xl border border-green-500/20 rounded-2xl p-8 md:p-10 text-center">

      <div class="fade-up relative inline-flex items-center justify-center mb-8" style="animation-delay:0.2s;opacity:0">
        <div class="pulse-ring"></div>
        <div class="pulse-ring" style="animation-delay:0.6s"></div>
        <div class="relative w-20 h-20 rounded-full bg-green-500/10 border border-green-500/30 flex items-center justify-center float-icon">
          <svg class="w-9 h-9 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M18.364 18.364A9 9 0 0 0 5.636 5.636m12.728 12.728A9 9 0 0 1 5.636 5.636m12.728 12.728L5.636 5.636"/>
          </svg>
        </div>
      </div>

      <div class="fade-up mb-2" style="animation-delay:0.3s;opacity:0">
        <span class="text-green-500/50 text-xs tracking-widest uppercase" style="font-family:'Space Mono',monospace">ERR_403 &nbsp;·&nbsp; ACCESS_REVOKED</span>
      </div>

      <div class="fade-up relative mb-4" style="animation-delay:0.4s;opacity:0">
        <h1 class="glitch-text relative text-4xl md:text-5xl font-extrabold text-white tracking-tight" data-text="You're Banned">
          You're Banned
        </h1>
      </div>

      <div class="fade-up mb-8" style="animation-delay:0.5s;opacity:0">
        <p class="text-neutral-400 text-base leading-relaxed">
          Your account has been <span class="text-green-400 font-semibold">suspended</span> by an administrator.<br/>
          You no longer have access to this platform.
        </p>
      </div>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn-logout">
                <span class="wind-lines" aria-hidden="true">
                    <span></span><span></span><span></span>
                </span>
                <svg class="logout-arrow w-4 h-4 text-white/70" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15M18 15l3-3m0 0-3-3m3 3H9"/>
                </svg>
                Log Out
            </button>
        </form>

      <div class="fade-up mb-8" style="animation-delay:0.6s;opacity:0">
        <div class="bg-black/40 border border-green-500/15 rounded-xl p-5 text-left space-y-3" style="font-family:'Space Mono',monospace">
          <div class="flex justify-between items-center text-sm">
            <span class="text-neutral-500">User ID</span>
            <span class="text-green-400">#USR-84720</span>
          </div>
          <div class="h-px bg-green-500/10"></div>
          <div class="flex justify-between items-center text-sm">
            <span class="text-neutral-500">Banned on</span>
            <span class="text-white">Mar 02, 2026</span>
          </div>
          <div class="h-px bg-green-500/10"></div>
          <div class="flex justify-between items-center text-sm">
            <span class="text-neutral-500">Reason</span>
            <span class="text-red-400/80">Policy violation</span>
          </div>
          <div class="h-px bg-green-500/10"></div>
          <div class="flex justify-between items-center text-sm">
            <span class="text-neutral-500">Duration</span>
            <span class="text-yellow-400/80">Permanent</span>
          </div>
        </div>
      </div>

      <div class="fade-up space-y-3" style="animation-delay:0.7s;opacity:0">
        <a href="mailto:support@example.com"
          class="block w-full py-3.5 rounded-xl bg-green-500 hover:bg-green-400 text-black font-bold text-sm tracking-wide transition-all duration-200 hover:shadow-[0_0_24px_rgba(34,197,94,0.5)] active:scale-95 no-underline">
          Contact Support
        </a>
        <a href="#"
          class="block w-full py-3.5 rounded-xl border border-green-500/30 hover:border-green-500/60 text-green-400 font-semibold text-sm tracking-wide transition-all duration-200 hover:bg-green-500/5 active:scale-95 no-underline">
          Learn About Our Policies
        </a>

        <!-- 💨 Breeze Logout Button — pure CSS, zero JS -->

      </div>

    </div>

    <div class="fade-up flex items-center justify-center gap-2 mt-6" style="animation-delay:0.8s;opacity:0">
      <div class="w-1.5 h-1.5 rounded-full bg-green-500 blink"></div>
      <span class="text-neutral-600 text-xs" style="font-family:'Space Mono',monospace">admin.system.monitor &nbsp;·&nbsp; active</span>
    </div>
  </div>

</body>
</html>
