
<!DOCTYPE html>
<html lang="en">

@include('layouts.header')

<body class="index-page">

  <header id="header" class="header sticky-top">
    <div class="branding d-flex align-items-cente">

      <div class="container position-relative d-flex align-items-center justify-content-between">
        <a href="index.html" class="logo d-flex align-items-center">
          <img src="{{asset('BizLand/Pejamas No BG.png')}}" alt="">
        </a>

        <nav id="navmenu" class="navmenu">
          <ul>
            <li><a href="#hero" class="active">Home</a></li>
            <li><a href="#about">Tentang Kami</a></li>
            <li><a href="#services">Pelayanan</a></li>
            <li><a href="#team">Team</a></li>
            <li><a href="#faq">Faqs</a></li>
            <li><a href="#contact">Kontak</a></li>
            @auth
            <li class="dropdown"><a href="{{ route('dashboard.home') }}"><span>{{ Auth::user()->name }}</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
              <ul>
                <li>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                        <span>Log Out</span>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
              </ul>
            </li>
            @else
            <li><a href="{{ route('login') }}">Login</a></li>
            @endauth
          </ul>
          <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>

      </div>

    </div>

  </header>

  <main class="main">

    <!-- Hero Section -->
    <section id="hero" class="hero section">

      <div class="container">
        <div class="row gy-4">
          <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center" data-aos="zoom-out">
            <h1>Selamat Datang Di <span>PEJAMAS</span></h1>
            <p>PEJAMAS (Pengaduan Jalan Masyarakat) adalah platform digital yang dirancang untuk memudahkan masyarakat dalam mengirimkan pengaduan terkait kerusakan jalan.</p>
            <div class="d-flex">
              <a href="{{ route('login') }}" class="btn-get-started">Login Untuk Memulai</a>
             </div>
          </div>
        </div>
      </div>

    </section><!-- /Hero Section -->



    <!-- About Section -->
    <section id="about" class="about section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Tentang Kami</h2>
        <p><span>Lebih Banyak </span> <span class="description-title">Tentang Kami.</span></p>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row gy-3">

          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
            <img src="{{asset('BizLand/assets/img/about.jpg')}}" alt="" class="img-fluid">
          </div>

          <div class="col-lg-6 d-flex flex-column justify-content-center" data-aos="fade-up" data-aos-delay="200">
            <div class="about-content ps-0 ps-lg-3">
              <h3>Tentang PEJAMAS</h3>
              <p class="fst-italic">
                PEJAMAS (Pengaduan Jalan Masyarakat) adalah platform digital yang dirancang untuk memudahkan masyarakat dalam mengirimkan pengaduan terkait kerusakan jalan. Melalui PEJAMAS, warga dapat melaporkan masalah jalan yang membutuhkan perbaikan, yang kemudian akan ditindaklanjuti oleh pemerintah setempat bekerja sama dengan pihak ketiga yang telah ditunjuk. Kami berkomitmen untuk meningkatkan kualitas infrastruktur jalan demi kenyamanan dan keselamatan masyarakat.
              </p>
              <ul>
                <li>
                  <i class="bi bi-diagram-3"></i>
                  <div>
                    <h4>Pelaporan Mudah.</h4>
                    <p>Kirim laporan kerusakan jalan dengan cepat dan mudah melalui platform kami</p>
                  </div>
                </li>
                <li>
                  <i class="bi bi-fullscreen-exit"></i>
                  <div>
                    <h4>Tindak Lanjut Transparan</h4>
                    <p>Lacak status pengaduan Anda dan lihat perkembangan perbaikannya</p>
                  </div>
                </li>
              </ul>
              <p>
                Mari bergabung dengan PEJAMAS dan jadilah bagian dari solusi untuk infrastruktur jalan yang lebih baik!
              </p>
            </div>

          </div>
        </div>

      </div>

    </section><!-- /About Section -->

      <!-- Featured Services Section -->
      <section id="featured-services" class="featured-services section">

        <div class="container">

          <div class="row gy-4">

            <div class="col-xl-4 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="100">
              <div class="service-item position-relative">
                <div class="icon"><i class="bi bi-activity icon"></i></div>
                <h4><a href="" class="stretched-link">Terhubung</a></h4>
                <p>Mari hubungi kami dan bantu kami dalam membangun fasilitas yang baik!</p>
              </div>
            </div><!-- End Service Item -->

            <div class="col-xl-4 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="200">
              <div class="service-item position-relative">
                <div class="icon"><i class="bi bi-bounding-box-circles icon"></i></div>
                <h4><a href="" class="stretched-link">Terorganisir</a></h4>
                <p>Sistem kami terorganisir mulai dari warga, petugas, dan administrator.</p>
              </div>
            </div><!-- End Service Item -->

            <div class="col-xl-4 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="300">
              <div class="service-item position-relative">
                <div class="icon"><i class="bi bi-calendar4-week icon"></i></div>
                <h4><a href="" class="stretched-link">Up To Date</a></h4>
                <p>Kami selalu memperbarui laporan yang anda kirimkan, mari melapor karena semuanya gratis!</p>
              </div>
            </div><!-- End Service Item -->
          </div>

        </div>

      </section><!-- /Featured Services Section -->
    <!-- Services Section -->
    <section id="services" class="services section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Pelayanan</h2>
        <p><span>Apa Saja</span> <span class="description-title">Pelayanan kita?</span></p>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row gy-4">

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
            <div class="service-item position-relative">
              <div class="icon">
                <i class="bi bi-activity"></i>
              </div>
              <a href="service-details.html" class="stretched-link">
                <h3>Pelaporan Kerusakan Jalan</h3>
              </a>
              <p>Pengguna Dapat Melaporkan Kerusakan Jalan Dengan Foto, Deskrpsi, dan Lokasi</p>
            </div>
          </div><!-- End Service Item -->

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
            <div class="service-item position-relative">
              <div class="icon">
                <i class="bi bi-broadcast"></i>
              </div>
              <a href="service-details.html" class="stretched-link">
                <h3>Pemantuan Situs Pengaduan</h3>
              </a>
              <p>Lacak Status Pengaduan</p>
            </div>
          </div><!-- End Service Item -->

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
            <div class="service-item position-relative">
              <div class="icon">
                <i class="bi bi-easel"></i>
              </div>
              <a href="service-details.html" class="stretched-link">
                <h3>Informasi Proses Perbaikan</h3>
              </a>
              <p>Dapatkan Informasi Terkini Tentang Progres Perbaikan Jalan</p>
            </div>
          </div><!-- End Service Item -->

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="400">
            <div class="service-item position-relative">
              <div class="icon">
                <i class="bi bi-bounding-box-circles"></i>
              </div>
              <a href="service-details.html" class="stretched-link">
                <h3>Feedback & Penilaian</h3>
              </a>
              <p>Berikan Feedback & Penilaian Terhadap Penanganan Pengaduan</p>
              <a href="service-details.html" class="stretched-link"></a>
            </div>
          </div><!-- End Service Item -->

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="500">
            <div class="service-item position-relative">
              <div class="icon">
                <i class="bi bi-calendar4-week"></i>
              </div>
              <a href="service-details.html" class="stretched-link">
                <h3>Laporan & Statistik</h3>
              </a>
              <p>Akses laporan dan statistik mengenai kerusakan jalan dan perbaikannya</p>
              <a href="service-details.html" class="stretched-link"></a>
            </div>
          </div><!-- End Service Item -->

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="600">
            <div class="service-item position-relative">
              <div class="icon">
                <i class="bi bi-chat-square-text"></i>
              </div>
              <a href="service-details.html" class="stretched-link">
                <h3>Notifikasi Pengguna</h3>
              </a>
              <p>Alert System Layanan notifikasi yang mengirimkan pembaruan otomatis kepada pengguna mengenai status pengaduan mereka melalui email</p>
              <a href="service-details.html" class="stretched-link"></a>
            </div>
          </div><!-- End Service Item -->

        </div>

      </div>

    </section><!-- /Services Section -->

    <!-- Team Section -->
    <section id="team" class="team section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Kelompok</h2>
        <p><span>Anggota</span> <span class="description-title">Kelompok</span></p>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row gy-4 justify-content-center">

          <div class="col-lg-2 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
            <div class="team-member">
              <div class="member-img">
                <img src="{{asset('BizLand/waktuny.jpeg')}}" class="img-fluid" alt="">
              </div>
              <div class="member-info">
                <h4>Tegar Dinar Harsya Ibrahim</h4>
                <span>Anggota</span>
              </div>
            </div>
          </div><!-- End Team Member -->

          <div class="col-lg-2 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="200">
            <div class="team-member">
              <div class="member-img">
                <img src="{{asset('BizLand/waktuny.jpeg')}}" class="img-fluid" alt="">
              </div>
              <div class="member-info">
                <h4>Ari Ardiansyah</h4>
                <span>Anggota</span>
              </div>
            </div>
          </div><!-- End Team Member -->

          <div class="col-lg-2 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="300">
            <div class="team-member">
              <div class="member-img">
                <img src="{{asset('BizLand/waktuny.jpeg')}}" class="img-fluid" alt="">
              </div>
              <div class="member-info">
                <h4>Rohendi Adiputra</h4>
                <span>Anggota</span>
              </div>
            </div>
          </div><!-- End Team Member -->

          <div class="col-lg-2 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="400">
            <div class="team-member">
              <div class="member-img">
                <img src="{{asset('BizLand/waktuny.jpeg')}}" class="img-fluid" alt="">
              </div>
              <div class="member-info">
                <h4>Adam Albani Timmothy</h4>
                <span>Fullstack</span>
              </div>
            </div>
          </div><!-- End Team Member -->

          <div class="col-lg-2 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="400">
            <div class="team-member">
              <div class="member-img">
                <img src="{{asset('BizLand/waktuny.jpeg')}}" class="img-fluid" alt="">
              </div>
              <div class="member-info">
                <h4>Azkia Hanif</h4>
                <span>Anggota</span>
              </div>
            </div>
          </div><!-- End Team Member -->

        </div>

      </div>

    </section><!-- /Team Section -->

    <!-- Faq Section -->
    <section id="faq" class="faq section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>F.A.Q</h2>
        <p><span>Frequently Asked Questions</span> <span class="description-title">(FAQ)</span></p>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row justify-content-center">

          <div class="col-lg-10" data-aos="fade-up" data-aos-delay="100">

            <div class="faq-container">

              <div class="faq-item faq-active">
                <h3>Bagaimana cara melaporkan kerusakan jalan?</h3>
                <div class="faq-content">
                  <p>Untuk melaporkan kerusakan jalan, Anda perlu membuat akun terlebih dahulu. Setelah mendaftar, Anda harus mengunggah foto KTP Anda untuk proses verifikasi. Setelah akun Anda diverifikasi (paling lama 1x24 jam), Anda dapat mengirimkan pengaduan melalui halaman pengguna. Pastikan untuk melengkapi detail pengaduan dengan foto dan deskripsi kerusakan.</p>
                </div>
                <i class="faq-toggle bi bi-chevron-right"></i>
              </div><!-- End Faq item-->

              <div class="faq-item">
                <h3>Berapa lama waktu yang dibutuhkan untuk menindaklanjuti pengaduan?</h3>
                <div class="faq-content">
                  <p>Kami berusaha untuk menindaklanjuti setiap pengaduan secepat mungkin. Waktu penanganan dapat bervariasi tergantung pada tingkat kerusakan dan jumlah pengaduan yang masuk. Pengguna dapat memantau progres pengaduan mereka melalui halaman pengguna, yang akan diupdate secara berkala oleh petugas</p>
                </div>
                <i class="faq-toggle bi bi-chevron-right"></i>
              </div><!-- End Faq item-->

              <div class="faq-item">
                <h3>Bagaimana saya bisa melacak status pengaduan saya?</h3>
                <div class="faq-content">
                  <p>Anda dapat melacak status pengaduan Anda melalui fitur pemantauan status di akun PEJAMAS Anda. Status pengaduan akan diupdate oleh petugas dan Anda akan menerima notifikasi mengenai setiap perubahan status.</p>
                </div>
                <i class="faq-toggle bi bi-chevron-right"></i>
              </div><!-- End Faq item-->

              <div class="faq-item">
                <h3>Apa yang harus dilakukan jika perbaikan jalan belum dilakukan setelah pengaduan?</h3>
                <div class="faq-content">
                  <p>Jika perbaikan belum dilakukan dalam waktu yang lama, Anda dapat menghubungi tim dukungan kami untuk mendapatkan informasi lebih lanjut. Anda juga bisa memberikan tanggapan atau kritik melalui fitur feedback di halaman pengguna</p>
                </div>
                <i class="faq-toggle bi bi-chevron-right"></i>
              </div><!-- End Faq item-->

              <div class="faq-item">
                <h3>Apakah ada biaya untuk melaporkan kerusakan jalan?</h3>
                <div class="faq-content">
                  <p>Tidak ada biaya yang dikenakan untuk melaporkan kerusakan jalan melalui platform PEJAMAS. Layanan ini gratis untuk seluruh masyarakat</p>
                </div>
                <i class="faq-toggle bi bi-chevron-right"></i>
              </div><!-- End Faq item-->

              <div class="faq-item">
                <h3>Bagaimana cara memberikan feedback mengenai layanan PEJAMAS?</h3>
                <div class="faq-content">
                  <p>Anda dapat memberikan feedback melalui fitur feedback di halaman pengguna. Di sini, Anda bisa memberikan tingkat kepuasan, kritik, dan saran mengenai proses penanganan pengaduan. Hal ini membantu kami untuk terus meningkatkan kualitas layanan</p>
                </div>
                <i class="faq-toggle bi bi-chevron-right"></i>
              </div><!-- End Faq item-->

              <div class="faq-item">
                <h3>Mengapa saya harus mengunggah foto KTP?</h3>
                <div class="faq-content">
                  <p>Foto KTP diperlukan untuk memverifikasi identitas pengguna demi memastikan keamanan dan keabsahan pengaduan yang masuk. Proses verifikasi ini biasanya memakan waktu paling lama 1x24 jam</p>
                </div>
                <i class="faq-toggle bi bi-chevron-right"></i>
              </div><!-- End Faq item-->

            </div>

          </div><!-- End Faq Column-->

        </div>

      </div>

    </section><!-- /Faq Section -->

    <!-- Contact Section -->
    <section id="contact" class="contact section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Kontak Kami</h2>
        <p><span>Butuh Bantuan? </span> <span class="description-title">Hubungi Kami</span></p>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4">

          <div class="col-lg-5">

            <div class="info-wrap">
              <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="200">
                <i class="bi bi-geo-alt flex-shrink-0"></i>
                <div>
                  <h3>Alamat</h3>
                  <p>Jl. Soekarno Hatta Jl. Leuwi Panjang No.211, Situsaeur, Kec. Bojongloa Kidul, Kota Bandung, Jawa Barat 40233
                  </p>
                </div>
              </div><!-- End Info Item -->

              <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="300">
                <i class="bi bi-telephone flex-shrink-0"></i>
                <div>
                  <h3>No Kami</h3>
                  <p>08123467886</p>
                </div>
              </div><!-- End Info Item -->

              <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="400">
                <i class="bi bi-envelope flex-shrink-0"></i>
                <div>
                  <h3>Email Kami</h3>
                  <p>PejamasHelp@gmail.com</p>
                </div>
              </div><!-- End Info Item -->

              <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d990.1322815307512!2d107.59317772843744!3d-6.9467363995640214!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e8bee3bd350f%3A0x198c9de6ba46e374!2sSTMIK%20Mardira%20Indonesia!5e0!3m2!1sen!2sid!4v1718858389500!5m2!1sen!2sid" width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe></div>
          </div>

          <div class="col-lg-7">
                @if ($message = Session::get('success') || session('success'))
                    <span class="text-primary">{{ $message }}</span>
                @endif
            <form action="{{ route('contact.user') }}" method="post" class="php-email-form" data-aos="fade-up" data-aos-delay="200">
                @csrf
                <div class="row gy-4">

                <div class="col-md-6">
                  <label for="name-field" class="pb-2">Nama</label>
                  <input type="text" name="name"  value="{{ Auth::user()->name ?? old('name') }}" id="name-field" class="form-control  @error('name') is-invalid @enderror" required="">
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="col-md-6">
                  <label for="email-field" class="pb-2">Email</label>
                  <input type="email" class="form-control @error('email') is-invalid @enderror" value="{{ Auth::user()->email ?? old('email') }}" name="email" id="email-field" required="">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="col-md-12">
                  <label for="subject-field" class="pb-2">Perihal</label>
                  <input type="text" class="form-control @error('subject') is-invalid @enderror" name="subject" value="{{ old('subject') }}" id="subject-field" required="">
                    @error('subject')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="col-md-12">
                  <label for="message-field" class="pb-2">Pesan</label>
                  <textarea class="form-control @error('message') is-invalid @enderror" name="message" rows="10" id="message-field" required="">{{ old('message') }}</textarea>
                    @error('message')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="col-md-12 text-center">
                  <div class="loading">Loading</div>
                  <div class="error-message"></div>
                  <div class="sent-message">Pesanmu sudah dikirim, Terimakasih</div>

                  <button type="submit">Kirim Pesan</button>
                </div>

              </div>
            </form>
          </div><!-- End Contact Form -->

        </div>

      </div>

    </section><!-- /Contact Section -->

  </main>

  <footer id="footer" class="footer">


    <div class="container footer-top">
      <div class="row gy-4">

        <div class="col-lg-4 col-md-6 footer-about">
          <a href="index.html" class="d-flex align-items-center">
            <span class="sitename">PEJAMAS</span>
          </a>
          <div class="footer-contact pt-3">
            <p>Jl. Soekarno Hatta Jl. Leuwi Panjang No.211,</p>
            <p>Situsaeur, Kec. Bojongloa Kidul, Kota Bandung, Jawa Barat 40233</p>
            <p class="mt-3"><strong>No:</strong> <span>08123467886</span></p>
            <p><strong>Email:</strong> <span>PejamasHelp@gmail.com</span></p>
          </div>
        </div>

        <div class="col-lg-2 col-md-4 footer-links">
          <h4>Useful Links</h4>
          <ul class="row justify-stretch">
            <li><i class="bi bi-chevron-right"></i><a class="text-muted" href="#hero">Home</a></li>
            <li><i class="bi bi-chevron-right"></i><a class="text-muted" href="#about">Tentang Kami</a></li>
            <li><i class="bi bi-chevron-right"></i><a class="text-muted" href="#service">Pelayanan</a></li>
            <li><i class="bi bi-chevron-right"></i><a class="text-muted" href="#team">Team</a></li>
            <li><i class="bi bi-chevron-right"></i><a class="text-muted" href="#faq">Faqs</a></li>
            <li><i class="bi bi-chevron-right"></i><a class="text-muted" href="#contact">Kontak</a></li>
          </ul>
        </div>

        <div class="col-lg-2 col-md-3 footer-links">
          <h4>Pelayanan</h4>
          <ul>
            <li><i class="bi bi-chevron-right"></i> <a href="#services">Pelaporan kerusakan jalan</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="#services">Pemantauan situs pengaudan</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="#services">Informasi proses perbaikan</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="#services">Feedback & Penilaian</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="#services">Laporan & Statistik</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="#services">Notifikasi Pengguna</a></li>
          </ul>
        </div>

        <div class="col-lg-4 col-md-12">
          <h4>Sosial Media </h4>
          <p>Jangan lupa ikuti kami disosial media untuk mendapatkan informasi yang menarik</p>
          <div class="social-links d-flex">
            <a href="javascript:void(0);"><i class="bi bi-twitter-x"></i></a>
            <a href="javascript:void(0);"><i class="bi bi-facebook"></i></a>
            <a href="javascript:void(0);"><i class="bi bi-instagram"></i></a>
            <a href="javascript:void(0);"><i class="bi bi-linkedin"></i></a>
          </div>
        </div>

      </div>
    </div>

    <div class="container copyright text-center">
      <p>© <span>Copyright</span> <strong class="sitename">PEJAMAS</strong> <span>All Rights Reserved</span></p>
      <div class="credits">
        Made By Love <a href="https://github.com/Noptzy/PEJAMAS">PEJAMAS</a>
      </div>
    </div>

  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>


@include('layouts.script')

</body>

</html>
