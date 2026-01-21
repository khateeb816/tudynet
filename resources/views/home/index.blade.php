<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Tudynet - Order & Referral Management System</title>
  <meta name="description" content="Tudynet is a comprehensive platform for managing writing orders, connecting clients with expert writers, and facilitating a seamless referral system.">
  <meta name="keywords" content="order management, referral system, academic writing, writers, clients, tudynet">

  <!-- Favicons -->
  <link href="{{ asset('assets/images/logo.jpeg') }}" rel="icon">
  <link href="{{ asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

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
          <li><a href="#about">About</a></li>
          <li><a href="#services">Services</a></li>
          <li><a href="#portfolio">Portfolio</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

      <div class="d-flex gap-2">
        <a class="btn-getstarted" href="{{ route('login') }}">Login</a>
        <a class="btn-getstarted" href="{{ route('register') }}" style="background-color: transparent; border: 2px solid var(--accent-color); color: var(--accent-color);">Register</a>
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

              <h1 class="hero-headline" data-aos="fade-up" data-aos-delay="300">Streamline Your <br>Writing Business</h1>

              <p class="hero-text" data-aos="fade-up" data-aos-delay="350">
                The ultimate platform for managing academic orders, connecting with expert writers, and growing your network through our powerful referral system.
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

    <!-- About Section -->
    <section id="about" class="about section">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-5 align-items-center">

          <div class="col-xl-6 aos-init aos-animate" data-aos="fade-right" data-aos-delay="200">
            <div class="about-images-wrapper">
              <div class="image-main">
                <img src="{{ asset('assets/img/about/about-5.webp') }}" alt="Business meeting" class="img-fluid">
              </div>
              <div class="image-offset">
                <img src="{{ asset('assets/img/about/about-square-3.webp') }}" alt="Detail shot" class="img-fluid">
              </div>
              <div class="experience-badge">
                <span class="years purecounter" data-purecounter-start="0" data-purecounter-end="12" data-purecounter-duration="1">12</span>
                <span class="text">Years of<br>Excellence</span>
              </div>
              <div class="shape-pattern"></div>
            </div>
          </div>

           <div class="col-xl-6 aos-init aos-animate" data-aos="fade-left" data-aos-delay="300">
            <div class="about-content">
              <div class="section-subtitle">Who We Are</div>
              <h2>Empowering Academic & Professional Excellence</h2>
              <p class="lead-text">
                Tudynet bridges the gap between those seeking high-quality writing services and a network of skilled professional writers.
              </p>
              <p class="mb-4 description">
                Our platform provides a seamless order management experience, ensuring timely delivery, original content, and secure transactions. We also empower our users through a robust referral system, allowing you to grow with us.
              </p>

              <div class="features-grid">
                <div class="feature-card">
                  <i class="bi bi-clock-history"></i>
                  <span>Fast Turnaround</span>
                </div>
                <div class="feature-card">
                  <i class="bi bi-patch-check-fill"></i>
                  <span>Verified Writers</span>
                </div>
                <div class="feature-card">
                  <i class="bi bi-shield-lock-fill"></i>
                  <span>Secure Payments</span>
                </div>
                <div class="feature-card">
                  <i class="bi bi-headset"></i>
                  <span>24/7 Support</span>
                </div>
              </div>

              <div class="stats-row">
                <div class="stat-box">
                  <span class="number purecounter" data-purecounter-start="0" data-purecounter-end="500" data-purecounter-duration="1">500</span>+
                  <span class="label">Orders Done</span>
                </div>
                <div class="stat-box">
                  <span class="number purecounter" data-purecounter-start="0" data-purecounter-end="200" data-purecounter-duration="1">200</span>+
                  <span class="label">Active Writers</span>
                </div>
                <div class="stat-box">
                  <span class="number purecounter" data-purecounter-start="0" data-purecounter-end="98" data-purecounter-duration="1">98%</span>
                  <span class="label">Satisfaction</span>
                </div>
              </div>

              <div class="action-buttons">
                <a href="{{ route('register') }}" class="btn btn-primary-custom">
                  Join Us Today <i class="bi bi-arrow-right"></i>
                </a>
              </div>

            </div>
          </div>

        </div>

      </div>

    </section><!-- /About Section -->

    <!-- Services Section -->
    <section id="services" class="services section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Services</h2>
        <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row g-4">

          <!-- Service Card 1 -->
          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
            <div class="service-card">
              <div class="icon-wrapper">
                <i class="bi bi-pen"></i>
              </div>
              <h3>Academic Writing</h3>
              <p>Professional assistance with essays, research papers, dissertations, and more, tailored to academic standards.</p>
            </div>
          </div><!-- End Service Card -->

          <!-- Service Card 2 -->
          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
            <div class="service-card">
              <div class="icon-wrapper">
                <i class="bi bi-file-text"></i>
              </div>
              <h3>Content Creation</h3>
              <p>High-quality articles, blog posts, and website copy designed to engage and inform your audience.</p>
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
                <i class="bi bi-check-circle"></i>
              </div>
              <h3>Proofreading & Editing</h3>
              <p>Meticulous review of your documents to ensure clarity, grammar accuracy, and polished flow.</p>
            </div>
          </div><!-- End Service Card -->

          <!-- Service Card 4 -->
          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
            <div class="service-card">
              <div class="icon-wrapper">
                <i class="bi bi-people-fill"></i>
              </div>
              <h3>Referral Program</h3>
              <p>Join our network and earn commissions by referring new clients or writers to our platform.</p>
            </div>
          </div><!-- End Service Card -->

          <!-- Service Card 5 -->
          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
            <div class="service-card">
              <div class="icon-wrapper">
                <i class="bi bi-kanban"></i>
              </div>
              <h3>Order Management</h3>
              <p>Efficiently track your orders, communicate with writers, and manage deadlines from a single dashboard.</p>
            </div>
          </div><!-- End Service Card -->

          <!-- Service Card 6 -->
          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
            <div class="service-card">
              <div class="icon-wrapper">
                <i class="bi bi-shield-lock"></i>
              </div>
              <h3>Secure Transactions</h3>
              <p>Your payments and personal data are protected with industry-standard security protocols and escrow services.</p>
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

    <!-- Portfolio Section -->
    <section id="portfolio" class="portfolio section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Our Expertise</h2>
        <p>Explore the wide range of services and subjects our expert writers specialize in</p>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row g-4" data-aos="fade-up" data-aos-delay="200">

          <div class="col-lg-4 col-md-6">
            <div class="project-card">
              <div class="image-wrapper">
                <img src="{{ asset('assets/img/portfolio/portfolio-2.webp') }}" alt="Academic Writing" class="img-fluid" loading="lazy">
                <span class="category-badge">Academic</span>
              </div>
              <div class="project-info">
                <h3>Research Papers</h3>
                <p>Comprehensive research and analysis on complex topics.</p>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6">
            <div class="project-card featured">
              <div class="image-wrapper">
                <img src="{{ asset('assets/img/portfolio/portfolio-4.webp') }}" alt="Creative Writing" class="img-fluid" loading="lazy">
                <span class="category-badge">Creative</span>
                <span class="featured-badge"><i class="bi bi-star-fill"></i> Popular</span>
              </div>
              <div class="project-info">
                <h3>Essays & Articles</h3>
                <p>Engaging content tailored to your specific audience.</p>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6">
            <div class="project-card">
              <div class="image-wrapper">
                <img src="{{ asset('assets/img/portfolio/portfolio-6.webp') }}" alt="Business Writing" class="img-fluid" loading="lazy">
                <span class="category-badge">Business</span>
              </div>
              <div class="project-info">
                <h3>Business Plans</h3>
                <p>Strategic documentation for startups and enterprises.</p>
              </div>
            </div>
          </div>

        </div>

        <div class="cta-section" data-aos="zoom-in" data-aos-delay="300">
          <div class="cta-content">
            <span class="cta-label"><i class="bi bi-lightning-charge-fill"></i> Ready to Start?</span>
            <h3>Get Your Order Completed Today</h3>
            <p>Join thousands of satisfied clients who trust Tudynet for their writing needs.</p>
            <div class="cta-buttons">
              <a href="{{ route('register') }}" class="btn-cta-primary">Place Order <i class="bi bi-arrow-right"></i></a>
            </div>
          </div>
          <div class="cta-decoration">
            <div class="floating-shape shape-1"></div>
            <div class="floating-shape shape-2"></div>
            <div class="floating-shape shape-3"></div>
          </div>
        </div>

      </div>

    </section><!-- /Portfolio Section -->

    <!-- Why Us Section -->
    <section id="why-us" class="why-us section light-background">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Why Us</h2>
        <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row g-5">
          <div class="col-lg-5" data-aos="fade-right" data-aos-delay="200">
            <div class="sidebar-content">
              <div class="badge-wrapper">
                <span class="section-badge"><i class="bi bi-stars"></i> Our Difference</span>
              </div>
              <h2>Transform Your Academic Journey</h2>
              <p class="description">We connect you with the best minds to ensure your success. Our platform facilitates seamless collaboration between clients and verified writers.</p>

              <div class="stat-cards">
                <div class="stat-card" data-aos="zoom-in" data-aos-delay="300">
                  <div class="stat-value">
                    <span class="purecounter" data-purecounter-start="0" data-purecounter-end="500" data-purecounter-duration="2">500</span>+
                  </div>
                  <div class="stat-text">Orders Completed</div>
                </div>
                <div class="stat-card" data-aos="zoom-in" data-aos-delay="350">
                  <div class="stat-value">
                    <span class="purecounter" data-purecounter-start="0" data-purecounter-end="98" data-purecounter-duration="2">98</span>%
                  </div>
                  <div class="stat-text">High Quality Score</div>
                </div>
                <div class="stat-card" data-aos="zoom-in" data-aos-delay="400">
                  <div class="stat-value">
                    <span class="purecounter" data-purecounter-start="0" data-purecounter-end="24" data-purecounter-duration="2">24</span>/7
                  </div>
                  <div class="stat-text">Support Available</div>
                </div>
              </div>

              <div class="action-buttons">
                <a href="{{ route('register') }}" class="btn-main">Get Started Today</a>
              </div>
            </div>
          </div>

          <div class="col-lg-7" data-aos="fade-left" data-aos-delay="200">
            <div class="features-grid">
              <div class="feature-box highlight" data-aos="fade-up" data-aos-delay="250">
                <div class="feature-ribbon">Top Rated</div>
                <div class="feature-icon">
                  <i class="bi bi-clock-fill"></i>
                </div>
                <div class="feature-content">
                  <h4>On-Time Delivery</h4>
                  <p>We respect your deadlines. Our writers are committed to delivering quality work within your specified timeframe.</p>
                  <a href="{{ route('register') }}" class="feature-link">Start Now <i class="bi bi-chevron-right"></i></a>
                </div>
              </div><!-- End Feature Box -->

              <div class="feature-box" data-aos="fade-up" data-aos-delay="300">
                <div class="feature-icon">
                  <i class="bi bi-shield-fill-check"></i>
                </div>
                <div class="feature-content">
                  <h4>Quality Guarantee</h4>
                  <p>All work goes through a rigorous quality check to ensure it meets our high standards and your instructions.</p>
                  <a href="{{ route('register') }}" class="feature-link">Join Us <i class="bi bi-chevron-right"></i></a>
                </div>
              </div><!-- End Feature Box -->

              <div class="feature-box" data-aos="fade-up" data-aos-delay="350">
                <div class="feature-icon">
                  <i class="bi bi-people-fill"></i>
                </div>
                <div class="feature-content">
                  <h4>Expert Writers</h4>
                  <p>Our network consists of verified professionals with expertise in various academic and professional fields.</p>
                  <a href="{{ route('register') }}" class="feature-link">Register today <i class="bi bi-chevron-right"></i></a>
                </div>
              </div><!-- End Feature Box -->
            </div>

            <div class="process-timeline" data-aos="fade-up" data-aos-delay="400">
              <h5 class="timeline-title"><i class="bi bi-diagram-3-fill"></i> How It Works</h5>
              <div class="timeline-steps">
                <div class="timeline-step">
                  <div class="step-marker">1</div>
                  <div class="step-info">
                    <strong>Order</strong>
                    <span>Submit details</span>
                  </div>
                </div>
                <div class="timeline-connector"></div>
                <div class="timeline-step">
                  <div class="step-marker">2</div>
                  <div class="step-info">
                    <strong>Match</strong>
                    <span>Expert assigned</span>
                  </div>
                </div>
                <div class="timeline-connector"></div>
                <div class="timeline-step">
                  <div class="step-marker">3</div>
                  <div class="step-info">
                    <strong>Review</strong>
                    <span>Quality check</span>
                  </div>
                </div>
                <div class="timeline-connector"></div>
                <div class="timeline-step">
                  <div class="step-marker">4</div>
                  <div class="step-info">
                    <strong>Receive</strong>
                    <span>Final delivery</span>
                  </div>
                </div>
              </div>
            </div>

            <div class="capabilities-section" data-aos="fade-up" data-aos-delay="450">
              <h5 class="capabilities-heading">What We Bring to the Table</h5>
              <div class="capabilities-grid">
                <div class="capability-card">
                  <div class="capability-icon">
                    <i class="bi bi-bullseye"></i>
                  </div>
                  <h6>Strategic Matching</h6>
                  <p>We analyze your requirements to find the perfect writer for your specific subject and level.</p>
                </div>
                <div class="capability-card">
                  <div class="capability-icon">
                    <i class="bi bi-code-slash"></i>
                  </div>
                  <h6>Secure Platform</h6>
                  <p>Your data and payments are protected 24/7 with our advanced security infrastructure.</p>
                </div>
                <div class="capability-card">
                  <div class="capability-icon">
                    <i class="bi bi-arrow-repeat"></i>
                  </div>
                  <h6>Continuous Support</h6>
                  <p>Our team is available round the clock to assist you with any questions or concerns.</p>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </section><!-- /Why Us Section -->

    <!-- Testimonials Section -->
    <section id="testimonials" class="testimonials section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Testimonials</h2>
        <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row">

          <!-- Left Sidebar -->
          <div class="col-lg-4" data-aos="fade-right" data-aos-delay="150">
            <div class="testimonials-sidebar">
              <div class="avatar-stack">
                <img src="{{ asset('assets/img/person/person-m-3.webp') }}" alt="Happy Client" class="avatar" loading="lazy">
                <img src="{{ asset('assets/img/person/person-f-7.webp') }}" alt="Happy Client" class="avatar" loading="lazy">
                <img src="{{ asset('assets/img/person/person-m-9.webp') }}" alt="Happy Client" class="avatar" loading="lazy">
                <img src="{{ asset('assets/img/person/person-f-4.webp') }}" alt="Happy Client" class="avatar" loading="lazy">
                <span class="avatar-count">+2.5k</span>
              </div>
              <div class="sidebar-content">
                <span class="satisfied-badge"><i class="bi bi-heart-fill"></i> Satisfied Community</span>
                <h3>Discover What Our Member Says</h3>
                <p>Real feedback from students, professional writers, and referral partners who use Tudynet daily.</p>
                <a href="{{ route('register') }}" class="btn-view-all">Register today <i class="bi bi-arrow-right"></i></a>
              </div>
            </div>
          </div><!-- End Left Sidebar -->

          <!-- Right Testimonials Slider -->
          <div class="col-lg-8" data-aos="fade-left" data-aos-delay="200">
            <div class="testimonials-carousel swiper init-swiper">
              <script type="application/json" class="swiper-config">
                {
                  "loop": true,
                  "speed": 700,
                  "autoplay": {
                    "delay": 5000
                  },
                  "slidesPerView": 1,
                  "spaceBetween": 24,
                  "pagination": {
                    "el": ".swiper-pagination",
                    "type": "bullets",
                    "clickable": true
                  },
                  "breakpoints": {
                    "768": {
                      "slidesPerView": 2
                    }
                  }
                }
              </script>

              <div class="swiper-wrapper">

                <div class="swiper-slide">
                  <div class="testimonial-card">
                    <div class="card-top">
                      <div class="stars">
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                      </div>
                      <span class="quote-mark"><i class="bi bi-quote"></i></span>
                    </div>
                    <p class="testimonial-text">Tudynet has completely changed how I manage my academic assignments. The writers are top-notch and always deliver before the deadline.</p>
                    <div class="author-info">
                      <img src="{{ asset('assets/img/person/person-f-2.webp') }}" alt="Student" class="author-img" loading="lazy">
                      <div class="author-details">
                        <h5>Sarah Jenkins</h5>
                        <span>Student (Client)</span>
                      </div>
                    </div>
                  </div>
                </div><!-- End Testimonial Card -->

                <div class="swiper-slide">
                  <div class="testimonial-card">
                    <div class="card-top">
                      <div class="stars">
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                      </div>
                      <span class="quote-mark"><i class="bi bi-quote"></i></span>
                    </div>
                    <p class="testimonial-text">As a writer, I appreciate the clear communication and fair payment structure. The platform is intuitive and helps me focus on quality work.</p>
                    <div class="author-info">
                      <img src="{{ asset('assets/img/person/person-m-5.webp') }}" alt="Writer" class="author-img" loading="lazy">
                      <div class="author-details">
                        <h5>David Miller</h5>
                        <span>Professional Writer</span>
                      </div>
                    </div>
                  </div>
                </div><!-- End Testimonial Card -->

                <div class="swiper-slide">
                  <div class="testimonial-card">
                    <div class="card-top">
                      <div class="stars">
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                      </div>
                      <span class="quote-mark"><i class="bi bi-quote"></i></span>
                    </div>
                    <p class="testimonial-text">The referral system is fantastic! I was able to earn significant commissions by simply sharing my link with my fellow students.</p>
                    <div class="author-info">
                      <img src="{{ asset('assets/img/person/person-f-9.webp') }}" alt="Affiliate" class="author-img" loading="lazy">
                      <div class="author-details">
                        <h5>Elena Rodriguez</h5>
                        <span>Referral Partner</span>
                      </div>
                    </div>
                  </div>
                </div><!-- End Testimonial Card -->

                <div class="swiper-slide">
                  <div class="testimonial-card">
                    <div class="card-top">
                      <div class="stars">
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                      </div>
                      <span class="quote-mark"><i class="bi bi-quote"></i></span>
                    </div>
                    <p class="testimonial-text">I've used several writing platforms, but none offer the quality and reliability of Tudynet. Highly recommended for any serious student.</p>
                    <div class="author-info">
                      <img src="{{ asset('assets/img/person/person-m-11.webp') }}" alt="Student" class="author-img" loading="lazy">
                      <div class="author-details">
                        <h5>James Mitchell</h5>
                        <span>Repeat Client</span>
                      </div>
                    </div>
                  </div>
                </div><!-- End Testimonial Card -->

                <div class="swiper-slide">
                  <div class="testimonial-card">
                    <div class="card-top">
                      <div class="stars">
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                      </div>
                      <span class="quote-mark"><i class="bi bi-quote"></i></span>
                    </div>
                    <p class="testimonial-text">Managing my orders on Tudynet is a breeze. The interface is clean, and the support team is always ready to help when I need it.</p>
                    <div class="author-info">
                      <img src="{{ asset('assets/img/person/person-f-14.webp') }}" alt="Writer" class="author-img" loading="lazy">
                      <div class="author-details">
                        <h5>Olivia Chen</h5>
                        <span>Academic Writer</span>
                      </div>
                    </div>
                  </div>
                </div><!-- End Testimonial Card -->

              </div>

              <div class="swiper-pagination"></div>

            </div>
          </div><!-- End Right Testimonials Slider -->

        </div>

      </div>

    </section><!-- /Testimonials Section -->
  </main>

  <footer id="footer" class="footer light-background">

    <div class="container footer-top">
      <div class="row gy-4">
        <div class="col-lg-3 col-md-6 footer-info">
          <a href="{{ url('/') }}" class="logo d-flex align-items-center mb-4">
            <span class="sitename">Tudynet</span>
          </a>
          <p>Tudynet is a leading platform connecting students with expert writers. We streamline the academic writing process while offering a rewarding referral system for our community.</p>

          <div class="social-links d-flex mt-4">
            <a href="#" aria-label="Twitter"><i class="bi bi-twitter-x"></i></a>
            <a href="#" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
            <a href="#" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
            <a href="#" aria-label="TikTok"><i class="bi bi-tiktok"></i></a>
            <a href="#" aria-label="Pinterest"><i class="bi bi-pinterest"></i></a>
          </div>
        </div>

        <div class="col-lg-2 col-md-6 footer-links">
          <h4>Services</h4>
          <ul>
            <li><a href="#services">Academic Writing</a></li>
            <li><a href="#services">Content Creation</a></li>
            <li><a href="#services">Proofreading</a></li>
            <li><a href="#services">Referral Program</a></li>
            <li><a href="#services">Order Management</a></li>
            <li><a href="#services">Secure Payments</a></li>
          </ul>
        </div>

        <div class="col-lg-2 col-md-6 footer-links">
          <h4>Quick Links</h4>
          <ul>
            <li><a href="#hero">Home</a></li>
            <li><a href="#about">About Us</a></li>
            <li><a href="#services">Services</a></li>
            <li><a href="#portfolio">Our Expertise</a></li>
            <li><a href="#why-us">Why Us</a></li>
          </ul>
        </div>

        <div class="col-lg-2 col-md-6 footer-links">
          <h4>More Info</h4>
          <ul>
            <li><a href="{{ route('register') }}">Join as Client</a></li>
            <li><a href="{{ route('register') }}">Affiliate Program</a></li>
          </ul>
        </div>
      </div>
    </div>

    <div class="container footer-bottom">
      <div class="row gy-3">
        <div class="col-md-6 order-2 order-md-1">
          <div class="copyright">
            <p>© <span>Copyright</span> <strong class="sitename">Tudynet</strong>. All Rights Reserved.</p>
          </div>
        </div>
      </div>
    </div>

  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

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
