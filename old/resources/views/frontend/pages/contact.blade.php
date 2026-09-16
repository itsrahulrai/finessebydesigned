@extends('layouts.app')
@section('title', 'Contact Us')
@push('styles')
    <style>
     /*================================================
BRANCH SECTION
================================================*/

.branch-section{
    background: var(--kkt-bg);
    position: relative;
}

.section-badge{
    display:inline-block;
    color:var(--kkt-secondary);
    font-size:13px;
    font-weight:700;
    letter-spacing:3px;
    text-transform:uppercase;
    margin-bottom:12px;
}

.section-title{
    font-size:42px;
    font-weight:800;
    color:var(--kkt-dark);
    margin-bottom:15px;
}

.section-desc{
    max-width:650px;
    margin:auto;
    color:var(--kkt-muted);
    font-size:16px;
}


/*================================================
CARD
================================================*/

.branch-card{
    background:#fff;
    border:1px solid var(--kkt-border);
    border-radius:22px;
    padding:25px;
    height:100%;
    position:relative;
    overflow:hidden;
    box-shadow:
        0 10px 30px rgba(181,23,54,.04),
        0 15px 40px rgba(217,90,11,.06);
    transition:.4s ease;
}

.branch-card:hover{
    transform:translateY(-8px);
}

.branch-card::before{
    content:"";
    position:absolute;
    top:0;
    left:0;
    width:100%;
    height:4px;
    background:var(--kkt-gradient);
}


/*================================================
ICON
================================================*/

.branch-icon{
    width:55px;
    height:55px;
    border-radius:16px;
    background:var(--kkt-gradient);
    color:#fff;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:20px;
    margin-bottom:18px;
}


/*================================================
TITLE
================================================*/

.branch-card h4{
    font-size:25px;
    font-weight:700;
    color:var(--kkt-dark);
    margin-bottom:12px;
}


/*================================================
PHONE
================================================*/

.branch-phone{
    font-size:15px;
    font-weight:600;
    color:var(--kkt-primary);
    margin-bottom:15px;
}

.branch-phone i{
    margin-right:7px;
}


/*================================================
ADDRESS
================================================*/

.branch-address{
    color:var(--kkt-text);
    font-size:14px;
    line-height:1.8;
    margin-bottom:18px;
}


/*================================================
BUSINESS HOURS BOX
================================================*/

.branch-time{
    background:var(--kkt-light);
    border:1px solid var(--kkt-border);
    border-radius:16px;
    padding:16px;
}

.branch-time h6{
    font-size:15px;
    font-weight:700;
    color:var(--kkt-dark);
    margin-bottom:10px;
}

.branch-time span{
    display:block;
    font-size:14px;
    color:var(--kkt-text);
    line-height:1.7;
}


/*================================================
BUTTONS
================================================*/

.branch-btns{
    display:flex;
    gap:10px;
    margin-top:18px;
}

.branch-btn{
    flex:1;
    height:42px;
    border-radius:12px;
    display:flex;
    align-items:center;
    justify-content:center;
    text-decoration:none;
    font-size:14px;
    font-weight:600;
    transition:.3s;
}

.branch-call{
    background:var(--kkt-gradient);
    color:#fff;
}

.branch-map{
    background:var(--kkt-light);
    color:var(--kkt-primary);
    border:1px solid var(--kkt-border);
}

.branch-btn:hover{
    transform:translateY(-3px);
}


/*================================================
RESPONSIVE
================================================*/

@media(max-width:991px){

    .section-title{
        font-size:34px;
    }

    .branch-card{
        padding:22px;
    }

    .branch-card h4{
        font-size:22px;
    }

}

@media(max-width:767px){

    .section-title{
        font-size:28px;
    }

    .section-desc{
        font-size:14px;
    }

    .branch-card{
        padding:20px;
    }

    .branch-btns{
        flex-direction:column;
    }

    .branch-btn{
        width:100%;
    }

}
    </style>
