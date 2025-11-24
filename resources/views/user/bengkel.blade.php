<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>Maps Bengkel — Toddopuli, Makassar</title>

    <!-- Bootstrap (CDN) -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
      rel="stylesheet" />

    <!-- Leaflet CSS & MarkerCluster -->
    <link
      rel="stylesheet"
      href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
      integrity=""
      crossorigin="" />
    <link
      rel="stylesheet"
      href="https://unpkg.com/leaflet.markercluster@1.5.3/dist/MarkerCluster.Default.css" />
    <link
      rel="stylesheet"
      href="https://unpkg.com/leaflet.markercluster@1.5.3/dist/MarkerCluster.css" />

    <style>
              /* --- Page base --- */
              body { font-family: "Poppins", sans-serif; margin:0; background:#fff; color:#222; }
        /* Hero */
            /* Hero */
      .hero {
        height: 20vh;
        background: linear-gradient(120deg,#1a1a1a 0%, #2d2d2d 100%);
        display:flex;
        align-items:center;
        justify-content:center;
        color:#fff;
        text-align:center;
        position:relative;
      }
      .hero .container { z-index:1; }
      .hero h1 { font-size:3.5rem; margin-bottom:1rem; font-weight:700; }
      .hero .subtitle { font-size:1.2rem; color:#999; margin-top:0.5rem; }
      .back-btn {
        position:absolute;
        top:50px;
        left:150px;
        background:rgba(255,255,255,0.1);
        border:1px solid rgba(255,255,255,0.2);
        color:#fff;
        padding:12px 24px;
        border-radius:8px;
        text-decoration:none;
        display:inline-flex;
        align-items:center;
        gap:8px;
        transition:all 0.3s ease;
        backdrop-filter:blur(10px);
      }
      .back-btn:hover {
        background:rgba(255,255,255,0.2);
        color:#fff;
        transform:translateX(-4px);
      }
              /* Map area */
              #map { width:100%; height:62vh; border-radius:10px; box-shadow:0 8px 30px rgba(0,0,0,0.15); }

              /* Sidebar list */
              .left-panel { max-height:62vh; overflow:auto; padding:12px; border-radius:10px; background:linear-gradient(180deg, rgba(255,255,255,0.02), rgba(255,255,255,0.01)); }
              .workshop-item { padding:10px; border-bottom:1px solid rgba(0,0,0,0.06); cursor:pointer; }
              .workshop-item:hover { background: rgba(58,171,220,0.06); }

              /* Responsive layout */
              @media (min-width: 992px) {
                .map-wrapper { display:grid; grid-template-columns: 360px 1fr; gap:20px; align-items:start; }
              }
              @media (max-width: 991px) {
                .map-wrapper { display:block; }
                .left-panel { margin-bottom:14px; }
              }

              /* small UI */
              .badge-category { font-size:0.75rem; }
              .muted { color:#666; font-size:0.92rem; }
    </style>
  </head>
  <body>
    <main>
      <!-- HERO -->
      <section id="hero" class="hero">
        <div class="container">
          <h1>Map Bengkel</h1>
          <a href="http://127.0.0.1:8000/home" class="back-btn">
            ← Back to Home
          </a>
        </div>
      </section>

      <!-- MAP + SIDEBAR -->
      <section id="map-section" class="py-5">
        <div class="container">
          <div class="map-wrapper">
            <!-- sidebar -->
            <div class="left-panel">
              <div class="mb-3">
                <input
                  id="searchInput"
                  class="form-control"
                  placeholder="Cari nama bengkel (contoh: Helios)" />
              </div>

              <div id="list" class="mb-3">
                <!-- daftar bengkel akan diisi JS -->
              </div>

              <hr />
              <div class="small muted">
                Sumber data (contoh): Roojai / Moservice / listing lokal &
                social media. Data alamat bisa berubah — klik marker untuk buka
                Google Maps.
              </div>
            </div>

            <!-- map -->
            <div>
              <div id="map"></div>
            </div>
          </div>
        </div>
      </section>
    </main>

    <footer class="text-center py-3">
      <small>
        ©2025 PITLANE — Maps Toddopuli. Data publik, disusun otomatis.
      </small>
    </footer>

    <!-- SCRIPTS: Leaflet, MarkerCluster, Bootstrap -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet.markercluster@1.5.3/dist/leaflet.markercluster.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

    <script>
      /* =========================
         WORKSHOP LIST (alamat sumber publik)
         Tambahkan / edit alamat jika kamu punya data lebih lengkap.
         ========================== */
        const workshops = @json($workshops)
      //   {
      //     name: "Helios Garage",
      //     address: "Jl. Toddopuli Raya Timur No.84, Borong, Manggala, Makassar",
      //     phone: "0811-4484-017",
      //     source: "Roojai / listing",
      //   },
      //   {
      //     name: "Planet Motor",
      //     address: "Jl. Toddopuli Raya Timur No.171, Borong, Manggala, Makassar",
      //     phone: "0822-9038-5761",
      //     source: "Local listing",
      //   },
      //   {
      //     name: "Bengkel JDM (SPBU Toddopuli)",
      //     address: "Jl. Toddopuli Raya Timur No.7A (SPBU Toddopuli), Makassar",
      //     phone: "",
      //     source: "Facebook listing",
      //   },
      //   {
      //     name: "Adhimotorsport",
      //     address: "Jalan Toddopuli Raya A2 No.3-4, Makassar",
      //     phone: "081343922258",
      //     source: "Instagram",
      //   },
      //   {
      //     name: "Karya Mandiri (workshop)",
      //     address: "Jl. Toddopuli 10 Baru, Borong, Manggala, Makassar",
      //     phone: "",
      //     source: "Roojai / listing",
      //   }
      //   // — kalau punya bengkel lain, tambahkan di sini
      // ];

      /* =========================
         Map init: pusat Toddopuli (perkiraan)
         ========================== */
      const mapCenter = [-5.1640, 119.4560]; // perkiraan pusat Toddopuli
      const map = L.map('map', { center: mapCenter, zoom: 14 });

      // tile layer (OpenStreetMap)
      L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
      }).addTo(map);

      // marker cluster group
      const markers = L.markerClusterGroup();
      map.addLayer(markers);

      // UI references
      const listEl = document.getElementById('list');
      const searchInput = document.getElementById('searchInput');

      // Utility: create map link
      function mapsLink(addr) {
        return 'https://www.google.com/maps/search/?api=1&query=' + encodeURIComponent(addr);
      }

      // Geocode caching helper: store latlng in localStorage by address key
      function cacheKey(addr) { return 'geo:' + addr; }
      function setCache(addr, data) { try { localStorage.setItem(cacheKey(addr), JSON.stringify(data)); } catch(e){} }
      function getCache(addr) { try { const v = localStorage.getItem(cacheKey(addr)); return v ? JSON.parse(v) : null; } catch(e){ return null } }

      // Nominatim geocode (client-side). small polite delay between queries to be nice.
      async function geocodeAddress(addr) {
        const cached = getCache(addr);
        if (cached) return cached;

        // Use Nominatim public API (OpenStreetMap). This runs in user's browser.
        const url = 'https://nominatim.openstreetmap.org/search?format=jsonv2&q=' + encodeURIComponent(addr);
        try {
          const resp = await fetch(url, {headers: {'Accept': 'application/json'}});
          const j = await resp.json();
          if (Array.isArray(j) && j.length > 0) {
            const lat = parseFloat(j[0].lat);
            const lon = parseFloat(j[0].lon);
            const data = { lat, lon, display_name: j[0].display_name };
            setCache(addr, data);
            return data;
          } else {
            return null;
          }
        } catch (e) {
          console.error('Geocode fail', e);
          return null;
        }
      }

// Render workshop list in sidebar and add markers
async function renderWorkshops(filter = '') {
  listEl.innerHTML = '<div class="muted">Memuat bengkel…</div>';
  markers.clearLayers();

  const toShow = workshops.filter(w =>
    w.nama_bengkel.toLowerCase().includes(filter.toLowerCase())
  );

  if (toShow.length === 0) {
    listEl.innerHTML = '<div class="muted">Tidak ada bengkel ditemukan.</div>';
    return;
  }

  listEl.innerHTML = ''; // reset
  for (const w of toShow) {
    // create list item
    const item = document.createElement('div');
    item.className = 'workshop-item';

    item.innerHTML = `
      <div>
        <h4 class="mb-1">${w.nama_bengkel}</h4>
        <p class="mb-1">${w.alamat}</p>
        <p class="mb-1">📞 ${w.no_hp ?? '-'}</p>
        <p class="mb-2">🕒 ${w.jam_operasional ?? '-'}</p>
        <button onclick="window.open('${w.link_alamat}', '_blank')" class="btn btn-sm btn-primary">
          Buka di Google Maps
        </button>
      </div>
    `;

    listEl.appendChild(item);

    // find cached / geocode
    const geo = await geocodeAddress(w.alamat);
    if (geo) {
      const marker = L.marker([geo.lat, geo.lon]);

      const popupHtml = `
        <div style="min-width:220px">
          <strong>${w.nama_bengkel}</strong><br>
          ${w.alamat}<br>
          📞 ${w.no_hp ?? '-'}<br>
          🕒 ${w.jam_operasional ?? '-'}<br>
          <a href="${w.link_alamat}" target="_blank" class="btn btn-sm btn-primary mt-2">
            Buka di Google Maps
          </a>
        </div>
      `;

      marker.bindPopup(popupHtml);
      markers.addLayer(marker);

      // klik list -> buka popup & pan
      item.addEventListener('click', () => {
        map.setView([geo.lat, geo.lon], 16, { animate:true });
        marker.openPopup();
      });
    } else {
      // geocode gagal
      const warn = document.createElement('div');
      warn.className = 'muted small';
      warn.textContent = ' (Lokasi belum ditemukan otomatis — klik untuk buka Google Maps)';
      item.appendChild(warn);
      item.addEventListener('click', () => {
        window.open(w.link_alamat, '_blank');
      });
    }

    // polite delay — biar tidak spam geocode
    await new Promise(r => setTimeout(r, 300));
  }

  // fit bounds if markers exist
  const all = markers.getLayers();
  if (all.length) {
    const group = L.featureGroup(all);
    map.fitBounds(group.getBounds().pad(0.25));
  }
}

      // initial render
      renderWorkshops();

      // search behavior
      searchInput.addEventListener('input', (e) => {
        renderWorkshops(e.target.value);
      });

      /* ===== Navbar scroll and color-switch (About) - reuse pattern from previous UI ===== */
      const nav = document.querySelector('.navbar');
      const navLinks = document.querySelectorAll('.nav-link');
      const aboutSection = document.getElementById('hero'); // no 'about' here; using hero for white-mode
      window.addEventListener('scroll', () => {
        if (window.scrollY > 40) nav.classList.add('scrolled'); else nav.classList.remove('scrolled');

        // Example: if scrolled past hero -> use black links (not necessary here, kept for consistency)
        const heroBottom = aboutSection.offsetTop + aboutSection.offsetHeight;
        const inHero = window.scrollY + window.innerHeight/2 < heroBottom;
        navLinks.forEach(l => { l.classList.toggle('white-mode', inHero); l.classList.toggle('black-mode', !inHero); });
      });
    </script>
  </body>
</html>
