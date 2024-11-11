@extends('frontend.master')

@section("title", "About")

@section('content')

    <!-- page wapper-->

    <?php

    $wwrTitle = SM::smGetThemeOption("wwr_title");

    $wwrSubtitle = SM::smGetThemeOption("wwr_subtitle");

    $wwrDescription = SM::smGetThemeOption("wwr_description");

    $ourMission = SM::smGetThemeOption("our_mission");

    $ourVision = SM::smGetThemeOption("our_vision");

    $histories = SM::smGetThemeOption("histories");

    $historiesCount = $histories;

    $title = SM::smGetThemeOption("about_banner_title");

    $subtitle = SM::smGetThemeOption("about_banner_subtitle");

    $bannerImage = SM::smGetThemeOption("about_banner_image");

    ?>

    <div class="container">
<section class="page-banner-section contact-banner-section">
<div class="row">
        <div class="col-md-12">
            <div class="blog-banner-sec " style="background:url( /storage/uploads/slider-2_1.jpg) no-repeat center center /cover">
                    <div class="blog-banner-contents text-center">
                            <h1>About Us</h1>

                    </div>
                </div>
            </div>
         </div>

    </section>
     </div>
   <section class="about-us-section">
       <div class="container">
           <div class="row">
               <div class="col-md-12"> 

                  <div class="section-title-about">
                   <h2>{{ $wwrSubtitle }}</h2>
                   <p>{!! stripslashes($wwrDescription) !!} </p>
                    <img src="http://zenvobd.com/storage/uploads/slider-3.jpg" class="img-responsive" style="margin-top: 20px;">
               </div>
                </div>
           </div>
       </div>
   </section>
   <section class="about-us-section" style="background-color: #f5f5f5;">
       <div class="container">
           <div class="row">
               <div class="col-md-4">
                   <img src="http://zenvobd.com/storage/uploads/brochure.jpg" class="img-responsive" style="margin-top: 20px;">
               </div>
               <div class="col-md-8">
                   <div class="section-title-our-about">
                   <h2>ABOUT SB Fashion</h2>
                   

                    
               </div>
               </div>
           </div>
       </div>
   </section>
   <section class="about-us-section">
       <div class="container">
           <div class="row">
               <div class="section-title-about history">
                   <h2>History</h2>
                   <p>{!! stripslashes($histories) !!} </p>
                    <img src="http://zenvobd.com/storage/uploads/slider-2.jpg" class="img-responsive" style="margin-top: 20px;">
               </div>
           </div>
       </div>
   </section>
   <section class="about-us-section" style="background-color: #f5f5f5;">
       <div class="container">
           <div class="row">
               
               <div class="col-md-12">
                   <div class="section-title-our-about our_avai">
                   <h2>Our Mission </h2>
                    <p>{!! stripslashes($ourMission) !!} </p>
                   </div>
               </div>
           </div>
       </div>
   </section>
   <section class="about-us-section" style="background-color: #f5f5f5;">
       <div class="container">
           <div class="row">
               
               <div class="col-md-12">
                   <div class="section-title-our-about our_avai">
                   <h2>Our Vision </h2>
                    <p>{!! stripslashes($ourVision) !!} </p>
                   </div>
               </div>
           </div>
       </div>
   </section>
@endsection