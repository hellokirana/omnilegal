@extends('layouts.frontend')

@section('content')
    <!-- common banner -->
    <section class="common-banner">
        <div class="bg-layer" style="background: url('{{ asset('assets/images/background/common-banner-bg.jpg')}}');"></div>
        <div class="common-banner-content">
            <h3>About</h3>
            <div class="breadcrumb">
                <ul>
                    <li class="breadcrumb-item active"><a href="{{ url('/')}}">Home</a></li>
                    <li class="breadcrumb-item"><i class="fa-solid fa-angles-right"></i> About</li>
                </ul>
            </div>
        </div>
    </section>
    <!-- common banner -->


    <!-- about page -->
    <section class="about-page">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <div class="about-page-left">
                        <div class="yellow-shape"></div>
                        <div class="pink-shape"></div>
                        <div class="about-page-left-image">
                            <img src="{{ asset('assets/images/resource/rotokemas.png') }}" alt="image">
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="rewards-left-container">
                        <div class="rewards-left-container-inner">
                            <div class="common-title mb_30">
                                <h6><i class="fa-solid fa-angles-right"></i>SHOWING</h6>
                                <h3>About Rotokemas Indonesia</h3>
                                <p style="text-align: justify;">The Packaging Industry Association - Rotokemas is an organization established to support the development of the packaging industry in Indonesia, focusing on innovation, standardization, and collaboration among industry players. Rotokemas has served as a platform for packaging companies to share knowledge, enhance production quality, and expand business networks.</p>
                            </div>
                            <div class="rewards-left-list">
                                <ul>
                                    <li><i class="fa-sharp fa-light fa-circle-check"></i>Strong Industry Network</li>
                                    <li><i class="fa-sharp fa-light fa-circle-check"></i>Focus on Innovation</li>
                                    <li><i class="fa-sharp fa-light fa-circle-check"></i>Quality & Standardization Support</li>
                                    <li><i class="fa-sharp fa-light fa-circle-check"></i>Knowledge Sharing & Skill Development</li>
                                    <li><i class="fa-sharp fa-light fa-circle-check"></i>Business Expansion Opportunities</li>
                                    <li><i class="fa-sharp fa-light fa-circle-check"></i>Credibility & Trust</li>
                                    <li><i class="fa-sharp fa-light fa-circle-check"></i>Advocacy & Industry Voice</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- about page -->

    <!-- rotokemas history -->
<section class="rotokemas-history py-5 bg-white">
    <div class="container">
        <div class="common-title text-center mb-5">
            <h6><i class="fa-solid fa-angles-right"></i>OUR HISTORY</h6>
            <h3>Historical Milestones of Rotokemas</h3>
        </div>

        <div class="timeline">

            <!-- 1979/1980 -->
            <div class="timeline-item mb-5">
                <h5 class="fw-bold">1979/1980 – The Early Foundation</h5>
                <p>
                    The name “Rotokemas Indonesia” originated from a collective initiative of rotogravure and packaging companies in Indonesia. 
                    This informal group served as a platform for collaboration and information exchange among industry players.
                </p>
            </div>

            <!-- 2023 -->
            <div class="timeline-item mb-5">
                <h5 class="fw-bold">2023 – First General Meeting</h5>
                <p>
                    The first official general meeting was held on <strong>March 16, 2023</strong> at <strong>Swissotel PIK Avenue Laussane 2 Lantai 7 Pantai Indah Kapuk</strong>.
                    It marked the formal establishment of the association under Indonesian law.
                </p>
                <p><strong>Legal Basis:</strong> Deed No. 06, dated December 6, 2023, by Notary Nilda, SH.</p>
                <p><strong>Ministry Approval:</strong> AHU-0011092.AH.01.07.2023, issued on December 18, 2023.</p>
                <p><strong>Founding Board:</strong></p>
                <ul class="ms-4">
                    <li>Timothy Cahyadi (Toppan Plasindo Lestari) – Chairman</li>
                    <li>Purnomo Widjaja (PT Lawangmas Primapack Indonesia) – Secretary</li>
                    <li>Jeffrey Halim (PT Supernova Flexible Packaging) – Treasurer</li>
                    <li>Bong Harly (PT DNP Indonesia) – Supervisor</li>
                    <li>Johanes Julia (PT Indofood CBP Sukses Makmur Tbk) – Vice Supervisor</li>
                    <li>Se Kwok Rahardjo (PT Prima Makmur Rotokemindo) – Member Supervisor</li>
                </ul>
            </div>

            <!-- 2024 -->
            <div class="timeline-item mb-5">
                <h5 class="fw-bold">2024 – Second General Meeting</h5>
                <p>
                    Held on <strong>June 20, 2024</strong> at <strong>Hotel Borobudur Jakarta (Singosari Room)</strong>, 
                    the meeting reviewed organizational progress and planned further programs.
                </p>
            </div>

            <!-- 2025 -->
            <div class="timeline-item mb-0">
                <h5 class="fw-bold">2025 – Third General Meeting</h5>
                <p>
                    The third general meeting was conducted on <strong>June 4, 2025</strong> at <strong>Hotel Grand Mercure (Lotus 1 Room)</strong>, 
                    continuing the association’s commitment to industry development and member engagement.
                </p>
            </div>

        </div>
    </div>
