<section id="about" class="about">
    <div class="">
        <!-- Video Section -->
        <div class="row justify-content-center mb-5">
            <div class="col-12 col-lg-10">
                <div class="video-container">
                    <iframe 
                        src="https://www.youtube.com/embed/-DnYQsiDODU" 
                        title="Yayasan Tat Twam Asi" 
                        frameborder="0" 
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                        allowfullscreen>
                    </iframe>
                </div>
            </div>
        </div>

    
        <!-- Pendiri Yayasan Section -->
        <section class="team-section" id="team-section">
            <!-- Team Member 1 -->
            <div class="team-member">
                <div class="content-side">
                    <h2 class="member-title">Ny. Ida Bagus Mantra</h2>
                    <div class="member-role">Pendiri & Visioner</div>
                    <p class="member-description">
                        Sebagai salah satu pendiri Yayasan Tat Twam Asi, Ny. Ida Bagus Mantra membawa visi mulia untuk menciptakan 
                        wadah pendidikan berbasis nilai-nilai luhur Agama Hindu. Dengan dedikasi yang tinggi, beliau memimpin 
                        pengembangan karakter generasi muda Bali yang berintegritas dan berpengetahuan luas.
                    </p>
                    <div class="member-meta">
                        <span class="member-photo-credit">
                            Photo : <span class="member-name-highlight">Ny. Ida Bagus Mantra</span>, Pendiri Yayasan Tat Twam Asi
                        </span>
                    </div>
                </div>
                <div class="image-side">
                        <img src="{{ asset('images/pendiri 1.jpg') }}" 
                             alt="Ny. Ida Bagus Mantra" class="parallax-image">
                </div>
            </div>

            <!-- Team Member 2 -->
            <div class="team-member">
                <div class="content-side">
                    <h2 class="member-title">Ny. I Gusti Ngurah Ketu</h2>
                    <div class="member-role">Pendiri & Pemimpin</div>
                    <p class="member-description">
                        Dengan kepemimpinan yang kuat dan penuh dedikasi, Ny. I Gusti Ngurah Ketu memastikan setiap program 
                        yayasan berjalan sesuai dengan visi misi. Keahliannya dalam manajemen organisasi menjadi fondasi 
                        kokoh bagi pengembangan yayasan dan peningkatan kualitas pendidikan di Bali.
                    </p>
                    <div class="member-meta">
                        <span class="member-photo-credit">
                            Photo : <span class="member-name-highlight">Ny. I Gusti Ngurah Ketu</span>, Pendiri Yayasan Tat Twam Asi
                        </span>
                    </div>
                </div>
                <div class="image-side">
                        <img src="{{ asset('images/ketu.jpg') }}" 
                             alt="Ny. I Gusti Ngurah Ketu" class="parallax-image">
                </div>
            </div>

            <!-- Team Member 3 -->
            <div class="team-member">
                <div class="content-side">
                    <h2 class="member-title">Ny. I.A.SW. Diwangkara</h2>
                    <div class="member-role">Pendiri & Penggerak</div>
                    <p class="member-description">
                        Sebagai motor penggerak yayasan, Ny. I.A.SW. Diwangkara membawa semangat inovasi dalam setiap program pendidikan. 
                        Kecintaannya terhadap pelestarian budaya Bali dan pengembangan generasi muda menjadi inspirasi 
                        bagi seluruh keluarga besar Yayasan Tat Twam Asi.
                    </p>
                    <div class="member-meta">
                        <span class="member-photo-credit">
                            Photo : <span class="member-name-highlight">Ny. I.A.SW. Diwangkara</span>, Pendiri Yayasan Tat Twam Asi
                        </span>
                    </div>
                </div>
                <div class="image-side">
                        <img src="{{ asset('images/pendiri 3.jpg') }}" 
                             alt="Ny. I.A.SW. Diwangkara" class="parallax-image">
                </div>
                
                <script>
                document.addEventListener('DOMContentLoaded', function() {
                    // Register ScrollTrigger plugin
                    gsap.registerPlugin(ScrollTrigger);
                    
                    // Animate team members on scroll
                    gsap.utils.toArray('.team-member').forEach((member, i) => {
                        gsap.from(member, {
                            scrollTrigger: {
                                trigger: member,
                                start: 'top 80%',
                                toggleActions: 'play none none none'
                            },
                            opacity: 0,
                            y: 50,
                            duration: 0.8,
                            delay: i * 0.3,
                            ease: 'power2.out'
                        });
                        
                    });
                });
                </script>
            </div>
        </section>

        <!-- Sejarah Section -->
        <div id="sejarah" class="row align-items-center g-5 my-5">
            <div class="col-lg-6 gsap-history-image m-0 p-2">
                <div class="image-container">
                    <img src="{{ asset('images/sejarah.jpg') }}" class="img-fluid rounded" alt="Sejarah Yayasan">
                </div>
            </div>
            <div class="col-lg-6 gsap-history-content">
                    <h3 class="section-title gsap-history-title m-0 d-inline-block position-relative content-title-about" style="font-family: 'Montserrat', sans-serif; text-align: right; width: 100%;">
                        <span class="position-relative d-inline-block" style="text-align: right;">
                            Sejarah Singkat
                            <span class="title-underline" style="position: absolute; bottom: -8px; right: 0; width: 0; height: 3px; background-color: #388E3C; border-radius: 2px; display: block;"></span>
                        </span>
                    </h3>
                    <p class="content-text gsap-history-text" style=" font-size: 0.8rem; font-family: 'Montserrat', sans-serif; text-align: right;">
                        Yayasan Tat Twam Asi didirikan dengan Akta Notaris Nomor 60 Tahun 1987 tanggal 20 Juli. Usaha
                        sosial yang dilaksanakan Yayasan adalah menampung dan menyantuni anak-anak usia sekolah atau
                        anak putus sekolah, khususnya anak perempuan dari kalangan keluarga miskin maupun yatim piatu
                        dalam sebuah Panti Asuhan dengan nama yang sama dengan nama Yayasan dan memberikan kesempatan
                        kepada mereka untuk mengikuti pendidikan formal (SD s/d SMA) dan pendidikan non formal.
                    </p>
                    <div class="d-flex align-items-center highlight-box">
                        <div class="highlight-icon">
                            <i class="bi bi-building fs-2"></i>
                        </div>
                        <div class="highlight-text text-right">
                            <h5><span >37</span>+ Tahun Pengalaman</h5>
                            <p>Melayani dengan dedikasi sejak 1987</p>
                        </div>
                    </div>
            </div>
        </div>

        <!-- Visi Misi Section -->
        <div id="visimisi" class="row align-items-center g-5 flex justify-center mx-auto">
            <div class="row align-items-center g-5 mb-5 flex-lg-row-reverse mx-auto p-0">
            <div class="text-center mb-5">
                <h3 class="section-title gsap-history-title m-0 d-inline-block position-relative pb-0 content-title-about" style=" font-family: 'Montserrat', sans-serif; margin-bottom: 1.5rem;">
                    <span class="position-relative ">
                        Visi dan Misi
                        <span class="title-underline" style="position: absolute; bottom: -8px; left: 0; width: 0; height: 3px; background-color: #388E3C; border-radius: 2px; display: block;"></span>
                    </span>
                </h3>
            </div>
                <div class="col-lg-6 gsap-vision-image" style="border: 3px solid var(--default-color);">
                    <div class="image-container pr-0 md:pr-3">
                        <img src="{{ asset('images/visimisi.png') }}" class="img-fluid rounded" alt="Visi Misi">
                    </div>
                </div>
                <div class="col-lg-6 gsap-vision-content" style="font-family: 'Montserrat', sans-serif;">
                    <div class="">
                     

                        <!-- Visi Card -->
                        <div class="card vm-card bg-white border-0 shadow-none gsap-vm-card">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="vm-icon-container">
                                        <i class="bi bi-eye-fill fs-4"></i>
                                    </div>
                                    <h4 class="vm-title">Visi</h4>
                                </div>
                                <p class="content-text mb-0" style="font-size: 1rem;">
                                Menjadi wadah pelindung dan pendidikan sosial yang mendidik generasi muda dengan nilai luhur Agama Hindu, membangun manusia berkarakter, berpengetahuan, dan berintegritas untuk mewujudkan masyarakat Bali yang peduli dan maju.
                                </p>
                            </div>
                        </div>

                        <!-- Misi Card -->
                        <div class="card vm-card border-0 bg-white shadow-none gsap-vm-card">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="vm-icon-container">
                                        <i class="bi bi-bullseye fs-4"></i>
                                    </div>
                                    <h4 class="vm-title">Misi</h4>
                                </div>
                                <ul class="mission-list" style="text-align: justify;">
                                    <li class="mission-item gsap-mission-item">
                                        <i class="bi bi-check-circle-fill mission-icon"></i>
                                        <span class="mission-text" style="font-size: 1rem;">Menyediakan asuhan dan pendidikan formal/non‑formal bagi anak-anak kurang mampu atau yatim piatu, khususnya perempuan, hingga jenjang SMA.</span>
                                    </li>
                                    <li class="mission-item gsap-mission-item">
                                        <i class="bi bi-check-circle-fill mission-icon"></i>
                                        <span class="mission-text" style="font-size: 1rem;">Mengintegrasikan pendidikan moral dan keagamaan Hindu (Sraddha & Bhakti) melalui kegiatan seperti Dharmagita, dialog spiritual, dan pelatihan karakter.</span>
                                    </li>
                                    <li class="mission-item gsap-mission-item">
                                        <i class="bi bi-check-circle-fill mission-icon"></i>
                                        <span class="mission-text" style="font-size: 1rem;">Menjalin kerja sama dengan donor, relawan, dan komunitas lokal/internasional untuk meningkatkan kualitas kehidupan anak asuh.</span>
                                    </li>
                                    <li class="mission-item gsap-mission-item">
                                        <i class="bi bi-check-circle-fill mission-icon"></i>
                                        <span class="mission-text" style="font-size: 1rem;">Mengupayakan menyalurkan anak-anak yang telah menamatkan pendidikan di SMA/SMK ke berbagai lowongan pekerjaan.</span>
                                    </li>
                                    <li class="mission-item gsap-mission-item">
                                        <i class="bi bi-check-circle-fill mission-icon"></i>
                                        <span class="mission-text" style="font-size: 1rem;">Menumbuhkan semangat cinta kasih (Tat Twam Asi) berdasarkan ajaran agama dan budaya Hindu Bali sebagai dasar bersama untuk peduli sesama.</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Custom CSS for Video and Image Animation -->
