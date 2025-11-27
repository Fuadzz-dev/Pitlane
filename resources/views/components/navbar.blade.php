
    <nav class="navbar">
      <div class="nav-container">
        <div class="nav-left">
          <a href="#hero" class="logo">
            <div class="logo-icon">
              <img src="{{ asset('img/l.jpg') }}" alt="" style="width: 140px;" />
            </div>
          </a>
          <button class="mobile-menu-btn" onclick="toggleMenu()">☰</button>
          <ul class="nav-menu" id="navMenu">
            <li class="nav-item">
              <a href="#hero" class="nav-link ">Home</a>
            </li>
            <li class="nav-item">
              <a href="#about" class="nav-link">About</a>
            </li>
            <li class="nav-item">
              <a href="#form" class="nav-link">Services</a>
            </li>
            <li class="nav-item">
              <a href="#start-service" class="nav-link">Queue</a>
            </li>
            <li class="nav-item">
              <a href="#contact" class="nav-link">Contact</a>
            </li>
          </ul>
        </div>
        <div class="nav-right">
          <div class="profile-container">
            <img
              src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=100&h=100&fit=crop"
              alt="Profile"
              class="profile"
              onclick="toggleProfile()" />
            <div class="profile-dropdown" id="profileDropdown">
              <a href="{{ route('profile') }}" class="dropdown-item">Your profile</a>
              <a href="#" class="dropdown-item" onclick="handleLogout(event)">Logout</a>
            </div>
          </div>
        </div>
      </div>
    </nav>

    <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display: none;">
    @csrf </form>

    <style>
        .navbar {
            padding: 0 2rem;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            transition: all 0.3s ease;
        }

        .navbar.scrolled {
            backdrop-filter: blur(10px);
        }

        .nav-container {
            max-width: 1400px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 70px;
        }

        .nav-left {
          display: flex;
          justify-content: right;
          gap: 60rem;
          margin-left: 150px;
          margin-right: 10px;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 0.8rem;
            text-decoration: none;
        }

        .logo-icon {
            width: 10px;
            height: 10px;
            size: 10px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .logo-text {
            font-size: 1.3rem;
            font-weight: 700;
            color: #fff;
            letter-spacing: 1px;
        }

        .nav-menu {
            display: flex;
            list-style: none;
            gap: 0.5rem;
            margin: 0;
            padding: 0;
        }

        .nav-item a {
            color: #94a3b8;
            text-decoration: none;
            padding: 0.7rem 1.2rem;
            border-radius: 8px;
            font-weight: 500;
            font-size: 15px;
            transition: all 0.3s ease;
            display: block;
        }

        .nav-item a:hover {
            color: #fff;
            background: rgba(100, 116, 139, 0.2);
            backdrop-filter: blur(10px);
        }

        .nav-item a.active {
            color: #fff;
            background: rgba(100, 116, 139, 0.3);
        }

        .nav-right {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }

        .profile-container {
            position: relative;
        }

        .profile {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            cursor: pointer;
            border: 2px solid rgba(100, 116, 139, 0.3);
            transition: all 0.3s ease;
            object-fit: cover;
            justify-content: right;
        }

        .profile:hover {
            border-color: #667eea;
            transform: scale(1.05);
        }

        .profile-dropdown {
            position: absolute;
      top: 55px;
      right: 0;
      backdrop-filter: blur(10px);
      border: 1px solid rgba(100, 116, 139, 0.2);
      border-radius: 12px;
      min-width: 200px;
      padding: 0.5rem;
      opacity: 0;
      visibility: hidden;
      transform: translateY(-10px);
      transition: all 0.3s ease;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
      z-index: 1000;
      }

        .profile-dropdown.active {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .profile-dropdown::before {
            content: '';
            position: absolute;
            top: -6px;
            right: 12px;
            width: 12px;
            height: 12px;
            backdrop-filter: blur(10px);
            border-left: 1px solid rgba(100, 116, 139, 0.2);
            border-top: 1px solid rgba(100, 116, 139, 0.2);
            transform: rotate(45deg);
        }

        .dropdown-item {
            display: block;
            padding: 0.75rem 1rem;
            color: #cbd5e1;
            text-decoration: none;
            border-radius: 8px;
            transition: all 0.2s ease;
            font-size: 14px;
            font-weight: 500;
        }

        .dropdown-item:hover {
            background: rgba(100, 116, 139, 0.2);
            color: #fff;
        }

        .dropdown-divider {
            height: 1px;
            background: rgba(100, 116, 139, 0.2);
            margin: 0.5rem 0;
        }

        .mobile-menu-btn {
            display: none;
            background: none;
            border: none;
            color: #94a3b8;
            font-size: 24px;
            cursor: pointer;
        }

        @media (max-width: 768px) {
            .navbar {
                padding: 0 1rem;
            }

            .nav-menu {
                position: absolute;
                top: 70px;
                left: 0;
                right: 0;
                background: rgba(15, 23, 42, 0.98);
                flex-direction: column;
                padding: 1rem;
                gap: 0;
                display: none;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            }

            .nav-menu.active {
                display: flex;
            }

            .nav-item a {
                padding: 1rem;
            }

            .mobile-menu-btn {
                display: block;
            }

            .nav-left {
                gap: 1rem;
            }

            .logo-text {
                font-size: 1.1rem;
            }
        }

    </style>

    <script>
      function toggleMenu() {
          const menu = document.getElementById('navMenu');
          menu.classList.toggle('active');
      }

      function toggleProfile() {
          const dropdown = document.getElementById('profileDropdown');
          dropdown.classList.toggle('active');
      }


      // Fungsi untuk handle logout
      function handleLogout(event) {
      event.preventDefault(); // Mencegah link redirect
      document.getElementById('logout-form').submit(); // Submit form logout
  }

      // Close menus when clicking outside
      document.addEventListener('click', function(event) {
          const menu = document.getElementById('navMenu');
          const menuBtn = document.querySelector('.mobile-menu-btn');
          const profileDropdown = document.getElementById('profileDropdown');
          const profileImg = document.querySelector('.profile');

          // Close mobile menu
          if (menu && menuBtn && !menu.contains(event.target) && !menuBtn.contains(event.target)) {
              menu.classList.remove('active');
          }

          // Close profile dropdown
          if (profileDropdown && profileImg && !profileDropdown.contains(event.target) && !profileImg.contains(event.target)) {
              profileDropdown.classList.remove('active');
          }
      });

      window.addEventListener("scroll", function() {
        const navbar = document.querySelector(".navbar");
        if (window.scrollY > 50) navbar.classList.add("scrolled");
        else navbar.classList.remove("scrolled");
      });

      // Smooth scroll for navigation links
      document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
          e.preventDefault();
          const target = document.querySelector(this.getAttribute('href'));
          if (target) {
            const offset = 70; // navbar height
            const targetPosition = target.offsetTop - offset;
            window.scrollTo({
              top: targetPosition,
              behavior: 'smooth'
            });
            // Close mobile menu if open
            const menu = document.getElementById('navMenu');
            if (menu) {
              menu.classList.remove('active');
            }
          }
        });
      });
    </script>