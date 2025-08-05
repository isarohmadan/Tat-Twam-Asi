<!-- Clean & Natural Footer -->
<footer class="footer">
        <div class="footer-content">
            <div class="footer-top">
                <!-- Brand & Mission Section -->
                <div class="footer-brand">
                    <div class="footer-logo">
                        <div class="logo-icon">
                            <i class="fas fa-heart"></i>
                        </div>
                        <h3>Yayasan Tat Twam Asi</h3>
                    </div>
                    
                    <p class="footer-description">
                        Yayasan yang berkomitmen memberikan pendidikan berkualitas dan kasih sayang 
                        kepada anak-anak, dengan berlandaskan nilai-nilai luhur untuk menciptakan 
                        generasi yang berkarakter dan berintegritas.
                    </p>

                    
                    <div class="location-info">
                        <h6><i class="fas fa-map-marker-alt" style="margin-right: 5px;"></i>Lokasi Strategis</h6>
                        <p>Berada di pusat kota Denpasar dengan akses mudah dijangkau, 
                        menciptakan lingkungan yang kondusif untuk pembelajaran dan pertumbuhan.</p>
                    </div>
                    
                    <div class="social-links">
                        <a href="#" class="social-link" title="Facebook">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="social-link" title="Instagram">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="social-link" title="WhatsApp">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                        <a href="mailto:pa.tatwamasi@gmail.com" class="social-link" title="Email">
                            <i class="fas fa-envelope"></i>
                        </a>
                    </div>
                </div>
                
                <!-- Contact Information -->
                <div class="footer-contact">
                    <h4>Informasi Kontak</h4>
                    
                    <ul class="contact-info">
                        <li class="contact-item">
                            <div class="contact-icon">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div class="contact-details">
                                <div class="contact-label">Alamat</div>
                                <div class="contact-value">
                                    Jalan Jaya Giri IX No.6<br>Denpasar, Bali
                                </div>
                            </div>
                        </li>
                        
                        <li class="contact-item">
                            <div class="contact-icon">
                                <i class="fas fa-phone"></i>
                            </div>
                            <div class="contact-details">
                                <div class="contact-label">Telepon</div>
                                <div class="contact-value">
                                    <a href="tel:+6236123140001">(0361) 231401</a>
                                </div>
                            </div>
                        </li>
                        <li class="contact-item">
                            <div class="contact-icon">
                                <i class="fas fa-mobile-alt"></i>
                            </div>
                            <div class="contact-details">
                                <div class="contact-label">Handphone</div>
                                <div class="contact-value">
                                    <a href="tel:+6285935150401">085 935 150 401</a>
                                </div>
                            </div>
                        </li>
                        
                        <li class="contact-item">
                            <div class="contact-icon">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div class="contact-details">
                                <div class="contact-label">Email</div>
                                <div class="contact-value">
                                    <a href="mailto:pa.tatwamasi@gmail.com">pa.tatwamasi@gmail.com</a>
                                </div>
                            </div>
                        </li>
                        
                        <li class="contact-item">
                            <div class="contact-icon">
                                <i class="fas fa-university"></i>
                            </div>
                            <div class="contact-details">
                                <div class="contact-label">Rekening Donasi</div>
                                <div class="contact-value">
                                    0017-01-006109-53-2<br>
                                    <small>Bank BRI Cabang Denpasar</small>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        
        <div class="footer-bottom">
            <p>
                Copyright © 2025 <span class="highlight">Yayasan Tat Twam Asi</span>. 
                Dibuat dengan dedikasi untuk masa depan anak-anak Indonesia.
            </p>
        </div>
    </footer>
    <style>
        .footer {
            background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
            color: white;
            position: relative;
            font-family: 'Montserrat', serif;
            margin-top: auto;
        }

        /* Subtle overlay */
        .footer::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                radial-gradient(circle at 20% 50%, rgba(255,255,255,0.03) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(255,255,255,0.02) 0%, transparent 50%);
            pointer-events: none;
        }
        
        .footer-content {
            position: relative;
            z-index: 2;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        
        .footer-top {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 50px;
        }
        
        /* Brand Section - Clean & Professional */
        .footer-brand {
            display: flex;
            flex-direction: column;
        }
        
        .footer-logo {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }
        
        .footer-logo .logo-icon {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, #6bb6ff, #4a90e2);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            box-shadow: 0 4px 15px rgba(74, 144, 226, 0.2);
        }
        
        .footer-logo .logo-icon i {
            color: white;
            font-size: 1.4rem;
        }
        
        .footer-logo h3 {
            font-family: 'Montserrat', serif;
            font-size: 1.6rem;
            font-weight: 600;
            margin: 0;
            color: #ffffff;
        }
        
        .footer-description {
            color: rgba(255, 255, 255, 0.85);
            font-size: 0.95rem;
            line-height: 1.6;
            margin-bottom: 20px;
        }
        
        .philosophy-section {
            background: rgba(255, 255, 255, 0.05);
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            border-left: 3px solid #4a90e2;
        }
        
        .philosophy-section h5 {
            font-family: 'Montserrat', serif;
            font-size: 1.1rem;
            color: #6bb6ff;
            margin-bottom: 10px;
            font-weight: 600;
        }
        
        .philosophy-section p {
            color: rgba(255, 255, 255, 0.8);
            margin: 0;
            font-size: 0.9rem;
            line-height: 1.5;
        }
        
        .location-info {
            background: rgba(255, 255, 255, 0.04);
            padding: 18px;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        
        .location-info h6 {
            color: #6bb6ff;
            margin-bottom: 8px;
            font-size: 0.95rem;
            font-weight: 600;
        }
        
        .location-info p {
            color: rgba(255, 255, 255, 0.8);
            margin: 0;
            font-size: 0.85rem;
            line-height: 1.5;
        }
        
        /* Social Links - Minimal */
        .social-links {
            display: flex;
            gap: 12px;
        }
        
        .social-link {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 8px;
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: all 0.3s ease;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .social-link:hover {
            background: #4a90e2;
            color: white;
            transform: translateY(-2px);
            border-color: #4a90e2;
        }
        
        /* Contact Section - Clean Layout */
        .footer-contact {
            padding-left: 20px;
        }
        
        .footer-contact h4 {
            font-family: 'Montserrat', serif;
            font-size: 1.4rem;
            font-weight: 600;
            margin-bottom: 20px;
            color: #ffffff;
            position: relative;
            padding-bottom: 8px;
        }
        
        .footer-contact h4::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 40px;
            height: 2px;
            background: #4a90e2;
            border-radius: 1px;
        }
        
        .contact-info {
            list-style: none;
            margin: 0;
            padding: 0;
        }
        
        .contact-item {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
            padding: 12px 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            transition: all 0.3s ease;
        }
        
        .contact-item:last-child {
            border-bottom: none;
        }
        
        .contact-item:hover {
            padding-left: 8px;
        }
        
        .contact-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 35px;
            height: 35px;
            background: rgba(74, 144, 226, 0.1);
            border-radius: 6px;
            margin-right: 12px;
            flex-shrink: 0;
        }
        
        .contact-icon i {
            color: #6bb6ff;
            font-size: 0.9rem;
        }
        
        .contact-details {
            flex: 1;
        }
        
        .contact-label {
            font-weight: 500;
            color: rgba(255, 255, 255, 0.9);
            font-size: 0.85rem;
            margin-bottom: 2px;
        }
        
        .contact-value {
            color: rgba(255, 255, 255, 0.75);
            font-size: 0.9rem;
            line-height: 1.4;
        }
        
        .contact-value a {
            color: #6bb6ff;
            text-decoration: none;
            transition: color 0.3s ease;
        }
        
        .contact-value a:hover {
            color: #4a90e2;
        }
        
        /* Footer Bottom - Simple */
        .footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding: 20px 0;
            text-align: center;
            background: rgba(0, 0, 0, 0.1);
        }
        
        .footer-bottom p {
            margin: 0;
            color: rgba(255, 255, 255, 0.7);
            font-size: 0.9rem;
        }
        
        .footer-bottom .highlight {
            color: #6bb6ff;
            font-weight: 500;
        }
        
        /* Responsive Design */
        @media (max-width: 768px) {
            .footer-content {
                padding: 40px 20px 20px;
            }
            
            .footer-top {
                grid-template-columns: 1fr;
                gap: 30px;
            }
            
            .footer-contact {
                padding-left: 0;
            }
            
            .footer-logo h3 {
                font-size: 1.4rem;
            }
            
            .social-links {
                justify-content: center;
            }
            
            .philosophy-section,
            .location-info {
                padding: 15px;
            }
        }
        
        @media (max-width: 480px) {
            .footer-logo {
                flex-direction: column;
                text-align: center;
            }
            .footer-top {
                padding-top: 0px;
            }
               
        .footer-bottom p {
            margin: 0;
            color: rgba(255, 255, 255, 0.7);
            font-size: 0.5rem;
        }
            
            .footer-logo .logo-icon {
                margin-right: 0;
                margin-bottom: 10px;
            }
            
            .contact-item {
                align-items: flex-start;
                padding: 10px 0;
            }
            
            .contact-icon {
                margin-top: 2px;
            }
        }
    </style>