<style>
    /* Team Section Styles */
    .team-section {
        position: relative;
        overflow: hidden;
        width: 90vw;
        display: flex;
        flex-direction: column;
        gap: 3rem;
        margin: 0 auto;
    }
    #sejarah {
        width: 95vw;
        margin: 0 auto;
    }

    .parallax-image {
        width: 100%;
    }
    
    /* Visi Misi Section Styling */
    #visimisi {
        min-height: 100vh;
        position: relative;
        padding: 2rem 0;
    }
    
    #visimisi > .row {
        min-height: 100vh;
        align-items: flex-start;
    }

    .content-title-about {
        font-size: 3.5rem;
        font-family: 'Montserrat', sans-serif;
    }
    
    .gsap-vision-image {
        position: sticky;
        top: 80px; /* Slightly reduced for better mobile view */
        height: fit-content;
        padding: 1rem;
        align-self: flex-start;
    }
    
    .gsap-vision-image .image-container {
        position: relative;
        width: 100%;
        height: 100%;
    }
    
    .gsap-vision-image img {
        width: 100%;
        height: auto;
        max-height: 70vh;
        object-fit: contain;
    }
    .team-member:nth-child(even) .content-side .member-title {
        text-align: right;
    }

    .team-member:nth-child(even) .content-side .member-role {
        text-align: right;
    }

    .team-member:nth-child(even) .content-side .member-description {
        text-align: right;
        width: 100%;
        max-width: none;
        padding-left: 0px;
    }
    
    /* Responsive Adjustments */
    @media (max-width: 1399.98px) {
        .gsap-vision-image {
            top: 70px;
        }
        
        .gsap-vision-image img {
            max-height: 65vh;
        }
    }
    
    @media (max-width: 1199.98px) {
        #visimisi > .row {
            min-height: auto;
        }
        
        .gsap-vision-image {
            position: relative;
            top: auto;
        }
        
        .gsap-vision-image img {
            max-height: 60vh;
            margin: 0 auto;
            display: block;
        }
        
        .gsap-vision-content {
            padding: 0 1rem;
        }
    }
    
    @media (max-width: 767.98px) {
        #visimisi {
            padding: 1.5rem 0;
        }

        .content-title-about {
        font-size: 2.5rem;
        font-family: 'Montserrat', sans-serif;
    }
        
        .gsap-vision-image img {
            max-height: 50vh;
        }
        
        .gsap-vision-content {
            padding: 0 0.5rem;
        }
    }
    
    @media (max-width: 575.98px) {
        .gsap-vision-image img {
            max-height: 45vh;
        }
        
        .gsap-vision-content {
            padding: 0;
        }
    }

    .team-member {
        display: flex;
        min-height: 100vh;
        align-items: center;
        margin-bottom: 0;
    }

    .team-member:nth-child(even) {
        flex-direction: row-reverse;
    }

    .content-side {
        flex: 1;
        display: flex;
        flex-direction: column;
        justify-content: center;
        background: white;
        z-index: 2;
        position: relative;
    }

    .image-side {
        flex: 1;
        position: relative;
        overflow: hidden;
        width: 100%;
        height: fit-content;
    }

    .member-title {
        font-family: 'Montserrat', sans-serif;
        font-size: 3.5rem;
        font-weight: 900;
        color: #1f2937;
        margin-bottom: 20px;
        line-height: 1.1;
        opacity: 1;
    }

    .member-role {
        font-family: 'Montserrat', sans-serif;
        font-size: 1.2rem;
        color: #22c55e;
        font-weight: 600;
        margin-bottom: 30px;
        text-transform: uppercase;
        letter-spacing: 1px;
        opacity: 1;
    }

    .member-description {
        font-family: 'Montserrat', sans-serif;
        font-size: 1.1rem;
        line-height: 1.8;
        color:rgb(0, 0, 0);
        margin-bottom: 40px;
        max-width: 500px;
        opacity: 1;
    }

    .member-meta {
        display: flex;
        align-items: center;
        gap: 20px;
        opacity: 1;
    }

    .member-photo-credit {
        font-family: 'Montserrat', sans-serif;
        font-size: 0.9rem;
        color: #9ca3af;
        font-style: italic;
    }

    .member-name-highlight {
        font-weight: 700;
        color: #22c55e;
    }



    .team-member:nth-child(even) .content-side .member-meta {
        text-align: right;
        justify-content: right;
    }

    /* Team member specific colors */
    .team-member:nth-child(1) .member-role,
    .team-member:nth-child(1) .member-name-highlight {
        color: #3b82f6;
    }

    .team-member:nth-child(2) .member-role,
    .team-member:nth-child(2) .member-name-highlight {
        color: #ef4444;
    }

    .team-member:nth-child(3) .member-role,
    .team-member:nth-child(3) .member-name-highlight {
        color: #8b5cf6;
    }

    /* Responsive Styles */
    @media (max-width: 1200px) {
        .member-title {
            font-size: 2.8rem;
        }
    }


    @media (max-width: 992px) {

        .team-member:nth-child(even) .content-side .member-title {
        text-align: center;
    }

    .team-member:nth-child(even) .content-side .member-role {
        text-align: center;
    }

    .team-member:nth-child(even) .content-side .member-description {
        text-align: center;
        width: 100%;
        max-width: none;
        padding-left: 0px;
    }
        .team-member {
            flex-direction: column !important;
            min-height: auto;
        }

         .image-side {
            flex: none;
            width: 100%;
            padding: 10px 20px;
        }
        .content-side {
            padding: 10px 10px;
            flex: none;
            width: 100%;
        }

        .image-side {
            height: fit-content;
            order: -1;
        }


        .member-title {
            font-size: 2.5rem;
            text-align: center;
        }

        .member-role, .member-description, .member-meta {
            text-align: center;
            margin-left: auto;
            margin-right: auto;
        }
    }

    @media (max-width: 768px) {
    .team-member:nth-child(even) .content-side .member-title {
        text-align: center !important;
    }

    .team-member:nth-child(even) .content-side .member-role {
        text-align: center !important;
    }

    .team-member:nth-child(even) .content-side .member-description {
        text-align: center !important;
        width: 100%;
        padding-left: 0px;
    }

    .team-member:nth-child(even) .content-side .member-meta {
        text-align: center;
        justify-content: center;
    }
        .member-title {
            font-size: 2.2rem;
        }

        .member-role {
            font-size: 1rem;
        }

        .member-description {
            font-size: 1rem;
        }
    }

    /* Video Container Styles */
    .video-container {
        position: relative;
        width: 100%;
        padding-bottom: 56.25%; /* 16:9 Aspect Ratio */
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }
    
    .video-container iframe {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        border: none;
    }
    
    @media (max-width: 768px) {
        .member-title {
            font-size: 2rem;
            margin: 0;
        }
        .member-role {
            font-size: 0.8rem;
            margin:0.7rem;
        }
        .member-description {
            font-size: 0.8rem;
        }
        .video-container {
            border-radius: 10px;
            margin: 1rem 0;
        }
        .member-meta * {
            margin: 0;
            font-size: 0.5rem;
        }
    }
    .founder-image {
        width: 70%;
        /* Reduced the image size further */
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        /* Smooth transition for scaling and shadow */
    }

    .founder-image:hover {
        transform: scale(1.1);
        /* Slightly enlarge the image on hover */
        box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.2);
        /* Add a shadow effect on hover */
    }

    .founder-section {
        position: relative;
        overflow: hidden;
    }

    .founder-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        pointer-events: none;
    }

    .section-title {
        font-family: 'Playfair Display', serif;
        font-weight: 700;
        color: #2c3e50;
        font-size: 2.5rem;
        position: relative;
        margin-bottom: 3rem;
    }

    .founder-card {
        background: white;
        border-radius: 20px;
        padding: 2rem;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        transition: all 0.4s ease;
        position: relative;
        overflow: hidden;
        border: 1px solid rgba(212, 175, 55, 0.2);
    }

    .founder-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #388E3C, #ffffff, #388E3C);
    }

    .founder-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
    }

    .founder-image {
        width: 150px;
        height: 150px;
        object-fit: cover;
        border-radius: 50%;
        border: 5px solid white;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        transition: all 0.3s ease;
        margin-bottom: 1.5rem;
        position: relative;
    }

    .founder-image::before {
        content: '';
        position: absolute;
        top: -10px;
        left: -10px;
        right: -10px;
        bottom: -10px;
        border-radius: 50%;
        background: linear-gradient(45deg, #388E3C, #d4af37);
        z-index: -1;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .founder-card:hover .founder-image::before {
        opacity: 1;
    }

    .founder-name {
        font-family: 'Merriweather', serif;
        font-weight: 700;
        color: #2c3e50;
        font-size: 1.1rem;
        margin-bottom: 0.5rem;
        transition: color 0.3s ease;
    }

    .founder-card:hover .founder-name {
        color: #388E3C;
    }

    .founder-title {
        color: #6c757d;
        font-size: 0.9rem;
        font-style: italic;
        margin-bottom: 1rem;
    }

    .founder-icon {
        position: absolute;
        top: 20px;
        right: 20px;
        color: #d4af37;
        font-size: 1.2rem;
        opacity: 0.7;
    }

    .decorative-element {
        position: absolute;
        bottom: 20px;
        left: 50%;
        transform: translateX(-50%);
        width: 40px;
        height: 2px;
        background: linear-gradient(90deg, transparent, #d4af37, transparent);
    }

    @media (max-width: 768px) {
        .section-title {
            font-size: 2rem;
        }


        .founder-card {
            margin-bottom: 2rem;
        }

        .founder-image {
            width: 120px;
            height: 120px;
        }
    }

    .founder-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 2rem;
        max-width: 1000px;
        margin: 0 auto;
    }

    :root {
        --primary-color: #4CAF50;
        /* Green */
        --primary-light: rgba(76, 175, 80, 0.1);
        /* Light Green */
        --primary-medium: rgba(76, 175, 80, 0.2);
        /* Medium Green */
        --text-dark: #2c3e50;
        /* Dark text */
        --text-muted: #6c757d;
        /* Muted text */
        --bg-white: #ffffff;
        /* White background */
        --shadow-light: 0 8px 25px rgba(0, 0, 0, 0.08);
        /* Light shadow */
        --shadow-medium: 0 15px 35px rgba(0, 0, 0, 0.12);
        /* Medium shadow */
        --shadow-hover: 0 20px 40px rgba(0, 0, 0, 0.15);
        /* Hover shadow */
    }

    .main-container {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 50%, #f1f3f4 100%);
        padding: 80px 0;
        position: relative;
        overflow: hidden;
    }

    .main-container::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><circle cx="20" cy="20" r="1.5" fill="%23007bff" opacity="0.1"/><circle cx="80" cy="80" r="1.5" fill="%23007bff" opacity="0.1"/><circle cx="40" cy="60" r="1" fill="%23007bff" opacity="0.08"/><circle cx="60" cy="40" r="1" fill="%23007bff" opacity="0.08"/></svg>') repeat;
        pointer-events: none;
    }

    /* Enhanced Content Cards */
    .content-card {
        background: var(--bg-white);
        border-radius: 25px;
        padding: 50px 40px;
        margin: 3rem 0;
        transition: all 0.4s ease;
        position: relative;
        overflow: hidden;
    }

    .content-card:hover {
        transform: translateY(-5px);
    }

    /* Enhanced Titles */
    .content-title {
        font-size: 2.2rem;
        color: var(--text-dark);
        margin-bottom: 2rem;
        font-weight: 700;
        position: relative;
    }

    .content-title::after {
        content: '';
        position: absolute;
        bottom: -12px;
        left: 0;
        width: 60px;
        height: 4px;
        border-radius: 2px;
    }

    /* Enhanced Text Styling */
    .content-text {
        text-align: justify;
        line-height: 1.8;
        color: var(--text-dark);
        font-size: 1.1rem;
        margin-bottom: 2rem;
    }

    /* Enhanced Highlight Box */
    .highlight-box {
        background: linear-gradient(135deg, var(--primary-color), #388E3C);
        color: white;
        padding: 25px;
        border-radius: 18px;
        margin-top: 2rem;
        position: relative;
        overflow: hidden;
    }

    .highlight-box::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        width: 100%;
        height: 100%;
        background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
        animation: shimmer 3s ease-in-out infinite;
    }

    @keyframes shimmer {
        0%, 100% {
            opacity: 0;
        }
        50% {
            opacity: 1;
        }
    }

    .highlight-icon {
        background: rgba(255, 255, 255, 0.2);
        padding: 18px;
        border-radius: 15px;
        margin-right: 20px;
        position: relative;
        z-index: 2;
    }

    .highlight-text {
        position: relative;
        z-index: 2;
    }

    .highlight-text h5 {
        margin-bottom: 8px;
        font-weight: 700;
        font-size: 1.3rem;
    }

    .highlight-text p {
        margin: 0;
        opacity: 0.95;
        font-size: 1rem;
    }

    /* Enhanced Image Container */
    .image-container {
        position: relative;
        overflow: hidden;
        border-radius: 20px;
        box-shadow: var(--shadow-medium);
        transition: all 0.4s ease;
    }

    .image-container::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(45deg, transparent 0%, rgba(0, 123, 255, 0.1) 50%, transparent 100%);
        opacity: 0;
        transition: opacity 0.3s ease;
        z-index: 1;
    }

    .image-container:hover::before {
        opacity: 1;
    }
    .image-container img {
        width: 100%;
        height: auto;
        transition: transform 0.4s ease;
    }
    /* Enhanced Vision Mission Cards */
    .vm-card {
        border: 0;
        background: var(--bg-white);
        box-shadow: var(--shadow-light);
        border-radius: 20px;
        transition: all 0.4s ease;
        overflow: hidden;
        position: relative;
        margin-bottom: 25px;
    }
    .vm-card:hover {
        transform: translateY(-5px) translateX(2px);
    }

    .vm-card .card-body {
        padding: 35px 15px;
        background-color: #f8f9fa;
    }

    /* Enhanced Icon Container */
    .vm-icon-container {
        background: linear-gradient(135deg, var(--primary-color), #388E3C);
        color: white;
        padding: 15px;
        border-radius: 15px;
        margin-right: 18px;
        position: relative;
        box-shadow: 0 8px 20px rgba(0, 123, 255, 0.3);
    }
    .vm-title {
        font-weight: 700;
        margin-bottom: 0;
        color: var(--text-dark);
        font-size: 1.4rem;
    }

    /* Enhanced Mission List */
    .mission-list {
        list-style: none;
        padding: 0;
        margin-top: 1.5rem;
    }

    .mission-item {
        display: flex;
        align-items: flex-start;
        margin-bottom: 18px;
        padding: 15px;
        border-radius: 12px;
        transition: all 0.3s ease;
        position: relative;
        background: rgba(0, 123, 255, 0.02);
        border-left: 3px solid transparent;
    }

    .mission-item:hover {
        background: var(--primary-light);
        border-left-color: var(--primary-color);
        transform: translateX(8px);
    }

    .mission-icon {
        color: var(--primary-color);
        margin-right: 15px;
        margin-top: 3px;
        font-size: 1.2rem;
        transition: all 0.3s ease;
    }

    .mission-item:hover .mission-icon {
        transform: scale(1.2);
        color: #388E3C;
    }

    .mission-text {
        flex: 1;
        line-height: 1.7;
        color: var(--text-dark);
        font-size: 1.05rem;
    }

    /* Decorative Elements */
    .decorative-element {
        position: absolute;
        width: 100px;
        height: 100px;
        border-radius: 50%;
        background: linear-gradient(135deg, rgba(0, 123, 255, 0.1), rgba(102, 16, 242, 0.1));
        top: -50px;
        right: -50px;
        pointer-events: none;
    }

    .section-divider {
        height: 80px;
        background: linear-gradient(90deg, transparent, var(--primary-color), transparent);
        width: 2px;
        margin: 40px auto;
        border-radius: 1px;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .content-card {
            padding: 35px 25px;
            margin: 30px 0;
        }

        .content-title {
            font-size: 1.8rem;
        }

        .highlight-box {
            padding: 20px;
            flex-direction: column;
            text-align: center;
        }

        .highlight-icon {
            margin-right: 0;
            margin-bottom: 15px;
        }

        .mission-item {
            padding: 12px;
        }
    }

    @media (max-width: 576px) {

        .content-title {
            font-size: 2rem !important;
            text-align: center;
            margin:1rem 0;
        }
        .content-title-about {
        font-size: 2rem !important;
        font-family: 'Montserrat', sans-serif;
    }

        .content-text {
            font-size: 1rem !important;
        }
        .gsap-vision-image{
            margin-top:0.6rem
        }
    }

    /* Animation Classes */
    .fade-in-up {
        opacity: 0;
        transform: translateY(30px);
        transition: all 0.6s ease;
    }

    .fade-in-up.visible {
        opacity: 1;
        transform: translateY(0);
    }

    .slide-in-left {
        opacity: 0;
        transform: translateX(-30px);
        transition: all 0.6s ease;
    }

    .slide-in-left.visible {
        opacity: 1;
        transform: translateX(0);
    }

    .slide-in-right {
        opacity: 0;
        transform: translateX(30px);
        transition: all 0.6s ease;
    }

    .slide-in-right.visible {
        opacity: 1;
        transform: translateX(0);
    }
</style>

<script>
    // GSAP Animations with Error Handling
    document.addEventListener('DOMContentLoaded', function() {
        // Check if GSAP and ScrollTrigger are loaded
        if (typeof gsap === 'undefined' || typeof ScrollTrigger === 'undefined') {
            console.error('GSAP or ScrollTrigger not found. Please ensure both libraries are loaded.');
            return;
        }

        try {
            // Register ScrollTrigger plugin
            gsap.registerPlugin(ScrollTrigger);
            
            // Configure GSAP for better performance
        gsap.config({
            force3D: true,
            autoSleep: 60,
            nullTargetWarn: false
        });
        
        // Set default scroll behavior to passive for touch/wheel events
        try {
            const options = {
                passive: true,
                capture: true
            };
            
            // Apply passive to window and document
            ['touchstart', 'touchmove', 'wheel'].forEach(event => {
                window.addEventListener(event, () => {}, options);
                document.addEventListener(event, () => {}, options);
            });
            
            // Apply passive to document elements
            const originalAddEventListener = EventTarget.prototype.addEventListener;
            EventTarget.prototype.addEventListener = function(type, listener, options) {
                const newOptions = (typeof options === 'boolean' || options === undefined) ? 
                    options : 
                    { ...options, passive: type === 'wheel' || type === 'touchstart' || type === 'touchmove' };
                
                return originalAddEventListener.call(this, type, listener, newOptions);
            };
        } catch (e) {
            console.warn('Could not set passive event listeners', e);
        }

        // Helper function to safely create animations
        function safeGsapFrom(selector, vars, scrollVars) {
            const element = document.querySelector(selector);
            if (!element) return null;
            
            return gsap.from(selector, {
                ...vars,
                scrollTrigger: scrollVars ? {
                    ...scrollVars,
                    toggleActions: scrollVars.toggleActions || 'play none none reverse'
                } : undefined
            });
        }

        // Header Animation (equivalent to data-aos="fade-up" data-aos-duration="1500")
        safeGsapFrom('.header-line-left', {
            width: 0,
            duration: 0.8,
            ease: "power2.out"
        });

        safeGsapFrom('.header-line-right', {
            width: 0,
            duration: 0.8,
            delay: 0.2,
            ease: "power2.out"
        });

        safeGsapFrom('.gsap-title', {
            opacity: 0,
            y: 30,
            duration: 1.5,
            delay: 0.4,
            ease: "power2.out"
        });

        safeGsapFrom('.gsap-subtitle', {
            opacity: 0,
            y: 20,
            duration: 1.5,
            delay: 0.6,
            ease: "power2.out"
        });

        // Founder Section Title (only if element exists)
        safeGsapFrom('.gsap-founder-title', {
            opacity: 0,
            y: 30,
            duration: 1.0,
            ease: "power2.out"
        }, {
            trigger: '.gsap-founder-title',
            start: 'top 85%'
        });

        // Founder Cards (only if element exists)
        const founderGrid = document.querySelector('.founder-grid');
        if (founderGrid) {
            gsap.from('.gsap-founder-card', {
                scrollTrigger: {
                    trigger: founderGrid,
                    start: 'top 80%',
                    toggleActions: 'play none none reverse'
                },
                opacity: 0,
                y: 50,
                duration: 1.2,
                stagger: 0.15,
                ease: "back.out(1.7)"
            });
        }

        // History Section (equivalent to data-aos="fade-right" and "fade-left" data-aos-duration="1200")
        gsap.from('.gsap-history-image', {
            scrollTrigger: {
                trigger: '#sejarah',
                start: 'top 75%',
                toggleActions: 'play none none reverse'
            },
            opacity: 0,
            x: -50,
            duration: 1.2,
            ease: "power2.out"
        });

        gsap.from('.gsap-history-content', {
            scrollTrigger: {
                trigger: '#sejarah',
                start: 'top 75%',
                toggleActions: 'play none none reverse'
            },
            opacity: 0,
            x: 50,
            duration: 1.2,
            delay: 0.2,
            ease: "power2.out"
        });


        // Vision Mission Section (equivalent to data-aos="fade-left" and "fade-right" data-aos-duration="1200")
        gsap.from('.gsap-vision-image', {
            scrollTrigger: {
                trigger: '#visimisi',
                start: 'top 75%',
                toggleActions: 'play none none reverse'
            },
            opacity: 0,
            x: -50,
            duration: 1.2,
            ease: "power2.out"
        });

        gsap.from('.gsap-vision-content', {
            scrollTrigger: {
                trigger: '#visimisi',
                start: 'top 75%',
                toggleActions: 'play none none reverse'
            },
            opacity: 0,
            x: 50,
            duration: 1.2,
            delay: 0.2,
            ease: "power2.out"
        });

        // Experience Counter Animation
        const experienceCounter = document.querySelector('.highlight-box span');
        if (experienceCounter) {
            const targetNumber = parseInt(experienceCounter.textContent);
            let animated = false;
            
            gsap.to(experienceCounter, {
                scrollTrigger: {
                    trigger: '.highlight-box',
                    start: 'top 80%',
                    onEnter: () => {
                        if (!animated) {
                            let count = 0;
                            const duration = 2; // seconds
                            const step = targetNumber / (duration * 60); // 60fps
                            
                            const updateCount = () => {
                                count += step;
                                if (count < targetNumber) {
                                    experienceCounter.textContent = Math.ceil(count);
                                    requestAnimationFrame(updateCount);
                                } else {
                                    experienceCounter.textContent = targetNumber;
                                }
                            };
                            
                            updateCount();
                            animated = true;
                        }
                    },
                    once: true // Only animate once
                }
            });
        }
        } catch (error) {
            console.error('Error initializing GSAP animations:', error);
        }
    });

    // Initialize title underlines with error handling
    function initTitleUnderlines() {
        try {
            const sectionTitles = document.querySelectorAll('.section-title');
            if (!sectionTitles.length) {
                console.warn('No section titles found for underline animation');
                return;
            }

            sectionTitles.forEach(title => {
                const underline = title.querySelector('.title-underline');
                if (!underline) {
                    console.warn('No underline element found in title:', title);
                    return;
                }

                // Set initial state
                gsap.set(underline, { width: 0 });
                
                // Create ScrollTrigger
                gsap.to(underline, {
                    scrollTrigger: {
                        trigger: title,
                        start: 'top 80%',
                        toggleActions: 'play none none reverse',
                        onEnter: () => gsap.to(underline, { 
                            width: '100%', 
                            duration: 0.8, 
                            ease: 'power2.out' 
                        }),
                        onLeaveBack: () => gsap.to(underline, { 
                            width: 0, 
                            duration: 0.4 
                        })
                    }
                });
            });
        } catch (error) {
            console.error('Error initializing title underlines:', error);
        }
    }

    // Initialize after GSAP is ready
    if (typeof gsap !== 'undefined' && typeof ScrollTrigger !== 'undefined') {
        gsap.registerPlugin(ScrollTrigger);
        gsap.delayedCall(0.1, initTitleUnderlines);
    }
</script>