</section>
<!-- rotokemas history -->

{{-- structure --}}
<section class="organization-structure py-5">
    <div class="container text-center">
        <div class="common-title text-center mb-4">
            <h6>2023 - 2026</h6>
            <h3>Organizational Structure</h3>
        </div>

        <div class="about-page-image">
            <img src="{{ asset('assets/images/resource/structure.png') }}" alt="image" style="max-width: 100%; width: 500px; height: auto;">
        </div>
    </div>
</section>
{{-- structure --}}


    <!-- contact page -->
<section class="contact-section bg-light py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <div class="contact-content position-relative">
                    <div class="common-title mb-4">
                        <h6><i class="fa-solid fa-angles-right"></i>CONTACT US</h6>
                        <h3>Would you like to get in touch with us?</h3>
                        <p>If you have any feedback, suggestions, or inquiries, please do not hesitate to contact us. We highly value your input.</p>
                    </div>
                    <div class="mt-4">
                        <a href="{{ url('/kontak') }}" class="btn-1">Contact Us<i class="icon-arrow-1"></i></a>
                    </div>

                    <!-- Decorative elements -->
                    <div class="yellow-shape position-absolute" style="top: -20px; right: -20px; width: 100px; height: 100px; background-color: #ffd700; opacity: 0.2; border-radius: 50%;"></div>
                    <div class="pink-shape position-absolute" style="bottom: -30px; left: -30px; width: 150px; height: 150px; background-color: #ff69b4; opacity: 0.1; border-radius: 50%;"></div>
                </div>
            </div>
            
            <div class="col-lg-6">
                <div class="contact-image position-relative">
                    <img src="{{ asset('assets/images/resource/feedback.png') }}" alt="contact"">
                </div>
            </div>
            
        </div>
    </div>
</section>
<!-- contact page  -->

<!-- Partner Registration Steps -->
    {{-- <section class="registration-steps py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center mb-5">
                    <div class="common-title">
                        <h6><i class="fa-solid fa-angles-right"></i>REGISTRATION FLOW</h6>
                        <h3>Become a Member of Rotokemas</h3>
                        <p>Follow these steps to officially join the Packaging Industry Association – Rotokemas:</p>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                <!-- Step 1 -->
                <div class="col-lg-4 mb-4">
                    <div class="step-card position-relative bg-white rounded-lg p-4 h-100 shadow-sm">
                        <div class="step-number position-absolute" style="top: -15px; left: -15px; width: 40px; height: 40px; background-color: #007bff; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold;">1</div>
                        <div class="step-icon text-center mb-3">
                            <i class="fa-solid fa-graduation-cap fa-3x text-primary"></i>
                        </div>
                        <h4 class="text-center mb-3">Complete the Registration Form</h4>
                        <ul class="list-unstyled">
                            <li class="mb-3">
                                <i class="fa-solid fa-check text-success me-2"></i>
                                Access the official registration link provided by Rotokemas and fill in the required company and contact information accurately.
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Step 2 -->
                <div class="col-lg-4 mb-4">
                    <div class="step-card position-relative bg-white rounded-lg p-4 h-100 shadow-sm">
                        <div class="step-number position-absolute" style="top: -15px; left: -15px; width: 40px; height: 40px; background-color: #007bff; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold;">2</div>
                        <div class="step-icon text-center mb-3">
                            <i class="fa-solid fa-certificate fa-3x text-warning"></i>
                        </div>
                        <h4 class="text-center mb-3">Await Administrative Confirmation
                        </h4>
                        <ul class="list-unstyled">
                            <li class="mb-3">
                                <i class="fa-solid fa-check text-success me-2"></i>
                                After submitting your registration, please wait for confirmation from the Rotokemas administration team. You will be notified once your application has been reviewed.
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Step 3 -->
                <div class="col-lg-4 mb-4">
                    <div class="step-card position-relative bg-white rounded-lg p-4 h-100 shadow-sm">
                        <div class="step-number position-absolute" style="top: -15px; left: -15px; width: 40px; height: 40px; background-color: #007bff; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold;">3</div>
                        <div class="step-icon text-center mb-3">
                            <i class="fa-solid fa-handshake fa-3x text-success"></i>
                        </div>
                        <h4 class="text-center mb-3">Receive Official Membership Status</h4>
                        <ul class="list-unstyled">
                            <li class="mb-3">
                                <i class="fa-solid fa-check text-success me-2"></i>
                                Once approved, your company will be officially recognized as a member of Rotokemas and included in our member database.
                            </li>
                            </ul>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center mt-5">
                <div class="col-lg-8 text-center">
                    <h3 class="mb-3">Are you ready to be part of Rotokemas??</h3>
                </div>
            </div> --}}
        </div>
    </section>
@endsection
