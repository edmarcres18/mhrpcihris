<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Luscious Co.</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }

        :root {
            --primary: #2E7D32;
            --secondary: #81C784;
            --accent: #4CAF50;
            --background: #F1F8E9;
            --text: #1B5E20;
            --white: #ffffff;
            --gray-light: #E8F5E9;
            --shadow: 0 8px 30px rgba(46, 125, 50, 0.12);
            --transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        body {
            line-height: 1.6;
        }

        /* Navigation */
        .header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            width: 100%;
            height: 80px;
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(20px);
            box-shadow: var(--shadow);
            transition: var(--transition);
            z-index: 9999;
        }

        .nav-container {
            position: static;
            max-width: 1400px;
            margin: 0 auto;
            padding: 0.5rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 100%;
            background: none;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }

        .logo img {
            width: 48px;
            height: 48px;
            border-radius: 16px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        .nav-menu {
            display: flex;
            gap: 2.5rem;
            list-style: none;
            margin-left: auto;
        }

        .nav-link {
            color: var(--text);
            text-decoration: none;
            font-weight: 500;
            font-family: 'Montserrat', sans-serif;
            padding: 0.5rem 0;
            position: relative;
        }

        .nav-link:hover {
            color: var(--primary);
            border-bottom: 2px solid var(--secondary);
        }

        .nav-link i {
            margin-right: 1rem;
        }

        /* Main Content */
        .main-content {
            margin-left: 0;
            padding-top: 80px;
        }

        /* Hero Section */
        .hero {
            height: 60vh;
            background: linear-gradient(rgba(46, 125, 50, 0.8), rgba(46, 125, 50, 0.8)),
                        url('{{ asset('vendor/adminlte/dist/img/lus.png') }}') center/cover;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--light-text);
            text-align: center;
            padding: 2rem;
        }

        .hero-content {
            max-width: 800px;
            animation: fadeIn 1.5s ease-out;
            color: var(--white);
        }

        .hero h1 {
            font-size: 3.5rem;
            margin-bottom: 1.5rem;
        }

        .hero p {
            font-size: 1.2rem;
            margin-bottom: 2rem;
        }

        /* Sections */
        .section {
            padding: 5rem 2rem;
        }

        .section-light {
            background-color: var(--light-bg);
        }

        .section-title {
            font-size: 2.5rem;
            margin-bottom: 3rem;
            text-align: center;
            color: var(--primary);
        }

        /* About Section */
        .about-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        .about-card {
            background-color: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .about-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.15);
            border-left: 4px solid var(--secondary);
        }

        .about-card i {
            font-size: 2.5rem;
            color: var(--primary);
            margin-bottom: 1rem;
        }

        /* Services Section */
        .services-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        .service-card {
            background-color: white;
            padding: 2rem;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .service-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.15);
            border-left: 4px solid var(--secondary);
        }

        .service-card i {
            font-size: 2.5rem;
            color: var(--primary);
            margin-bottom: 1rem;
        }

        /* Location Section */
        .location-container {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 2rem;
        }

        .location-info {
            padding: 2rem;
        }

        .location-map {
            background-color: #ddd;
            min-height: 400px;
            border-radius: 10px;
        }

        /* Footer */
        footer {
            background-color: var(--primary);
            color: var(--white);
            padding: 3rem 2rem;
            text-align: center;
        }

        /* Responsive Design */
        @media (max-width: 1024px) {
            .nav-container {
                width: 80px;
            }

            .main-content {
                margin-left: 80px;
            }

            .logo img {
                width: 60px;
                height: 60px;
            }

            .nav-link span {
                display: none;
            }

            .location-container {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .hero h1 {
                font-size: 2.5rem;
            }

            .nav-menu {
                display: none;
            }
        }

        /* Add these new animation keyframes */
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes slideIn {
            from { transform: translateY(50px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        /* Mobile Menu Button */
        .mobile-menu-btn {
            display: none;
            flex-direction: column;
            gap: 6px;
            cursor: pointer;
            padding: 10px;
        }

        .mobile-menu-btn span {
            display: block;
            width: 25px;
            height: 3px;
            background-color: var(--primary);
            transition: var(--transition);
        }

        /* Updated Responsive Design */
        @media (max-width: 1024px) {
            .nav-container {
                padding: 0.5rem 1rem;
            }

            .location-container {
                grid-template-columns: 1fr;
            }

            .about-grid, .services-grid {
                grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
                padding: 0 1rem;
            }
        }

        @media (max-width: 768px) {
            .mobile-menu-btn {
                display: flex;
            }

            .nav-menu {
                display: none;
                position: fixed;
                top: 80px;
                left: 0;
                right: 0;
                background: rgba(255, 255, 255, 0.98);
                backdrop-filter: blur(20px);
                flex-direction: column;
                padding: 2rem;
                gap: 1.5rem;
                box-shadow: var(--shadow);
            }

            .nav-menu.active {
                display: flex;
            }

            .hero h1 {
                font-size: 2rem;
            }

            .hero p {
                font-size: 1rem;
            }

            .section {
                padding: 3rem 1rem;
            }

            .section-title {
                font-size: 2rem;
            }
        }

        @media (max-width: 480px) {
            .logo h1 {
                font-size: 1.5rem;
            }

            .logo img {
                width: 40px;
                height: 40px;
            }

            .hero h1 {
                font-size: 1.75rem;
            }

            .about-card, .service-card {
                padding: 1.5rem;
            }
        }

        /* Add these utility classes */
        .no-scroll {
            overflow: hidden;
        }

        /* Add smooth transitions */
        .nav-menu, .hero-content, .about-card, .service-card {
            transition: var(--transition);
        }
    </style>
</head>
<body>
    <header class="header">
        <nav class="nav-container">
            <div class="logo">
                <img src="{{ asset('vendor/adminlte/dist/img/lus.png') }}" alt="LUS Logo">
                <h1>LUS</h1>
            </div>
            <ul class="nav-menu">
                <li><a href="{{route('welcome')}}" class="nav-link">Home</a></li>
                <li><a href="#who-we-are" class="nav-link">Who We Are</a></li>
                <li><a href="#about" class="nav-link">About</a></li>
                <li><a href="#location" class="nav-link">Location</a></li>
            </ul>
            <div class="mobile-menu-btn">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </nav>
    </header>

    <main class="main-content">
        <section id="home" class="hero">
            <div class="hero-content">
                <h1>Welcome to Luscious Co.</h1>
                <p>Elevating dining experiences with premium cuisine and exceptional service</p>
            </div>
        </section>

        <section id="who-we-are" class="section section-light">
            <h2 class="section-title">Who We Are</h2>
            <div style="max-width: 1000px; margin: 0 auto; text-align: justify; padding: 0 2rem;" data-aos="fade-up">
                <p style="font-size: 1.1rem; margin-bottom: 1.5rem;">
                    Luscious Co. is a distinguished name in the food and hospitality sector, known for creating extraordinary dining experiences in Cebu. As a premium culinary establishment, we take pride in offering exceptional food and catering services that delight the senses.
                </p>
                <p style="font-size: 1.1rem; margin-bottom: 1.5rem;">
                    Since our establishment, we have grown from a small dining venue to a comprehensive hospitality provider, serving both private events and corporate functions. Our commitment to quality and innovation has made us the preferred choice for discerning clients seeking memorable dining experiences.
                </p>
                <p style="font-size: 1.1rem;">
                    With our team of skilled chefs and dedicated service staff, we maintain the highest standards of culinary excellence and customer service. Our passion for creating exceptional dining experiences has helped us build a strong reputation in the local hospitality industry.
                </p>
            </div>
        </section>
        <section id="about" class="section">
            <h2 class="section-title">About Us</h2>
            <div class="about-grid">
                <div class="about-card" data-aos="fade-up">
                    <i class="fas fa-utensils"></i>
                    <h3>Our Cuisine</h3>
                    <p>Premium dining experiences featuring carefully curated menus and the finest ingredients, crafted by our expert culinary team.</p>
                </div>
                <div class="about-card" data-aos="fade-up" data-aos-delay="100">
                    <i class="fas fa-users"></i>
                    <h3>Our Team</h3>
                    <p>Skilled chefs and professional service staff dedicated to creating memorable dining experiences for our guests.</p>
                </div>
                <div class="about-card" data-aos="fade-up" data-aos-delay="200">
                    <i class="fas fa-star"></i>
                    <h3>Excellence</h3>
                    <p>Known for our commitment to quality, innovation, and exceptional customer service in the hospitality industry.</p>
                </div>
            </div>
        </section>

        <section id="services" class="section section-light">
            <h2 class="section-title">Our Services</h2>
            <div class="services-grid">
                <div class="service-card" data-aos="fade-up">
                    <i class="fas fa-concierge-bell"></i>
                    <h3>Fine Dining</h3>
                    <p>Exceptional dining experiences in an elegant atmosphere</p>
                </div>
                <div class="service-card" data-aos="fade-up" data-aos-delay="100">
                    <i class="fas fa-glass-cheers"></i>
                    <h3>Event Catering</h3>
                    <p>Premium catering services for special occasions</p>
                </div>
                <div class="service-card" data-aos="fade-up" data-aos-delay="200">
                    <i class="fas fa-building"></i>
                    <h3>Corporate Services</h3>
                    <p>Specialized catering for business events and functions</p>
                </div>
                <div class="service-card" data-aos="fade-up" data-aos-delay="300">
                    <i class="fas fa-birthday-cake"></i>
                    <h3>Private Events</h3>
                    <p>Customized dining experiences for private celebrations</p>
                </div>
            </div>
        </section>

        <!-- <section id="location" class="section">
            <h2 class="section-title">Our Location</h2>
            <div class="location-container">
                <div class="location-info" data-aos="fade-right">
                    <h3>Find Us Here</h3>
                    <p><i class="fas fa-map-marker-alt"></i> National Rd. Cansaga, Consolacion, Cebu</p>
                    <p><i class="fas fa-phone"></i> Contact Number: (032) 238-1887</p>
                    <p><i class="fas fa-clock"></i> Operating Hours: 24/7</p>
                </div>
                <div class="location-map" data-aos="fade-left">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3924.8961246876434!2d123.96145421475498!3d10.378576892605444!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33a9a2b07fd8a64f%3A0x99917bdaf36b746e!2sBay%20Gas%20%26%20Petroleum%20Distribution%2C%20Inc.!5e0!3m2!1sen!2sph!4v1650000000000!5m2!1sen!2sph"
                        width="100%"
                        height="100%"
                        style="border:0; border-radius: 10px;"
                        allowfullscreen=""
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>
        </section> -->

        <footer>
            <p>&copy; {{ date('Y') }} Luscious Co. All rights reserved.</p>
            <p>A subsidiary of MHR Properties Conglomerate, Inc.</p>
        </footer>
    </main>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        // Initialize AOS
        AOS.init({
            duration: 1000,
            once: true,
            offset: 100
        });

        // Smooth scrolling
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });

        // Add VHI's mobile menu toggle code
        const mobileMenuBtn = document.querySelector('.mobile-menu-btn');
        const navMenu = document.querySelector('.nav-menu');
        const body = document.body;

        mobileMenuBtn.addEventListener('click', () => {
            mobileMenuBtn.classList.toggle('active');
            navMenu.classList.toggle('active');
            body.classList.toggle('no-scroll');
        });

        // Close mobile menu when clicking a link
        document.querySelectorAll('.nav-link').forEach(link => {
            link.addEventListener('click', () => {
                mobileMenuBtn.classList.remove('active');
                navMenu.classList.remove('active');
                body.classList.remove('no-scroll');
            });
        });

        // Close mobile menu when clicking outside
        document.addEventListener('click', (e) => {
            if (!navMenu.contains(e.target) && !mobileMenuBtn.contains(e.target)) {
                mobileMenuBtn.classList.remove('active');
                navMenu.classList.remove('active');
                body.classList.remove('no-scroll');
            }
        });
    </script>
</body>
</html>
