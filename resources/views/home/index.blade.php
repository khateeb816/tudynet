<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Tudynet - Order & Referral Management System</title>
    <meta name="description"
        content="Tudynet is a comprehensive platform for managing writing orders, connecting clients with expert writers, and facilitating a seamless referral system.">
    <meta name="keywords" content="order management, referral system, academic writing, writers, clients, tudynet">

    <!-- Favicons -->
    <link href="{{ asset('assets/images/logo.jpeg') }}" rel="icon">
    <link href="{{ asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">


</head>

<body class="index-page">

    <header id="header" class="header d-flex align-items-center sticky-top">
        <div class="container position-relative d-flex align-items-center justify-content-between">

            <a href="{{ url('/') }}" class="logo d-flex align-items-center me-auto me-xl-0">
                <img src="{{ asset('assets/images/logo.jpeg') }}" alt="Tudynet Logo">
                <h1 class="sitename">Tudy<span style="color: var(--accent-color);">net</span></h1>
            </a>

            <nav id="navmenu" class="navmenu">
                <ul>
                    <li><a href="#hero" class="active">Home</a></li>
                    <li><a href="#team">Meet My Team</a></li>
                    <li><a href="#results">My Previous Results</a></li>
                    <li><a href="#services">A Few Samples</a></li>
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>

            <div class="d-flex gap-2">
                <a class="btn-getstarted" href="{{ route('login') }}">Login</a>
                <a class="btn-getstarted" href="{{ route('register') }}"
                    style="background-color: transparent; border: 2px solid var(--accent-color); color: var(--accent-color);">Register</a>
            </div>

        </div>
    </header>

    <main class="main">

        <!-- Hero Section -->
        <section id="hero" class="hero section">
            <div class="container" data-aos="fade-up" data-aos-delay="100">
                <div class="row align-items-center gy-5">
                    <div class="col-lg-6" data-aos="fade-right" data-aos-delay="200">
                        <div class="hero-content">
                            <div class="hero-tag" data-aos="fade-up" data-aos-delay="250">
                                <span class="tag-dot"></span>
                                <span class="tag-text">Order & Referral System</span>
                            </div>

                            <h1 class="hero-headline" data-aos="fade-up" data-aos-delay="300">Streamline Your
                                <br>Writing Business
                            </h1>

                            <p class="hero-text" data-aos="fade-up" data-aos-delay="350">
                                The ultimate platform for managing academic orders, connecting with expert writers, and
                                growing your network through our powerful referral system.
                            </p>

                            <div class="hero-cta" data-aos="fade-up" data-aos-delay="400">
                                <a href="{{ route('register') }}" class="cta-button">
                                    <span>Get Started</span>
                                    <i class="bi bi-arrow-right"></i>
                                </a>
                                <a href="{{ route('login') }}" class="glightbox cta-link">
                                    <i class="bi bi-box-arrow-in-right"></i>
                                    <span>Client Login</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6" data-aos="fade-left" data-aos-delay="300">
                        <div class="stats-grid">
                            <div class="stat-card stat-card-primary" data-aos="zoom-in" data-aos-delay="350">
                                <div class="stat-icon-wrap">
                                    <i class="bi bi-file-earmark-text"></i>
                                </div>
                                <div class="stat-info">
                                    <span class="stat-value">500+</span>
                                    <span class="stat-title">Orders Completed</span>
                                </div>
                            </div>

                            <div class="stat-card" data-aos="zoom-in" data-aos-delay="400">
                                <div class="stat-icon-wrap">
                                    <i class="bi bi-emoji-smile"></i>
                                </div>
                                <div class="stat-info">
                                    <span class="stat-value">98%</span>
                                    <span class="stat-title">Client Satisfaction</span>
                                </div>
                            </div>

                            <div class="stat-card" data-aos="zoom-in" data-aos-delay="450">
                                <div class="stat-icon-wrap">
                                    <i class="bi bi-people"></i>
                                </div>
                                <div class="stat-info">
                                    <span class="stat-value">200+</span>
                                    <span class="stat-title">Expert Writers</span>
                                </div>
                            </div>

                            <div class="stat-card stat-card-accent" data-aos="zoom-in" data-aos-delay="500">
                                <div class="stat-icon-wrap">
                                    <i class="bi bi-cash-coin"></i>
                                </div>
                                <div class="stat-info">
                                    <span class="stat-value">$10k+</span>
                                    <span class="stat-title">Referral Paid</span>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </section><!-- /Hero Section -->


        <!-- Team Section -->
        <section id="team" class="team section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Team</h2>
                <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
            </div><!-- End Section Title -->

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="row gy-5">

                    <!-- Team Member 1 -->
                    <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
                        <div class="team-card">
                            <div class="member-img">
                                <img src="{{ asset('assets/img/person/person-m-1.webp') }}" class="img-fluid"
                                    alt="Team Member">
                                <div class="social-overlay">
                                    <div class="social-links">
                                        <a href="#"><i class="bi bi-twitter-x"></i></a>
                                        <a href="#"><i class="bi bi-linkedin"></i></a>
                                        <a href="#"><i class="bi bi-instagram"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="member-info">
                                <span class="member-badge">Founder</span>
                                <h4>Marcus Wellington</h4>
                                <p>Chief Executive Officer</p>
                            </div>
                        </div>
                    </div><!-- End Team Member -->

                    <!-- Team Member 2 -->
                    <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="200">
                        <div class="team-card">
                            <div class="member-img">
                                <img src="{{ asset('assets/img/person/person-m-3.webp') }}" class="img-fluid"
                                    alt="Team Member">
                                <div class="social-overlay">
                                    <div class="social-links">
                                        <a href="#"><i class="bi bi-twitter-x"></i></a>
                                        <a href="#"><i class="bi bi-linkedin"></i></a>
                                        <a href="#"><i class="bi bi-dribbble"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="member-info">
                                <span class="member-badge">Strategy</span>
                                <h4>Elena Rodriguez</h4>
                                <p>Creative Director</p>
                            </div>
                        </div>
                    </div><!-- End Team Member -->

                    <!-- Team Member 3 - Featured -->
                    <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="300">
                        <div class="team-card featured">
                            <div class="member-img">
                                <img src="{{ asset('assets/img/person/person-m-5.webp') }}" class="img-fluid"
                                    alt="Team Member">
                                <div class="social-overlay">
                                    <div class="social-links">
                                        <a href="#"><i class="bi bi-twitter-x"></i></a>
                                        <a href="#"><i class="bi bi-github"></i></a>
                                        <a href="#"><i class="bi bi-linkedin"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="member-info">
                                <span class="member-badge">Tech Lead</span>
                                <h4>David Chen</h4>
                                <p>Head of Engineering</p>
                            </div>
                        </div>
                    </div><!-- End Team Member -->

                    <!-- Team Member 4 -->
                    <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="400">
                        <div class="team-card">
                            <div class="member-img">
                                <img src="{{ asset('assets/img/person/person-f-7.webp') }}" class="img-fluid"
                                    alt="Team Member">
                                <div class="social-overlay">
                                    <div class="social-links">
                                        <a href="#"><i class="bi bi-twitter-x"></i></a>
                                        <a href="#"><i class="bi bi-linkedin"></i></a>
                                        <a href="#"><i class="bi bi-behance"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="member-info">
                                <span class="member-badge">Growth</span>
                                <h4>Sophia Martinez</h4>
                                <p>Marketing Director</p>
                            </div>
                        </div>
                    </div><!-- End Team Member -->

                </div>

                <!-- Stats Row -->
                <div class="team-stats" data-aos="fade-up" data-aos-delay="500">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <div class="stats-wrapper">
                                <div class="stat-item">
                                    <span class="stat-number">50+</span>
                                    <span class="stat-label">Team Members</span>
                                </div>
                                <div class="stat-divider"></div>
                                <div class="stat-item">
                                    <span class="stat-number">12</span>
                                    <span class="stat-label">Countries</span>
                                </div>
                                <div class="stat-divider"></div>
                                <div class="stat-item">
                                    <span class="stat-number">8+</span>
                                    <span class="stat-label">Years Experience</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </section><!-- /Team Section -->

        <!-- Results Section -->
        <section id="results" class="portfolio section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>My Previous Results</h2>
                <p>Explore our track record of successful projects and transformations that have made a real impact for
                    our clients</p>
            </div><!-- End Section Title -->

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="isotope-layout" data-default-filter="*" data-layout="fitRows"
                    data-sort="original-order">

                    <div class="filters-wrapper" data-aos="fade-up" data-aos-delay="100">
                        <ul class="portfolio-filters isotope-filters">
                            <li data-filter="*" class="filter-active">All Projects</li>
                            <li data-filter=".filter-web">Content Writing</li>
                            <li data-filter=".filter-mobile">Assignments</li>
                            <li data-filter=".filter-branding">Story Writing</li>
                            <li data-filter=".filter-ui">Essays</li>
                        </ul>
                    </div>

                    <div class="row g-4 isotope-container" data-aos="fade-up" data-aos-delay="200">

                        <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-web">
                            <div class="project-card">
                                <div class="image-wrapper">
                                    <img src="assets/img/portfolio/portfolio-2.webp" alt="Project showcase"
                                        class="img-fluid" loading="lazy">
                                    <div class="hover-overlay">
                                        <div class="overlay-actions">
                                            <a href="assets/img/portfolio/portfolio-2.webp"
                                                class="glightbox action-btn" data-gallery="portfolio">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <a href="#" class="action-btn">
                                                <i class="bi bi-link-45deg"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <span class="category-badge">Content Writing</span>
                                </div>
                                <div class="project-info">
                                    <h3>Professional Blog Article</h3>
                                    <p>Engaging content that drives traffic and builds audience engagement through
                                        compelling storytelling.</p>
                                    <div class="project-meta">
                                        <div class="tech-tags">
                                            <span>SEO</span>
                                            <span>Marketing</span>
                                        </div>
                                        <span class="year">2024</span>
                                    </div>
                                </div>
                            </div>
                        </div><!-- End Portfolio Item -->

                        <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-mobile">
                            <div class="project-card featured">
                                <div class="image-wrapper">
                                    <img src="assets/img/portfolio/portfolio-4.webp" alt="Project showcase"
                                        class="img-fluid" loading="lazy">
                                    <div class="hover-overlay">
                                        <div class="overlay-actions">
                                            <a href="assets/img/portfolio/portfolio-4.webp"
                                                class="glightbox action-btn" data-gallery="portfolio">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <a href="#" class="action-btn">
                                                <i class="bi bi-link-45deg"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <span class="category-badge">Assignments</span>
                                    <span class="featured-badge"><i class="bi bi-star-fill"></i> Featured</span>
                                </div>
                                <div class="project-info">
                                    <h3>Research Paper Assignment</h3>
                                    <p>Comprehensive academic research with proper citations and analysis on complex
                                        topics.</p>
                                    <div class="project-meta">
                                        <div class="tech-tags">
                                            <span>Research</span>
                                            <span>Academic</span>
                                        </div>
                                        <span class="year">2024</span>
                                    </div>
                                </div>
                            </div>
                        </div><!-- End Portfolio Item -->

                        <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-branding">
                            <div class="project-card">
                                <div class="image-wrapper">
                                    <img src="assets/img/portfolio/portfolio-6.webp" alt="Project showcase"
                                        class="img-fluid" loading="lazy">
                                    <div class="hover-overlay">
                                        <div class="overlay-actions">
                                            <a href="assets/img/portfolio/portfolio-6.webp"
                                                class="glightbox action-btn" data-gallery="portfolio">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <a href="#" class="action-btn">
                                                <i class="bi bi-link-45deg"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <span class="category-badge">Story Writing</span>
                                </div>
                                <div class="project-info">
                                    <h3>Creative Fiction Story</h3>
                                    <p>Imaginative narrative with well-developed characters and compelling plot
                                        development.</p>
                                    <div class="project-meta">
                                        <div class="tech-tags">
                                            <span>Creative</span>
                                            <span>Fiction</span>
                                        </div>
                                        <span class="year">2023</span>
                                    </div>
                                </div>
                            </div>
                        </div><!-- End Portfolio Item -->

                        <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-ui">
                            <div class="project-card">
                                <div class="image-wrapper">
                                    <img src="assets/img/portfolio/portfolio-8.webp" alt="Project showcase"
                                        class="img-fluid" loading="lazy">
                                    <div class="hover-overlay">
                                        <div class="overlay-actions">
                                            <a href="assets/img/portfolio/portfolio-8.webp"
                                                class="glightbox action-btn" data-gallery="portfolio">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <a href="#" class="action-btn">
                                                <i class="bi bi-link-45deg"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <span class="category-badge">Essays</span>
                                </div>
                                <div class="project-info">
                                    <h3>Analytical Essay on Economics</h3>
                                    <p>Well-structured essay with critical analysis and supported arguments on
                                        contemporary issues.</p>
                                    <div class="project-meta">
                                        <div class="tech-tags">
                                            <span>Analysis</span>
                                            <span>Academic</span>
                                        </div>
                                        <span class="year">2024</span>
                                    </div>
                                </div>
                            </div>
                        </div><!-- End Portfolio Item -->

                        <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-web">
                            <div class="project-card">
                                <div class="image-wrapper">
                                    <img src="assets/img/portfolio/portfolio-1.webp" alt="Project showcase"
                                        class="img-fluid" loading="lazy">
                                    <div class="hover-overlay">
                                        <div class="overlay-actions">
                                            <a href="assets/img/portfolio/portfolio-1.webp"
                                                class="glightbox action-btn" data-gallery="portfolio">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <a href="#" class="action-btn">
                                                <i class="bi bi-link-45deg"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <span class="category-badge">Content Writing</span>
                                </div>
                                <div class="project-info">
                                    <h3>Technical Documentation</h3>
                                    <p>Clear and concise technical content tailored for various audiences and
                                        industries.</p>
                                    <div class="project-meta">
                                        <div class="tech-tags">
                                            <span>Technical</span>
                                            <span>Documentation</span>
                                        </div>
                                        <span class="year">2023</span>
                                    </div>
                                </div>
                            </div>
                        </div><!-- End Portfolio Item -->

                        <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-mobile">
                            <div class="project-card">
                                <div class="image-wrapper">
                                    <img src="assets/img/portfolio/portfolio-3.webp" alt="Project showcase"
                                        class="img-fluid" loading="lazy">
                                    <div class="hover-overlay">
                                        <div class="overlay-actions">
                                            <a href="assets/img/portfolio/portfolio-3.webp"
                                                class="glightbox action-btn" data-gallery="portfolio">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <a href="#" class="action-btn">
                                                <i class="bi bi-link-45deg"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <span class="category-badge">Assignments</span>
                                </div>
                                <div class="project-info">
                                    <h3>Case Study Analysis</h3>
                                    <p>Detailed case study breakdown with strategic recommendations and business
                                        insights.</p>
                                    <div class="project-meta">
                                        <div class="tech-tags">
                                            <span>Analysis</span>
                                            <span>Business</span>
                                        </div>
                                        <span class="year">2024</span>
                                    </div>
                                </div>
                            </div>
                        </div><!-- End Portfolio Item -->

                        <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-ui">
                            <div class="project-card featured">
                                <div class="image-wrapper">
                                    <img src="assets/img/portfolio/portfolio-7.webp" alt="Project showcase"
                                        class="img-fluid" loading="lazy">
                                    <div class="hover-overlay">
                                        <div class="overlay-actions">
                                            <a href="assets/img/portfolio/portfolio-7.webp"
                                                class="glightbox action-btn" data-gallery="portfolio">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <a href="#" class="action-btn">
                                                <i class="bi bi-link-45deg"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <span class="category-badge">Essays</span>
                                    <span class="featured-badge"><i class="bi bi-star-fill"></i> Featured</span>
                                </div>
                                <div class="project-info">
                                    <h3>Persuasive Essay Collection</h3>
                                    <p>Compelling essays with strong arguments, evidence-based reasoning, and persuasive
                                        techniques.</p>
                                    <div class="project-meta">
                                        <div class="tech-tags">
                                            <span>Persuasive</span>
                                            <span>Academic</span>
                                        </div>
                                        <span class="year">2024</span>
                                    </div>
                                </div>
                            </div>
                        </div><!-- End Portfolio Item -->

                        <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-branding">
                            <div class="project-card">
                                <div class="image-wrapper">
                                    <img src="assets/img/portfolio/portfolio-9.webp" alt="Project showcase"
                                        class="img-fluid" loading="lazy">
                                    <div class="hover-overlay">
                                        <div class="overlay-actions">
                                            <a href="assets/img/portfolio/portfolio-9.webp"
                                                class="glightbox action-btn" data-gallery="portfolio">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <a href="#" class="action-btn">
                                                <i class="bi bi-link-45deg"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <span class="category-badge">Story Writing</span>
                                </div>
                                <div class="project-info">
                                    <h3>Short Story Collection</h3>
                                    <p>Multiple engaging short stories with varied themes and captivating narratives.
                                    </p>
                                    <div class="project-meta">
                                        <div class="tech-tags">
                                            <span>Short Stories</span>
                                            <span>Creative</span>
                                        </div>
                                        <span class="year">2023</span>
                                    </div>
                                </div>
                            </div>
                        </div><!-- End Portfolio Item -->

                    </div><!-- End Portfolio Container -->

                </div>
        </section><!-- /Results Section -->

        <!-- Services Section -->
        <section id="services" class="services section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>A Few Samples</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore
                    et dolore magna aliqua</p>
            </div><!-- End Section Title -->

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="row g-4">

                    <!-- Service Card 1 -->
                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                        <div class="service-card">
                            <div class="icon-wrapper">
                                <i class="bi bi-lightbulb"></i>
                            </div>
                            <h3>Sample 1</h3>
                            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Iusto, distinctio odit quis
                                labore itaque fugit nulla totam temporibus esse illo. Dicta, incidunt? Qui ad sed
                                tenetur assumenda nisi nam et ipsum soluta harum laudantium repellat, rerum, aperiam
                                illo quasi quia vero tempore repudiandae expedita officia tempora, provident deleniti
                                fuga eaque!
                            </p>

                        </div>
                    </div><!-- End Service Card -->

                    <!-- Service Card 2 -->
                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                        <div class="service-card">
                            <div class="icon-wrapper">
                                <i class="bi bi-graph-up-arrow"></i>
                            </div>
                            <h3>Sample 2</h3>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Blanditiis, quibusdam nisi
                                corporis ducimus eveniet rem provident iure dolorum, praesentium molestias libero
                                impedit quia deleniti autem suscipit, veniam vel! Eius a vero, assumenda delectus
                                voluptates nobis, asperiores nihil ipsum laborum hic in iste aliquam voluptatibus
                                reprehenderit dolore facilis odio modi veritatis!
                            </p>
                        </div>
                    </div><!-- End Service Card -->

                    <!-- Service Card 3 - Featured -->
                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                        <div class="service-card featured">
                            <div class="featured-badge">
                                <i class="bi bi-star-fill"></i>
                                <span>Popular</span>
                            </div>
                            <div class="icon-wrapper">
                                <i class="bi bi-palette"></i>
                            </div>
                            <h3>Sample 3</h3>
                            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Amet, minus fuga labore harum
                                mollitia nobis alias quia placeat, molestias a tempora, blanditiis dolore eaque
                                voluptate modi eum delectus et quidem ratione vero id repellendus inventore commodi
                                ducimus. Similique est aspernatur consectetur voluptatum, sit perspiciatis maxime ipsam
                                dolorem? Nemo, error nesciunt?</p>

                        </div>
                    </div><!-- End Service Card -->

                    <!-- Service Card 4 -->
                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                        <div class="service-card">
                            <div class="icon-wrapper">
                                <i class="bi bi-code-slash"></i>
                            </div>
                            <h3>Sample 4</h3>
                            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Amet laborum ipsa quos omnis
                                explicabo accusamus eius atque distinctio. Ipsum exercitationem voluptatum iure.
                                Deleniti quis eligendi aut dicta eum eveniet autem voluptas cupiditate saepe! Fugit
                                voluptas possimus nesciunt atque ea amet ex earum, corporis ut quidem odit laudantium.
                                Expedita, ad commodi!</p>
                        </div>
                    </div><!-- End Service Card -->

                    <!-- Service Card 5 -->
                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                        <div class="service-card">
                            <div class="icon-wrapper">
                                <i class="bi bi-megaphone"></i>
                            </div>
                            <h3>Sample 5</h3>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Magni iure ipsa fuga porro
                                labore accusamus autem cum quo nisi molestias quasi, alias rem debitis repellat? Magnam
                                doloremque quos deleniti sequi ratione, enim explicabo voluptate nostrum quisquam! Et
                                sint odio nisi maiores doloremque quaerat libero iure. Corporis quisquam nobis possimus
                                accusamus.</p>
                        </div>
                    </div><!-- End Service Card -->

                    <!-- Service Card 6 -->
                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                        <div class="service-card">
                            <div class="icon-wrapper">
                                <i class="bi bi-shield-check"></i>
                            </div>
                            <h3>Sample 6</h3>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Rem asperiores reprehenderit
                                modi qui inventore cumque ut impedit autem iure earum quasi reiciendis sequi ullam
                                assumenda sed adipisci, ab mollitia. Ipsum pariatur esse sapiente corporis reprehenderit
                                neque nobis at consequuntur! Quod delectus ratione veniam porro fuga nostrum, magnam
                                inventore perferendis eligendi!</p>
                        </div>
                    </div><!-- End Service Card -->
                </div>

                <!-- Stats Row -->
                <div class="stats-row" data-aos="fade-up" data-aos-delay="400">
                    <div class="row g-4 justify-content-center">
                        <div class="col-6 col-md-3">
                            <div class="stat-item">
                                <span class="stat-number">250+</span>
                                <span class="stat-label">Projects Delivered</span>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="stat-item">
                                <span class="stat-number">98%</span>
                                <span class="stat-label">Client Satisfaction</span>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="stat-item">
                                <span class="stat-number">15+</span>
                                <span class="stat-label">Years Experience</span>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="stat-item">
                                <span class="stat-number">40+</span>
                                <span class="stat-label">Team Experts</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </section><!-- /Services Section -->


    </main>

    <footer id="footer" class="footer light-background">

        <div class="container footer-top py-5">
            <div class="row align-items-start justify-content-between">

                <!-- Logo + About -->
                <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                    <a href="{{ url('/') }}" class="d-flex align-items-center mb-3">
                        <span class="sitename fs-4 fw-bold">Tudynet</span>
                    </a>

                    <p class="mb-3">
                        Tudynet is a leading platform connecting students with expert writers. We streamline the
                        academic
                        writing process while offering a rewarding referral system for our community.
                    </p>
                </div>

                <!-- Get Started Links -->
                <div class="col-lg-3 col-md-6">
                    <h4 class="fw-semibold mb-3">Get Started</h4>
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <a href="{{ route('register') }}" class="text-decoration-none">
                                Join as Client
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('register') }}" class="text-decoration-none">
                                Affiliate Program
                            </a>
                        </li>
                    </ul>
                </div>

            </div>
        </div>

        <!-- Bottom Bar -->
        <div class="container footer-bottom border-top pt-3">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <p class="mb-0">
                        © <strong class="sitename">Tudynet</strong>. All Rights Reserved.
                    </p>
                </div>
            </div>
        </div>

    </footer>


    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->
    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
    <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>

    <!-- Main JS File -->
    <script src="{{ asset('assets/js/main.js') }}"></script>

</body>

</html>