@endpush
@section('content')
    {{-- Breadcrumb --}}
    <div class="breadcrumb-kkt">
        <div class="container">
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}">
                            <i class="bi bi-house-door-fill me-1"></i>
                            Home
                        </a>
                    </li>
                    <li class="breadcrumb-item active">
                        Contact
                    </li>
                </ol>
            </nav>
        </div>
    </div>
    {{-- Contact Section --}}
    <section class="contact-section">
        <div class="container">
            <div class="row align-items-center g-5">
                {{-- Left Info --}}
                <div class="col-lg-5">
                    <span class="contact-badge">
                        Get In Touch
                    </span>
                    <h2 class="contact-title">
                        Get In
                     <span>Touch With Us</span>
                    </h2>
                    <p class="contact-desc">
                        Have questions or need assistance? Our team is here to help.
                    </p>
                    {{-- Contact Info --}}
                    <div class="contact-info-wrapper">
                        {{-- Phone --}}
                        <div class="contact-info-box">
                            <div class="contact-icon">
                                <i class="bi bi-telephone-fill"></i>
                            </div>
                            <div>
                                <h6>Phone Number</h6>
                                <p>{{ setting('site_phone') }}</p>
                            </div>
                        </div>
                        {{-- Email --}}
                        <div class="contact-info-box">
                            <div class="contact-icon">
                                <i class="bi bi-envelope-fill"></i>
                            </div>
                            <div>
                                <h6>Email Address</h6>
                                <p>{{ setting('site_email') }}</p>
                            </div>
                        </div>
                        {{-- Address --}}
                        <div class="contact-info-box">
                            <div class="contact-icon">
                                <i class="bi bi-geo-alt-fill"></i>
                            </div>
                            <div>
                                <h6>Office Address</h6>
                                <p>{{ setting('site_address') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Contact Form --}}
                <div class="col-lg-7">
                    <div class="contact-card">
                        <div class="contact-card-header">
                            <h3>
                                Send Us a Message
                            </h3>
                            <p>
                                Fill out the form and we’ll contact you shortly.
                            </p>
                        </div>
                        {{-- Success --}}
                        @if (session('success'))
                            <div class="alert alert-success border-0 rounded-4 py-3">
                                {{ session('success') }}
                            </div>
                        @endif
                        {{-- Form --}}
                        <form method="POST" action="{{ route('contact.submit') }}">
                            @csrf
                            <div class="row g-4">
                                {{-- Name --}}
                                <div class="col-md-6">
                                    <label class="contact-label">
                                        Full Name
                                    </label>
                                    <input type="text" name="name" class="form-control contact-input"
                                        placeholder="Enter your name" required>
                                </div>
                                {{-- Email --}}
                                <div class="col-md-6">
                                    <label class="contact-label">
                                        Email Address
                                    </label>
                                    <input type="email" name="email" class="form-control contact-input"
                                        placeholder="Enter your email" required>
                                </div>
                                {{-- Phone --}}
                                <div class="col-md-6">
                                    <label class="contact-label">
                                        Phone Number
                                    </label>
                                    <input type="tel" name="phone" class="form-control contact-input"
                                        placeholder="+91 XXXXX XXXXX">
                                </div>
                                {{-- Subject --}}
                                <div class="col-md-6">
                                    <label class="contact-label">
                                        Subject
                                    </label>
                                    <input type="text" name="subject" class="form-control contact-input"
                                        placeholder="Enter subject">
                                </div>
                                {{-- Message --}}
                                <div class="col-12">
                                    <label class="contact-label">
                                        Your Message
                                    </label>
                                    <textarea name="message" rows="5" class="form-control contact-textarea" placeholder="Write your message..."
                                        required></textarea>
                                </div>
                            </div>
                            {{-- Button --}}
                            <button type="submit" class="contact-btn">
                                Send Message
                                <i class="bi bi-arrow-right ms-2"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>  

    {{-- Branch Locations --}}
    <section class="branch-section py-5">
        <div class="container">
            <div class="text-center mb-5">
                <span class="section-badge">OUR CENTRES</span>
                <h2 class="section-title">Our Centre & Timings</h2>
                <p class="section-desc">
                    Visit any of our locations. We are available by appointment.
                </p>
            </div>

            <div class="row g-4">

                {{-- Branch --}}
                <div class="col-lg-3 col-md-6">
                    <div class="branch-card">
                        <div class="branch-icon">
                            <i class="bi bi-geo-alt-fill"></i>
                        </div>

                        <h4>Paschim Vihar</h4>

                        <p class="branch-phone">
                            <i class="bi bi-telephone-fill"></i>
                            +91-9212395788
                        </p>

                        <p class="branch-address">
                            A-8 Shubham Enclave, Opp. Radisson Blu Hotel,
                            Outer Ring Road, Paschim Vihar, Delhi 110063
                        </p>

                        <div class="branch-time">
                            <h6>Business Hours</h6>
                            <span>Mon - Sun : 11:00 AM - 8:00 PM</span>
                        </div>
                    </div>
                </div>

                {{-- Branch --}}
                <div class="col-lg-3 col-md-6">
                    <div class="branch-card">
                        <div class="branch-icon">
                            <i class="bi bi-geo-alt-fill"></i>
                        </div>

                        <h4>Rohini</h4>

                        <p class="branch-phone">
                            <i class="bi bi-telephone-fill"></i>
                            +91-9870365644
                        </p>

                        <p class="branch-address">
                            AI/30, 1st Floor, Sec-15, Near Junior Sachdeva Public School,
                            Rohini West Metro Station, Delhi
                        </p>

                        <div class="branch-time">
                            <h6>Business Hours</h6>
                            <span>Mon - Sun : 10:00 AM - 8:00 PM</span>
                        </div>
                    </div>
                </div>

                {{-- Branch --}}
                <div class="col-lg-3 col-md-6">
                    <div class="branch-card">
                        <div class="branch-icon">
                            <i class="bi bi-geo-alt-fill"></i>
                        </div>

                        <h4>Indirapuram</h4>

                        <p class="branch-phone">
                            <i class="bi bi-telephone-fill"></i>
                            +91-9910881571
                        </p>

                        <p class="branch-address">
                            A-203, Rajhans Plaza, Opp. Aditya Mall,
                            Indirapuram, Ghaziabad - 201014
                        </p>

                        <div class="branch-time">
                            <h6>Business Hours</h6>
                            <span>Sat : 7:00 PM - 8:30 PM</span>
                        </div>
                    </div>
                </div>

                 {{-- Branch --}}
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="branch-card">
                        <div class="branch-icon">
                            <i class="bi bi-geo-alt-fill"></i>
                        </div>

                        <h4>Tilak Nagar</h4>

                        <p class="branch-phone">
                            <i class="bi bi-telephone-fill"></i>
                            +91-7042452308
                        </p>

                        <p class="branch-address">
                            B-14, F/F, WZ-6/7, Ganesh Nagar,
                            Tilak Nagar, Delhi 110018
                        </p>

                        <div class="branch-time">
                            <h6>Business Hours</h6>
                            <span>Monday To Sunday : 8:00 AM - 8:00 PM</span>
                        </div>
                    </div>
                </div>

                 {{-- Branch --}}
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="branch-card">
                        <div class="branch-icon">
                            <i class="bi bi-geo-alt-fill"></i>
                        </div>

                        <h4>Dwarka</h4>

                        <p class="branch-phone">
                            <i class="bi bi-telephone-fill"></i>
                            +91-7303909004
                        </p>

                        <p class="branch-address">
                            F C, Pathak Shop, AT D-418 G/F,
                            Sector-7, Harijan Basti Palam,
                            Dwarka, Delhi 110077
                        </p>

                        <div class="branch-time">
                            <h6>Business Hours</h6>
                            <span>Monday To Sunday : 8:00 AM - 8:00 PM</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>


    {{-- Google Map --}}
{{-- <section class="contact-map-section">
    <div class="map-card">
       <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d6996.250880244178!2d77.1368778!3d28.7456715!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390d0132cd377003%3A0xf91f52fafdf12841!2sSANNI%20CAD%20CAM%20PVT%20LTD!5e0!3m2!1sen!2sin!4v1780737977712!5m2!1sen!2sin" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
</section>
 --}}

@endsection