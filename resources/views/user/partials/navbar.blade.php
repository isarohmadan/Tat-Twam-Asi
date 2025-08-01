<style>
    .navbar {
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1) !important;
        background: rgba(255, 255, 255, 0.95) !important;
        backdrop-filter: blur(20px) !important;
        -webkit-backdrop-filter: blur(20px) !important;
        position: fixed !important;
        top: 0 !important;
        left: 0 !important;
        right: 0 !important;
        z-index: 10 !important;
        width: 100% !important;
        border-bottom: 1px solid rgba(255, 255, 255, 0.2) !important;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1) !important;
        transform: none !important;
        opacity: 1 !important;
        visibility: visible !important;
    }
    
    /* Ensure content doesn't jump when navbar appears */
    body {
        padding-top: 80px; /* Add padding to account for fixed navbar */
    }

    .navbar .container {
        padding: 0.75rem 2rem;
        max-width: 1200px;
    }

    /* Brand Styles */
    .navbar-brand {
        display: flex;
        align-items: center;
        transition: transform 0.3s ease;
        text-decoration: none;
    }

    .navbar-brand:hover {
        transform: translateY(-2px);
    }

    .navbar-brand img {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        transition: transform 0.3s ease;
        box-shadow: 0 4px 15px rgba(80, 200, 120, 0.3);
    }

    .navbar-brand:hover img {
        transform: rotate(-5deg) scale(1.05);
    }

    .navbar-brand span {
        font-family: 'Montserrat', sans-serif;
        font-size: 18px;
        font-weight: 700;
        color: #2c3e50;
        margin-left: 12px;
        line-height: 1.2;
    }

    /* Navigation Links */
    .nav-link {
        font-family: 'Montserrat', sans-serif;
        font-size: 15px;
        font-weight: 500;
        color: #2c3e50 !important;
        transition: all 0.3s ease;
        padding: 10px 16px !important;
        border-radius: 8px;
        position: relative;
        overflow: hidden;
        margin: 0 2px;
    }

    .nav-link::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(80, 200, 120, 0.1), transparent);
        transition: left 0.5s ease;
    }

    .nav-link:hover::before {
        left: 100%;
    }

    .nav-link:hover,
    .nav-link.active {
        color: #50c878 !important;
        background-color: rgba(80, 200, 120, 0.1);
        transform: translateY(-1px);
    }

    /* Dropdown Styles */
    .dropdown-menu {
        border-radius: 12px;
        padding: 8px 0;
        font-family: 'Montserrat', sans-serif;
        border: none;
        margin-top: 8px;
        font-size: 15px;
        background: rgba(255, 255, 255, 0.98);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.12);
        border: 1px solid rgba(255, 255, 255, 0.18);
        opacity: 0;
        visibility: hidden;
        min-width: 220px;
        display: block !important;
        pointer-events: none;
        transition: all 0.2s ease;
        transform: translateY(5px);
        overflow: hidden;
    }

    .dropdown:hover .dropdown-menu,
    .dropdown.show .dropdown-menu {
        opacity: 1;
        visibility: visible;
        transform: translateY(0);
        pointer-events: auto;
    }
    
    /* Add a gap between dropdown toggle and menu */
    .dropdown {
        position: relative;
    }
    
    .dropdown > .dropdown-toggle::after {
        display: inline-block;
        margin-left: 0.255em;
        vertical-align: 0.255em;
        content: "";
        border-top: 0.3em solid;
        border-right: 0.3em solid transparent;
        border-bottom: 0;
        border-left: 0.3em solid transparent;
    }
    
    /* Smooth dropdown items animation */
    .dropdown-item {
        transform: translateX(-10px);
        opacity: 0;
        transition: all 0.3s ease;
        color: #2c3e50;
        padding: 8px 16px;
        border-radius: 6px;
        margin: 2px 16px;
    }
    
    .dropdown:hover .dropdown-item,
    .dropdown.show .dropdown-item {
        transform: translateX(0);
        opacity: 1;
    }
    
    .dropdown-item:hover {
        color: #50c878;
    }
    
    /* Staggered animation for dropdown items */
    .dropdown:hover .dropdown-item:nth-child(1),
    .dropdown.show .dropdown-item:nth-child(1) {
        transition-delay: 0.05s;
    }
    
    .dropdown:hover .dropdown-item:nth-child(2),
    .dropdown.show .dropdown-item:nth-child(2) {
        transition-delay: 0.1s;
    }
    
    .dropdown:hover .dropdown-item:nth-child(3),
    .dropdown.show .dropdown-item:nth-child(3) {
        transition-delay: 0.15s;
    }

    /* User Menu */
    .nav-link.text-white {
        color: #2c3e50 !important;
        background: linear-gradient(135deg, #50c878 0%, #388E3C 100%);
        color: white !important;
        border-radius: 25px;
        padding: 8px 20px !important;
        font-weight: 500;
        box-shadow: 0 4px 15px rgba(80, 200, 120, 0.3);
        margin-left: 8px;
    }

    .nav-link.text-white:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(80, 200, 120, 0.4);
        color: white !important;
    }

    /* Mobile Toggle */
    .navbar-toggler {
        border: none;
        padding: 8px;
        border-radius: 8px;
        transition: background-color 0.3s ease;
    }

    .navbar-toggler:hover {
        background-color: rgba(80, 200, 120, 0.1);
    }

    .navbar-toggler:focus {
        box-shadow: none;
        outline: none;
    }

    .navbar-toggler-icon {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%2844, 62, 80, 1%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='m4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
    }

    /* Mobile Styles */
    @media (max-width: 991.98px) {
        .navbar .container {
            padding: 0.75rem 1rem;
        }

        .navbar-brand span {
            font-size: 16px;
        }

        .navbar-brand img {
            width: 40px;
            height: 40px;
        }

        .navbar-collapse {
            background: white;
            margin-top: 1rem;
            padding: 1rem;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }

        .nav-link {
            padding: 12px 16px !important;
            margin: 2px 0;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }

        .nav-link:last-child {
            border-bottom: none;
        }

        .dropdown-menu {
            position: static;
            transform: none;
            box-shadow: none;
            border: none;
            background: rgba(80, 200, 120, 0.05);
            margin: 0;
            border-radius: 8px;
            opacity: 0;
            visibility: hidden;
            display: none !important;
            pointer-events: none;
            max-height: 0;
            padding: 0 8px;
            transition: all 0.3s ease, max-height 0.3s ease, padding 0.3s ease;
        }

        .dropdown.show .dropdown-menu {
            display: block !important;
            margin-top: 8px;
            margin-bottom: 8px;
            padding: 8px 8px 8px 32px;
            background: rgba(80, 200, 120, 0.05);
            opacity: 1;
            visibility: visible;
            pointer-events: auto;
            max-height: 500px;
        }
        
        .dropdown-item {
            transform: none;
            opacity: 1;
            transition: all 0.3s ease;
            padding: 8px 12px;
            margin: 2px 0;
            border-radius: 6px;
        }
    }

    /* Smooth scroll offset for fixed navbar */
    html {
        scroll-padding-top: 80px;
    }

    /* Loading animation */
    @keyframes slideDown {
        from {
            transform: translateY(-100%);
            opacity: 0;
        }
        to {
            transform: translateY(0);
            opacity: 1;
        }
    }

    .navbar.loaded {
        animation: slideDown 0.6s ease-out;
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add loaded class for initial animation
    const navbar = document.querySelector('.navbar');
    if (navbar) {
        navbar.classList.add('loaded');
    }
    
    // Initialize dropdown functionality with proper hover handling
    const dropdowns = document.querySelectorAll('.dropdown');
    let activeDropdown = null;

    // Function to show dropdown
    function showDropdown(dropdown) {
        if (activeDropdown && activeDropdown !== dropdown) {
            hideDropdown(activeDropdown);
        }
        dropdown.classList.add('show');
        activeDropdown = dropdown;
    }

    // Function to hide dropdown
    function hideDropdown(dropdown) {
        dropdown.classList.remove('show');
        if (activeDropdown === dropdown) {
            activeDropdown = null;
        }
    }

    // Handle dropdown behavior
    dropdowns.forEach(dropdown => {
        const toggle = dropdown.querySelector('.dropdown-toggle');
        const menu = dropdown.querySelector('.dropdown-menu');
        
        if (!toggle || !menu) return;

        let hoverTimeout;

        // Desktop hover behavior
        function handleMouseEnter() {
            if (window.innerWidth > 991.98) {
                clearTimeout(hoverTimeout);
                showDropdown(dropdown);
            }
        }

        function handleMouseLeave() {
            if (window.innerWidth > 991.98) {
                hoverTimeout = setTimeout(() => {
                    hideDropdown(dropdown);
                }, 150); // Small delay to allow mouse movement to menu
            }
        }

        // Add event listeners to both toggle and menu
        dropdown.addEventListener('mouseenter', handleMouseEnter);
        dropdown.addEventListener('mouseleave', handleMouseLeave);

        // Mobile click behavior
        toggle.addEventListener('click', function(e) {
            if (window.innerWidth <= 991.98) {
                e.preventDefault();
                e.stopPropagation();
                
                if (dropdown.classList.contains('show')) {
                    hideDropdown(dropdown);
                } else {
                    showDropdown(dropdown);
                }
            }
        });

        // Prevent dropdown from closing when clicking inside menu
        menu.addEventListener('click', function(e) {
            e.stopPropagation();
        });
    });

    // Close dropdowns when clicking outside
    document.addEventListener('click', function(e) {
        const clickedDropdown = e.target.closest('.dropdown');
        if (!clickedDropdown && activeDropdown) {
            hideDropdown(activeDropdown);
        }
    });

    // Handle window resize
    let resizeTimer;
    window.addEventListener('resize', function() {
        document.body.classList.add('resize-animation-stopper');
        clearTimeout(resizeTimer);
        
        // Close all dropdowns on resize
        if (activeDropdown) {
            hideDropdown(activeDropdown);
        }
        
        resizeTimer = setTimeout(() => {
            document.body.classList.remove('resize-animation-stopper');
        }, 400);
    });

    // Add resize animation stopper class
    const style = document.createElement('style');
    style.textContent = `
        .resize-animation-stopper * {
            animation-duration: 0s !important;
            animation-delay: 0s !important;
            transition-duration: 0s !important;
            transition-delay: 0s !important;
        }
    `;
    document.head.appendChild(style);
});
</script>

<nav class="navbar navbar-expand-lg navbar-light sticky-top">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="me-2">
            <span class="fw-bold" style="font-family: 'Montserrat', text-transform: uppercase; serif; font-size: 18px; color: #2c3e50;"> 
                Yayasan Tat Twam Asi
            </span>
        </a>
        
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item">
                    <a class="nav-link active" href="#home">
                        Home
                    </a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="pengajuanDropdown" role="button" 
                       data-bs-toggle="dropdown" aria-expanded="false">
                        Pengajuan
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="pengajuanDropdown">
                        <li><a class="dropdown-item" href="{{ route('userkegiatan') }}">Kegiatan</a></li>
                        <li><a class="dropdown-item" href="{{ route('userkunjungan') }}">Kunjungan</a></li>
                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="profilDropdown" role="button" 
                       data-bs-toggle="dropdown" aria-expanded="false">
                        Profil
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profilDropdown">
                        <li><a class="dropdown-item" href="#sejarah">Sejarah</a></li>
                        <li><a class="dropdown-item" href="#visimisi">Visi Misi</a></li>
                    </ul>
                </li>

                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" href="#" id="userDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('login') }}">
                            Login
                        </a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>