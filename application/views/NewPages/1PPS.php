<!--application/views/NewPages/1PPS.php -->

<!DOCTYPE html>

<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>PPS — Product Per Student | Launching Soon</title>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;0,900;1,700&family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet"/>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    :root {
      --cream: #faf7f2;
      --paper: #f3ede3;
      --ink: #12100e;
      --ink2: #2d2820;
      --muted: #8a7e72;
      --border: #e0d8cc;
      --orange: #e8541a;
      --orange-light: #fde8df;
      --teal: #0d7a6e;
      --teal-light: #d4f0ec;
      --yellow: #f5c518;
    }

    .custom-container{
      max-width: 1070px;
      margin: 0 auto;
      padding: 0 15px;
    }

    html { scroll-behavior: smooth; }

    body {
      background: var(--cream);
      color: var(--ink);
      font-family: 'Outfit', sans-serif;
      font-size: 16px;
      line-height: 1.65;
      overflow-x: hidden;
    }

    /* ── NAV ── */
    nav {
      position: fixed; top: 0; left: 0; right: 0; z-index: 100;
      display: flex; align-items: center; justify-content: space-between;
      padding: 1.1rem 5%;
      background: rgba(250,247,242,0.92);
      backdrop-filter: blur(12px);
      border-bottom: 1px solid var(--border);
    }
    .logo {
      font-family: 'Playfair Display', serif;
      font-weight: 900; font-size: 1.5rem;
      color: var(--ink); letter-spacing: -0.03em;
    }
    .logo em { color: var(--orange); font-style: normal; }
    .nav-right { display: flex; align-items: center; gap: 1.5rem; }
    .nav-link {
      color: var(--muted); text-decoration: none;
      font-size: 0.88rem; font-weight: 500;
      transition: color 0.2s;
    }
    .nav-link:hover { color: var(--ink); }
    .nav-btn {
      background: var(--ink); color: var(--cream);
      padding: 0.5rem 1.3rem; border-radius: 6px;
      font-weight: 600; font-size: 0.85rem;
      text-decoration: none;
      transition: background 0.2s, transform 0.2s;
    }
    .nav-btn:hover { background: var(--orange); transform: translateY(-1px); }

    /* ── HERO ── */
    .hero {
      min-height: 100vh;
      padding: 9rem 5% 5rem;
      display: flex; flex-direction: column;
      align-items: center; justify-content: center;
      text-align: center;
      position: relative;
      overflow: hidden;
    }

    /* Decorative background */
    .hero-deco {
      position: absolute; inset: 0; z-index: 0; pointer-events: none;
    }
    .deco-circle {
      position: absolute; border-radius: 50%;
      border: 1px solid var(--border);
    }
    .deco-c1 { width: 500px; height: 500px; top: -100px; right: -150px; opacity: 0.5; }
    .deco-c2 { width: 300px; height: 300px; bottom: 50px; left: -80px; opacity: 0.4; }
    .deco-c3 { width: 160px; height: 160px; top: 20%; right: 10%; opacity: 0.3; }
    .deco-dots {
      position: absolute; width: 200px; height: 200px;
      top: 60%; left: 5%;
      background-image: radial-gradient(var(--border) 1.5px, transparent 1.5px);
      background-size: 20px 20px;
      opacity: 0.7;
    }
    .deco-dots2 {
      position: absolute; width: 160px; height: 160px;
      top: 15%; right: 8%;
      background-image: radial-gradient(var(--border) 1.5px, transparent 1.5px);
      background-size: 20px 20px;
      opacity: 0.6;
    }

    .launch-tag {
      display: inline-flex; align-items: center; gap: 0.6rem;
      background: var(--orange-light);
      border: 1px solid rgba(232,84,26,0.25);
      color: var(--orange);
      padding: 0.4rem 1.1rem; border-radius: 999px;
      font-size: 0.78rem; font-weight: 700;
      letter-spacing: 0.1em; text-transform: uppercase;
      margin-bottom: 2rem;
      position: relative; z-index: 1;
      animation: fadeUp 0.6s ease both;
    }
    .launch-tag .blink {
      width: 7px; height: 7px; border-radius: 50%;
      background: var(--orange);
      animation: blink 1.4s infinite;
    }
    @keyframes blink {
      0%, 100% { opacity: 1; }
      50% { opacity: 0.2; }
    }

    h1 {
      font-family: 'Playfair Display', serif;
      font-size: 90px;
      font-weight: 900;
      
      line-height: 0.95;
      letter-spacing: -0.04em;
      position: relative; z-index: 1;
      animation: fadeUp 0.6s 0.1s ease both;
      opacity: 0;
    }

     @media(max-width:768px){
       h1 {
     
      font-size: 50px !important;

      
    }
    
     }

      @media(max-width:576px){
       h1 {
     
      font-size: 30px !important;
      
    }
    }


    h1 .italic-line {
      display: block;
      font-style: italic;
      color: var(--orange);
    }
    h1 .outline-line {
      display: block;
      -webkit-text-stroke: 2px var(--ink);
      color: transparent;
    }

    .hero-desc {
      max-width: 540px;
      font-size: 1.05rem; font-weight: 300;
      color: var(--muted); margin: 2rem auto 0;
      position: relative; z-index: 1;
      animation: fadeUp 0.6s 0.2s ease both;
      opacity: 0;
      line-height: 1.75;
    }
    .hero-desc strong { color: var(--ink); font-weight: 600; }

    /* COUNTDOWN */
    .countdown-wrap {
      margin-top: 3rem;
      position: relative; z-index: 1;
      animation: fadeUp 0.6s 0.3s ease both;
      opacity: 0;
    }
    .countdown-label {
      font-size: 0.75rem; font-weight: 700;
      letter-spacing: 0.12em; text-transform: uppercase;
      color: var(--muted); margin-bottom: 1rem;
    }
    .countdown {
      display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;
    }
    .cd-unit {
      background: var(--paper);
      border: 1px solid var(--border);
      border-radius: 12px;
      padding: 1rem 1.4rem;
      min-width: 80px; text-align: center;
    }
    .cd-num {
      font-family: 'Playfair Display', serif;
      font-size: 2.2rem; font-weight: 900;
      line-height: 1; color: var(--ink);
    }
    .cd-lbl {
      font-size: 0.7rem; font-weight: 600;
      text-transform: uppercase; letter-spacing: 0.08em;
      color: var(--muted); margin-top: 0.3rem;
    }
    .cd-sep {
      font-family: 'Playfair Display', serif;
      font-size: 2.2rem; color: var(--border);
      align-self: center; padding-bottom: 0.5rem;
    }

    /* FORM */
    .hero-form {
      margin-top: 2.5rem;
      position: relative; z-index: 1;
      animation: fadeUp 0.6s 0.4s ease both;
      opacity: 0;
    }
    .form-card {
      background: #fff;
      border: 1px solid var(--border);
      border-radius: 16px;
      padding: 2.2rem 2rem;
      max-width: 480px; margin: 0 auto;
      box-shadow: 0 8px 40px rgba(18,16,14,0.08);
    }
    .form-card h3 {
      font-family: 'Playfair Display', serif;
      font-size: 1.3rem; font-weight: 700;
      margin-bottom: 0.3rem;
    }
    .form-card p { color: var(--muted); font-size: 0.85rem; margin-bottom: 1.5rem; }
    .field { margin-bottom: 1rem; }
    .field label {
      display: block; font-size: 0.8rem; font-weight: 600;
      color: var(--ink2); margin-bottom: 0.4rem;
    }
    .field input, .field select {
      width: 100%;
      background: var(--cream); border: 1px solid var(--border);
      border-radius: 8px; padding: 0.75rem 1rem;
      color: var(--ink); font-family: 'Outfit', sans-serif;
      font-size: 0.9rem; outline: none;
      transition: border-color 0.2s, box-shadow 0.2s;
      appearance: none;
    }
    .field input::placeholder { color: var(--muted); }
    .field input:focus, .field select:focus {
      border-color: var(--orange);
      box-shadow: 0 0 0 3px rgba(232,84,26,0.1);
    }
    .field-row { display: grid; grid-template-columns: 1fr 1fr; gap: 0.8rem; }
    .submit-btn {
      width: 100%; margin-top: 0.5rem;
      background: var(--ink); color: var(--cream);
      border: none; border-radius: 8px;
      padding: 0.9rem; font-family: 'Outfit', sans-serif;
      font-size: 0.95rem; font-weight: 700;
      cursor: pointer; transition: background 0.2s, transform 0.15s;
      display: flex; align-items: center; justify-content: center; gap: 0.5rem;
    }
    .submit-btn:hover { background: var(--orange); transform: translateY(-1px); }
    .form-note { font-size: 0.73rem; color: var(--muted); text-align: center; margin-top: 0.9rem; }
    .form-perks {
      display: flex; gap: 1.2rem; flex-wrap: wrap;
      justify-content: center; margin-top: 1.2rem;
    }
    .fperk {
      display: flex; align-items: center; gap: 0.35rem;
      font-size: 0.75rem; color: var(--muted); font-weight: 500;
    }
    .fperk-dot { color: var(--teal); font-size: 0.85rem; }

    @keyframes fadeUp {
      from { opacity: 0; transform: translateY(20px); }
      to   { opacity: 1; transform: translateY(0); }
    }

    /* ── DIVIDER ── */
    .divider {
      width: 100%; border: none;
      border-top: 1px solid var(--border);
      margin: 0;
    }

    /* ── SECTIONS ── */
    section { padding: 5.5rem 5%; }
    .section-eyebrow {
      display: inline-block;
      font-size: 0.72rem; font-weight: 700;
      text-transform: uppercase; letter-spacing: 0.14em;
      color: var(--orange);
      background: var(--orange-light);
      padding: 0.25rem 0.75rem; border-radius: 4px;
      margin-bottom: 1rem;
    }
    .section-h {
      font-family: 'Playfair Display', serif;
      font-size: clamp(2rem, 4vw, 3rem);
      font-weight: 900; letter-spacing: -0.03em;
      line-height: 1.1;
    }
    .section-sub {
      color: var(--muted); max-width: 500px;
      font-size: 1rem; margin-top: 0.7rem; font-weight: 300;
      line-height: 1.75;
    }

    /* ── WHAT IS PPS ── */
    #about { background: var(--paper); }
    .about-grid {
      display: grid; grid-template-columns: 1fr 1fr;
      gap: 6rem; align-items: center;
      max-width: 1100px; margin: 0 auto;
    }
    .about-list { margin-top: 2rem; display: flex; flex-direction: column; gap: 1.2rem; }
    .about-item {
      display: flex; gap: 1rem; align-items: flex-start;
      padding: 1.2rem; background: #fff;
      border: 1px solid var(--border); border-radius: 12px;
      transition: border-color 0.2s, transform 0.2s;
    }
    .about-item:hover { border-color: var(--orange); transform: translateX(4px); }
    .about-item-icon {
      font-size: 1.5rem; flex-shrink: 0;
      width: 44px; height: 44px;
      display: flex; align-items: center; justify-content: center;
      background: var(--orange-light); border-radius: 10px;
    }
    .about-item h4 {
      font-weight: 700; font-size: 0.95rem; margin-bottom: 0.2rem;
    }
    .about-item p { color: var(--muted); font-size: 0.83rem; }

    /* Visual side */
    .about-visual-box {
      background: var(--ink); border-radius: 20px;
      padding: 2.5rem 2rem; color: var(--cream);
      position: relative; overflow: hidden;
    }
    .about-visual-box::before {
      content: '';
      position: absolute; top: -60px; right: -60px;
      width: 200px; height: 200px; border-radius: 50%;
      background: rgba(232,84,26,0.15);
    }
    .about-visual-box::after {
      content: '';
      position: absolute; bottom: -40px; left: -40px;
      width: 140px; height: 140px; border-radius: 50%;
      background: rgba(13,122,110,0.1);
    }
    .avb-label {
      font-size: 0.7rem; font-weight: 700;
      text-transform: uppercase; letter-spacing: 0.12em;
      color: var(--orange); margin-bottom: 1.5rem;
    }
    .avb-big {
      font-family: 'Playfair Display', serif;
      font-size: 4rem; font-weight: 900;
      line-height: 1; margin-bottom: 0.5rem;
    }
    .avb-big span { color: var(--orange); }
    .avb-sub {
      font-size: 0.85rem; color: rgba(250,247,242,0.5);
      margin-bottom: 2rem; font-weight: 300;
    }
    .avb-divider { border: none; border-top: 1px solid rgba(255,255,255,0.1); margin: 1.5rem 0; }
    .avb-stat-row { display: flex; gap: 2rem; }
    .avb-stat-num {
      font-family: 'Playfair Display', serif;
      font-size: 1.8rem; font-weight: 900; line-height: 1;
    }
    .avb-stat-lbl {
      font-size: 0.72rem; color: rgba(250,247,242,0.5);
      font-weight: 400; margin-top: 0.2rem;
    }
    .avb-tags { display: flex; gap: 0.5rem; flex-wrap: wrap; margin-top: 1.8rem; }
    .avb-tag {
      padding: 0.3rem 0.7rem; border-radius: 6px;
      font-size: 0.72rem; font-weight: 600;
      background: rgba(255,255,255,0.08);
      color: rgba(250,247,242,0.7);
      border: 1px solid rgba(255,255,255,0.1);
    }

    /* ── HOW IT WORKS ── */
    #process { max-width: 1100px; margin: 0 auto; }
    .process-header { text-align: center; margin-bottom: 4rem; }
    .process-header .section-sub { margin: 0.7rem auto 0; }
    .timeline {
      position: relative;
      display: flex; flex-direction: column; gap: 0;
    }
    .timeline::before {
      content: '';
      position: absolute; left: 2rem; top: 0; bottom: 0; width: 2px;
      background: linear-gradient(180deg, var(--orange), var(--teal));
    }
    .tl-item {
      display: flex; gap: 2.5rem; align-items: flex-start;
      padding: 0 0 2.5rem 5.5rem;
      position: relative;
    }
    .tl-dot {
      position: absolute; left: calc(2rem - 10px); top: 4px;
      width: 20px; height: 20px; border-radius: 50%;
      background: var(--cream); border: 3px solid var(--orange);
      z-index: 1; transition: background 0.2s;
    }
    .tl-item:nth-child(even) .tl-dot { border-color: var(--teal); }
    .tl-item:hover .tl-dot { background: var(--orange); }
    .tl-item:nth-child(even):hover .tl-dot { background: var(--teal); }
    .tl-content {
      background: #fff; border: 1px solid var(--border);
      border-radius: 14px; padding: 1.5rem 1.8rem;
      flex: 1; transition: border-color 0.2s, transform 0.2s;
    }
    .tl-item:hover .tl-content { transform: translateX(4px); border-color: var(--orange); }
    .tl-item:nth-child(even):hover .tl-content { border-color: var(--teal); }
    .tl-num {
      font-size: 0.7rem; font-weight: 700;
      text-transform: uppercase; letter-spacing: 0.12em;
      color: var(--orange); margin-bottom: 0.4rem;
    }
    .tl-item:nth-child(even) .tl-num { color: var(--teal); }
    .tl-content h3 {
      font-family: 'Playfair Display', serif;
      font-size: 1.2rem; font-weight: 700; margin-bottom: 0.4rem;
    }
    .tl-content p { color: var(--muted); font-size: 0.88rem; }
    .tl-badge {
      display: inline-block; margin-top: 0.8rem;
      padding: 0.2rem 0.7rem; border-radius: 6px;
      font-size: 0.72rem; font-weight: 600;
    }
    .badge-orange { background: var(--orange-light); color: var(--orange); }
    .badge-teal { background: var(--teal-light); color: var(--teal); }

    /* ── WHO IT'S FOR ── */
    #who { background: var(--paper); }
    .who-inner { max-width: 1100px; margin: 0 auto; }
    .who-grid {
      display: grid; grid-template-columns: repeat(3, 1fr);
      gap: 1.2rem; margin-top: 3rem;
    }
    .who-card {
      background: #fff; border: 1px solid var(--border);
      border-radius: 14px; padding: 2rem 1.6rem;
      transition: border-color 0.2s, transform 0.2s;
    }
    .who-card:hover { transform: translateY(-4px); border-color: var(--orange); }
    .who-icon {
      width: 52px; height: 52px; border-radius: 12px;
      display: flex; align-items: center; justify-content: center;
      font-size: 1.6rem; margin-bottom: 1.2rem;
    }
    .wi-orange { background: var(--orange-light); }
    .wi-teal { background: var(--teal-light); }
    .wi-yellow { background: rgba(245,197,24,0.15); }
    .who-card h3 {
      font-family: 'Playfair Display', serif;
      font-size: 1.1rem; font-weight: 700; margin-bottom: 0.5rem;
    }
    .who-card p { color: var(--muted); font-size: 0.85rem; line-height: 1.65; }

    /* ── FAQ ── */
    #faq { max-width: 720px; margin: 0 auto; }
    .faq-header { text-align: center; margin-bottom: 3rem; }
    .faq-item {
      border: 1px solid var(--border); border-radius: 12px;
      margin-bottom: 0.8rem; overflow: hidden;
    }
    .faq-q {
      width: 100%; background: #fff;
      border: none; text-align: left;
      padding: 1.2rem 1.5rem;
      font-family: 'Outfit', sans-serif;
      font-size: 0.95rem; font-weight: 600; color: var(--ink);
      cursor: pointer; display: flex; justify-content: space-between;
      align-items: center; gap: 1rem;
      transition: background 0.2s;
    }
    .faq-q:hover { background: var(--cream); }
    .faq-q.open { background: var(--cream); }
    .faq-arrow {
      flex-shrink: 0; width: 22px; height: 22px;
      border-radius: 50%; background: var(--paper);
      display: flex; align-items: center; justify-content: center;
      font-size: 0.8rem; transition: transform 0.25s, background 0.2s;
    }
    .faq-q.open .faq-arrow {
      transform: rotate(180deg);
      background: var(--orange-light); color: var(--orange);
    }
    .faq-a {
      max-height: 0; overflow: hidden;
      transition: max-height 0.3s ease, padding 0.3s;
      background: var(--cream);
    }
    .faq-a.open { max-height: 200px; }
    .faq-a-inner {
      padding: 0 1.5rem 1.3rem;
      color: var(--muted); font-size: 0.88rem; line-height: 1.7;
    }

    /* ── FINAL CTA ── */
    #register {
      background: var(--ink);
      color: var(--cream);
      position: relative; overflow: hidden;
    }
    #register::before {
      content: '';
      position: absolute; top: -200px; right: -200px;
      width: 500px; height: 500px; border-radius: 50%;
      background: rgba(232,84,26,0.1);
    }
    #register::after {
      content: '';
      position: absolute; bottom: -150px; left: -100px;
      width: 350px; height: 350px; border-radius: 50%;
      background: rgba(13,122,110,0.08);
    }
    .register-inner {
      max-width: 680px; margin: 0 auto;
      text-align: center; position: relative; z-index: 1;
    }
    .register-inner .section-h { color: var(--cream); }
    .register-inner .section-sub { color: rgba(250,247,242,0.55); margin: 0 auto 2.5rem; }
    .register-form {
      background: rgba(255,255,255,0.06);
      border: 1px solid rgba(255,255,255,0.1);
      border-radius: 16px; padding: 2.5rem 2rem;
    }
    .reg-field { margin-bottom: 1rem; text-align: left; }
    .reg-field label {
      display: block; font-size: 0.78rem; font-weight: 600;
      color: rgba(250,247,242,0.5); margin-bottom: 0.4rem;
      text-transform: uppercase; letter-spacing: 0.07em;
    }
    .reg-field input, .reg-field select {
      width: 100%;
      background: rgba(255,255,255,0.07);
      border: 1px solid rgba(255,255,255,0.12);
      border-radius: 8px; padding: 0.8rem 1rem;
      color: var(--cream); font-family: 'Outfit', sans-serif;
      font-size: 0.9rem; outline: none;
      transition: border-color 0.2s, box-shadow 0.2s;
      appearance: none;
    }
    .reg-field input::placeholder { color: rgba(250,247,242,0.3); }
    .reg-field input:focus, .reg-field select:focus {
      border-color: var(--orange);
      box-shadow: 0 0 0 3px rgba(232,84,26,0.15);
    }
    .reg-field select option { background: #2d2820; }
    .reg-row { display: grid; grid-template-columns: 1fr 1fr; gap: 0.8rem; }
    .reg-submit {
      width: 100%; margin-top: 0.8rem;
      background: var(--orange); color: #fff;
      border: none; border-radius: 8px;
      padding: 1rem; font-family: 'Outfit', sans-serif;
      font-size: 1rem; font-weight: 700;
      cursor: pointer;
      display: flex; align-items: center; justify-content: center; gap: 0.5rem;
      transition: opacity 0.2s, transform 0.15s;
    }
    .reg-submit:hover { opacity: 0.9; transform: translateY(-1px); }
    .reg-note {
      font-size: 0.73rem; color: rgba(250,247,242,0.35);
      text-align: center; margin-top: 1rem;
    }
    /* Success state */
    .success-msg {
      display: none; text-align: center; padding: 2rem;
    }
    .success-msg .check {
      width: 60px; height: 60px; border-radius: 50%;
      background: rgba(13,122,110,0.2); border: 2px solid var(--teal);
      display: flex; align-items: center; justify-content: center;
      font-size: 1.5rem; margin: 0 auto 1rem;
    }
    .success-msg h3 {
      font-family: 'Playfair Display', serif;
      font-size: 1.4rem; margin-bottom: 0.5rem;
    }
    .success-msg p { color: rgba(250,247,242,0.55); font-size: 0.88rem; }

    /* ── FOOTER ── */
    footer {
      background: #0d0b09;
      border-top: 1px solid rgba(255,255,255,0.06);
      padding: 2.5rem 5%;
      display: flex; align-items: center; justify-content: space-between;
      flex-wrap: wrap; gap: 1rem;
      color: rgba(250,247,242,0.4); font-size: 0.8rem;
    }
    .footer-logo {
      font-family: 'Playfair Display', serif;
      font-weight: 900; font-size: 1.2rem;
      color: var(--cream);
    }
    .footer-logo em { color: var(--orange); font-style: normal; }
    .footer-links { display: flex; gap: 1.5rem; }
    .footer-links a {
      color: rgba(250,247,242,0.4); text-decoration: none;
      transition: color 0.2s;
    }
    .footer-links a:hover { color: var(--cream); }

    /* ── REVEAL ── */
    .reveal {
      opacity: 0; transform: translateY(28px);
      transition: opacity 0.65s ease, transform 0.65s ease;
    }
    .reveal.visible { opacity: 1; transform: translateY(0); }
    .reveal-delay-1 { transition-delay: 0.1s; }
    .reveal-delay-2 { transition-delay: 0.2s; }

    /* ── RESPONSIVE ── */
    @media (max-width: 860px) {
      .about-grid { grid-template-columns: 1fr; gap: 3rem; }
      .who-grid { grid-template-columns: 1fr 1fr; }
      .avb-stat-row { gap: 1.5rem; }
    }
    @media (max-width: 620px) {
      .nav-link { display: none; }
      .who-grid { grid-template-columns: 1fr; }
      .reg-row { grid-template-columns: 1fr; }
      .field-row { grid-template-columns: 1fr; }
      .countdown { gap: 0.5rem; }
      .cd-sep { display: none; }
    }
  </style>
</head>
<body>

  <!-- NAV -->
  <nav>
     
        <img src="https://www.theiotacademy.co/assets/dit/images/navbar/logo.svg"  alt="logo" class="img-fluid" style="max-height: 60px;">
      
      
  
    <div class="nav-right">
      <a href="https://www.theiotacademy.co/" target="_blank" class="nav-link">Home</a>
      <a href="https://www.theiotacademy.co/" target="_blank" class="nav-link">About</a>
      <a href="https://www.theiotacademy.co/all-courses" target="_blank" class="nav-link">Our Courses</a>
      <a href="https://www.theiotacademy.co/blog/" target="_blank" class="nav-link">Blogs</a>
      <!--<a href="https://learn.upskillcampus.com/s/dashboard" target="_blank" class="nav-btn">Register Now</a>-->
    </div>
  </nav>

  <!-- HERO -->
  <div class="hero">
    <div class="hero-deco">
      <div class="deco-circle deco-c1"></div>
      <div class="deco-circle deco-c2"></div>
      <div class="deco-circle deco-c3"></div>
      <div class="deco-dots"></div>
      <div class="deco-dots2"></div>
    </div>
    <div class="launch-tag"><span class="blink"></span>Aatmanirbhar Bharat Initiative · Cohort 2026</div>
    <div class="custom-container">
      <div class="row g-4 align-items-center">
         <div class="col-lg-6">
          <h1 class="text-align-center text-lg-align-start text-align-lg-start">
      One Student.
      <span class="italic-line">One Product.</span>
      <!--<span class="outline-line">Real AI.</span>-->
    </h1>
    <p class="hero-desc">
      <strong>1PPS (One Product Per Student)</strong> is a national initiative rooted in <strong>Aatmanirbhar Bharat</strong> — empowering every student to build a real, deployable product using <strong>AI/ML, IoT, Robotics, Drones, VLSI, EV or Cyber Security</strong> and contribute to India's innovation economy.
    </p>
        </div>
        <div class="col-lg-6">
          <img class="img-fluid rounded shadow " src="https://www.theiotacademy.co/assets/dit/images/1PPS.webp" alt="1pps" style="max-height: 500px;"/>
        </div>
       
      </div>
    </div>
    

    <!-- COUNTDOWN -->
    <div class="countdown-wrap">
      <div class="countdown-label">Applications close in</div>
      <div class="countdown">
        <div class="cd-unit"><div class="cd-num" id="cd-days">--</div><div class="cd-lbl">Days</div></div>
        <div class="cd-sep">:</div>
        <div class="cd-unit"><div class="cd-num" id="cd-hours">--</div><div class="cd-lbl">Hours</div></div>
        <div class="cd-sep">:</div>
        <div class="cd-unit"><div class="cd-num" id="cd-mins">--</div><div class="cd-lbl">Mins</div></div>
        <div class="cd-sep">:</div>
        <div class="cd-unit"><div class="cd-num" id="cd-secs">--</div><div class="cd-lbl">Secs</div></div>
      </div>
    </div>

    <!-- QUICK REGISTER -->
    <div class="hero-form">
      <div class="form-card">
        <h3>Secure Your Spot</h3>
        <p>Limited seats · Cohort starts April 2026</p>
        <div class="field-row">
          <div class="field">
            <label>First Name</label>
            <input type="text" id="hero-fname" placeholder="Arjun"/>
          </div>
          <div class="field">
            <label>Last Name</label>
            <input type="text" id="hero-lname" placeholder="Sharma"/>
          </div>
        </div>
        <div class="field">
          <label>College Email</label>
          <input type="email" id="hero-email" placeholder="you@college.edu.in"/>
        </div>
        <div class="field">
          <label>Contact Number</label>
          <input type="tel" id="hero-phone-input" class="hero-phone" placeholder="+91 98765 43210"/>
        </div>
        <div class="field">
          <label>AI/ML Domain of Interest</label>
          <select id="hero-domain">
            <option value="" disabled selected>Select a domain</option>
            <option>Natural Language Processing (NLP)</option>
            <option>Computer Vision</option>
            <option>Predictive Analytics / ML</option>
            <option>Generative AI & LLMs</option>
            <option>Reinforcement Learning</option>
            <option>AI for Social Good</option>
          </select>
        </div>
        <button class="submit-btn" id="hero-submit-btn" onclick="handleHeroSubmit(event)">
          Apply for Free
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
        </button>
        <p class="form-note">Free to apply. No prior product experience needed.</p>
        <div class="form-perks">
          <span class="fperk"><span class="fperk-dot">✓</span> Cloud Credits</span>
          <span class="fperk"><span class="fperk-dot">✓</span> 1:1 Mentorship</span>
          <span class="fperk"><span class="fperk-dot">✓</span> Certificate</span>
          <span class="fperk"><span class="fperk-dot">✓</span> Demo Day</span>
        </div>
      </div>
    </div>
  </div>

  <hr class="divider"/>

  <!-- ABOUT -->
  <section id="about">
    <div class="about-grid">
      <div class="reveal">
        <span class="section-eyebrow">What is 1PPS?</span>
        <h2 class="section-h">India's Student Innovation Movement</h2>
        <p class="section-sub">Recent global developments have reinforced that <em>Aatmanirbhar Bharat</em> is more important than ever. 1PPS inspires every student to focus on innovation and build meaningful products that contribute to India's journey toward becoming a strong, self-reliant economy.</p>
        <div class="about-list">
          <div class="about-item">
            <div class="about-item-icon">🇮🇳</div>
            <div>
              <h4>Rooted in Aatmanirbhar Bharat</h4>
              <p>Every product built under 1PPS contributes to India's vision of self-reliance — solving real Indian problems with homegrown innovation.</p>
            </div>
          </div>
          <div class="about-item">
            <div class="about-item-icon">🤝</div>
            <div>
              <h4>Powered by 3 Industry Leaders</h4>
              <p>Led by <strong>The IoT Academy</strong> in collaboration with <strong>UniConverge Technologies Pvt. Ltd.</strong> and <strong>UpSkill Campus</strong>.</p>
            </div>
          </div>
          <div class="about-item">
            <div class="about-item-icon">🚀</div>
            <div>
              <h4>From MVP to Commercial Product</h4>
              <p>Students don't just prototype — they optimise, test exhaustively, and prepare their product for real field trials and commercialisation.</p>
            </div>
          </div>
        </div>
      </div>
      <div class="reveal reveal-delay-1">
        <div class="about-visual-box">
          <div class="avb-label">PPS by the numbers</div>
          <div class="avb-big">1<span>:1</span></div>
          <div class="avb-sub">Every student gets a dedicated mentor</div>
          <hr class="avb-divider"/>
          <div class="avb-stat-row">
            <div>
              <div class="avb-stat-num">6</div>
              <div class="avb-stat-lbl">Week Cohort</div>
            </div>
            <div>
              <div class="avb-stat-num">100%</div>
              <div class="avb-stat-lbl">Hands-On</div>
            </div>
            <div>
              <div class="avb-stat-num">1</div>
              <div class="avb-stat-lbl">Product Per Student</div>
            </div>
          </div>
          <div class="avb-tags">
            <span class="avb-tag">AI / ML</span>
            <span class="avb-tag">IoT</span>
            <span class="avb-tag">Robotics</span>
            <span class="avb-tag">Drones</span>
            <span class="avb-tag">VLSI</span>
            <span class="avb-tag">EV</span>
            <span class="avb-tag">Cyber Security</span>
          </div>
        </div>
      </div>
    </div>
  </section>


  <hr class="divider"/>

  <!-- PARTNERS -->
  <section id="partners" style="background: var(--paper);">
    <div style="max-width: 1100px; margin: 0 auto; text-align: center;">
      <div class="reveal">
        <span class="section-eyebrow">Our Partners</span>
        <h2 class="section-h">Led by Industry. Built for Students.</h2>
        <p class="section-sub" style="margin: 0.7rem auto 2.5rem;">This initiative is a joint effort of three organisations committed to transforming how India's students build and innovate.</p>
      </div>
      <div class="reveal" style="display: grid; grid-template-columns: repeat(3,1fr); gap: 1.5rem; max-width: 900px; margin: 0 auto;">
        <div style="background:#fff; border:1px solid var(--border); border-radius:16px; padding:2rem 1.5rem; transition: transform 0.2s, border-color 0.2s;" onmouseover="this.style.transform='translateY(-4px)';this.style.borderColor='var(--orange)'" onmouseout="this.style.transform='';this.style.borderColor='var(--border)'">
          <div style="font-size:2.5rem; margin-bottom:1rem;">🏫</div>
          <h3 style="font-family:'Playfair Display',serif; font-size:1.05rem; font-weight:700; margin-bottom:0.5rem;">The IoT Academy</h3>
          <p style="color:var(--muted); font-size:0.82rem; line-height:1.65;">India's most affordable premium tech educator since 2017. Leading the 1PPS initiative with deep expertise in emerging technologies.</p>
          <span style="display:inline-block; margin-top:1rem; background:var(--orange-light); color:var(--orange); font-size:0.72rem; font-weight:700; padding:0.25rem 0.7rem; border-radius:4px;">Lead Partner</span>
        </div>
        <div style="background:#fff; border:1px solid var(--border); border-radius:16px; padding:2rem 1.5rem; transition: transform 0.2s, border-color 0.2s;" onmouseover="this.style.transform='translateY(-4px)';this.style.borderColor='var(--teal)'" onmouseout="this.style.transform='';this.style.borderColor='var(--border)'">
          <div style="font-size:2.5rem; margin-bottom:1rem;">🏢</div>
          <h3 style="font-family:'Playfair Display',serif; font-size:1.05rem; font-weight:700; margin-bottom:0.5rem;">UniConverge Technologies</h3>
          <p style="color:var(--muted); font-size:0.82rem; line-height:1.65;">Pvt. Ltd. — bringing deep industry connections, real-world product development expertise and commercialisation support.</p>
          <span style="display:inline-block; margin-top:1rem; background:var(--teal-light); color:var(--teal); font-size:0.72rem; font-weight:700; padding:0.25rem 0.7rem; border-radius:4px;">Technology Partner</span>
        </div>
        <div style="background:#fff; border:1px solid var(--border); border-radius:16px; padding:2rem 1.5rem; transition: transform 0.2s, border-color 0.2s;" onmouseover="this.style.transform='translateY(-4px)';this.style.borderColor='#f5c518'" onmouseout="this.style.transform='';this.style.borderColor='var(--border)'">
          <div style="font-size:2.5rem; margin-bottom:1rem;">📚</div>
          <h3 style="font-family:'Playfair Display',serif; font-size:1.05rem; font-weight:700; margin-bottom:0.5rem;">UpSkill Campus</h3>
          <p style="color:var(--muted); font-size:0.82rem; line-height:1.65;">Enabling skill development, free learning resources, and career growth pathways for students across India.</p>
          <span style="display:inline-block; margin-top:1rem; background:rgba(245,197,24,0.15); color:#b8920a; font-size:0.72rem; font-weight:700; padding:0.25rem 0.7rem; border-radius:4px;">Skills Partner</span>
        </div>
      </div>
    </div>
  </section>

  <hr class="divider"/>

  <!-- PROCESS -->
  <section>
    <div id="process">
      <div class="process-header reveal">
        <span class="section-eyebrow">How It Works</span>
        <h2 class="section-h">Your Journey from Idea to Launch</h2>
        <p class="section-sub">A 6-week structured programme designed to take you through the complete product-building experience.</p>
      </div>
      <div class="timeline reveal" style="max-width: 680px; margin: 0 auto;">
        <div class="tl-item">
          <div class="tl-dot"></div>
          <div class="tl-content">
            <div class="tl-num">Week 1 — Foundation</div>
            <h3>Apply, Get Selected & Onboard</h3>
            <p>Submit your application with a brief project idea. Selected students attend an orientation, get matched with their mentor, and finalize their product direction.</p>
            <span class="tl-badge badge-orange">Application → Orientation</span>
          </div>
        </div>
        <div class="tl-item">
          <div class="tl-dot"></div>
          <div class="tl-content">
            <div class="tl-num">Week 2 — Ideation</div>
            <h3>Define the Problem & Design the Solution</h3>
            <p>Validate your idea with real users, map out features, and create a product brief. No building yet — only thinking, research, and planning.</p>
            <span class="tl-badge badge-teal">User Research → Product Brief</span>
          </div>
        </div>
        <div class="tl-item">
          <div class="tl-dot"></div>
          <div class="tl-content">
            <div class="tl-num">Week 3–4 — Build</div>
            <h3>Train Your Model & Build the Product</h3>
            <p>Develop the ML/AI core, wrap it in a product (API, web app, mobile), and iterate continuously with mentor feedback and peer reviews.</p>
            <span class="tl-badge badge-orange">ML Model → Working Prototype</span>
          </div>
        </div>
        <div class="tl-item">
          <div class="tl-dot"></div>
          <div class="tl-content">
            <div class="tl-num">Week 5 — Polish</div>
            <h3>Test, Refine & Prepare for Launch</h3>
            <p>User testing, bug fixes, performance tuning, and preparing a compelling product narrative for Demo Day.</p>
            <span class="tl-badge badge-teal">Beta → Launch-Ready</span>
          </div>
        </div>
        <div class="tl-item" style="padding-bottom: 0;">
          <div class="tl-dot"></div>
          <div class="tl-content">
            <div class="tl-num">Week 6 — Launch</div>
            <h3>Ship It. Present It. Own It.</h3>
            <p>Deploy to production and present your product at the public Demo Day in front of industry guests, investors, and the broader student community.</p>
            <span class="tl-badge badge-orange">Deployed Product → Demo Day 🎉</span>
          </div>
        </div>
      </div>
    </div>
  </section>

  <hr class="divider"/>

  <!-- WHO IT'S FOR -->
  <section id="who">
    <div class="who-inner">
      <div class="reveal" style="text-align: center; margin-bottom: 0;">
        <span class="section-eyebrow">Who Should Apply</span>
        <h2 class="section-h">Built for Curious, Motivated Students</h2>
        <p class="section-sub" style="margin: 0.7rem auto 0;">You don't need to be an expert. You need to be willing to build.</p>
      </div>
      <div class="who-grid reveal">
        <div class="who-card">
          <div class="who-icon wi-orange">🎓</div>
          <h3>CS / IT / Engineering Students</h3>
          <p>If you're studying computer science, data science, or any engineering discipline and want hands-on AI experience — this is for you.</p>
        </div>
        <div class="who-card">
          <div class="who-icon wi-teal">💡</div>
          <h3>Problem Solvers with Ideas</h3>
          <p>Have a problem you want to solve with AI? Whether it's healthcare, education, agriculture, or finance — bring your idea and we'll help you build it.</p>
        </div>
        <div class="who-card">
          <div class="who-icon wi-yellow">🛠️</div>
          <h3>Beginners to Intermediate Coders</h3>
          <p>You should be comfortable with Python basics. Deep ML expertise is not required — our mentors will guide you through the technical implementation.</p>
        </div>
      </div>
    </div>
  </section>


  <hr class="divider"/>

  <!-- SUPPORT ECOSYSTEM -->
  <section id="support" style="background: var(--paper);">
    <div style="max-width: 1100px; margin: 0 auto;">
      <div class="reveal" style="text-align:center; margin-bottom:3rem;">
        <span class="section-eyebrow">Support Ecosystem</span>
        <h2 class="section-h">Everything You Need to Succeed</h2>
        <p class="section-sub" style="margin: 0.7rem auto 0;">We don't just enrol you and leave you alone. The 1PPS ecosystem wraps around every student with the right support at the right time.</p>
      </div>
      <div class="reveal" style="display:grid; grid-template-columns: repeat(2,1fr); gap:1.2rem;">
        <div style="background:#fff; border:1px solid var(--border); border-radius:14px; padding:1.8rem; display:flex; gap:1.2rem; align-items:flex-start; transition:transform 0.2s,border-color 0.2s;" onmouseover="this.style.transform='translateX(4px)';this.style.borderColor='var(--orange)'" onmouseout="this.style.transform='';this.style.borderColor='var(--border)'">
          <div style="font-size:1.8rem; flex-shrink:0; width:48px; height:48px; display:flex; align-items:center; justify-content:center; background:var(--orange-light); border-radius:10px;">🧭</div>
          <div>
            <h3 style="font-family:'Playfair Display',serif; font-weight:700; font-size:1rem; margin-bottom:0.3rem;">Product Guidance</h3>
            <p style="color:var(--muted); font-size:0.83rem;">Expert mentors guide you from raw idea to a well-defined MVP — helping you avoid common pitfalls and stay focused.</p>
          </div>
        </div>
        <div style="background:#fff; border:1px solid var(--border); border-radius:14px; padding:1.8rem; display:flex; gap:1.2rem; align-items:flex-start; transition:transform 0.2s,border-color 0.2s;" onmouseover="this.style.transform='translateX(4px)';this.style.borderColor='var(--teal)'" onmouseout="this.style.transform='';this.style.borderColor='var(--border)'">
          <div style="font-size:1.8rem; flex-shrink:0; width:48px; height:48px; display:flex; align-items:center; justify-content:center; background:var(--teal-light); border-radius:10px;">📖</div>
          <div>
            <h3 style="font-family:'Playfair Display',serif; font-weight:700; font-size:1rem; margin-bottom:0.3rem;">Free Skill Resources</h3>
            <p style="color:var(--muted); font-size:0.83rem;">Access curated free learning content for every skill you need — AI/ML, embedded systems, cloud, and more — no extra cost.</p>
          </div>
        </div>
        <div style="background:#fff; border:1px solid var(--border); border-radius:14px; padding:1.8rem; display:flex; gap:1.2rem; align-items:flex-start; transition:transform 0.2s,border-color 0.2s;" onmouseover="this.style.transform='translateX(4px)';this.style.borderColor='var(--orange)'" onmouseout="this.style.transform='';this.style.borderColor='var(--border)'">
          <div style="font-size:1.8rem; flex-shrink:0; width:48px; height:48px; display:flex; align-items:center; justify-content:center; background:var(--orange-light); border-radius:10px;">🛠️</div>
          <div>
            <h3 style="font-family:'Playfair Display',serif; font-weight:700; font-size:1rem; margin-bottom:0.3rem;">Open Source MVP Library</h3>
            <p style="color:var(--muted); font-size:0.83rem;">Get access to a curated open-source list to jumpstart your MVP — so you build on proven foundations, not from scratch.</p>
          </div>
        </div>
        <div style="background:#fff; border:1px solid var(--border); border-radius:14px; padding:1.8rem; display:flex; gap:1.2rem; align-items:flex-start; transition:transform 0.2s,border-color 0.2s;" onmouseover="this.style.transform='translateX(4px)';this.style.borderColor='var(--teal)'" onmouseout="this.style.transform='';this.style.borderColor='var(--border)'">
          <div style="font-size:1.8rem; flex-shrink:0; width:48px; height:48px; display:flex; align-items:center; justify-content:center; background:var(--teal-light); border-radius:10px;">📈</div>
          <div>
            <h3 style="font-family:'Playfair Display',serif; font-weight:700; font-size:1rem; margin-bottom:0.3rem;">Marketing & Commercialisation</h3>
            <p style="color:var(--muted); font-size:0.83rem;">We don't stop at launch. Get help positioning, pitching, and taking your product to market — including field trial support.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <hr class="divider"/>

  <!-- FAQ -->
  <section>
    <div id="faq">
      <div class="faq-header reveal">
        <span class="section-eyebrow">FAQ</span>
        <h2 class="section-h">Common Questions</h2>
        <p class="section-sub" style="margin: 0.7rem auto 0;">Everything you need to know before applying.</p>
      </div>
      <div class="reveal">
        <div class="faq-item">
          <button class="faq-q" onclick="toggleFaq(this)">
            How can I apply for the 1PPS Program?
            <span class="faq-arrow">↓</span>
          </button>
          <div class="faq-a">
            <div class="faq-a-inner">Simply fill out the registration form on this page. Once registered, you'll receive guidance on submitting your innovative idea, checking required skills, and accessing the open-source MVP library. Applications close April 15, 2026.</div>
          </div>
        </div>
        <div class="faq-item">
          <button class="faq-q" onclick="toggleFaq(this)">
            What are the benefits of the 1PPS program?
            <span class="faq-arrow">↓</span>
          </button>
          <div class="faq-a">
            <div class="faq-a-inner">You get access to free skill development resources, expert product guidance, an open-source MVP library, mentorship from industry professionals, and support for marketing and commercialisation — all the way to field trials. You'll graduate with a real, deployable product in your portfolio.</div>
          </div>
        </div>
        <div class="faq-item">
          <button class="faq-q" onclick="toggleFaq(this)">
            How can 1PPS help in my career growth?
            <span class="faq-arrow">↓</span>
          </button>
          <div class="faq-a">
            <div class="faq-a-inner">In today's competitive market, having a real product on your resume sets you apart. 1PPS gives you a live, tested product built with emerging technologies — AI/ML, IoT, Robotics, Drones, VLSI, EV or Cyber Security — that you can showcase to employers, investors, and graduate schools as proof of your ability to build and ship.</div>
          </div>
        </div>
        <div class="faq-item">
          <button class="faq-q" onclick="toggleFaq(this)">
            Is there any fee for the program?
            <span class="faq-arrow">↓</span>
          </button>
          <div class="faq-a">
            <div class="faq-a-inner">The 1PPS program is free to apply and participate in. Free skill development resources are also provided. Some optional advanced modules or hardware components may have associated costs, but the core programme and mentorship are offered at no charge.</div>
          </div>
        </div>
        <div class="faq-item">
          <button class="faq-q" onclick="toggleFaq(this)">
            Will I get a certificate for being part of this program?
            <span class="faq-arrow">↓</span>
          </button>
          <div class="faq-a">
            <div class="faq-a-inner">Yes! Students who successfully complete the programme and ship their product receive an official 1PPS Certificate of Completion issued by The IoT Academy, UniConverge Technologies, and UpSkill Campus — recognised by industry partners.</div>
          </div>
        </div>
        <div class="faq-item">
          <button class="faq-q" onclick="toggleFaq(this)">
            When does Cohort 2026 begin?
            <span class="faq-arrow">↓</span>
          </button>
          <div class="faq-a">
            <div class="faq-a-inner">Cohort 2026 begins in April 2026. Applications close April 15, 2026. Selections will be communicated by May 1, 2026. Register now to secure your spot.</div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- FINAL REGISTER -->
  <section id="register">
    <div class="register-inner reveal">
      <span class="section-eyebrow" style="background: rgba(232,84,26,0.15);">Register Now</span>
      <h2 class="section-h" style="margin-top: 0.8rem;">Be Part of Aatmanirbhar Bharat</h2>
      <p class="section-sub">Join 1PPS and build a product that matters for India. It takes under 2 minutes to apply. Applications close April 15, 2026.</p>

      <div class="register-form" id="reg-form-wrap">
        <div class="reg-row">
          <div class="reg-field">
            <label>First Name *</label>
            <input type="text" id="reg-fname" placeholder="Arjun" required/>
          </div>
          <div class="reg-field">
            <label>Last Name *</label>
            <input type="text" id="reg-lname" placeholder="Sharma" required/>
          </div>
        </div>
        <div class="reg-field">
          <label>Email Address *</label>
          <input type="email" id="reg-email" placeholder="you@college.edu.in" required/>
        </div>
        <div class="reg-field">
          <label>College / University *</label>
          <input type="text" id="reg-college" placeholder="e.g. IIT Delhi, Delhi University…"/>
        </div>
        <div class="reg-field">
          <label>Contact Number</label>
          <input type="tel" id="reg-phone" placeholder="+91 98765 43210"/>
        </div>
        <div class="reg-row">
          <div class="reg-field">
            <label>Year of Study</label>
            <select id="reg-year">
              <option value="" disabled selected>Select year</option>
              <option>1st Year</option>
              <option>2nd Year</option>
              <option>3rd Year</option>
              <option>4th Year</option>
              <option>Postgraduate</option>
            </select>
          </div>
          <div class="reg-field">
            <label>Domain of Interest</label>
            <select id="reg-domain">
              <option value="" disabled selected>Select domain</option>
              <option>Natural Language Processing</option>
              <option>Computer Vision</option>
              <option>Predictive Analytics</option>
              <option>Generative AI & LLMs</option>
              <option>Reinforcement Learning</option>
              <option>AI for Social Good</option>
            </select>
          </div>
        </div>
        <div class="reg-field">
          <label>Briefly describe your product idea (optional)</label>
          <input type="text" id="reg-idea" placeholder="e.g. A crop disease detector for farmers using phone camera…"/>
        </div>
        <button class="reg-submit" id="reg-submit-btn" onclick="handleRegSubmit(event)">
          Submit Application
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
        </button>
        <p class="reg-note">Your information is safe with us. We'll reach out within 5 business days.</p>
      </div>

      <div class="success-msg" id="reg-success">
        <div class="check">✓</div>
        <h3>Application Submitted!</h3>
        <p>Thank you for applying to PPS Cohort 2026. We'll review your application and get back to you by May 1, 2026.</p>
      </div>

      <!-- Contact strip -->
      <div style="margin-top:2.5rem; display:flex; align-items:center; justify-content:center; gap:2rem; flex-wrap:wrap;">
        <span style="color:rgba(250,247,242,0.4); font-size:0.82rem;">Have questions? Reach us at</span>
        <a href="/cdn-cgi/l/email-protection#b0d9ded6dff0c4d8d5d9dfc4d1d3d1d4d5ddc99ed3df" style="display:inline-flex; align-items:center; gap:0.5rem; background:rgba(255,255,255,0.06); border:1px solid rgba(255,255,255,0.12); border-radius:8px; padding:0.55rem 1.1rem; color:var(--cream); text-decoration:none; font-size:0.84rem; font-weight:500; transition:border-color 0.2s;" onmouseover="this.style.borderColor='rgba(232,84,26,0.5)'" onmouseout="this.style.borderColor='rgba(255,255,255,0.12)'">
&#105;&#110;&#102;&#111;&#64;&#116;&#104;&#101;&#105;&#111;&#116;&#97;&#99;&#97;&#100;&#101;&#109;&#121;&#46;&#99;&#111;
        </a>
        <a href="tel:+919354068856"
          style="display:inline-flex; align-items:center; gap:0.5rem; background:rgba(255,255,255,0.06); border:1px solid rgba(255,255,255,0.12); border-radius:8px; padding:0.55rem 1.1rem; color:var(--cream); text-decoration:none; font-size:0.84rem; font-weight:500; transition:border-color 0.2s;"
          onmouseover="this.style.borderColor='rgba(232,84,26,0.5)'" onmouseout="this.style.borderColor='rgba(255,255,255,0.12)'">
          📞 +91-9354068856
        </a>
      </div>
    </div>
  </section>

  <!-- FOOTER -->
  <footer>
      <a href="https://www.theiotacademy.co/" target="_blank" class="text-decoration-none">
      <img src="https://www.theiotacademy.co/assets/dit/images/navbar/footer-logo.svg" class="img-fluid" style="max-height: 60px;">
      </a>
    <div class="footer-links">
      <a href="https://www.theiotacademy.co/" target="_blank" class="nav-link">Home</a>
      <a href="https://www.theiotacademy.co/" target="_blank" class="nav-link">About</a>
      <a href="https://www.theiotacademy.co/all-courses" target="_blank" class="nav-link">Our Courses</a>
      <a href="https://www.theiotacademy.co/blog/" target="_blank" class="nav-link">Blogs</a>
      <!-- <a href="https://www.theiotacademy.co/ds-ml-ai-genai-by-eict-iitroorkee" target="_blank">Professional Program In Data Science, Machine Learning, AI &amp; GenAI by E&amp;ICT Academy, IIT Roorkee</a>
      <a href="https://www.theiotacademy.co/data-analytics-and-gen-ai-by-eict-iit-roorkee" target="_blank">Advanced Program in Applied Data Analytics &amp; Generative AI by E&amp;ICT Academy, IIT Roorkee</a>
      <a href="https://www.theiotacademy.co/embedded-systems-training-with-ai" target="_blank">AI-Powered Embedded &amp; IoT Program</a>
      <a href="https://www.theiotacademy.co/data-analyst-with-genai-and-agenticai-course" target="_blank">Master Data Analytics + Gen AI &amp; Agentic AI</a> -->

      <!--<a href="https://learn.upskillcampus.com/s/dashboard" target="_blank" class="nav-link">Register Now</a>-->
    </div>
    <div style="display:flex; flex-direction:column; gap:0.4rem; text-align:right;">
      <span style="color:rgba(250,247,242,0.6); font-size:0.8rem; font-weight:600;">The IoT Academy</span>
      <a href="/cdn-cgi/l/email-protection#4f26212920696c797b743b272a26203b2e2c2e2b2a2236696c7b79742c20" style="color:var(--orange); font-size:0.8rem; text-decoration:none;">&#9993; info&#64;theiotacademy&#46;co</a>
      <a href="tel:+919354068856" style="color:rgba(250,247,242,0.5); font-size:0.8rem; text-decoration:none;">📞 +91-9354068856</a>
    </div>
  </footer>

  <!-- ── ADMIN PANEL (hidden, access via ?admin in URL) ── -->
  <div id="admin-overlay" style="display:none; position:fixed; inset:0; z-index:9999; background:rgba(18,16,14,0.97); font-family:'Outfit',sans-serif; overflow-y:auto;">
    <div style="max-width:900px; margin:0 auto; padding:2.5rem 2rem;">

      <!-- Login screen -->
      <div id="admin-login" style="max-width:360px; margin:5rem auto; text-align:center;">
        <div style="font-family:'Playfair Display',serif; font-size:2rem; font-weight:900; color:#faf7f2; margin-bottom:0.4rem;">PPS Admin</div>
        <div style="color:#8a7e72; font-size:0.85rem; margin-bottom:2rem;">Enter your admin password to view registrations</div>
        <input id="admin-pw-input" type="password" placeholder="Password"
          style="width:100%; background:rgba(255,255,255,0.07); border:1px solid rgba(255,255,255,0.12); border-radius:8px; padding:0.85rem 1rem; color:#faf7f2; font-family:'Outfit',sans-serif; font-size:0.95rem; outline:none; margin-bottom:0.8rem;"
          onkeydown="if(event.key==='Enter') adminLogin()"/>
        <button onclick="adminLogin()"
          style="width:100%; background:#e8541a; color:#fff; border:none; border-radius:8px; padding:0.85rem; font-family:'Outfit',sans-serif; font-weight:700; font-size:0.95rem; cursor:pointer;">
          Login
        </button>
        <div id="admin-pw-err" style="color:#e8541a; font-size:0.8rem; margin-top:0.6rem; display:none;">Incorrect password. Try again.</div>
        <button onclick="closeAdmin()" style="margin-top:1.2rem; background:none; border:none; color:#8a7e72; font-family:'Outfit',sans-serif; font-size:0.82rem; cursor:pointer;">← Back to site</button>
      </div>

      <!-- Dashboard (shown after login) -->
      <div id="admin-dashboard" style="display:none;">
        <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:2rem; flex-wrap:wrap; gap:1rem;">
          <div>
            <div style="font-family:'Playfair Display',serif; font-size:1.8rem; font-weight:900; color:#faf7f2;">Registrations</div>
            <div style="color:#8a7e72; font-size:0.85rem;" id="admin-count-label">Loading…</div>
          </div>
          <div style="display:flex; gap:0.8rem; flex-wrap:wrap;">
            <button onclick="exportCSV()"
              style="background:#0d7a6e; color:#fff; border:none; border-radius:8px; padding:0.6rem 1.2rem; font-family:'Outfit',sans-serif; font-weight:600; font-size:0.85rem; cursor:pointer;">
              ⬇ Export CSV
            </button>
            <button onclick="clearAllData()"
              style="background:rgba(232,84,26,0.15); color:#e8541a; border:1px solid rgba(232,84,26,0.3); border-radius:8px; padding:0.6rem 1.2rem; font-family:'Outfit',sans-serif; font-weight:600; font-size:0.85rem; cursor:pointer;">
              🗑 Clear All
            </button>
            <button onclick="adminLogout()"
              style="background:rgba(255,255,255,0.07); color:#8a7e72; border:1px solid rgba(255,255,255,0.1); border-radius:8px; padding:0.6rem 1.2rem; font-family:'Outfit',sans-serif; font-weight:600; font-size:0.85rem; cursor:pointer;">
              Logout
            </button>
          </div>
        </div>

        <!-- Summary cards -->
        <div id="admin-summary" style="display:grid; grid-template-columns:repeat(4,1fr); gap:1rem; margin-bottom:2rem;"></div>

        <!-- Search -->
        <input id="admin-search" type="text" placeholder="Search by name, email or domain…"
          oninput="renderTable()"
          style="width:100%; background:rgba(255,255,255,0.06); border:1px solid rgba(255,255,255,0.1); border-radius:8px; padding:0.75rem 1rem; color:#faf7f2; font-family:'Outfit',sans-serif; font-size:0.88rem; outline:none; margin-bottom:1.2rem;"/>

        <!-- Table -->
        <div style="overflow-x:auto; border-radius:12px; border:1px solid rgba(255,255,255,0.08);">
          <table id="admin-table" style="width:100%; border-collapse:collapse; font-size:0.83rem;">
            <thead>
              <tr style="background:rgba(255,255,255,0.06); text-align:left;">
                <th style="padding:0.9rem 1rem; color:#8a7e72; font-weight:600; white-space:nowrap;">#</th>
                <th style="padding:0.9rem 1rem; color:#8a7e72; font-weight:600; white-space:nowrap;">Name</th>
                <th style="padding:0.9rem 1rem; color:#8a7e72; font-weight:600; white-space:nowrap;">Email</th>
                <th style="padding:0.9rem 1rem; color:#8a7e72; font-weight:600; white-space:nowrap;">Phone</th>
                <th style="padding:0.9rem 1rem; color:#8a7e72; font-weight:600; white-space:nowrap;">College</th>
                <th style="padding:0.9rem 1rem; color:#8a7e72; font-weight:600; white-space:nowrap;">Year</th>
                <th style="padding:0.9rem 1rem; color:#8a7e72; font-weight:600; white-space:nowrap;">Domain</th>
                <th style="padding:0.9rem 1rem; color:#8a7e72; font-weight:600; white-space:nowrap;">Idea</th>
                <th style="padding:0.9rem 1rem; color:#8a7e72; font-weight:600; white-space:nowrap;">Submitted</th>
                <th style="padding:0.9rem 1rem; color:#8a7e72; font-weight:600; white-space:nowrap;">Del</th>
              </tr>
            </thead>
            <tbody id="admin-tbody"></tbody>
          </table>
        </div>
        <div id="admin-empty" style="display:none; text-align:center; padding:3rem; color:#8a7e72;">No registrations yet.</div>
      </div>
    </div>
  </div>

  <style>
    /* Admin table row hover */
    #admin-tbody tr { border-bottom: 1px solid rgba(255,255,255,0.05); transition: background 0.15s; }
    #admin-tbody tr:hover { background: rgba(255,255,255,0.04); }
    #admin-tbody td { padding: 0.85rem 1rem; color: #e8f0f8; vertical-align: top; }
    #admin-pw-input:focus { border-color: #e8541a !important; }
    #admin-search:focus { border-color: rgba(232,84,26,0.4) !important; }
  </style>


  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.8/js/bootstrap.min.js" integrity="sha512-nKXmKvJyiGQy343jatQlzDprflyB5c+tKCzGP3Uq67v+lmzfnZUi/ZT+fc6ITZfSC5HhaBKUIvr/nTLCV+7F+Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script>
    // ── CONFIG ──
    // STEP 1: Paste your Google Apps Script URL below after deployment
    const SHEET_URL = 'https://script.google.com/macros/s/AKfycbyfEbP_lJwUSamaWR5n3laSc0U3_3Ha6ZKwN8YISO0ob7nnaOELAmRL_YX2avFO7a1u/exec';
    const ADMIN_PASSWORD = 'pps2025';
    const STORAGE_KEY = 'pps_registrations'; // kept as local backup

    // ── COUNTDOWN ──
    function updateCountdown() {
      const target = new Date('2026-04-15T23:59:59');
      const diff = target - new Date();
      if (diff <= 0) { ['cd-days','cd-hours','cd-mins','cd-secs'].forEach(id => document.getElementById(id).textContent = '00'); return; }
      document.getElementById('cd-days').textContent  = String(Math.floor(diff/86400000)).padStart(2,'0');
      document.getElementById('cd-hours').textContent = String(Math.floor((diff%86400000)/3600000)).padStart(2,'0');
      document.getElementById('cd-mins').textContent  = String(Math.floor((diff%3600000)/60000)).padStart(2,'0');
      document.getElementById('cd-secs').textContent  = String(Math.floor((diff%60000)/1000)).padStart(2,'0');
    }
    updateCountdown(); setInterval(updateCountdown, 1000);

    // ── STORAGE HELPERS (local backup) ──
    function getRegistrations() {
      try { return JSON.parse(localStorage.getItem(STORAGE_KEY) || '[]'); } catch { return []; }
    }
    function saveRegistrations(data) {
      localStorage.setItem(STORAGE_KEY, JSON.stringify(data));
    }

    // ── SEND TO GOOGLE SHEETS ──
    async function saveEntry(entry) {
      const all = getRegistrations();
      if (all.find(r => r.email.toLowerCase() === entry.email.toLowerCase())) return 'duplicate';

      // Save locally as backup
      all.push(entry);
      saveRegistrations(all);

      // Send to Google Sheets — using script tag trick (bypasses CORS completely)
      if (SHEET_URL) {
        return new Promise((resolve) => {
          const params = new URLSearchParams({
            fname:       entry.fname || '',
            lname:       entry.lname || '',
            email:       entry.email || '',
            phone:       entry.phone || '',
            college:     entry.college || '',
            year:        entry.year || '',
            domain:      entry.domain || '',
            idea:        entry.idea || '',
            source:      entry.source || '',
            submittedAt: entry.submittedAt || ''
          });
          const script = document.createElement('script');
          const cbName = 'pps_cb_' + Date.now();
          window[cbName] = function(response) {
            delete window[cbName];
            document.body.removeChild(script);
            resolve('ok');
          };
          script.onerror = function() {
            // even on error, data is saved locally
            try { document.body.removeChild(script); } catch(e) {}
            resolve('ok');
          };
          // Timeout fallback after 5s
          setTimeout(() => resolve('ok'), 5000);
          script.src = SHEET_URL + '?' + params.toString() + '&callback=' + cbName;
          document.body.appendChild(script);
        });
      }
      return 'ok';
    }

    // ── HERO FORM ──
    async function handleHeroSubmit(event) {
      event.preventDefault();
      var btn = document.getElementById('hero-submit-btn');
      var fname  = document.getElementById('hero-fname').value.trim();
      var lname  = document.getElementById('hero-lname').value.trim();
      var email  = document.getElementById('hero-email').value.trim();
      var phone  = document.getElementById('hero-phone-input').value.trim();
      var domain = document.getElementById('hero-domain').value;
      if (!fname || !email) { alert('Please enter your first name and email.'); return; }
      btn.disabled = true;
      btn.textContent = 'Submitting…';
      var result = await saveEntry({ fname:fname, lname:lname, email:email, phone:phone, college:'', year:'', domain:domain, idea:'', source:'hero', submittedAt: new Date().toISOString() });
      document.getElementById('hero-fname').value = '';
      document.getElementById('hero-lname').value = '';
      document.getElementById('hero-email').value = '';
      document.getElementById('hero-phone-input').value = '';
      document.getElementById('hero-domain').selectedIndex = 0;
      btn.disabled = false;
      if (result === 'duplicate') {
        btn.textContent = '✓ Already registered!';
        btn.style.background = 'var(--teal)'; btn.style.color = '#fff';
      } else {
        btn.textContent = '✓ You\'re on the list!';
        btn.style.background = 'var(--teal)'; btn.style.color = '#fff';
      }
      setTimeout(function() {
        btn.textContent = 'Apply for Free';
        btn.style.background = ''; btn.style.color = '';
      }, 4000);
    }

    // ── MAIN REGISTER FORM ──
    async function handleRegSubmit(event) {
      event.preventDefault();
      var submitBtn = document.getElementById('reg-submit-btn');
      var fname   = document.getElementById('reg-fname').value.trim();
      var lname   = document.getElementById('reg-lname').value.trim();
      var email   = document.getElementById('reg-email').value.trim();
      var phone   = document.getElementById('reg-phone').value.trim();
      var college = document.getElementById('reg-college').value.trim();
      var year    = document.getElementById('reg-year').value;
      var domain  = document.getElementById('reg-domain').value;
      var idea    = document.getElementById('reg-idea').value.trim();
      if (!fname || !email) { alert('Please fill in your name and email.'); return; }
      submitBtn.disabled = true;
      submitBtn.textContent = 'Submitting…';
      var result = await saveEntry({ fname:fname, lname:lname, email:email, phone:phone, college:college, year:year, domain:domain, idea:idea, source:'main', submittedAt: new Date().toISOString() });
      document.getElementById('reg-fname').value = '';
      document.getElementById('reg-lname').value = '';
      document.getElementById('reg-email').value = '';
      document.getElementById('reg-phone').value = '';
      document.getElementById('reg-college').value = '';
      document.getElementById('reg-idea').value = '';
      document.getElementById('reg-year').selectedIndex = 0;
      document.getElementById('reg-domain').selectedIndex = 0;
      submitBtn.disabled = false;
      submitBtn.innerHTML = 'Submit Application <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>';
      if (result === 'duplicate') {
        alert('This email is already registered. We\'ll be in touch!');
        return;
      }
      document.getElementById('reg-form-wrap').style.display = 'none';
      document.getElementById('reg-success').style.display = 'block';
      setTimeout(function() {
        document.getElementById('reg-success').style.display = 'none';
        document.getElementById('reg-form-wrap').style.display = 'block';
      }, 5000);
    }


    // ── FAQ ──
    function toggleFaq(btn) {
      const answer = btn.nextElementSibling;
      const isOpen = answer.classList.contains('open');
      document.querySelectorAll('.faq-a').forEach(a => a.classList.remove('open'));
      document.querySelectorAll('.faq-q').forEach(b => b.classList.remove('open'));
      if (!isOpen) { answer.classList.add('open'); btn.classList.add('open'); }
    }

    // ── SCROLL REVEAL ──
    const revealObs = new IntersectionObserver(entries => {
      entries.forEach(e => { if (e.isIntersecting) e.target.classList.add('visible'); });
    }, { threshold: 0.1 });
    document.querySelectorAll('.reveal').forEach(el => revealObs.observe(el));

    // ── ACTIVE NAV ──
    const navSections = document.querySelectorAll('section[id], div[id]');
    window.addEventListener('scroll', () => {
      let cur = '';
      navSections.forEach(s => { if (window.scrollY >= s.offsetTop - 120) cur = s.id; });
      document.querySelectorAll('.nav-link').forEach(a => {
        a.style.color = a.getAttribute('href') === '#'+cur ? 'var(--orange)' : '';
      });
    });

    // ── ADMIN: open via URL ?admin ──
    if (window.location.search.includes('admin')) {
      document.getElementById('admin-overlay').style.display = 'block';
      document.body.style.overflow = 'hidden';
    }

    function closeAdmin() {
      document.getElementById('admin-overlay').style.display = 'none';
      document.body.style.overflow = '';
      window.history.replaceState({}, '', window.location.pathname);
    }

    function adminLogin() {
      const pw = document.getElementById('admin-pw-input').value;
      if (pw === ADMIN_PASSWORD) {
        document.getElementById('admin-login').style.display = 'none';
        document.getElementById('admin-dashboard').style.display = 'block';
        renderDashboard();
      } else {
        document.getElementById('admin-pw-err').style.display = 'block';
        document.getElementById('admin-pw-input').value = '';
      }
    }

    function adminLogout() {
      document.getElementById('admin-login').style.display = 'block';
      document.getElementById('admin-dashboard').style.display = 'none';
      document.getElementById('admin-pw-input').value = '';
      document.getElementById('admin-pw-err').style.display = 'none';
    }

    function renderDashboard() {
      const data = getRegistrations();
      // Summary cards
      const domainCounts = {};
      data.forEach(r => { domainCounts[r.domain || 'Not specified'] = (domainCounts[r.domain || 'Not specified'] || 0) + 1; });
      const topDomain = Object.entries(domainCounts).sort((a,b) => b[1]-a[1])[0];
      const summary = document.getElementById('admin-summary');
      summary.innerHTML = [
        { label: 'Total Applications', val: data.length, color: '#e8541a' },
        { label: 'This Week', val: data.filter(r => new Date(r.submittedAt) > new Date(Date.now()-7*86400000)).length, color: '#0d7a6e' },
        { label: 'Top Domain', val: topDomain ? topDomain[0].split(' ')[0] : '—', color: '#f5c518' },
        { label: 'Latest Entry', val: data.length ? new Date(data[data.length-1].submittedAt).toLocaleDateString('en-IN',{day:'numeric',month:'short'}) : '—', color: '#8a7e72' },
      ].map(c => `
        <div style="background:rgba(255,255,255,0.05); border:1px solid rgba(255,255,255,0.08); border-radius:10px; padding:1.2rem;">
          <div style="font-size:1.6rem; font-weight:800; color:${c.color}; font-family:'Playfair Display',serif;">${c.val}</div>
          <div style="font-size:0.75rem; color:#8a7e72; margin-top:0.2rem;">${c.label}</div>
        </div>`).join('');
      renderTable();
    }

    function renderTable() {
      const all = getRegistrations();
      const q = (document.getElementById('admin-search').value || '').toLowerCase();
      const filtered = q ? all.filter(r =>
        (r.fname+' '+r.lname).toLowerCase().includes(q) ||
        r.email.toLowerCase().includes(q) ||
        (r.domain||'').toLowerCase().includes(q) ||
        (r.college||'').toLowerCase().includes(q)
      ) : all;

      document.getElementById('admin-count-label').textContent = `${all.length} total · ${filtered.length} shown`;
      const tbody = document.getElementById('admin-tbody');

      if (filtered.length === 0) {
        tbody.innerHTML = '';
        document.getElementById('admin-empty').style.display = 'block';
        return;
      }
      document.getElementById('admin-empty').style.display = 'none';

      tbody.innerHTML = filtered.slice().reverse().map((r, i) => `
        <tr>
          <td style="color:#8a7e72;">${filtered.length - i}</td>
          <td><strong>${esc(r.fname)} ${esc(r.lname)}</strong></td>
          <td style="color:#0d7a6e;">${esc(r.email)}</td>
          <td>${esc(r.phone || '—')}</td>
          <td>${esc(r.college || '—')}</td>
          <td>${esc(r.year || '—')}</td>
          <td><span style="background:rgba(232,84,26,0.12);color:#e8541a;padding:0.15rem 0.5rem;border-radius:4px;font-size:0.72rem;font-weight:600;">${esc(r.domain || '—')}</span></td>
          <td style="max-width:180px; color:#8a7e72; font-size:0.78rem;">${esc(r.idea || '—')}</td>
          <td style="color:#8a7e72; white-space:nowrap;">${new Date(r.submittedAt).toLocaleDateString('en-IN',{day:'numeric',month:'short',year:'2-digit'})}</td>
          <td><button onclick="deleteEntry('${r.email}')" style="background:none;border:none;color:#8a7e72;cursor:pointer;font-size:1rem;" title="Delete">🗑</button></td>
        </tr>`).join('');
    }

    function esc(str) {
      return String(str).replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;');
    }

    function deleteEntry(email) {
      if (!confirm(`Remove ${email} from registrations?`)) return;
      saveRegistrations(getRegistrations().filter(r => r.email !== email));
      renderDashboard();
    }

    function clearAllData() {
      if (!confirm('Delete ALL registrations? This cannot be undone.')) return;
      saveRegistrations([]);
      renderDashboard();
    }

    function exportCSV() {
      const data = getRegistrations();
      if (!data.length) { alert('No registrations to export.'); return; }
      const headers = ['#','First Name','Last Name','Email','Phone','College','Year','Domain','Idea','Source','Submitted At'];
      const rows = data.map((r, i) => [
        i+1, r.fname, r.lname, r.email, r.phone, r.college, r.year, r.domain, r.idea, r.source,
        new Date(r.submittedAt).toLocaleString('en-IN')
      ].map(v => `"${String(v||'').replace(/"/g,'""')}"`).join(','));
      const csv = [headers.join(','), ...rows].join('\n');
      const blob = new Blob([csv], { type: 'text/csv' });
      const a = document.createElement('a');
      a.href = URL.createObjectURL(blob);
      a.download = `pps-registrations-${new Date().toISOString().slice(0,10)}.csv`;
      a.click();
    }
  </script>
</body>
</html>