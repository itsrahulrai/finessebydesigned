@extends('layouts.app')

@section('content')
    {{-- =========================
        BREADCRUMB
    ========================== --}}
    <div class="breadcrumb-kkt">
        <div class="container">
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}">Home</a>
                    </li>

                    <li class="breadcrumb-item active">
                        About Us
                    </li>
                </ol>
            </nav>
        </div>
    </div>



    {{-- =========================
    ABOUT SECTION
========================== --}}
    <section class="about-hero py-5">
        <div class="container">

            <div class="row align-items-center g-5">

                {{-- Left Content --}}
                <div class="col-lg-7">

                    <span class="about-badge">
                        About Gastro Wellness
                    </span>

                    <h1 class="about-title mt-3">
                        Gastro Wellness Pvt. Ltd.
                    </h1>

                    <p class="about-subtitle">
                        Your Trusted Partner in Digestive, Liver & Anorectal Health
                    </p>

                    <p class="about-text">
                        <strong>Gastro Wellness Pvt. Ltd.</strong> is a healthcare-focused
                        pharmaceutical and wellness company dedicated to improving the lives
                        of patients suffering from anorectal disorders, gastrointestinal
                        diseases, and liver-related conditions.
                    </p>

                    <p class="about-text">
                        Backed by more than
                        <strong>22 years of clinical excellence</strong> and the trusted
                        foundation of <strong>Centre for Piles and Fistula</strong>, our
                        mission is to provide effective, trusted, and doctor-recommended
                        healthcare solutions that improve quality of life and promote
                        long-term digestive wellness.
                    </p>


                </div>


                {{-- Right Card --}}
                <div class="col-lg-5">

                    <div class="about-card">

                        <h3>
                            Our Healthcare Focus
                        </h3>

                        <div class="row g-3 mt-2">

                            <div class="col-6">
                                <div class="feature-box">
                                    Piles (Hemorrhoids)
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="feature-box">
                                    Fissure & Fistula
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="feature-box">
                                    Constipation
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="feature-box">
                                    Digestive Disorders
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="feature-box">
                                    Acidity & Gas
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="feature-box">
                                    Liver health and Wellness 
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="feature-box">
                                    Fatty Liver
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="feature-box">
                                   Gut Health & Wellness
                                </div>
                            </div>

                        </div>

                    </div>

                </div>


            </div>



            {{-- Mission --}}
            <div class="row mt-5">

                <div class="col-lg-12">

                    <div class="mission-box">

                        <h2>
                            Why Gut Health Matters
                        </h2>

                        <p class="about-text">
                            We believe that <strong>every disease begins with the gut.</strong>
                            A healthy digestive system is the foundation of a healthy life. Your gut
                            is home to trillions of beneficial microorganisms that play a vital role
                            in digestion, immunity, metabolism, and overall physical and emotional wellness.
                        </p>

                        <p class="about-text mb-0">
                            When your digestive system is balanced, your body functions more efficiently,
                            helping you feel healthier, more energetic, and mentally stronger every day.
                        </p>

                    </div>

                </div>

            </div>


            <div class="row mt-5">

                <div class="col-lg-12">

                    <div class="mission-box">

                        <h2>
                            The Gut–Brain Connection
                        </h2>

                        <p class="about-text">
                            Modern scientific research has established the powerful
                            <strong>Gut-Brain Axis</strong>—a continuous communication
                            between your digestive system and your brain.
                        </p>

                        <p class="about-text">
                            A balanced gut microbiome can positively influence
                            <strong>mood, stress response, sleep quality, cognitive function,</strong>
                            and overall mental well-being. Caring for your gut means caring for your entire body.
                        </p>

                    </div>

                </div>

            </div>

            <div class="mt-4">

                <div class="about-card">

                    <h3>
                        Benefits of a Healthy Gut
                    </h3>

                    <div class="row g-3 mt-2">

                        <div class="col-6">
                            <div class="feature-box">
                                Stronger Immunity
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="feature-box">
                             Better Digestion
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="feature-box">
                                Improved Metabolism
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="feature-box">
                                Weight Management
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="feature-box">
                                Higher Energy Levels
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="feature-box">
                              Reduced Inflammation
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="feature-box">
                                Better Sleep
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="feature-box">
                                Mental Wellness
                            </div>
                        </div>

                    </div>

                </div>

            </div>


            {{-- Mission --}}
            <div class="row mt-5">

                <div class="col-lg-12">

                    <div class="mission-box">

                        <h2>
                            Our Mission
                        </h2>

                        <p>
                            At <strong>Gastro Wellness Pvt. Ltd.</strong>, through innovation,
                            clinical expertise, and an unwavering commitment to patient care,
                            we strive to deliver healthcare solutions that support healing,
                            provide comfort, and promote long-term wellness.
                        </p>

                    </div>

                </div>

            </div>


            {{-- Promise --}}
            <div class="row mt-4">

                <div class="col-lg-12">


                    <div class="promise-box text-center">

                        <h2>Our Promise</h2>

                        <h4 class="mt-3">
                            Your Health, Our Priority.
                        </h4>

                        <h4 class="text-warning fw-bold">
                            Your Wellness, Our Mission.
                        </h4>

                        

                        <div class="row mt-4 justify-content-center">

                            <div class="col-lg-4 col-md-4 col-12">
                                <div class="feature-box">
                                    💚 Healthy Gut
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-4 col-12">
                                <div class="feature-box">
                                    💪 Healthy Body
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-4 col-12">
                                <div class="feature-box">
                                    🧠 Healthy Mind
                                </div>
                            </div>

                        </div>

                        <p class="about-text text-white mt-4 mb-0">
                            We believe that true wellness starts from within. By combining trusted
                            medical expertise, scientifically developed healthcare products, and
                            patient-focused care, we aim to help every individual live a healthier,
                            happier, and more active life.
                        </p>

                    </div>

                </div>

            </div>

        </div>
    </section>
@endsection
