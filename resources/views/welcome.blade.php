<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Coloc — Find Your Perfect Flatmate</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=playfair-display:400,700,900i|dm-sans:300,400,500" rel="stylesheet" />

        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif

        <style>
            :root {
                --green-deep:   #0a2e1a;
                --green-mid:    #16522e;
                --green-fresh:  #22c55e;
                --green-light:  #86efac;
                --green-pale:   #dcfce7;
                --cream:        #faf9f5;
                --ink:          #0f1a13;
                --muted:        #4a6355;
            }

            *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

            body {
                font-family: 'DM Sans', sans-serif;
                background: var(--cream);
                color: var(--ink);
                min-height: 100vh;
                overflow-x: hidden;
            }

            /* ── NAV ── */
            nav {
                position: fixed;
                top: 0; left: 0; right: 0;
                z-index: 100;
                display: flex;
                align-items: center;
                justify-content: space-between;
                padding: 1.25rem 3rem;
                background: rgba(250,249,245,.85);
                backdrop-filter: blur(12px);
                border-bottom: 1px solid rgba(34,197,94,.15);
            }

            .logo {
                font-family: 'Playfair Display', serif;
                font-size: 1.75rem;
                font-weight: 900;
                color: var(--green-deep);
                letter-spacing: -.02em;
                text-decoration: none;
            }
            .logo span { color: var(--green-fresh); }

            .nav-links { display: flex; align-items: center; gap: 1rem; }

            .btn-ghost {
                font-family: 'DM Sans', sans-serif;
                font-size: .875rem;
                font-weight: 500;
                color: var(--green-mid);
                text-decoration: none;
                padding: .5rem 1.25rem;
                border-radius: 999px;
                border: 1.5px solid transparent;
                transition: border-color .2s, background .2s;
            }
            .btn-ghost:hover {
                border-color: var(--green-fresh);
                background: var(--green-pale);
            }

            .btn-solid {
                font-family: 'DM Sans', sans-serif;
                font-size: .875rem;
                font-weight: 500;
                color: #fff;
                text-decoration: none;
                padding: .5rem 1.5rem;
                border-radius: 999px;
                background: var(--green-mid);
                border: 1.5px solid var(--green-mid);
                transition: background .2s, transform .15s;
            }
            .btn-solid:hover { background: var(--green-deep); transform: translateY(-1px); }

            /* ── HERO ── */
            .hero {
                min-height: 100vh;
                display: grid;
                grid-template-columns: 1fr 1fr;
                align-items: center;
                gap: 4rem;
                padding: 8rem 3rem 4rem;
                position: relative;
                overflow: hidden;
            }

            /* background blobs */
            .hero::before {
                content: '';
                position: absolute;
                top: -10%; right: -5%;
                width: 55vw; height: 55vw;
                border-radius: 50%;
                background: radial-gradient(circle, #bbf7d080 0%, transparent 70%);
                pointer-events: none;
            }
            .hero::after {
                content: '';
                position: absolute;
                bottom: -15%; left: -10%;
                width: 40vw; height: 40vw;
                border-radius: 50%;
                background: radial-gradient(circle, #dcfce780 0%, transparent 70%);
                pointer-events: none;
            }

            .hero-text { position: relative; z-index: 2; }

            .hero-tag {
                display: inline-flex;
                align-items: center;
                gap: .5rem;
                font-size: .8rem;
                font-weight: 500;
                letter-spacing: .1em;
                text-transform: uppercase;
                color: var(--green-mid);
                background: var(--green-pale);
                padding: .35rem .9rem;
                border-radius: 999px;
                border: 1px solid #bbf7d0;
                margin-bottom: 1.5rem;
                animation: fadeUp .6s ease both;
            }
            .hero-tag::before {
                content: '';
                width: 6px; height: 6px;
                border-radius: 50%;
                background: var(--green-fresh);
            }

            h1 {
                font-family: 'Playfair Display', serif;
                font-size: clamp(2.8rem, 5vw, 4.5rem);
                font-weight: 900;
                line-height: 1.08;
                color: var(--green-deep);
                letter-spacing: -.03em;
                margin-bottom: 1.5rem;
                animation: fadeUp .6s .1s ease both;
            }
            h1 em {
                font-style: italic;
                color: var(--green-fresh);
            }

            .hero-desc {
                font-size: 1.1rem;
                font-weight: 300;
                line-height: 1.75;
                color: var(--muted);
                max-width: 42ch;
                margin-bottom: 2.5rem;
                animation: fadeUp .6s .2s ease both;
            }

            .hero-cta {
                display: flex;
                align-items: center;
                gap: 1rem;
                flex-wrap: wrap;
                animation: fadeUp .6s .3s ease both;
            }

            .cta-primary {
                display: inline-flex;
                align-items: center;
                gap: .6rem;
                font-family: 'DM Sans', sans-serif;
                font-size: 1rem;
                font-weight: 500;
                color: #fff;
                text-decoration: none;
                padding: .85rem 2rem;
                border-radius: 999px;
                background: var(--green-mid);
                box-shadow: 0 4px 24px rgba(22,82,46,.25);
                transition: background .2s, transform .15s, box-shadow .2s;
            }
            .cta-primary:hover {
                background: var(--green-deep);
                transform: translateY(-2px);
                box-shadow: 0 8px 32px rgba(22,82,46,.35);
            }
            .cta-primary svg { transition: transform .2s; }
            .cta-primary:hover svg { transform: translateX(3px); }

            .cta-secondary {
                font-family: 'DM Sans', sans-serif;
                font-size: 1rem;
                font-weight: 400;
                color: var(--green-mid);
                text-decoration: none;
                padding: .85rem 1.5rem;
                border-radius: 999px;
                border: 1.5px solid #bbf7d0;
                transition: border-color .2s, background .2s;
            }
            .cta-secondary:hover {
                border-color: var(--green-fresh);
                background: var(--green-pale);
            }

            /* ── HERO VISUAL ── */
            .hero-visual {
                position: relative;
                z-index: 2;
                animation: fadeUp .6s .2s ease both;
            }

            .card-stack {
                position: relative;
                width: 100%;
                max-width: 440px;
                margin: 0 auto;
            }

            .card-back {
                position: absolute;
                top: -16px; left: 16px; right: -16px;
                height: 100%;
                background: var(--green-light);
                border-radius: 24px;
                opacity: .4;
            }

            .card-main {
                background: var(--green-deep);
                border-radius: 24px;
                padding: 2.5rem;
                color: #fff;
                position: relative;
                overflow: hidden;
                box-shadow: 0 24px 64px rgba(10,46,26,.3);
            }
            .card-main::before {
                content: '';
                position: absolute;
                top: -40%; right: -20%;
                width: 320px; height: 320px;
                border-radius: 50%;
                background: radial-gradient(circle, rgba(34,197,94,.2) 0%, transparent 70%);
            }

            .card-avatar-row {
                display: flex;
                align-items: center;
                gap: .75rem;
                margin-bottom: 1.75rem;
            }
            .avatar {
                width: 48px; height: 48px;
                border-radius: 50%;
                background: var(--green-mid);
                display: flex; align-items: center; justify-content: center;
                font-size: 1.25rem;
                font-weight: 700;
                flex-shrink: 0;
                border: 2px solid rgba(134,239,172,.3);
            }
            .card-name { font-weight: 500; font-size: 1rem; }
            .card-sub { font-size: .8rem; color: var(--green-light); opacity: .8; }

            .card-listing-title {
                font-family: 'Playfair Display', serif;
                font-size: 1.5rem;
                font-weight: 700;
                margin-bottom: .5rem;
            }
            .card-location {
                font-size: .85rem;
                color: var(--green-light);
                opacity: .8;
                margin-bottom: 1.5rem;
                display: flex; align-items: center; gap: .3rem;
            }

            .card-tags {
                display: flex; gap: .5rem; flex-wrap: wrap;
                margin-bottom: 1.75rem;
            }
            .tag {
                font-size: .75rem;
                padding: .3rem .75rem;
                border-radius: 999px;
                background: rgba(134,239,172,.12);
                border: 1px solid rgba(134,239,172,.2);
                color: var(--green-light);
            }

            .card-price-row {
                display: flex;
                align-items: center;
                justify-content: space-between;
            }
            .card-price {
                font-family: 'Playfair Display', serif;
                font-size: 2rem;
                font-weight: 700;
            }
            .card-price span { font-size: 1rem; opacity: .6; font-family: 'DM Sans', sans-serif; }

            .card-btn {
                font-size: .85rem;
                font-weight: 500;
                padding: .6rem 1.25rem;
                border-radius: 999px;
                background: var(--green-fresh);
                color: var(--green-deep);
                border: none;
                cursor: pointer;
                transition: background .2s;
            }
            .card-btn:hover { background: var(--green-light); }

            /* floating badge */
            .badge-float {
                position: absolute;
                bottom: -20px; left: -20px;
                background: #fff;
                border-radius: 16px;
                padding: .85rem 1.25rem;
                box-shadow: 0 8px 32px rgba(0,0,0,.1);
                display: flex;
                align-items: center;
                gap: .75rem;
                z-index: 3;
            }
            .badge-icon {
                width: 40px; height: 40px;
                border-radius: 12px;
                background: var(--green-pale);
                display: flex; align-items: center; justify-content: center;
                font-size: 1.2rem;
            }
            .badge-label { font-size: .8rem; color: var(--muted); }
            .badge-value { font-size: 1rem; font-weight: 600; color: var(--green-deep); }

            /* ── FEATURES ── */
            .features {
                padding: 6rem 3rem;
                background: var(--green-deep);
                position: relative;
                overflow: hidden;
            }
            .features::before {
                content: '';
                position: absolute;
                top: -30%; right: -10%;
                width: 50vw; height: 50vw;
                border-radius: 50%;
                background: radial-gradient(circle, rgba(34,197,94,.08) 0%, transparent 70%);
            }

            .section-label {
                font-size: .75rem;
                letter-spacing: .15em;
                text-transform: uppercase;
                color: var(--green-fresh);
                font-weight: 500;
                margin-bottom: 1rem;
            }

            .features h2 {
                font-family: 'Playfair Display', serif;
                font-size: clamp(2rem, 3.5vw, 3rem);
                font-weight: 900;
                color: #fff;
                letter-spacing: -.02em;
                max-width: 20ch;
                margin-bottom: 4rem;
            }

            .features-grid {
                display: grid;
                grid-template-columns: repeat(3, 1fr);
                gap: 1.5rem;
                position: relative; z-index: 2;
            }

            .feature-card {
                background: rgba(255,255,255,.04);
                border: 1px solid rgba(134,239,172,.1);
                border-radius: 20px;
                padding: 2rem;
                transition: background .2s, transform .2s;
            }
            .feature-card:hover {
                background: rgba(255,255,255,.08);
                transform: translateY(-4px);
            }
            .feature-icon {
                font-size: 2rem;
                margin-bottom: 1.25rem;
            }
            .feature-card h3 {
                font-family: 'Playfair Display', serif;
                font-size: 1.2rem;
                font-weight: 700;
                color: #fff;
                margin-bottom: .6rem;
            }
            .feature-card p {
                font-size: .9rem;
                line-height: 1.7;
                color: rgba(134,239,172,.65);
                font-weight: 300;
            }

            /* ── CTA STRIP ── */
            .cta-strip {
                padding: 6rem 3rem;
                display: flex;
                flex-direction: column;
                align-items: center;
                text-align: center;
                background: var(--cream);
                position: relative;
            }
            .cta-strip::before {
                content: '';
                position: absolute;
                inset: 0;
                background: radial-gradient(ellipse 60% 50% at 50% 100%, #dcfce7 0%, transparent 70%);
            }

            .cta-strip h2 {
                font-family: 'Playfair Display', serif;
                font-size: clamp(2.2rem, 4vw, 3.5rem);
                font-weight: 900;
                color: var(--green-deep);
                letter-spacing: -.03em;
                max-width: 18ch;
                margin-bottom: 1rem;
                position: relative;
            }
            .cta-strip p {
                font-size: 1.05rem;
                color: var(--muted);
                font-weight: 300;
                margin-bottom: 2.5rem;
                position: relative;
            }
            .cta-strip .cta-row {
                display: flex;
                gap: 1rem;
                flex-wrap: wrap;
                justify-content: center;
                position: relative;
            }

            /* ── FOOTER ── */
            footer {
                padding: 1.5rem 3rem;
                border-top: 1px solid rgba(34,197,94,.1);
                display: flex;
                align-items: center;
                justify-content: space-between;
                background: var(--cream);
            }
            footer p {
                font-size: .8rem;
                color: var(--muted);
            }

            /* ── ANIMATIONS ── */
            @keyframes fadeUp {
                from { opacity: 0; transform: translateY(24px); }
                to   { opacity: 1; transform: translateY(0); }
            }

            /* ── RESPONSIVE ── */
            @media (max-width: 900px) {
                nav { padding: 1rem 1.5rem; }
                .hero { grid-template-columns: 1fr; padding: 7rem 1.5rem 3rem; gap: 3rem; }
                .hero-visual { order: -1; }
                .card-stack { max-width: 340px; }
                .features { padding: 4rem 1.5rem; }
                .features-grid { grid-template-columns: 1fr; }
                .cta-strip { padding: 4rem 1.5rem; }
                footer { flex-direction: column; gap: .75rem; text-align: center; }
                .badge-float { display: none; }
            }
        </style>
    </head>
    <body>

        <nav>
            <a href="/" class="logo">Coloc<span>.</span></a>
            <div class="nav-links">
                @auth
                    <a href="{{ url('/dashboard') }}" class="btn-ghost">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="btn-ghost">Log in</a>
                    <a href="{{ route('register') }}" class="btn-solid">Sign up free</a>
                @endauth
            </div>
        </nav>

        {{-- ── HERO ── --}}
        <section class="hero">
            <div class="hero-text">
                <div class="hero-tag">🏡 Colocation made simple</div>

                <h1>Find your<br><em>perfect</em><br>flatmate.</h1>

                <p class="hero-desc">
                    Coloc connects people looking for shared housing. Browse verified listings,
                    chat with future roommates, and settle in somewhere you'll love.
                </p>

                <div class="hero-cta">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="cta-primary">
                            Go to dashboard
                            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                            </svg>
                        </a>
                    @else
                        <a href="{{ route('register') }}" class="cta-primary">
                            Get started free
                            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                            </svg>
                        </a>
                        <a href="{{ route('login') }}" class="cta-secondary">Log in</a>
                    @endauth
                </div>
            </div>

            <div class="hero-visual">
                <div class="card-stack">
                    <div class="card-back"></div>
                    <div class="card-main">
                        <div class="card-avatar-row">
                            <div class="avatar">S</div>
                            <div>
                                <div class="card-name">Sophie M.</div>
                                <div class="card-sub">Verified host · Paris, 75011</div>
                            </div>
                        </div>
                        <div class="card-listing-title">Bright room in Bastille flat</div>
                        <div class="card-location">
                            <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            </svg>
                            11th arrondissement, Paris
                        </div>
                        <div class="card-tags">
                            <span class="tag">Furnished</span>
                            <span class="tag">Bills included</span>
                            <span class="tag">Pet-friendly</span>
                            <span class="tag">Non-smoker</span>
                        </div>
                        <div class="card-price-row">
                            <div class="card-price">€720 <span>/ month</span></div>
                            <button class="card-btn">View listing</button>
                        </div>
                    </div>

                    <div class="badge-float">
                        <div class="badge-icon">✅</div>
                        <div>
                            <div class="badge-label">Active listings</div>
                            <div class="badge-value">2,400+</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="features">
            <p class="section-label">Why Coloc?</p>
            <h2>Everything you need to find a home.</h2>

            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">🔍</div>
                    <h3>Smart search</h3>
                    <p>Filter by budget, location, lifestyle and more. Find listings that genuinely match your life.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">💬</div>
                    <h3>Direct messaging</h3>
                    <p>Chat securely with flatmates before committing. No middleman, no phone tag.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">✅</div>
                    <h3>Verified profiles</h3>
                    <p>Every profile is checked so you know who you're moving in with before you sign anything.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">💸</div>
                    <h3>Expense tracking</h3>
                    <p>Split bills and track shared expenses from your dashboard. No more awkward money conversations.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">🏠</div>
                    <h3>Post your listing</h3>
                    <p>Have a spare room? Post in minutes and reach thousands of people actively looking.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">🔒</div>
                    <h3>Private & secure</h3>
                    <p>Your data stays yours. We never sell your information to third parties. Ever.</p>
                </div>
            </div>
        </section>

        <section class="cta-strip">
            <h2>Ready to find your next home?</h2>
            <p>Join thousands of people already using Coloc across France.</p>
            <div class="cta-row">
                @auth
                    <a href="{{ url('/dashboard') }}" class="cta-primary">
                        Go to my dashboard
                        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </a>
                @else
                    <a href="{{ route('register') }}" class="cta-primary">
                        Create a free account
                        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </a>
                    <a href="{{ route('login') }}" class="cta-secondary">I already have an account</a>
                @endauth
            </div>
        </section>

        <footer>
            <p class="logo" style="font-size:1.1rem;">Coloc<span style="color:var(--green-fresh)">.</span></p>
            <p>© {{ date('Y') }} Coloc. Built with ❤️ for better living.</p>
        </footer>

    </body>
</html>
