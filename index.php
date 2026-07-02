<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Izaz Uddin — Web Developer</title>

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet" />

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

  <!-- AOS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" />

  <!-- Stylesheets -->
  <link rel="stylesheet" href="style.css" />
  <link rel="stylesheet" href="responsive.css" />
</head>
<body>

<?php
require_once __DIR__ . '/includes/helpers.php';
secure_session_start();
?>

  <!-- ═══════════════ LOADER ═══════════════ -->

  <div id="loader">
    <div class="loader-inner">
      <div class="loader-code">&lt;IU /&gt;</div>
      <div class="loader-bar"><div class="loader-fill"></div></div>
    </div>
  </div>

  <!-- ═══════════════ SCROLL TO TOP ═══════════════ -->
  <button id="scrollTop" aria-label="Scroll to top"><i class="fa-solid fa-arrow-up"></i></button>

  <!-- ═══════════════ NAVBAR ═══════════════ -->
  <nav id="navbar">
    <div class="nav-inner">
      <a href="#hero" class="nav-logo"><img src="project-img/logo.png" alt="Izaz Uddin Logo" /></a>
      <ul class="nav-links" id="navLinks">
        <li><a href="#about">About</a></li>
        <li><a href="#skills">Skills</a></li>
        <li><a href="#projects">Projects</a></li>
        <li><a href="#experience">Experience</a></li>
        <li><a href="#education">Education</a></li>
        <li><a href="#certifications">Certs</a></li>
        <li><a href="#contact">Contact</a></li>
      </ul>
      <button class="hamburger" id="hamburger" aria-label="Menu">
        <span></span><span></span><span></span>
      </button>
    </div>
  </nav>

  <!-- ═══════════════ HERO ═══════════════ -->
  <section id="hero">
    <div class="hero-bg-grid"></div>
    <div class="hero-glow hero-glow-1"></div>
    <div class="hero-glow hero-glow-2"></div>

    <div class="hero-content">
      <div class="hero-text">
        <p class="hero-eyebrow"><span class="dot"></span> Available for hire</p>
        <h1 class="hero-name">Izaz<br /><span>Uddin</span></h1>
        <p class="hero-title">
          <span class="typed-prefix">I build </span>
          <span id="typed"></span>
        </p>
        <p class="hero-desc">
          BS Computer Science graduate and full-stack web developer specialising in PHP, JavaScript, and MySQL — turning ideas into responsive, high-performance web applications.
        </p>
        <div class="hero-cta">
          <a href="#contact" class="btn btn-primary">Hire Me <i class="fa-solid fa-arrow-right"></i></a>
          <a href="izaz_cv.pdf" class="btn btn-outline" download>Download CV <i class="fa-solid fa-download"></i></a>
        </div>
        <div class="hero-stats">
          <div class="stat"><span class="counter" data-target="7">0</span>+ <small>Projects</small></div>
          <div class="stat-divider"></div>
          <div class="stat"><span class="counter" data-target="9">0</span>+ <small>Skills</small></div>
          <div class="stat-divider"></div>
          <div class="stat"><span class="counter" data-target="1">0</span>+ <small>Year Exp.</small></div>
        </div>
      </div>

      <div class="hero-avatar">
        <div class="avatar-ring"></div>
        <div class="avatar-placeholder">
          <img src="project-img/izaz.png" alt="Izaz Uddin" />
        </div>
        <div class="avatar-badge"><i class="fa-solid fa-code"></i> PHP Dev</div>
      </div>
    </div>

    <a href="#about" class="hero-scroll"><i class="fa-solid fa-chevron-down"></i></a>
  </section>

  <!-- ═══════════════ ABOUT ═══════════════ -->
  <section id="about">
    <div class="container">
      <div class="section-header" data-aos="fade-up">
        <p class="section-label">01 / Who I Am</p>
        <h2>About <span>Me</span></h2>
      </div>

      <div class="about-grid">
        <div class="about-visual" data-aos="fade-right">
          <div class="about-card glass">
            <div class="about-avatar-lg">
              <img src="project-img/izaz.png" alt="Izaz Uddin" />
            </div>
            <h3>Izaz Uddin</h3>
            <p class="about-role">Web Developer</p>
            <div class="about-info-list">
              <div class="info-row"><i class="fa-solid fa-location-dot"></i> Atta height dream gardan defense road Lahor, Pakistan</div>
              <div class="info-row"><i class="fa-solid fa-envelope"></i> izazuddin47@gmail.com</div>
              <div class="info-row"><i class="fa-solid fa-phone"></i> +92-3190750829</div>
              <div class="info-row"><i class="fa-solid fa-clock"></i> UTC+05:00</div>
            </div>
          </div>
        </div>

        <div class="about-body" data-aos="fade-left">
          <h3 class="about-sub">Career Objective</h3>
          <p>
            I am a motivated BS Computer Science graduate with strong technical foundations in software development and web technologies. My academic journey has strengthened my analytical thinking, research aptitude, and problem-solving capabilities, enabling me to approach complex challenges systematically.
          </p>
          <p>
            I am particularly interested in advancing my knowledge through research-driven environments where innovation, collaboration, and interdisciplinary learning are encouraged. With the ability to work effectively both independently and within multicultural teams, I aim to contribute to impactful projects while continuously enhancing my technical and academic competencies.
          </p>

          <div class="about-highlights">
            <div class="highlight-chip"><i class="fa-solid fa-graduation-cap"></i> BS Computer Science</div>
            <div class="highlight-chip"><i class="fa-solid fa-laptop-code"></i> Full-Stack PHP</div>
            <div class="highlight-chip"><i class="fa-solid fa-certificate"></i> Duolingo English 95</div>
            <div class="highlight-chip"><i class="fa-brands fa-github"></i> Open Source</div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ═══════════════ SKILLS ═══════════════ -->
  <section id="skills">
    <div class="container">
      <div class="section-header" data-aos="fade-up">
        <p class="section-label">02 / What I Know</p>
        <h2>Technical <span>Skills</span></h2>
      </div>

      <div class="skills-grid">

        <!-- Frontend -->
        <div class="skill-group glass" data-aos="fade-up" data-aos-delay="0">
          <h3 class="skill-group-title"><i class="fa-solid fa-palette"></i> Frontend</h3>
          <div class="skill-bar-wrap">
            <div class="skill-label"><span>HTML5</span><span>90%</span></div>
            <div class="skill-track"><div class="skill-fill" data-width="90"></div></div>
          </div>
          <div class="skill-bar-wrap">
            <div class="skill-label"><span>CSS3</span><span>85%</span></div>
            <div class="skill-track"><div class="skill-fill" data-width="85"></div></div>
          </div>
          <div class="skill-bar-wrap">
            <div class="skill-label"><span>Bootstrap</span><span>85%</span></div>
            <div class="skill-track"><div class="skill-fill" data-width="85"></div></div>
          </div>
          <div class="skill-bar-wrap">
            <div class="skill-label"><span>JavaScript</span><span>75%</span></div>
            <div class="skill-track"><div class="skill-fill" data-width="75"></div></div>
          </div>
        </div>

        <!-- Backend -->
        <div class="skill-group glass" data-aos="fade-up" data-aos-delay="100">
          <h3 class="skill-group-title"><i class="fa-solid fa-server"></i> Backend</h3>
          <div class="skill-bar-wrap">
            <div class="skill-label"><span>PHP</span><span>85%</span></div>
            <div class="skill-track"><div class="skill-fill" data-width="85"></div></div>
          </div>
          <div class="skill-bar-wrap">
            <div class="skill-label"><span>MySQL / RDBMS</span><span>80%</span></div>
            <div class="skill-track"><div class="skill-fill" data-width="80"></div></div>
          </div>
          <div class="skill-bar-wrap">
            <div class="skill-label"><span>CodeIgniter</span><span>70%</span></div>
            <div class="skill-track"><div class="skill-fill" data-width="70"></div></div>
          </div>
          <div class="skill-bar-wrap">
            <div class="skill-label"><span>Laravel <small>(Learning)</small></span><span>50%</span></div>
            <div class="skill-track"><div class="skill-fill learning" data-width="50"></div></div>
          </div>
        </div>

        <!-- Tools -->
        <div class="skill-group glass" data-aos="fade-up" data-aos-delay="200">
          <h3 class="skill-group-title"><i class="fa-solid fa-wrench"></i> Tools & Other</h3>
          <div class="skill-bar-wrap">
            <div class="skill-label"><span>Git & GitHub</span><span>75%</span></div>
            <div class="skill-track"><div class="skill-fill" data-width="75"></div></div>
          </div>
          <div class="skill-bar-wrap">
            <div class="skill-label"><span>TypeScript</span><span>55%</span></div>
            <div class="skill-track"><div class="skill-fill" data-width="55"></div></div>
          </div>
          <div class="skill-bar-wrap">
            <div class="skill-label"><span>Responsive Design</span><span>88%</span></div>
            <div class="skill-track"><div class="skill-fill" data-width="88"></div></div>
          </div>
          <div class="skill-bar-wrap">
            <div class="skill-label"><span>Problem Solving</span><span>80%</span></div>
            <div class="skill-track"><div class="skill-fill" data-width="80"></div></div>
          </div>
        </div>

      </div>

      <!-- Soft Skills Pills -->
      <div class="soft-skills" data-aos="fade-up">
        <div class="soft-pill"><i class="fa-solid fa-users"></i> Team Player</div>
        <div class="soft-pill"><i class="fa-solid fa-lightbulb"></i> Creative</div>
        <div class="soft-pill"><i class="fa-solid fa-comments"></i> Communication</div>
        <div class="soft-pill"><i class="fa-solid fa-medal"></i> Leadership</div>
        <div class="soft-pill"><i class="fa-solid fa-handshake"></i> Social Commitment</div>
      </div>
    </div>
  </section>

  <!-- ═══════════════ PROJECTS ═══════════════ -->
  <section id="projects">
    <div class="container">
      <div class="section-header" data-aos="fade-up">
        <p class="section-label">03 / What I Built</p>
        <h2>Featured <span>Projects</span></h2>
      </div>

      <div class="projects-grid">

        <!-- FYP -->
        <div class="project-card featured glass" data-aos="fade-up">
          <div class="project-img"><img src="project-img/GTT.png" alt="Digital Time Tracker System" /><span class="fyp-badge">FYP</span></div>
          <div class="project-body">
            <div class="project-tags">
              <span>PHP</span><span>MySQL</span><span>Bootstrap</span><span>JavaScript</span>
            </div>
            <h3>Digital Time Tracker System</h3>
            <p>Final Year Project — A role-based web application for software houses to manage projects, track employee work hours, monitor task progress, and generate productivity reports. Features Super Admin, Admin, and User panels.</p>
            <ul class="project-features">
              <li><i class="fa-solid fa-check"></i> Role-based access control (3 panels)</li>
              <li><i class="fa-solid fa-check"></i> Real-time task & time tracking</li>
              <li><i class="fa-solid fa-check"></i> Dashboard analytics & productivity reports</li>
              <li><i class="fa-solid fa-check"></i> User authentication & project management</li>
            </ul>
            <div class="project-links">
              <a href="#" class="btn btn-sm btn-outline"><i class="fa-brands fa-github"></i> GitHub</a>
              <a href="#" class="btn btn-sm btn-primary"><i class="fa-solid fa-globe"></i> Live Demo</a>
            </div>
          </div>
        </div>

        <!-- Expense -->
        <div class="project-card glass" data-aos="fade-up" data-aos-delay="50">
          <div class="project-img"><img src="project-img/expenes.png" alt="Expense Management System" /></div>
          <div class="project-body">
            <div class="project-tags"><span>PHP</span><span>MySQL</span><span>Bootstrap</span></div>
            <h3>Expense Management System</h3>
            <p>A web app for tracking daily expenses with category-wise reporting and data visualisation dashboards.</p>
            <ul class="project-features">
              <li><i class="fa-solid fa-check"></i> Category-wise expense tracking</li>
              <li><i class="fa-solid fa-check"></i> Data visualisation charts</li>
              <li><i class="fa-solid fa-check"></i> MySQL database integration</li>
            </ul>
            <div class="project-links">
              <a href="#" class="btn btn-sm btn-outline"><i class="fa-brands fa-github"></i> GitHub</a>
              <a href="#" class="btn btn-sm btn-primary"><i class="fa-solid fa-globe"></i> Live Demo</a>
            </div>
          </div>
        </div>

        <!-- Hospital / Medicine -->
        <div class="project-card glass" data-aos="fade-up" data-aos-delay="100">
          <div class="project-img"><img src="project-img/medicin.png" alt="Medicine Management System" /></div>
          <div class="project-body">
            <div class="project-tags"><span>PHP</span><span>MySQL</span><span>Bootstrap</span></div>
            <h3>Medicine Management System</h3>
            <p>PHP-based hospital management web app for handling patient records, appointment scheduling, and doctor details.</p>
            <ul class="project-features">
              <li><i class="fa-solid fa-check"></i> Patient record management</li>
              <li><i class="fa-solid fa-check"></i> Appointment scheduling</li>
              <li><i class="fa-solid fa-check"></i> Doctor detail management</li>
            </ul>
            <div class="project-links">
              <a href="#" class="btn btn-sm btn-outline"><i class="fa-brands fa-github"></i> GitHub</a>
              <a href="#" class="btn btn-sm btn-primary"><i class="fa-solid fa-globe"></i> Live Demo</a>
            </div>
          </div>
        </div>

        <!-- Personal Blog -->
        <div class="project-card glass" data-aos="fade-up" data-aos-delay="150">
          <div class="project-img"><img src="project-img/blog.png" alt="Personal Blog CMS" /></div>
          <div class="project-body">
            <div class="project-tags"><span>PHP</span><span>MySQL</span><span>Bootstrap</span></div>
            <h3>Personal Blog CMS</h3>
            <p>A content management system for creating and managing blog posts, categories, and content with a full admin panel.</p>
            <ul class="project-features">
              <li><i class="fa-solid fa-check"></i> Admin panel for full content control</li>
              <li><i class="fa-solid fa-check"></i> Category & post management</li>
              <li><i class="fa-solid fa-check"></i> MySQL database integration</li>
            </ul>
            <div class="project-links">
              <a href="#" class="btn btn-sm btn-outline"><i class="fa-brands fa-github"></i> GitHub</a>
              <a href="#" class="btn btn-sm btn-primary"><i class="fa-solid fa-globe"></i> Live Demo</a>
            </div>
          </div>
        </div>

        <!-- Grocery -->
        <div class="project-card glass" data-aos="fade-up" data-aos-delay="200">
          <div class="project-img"><img src="project-img/Grocery.png" alt="Shared Grocery List Web App" /></div>
          <div class="project-body">
            <div class="project-tags"><span>PHP</span><span>MySQL</span><span>JavaScript</span></div>
            <h3>Shared Grocery List Web App</h3>
            <p>A collaborative grocery management application for adding, tracking, and completing shopping items with quantity management.</p>
            <ul class="project-features">
              <li><i class="fa-solid fa-check"></i> Add / check-off grocery items</li>
              <li><i class="fa-solid fa-check"></i> Quantity & list tracking</li>
              <li><i class="fa-solid fa-check"></i> MySQL persistence</li>
            </ul>
            <div class="project-links">
              <a href="#" class="btn btn-sm btn-outline"><i class="fa-brands fa-github"></i> GitHub</a>
              <a href="#" class="btn btn-sm btn-primary"><i class="fa-solid fa-globe"></i> Live Demo</a>
            </div>
          </div>
        </div>

        <!-- Contact Management -->
        <div class="project-card glass" data-aos="fade-up" data-aos-delay="250">
          <div class="project-img"><img src="project-img/contact.png" alt="Contact Management System" /></div>
          <div class="project-body">
            <div class="project-tags"><span>PHP</span><span>MySQL</span><span>Bootstrap</span></div>
            <h3>Contact Management System</h3>
            <p>A web-based contact management application for storing, searching, and organising personal and business contacts.</p>
            <ul class="project-features">
              <li><i class="fa-solid fa-check"></i> CRUD contact operations</li>
              <li><i class="fa-solid fa-check"></i> Search & filter functionality</li>
              <li><i class="fa-solid fa-check"></i> User authentication</li>
            </ul>
            <div class="project-links">
              <a href="#" class="btn btn-sm btn-outline"><i class="fa-brands fa-github"></i> GitHub</a>
              <a href="#" class="btn btn-sm btn-primary"><i class="fa-solid fa-globe"></i> Live Demo</a>
            </div>
          </div>
        </div>

        <!-- School Management -->
        <div class="project-card glass" data-aos="fade-up" data-aos-delay="300">
          <div class="project-img"><img src="project-img/school.png" alt="School Management System" /></div>
          <div class="project-body">
            <div class="project-tags"><span>PHP</span><span>MySQL</span><span>Bootstrap</span></div>
            <h3>School Management System</h3>
            <p>A comprehensive school administration web app to manage students, teachers, classes, and academic records.</p>
            <ul class="project-features">
              <li><i class="fa-solid fa-check"></i> Student & teacher management</li>
              <li><i class="fa-solid fa-check"></i> Class & timetable scheduling</li>
              <li><i class="fa-solid fa-check"></i> Academic records tracking</li>
            </ul>
            <div class="project-links">
              <a href="#" class="btn btn-sm btn-outline"><i class="fa-brands fa-github"></i> GitHub</a>
              <a href="#" class="btn btn-sm btn-primary"><i class="fa-solid fa-globe"></i> Live Demo</a>
            </div>
          </div>
        </div>

        <!-- Blood Donation -->
        <div class="project-card glass" data-aos="fade-up" data-aos-delay="350">
          <div class="project-img"><img src="project-img/blood.png" alt="Blood Donation Management System" /></div>
          <div class="project-body">
            <div class="project-tags"><span>PHP</span><span>MySQL</span><span>Bootstrap</span></div>
            <h3>Blood Donation Management System</h3>
            <p>A community-facing web platform to connect blood donors with recipients, manage donor records, and track blood group availability.</p>
            <ul class="project-features">
              <li><i class="fa-solid fa-check"></i> Donor registration & search</li>
              <li><i class="fa-solid fa-check"></i> Blood group inventory</li>
              <li><i class="fa-solid fa-check"></i> Request & matching system</li>
            </ul>
            <div class="project-links">
              <a href="#" class="btn btn-sm btn-outline"><i class="fa-brands fa-github"></i> GitHub</a>
              <a href="#" class="btn btn-sm btn-primary"><i class="fa-solid fa-globe"></i> Live Demo</a>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- ═══════════════ EXPERIENCE ═══════════════ -->
  <section id="experience">
    <div class="container">
      <div class="section-header" data-aos="fade-up">
        <p class="section-label">04 / My Journey</p>
        <h2>Work <span>Experience</span></h2>
      </div>

      <div class="timeline">

        <div class="timeline-item" data-aos="fade-up">
          <div class="timeline-dot"></div>
          <div class="timeline-card glass">
            <div class="tl-header">
              <div>
                <h3>Web Developer</h3>
                <p class="tl-company"><i class="fa-solid fa-building"></i> Code Crush Technologies</p>
              </div>
              <span class="tl-date">Dec 2024 – Apr 2026</span>
            </div>
            <ul class="tl-list">
              <li>Developed dynamic websites using PHP, HTML &amp; CSS, JavaScript, and Bootstrap.</li>
              <li>Converted design mockups into fully functional, responsive web applications.</li>
              <li>Implemented both front-end interfaces and back-end functionality.</li>
              <li>Enhanced website performance and cross-platform compatibility.</li>
              <li>Collaborated with team members to achieve project goals and meet deadlines.</li>
            </ul>
            <div class="tl-tags">
              <span>PHP</span><span>JavaScript</span><span>Bootstrap</span><span>MySQL</span>
            </div>
          </div>
        </div>

        <div class="timeline-item" data-aos="fade-up" data-aos-delay="100">
          <div class="timeline-dot"></div>
          <div class="timeline-card glass">
            <div class="tl-header">
              <div>
                <h3>Junior Web Developer Intern</h3>
                <p class="tl-company"><i class="fa-solid fa-building"></i> Code Crush Technologies</p>
              </div>
              <span class="tl-date">Dec 2024 – Jun 2025</span>
            </div>
            <ul class="tl-list">
              <li>Completed a 6-month internship gaining hands-on experience in full-stack web development.</li>
              <li>Worked on real client projects under senior developer mentorship.</li>
              <li>Built and maintained responsive web applications using modern web technologies.</li>
            </ul>
            <div class="tl-tags">
              <span>PHP</span><span>HTML5</span><span>CSS3</span><span>JavaScript</span>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- ═══════════════ EDUCATION ═══════════════ -->
  <section id="education">
    <div class="container">
      <div class="section-header" data-aos="fade-up">
        <p class="section-label">05 / Academic Path</p>
        <h2>Education</h2>
      </div>

      <div class="edu-grid">

        <div class="edu-card glass" data-aos="fade-up">
          <div class="edu-icon"><i class="fa-solid fa-graduation-cap"></i></div>
          <div class="edu-body">
            <h3>BS Computer Science</h3>
            <p class="edu-inst">University of Malakand</p>
            <span class="edu-year">Session 2022 – 2026</span>
            <p class="edu-desc">Four-year undergraduate degree with focus on software development, database systems, algorithms, and web technologies. Completed a Final Year Project on a Digital Time Tracker System.</p>
          </div>
        </div>

        <div class="edu-card glass" data-aos="fade-up" data-aos-delay="100">
          <div class="edu-icon"><i class="fa-solid fa-book-open"></i></div>
          <div class="edu-body">
            <h3>HSSC (Intermediate)</h3>
            <p class="edu-inst">BISE Malakand</p>
            <span class="edu-year">2022</span>
            <p class="edu-desc">Higher Secondary School Certificate from Board of Intermediate and Secondary Education, Malakand.</p>
          </div>
        </div>

        <div class="edu-card glass" data-aos="fade-up" data-aos-delay="200">
          <div class="edu-icon"><i class="fa-solid fa-school"></i></div>
          <div class="edu-body">
            <h3>SSC (Matriculation)</h3>
            <p class="edu-inst">BISE Malakand</p>
            <span class="edu-year">2020</span>
            <p class="edu-desc">Secondary School Certificate from Board of Intermediate and Secondary Education, Malakand.</p>
          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- ═══════════════ CERTIFICATIONS ═══════════════ -->
  <section id="certifications">
    <div class="container">
      <div class="section-header" data-aos="fade-up">
        <p class="section-label">06 / Credentials</p>
        <h2>Certifications</h2>
      </div>

      <div class="cert-grid">

        <div class="cert-card glass" data-aos="zoom-in">
          <div class="cert-icon"><i class="fa-solid fa-certificate"></i></div>
          <div class="cert-body">
            <h3>Junior Web Developer Internship</h3>
            <p class="cert-issuer">Code Crush Technologies</p>
            <span class="cert-date">Dec 2024 – Jun 2025</span>
            <p>6-month internship certificate for hands-on web development experience in PHP, HTML, CSS, JavaScript, and Bootstrap.</p>
          </div>
        </div>

        <div class="cert-card glass" data-aos="zoom-in" data-aos-delay="100">
          <div class="cert-icon"><i class="fa-solid fa-award"></i></div>
          <div class="cert-body">
            <h3>Diploma in Information Technology (DIT)</h3>
            <p class="cert-issuer">Govt. Polytechnic Institute Timergara</p>
            <span class="cert-date">Awarded: 5 August 2022</span>
            <p>Completed with 1120/1400 marks — Grade A+. Covered fundamentals of computer hardware, software, networking, and IT applications.</p>
          </div>
        </div>

        <div class="cert-card glass" data-aos="zoom-in" data-aos-delay="200">
          <div class="cert-icon"><i class="fa-solid fa-language"></i></div>
          <div class="cert-body">
            <h3>Duolingo English Test</h3>
            <p class="cert-issuer">Duolingo</p>
            <span class="cert-date">Score: 95</span>
            <p>Demonstrated professional English language proficiency through the internationally recognised Duolingo English Test with a score of 95.</p>
          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- ═══════════════ CONTACT ═══════════════ -->
  <section id="contact">
    <div class="container">
      <div class="section-header" data-aos="fade-up">
        <p class="section-label">07 / Let's Talk</p>
        <h2>Get In <span>Touch</span></h2>
      </div>

      <div class="contact-grid">

        <div class="contact-info" data-aos="fade-right">
          <p class="contact-lead">I'm open to new opportunities, freelance work, and collaboration. Drop me a message and I'll get back to you within 24 hours.</p>

          <div class="contact-details">
            <a href="mailto:izazuddin47@gmail.com" class="contact-item glass">
              <div class="contact-icon"><i class="fa-solid fa-envelope"></i></div>
              <div>
                <small>Email</small>
                <p>izazuddin47@gmail.com</p>
              </div>
            </a>
            <a href="tel:+923190750829" class="contact-item glass">
              <div class="contact-icon"><i class="fa-brands fa-whatsapp"></i></div>
              <div>
                <small>WhatsApp / Phone</small>
                <p>+92-3190750829</p>
              </div>
            </a>
            <div class="contact-item glass">
              <div class="contact-icon"><i class="fa-solid fa-location-dot"></i></div>
              <div>
                <small>Location</small>
                <p>Atta height dream gardan defense road Lahor, Pakistan</p>
              </div>
            </div>
          </div>

          <div class="contact-social">
            <a href="https://github.com/izazuddin47" class="social-btn" aria-label="GitHub"><i class="fa-brands fa-github"></i></a>
            <a href="https://www.linkedin.com/in/izaz-uddin-ba6868342" class="social-btn" aria-label="LinkedIn"><i class="fa-brands fa-linkedin"></i></a>
            <a href="https://wa.me/923190750829" class="social-btn" aria-label="WhatsApp"><i class="fa-brands fa-whatsapp"></i></a>
            <a href="mailto:izazuddin47@gmail.com" class="social-btn" aria-label="Email"><i class="fa-solid fa-envelope"></i></a>
          </div>
        </div>

        <form class="contact-form glass" id="contactForm" data-aos="fade-left" action="authentication/contact_submit.php" method="POST">
          <div class="form-row">
            <div class="form-group">
              <label for="name">Your Name</label>
              <input type="text" id="name" name="name" placeholder="Your Name" required />
            </div>
            <div class="form-group">
              <label for="email">Email Address</label>
              <input type="email" id="email" name="email" placeholder="john@example.com" required />
            </div>
          </div>
          <div class="form-group">
            <label for="subject">Subject</label>
            <input type="text" id="subject" name="subject" placeholder="Project discussion..." />
          </div>
          <div class="form-group">
            <label for="message">Message</label>
              <textarea id="message" name="message" rows="5" placeholder="Tell me about your project..." required></textarea>
          </div>
          <?php if (function_exists('generate_csrf_token')): ?>
          <input type="hidden" name="csrf_token" value="<?php echo generate_csrf_token(); ?>">
          <?php else: ?>
          <input type="hidden" name="csrf_token" value="">
          <?php endif; ?>
          <button type="submit" class="btn btn-primary full-width">
            Send Message <i class="fa-solid fa-paper-plane"></i>
          </button>
          <div id="formMsg" class="form-msg"></div>
        </form>

      </div>
    </div>
  </section>

  <!-- ═══════════════ FOOTER ═══════════════ -->
  <footer>
    <div class="footer-inner">
      <a href="#hero" class="nav-logo"><img src="project-img/logo.png" alt="Izaz Uddin Logo" /></a>
     <p class="footer-copy">
    © 2026 Izaz Uddin. Creating digital experiences with passion and precision in Lahore, Pakistan.
</p>
      <div class="footer-social">
        <a href="https://github.com/izazuddin47" aria-label="GitHub"><i class="fa-brands fa-github"></i></a>
        <a href="www.linkedin.com/in/izaz-uddin-ba6868342" aria-label="LinkedIn"><i class="fa-brands fa-linkedin"></i></a>
        <a href="mailto:izazuddin47@gmail.com" aria-label="Email"><i class="fa-solid fa-envelope"></i></a>
      </div>
    </div>
  </footer>

  <!-- AOS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
  <script src="script.js"></script>
</body>
</html>
