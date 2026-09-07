<?php
/**
 * Municipal Agriculture Office Jimenez - Main Landing Page
 * Path: public/index.php
 */

$pageTitle = 'Municipal Agriculture Office - Jimenez, Misamis Occidental';
$pageDescription = 'Official Portal of the Municipal Agriculture Office of Jimenez, Misamis Occidental. Empowering farmers, fisherfolk, and agricultural entrepreneurs.';
$assetBase = 'assets';
$loginUrl = 'login.php';

// Include Header & Navigation Components
require_once __DIR__ . '/../frontend/components/header.php';
require_once __DIR__ . '/../frontend/components/navbar.php';
?>

<main class="w-full pt-20 bg-surface">
  <div class="flex flex-col w-full">

    <!-- ============================================== -->
    <!-- 2. HERO / WELCOME SECTION                      -->
    <!-- ============================================== -->
    <section class="relative w-full overflow-hidden bg-primary text-on-primary min-h-[580px] flex items-center" id="home">
      <!-- Panoramic Jimenez Banner Image & Contrast Gradients -->
      <div class="absolute inset-0 bg-cover bg-center transition-transform duration-1000 scale-100" style="background-image: url('<?= $assetBase ?>/images/banners/jimenez.jpg');"></div>
      <div class="absolute inset-0 bg-gradient-to-r from-primary/95 via-primary/85 to-primary/65 z-10"></div>
      <div class="absolute inset-0 bg-gradient-to-t from-primary/90 via-transparent to-primary/40 z-10"></div>

      <div class="relative z-20 max-w-container-max mx-auto px-gutter-mobile lg:px-gutter-desktop py-space-3xl lg:py-space-4xl w-full">
        <!-- Official Eyebrow Tag -->
        <div class="inline-flex items-center gap-space-xs px-space-sm py-space-xxs rounded-full bg-surface-container-lowest/15 backdrop-blur-md text-primary-fixed mb-space-lg shadow-sm border border-primary-fixed/30">
          <span class="material-symbols-outlined text-sm" style="font-variation-settings: 'FILL' 1;">eco</span>
          <span class="font-label-sm text-xs tracking-wide uppercase font-semibold">Municipal Agriculture Office</span>
        </div>

        <!-- Main Title & Content -->
        <div class="max-w-3xl">
          <h1 class="hero-headline font-display-hero text-3xl sm:text-4xl lg:text-5xl text-on-primary font-bold tracking-tight mb-space-md leading-tight">
            Municipal Agriculture Office Jimenez
          </h1>
          <p class="font-body-xl text-base sm:text-lg text-surface-variant font-normal mb-space-xl max-w-2xl leading-relaxed">
            Promoting sustainable agriculture and fisheries development in partnership with the Department of Agriculture to empower farming and coastal communities in Jimenez, Misamis Occidental.
          </p>

          <!-- CTAs -->
          <div class="flex flex-wrap items-center gap-space-md">
            <a class="inline-flex items-center gap-space-xs px-space-xl py-space-sm rounded-xl bg-secondary-fixed text-on-secondary-fixed hover:bg-secondary-fixed-dim transition-all shadow-md font-label-lg text-sm font-bold" href="#about">
              <span>Explore Mandate</span>
              <span class="material-symbols-outlined text-base font-bold">arrow_forward</span>
            </a>
            <a class="inline-flex items-center gap-space-xs px-space-lg py-space-sm rounded-xl bg-primary-container/80 hover:bg-primary-container text-primary-fixed transition-all font-label-lg text-sm font-semibold border border-white/20" href="#contact">
              <span class="material-symbols-outlined text-base">support_agent</span>
              <span>Contact Us</span>
            </a>
          </div>
        </div>
      </div>
    </section>

    <!-- ============================================== -->
    <!-- 3. VISION, MISSION, GOAL & FUNCTIONS SECTION   -->
    <!-- ============================================== -->
    <section class="w-full py-space-4xl bg-surface-container-low" id="about">
      <div class="max-w-container-max mx-auto px-gutter-mobile lg:px-gutter-desktop">
        <!-- Strategic Direction Header -->
        <div class="text-center max-w-3xl mx-auto mb-space-2xl">
          <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-primary/10 text-primary font-bold text-xs uppercase tracking-wider mb-2">
            <span class="material-symbols-outlined text-sm">flag</span>
            <span>Strategic Direction</span>
          </div>
          <h2 class="font-headline-xl text-2xl lg:text-3xl text-on-surface font-extrabold tracking-tight">
            Vision, Mission & Goals
          </h2>
          <p class="font-body-md text-sm text-on-surface-variant mt-2 leading-relaxed">
            Guiding sustainable agro-fishery development and rural prosperity in Jimenez, Misamis Occidental.
          </p>
        </div>

        <!-- Vision, Mission & Goal Interactive Carousel -->
        <div id="blueprint-carousel" class="bg-gradient-to-br from-primary via-[#0a4224] to-primary-container text-on-primary rounded-2xl p-6 sm:p-8 lg:p-10 shadow-xl relative overflow-hidden border border-primary-fixed/25 mb-10">
          <!-- Background Subtle Seal Watermark -->
          <div class="absolute -right-8 -bottom-8 opacity-10 pointer-events-none w-72 h-72">
            <img src="<?= $assetBase ?>/images/banners/jimenez-logo-no-bg.png" alt="" class="w-full h-full object-contain">
          </div>

          <!-- Carousel Controls Bar -->
          <div class="relative z-20 flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-6 border-b border-white/15 mb-6">
            <!-- Navigation Tabs -->
            <div class="inline-flex p-1 rounded-xl bg-black/25 backdrop-blur-md border border-white/10 gap-1 self-start">
              <button data-blueprint-tab="0" class="px-4 py-1.5 rounded-lg text-xs font-bold transition-all bg-secondary-fixed text-on-secondary-fixed shadow-sm cursor-pointer">
                Vision
              </button>
              <button data-blueprint-tab="1" class="px-4 py-1.5 rounded-lg text-xs font-semibold text-white/80 hover:bg-white/10 transition-all cursor-pointer">
                Mission
              </button>
              <button data-blueprint-tab="2" class="px-4 py-1.5 rounded-lg text-xs font-semibold text-white/80 hover:bg-white/10 transition-all cursor-pointer">
                Core Goal
              </button>
            </div>

            <!-- Slide Counter + Prev / Next Arrows -->
            <div class="flex items-center gap-3 self-end sm:self-auto">
              <span data-blueprint-counter class="text-xs font-mono tracking-widest text-emerald-200 font-bold">
                01 / 03
              </span>
              <div class="flex items-center gap-1.5">
                <button data-blueprint-prev aria-label="Previous Slide" class="w-9 h-9 rounded-full bg-white/10 hover:bg-white/20 active:scale-95 text-white flex items-center justify-center transition-all border border-white/15 cursor-pointer">
                  <span class="material-symbols-outlined text-lg">chevron_left</span>
                </button>
                <button data-blueprint-next aria-label="Next Slide" class="w-9 h-9 rounded-full bg-white/10 hover:bg-white/20 active:scale-95 text-white flex items-center justify-center transition-all border border-white/15 cursor-pointer">
                  <span class="material-symbols-outlined text-lg">chevron_right</span>
                </button>
              </div>
            </div>
          </div>

          <!-- Slides Wrapper -->
          <div class="relative z-10 min-h-[250px] sm:min-h-[210px]">
            <!-- SLIDE 1: VISION -->
            <div data-blueprint-slide="0" class="blueprint-slide block opacity-100 scale-100">
              <div class="flex items-center gap-2 mb-3">
                <span class="px-3 py-0.5 rounded-full bg-secondary-fixed text-on-secondary-fixed font-bold text-[11px] uppercase tracking-wider shadow-sm">
                  Our Vision
                </span>
                <span class="text-xs text-primary-fixed/80 font-medium">Food Security & Sufficiency</span>
              </div>

              <blockquote class="text-2xl sm:text-3xl lg:text-4xl font-display-hero font-extrabold text-white tracking-tight leading-tight mb-4">
                “Work towards achieving food security & sufficiency.”
              </blockquote>

              <p class="text-surface-variant text-sm sm:text-base leading-relaxed max-w-3xl mb-6">
                Providing modern farm inputs, technical support, and coastal marine protection to ensure stable, safe, and sustainable food across all barangays of Jimenez.
              </p>

              <!-- Focus Badges -->
              <div class="pt-4 border-t border-white/15 grid grid-cols-1 sm:grid-cols-3 gap-4 text-xs">
                <div class="flex items-center gap-2 text-white">
                  <span class="material-symbols-outlined text-secondary-fixed text-lg">potted_plant</span>
                  <span class="font-medium">Food Self-Sufficiency</span>
                </div>
                <div class="flex items-center gap-2 text-white">
                  <span class="material-symbols-outlined text-secondary-fixed text-lg">water_drop</span>
                  <span class="font-medium">Marine Abundance</span>
                </div>
                <div class="flex items-center gap-2 text-white">
                  <span class="material-symbols-outlined text-secondary-fixed text-lg">shield</span>
                  <span class="font-medium">Climate-Resilient Agriculture</span>
                </div>
              </div>
            </div>

            <!-- SLIDE 2: MISSION -->
            <div data-blueprint-slide="1" class="blueprint-slide hidden opacity-0 scale-95">
              <div class="flex items-center gap-2 mb-3">
                <span class="px-3 py-0.5 rounded-full bg-secondary-fixed text-on-secondary-fixed font-bold text-[11px] uppercase tracking-wider shadow-sm">
                  Our Mission
                </span>
                <span class="text-xs text-primary-fixed/80 font-medium">Agro-Processing & Tourism</span>
              </div>

              <blockquote class="text-2xl sm:text-3xl lg:text-4xl font-display-hero font-extrabold text-white tracking-tight leading-tight mb-4">
                “Develop rural communities into dynamic men & women entrepreneurs who do profitable business out of agro-processing & eco-cultural tourism.”
              </blockquote>

              <p class="text-surface-variant text-sm sm:text-base leading-relaxed max-w-3xl mb-6">
                Guiding farmers and fisherfolk toward competitive agribusiness, value-added crop processing, and eco-tourism initiatives that raise rural household incomes.
              </p>

              <!-- Focus Badges -->
              <div class="pt-4 border-t border-white/15 grid grid-cols-1 sm:grid-cols-3 gap-4 text-xs">
                <div class="flex items-center gap-2 text-white">
                  <span class="material-symbols-outlined text-secondary-fixed text-lg">groups</span>
                  <span class="font-medium">Rural Agri-Entrepreneurs</span>
                </div>
                <div class="flex items-center gap-2 text-white">
                  <span class="material-symbols-outlined text-secondary-fixed text-lg">precision_manufacturing</span>
                  <span class="font-medium">Value-Added Agro-Processing</span>
                </div>
                <div class="flex items-center gap-2 text-white">
                  <span class="material-symbols-outlined text-secondary-fixed text-lg">tour</span>
                  <span class="font-medium">Eco-Cultural Farm Tourism</span>
                </div>
              </div>
            </div>

            <!-- SLIDE 3: GOAL -->
            <div data-blueprint-slide="2" class="blueprint-slide hidden opacity-0 scale-95">
              <div class="flex items-center gap-2 mb-3">
                <span class="px-3 py-0.5 rounded-full bg-secondary-fixed text-on-secondary-fixed font-bold text-[11px] uppercase tracking-wider shadow-sm">
                  Our Goal
                </span>
                <span class="text-xs text-primary-fixed/80 font-medium">Sustainable Stewardship</span>
              </div>

              <blockquote class="text-2xl sm:text-3xl lg:text-4xl font-display-hero font-extrabold text-white tracking-tight leading-tight mb-4">
                “Strongly upholds peoples’ initiatives towards innovative and sustainable use of earth’s resources.”
              </blockquote>

              <p class="text-surface-variant text-sm sm:text-base leading-relaxed max-w-3xl mb-6">
                Supporting community-led conservation to protect municipal soil health, watersheds, and coastal marine habitats for long-term ecological balance.
              </p>

              <!-- Focus Badges -->
              <div class="pt-4 border-t border-white/15 grid grid-cols-1 sm:grid-cols-3 gap-4 text-xs">
                <div class="flex items-center gap-2 text-white">
                  <span class="material-symbols-outlined text-secondary-fixed text-lg">volunteer_activism</span>
                  <span class="font-medium">Peoples' Initiatives</span>
                </div>
                <div class="flex items-center gap-2 text-white">
                  <span class="material-symbols-outlined text-secondary-fixed text-lg">eco</span>
                  <span class="font-medium">Sustainable Resource Use</span>
                </div>
                <div class="flex items-center gap-2 text-white">
                  <span class="material-symbols-outlined text-secondary-fixed text-lg">yard</span>
                  <span class="font-medium">Environmental Stewardship</span>
                </div>
              </div>
            </div>
          </div>

          <!-- Bottom Navigation Dots -->
          <div class="relative z-20 flex items-center justify-center gap-2 pt-6 mt-6 border-t border-white/10">
            <button data-blueprint-dot="0" aria-label="Go to Vision" class="blueprint-dot h-2 rounded-full cursor-pointer w-8 bg-secondary-fixed"></button>
            <button data-blueprint-dot="1" aria-label="Go to Mission" class="blueprint-dot h-2 rounded-full cursor-pointer w-2.5 bg-white/40 hover:bg-white/70"></button>
            <button data-blueprint-dot="2" aria-label="Go to Goal" class="blueprint-dot h-2 rounded-full cursor-pointer w-2.5 bg-white/40 hover:bg-white/70"></button>
          </div>
        </div>

        <!-- Statutory Governance & Core Mandates -->
        <div class="bg-surface-container-lowest rounded-2xl p-space-xl lg:p-space-2xl shadow-sm border border-surface-container">
          <!-- Institutional Legal Header -->
          <div class="flex flex-col md:flex-row md:items-end justify-between border-b border-surface-container pb-6 mb-8 gap-4">
            <div class="max-w-3xl">
              <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-primary/10 text-primary font-bold text-xs uppercase tracking-wider mb-2">
                <span class="material-symbols-outlined text-sm">gavel</span>
                <span>Section 482, RA 7160</span>
              </div>
              <h3 class="font-headline-xl text-2xl lg:text-3xl text-on-surface font-extrabold tracking-tight">
                Statutory Functions
              </h3>
              <p class="font-body-md text-sm text-on-surface-variant mt-2 leading-relaxed">
                Core agricultural responsibilities mandated under the Local Government Code of 1991:
              </p>
            </div>
            <div class="hidden lg:flex items-center gap-2 text-xs text-on-surface-variant bg-surface-container-low px-3 py-2 rounded-lg border border-surface-container shrink-0">
              <span class="material-symbols-outlined text-primary text-base">verified</span>
              <span>LGU Mandate</span>
            </div>
          </div>

          <!-- 3-Column Mandate Architecture -->
          <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            <!-- Mandate 1: Policy Formulation & Technical Support -->
            <div class="bg-surface-container-low/40 rounded-xl p-6 border border-surface-container hover:border-primary/40 hover:shadow-md transition-all flex flex-col justify-between">
              <div>
                <div class="flex items-center justify-between mb-4">
                  <span class="px-2.5 py-0.5 rounded-full bg-primary text-on-primary font-bold text-[11px] uppercase tracking-wider">
                    Mandate I
                  </span>
                  <div class="w-10 h-10 rounded-lg bg-primary/10 text-primary flex items-center justify-center font-bold">
                    <span class="material-symbols-outlined text-xl">policy</span>
                  </div>
                </div>
                <h4 class="font-headline-sm text-base text-on-surface font-bold mb-2">
                  Policy Formulation & Technical Support
                </h4>
                <p class="font-body-sm text-xs sm:text-sm text-on-surface-variant leading-relaxed mb-4">
                  Formulate measures for Sanggunian approval and provide technical assistance to the Mayor to ensure effective delivery of agricultural services and facilities.
                </p>
              </div>
              <div class="pt-3 border-t border-surface-container/80 space-y-1 text-[11px] text-on-surface-variant">
                <div class="flex items-center gap-1.5 text-primary font-semibold">
                  <span class="material-symbols-outlined text-xs">check_circle</span>
                  <span>Agricultural Policy Development</span>
                </div>
                <div class="flex items-center gap-1.5">
                  <span class="material-symbols-outlined text-xs text-primary">check_circle</span>
                  <span>Executive Technical Support</span>
                </div>
                <div class="flex items-center gap-1.5">
                  <span class="material-symbols-outlined text-xs text-primary">check_circle</span>
                  <span>Agrarian Facilities Delivery</span>
                </div>
              </div>
            </div>

            <!-- Mandate 2: Regulatory Enforcement -->
            <div class="bg-surface-container-low/40 rounded-xl p-6 border border-surface-container hover:border-secondary/40 hover:shadow-md transition-all flex flex-col justify-between">
              <div>
                <div class="flex items-center justify-between mb-4">
                  <span class="px-2.5 py-0.5 rounded-full bg-secondary text-on-secondary font-bold text-[11px] uppercase tracking-wider">
                    Mandate II
                  </span>
                  <div class="w-10 h-10 rounded-lg bg-secondary/10 text-secondary flex items-center justify-center font-bold">
                    <span class="material-symbols-outlined text-xl">verified_user</span>
                  </div>
                </div>
                <h4 class="font-headline-sm text-base text-on-surface font-bold mb-2">
                  Regulatory Enforcement
                </h4>
                <p class="font-body-sm text-xs sm:text-sm text-on-surface-variant leading-relaxed mb-4">
                  Enforce rules and regulations relating to agriculture and aquaculture across the municipality.
                </p>
              </div>
              <div class="pt-3 border-t border-surface-container/80 space-y-1 text-[11px] text-on-surface-variant">
                <div class="flex items-center gap-1.5 text-secondary font-semibold">
                  <span class="material-symbols-outlined text-xs">check_circle</span>
                  <span>Agri-Aqua Regulatory Compliance</span>
                </div>
                <div class="flex items-center gap-1.5">
                  <span class="material-symbols-outlined text-xs text-secondary">check_circle</span>
                  <span>Municipal Fishery Protection</span>
                </div>
                <div class="flex items-center gap-1.5">
                  <span class="material-symbols-outlined text-xs text-secondary">check_circle</span>
                  <span>Quality Standards Monitoring</span>
                </div>
              </div>
            </div>

            <!-- Mandate 3: Advisory & Livelihood Improvement -->
            <div class="bg-surface-container-low/40 rounded-xl p-6 border border-surface-container hover:border-tertiary-container/40 hover:shadow-md transition-all flex flex-col justify-between">
              <div>
                <div class="flex items-center justify-between mb-4">
                  <span class="px-2.5 py-0.5 rounded-full bg-tertiary-container text-on-tertiary-container font-bold text-[11px] uppercase tracking-wider">
                    Mandate III
                  </span>
                  <div class="w-10 h-10 rounded-lg bg-tertiary-fixed/40 text-tertiary-container flex items-center justify-center font-bold">
                    <span class="material-symbols-outlined text-xl">trending_up</span>
                  </div>
                </div>
                <h4 class="font-headline-sm text-base text-on-surface font-bold mb-2">
                  Advisory & Livelihood Improvement
                </h4>
                <p class="font-body-sm text-xs sm:text-sm text-on-surface-variant leading-relaxed mb-4">
                  Recommend measures to the Sanggunian and advise the Mayor on initiatives that improve farmer and fisherfolk livelihood and living conditions.
                </p>
              </div>
              <div class="pt-3 border-t border-surface-container/80 space-y-1 text-[11px] text-on-surface-variant">
                <div class="flex items-center gap-1.5 text-tertiary-container font-semibold">
                  <span class="material-symbols-outlined text-xs">check_circle</span>
                  <span>Livelihood & Income Programs</span>
                </div>
                <div class="flex items-center gap-1.5">
                  <span class="material-symbols-outlined text-xs text-tertiary-container">check_circle</span>
                  <span>Sanggunian & Mayor Advisory</span>
                </div>
                <div class="flex items-center gap-1.5">
                  <span class="material-symbols-outlined text-xs text-tertiary-container">check_circle</span>
                  <span>Agricultural Productivity Support</span>
                </div>
              </div>
            </div>

          </div>

          <!-- Official Governance Alignment Footnote -->
          <div class="mt-6 pt-4 border-t border-surface-container flex flex-col sm:flex-row items-center justify-between gap-3 text-xs text-on-surface-variant">
            <div class="flex items-center gap-2">
              <span class="material-symbols-outlined text-primary text-base">verified_user</span>
              <span>Exercised pursuant to Section 482 of the Local Government Code of 1991 (RA 7160).</span>
            </div>
            <span class="text-primary font-bold">Municipality of Jimenez, Misamis Occidental</span>
          </div>
        </div>
      </div>
    </section>

    <!-- ============================================== -->
    <!-- 4. PICTURES GALLERY SECTION                    -->
    <!-- ============================================== -->
    <section class="w-full py-space-4xl bg-surface" id="pictures">
      <div class="max-w-container-max mx-auto px-gutter-mobile lg:px-gutter-desktop">
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-space-xl gap-space-md">
          <div>
            <span class="font-label-sm text-xs uppercase tracking-wider text-primary font-bold">Field Activities</span>
            <h2 class="font-headline-xl text-2xl lg:text-3xl text-on-surface font-bold mt-1">Pictures & Gallery</h2>
            <p class="font-body-lg text-sm text-on-surface-variant mt-space-xxs font-medium">
              Agricultural extension, field schools, and fishery programs across Jimenez.
            </p>
          </div>

          <!-- Interactive Category Filter Tabs -->
          <div class="flex flex-wrap gap-1.5 bg-surface-container-low p-1.5 rounded-xl border border-surface-container">
            <button class="px-3 py-1 rounded-lg bg-primary text-on-primary font-label-sm text-xs font-bold shadow-sm transition-all" data-gallery-filter="all">All Fields</button>
            <button class="px-3 py-1 rounded-lg text-on-surface-variant hover:text-on-surface font-label-sm text-xs transition-all" data-gallery-filter="rice">Rice Farming</button>
            <button class="px-3 py-1 rounded-lg text-on-surface-variant hover:text-on-surface font-label-sm text-xs transition-all" data-gallery-filter="crops">High-Value Crops</button>
            <button class="px-3 py-1 rounded-lg text-on-surface-variant hover:text-on-surface font-label-sm text-xs transition-all" data-gallery-filter="trainings">Trainings</button>
            <button class="px-3 py-1 rounded-lg text-on-surface-variant hover:text-on-surface font-label-sm text-xs transition-all" data-gallery-filter="fisheries">Fisheries</button>
          </div>
        </div>

        <!-- Pictures Cards (Ready for Picture Swapping) -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-space-md" id="gallery-grid">
          
          <!-- Picture 1: Rice Farming -->
          <div class="group bg-surface-container-lowest rounded-xl overflow-hidden shadow-sm hover:shadow-md transition-all flex flex-col border border-surface-container" data-gallery-category="rice">
            <div class="gallery-photo-box h-52">
              <div class="flex flex-col items-center justify-center text-primary/40 group-hover:scale-105 transition-transform duration-300">
                <span class="material-symbols-outlined text-4xl text-primary/50">grass</span>
                <span class="text-xs font-semibold mt-1 text-on-surface-variant/70">Rice Demonstration Plot</span>
              </div>
              <span class="absolute top-2 left-2 bg-primary text-on-primary text-[11px] px-2 py-0.5 rounded font-semibold shadow-sm">
                Brgy. Corrales
              </span>
            </div>
            <div class="p-space-md flex-1 flex flex-col justify-between">
              <div>
                <span class="font-caption text-xs text-primary font-bold uppercase tracking-wider">Rice Farming & Seed Trials</span>
                <h4 class="font-headline-sm text-sm text-on-surface font-bold mt-1">Hybrid Rice Technology Field Walk</h4>
                <p class="font-body-sm text-xs text-on-surface-variant mt-1 line-clamp-2">
                  Evaluation of high-yield rice parcels with participating agrarian cluster farmers in Jimenez.
                </p>
              </div>
            </div>
          </div>

          <!-- Picture 2: High-Value Crops -->
          <div class="group bg-surface-container-lowest rounded-xl overflow-hidden shadow-sm hover:shadow-md transition-all flex flex-col border border-surface-container" data-gallery-category="crops">
            <div class="gallery-photo-box h-52 bg-tertiary-fixed/30">
              <div class="flex flex-col items-center justify-center text-tertiary-container/50 group-hover:scale-105 transition-transform duration-300">
                <span class="material-symbols-outlined text-4xl">yard</span>
                <span class="text-xs font-semibold mt-1 text-tertiary-container/70">High-Value Nursery</span>
              </div>
              <span class="absolute top-2 left-2 bg-tertiary-container text-on-tertiary-container text-[11px] px-2 py-0.5 rounded font-semibold shadow-sm">
                Brgy. Carmen
              </span>
            </div>
            <div class="p-space-md flex-1 flex flex-col justify-between">
              <div>
                <span class="font-caption text-xs text-tertiary-container font-bold uppercase tracking-wider">Agro-Processing & HVCC</span>
                <h4 class="font-headline-sm text-sm text-on-surface font-bold mt-1">Cacao Clonal Nursery Training</h4>
                <p class="font-body-sm text-xs text-on-surface-variant mt-1 line-clamp-2">
                  Training rural men and women entrepreneurs in side-grafting techniques and cacao production.
                </p>
              </div>
            </div>
          </div>

          <!-- Picture 3: Farmer Trainings -->
          <div class="group bg-surface-container-lowest rounded-xl overflow-hidden shadow-sm hover:shadow-md transition-all flex flex-col border border-surface-container" data-gallery-category="trainings">
            <div class="gallery-photo-box h-52 bg-secondary-fixed/20">
              <div class="flex flex-col items-center justify-center text-secondary/50 group-hover:scale-105 transition-transform duration-300">
                <span class="material-symbols-outlined text-4xl">school</span>
                <span class="text-xs font-semibold mt-1 text-secondary/80">Farmers Field School</span>
              </div>
              <span class="absolute top-2 left-2 bg-secondary text-on-secondary text-[11px] px-2 py-0.5 rounded font-semibold shadow-sm">
                Brgy. Sibucao
              </span>
            </div>
            <div class="p-space-md flex-1 flex flex-col justify-between">
              <div>
                <span class="font-caption text-xs text-secondary font-bold uppercase tracking-wider">Farmer Field Schools</span>
                <h4 class="font-headline-sm text-sm text-on-surface font-bold mt-1">Integrated Pest Management</h4>
                <p class="font-body-sm text-xs text-on-surface-variant mt-1 line-clamp-2">
                  Community members graduating with sustainable crop health and eco-agriculture methodologies.
                </p>
              </div>
            </div>
          </div>

          <!-- Picture 4: Fisheries -->
          <div class="group bg-surface-container-lowest rounded-xl overflow-hidden shadow-sm hover:shadow-md transition-all flex flex-col border border-surface-container" data-gallery-category="fisheries">
            <div class="gallery-photo-box h-52 bg-primary-container/20">
              <div class="flex flex-col items-center justify-center text-primary-container/60 group-hover:scale-105 transition-transform duration-300">
                <span class="material-symbols-outlined text-4xl">phishing</span>
                <span class="text-xs font-semibold mt-1 text-primary-container/80">Coastal Marine Release</span>
              </div>
              <span class="absolute top-2 left-2 bg-primary-container text-on-primary-container text-[11px] px-2 py-0.5 rounded font-semibold shadow-sm">
                Murcielagos Bay Coast
              </span>
            </div>
            <div class="p-space-md flex-1 flex flex-col justify-between">
              <div>
                <span class="font-caption text-xs text-primary-container font-bold uppercase tracking-wider">Fisheries & Coastal Waters</span>
                <h4 class="font-headline-sm text-sm text-on-surface font-bold mt-1">Fingerling Release & Mangrove Care</h4>
                <p class="font-body-sm text-xs text-on-surface-variant mt-1 line-clamp-2">
                  Aquatic preservation and marine ecosystem balance spearheaded with local fisherfolk associations.
                </p>
              </div>
            </div>
          </div>

        </div>
      </div>
    </section>

    <!-- ============================================== -->
    <!-- 5. STAFF ORGANIZATIONAL HIERARCHY              -->
    <!-- ============================================== -->
    <section class="w-full py-space-4xl bg-surface-container-low border-y border-surface-container" id="staff">
      <div class="max-w-container-max mx-auto px-gutter-mobile lg:px-gutter-desktop">
        
        <!-- Section Title & Intro (matching screenshot) -->
        <div class="text-center max-w-3xl mx-auto mb-space-2xl">
          <h2 class="font-headline-xl text-3xl sm:text-4xl text-on-surface font-bold">Staff</h2>
          <p class="font-body-lg text-sm sm:text-base text-on-surface-variant mt-2 font-medium">
            Municipal Agriculture Office personnel serving the farmers and fisherfolk of Jimenez.
          </p>
        </div>

        <!-- HIERARCHY TREE CONTAINER -->
        <div class="flex flex-col items-center">

          <!-- ========================================== -->
          <!-- TIER 1: HEAD OF OFFICE (1 Card Centered)   -->
          <!-- ========================================== -->
          <div class="w-full flex justify-center mb-6">
            <div class="w-full max-w-xs bg-surface-container-lowest p-6 rounded-2xl shadow-sm hover:shadow-md border border-surface-container flex flex-col items-center text-center transition-all card-hover-lift">
              <div class="w-28 h-28 sm:w-32 sm:h-32 rounded-full overflow-hidden mb-4 bg-surface-container border-2 border-primary/20 flex items-center justify-center shadow-inner shrink-0">
                <!-- Replace src with staff photo when ready: <img src="assets/images/staff/marissa-malon.jpg" alt="MARISSA MALON" class="w-full h-full object-cover"> -->
                <span class="material-symbols-outlined text-5xl text-primary/40">person</span>
              </div>
              <h3 class="font-headline-sm text-base font-bold text-on-surface uppercase tracking-wide">MARISSA MALON</h3>
              <p class="font-body-sm text-xs text-on-surface-variant mt-1 italic">Municipal Agriculturist</p>
            </div>
          </div>

          <!-- Tree Branch Connectors: Tier 1 to Tier 2 (visible on desktop) -->
          <div class="hidden lg:flex flex-col items-center w-full mb-6">
            <div class="hierarchy-stem-vertical h-6"></div>
            <div class="hierarchy-stem-horizontal w-2/3"></div>
            <div class="hierarchy-stem-vertical h-6"></div>
          </div>

          <!-- ========================================== -->
          <!-- TIER 2: COORDINATORS (3 Cards Centered)    -->
          <!-- ========================================== -->
          <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 w-full max-w-4xl mx-auto mb-6">
            <!-- 1. CHERLIE PINO -->
            <div class="bg-surface-container-lowest p-6 rounded-2xl shadow-sm hover:shadow-md border border-surface-container flex flex-col items-center text-center transition-all card-hover-lift">
              <div class="w-28 h-28 sm:w-32 sm:h-32 rounded-full overflow-hidden mb-4 bg-surface-container border-2 border-primary/20 flex items-center justify-center shadow-inner shrink-0">
                <!-- Replace src with staff photo when ready -->
                <span class="material-symbols-outlined text-5xl text-primary/40">person</span>
              </div>
              <h3 class="font-headline-sm text-sm sm:text-base font-bold text-on-surface uppercase tracking-wide">CHERLIE PINO</h3>
              <p class="font-body-sm text-xs text-on-surface-variant mt-1 italic">HVCC Coordinator/Fits ISS Coordinator</p>
            </div>

            <!-- 2. MARIEFE GALBO -->
            <div class="bg-surface-container-lowest p-6 rounded-2xl shadow-sm hover:shadow-md border border-surface-container flex flex-col items-center text-center transition-all card-hover-lift">
              <div class="w-28 h-28 sm:w-32 sm:h-32 rounded-full overflow-hidden mb-4 bg-surface-container border-2 border-primary/20 flex items-center justify-center shadow-inner shrink-0">
                <!-- Replace src with staff photo when ready -->
                <span class="material-symbols-outlined text-5xl text-primary/40">person</span>
              </div>
              <h3 class="font-headline-sm text-sm sm:text-base font-bold text-on-surface uppercase tracking-wide">MARIEFE GALBO</h3>
              <p class="font-body-sm text-xs text-on-surface-variant mt-1 italic">Agricultural Technologist/Corn Coordinator</p>
            </div>

            <!-- 3. LENDIE BARRIENTOS -->
            <div class="bg-surface-container-lowest p-6 rounded-2xl shadow-sm hover:shadow-md border border-surface-container flex flex-col items-center text-center transition-all card-hover-lift">
              <div class="w-28 h-28 sm:w-32 sm:h-32 rounded-full overflow-hidden mb-4 bg-surface-container border-2 border-primary/20 flex items-center justify-center shadow-inner shrink-0">
                <!-- Replace src with staff photo when ready -->
                <span class="material-symbols-outlined text-5xl text-primary/40">person</span>
              </div>
              <h3 class="font-headline-sm text-sm sm:text-base font-bold text-on-surface uppercase tracking-wide">LENDIE BARRIENTOS</h3>
              <p class="font-body-sm text-xs text-on-surface-variant mt-1 italic">Agricultural Technologist/Rice Coordinator</p>
            </div>
          </div>

          <!-- Tree Branch Connectors: Tier 2 to Tier 3 (visible on desktop) -->
          <div class="hidden lg:flex flex-col items-center w-full mb-6">
            <div class="hierarchy-stem-vertical h-6"></div>
            <div class="hierarchy-stem-horizontal w-4/5"></div>
            <div class="hierarchy-stem-vertical h-6"></div>
          </div>

          <!-- ========================================== -->
          <!-- TIER 3: TECHNOLOGISTS (4 Cards Centered)   -->
          <!-- ========================================== -->
          <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 w-full max-w-5xl mx-auto">
            <!-- 1. JOHN MARK MALALIS -->
            <div class="bg-surface-container-lowest p-6 rounded-2xl shadow-sm hover:shadow-md border border-surface-container flex flex-col items-center text-center transition-all card-hover-lift">
              <div class="w-28 h-28 sm:w-32 sm:h-32 rounded-full overflow-hidden mb-4 bg-surface-container border-2 border-primary/20 flex items-center justify-center shadow-inner shrink-0">
                <!-- Replace src with staff photo when ready -->
                <span class="material-symbols-outlined text-5xl text-primary/40">person</span>
              </div>
              <h3 class="font-headline-sm text-sm font-bold text-on-surface uppercase tracking-wide">JOHN MARK MALALIS</h3>
              <p class="font-body-sm text-xs text-on-surface-variant mt-1 italic">Agricultural Technologist/Livestock Coordinator</p>
            </div>

            <!-- 2. ROSHELLE ANN TABUZO -->
            <div class="bg-surface-container-lowest p-6 rounded-2xl shadow-sm hover:shadow-md border border-surface-container flex flex-col items-center text-center transition-all card-hover-lift">
              <div class="w-28 h-28 sm:w-32 sm:h-32 rounded-full overflow-hidden mb-4 bg-surface-container border-2 border-primary/20 flex items-center justify-center shadow-inner shrink-0">
                <!-- Replace src with staff photo when ready -->
                <span class="material-symbols-outlined text-5xl text-primary/40">person</span>
              </div>
              <h3 class="font-headline-sm text-sm font-bold text-on-surface uppercase tracking-wide">ROSHELLE ANN TABUZO</h3>
              <p class="font-body-sm text-xs text-on-surface-variant mt-1 italic">Fishery Coordinator/Agri basics Coordinator</p>
            </div>

            <!-- 3. MARY JOY BANQUE -->
            <div class="bg-surface-container-lowest p-6 rounded-2xl shadow-sm hover:shadow-md border border-surface-container flex flex-col items-center text-center transition-all card-hover-lift">
              <div class="w-28 h-28 sm:w-32 sm:h-32 rounded-full overflow-hidden mb-4 bg-surface-container border-2 border-primary/20 flex items-center justify-center shadow-inner shrink-0">
                <!-- Replace src with staff photo when ready -->
                <span class="material-symbols-outlined text-5xl text-primary/40">person</span>
              </div>
              <h3 class="font-headline-sm text-sm font-bold text-on-surface uppercase tracking-wide">MARY JOY BANQUE</h3>
              <p class="font-body-sm text-xs text-on-surface-variant mt-1 italic">Agricultural Technologist/Fishery Coordinator</p>
            </div>

            <!-- 4. JUVY PALANAS -->
            <div class="bg-surface-container-lowest p-6 rounded-2xl shadow-sm hover:shadow-md border border-surface-container flex flex-col items-center text-center transition-all card-hover-lift">
              <div class="w-28 h-28 sm:w-32 sm:h-32 rounded-full overflow-hidden mb-4 bg-surface-container border-2 border-primary/20 flex items-center justify-center shadow-inner shrink-0">
                <!-- Replace src with staff photo when ready -->
                <span class="material-symbols-outlined text-5xl text-primary/40">person</span>
              </div>
              <h3 class="font-headline-sm text-sm font-bold text-on-surface uppercase tracking-wide">JUVY PALANAS</h3>
              <p class="font-body-sm text-xs text-on-surface-variant mt-1 italic">Agricultural Technologist/Livestock Coordinator</p>
            </div>
          </div>

        </div>

      </div>
    </section>

    <!-- ============================================== -->
    <!-- 6. WEBSITE DEVELOPMENT TEAM SECTION            -->
    <!-- ============================================== -->
    <section class="w-full py-space-4xl bg-surface" id="team">
      <div class="max-w-container-max mx-auto px-gutter-mobile lg:px-gutter-desktop">
        <div class="text-center max-w-2xl mx-auto mb-space-2xl">
          <span class="font-label-sm text-xs uppercase tracking-wider text-primary font-bold">System Developers</span>
          <h2 class="font-headline-xl text-2xl lg:text-3xl text-on-surface font-bold mt-1">Website Development Team</h2>
          <p class="font-body-lg text-sm text-on-surface-variant mt-space-xxs font-medium">
            Developing and maintaining the Jimenez Agricultural Information System.
          </p>
        </div>

        <!-- 4 Developer Profile Cards (Ready for Picture Swapping) -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-space-lg">
          
          <!-- Team Member 1: NIKSUR D. BABIA -->
          <div class="bg-surface-container-lowest p-space-lg rounded-2xl shadow-sm hover:shadow-lg transition-all flex flex-col justify-between border border-surface-container group card-hover-lift sm:col-span-2 lg:col-span-3 lg:w-1/3 lg:justify-self-center">
            <div>
              <div class="staff-avatar-wrapper mx-auto mb-space-md w-24 h-24">
                <div class="w-full h-full rounded-full bg-primary/10 text-primary flex items-center justify-center border-2 border-primary/30 group-hover:scale-105 transition-transform overflow-hidden shadow-inner">
                  <!-- Replace with photo when ready -->
                  <span class="material-symbols-outlined text-4xl">terminal</span>
                </div>
              </div>

              <div class="text-center mb-space-md">
                <h3 class="font-headline-sm text-base text-on-surface font-bold leading-tight">NIKSUR D. BABIA</h3>
                <span class="inline-block px-space-xs py-0.5 rounded bg-primary text-on-primary font-label-sm text-[11px] uppercase mt-1 font-semibold">
                  Full-Stack Web
                </span>
              </div>

              <div class="developer-quote-card p-space-md rounded-xl text-on-surface-variant font-body-sm text-xs leading-relaxed">
                <span class="material-symbols-outlined text-primary-fixed-dim absolute -top-2 left-2 text-xs">format_quote</span>
                Builds and integrates the system's web applications.
              </div>
            </div>

            <div class="mt-space-lg pt-space-xs border-t border-surface-container flex justify-center gap-space-sm text-on-surface-variant">
              <span class="material-symbols-outlined text-base hover:text-primary cursor-pointer" title="Frontend & Backend">code</span>
              <span class="material-symbols-outlined text-base hover:text-primary cursor-pointer" title="Database Architecture">dns</span>
              <span class="material-symbols-outlined text-base hover:text-primary cursor-pointer" title="API Integration">data_object</span>
            </div>
          </div>

          <!-- Team Member 2: MELODY CENTINO -->
          <div class="bg-surface-container-lowest p-space-lg rounded-2xl shadow-sm hover:shadow-lg transition-all flex flex-col justify-between border border-surface-container group card-hover-lift">
            <div>
              <div class="staff-avatar-wrapper mx-auto mb-space-md w-24 h-24">
                <div class="w-full h-full rounded-full bg-secondary-fixed/30 text-secondary flex items-center justify-center border-2 border-secondary/30 group-hover:scale-105 transition-transform overflow-hidden shadow-inner">
                  <!-- Replace with photo when ready -->
                  <span class="material-symbols-outlined text-4xl">assignment</span>
                </div>
              </div>

              <div class="text-center mb-space-md">
                <h3 class="font-headline-sm text-base text-on-surface font-bold leading-tight">MELODY CENTINO</h3>
                <span class="inline-block px-space-xs py-0.5 rounded bg-secondary text-on-secondary font-label-sm text-[11px] uppercase mt-1 font-semibold">
                  Project Manager
                </span>
              </div>

              <div class="developer-quote-card p-space-md rounded-xl text-on-surface-variant font-body-sm text-xs leading-relaxed">
                <span class="material-symbols-outlined text-secondary-fixed-dim absolute -top-2 left-2 text-xs">format_quote</span>
                Coordinates project delivery, priorities, and team collaboration.
              </div>
            </div>

            <div class="mt-space-lg pt-space-xs border-t border-surface-container flex justify-center gap-space-sm text-on-surface-variant">
              <span class="material-symbols-outlined text-base hover:text-secondary cursor-pointer" title="Project Planning">fact_check</span>
              <span class="material-symbols-outlined text-base hover:text-secondary cursor-pointer" title="Team Coordination">groups</span>
              <span class="material-symbols-outlined text-base hover:text-secondary cursor-pointer" title="Delivery Tracking">task_alt</span>
            </div>
          </div>

          <!-- Team Member 3: ARRIANNE GANIH -->
          <div class="bg-surface-container-lowest p-space-lg rounded-2xl shadow-sm hover:shadow-lg transition-all flex flex-col justify-between border border-surface-container group card-hover-lift">
            <div>
              <div class="staff-avatar-wrapper mx-auto mb-space-md w-24 h-24">
                <div class="w-full h-full rounded-full bg-tertiary-fixed/40 text-tertiary-container flex items-center justify-center border-2 border-tertiary-container/30 group-hover:scale-105 transition-transform overflow-hidden shadow-inner">
                  <!-- Replace with photo when ready -->
                  <span class="material-symbols-outlined text-4xl">travel_explore</span>
                </div>
              </div>

              <div class="text-center mb-space-md">
                <h3 class="font-headline-sm text-base text-on-surface font-bold leading-tight">ARRIANNE GANIH</h3>
                <span class="inline-block px-space-xs py-0.5 rounded bg-tertiary-container text-on-tertiary-container font-label-sm text-[11px] uppercase mt-1 font-semibold">
                  Researcher/Data Analyst
                </span>
              </div>

              <div class="developer-quote-card p-space-md rounded-xl text-on-surface-variant font-body-sm text-xs leading-relaxed">
                <span class="material-symbols-outlined text-tertiary-fixed-dim absolute -top-2 left-2 text-xs">format_quote</span>
                Analyzes requirements and turns findings into actionable insights.
              </div>
            </div>

            <div class="mt-space-lg pt-space-xs border-t border-surface-container flex justify-center gap-space-sm text-on-surface-variant">
              <span class="material-symbols-outlined text-base hover:text-tertiary cursor-pointer" title="Agrarian Analytics">query_stats</span>
              <span class="material-symbols-outlined text-base hover:text-tertiary cursor-pointer" title="User Needs Assessment">find_in_page</span>
              <span class="material-symbols-outlined text-base hover:text-tertiary cursor-pointer" title="Strategic Insights">insights</span>
            </div>
          </div>

          <!-- Team Member 4: KC ABADILLA -->
          <div class="bg-surface-container-lowest p-space-lg rounded-2xl shadow-sm hover:shadow-lg transition-all flex flex-col justify-between border border-surface-container group card-hover-lift">
            <div>
              <div class="staff-avatar-wrapper mx-auto mb-space-md w-24 h-24">
                <div class="w-full h-full rounded-full bg-surface-container text-primary flex items-center justify-center border-2 border-outline/30 group-hover:scale-105 transition-transform overflow-hidden shadow-inner">
                  <!-- Replace with photo when ready -->
                  <span class="material-symbols-outlined text-4xl">verified_user</span>
                </div>
              </div>

              <div class="text-center mb-space-md">
                <h3 class="font-headline-sm text-base text-on-surface font-bold leading-tight">KC ABADILLA</h3>
                <span class="inline-block px-space-xs py-0.5 rounded bg-primary-container text-on-primary-container font-label-sm text-[11px] uppercase mt-1 font-semibold">
                  Compliance &amp; Governance Specialist
                </span>
              </div>

              <div class="developer-quote-card p-space-md rounded-xl text-on-surface-variant font-body-sm text-xs leading-relaxed">
                <span class="material-symbols-outlined text-surface-dim absolute -top-2 left-2 text-xs">format_quote</span>
                Protects standards, compliance, and responsible governance.
              </div>
            </div>

            <div class="mt-space-lg pt-space-xs border-t border-surface-container flex justify-center gap-space-sm text-on-surface-variant">
              <span class="material-symbols-outlined text-base hover:text-primary cursor-pointer" title="Policy Standards">gavel</span>
              <span class="material-symbols-outlined text-base hover:text-primary cursor-pointer" title="Risk Management">shield</span>
              <span class="material-symbols-outlined text-base hover:text-primary cursor-pointer" title="Governance Frameworks">account_balance</span>
            </div>
          </div>

        </div>
      </div>
    </section>

    <!-- ============================================== -->
    <!-- 7. CONTACT US SECTION                          -->
    <!-- ============================================== -->
    <section class="w-full py-space-4xl bg-surface-container-low" id="contact">
      <div class="max-w-container-max mx-auto px-gutter-mobile lg:px-gutter-desktop">
        <div class="max-w-3xl mb-space-2xl">
          <span class="font-label-sm text-xs uppercase tracking-wider text-primary font-bold">Get In Touch</span>
          <h2 class="font-headline-xl text-2xl lg:text-3xl text-on-surface font-bold mt-1">Contact Us</h2>
          <p class="font-body-lg text-sm text-on-surface-variant mt-space-xxs font-medium">
            Reach out to our agricultural extension desk for inquiries, programs, and farmer assistance.
          </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-space-xl">
          <!-- Contact Info & Map (5 Cols) -->
          <div class="lg:col-span-5 flex flex-col justify-between">
            <div class="space-y-space-md">
              <!-- Location -->
              <div class="flex items-start gap-space-md bg-surface-container-lowest p-space-md rounded-xl shadow-sm border border-surface-container">
                <div class="w-12 h-12 rounded-lg bg-primary/10 text-primary flex items-center justify-center shrink-0">
                  <span class="material-symbols-outlined text-2xl">location_on</span>
                </div>
                <div>
                  <span class="font-label-sm text-xs text-on-surface-variant uppercase tracking-wider font-semibold">Location</span>
                  <h4 class="font-headline-sm text-sm text-on-surface font-bold mt-0.5">Jimenez Municipal Nursery</h4>
                  <p class="font-body-sm text-xs text-on-surface-variant">Region X - Northern Mindanao, 7207 Philippines</p>
                </div>
              </div>

              <!-- Email -->
              <div class="flex items-start gap-space-md bg-surface-container-lowest p-space-md rounded-xl shadow-sm border border-surface-container">
                <div class="w-12 h-12 rounded-lg bg-primary/10 text-primary flex items-center justify-center shrink-0">
                  <span class="material-symbols-outlined text-2xl">mail</span>
                </div>
                <div>
                  <span class="font-label-sm text-xs text-on-surface-variant uppercase tracking-wider font-semibold">Email</span>
                  <h4 class="font-headline-sm text-sm text-on-surface font-bold mt-0.5 break-all">aggies.jimenez2016@gmail.com</h4>
                  <p class="font-body-sm text-xs text-on-surface-variant">Inquiries, Subsidies & Technical Support</p>
                </div>
              </div>

              <!-- Call -->
              <div class="flex items-start gap-space-md bg-surface-container-lowest p-space-md rounded-xl shadow-sm border border-surface-container">
                <div class="w-12 h-12 rounded-lg bg-primary/10 text-primary flex items-center justify-center shrink-0">
                  <span class="material-symbols-outlined text-2xl">call</span>
                </div>
                <div>
                  <span class="font-label-sm text-xs text-on-surface-variant uppercase tracking-wider font-semibold">Call</span>
                  <h4 class="font-headline-sm text-sm text-on-surface font-bold mt-0.5">+6399972388625</h4>
                  <p class="font-body-sm text-xs text-on-surface-variant">Monday to Friday: 8:00 AM – 5:00 PM</p>
                </div>
              </div>
            </div>

            <!-- Map Visualization -->
            <div class="mt-space-lg">
              <span class="font-label-sm text-xs text-on-surface-variant uppercase tracking-wider block mb-space-xxs font-semibold">Municipal Location Map</span>
              <div class="w-full h-56 rounded-xl overflow-hidden shadow-sm border border-outline-variant relative">
                <iframe class="w-full h-full border-0" loading="lazy" src="https://www.google.com/maps?q=8.3337231,123.8274478&z=17&output=embed" title="Jimenez Municipal Nursery Map" allowfullscreen>
                </iframe>
                <a class="absolute bottom-2 left-2 inline-flex items-center gap-space-xxs bg-surface-container-lowest/95 backdrop-blur-sm px-space-sm py-space-xxs rounded shadow text-primary font-label-sm text-xs font-bold hover:bg-white" href="https://www.google.com/maps/place/Jimenez+Municipal+Nursery/@8.3337231,123.8259167,17z/data=!4m14!1m7!3m6!1s0x32550301520a09c7:0x97790db3e2a40a38!2sJimenez+Municipal+Nursery!8m2!3d8.3337231!4d123.8274478!16s%2Fg%2F11k4yp3jkq!3m5!1s0x32550301520a09c7:0x97790db3e2a40a38!8m2!3d8.3337231!4d123.8274478!16s%2Fg%2F11k4yp3jkq?hl=en-US&entry=ttu&g_ep=EgoyMDI2MDkwMi4wIKXMDSoASAFQAw%3D%3D" rel="noopener noreferrer" target="_blank">
                  <span class="material-symbols-outlined text-xs">open_in_new</span>
                  <span>Jimenez Municipal Nursery</span>
                </a>
              </div>
            </div>
          </div>

          <!-- Inquiry Form (7 Cols) -->
          <div class="lg:col-span-7">
            <div class="bg-surface-container-lowest p-space-xl rounded-2xl shadow-md border border-surface-container">
              <div class="flex items-center justify-between mb-space-lg">
                <div>
                  <h3 class="font-headline-lg text-xl text-on-surface font-bold">Send an Inquiry or Request</h3>
                  <p class="font-body-sm text-xs text-on-surface-variant mt-1">
                    Fill out the form below and our agricultural extension officers will assist your concerns.
                  </p>
                </div>
                <span class="material-symbols-outlined text-3xl text-primary-fixed-dim hidden sm:block">mail_outline</span>
              </div>

              <form id="mao-contact-form" class="space-y-space-md">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-space-md">
                  <div>
                    <label class="block font-label-lg text-xs font-semibold text-on-surface mb-1">
                      Your Name <span class="text-error font-bold">*</span>
                    </label>
                    <input class="form-input-custom w-full bg-surface-container-lowest rounded-lg p-2.5 text-sm text-on-surface border border-outline-variant focus:outline-none shadow-sm" placeholder="Juan Dela Cruz" required type="text">
                  </div>
                  <div>
                    <label class="block font-label-lg text-xs font-semibold text-on-surface mb-1">
                      Email Address <span class="text-error font-bold">*</span>
                    </label>
                    <input class="form-input-custom w-full bg-surface-container-lowest rounded-lg p-2.5 text-sm text-on-surface border border-outline-variant focus:outline-none shadow-sm" placeholder="juan@example.com" required type="email">
                  </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-space-md">
                  <div>
                    <label class="block font-label-lg text-xs font-semibold text-on-surface mb-1">
                      Barangay in Jimenez <span class="text-error font-bold">*</span>
                    </label>
                    <select class="form-input-custom w-full bg-surface-container-lowest rounded-lg p-2.5 text-sm text-on-surface border border-outline-variant focus:outline-none shadow-sm" required>
                      <option value="">Select Barangay</option>
                      <option value="Adorable">Adorable</option>
                      <option value="Butuay">Butuay</option>
                      <option value="Carmen">Carmen</option>
                      <option value="Corrales">Corrales</option>
                      <option value="Dicoloc">Dicoloc</option>
                      <option value="Gata">Gata</option>
                      <option value="Guinabsan">Guinabsan</option>
                      <option value="Macabayao">Macabayao</option>
                      <option value="Matugas Alto">Matugas Alto</option>
                      <option value="Matugas Bajo">Matugas Bajo</option>
                      <option value="Mabas">Mabas</option>
                      <option value="National">National</option>
                      <option value="Naga">Naga</option>
                      <option value="Palilan">Palilan</option>
                      <option value="Rizal">Rizal</option>
                      <option value="San Isidro">San Isidro</option>
                      <option value="Santa Cruz">Santa Cruz</option>
                      <option value="Sibaroc">Sibaroc</option>
                      <option value="Sibucao">Sibucao</option>
                      <option value="Taboo">Taboo</option>
                      <option value="Taraka">Taraka</option>
                    </select>
                  </div>
                  <div>
                    <label class="block font-label-lg text-xs font-semibold text-on-surface mb-1">
                      Phone Number <span class="text-error font-bold">*</span>
                    </label>
                    <input class="form-input-custom w-full bg-surface-container-lowest rounded-lg p-2.5 text-sm text-on-surface border border-outline-variant focus:outline-none shadow-sm" placeholder="+63 9XX XXX XXXX" required type="tel">
                  </div>
                </div>

                <div>
                  <label class="block font-label-lg text-xs font-semibold text-on-surface mb-1">
                    Subject / Assistance Type <span class="text-error font-bold">*</span>
                  </label>
                  <input class="form-input-custom w-full bg-surface-container-lowest rounded-lg p-2.5 text-sm text-on-surface border border-outline-variant focus:outline-none shadow-sm" placeholder="e.g., Rice Seed Inquiries, FishR boat renewal, livestock vaccine" required type="text">
                </div>

                <div>
                  <label class="block font-label-lg text-xs font-semibold text-on-surface mb-1">
                    Your Message <span class="text-error font-bold">*</span>
                  </label>
                  <textarea class="form-input-custom w-full bg-surface-container-lowest rounded-lg p-2.5 text-sm text-on-surface border border-outline-variant focus:outline-none shadow-sm" placeholder="Write your message or inquiry in detail..." required rows="4"></textarea>
                </div>

                <div class="flex flex-col sm:flex-row items-center justify-between gap-space-md pt-space-xs">
                  <button class="w-full sm:w-auto inline-flex items-center justify-center gap-space-xs px-space-xl py-space-sm rounded-xl bg-primary text-on-primary hover:bg-primary-container transition-all font-label-lg text-sm font-bold shadow-md" type="submit">
                    <span>Send Message</span>
                    <span class="material-symbols-outlined text-base">send</span>
                  </button>
                  <span class="font-caption text-xs text-on-surface-variant text-center sm:text-right">
                    Official response time: 24–48 working hours
                  </span>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>

  </div>
</main>

<?php
// Include Footer Component
require_once __DIR__ . '/../frontend/components/footer.php';
?>
