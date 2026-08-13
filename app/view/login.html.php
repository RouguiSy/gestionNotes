<?php $erreurConnexion = $erreurConnexion ?? false; ?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Connexion à DiangÉcole</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Manrope:wght@700;800&display=swap" rel="stylesheet">
<style>
  :root{
    --dark-green: #0e2419;
    --dark-green-2: #123021;
    --mint: #a9e8c3;
    --mint-soft: #cdeedb;
    --brand-green: #1f5a3c;
    --brand-green-2: #16432c;
    --ink: #14201a;
    --muted: #6b7770;
    --line: #e6e9e6;
    --card-bg: #fbfdfc;
    --card-bg-hover: #f2f7f4;
  }

  *{box-sizing:border-box; margin:0; padding:0;}

  body{
    font-family:'Inter', sans-serif;
    color: var(--ink);
    min-height:100vh;
  }

  .page{
    display:grid;
    grid-template-columns: 1fr 1fr;
    min-height:100vh;
  }

  /* ---------- LEFT PANEL ---------- */
  .panel-left{
    background: radial-gradient(circle at 85% 90%, #163826 0%, var(--dark-green) 45%),
                var(--dark-green);
    color:#fff;
    padding: 56px 64px;
    display:flex;
    flex-direction:column;
    justify-content:space-between;
    position:relative;
    overflow:hidden;
  }

  .panel-left::before{
    content:"";
    position:absolute;
    right:-140px;
    bottom:-160px;
    width:520px;
    height:520px;
    border-radius:50%;
    border:1px solid rgba(255,255,255,0.06);
  }
  .panel-left::after{
    content:"";
    position:absolute;
    right:60px;
    bottom:40px;
    width:120px;
    height:120px;
    border-radius:50%;
    background: rgba(255,255,255,0.03);
  }

  .brand-card{
    background:#fff;
    border-radius:16px;
    padding:22px 28px;
    display:inline-flex;
    align-items:center;
    gap:14px;
    width:fit-content;
    box-shadow: 0 20px 40px rgba(0,0,0,0.25);
  }

  .brand-logo{
    width:52px;
    height:52px;
    flex-shrink:0;
  }

  .brand-text .name{
    font-family:'Manrope', sans-serif;
    font-weight:800;
    font-size:26px;
    color:#16324a;
    line-height:1.1;
  }
  .brand-text .tagline{
    font-size:12.5px;
    color:#6b7280;
    margin-top:3px;
  }

  .hero-content{
    margin-top:48px;
  }

  .eyebrow-pill{
    display:inline-block;
    border:1px solid rgba(255,255,255,0.35);
    color:#dfe9e2;
    font-size:12px;
    font-weight:600;
    letter-spacing:0.08em;
    padding:8px 16px;
    border-radius:999px;
    margin-bottom:28px;
  }

  .hero-title{
    font-family:'Manrope', sans-serif;
    font-weight:800;
    font-size:56px;
    line-height:1.08;
    letter-spacing:-0.01em;
  }
  .hero-title .light{
    color:#fff;
  }
  .hero-title .accent{
    color: var(--mint);
  }

  .hero-desc{
    margin-top:26px;
    font-size:17px;
    line-height:1.55;
    color:#cdd8d1;
    max-width:460px;
    font-weight:400;
  }

  .secure-box{
    margin-top:40px;
    background: rgba(255,255,255,0.04);
    border:1px solid rgba(255,255,255,0.12);
    border-radius:14px;
    padding:16px 20px;
    display:flex;
    align-items:center;
    gap:14px;
    width:fit-content;
    backdrop-filter: blur(4px);
  }
  .secure-icon{
    width:38px;
    height:38px;
    border-radius:10px;
    background: rgba(169,232,195,0.15);
    display:flex;
    align-items:center;
    justify-content:center;
    flex-shrink:0;
  }
  .secure-box .title{
    font-size:14.5px;
    font-weight:700;
    color:#fff;
  }
  .secure-box .sub{
    font-size:13px;
    color:#aeb8b1;
    margin-top:2px;
  }

  .panel-footer{
    font-size:13px;
    color:#8a958d;
    position:relative;
    z-index:1;
  }

  /* ---------- RIGHT PANEL ---------- */
  .panel-right{
    background:#fff;
    padding: 48px 80px 60px;
    display:flex;
    flex-direction:column;
    justify-content:center;
    max-width:760px;
    margin:0 auto;
    width:100%;
  }

  .back-link{
    display:inline-flex;
    align-items:center;
    gap:6px;
    font-size:14px;
    font-weight:600;
    color:#3b4a41;
    text-decoration:none;
    width:fit-content;
    margin-bottom:36px;
  }
  .back-link svg{width:16px;height:16px;}

  .eyebrow{
    font-size:12px;
    font-weight:700;
    letter-spacing:0.1em;
    color: var(--brand-green);
    margin-bottom:10px;
  }

  h1.title{
    font-family:'Manrope', sans-serif;
    font-size:38px;
    font-weight:800;
    color:#12211a;
    letter-spacing:-0.01em;
  }

  .subtitle{
    margin-top:10px;
    font-size:15.5px;
    color:#5c665f;
  }

  .profile-grid{
    margin-top:28px;
    display:grid;
    grid-template-columns: 1fr 1fr;
    gap:14px;
  }

  .profile-card{
    border:1px solid var(--line);
    border-radius:14px;
    padding:16px 18px;
    display:flex;
    align-items:flex-start;
    gap:14px;
    cursor:pointer;
    background: var(--card-bg);
    transition: border-color .15s ease, background .15s ease, transform .15s ease;
    text-align:left;
  }
  .profile-card:hover{
    border-color: var(--brand-green);
    background: var(--card-bg-hover);
    transform: translateY(-1px);
  }
  .profile-card:focus-visible{
    outline:2px solid var(--brand-green);
    outline-offset:2px;
  }

  .avatar{
    width:38px;
    height:38px;
    border-radius:10px;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:13px;
    font-weight:700;
    color:#0e2419;
    flex-shrink:0;
  }
  .avatar.c1{ background:#cdeedb; }
  .avatar.c2{ background:#cfe3f2; }
  .avatar.c3{ background:#f5dfc2; }
  .avatar.c4{ background:#e4d6f5; }
  .avatar.c5{ background:#f2cfd6; }
  .avatar.c6{ background:#d9e8c9; }
  .avatar.c7{ background:#f6e2b8; }

  .profile-role{
    font-size:15px;
    font-weight:700;
    color:#16241c;
  }
  .profile-sub{
    font-size:12.5px;
    color:#8a938c;
    margin-top:2px;
  }

  .divider{
    display:flex;
    align-items:center;
    gap:14px;
    margin:32px 0 22px;
    color:#96a19a;
    font-size:13px;
  }
  .divider::before,
  .divider::after{
    content:"";
    flex:1;
    height:1px;
    background: var(--line);
  }

  label.field-label{
    display:block;
    font-size:13.5px;
    font-weight:600;
    color:#28352d;
    margin-bottom:8px;
  }

  .input-wrap{
    position:relative;
    margin-bottom:20px;
  }
  .input-wrap input{
    width:100%;
    padding:14px 16px 14px 44px;
    border:1px solid var(--line);
    border-radius:12px;
    font-size:14.5px;
    font-family:'Inter', sans-serif;
    color:#1c2620;
    background:#fff;
    transition: border-color .15s ease, box-shadow .15s ease;
  }
  .input-wrap input:focus{
    outline:none;
    border-color: var(--brand-green);
    box-shadow: 0 0 0 3px rgba(31,90,60,0.12);
  }
  .input-wrap .icon{
    position:absolute;
    left:15px;
    top:50%;
    transform:translateY(-50%);
    width:18px;
    height:18px;
    color:#9aa39c;
    pointer-events:none;
  }
  .input-wrap .icon.eye{
    left:auto;
    right:15px;
    cursor:pointer;
    pointer-events:auto;
  }

  .row-between{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:8px;
  }
  .forgot{
    font-size:13px;
    font-weight:600;
    color: var(--brand-green);
    text-decoration:none;
  }

  .remember-row{
    display:flex;
    align-items:center;
    gap:10px;
    margin-bottom:26px;
    font-size:14px;
    color:#3b453e;
  }
  .remember-row input[type="checkbox"]{
    width:18px;
    height:18px;
    accent-color: var(--brand-green);
    border-radius:4px;
  }

  .btn-submit{
    width:100%;
    background: linear-gradient(135deg, var(--brand-green) 0%, var(--brand-green-2) 100%);
    color:#fff;
    border:none;
    border-radius:12px;
    padding:16px;
    font-size:15.5px;
    font-weight:700;
    font-family:'Inter', sans-serif;
    display:flex;
    align-items:center;
    justify-content:center;
    gap:10px;
    cursor:pointer;
    transition: opacity .15s ease, transform .15s ease;
  }
  .btn-submit:hover{ opacity:0.92; }
  .btn-submit svg{ width:16px; height:16px; }

  .demo-note{
    text-align:center;
    font-size:13px;
    color:#6b756e;
    margin-top:18px;
  }
  .demo-note strong{
    color:#28352d;
    font-weight:700;
  }
  .demo-note .check{
    color: var(--brand-green);
    margin-right:4px;
  }

  /* ---------- RESPONSIVE ---------- */
  @media (max-width: 980px){
    .page{ grid-template-columns: 1fr; }
    .panel-left{ padding:40px 32px; min-height:420px; }
    .hero-title{ font-size:38px; }
    .panel-right{ padding:40px 24px 56px; max-width:100%; }
    .profile-grid{ grid-template-columns: 1fr; }
  }

  @media (prefers-reduced-motion: reduce){
    *{ transition:none !important; }
  }
</style>
</head>
<body>

<div class="page">

  <!-- ================= LEFT PANEL ================= -->
  <section class="panel-left">
    <div>
      <div class="brand-card">
        <svg class="brand-logo" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M32 8L54 18L32 28L10 18L32 8Z" fill="#16324a"/>
          <path d="M18 24V38C18 38 24 44 32 44C40 44 46 38 46 38V24" stroke="#16324a" stroke-width="2.5" fill="none" stroke-linecap="round"/>
          <circle cx="32" cy="47" r="4" fill="#e0a83c"/>
          <path d="M12 44C16 40 20 38 24 40C22 44 18 47 12 44Z" fill="#3f8f5f"/>
          <path d="M52 44C48 40 44 38 40 40C42 44 46 47 52 44Z" fill="#2e6b8f"/>
          <rect x="20" y="46" width="24" height="10" rx="1.5" fill="#e0a83c" opacity="0.9"/>
          <rect x="20" y="46" width="24" height="3" fill="#16324a" opacity="0.8"/>
        </svg>
        <div class="brand-text">
          <div class="name">DiangÉcole</div>
          <div class="tagline">Gérer aujourd'hui, réussir demain.</div>
        </div>
      </div>

      <div class="hero-content">
        <span class="eyebrow-pill">ÉDUCATION · SÉNÉGAL</span>
        <h1 class="hero-title">
          <span class="light">Une école mieux</span><br>
          <span class="light">pilotée,</span><br>
          <span class="accent">une communauté</span><br>
          <span class="accent">rapprochée.</span>
        </h1>
        <p class="hero-desc">
          Administration, pédagogie et familles réunies dans un espace clair, fiable et profondément humain.
        </p>

        <div class="secure-box">
          <div class="secure-icon">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#a9e8c3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M12 2L4 5v6c0 5.5 3.4 9.7 8 11 4.6-1.3 8-5.5 8-11V5l-8-3z"></path>
            </svg>
          </div>
          <div>
            <div class="title">Espace de démonstration sécurisé</div>
            <div class="sub">Aucune donnée réelle n'est utilisée.</div>
          </div>
        </div>
      </div>
    </div>

    <div class="panel-footer">Conçu pour les établissements sénégalais</div>
  </section>

  <!-- ================= RIGHT PANEL ================= -->
  <section class="panel-right">

    <a href="#" class="back-link">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <polyline points="15 18 9 12 15 6"></polyline>
      </svg>
      Retour au portail
    </a>

    <div class="eyebrow">RAVI DE VOUS REVOIR</div>
    <h1 class="title">Connexion à DiangÉcole</h1>
    <p class="subtitle">Choisissez un profil de démonstration ou saisissez vos identifiants.</p>
    <?php if ($erreurConnexion) : ?>
      <p style="color:#A83232;font-weight:600;margin-top:12px;">Email ou mot de passe incorrect.</p>
    <?php endif; ?>

    <div class="profile-grid">
      <button class="profile-card" type="button">
        <div class="avatar c1">AN</div>
        <div>
          <div class="profile-role">Platform Admin</div>
          <div class="profile-sub">Pilotage de DiangÉcole</div>
        </div>
      </button>

      <button class="profile-card" type="button">
        <div class="avatar c2">MB</div>
        <div>
          <div class="profile-role">Group Admin</div>
          <div class="profile-sub">Groupe Scolaire Al Amal</div>
        </div>
      </button>

      <button class="profile-card" type="button">
        <div class="avatar c3">FS</div>
        <div>
          <div class="profile-role">Direction</div>
          <div class="profile-sub">CEM Al Amal</div>
        </div>
      </button>

      <button class="profile-card" type="button">
        <div class="avatar c4">ID</div>
        <div>
          <div class="profile-role">Enseignant</div>
          <div class="profile-sub">Mathématiques · CEM Al Amal</div>
        </div>
      </button>

      <button class="profile-card" type="button">
        <div class="avatar c5">MF</div>
        <div>
          <div class="profile-role">Comptable</div>
          <div class="profile-sub">Finance du groupe Al Amal</div>
        </div>
      </button>

      <button class="profile-card" type="button">
        <div class="avatar c6">OS</div>
        <div>
          <div class="profile-role">Vie scolaire</div>
          <div class="profile-sub">Assiduité · CEM Al Amal</div>
        </div>
      </button>

      <button class="profile-card" type="button">
        <div class="avatar c7">MF</div>
        <div>
          <div class="profile-role">Parent</div>
          <div class="profile-sub">Awa &amp; Moussa Fall</div>
        </div>
      </button>
    </div>

    <div class="divider">ou avec vos identifiants</div>

    <form method="POST" action="/login">
      <label class="field-label" for="email">Adresse email</label>
      <div class="input-wrap">
        <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
          <circle cx="12" cy="7" r="4"></circle>
        </svg>
        <input type="email" id="email" name="email" placeholder="vous@etablissement.sn">
      </div>

      <div class="row-between">
        <label class="field-label" for="password" style="margin-bottom:0;">Mot de passe</label>
        <a href="#" class="forgot">Mot de passe oublié ?</a>
      </div>
      <div class="input-wrap">
        <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M12 2L4 5v6c0 5.5 3.4 9.7 8 11 4.6-1.3 8-5.5 8-11V5l-8-3z"></path>
        </svg>
        <input type="password" id="password" name="password" placeholder="Votre mot de passe">
        <svg class="icon eye" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
          <circle cx="12" cy="12" r="3"></circle>
        </svg>
      </div>

      <div class="remember-row">
        <input type="checkbox" id="remember" checked>
        <label for="remember">Rester connecté sur cet appareil</label>
      </div>

      <button class="btn-submit" type="submit">
        Se connecter
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
          <line x1="5" y1="12" x2="19" y2="12"></line>
          <polyline points="12 5 19 12 12 19"></polyline>
        </svg>
      </button>
    </form>

    <p class="demo-note"><span class="check">✓</span>Tous les comptes utilisent le mot de passe <strong>demo1234</strong></p>

  </section>

</div>

</body>
</html>