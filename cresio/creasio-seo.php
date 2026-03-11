<!DOCTYPE html>
<html lang="en" style="scroll-behavior: smooth;">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Creasio – Complete</title>
  <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
  <style>
    :root {
      --purple-main: #7047d4;
      --purple-dark: #6030c0;
      --cyan: #22d3ee;
      --text-main: #1a1a2e;
      --text-light: #8b8b8b;
      --white: #ffffff;
      --grey-ph: #d2d2d2;
    }

    *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }

    body {
      font-family: 'Manrope', sans-serif;
      background: var(--white);
      color: var(--text-main);
      overflow-x: hidden;
    }

    .container { max-width: 1200px; margin: 0 auto; padding: 0 60px; }

    .split-title { font-size: 2.2rem; font-weight: 800; color: var(--purple-main); line-height: 1.2; }
    .split-desc { color: var(--text-light); font-size: 0.88rem; line-height: 1.75; }
    .split-header { display: grid; grid-template-columns: 1fr 1fr; gap: 60px; margin-bottom: 52px; align-items: start; }

    .diamond { width: 12px; height: 12px; background: var(--cyan); transform: rotate(45deg); border-radius: 2px; }

    /* ── HERO ── */
    .hero { 
      background: var(--purple-main); 
      color: var(--white); 
      position: relative; 
      overflow: hidden; 
      min-height: 500px; 
    }

    .hero-curves-top-right { 
      position: absolute; 
      top: 0; 
      right: 0; 
      width: 45%;  
      height: 100%; 
      pointer-events: none; 
      z-index: 1; 
    }

    /* ── NAVIGATION ── */
    nav { 
      display: flex; 
      justify-content: space-between; 
      align-items: center; 
      padding: 32px 0; 
      position: relative; 
      z-index: 100; 
    }

    .logo { font-weight: 800; font-size: 1rem; letter-spacing: 2px; }
    .nav-links { display: flex; gap: 36px; list-style: none; }
    
    .nav-links a { 
      color: white; 
      text-decoration: none; 
      font-size: 0.82rem; 
      font-weight: 500; 
      opacity: 0.8; 
      transition: opacity 0.3s, color 0.3s; 
      position: relative;
      padding: 4px 0;
    }

    /* PREMIUM HOVER EFFECT: Expanding Center Line */
    .nav-links a::after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 50%;
      width: 0;
      height: 2px;
      background: var(--cyan);
      transition: all 0.3s ease-in-out;
      transform: translateX(-50%);
    }

    .nav-links a:hover {
      opacity: 1;
      color: var(--cyan);
    }

    .nav-links a:hover::after {
      width: 100%;
    }

    /* HAMBURGER MENU */
    .hamburger {
      display: none;
      flex-direction: column;
      cursor: pointer;
      gap: 6px;
      z-index: 101;
    }
    .hamburger span {
      width: 25px;
      height: 2px;
      background: white;
      transition: 0.3s;
    }

    @media (max-width: 768px) {
      .container { padding: 0 30px; }
      .hamburger { display: flex; }
      .nav-links {
        position: fixed;
        top: 0;
        right: -100%;
        width: 100%;
        height: 100vh;
        background: var(--purple-dark);
        flex-direction: column;
        justify-content: center;
        align-items: center;
        transition: 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        z-index: 99;
        gap: 40px;
      }
      .nav-links.active { right: 0; }
      .nav-links a { font-size: 1.2rem; }
      
      .hamburger.active span:nth-child(1) { transform: translateY(8px) rotate(45deg); }
      .hamburger.active span:nth-child(2) { opacity: 0; }
      .hamburger.active span:nth-child(3) { transform: translateY(-8px) rotate(-45deg); }

      /* PREVENT PICTURES FROM GETTING SMALL - STACK LAYOUT */
      .split-header { grid-template-columns: 1fr; gap: 20px; }
      .service-grid { grid-template-columns: 1fr; }
      .grow-grid { grid-template-columns: 1fr; gap: 50px; }
      .projects-grid { grid-template-columns: 1fr; }
      .img-comp { max-width: 100%; margin: 0 auto; }
    }

    /* 4. HERO CONTENT */
    .hero-content { 
      padding: 50px 0 40px; 
      max-width: 520px; 
      position: relative; 
      z-index: 10; 
    }

    h1 { font-size: 3.2rem; font-weight: 800; line-height: 1.15; margin-bottom: 22px; }
    .hero-subtitle { font-size: 0.88rem; opacity: 0.75; margin-bottom: 48px; line-height: 1.75; max-width: 420px; font-style: italic; }

    /* Buttons */
    .btn-wrap { position: relative; display: inline-block; }
    .btn-wire { position: absolute; top: -10px; left: -12px; width: 46px; height: 58px; border: 1px solid rgba(255,255,255,0.4); z-index: 1; pointer-events: none; }
    .btn-main { position: relative; z-index: 2; border: 1.5px solid white; padding: 13px 26px; color: white; text-decoration: none; font-weight: 700; font-size: 0.72rem; text-transform: uppercase; letter-spacing: 1.5px; transition: 0.25s; display: inline-block; background: transparent; }
    .btn-main:hover { background: white; color: var(--purple-main); }

    /* ── TRANSITION STRIP ── */
    .transition-strip {
      display: flex;
      min-height: 155px;
    }
    .strip-left {
      flex: 1;
      background: var(--purple-main);
      display: flex;
      justify-content: flex-end;
      align-items: center;
      padding: 55px 80px 55px 0;
      position: relative; 
      overflow: visible; 
    }

    .hero-curves-left {
      position: absolute;
      top: -65px; 
      left: 0;
      width: 80%;    
      height: 250px;  
      opacity: 0.8; 
      pointer-events: none;
      z-index: 1;
    }

    .hero-curves-left svg {
      width: 100%;
      height: 100%;
    }
    .strip-right {
      flex: 0 0 52%;
      background: white;
      position: relative;
      padding: 48px 60px 48px 72px;
      display: flex;
      flex-direction: column;
      justify-content: center;
    }
    .card-wire {
      position: absolute;
      top: 22px; left: 16px;
      width: calc(100% - 32px); height: calc(100% - 44px);
      border: 1px solid rgba(112,71,212,0.16);
      pointer-events: none; z-index: 0;
    }
    .junction-badge {
      position: absolute;
      left: -19px;
      top: 10%;
      transform: translateY(-50%);
      width: 38px; height: 38px;
      background-color: rgba(255, 255, 255, 0.1);;
      border-radius: 50%;
      display: flex; align-items: center; justify-content: center;
      z-index: 20;
      box-shadow: 0 4px 18px rgba(112,71,212,0.35);
    }
    .strip-right h2 { font-size: 1.5rem; font-weight: 800; margin-bottom: 10px; position: relative; z-index: 1; color: var(--text-main); }
    .strip-right p { color: var(--text-light); max-width: 300px; font-size: 0.87rem; line-height: 1.65; position: relative; z-index: 1; }

    /* Logos Section */
    .logos-section {
      background:white;
      padding: 60px 60px 60px;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 16px;
    }

    .logo-item {
      flex: 1;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 10px;
      padding: 10px 20px;
    }

    .logo-item.vertical {
      flex-direction: column;
      gap: 2px;
    }

    .logo-icon-circle {
      width: 44px;
      height: 44px;
      border-radius: 50%;
      background: #bbb;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-shrink: 0;
    }

    .logo-icon-inner {
      width: 18px;
      height: 18px;
      border-radius: 50%;
      background: #888;
    }

    .logo-icon-triangle {
      position: relative;
      width: 32px;
      height: 28px;
      flex-shrink: 0;
    }

    .logo-icon-triangle::before {
      content: '';
      position: absolute;
      width: 0;
      height: 0;
      border-left: 16px solid transparent;
      border-right: 16px solid transparent;
      border-bottom: 28px solid #bbb;
    }

    .triangle-inner {
      position: absolute;
      top: 14px;
      left: 6px;
      width: 0;
      height: 0;
      border-left: 10px solid transparent;
      border-right: 10px solid transparent;
      border-bottom: 18px solid #f5f5f7;
    }

    .logo-icon-mountain {
      position: relative;
      width: 44px;
      height: 36px;
      flex-shrink: 0;
    }

    .logo-icon-mountain::before {
      content: '';
      position: absolute;
      bottom: 0;
      left: 0;
      width: 0;
      height: 0;
      border-left: 22px solid transparent;
      border-right: 22px solid transparent;
      border-bottom: 36px solid #bbb;
    }

    .logo-icon-mountain::after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 18px;
      width: 0;
      height: 0;
      border-left: 14px solid transparent;
      border-right: 14px solid transparent;
      border-bottom: 22px solid #999;
    }

    .logo-icon-star {
      width: 26px;
      height: 26px;
      border: 2.5px solid #bbb;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-shrink: 0;
    }

    .star-shape {
      width: 10px;
      height: 10px;
      background: #bbb;
      clip-path: polygon(50% 0%,61% 35%,98% 35%,68% 57%,79% 91%,50% 70%,21% 91%,32% 57%,2% 35%,39% 35%);
    }

    .logo-text-plain {
      font-size: 13px;
      font-weight: 500;
      color: #aaa;
      letter-spacing: 1px;
      text-transform: uppercase;
    }

    .logo-name {
      font-family: 'Poppins', sans-serif;
      font-size: 13px;
      font-weight: 700;
      color: #777;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }

    .logo-name.small {
      font-size: 11px;
      margin-left: 6px;
    }

    .logo-sub {
      display: block;
      font-size: 9px;
      font-weight: 400;
      color: #aaa;
      text-transform: none;
      letter-spacing: 0;
    }

    .logo-block-text {
      font-family: 'Poppins', sans-serif;
      font-size: 22px;
      font-weight: 900;
      color: #bbb;
      letter-spacing: 1px;
      text-transform: uppercase;
    }

    .logo-block-sub {
      font-size: 8px;
      color: #ccc;
      letter-spacing: 0.5px;
      text-align: center;
    }
    
    /* ── SERVICES ── */
    .services-section { padding: 85px 0 80px; }
    .service-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 28px; }
    
    .service-card { 
      background: #fafafa; 
      padding: 36px 28px; 
      border: 1px solid #eeeeee; 
      transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1); 
      position: relative;
      overflow: hidden;
      z-index: 1;
    }

    /* GRADIENT PURPLE HIGHLIGHT EFFECT */
    .service-card:hover { 
      background: linear-gradient(135deg, #ffffff 0%, #f3efff 100%);
      border-color: var(--purple-main); 
      box-shadow: 0 15px 45px rgba(112, 71, 212, 0.15);
      transform: translateY(-8px); 
    }

    .service-card:hover .icon-ring {
      background: var(--purple-main);
      border-color: var(--purple-main);
      box-shadow: 0 5px 15px rgba(112, 71, 212, 0.3);
    }

    .service-card:hover .icon-ring svg {
      stroke: #ffffff;
      transform: scale(1.1);
    }

    .icon-ring { 
      width: 44px; height: 44px; 
      border: 1.5px solid #dcd3f5; 
      border-radius: 50%; 
      margin-bottom: 22px; 
      display: flex; align-items: center; justify-content: center; 
      transition: all 0.3s ease;
    }
    .icon-ring svg { 
      width: 18px; height: 18px; 
      stroke: var(--purple-main); 
      fill: none; 
      stroke-width: 2; 
      stroke-linecap: round; 
      stroke-linejoin: round; 
      transition: all 0.3s ease;
    }
    
    .service-card h4 { font-size: 1rem; font-weight: 800; margin-bottom: 12px; color: var(--text-main); }
    .service-card p { font-size: 0.83rem; color: var(--text-light); line-height: 1.7; }

    /* ── GROW ── */
    .grow-section { padding: 80px 0 90px; }
    .grow-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 90px; align-items: center; }
    .img-comp { position: relative; width: 100%; max-width: 420px; }
    .img-wire { position: absolute; top: -36px; left: -36px; width: 160px; height: 100%; border: 1.5px solid rgba(112,71,212,0.18); z-index: 1; pointer-events: none; }
    .img-box { 
      position: relative; 
      width: 100%; 
      aspect-ratio: 0.88; 
      background: var(--grey-ph); 
      z-index: 2; 
      overflow: hidden; 
    }

    .img-box .slide {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      object-fit: cover;
      opacity: 0; 
      animation: fadeSlideshow 12s infinite; 
    }

    .img-box .slide:nth-child(1) { animation-delay: 0s; }
    .img-box .slide:nth-child(2) { animation-delay: 4s; }
    .img-box .slide:nth-child(3) { animation-delay: 8s; }

    @keyframes fadeSlideshow {
      0%   { opacity: 0; }
      10%  { opacity: 1; } 
      33%  { opacity: 1; } 
      43%  { opacity: 0; } 
      100% { opacity: 0; }
    }
    .img-badge {
    position: absolute;
    left: -22px; 
    top: 48%;
    transform: translateY(-50%);
    width: 44px;
    height: 44px;
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 10;
    }

    .img-badge::before {
    content: "";
    position: absolute;
    top: 0; left: 0; right: 0; bottom: 0;
    background: var(--purple-main);
    border-radius: 50%;
    clip-path: inset(0 50% 0 0);
    box-shadow: 0 6px 20px rgba(112,71,212,0.3);
    z-index: -1; 
    }

    .grow-text h2 { margin-bottom: 18px; }
    .grow-text .split-desc { margin-bottom: 48px; max-width: 360px; }
    .stats-row { display: flex; gap: 48px; }
    .stat-num { font-size: 2.3rem; font-weight: 800; color: var(--cyan); display: block; margin-bottom: 6px; line-height: 1; }
    .stat-lbl { font-size: 0.82rem; color: var(--text-light); line-height: 1.5; }

    /* ── PROJECTS ── */
    .projects-section { padding: 10px 0 90px; }
    .projects-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 36px; }
    .proj-card { position: relative; }
    .proj-img {
      position: relative;
      width: 100%;
      aspect-ratio: 1.25;
      background: var(--grey-ph);
      overflow: visible; 
    }

    .slideshow-inner {
      position: absolute;
      top: 0; left: 0;
      width: 100%; height: 100%;
      overflow: hidden; 
      z-index: 1;
    }

    .slideshow-inner .slide {
      position: absolute;
      top: 0; left: 0;
      width: 100%; height: 100%;
      object-fit: cover; 
      opacity: 0;
      animation: projectFade 12s infinite;
    }

    .slide:nth-child(1) { animation-delay: 0s; }
    .slide:nth-child(2) { animation-delay: 4s; }
    .slide:nth-child(3) { animation-delay: 8s; }

    @keyframes projectFade {
      0%   { opacity: 0; }
      10%  { opacity: 1; } 
      33%  { opacity: 1; } 
      43%  { opacity: 0; } 
      100% { opacity: 0; }
    }

    .corner-badge { position: absolute; bottom: -24px; right: 28px; width: 52px; height: 52px; border-radius: 50%; display: flex; align-items: center; justify-content: center; z-index: 10; box-shadow: 0 8px 24px rgba(0,0,0,0.15); }
    .corner-badge svg { width: 30px; height: 30px; }
    .proj-info { margin-top: 38px; }
    .proj-info h4 { font-size: 1rem; font-weight: 800; margin-bottom: 8px; color: var(--text-main); }
    .proj-info p { font-size: 0.83rem; color: var(--text-light); line-height: 1.7; }

    /* ── TEAM ── */
    .team-section { padding: 40px 0 60px; overflow: hidden; }
    .team-slider {
      width: 100%;
      max-width: 1200px;
      margin: 0 auto;
      padding: 0 20px;
    }

    .team-grid { 
      display: flex; 
      gap: 24px; 
      overflow-x: auto; 
      scroll-snap-type: x mandatory; 
      scroll-behavior: smooth;
      padding-bottom: 20px;
      -ms-overflow-style: none;  
      scrollbar-width: none;  
    }
    .team-grid::-webkit-scrollbar { display: none; }

    .team-card { 
      flex: 0 0 calc(33.333% - 16px); 
      aspect-ratio: 0.82; 
      background: var(--grey-ph); 
      position: relative; 
      scroll-snap-align: center; 
      overflow: hidden;
    }

    .team-card img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      filter: grayscale(100%); 
      opacity: 0.7;
      transition: 0.3s;
    }

    .team-card.active { 
      background: linear-gradient(to bottom, rgba(112, 71, 212, 0.2), rgba(112, 71, 212, 0.95)); 
      display: flex; 
      flex-direction: column; 
      justify-content: flex-end; 
      padding: 32px; 
      position: relative; 
      overflow: hidden;
    }

    .team-card.active img {
      display: block; 
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      object-fit: cover;
      z-index: -1; 
      filter: none; 
      opacity: 1;
    }

    @media (max-width: 900px) {
      .team-card { flex: 0 0 70%; } 
    }

    @media (max-width: 600px) {
      .team-card { flex: 0 0 85%; } 
    }

    .pagination { display: flex; justify-content: center; gap: 10px; padding: 20px 0 20px; }
    .p-dot { width: 10px; height: 10px; border-radius: 50%; background: #c5f1f8; cursor: pointer; transition: 0.3s; }
    .p-dot.active { background: var(--cyan); width: 25px; border-radius: 10px; } 

    /* ── TESTIMONIALS ── */
    .testi-section { padding: 20px 0 100px; background: #fff; }
    .testi-heading { text-align: center; margin-bottom: 50px; }
    .testi-heading h2 { font-size: 2.2rem; font-weight: 800; color: var(--purple-main); margin-bottom: 14px; }
    .testi-heading p { color: var(--text-light); font-size: 0.88rem; max-width: 420px; margin: 0 auto; line-height: 1.7; }
    .testi-grid { display: grid; grid-template-columns: 1fr 1px 1fr; gap: 60px; align-items: start; }
    .testi-divider { background: #e8e8e8; }
    .testi-top { display: flex; align-items: center; gap: 18px; margin-bottom: 18px; }
    .avatar { 
      width: 80px; 
      height: 80px; 
      background: var(--grey-ph); 
      border-radius: 50%; 
      flex-shrink: 0; 
      overflow: hidden; 
    }

    .avatar img {
      width: 100%; 
      height: 100%; 
      object-fit: cover; 
    }
    .testi-meta h4 { font-size: 0.98rem; font-weight: 800; color: var(--text-main); }
    .testi-meta span { font-size: 0.8rem; color: var(--text-light); }
    .stars { color: #f5a623; font-size: 1.2rem; letter-spacing: 2px; margin-bottom: 14px; }
    .testi-card p { font-size: 0.85rem; color: var(--text-light); line-height: 1.75; }

    :root {
      --purple-main: #8b6bde;
      --purple-dark: #6e4bc3; 
      --cyan: #00e5ff;
      --white-10: rgba(255, 255, 255, 0.1);
      --white-70: rgba(255, 255, 255, 0.7);
    }

/* ════════════════════════════════════════
   PART 4 — CTA + FOOTER
════════════════════════════════════════ */

    .cta-wrapper {
      position: relative;
      z-index: 20;
      padding: 0 120px;
      margin-bottom: -110px; 
    }

    .cta-banner {
      background: var(--purple-main);
      color: white;
      padding: 80px 40px;
      text-align: center;
      position: relative;
      box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
    }

    .cta-banner h2 { 
      font-size: 2.2rem; 
      font-weight: 800; 
      margin-bottom: 20px; 
      position: relative; 
      z-index: 2; 
    }

    .cta-banner p { 
      opacity: 0.8; 
      font-size: 0.95rem; 
      line-height: 1.8; 
      max-width: 500px; 
      margin: 0 auto 45px; 
      position: relative; 
      z-index: 2; 
    }

    .cta-btn-wrap { 
      position: relative; 
      z-index: 2; 
      display: inline-block; 
      padding: 15px 35px;
    }

    .btn-wires {
      position: absolute;
      top: 0; left: 0;
      width: 50%; height: 100%;
      border: 1px solid rgba(255, 255, 255, 0.3);
      transform: translate(-8px, 4px);
      pointer-events: none;
    }

    .btn-main {
      color: white;
      text-decoration: none;
      font-weight: 700;
      font-size: 0.85rem;
      text-transform: uppercase;
      letter-spacing: 2px;
    }

    .cta-badge {
      position: absolute;
      bottom: -23px; 
      right: 50px;
      width: 46px;
      height: 46px;
      display: flex;
      align-items: center;
      justify-content: center;
      z-index: 30;
    }

    .cta-badge::before {
      content: "";
      position: absolute;
      top: 0; left: 70px; width: 100%; height: 100%;
      background-color: rgba(255, 255, 255, 0.1);;
      border-radius: 50%;
      box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }

    .cta-badge .diamond {
      width: 12px;
      height: 12px;
      left: 70px;
      background: var(--cyan);
      transform: rotate(45deg);
      position: relative;
      z-index: 35;
    }

    footer {
      background: var(--purple-dark);
      color: white;
      padding: 180px 0 60px; 
      position: relative;
      overflow: hidden; 
    }

    .footer-wire {
      position: absolute;
      top: 50px; 
      right: 80px; 
      width: 35%; 
      height: 120px;
      border: 1px solid rgba(255, 255, 255, 0.1);
      pointer-events: none;
    }

    .footer-contact-row {
      display: grid;
      grid-template-columns: 1fr 1fr;
      padding-bottom: 50px;
      border-bottom: 1px solid rgba(255,255,255,0.1);
      margin-bottom: 60px;
    }

    .contact-label {
      font-size: 0.65rem;
      text-transform: uppercase;
      letter-spacing: 3px;
      font-weight: 800;
      color: rgba(255,255,255,0.7);
      margin-bottom: 15px;
      display: block;
    }

    .contact-item {
      display: flex;
      align-items: center;
      gap: 15px;
      font-size: 0.95rem;
      font-weight: 600;
    }

    .contact-icon {
      width: 32px; height: 32px;
      background: rgba(0, 229, 255, 0.15);
      border-radius: 50%;
      display: flex; align-items: center; justify-content: center;
    }

    .contact-icon svg { 
      width: 14px; height: 14px; 
      stroke: var(--cyan); 
      fill: none; 
      stroke-width: 2.5; 
    }

    .footer-nav-row {
      display: grid;
      grid-template-columns: 1fr 1fr 1fr auto 1.6fr;
      gap: 0;
      padding-bottom: 80px;
    }

    .f-col-title {
      font-size: 0.65rem;
      text-transform: uppercase;
      letter-spacing: 2px;
      font-weight: 800;
      margin-bottom: 25px;
      display: block;
    }

    .f-col ul { list-style: none; padding: 0; }
    .f-col li { 
      margin-bottom: 12px; 
      font-size: 0.9rem; 
      opacity: 0.6; 
    }

    .v-divider { 
      background: rgba(255,255,255,0.1); 
      width: 1px; 
      margin: 0 50px; 
    }

    .get-in-touch p { 
      font-size: 0.9rem; 
      opacity: 0.6; 
      margin-bottom: 15px; 
    }

    .f-email { 
      font-size: 1.1rem; 
      font-weight: 800; 
      color: white; 
      text-decoration: none; 
      display: block; 
      margin-bottom: 30px; 
    }

    .f-socials { display: flex; gap: 15px; }
    .f-dot { 
      width: 18px; height: 18px; 
      background: white; 
      border-radius: 50%; 
      opacity: 0.8; 
    }

    .footer-bottom {
      border-top: 1px solid rgba(255,255,255,0.1);
      padding-top: 30px;
      display: flex;
      justify-content: space-between;
      font-size: 0.8rem;
      color: rgba(255, 255, 255, 0.4);
    }

    .footer-bottom a { 
      color: inherit; 
      text-decoration: none; 
      margin-left: 30px; 
    }
  </style>
</head>
<body>

  <!-- ── HERO ── -->
  <section class="hero" id="home">
    <svg class="hero-curves-top-right" viewBox="0 0 800 600" preserveAspectRatio="none" fill="none" xmlns="http://www.w3.org/2000/svg">
      <g stroke="rgba(109, 255, 250, 0.83)" stroke-linecap="round">
        <path d="M220,-20 C180,150 350,250 500,350 C650,450 750,530 820,540" stroke-width="2.5" opacity="0.6" />
        <path d="M250,-20 C210,160 380,260 530,360 C680,460 780,550 850,560" stroke-width="1.5" opacity="0.4" />
        <path d="M100,-20 C60,200 300,300 450,400 C600,500 800,580 820,620" stroke-width="1" opacity="0.2" />
      </g>
    </svg>
    <div class="container">
      <nav>
        <div class="logo">CREASIO</div>
        
        <!-- Hamburger Menu -->
        <div class="hamburger" id="hamburger">
          <span></span><span></span><span></span>
        </div>

        <ul class="nav-links" id="nav-links">
          <li><a href="#home">Home</a></li>
          <li><a href="#about">About Us</a></li>
          <li><a href="#services">Services</a></li>
          <li><a href="#portfolio">Portfolio</a></li>
          <li><a href="#contact">Contact Us</a></li>
        </ul>
      </nav>
      <div class="hero-content">
        <h1>Grow your online business with our SEO Strategy.</h1>
        <p class="hero-subtitle">The monkey-rope is found in all whalers; but it was only in the Pequod that the monkey and his holder were ever tied together. This improvement upon the original.</p>
        <div class="btn-wrap">
          <div class="btn-wire"></div>
          <a href="#about" class="btn-main">Get Started &nbsp;›</a>
        </div>
      </div>
    </div>
  </section>

  <!-- TRANSITION STRIP -->
  <div class="transition-strip">
    <div class="strip-left">
      <svg class="hero-curves-left" viewBox="0 0 1000 500" preserveAspectRatio="none" fill="none" xmlns="http://www.w3.org/2000/svg">
        <g stroke="rgba(109, 255, 250, 0.83)" stroke-linecap="round">
          <path d="M-50,80 C150,80 180,320 400,320 C600,320 750,200 900,200 C1050,200 950,550 950,550" stroke-width="3" opacity="0.6" />
          <path d="M-50,110 C150,110 210,340 420,340 C620,340 700,240 850,240 C1000,240 920,550 920,550" stroke-width="1.5" opacity="0.4" />
          <path d="M-50,50 C120,50 150,290 370,290 C570,290 730,170 880,170 C1030,170 980,550 980,550" stroke-width="0.8" opacity="0.2" />
        </g>
      </svg>
    </div>
    <div class="strip-right">
      <div class="card-wire"></div>
      <div class="junction-badge"><div class="diamond"></div></div>
      <h2>Have a project in mind?</h2>
      <p>Being the savage's bowsman, that is, the person who pulled the bow-oar in.</p>
    </div>
  </div>

  <div class="container">
    <section class="logos-section">
      <div class="logo-item"><div class="logo-icon-circle"><div class="logo-icon-inner"></div></div><div class="logo-text"><span class="logo-name">Company <span class="logo-sub">Text Logo</span></span></div></div>
      <div class="logo-item"><div class="logo-icon-triangle"><div class="triangle-inner"></div></div><span class="logo-name">COMPANY</span></div>
      <div class="logo-item"><div class="logo-icon-mountain"></div><span class="logo-name small">A COMPANY</span></div>
      <div class="logo-item"><span class="logo-text-plain">TEXT</span><div class="logo-icon-star"><div class="star-shape"></div></div><span class="logo-text-plain">LOGO</span></div>
      <div class="logo-item vertical"><span class="logo-block-text">COMPANY</span><span class="logo-block-sub">YOUR COMPANY TAG LINE HERE</span></div>
    </section>

    <!-- SERVICES -->
    <section class="services-section" id="services">
      <div class="split-header">
        <h2 class="split-title">Our service we're<br>provide for you</h2>
        <p class="split-desc">Being the savage's bowsman, that is, the person who pulled the bow-oar in his boat (the second one from forwa).</p>
      </div>
      <div class="service-grid">
        <div class="service-card">
          <div class="icon-ring"><svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg></div>
          <h4>SEO Marketing</h4>
          <p>Being the savage's bowsman, that is, the person who pulled the bow-oar in his boat (the second one from forwa).</p>
        </div>
        <div class="service-card">
          <div class="icon-ring"><svg viewBox="0 0 24 24"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg></div>
          <h4>Email Marketing</h4>
          <p>Being the savage's bowsman, that is, the person who pulled the bow-oar in his boat (the second one from forwa).</p>
        </div>
        <div class="service-card">
          <div class="icon-ring"><svg viewBox="0 0 24 24"><path d="M3 3v18h18"/><path d="m19 9-5 5-4-4-3 3"/></svg></div>
          <h4>Marketing Statics</h4>
          <p>Being the savage's bowsman, that is, the person who pulled the bow-oar in his boat (the second one from forwa).</p>
        </div>
      </div>
    </section>

    <!-- GROW -->
    <section class="grow-section" id="about">
      <div class="grow-grid">
        <div class="img-comp">
          <div class="img-wire"></div>
          <div class="img-box">
            <img src="creasio-img/image1.jpg" alt="Slide 1" class="slide">
            <img src="creasio-img/image2.jpg" alt="Slide 2" class="slide">
            <img src="creasio-img/image3.jpg" alt="Slide 3" class="slide">
          </div>
          <div class="img-badge"><div class="diamond"></div></div>
        </div>
        <div class="grow-text">
          <h2 class="split-title">Grow your digital<br>business</h2>
          <p class="split-desc">The monkey-rope is found in all whalers; but it was only in the Pequod that the monkey and his holder were ever tied together. This improvement upon the original.</p>
          <div class="stats-row">
            <div><span class="stat-num">6K</span><p class="stat-lbl">Awesome<br>Projects.</p></div>
            <div><span class="stat-num">10</span><p class="stat-lbl">Years<br>Experienced.</p></div>
            <div><span class="stat-num">70K</span><p class="stat-lbl">Satisfied<br>Clients.</p></div>
          </div>
        </div>
      </div>
    </section>

    <!-- PROJECTS -->
    <section class="projects-section" id="portfolio">
      <div class="split-header">
        <h2 class="split-title">Our Project we work<br>previously</h2>
        <p class="split-desc">Being the savage's bowsman, that is, the person who pulled the bow-oar in his boat (the second one from forwa).</p>
      </div>
      <div class="projects-grid">
      <div class="proj-card">
        <div class="proj-img">
          <div class="slideshow-inner">
            <img src="creasio-img/place1.jpg" class="slide" alt="Travel 1">
            <img src="creasio-img/place2.jpg" class="slide" alt="Travel 2">
            <img src="creasio-img/place3.jpg" class="slide" alt="Travel 3">
          </div>
          <div class="corner-badge" style="background:#1a1a2e;">
            <svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg"><circle cx="50" cy="50" r="50" fill="white"/><circle cx="70" cy="30" r="12" fill="black"/></svg>
          </div>
        </div>
        <div class="proj-info"><h4>Travel Agency</h4><p>Being the savage's bowsman, that is, the person who pulled the bow-oar in his boat.</p></div>
      </div>
      <div class="proj-card">
        <div class="proj-img">
          <div class="slideshow-inner">
            <img src="creasio-img/food1.jpg" class="slide" alt="Food 1">
            <img src="creasio-img/food2.jpg" class="slide" alt="Food 2">
            <img src="creasio-img/food3.jpg" class="slide" alt="Food 3">
          </div>
          <div class="corner-badge" style="background:#e53535;">
            <svg viewBox="0 0 95 95" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg"><g fill="white"><path d="M50 25 L75 50 L50 38 L25 50 Z" /><path d="M50 48 L70 68 L50 88 L30 68 Z" /></g></svg>
          </div>
        </div>
        <div class="proj-info"><h4>Fast Food</h4><p>Being the savage's bowsman, that is, the person who pulled the bow-oar in his boat.</p></div>
      </div>
      </div>
    </section>

    <!-- TEAM -->
    <section class="team-section">
      <div class="split-header">
        <h2 class="split-title">Our team will be<br>help your business</h2>
        <p class="split-desc">Being the savage's bowsman, that is, the person who pulled the bow-oar in his boat.</p>
      </div>
      <div class="team-slider">
        <div class="team-grid" id="teamGrid">
          <div class="team-card" id="member1"><img src="creasio-img/person1.jpg" alt="Member 1"></div>
          <div class="team-card active" id="member2"><img src="creasio-img/person2.jpg" alt="Member 2"><h4>Sarah Weber</h4><p>Digital Marketing Expert</p><div class="team-dots"><div class="team-dot"></div><div class="team-dot"></div><div class="team-dot"></div></div></div>
          <div class="team-card" id="member3"><img src="creasio-img/person3.jpg" alt="Member 3"></div>
          <div class="team-card" id="member4"><img src="creasio-img/person4.jpg" alt="Member 4"></div>
          <div class="team-card" id="member5"><img src="creasio-img/person5.jpg" alt="Member 5"></div>
          <div class="team-card" id="member6"><img src="creasio-img/person6.jpg" alt="Member 6"></div>
          <div class="team-card" id="member7"><img src="creasio-img/person7.jpg" alt="Member 7"></div>
          <div class="team-card" id="member8"><img src="creasio-img/person8.jpg" alt="Member 8"></div>
          <div class="team-card" id="member9"><img src="creasio-img/person9.jpg" alt="Member 9"></div>
        </div>
      </div>
      <div class="pagination">
        <div class="p-dot" onclick="scrollToMember(0)"></div>
        <div class="p-dot active" onclick="scrollToMember(1)"></div>
        <div class="p-dot" onclick="scrollToMember(2)"></div>
        <div class="p-dot" onclick="scrollToMember(3)"></div>
        <div class="p-dot" onclick="scrollToMember(4)"></div>
      </div>
    </section>
  </div>

  <!-- TESTIMONIALS -->
  <section class="testi-section">
    <div class="container">
      <div class="testi-heading"><h2>What our client say<br>about us</h2><p>The monkey-rope is found in all whalers; but it was only in the Pequod that the monkey and his holder were ev.</p></div>
      <div class="testi-grid">
        <div class="testi-card">
          <div class="testi-top"><div class="avatar"><img src="creasio-img/profile1.jpg" alt="profile 1"></div><div class="testi-meta"><h4>Larry Garcia</h4><span>Manager PT. Rumah Kita</span></div></div>
          <div class="stars">★★★★☆</div>
          <p>It was a humorously perilous business for both of us. For, before we proceed further, it must be said that the monkey-rope was fast at both ends.</p>
        </div>
        <div class="testi-divider"></div>
        <div class="testi-card">
          <div class="testi-top"><div class="avatar"><img src="creasio-img/profile2.jpg" alt="profile 2"></div><div class="testi-meta"><h4>Ronald Franklin</h4><span>Founder Rumah Belajar</span></div></div>
          <div class="stars">★★★★☆</div>
          <p>The monkey-rope is found in all whalers; but it was only in the Pequod that the monkey and his holder were ever tied together.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- CTA + FOOTER -->
  <div class="cta-wrapper">
    <div class="cta-banner">
      <h2>Lets talk about your project</h2>
      <p>The monkey-rope is found in all whalers; but it was only in the Pequod that the monkey and his holder were ev.</p>
      <div class="cta-btn-wrap"><div class="btn-wires"></div><a href="#contact" class="btn-main">Contact Us &nbsp;›</a></div>
      <div class="cta-badge"><div class="diamond"></div></div>
    </div>
  </div>

  <footer id="contact">
    <div class="footer-wire"></div>
    <div class="container">
      <div class="footer-contact-row">
        <div class="contact-block"><span class="contact-label">Phone</span><div class="contact-item"><div class="contact-icon"><svg viewBox="0 0 24 24"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12a19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 3.6 1.27h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L7.91 8.91a16 16 0 0 0 6 6l.91-.91a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg></div>+1 808-779-9013</div></div>
        <div class="contact-block"><span class="contact-label">Address</span><div class="contact-item"><div class="contact-icon"><svg viewBox="0 0 24 24"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg></div>425-C Maluniu Ave, Kailua, HI 96734</div></div>
      </div>
      <div class="footer-nav-row">
        <div class="f-col"><span class="f-col-title">Services</span><ul><li>Digital Marketing</li><li>Content Strategy</li><li>SEO</li><li>Marketing Consultant</li></ul></div>
        <div class="f-col"><span class="f-col-title">Help and Advice</span><ul><li>How it works</li><li>Contact support</li></ul></div>
        <div class="f-col"><span class="f-col-title">Company</span><ul><li>Blog</li><li>Pricing</li><li>Our Team</li></ul></div>
        <div class="v-divider"></div>
        <div class="f-col get-in-touch"><span class="f-col-title">Get In Touch</span><p>Feel free to get in touch with us via email</p><a href="mailto:hello@hellow.com" class="f-email">hello@hellow.com</a><div class="f-socials"><div class="f-dot"></div><div class="f-dot"></div><div class="f-dot"></div></div></div>
      </div>
      <div class="footer-bottom"><p>Copyright © 2020 Hellow | all right reserved</p><div><a href="#">Terms Of Services</a><a href="#">Privacy Policy</a></div></div>
    </div>
  </footer>

<script>
  // Hamburger menu logic
  const hamburger = document.getElementById('hamburger');
  const navLinks = document.getElementById('nav-links');

  hamburger.addEventListener('click', () => {
    hamburger.classList.toggle('active');
    navLinks.classList.toggle('active');
  });

  // Close menu when link is clicked
  document.querySelectorAll('.nav-links a').forEach(link => {
    link.addEventListener('click', () => {
      hamburger.classList.remove('active');
      navLinks.classList.remove('active');
    });
  });

  // Team slider logic
  function scrollToMember(index) {
    const grid = document.getElementById('teamGrid');
    const cardWidth = grid.querySelector('.team-card').offsetWidth + 24;
    grid.scrollTo({ left: cardWidth * index, behavior: 'smooth' });
    document.querySelectorAll('.p-dot').forEach((dot, i) => {
      dot.classList.toggle('active', i === index);
    });
  }
</script>
</body>
</html>