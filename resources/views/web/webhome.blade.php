@extends('web.layouts.web-layouts')

@section('webcontent')

<!-- ======= Hero Section ======= -->
<section id="hero">
  <div id="heroCarousel" data-bs-interval="5000" class="carousel slide carousel-fade" data-bs-ride="carousel">

    <div class="carousel-inner" role="listbox">

      <!-- Slide 1 -->
      <div class="carousel-item active" style="background-image: url(assets/img/slide/slide-1.jpg);">
        <div class="carousel-container">
          <div class="carousel-content animate__animated animate__fadeInUp">
            <h2>Welcome to <span>Flattern</span></h2>
            <p>Ut velit est quam dolor ad a aliquid qui aliquid. Sequi ea ut et est quaerat sequi nihil ut aliquam.
              Occaecati alias dolorem mollitia ut. Similique ea voluptatem. Esse doloremque accusamus repellendus
              deleniti vel. Minus et tempore modi architecto.</p>
            <div class="text-center"><a href="" class="btn-get-started">Read More</a></div>
          </div>
        </div>
      </div>

      <!-- Slide 2 -->
      <div class="carousel-item" style="background-image: url(assets/img/slide/slide-2.jpg);">
        <div class="carousel-container">
          <div class="carousel-content animate__animated animate__fadeInUp">
            <h2>Lorem Ipsum Dolor</h2>
            <p>Ut velit est quam dolor ad a aliquid qui aliquid. Sequi ea ut et est quaerat sequi nihil ut aliquam.
              Occaecati alias dolorem mollitia ut. Similique ea voluptatem. Esse doloremque accusamus repellendus
              deleniti vel. Minus et tempore modi architecto.</p>
            <div class="text-center"><a href="" class="btn-get-started">Read More</a></div>
          </div>
        </div>
      </div>

      <!-- Slide 3 -->
      <div class="carousel-item" style="background-image: url(assets/img/slide/slide-3.jpg);">
        <div class="carousel-container">
          <div class="carousel-content animate__animated animate__fadeInUp">
            <h2>Sequi ea ut et est quaerat</h2>
            <p>Ut velit est quam dolor ad a aliquid qui aliquid. Sequi ea ut et est quaerat sequi nihil ut aliquam.
              Occaecati alias dolorem mollitia ut. Similique ea voluptatem. Esse doloremque accusamus repellendus
              deleniti vel. Minus et tempore modi architecto.</p>
            <div class="text-center"><a href="" class="btn-get-started">Read More</a></div>
          </div>
        </div>
      </div>

    </div>

    <a class="carousel-control-prev" href="#heroCarousel" role="button" data-bs-slide="prev">
      <span class="carousel-control-prev-icon bx bx-left-arrow" aria-hidden="true"></span>
    </a>

    <a class="carousel-control-next" href="#heroCarousel" role="button" data-bs-slide="next">
      <span class="carousel-control-next-icon bx bx-right-arrow" aria-hidden="true"></span>
    </a>

    <ol class="carousel-indicators" id="hero-carousel-indicators"></ol>

  </div>
</section><!-- End Hero -->

<main id="main">

  <!-- ======= Cta Section ======= -->
  <section id="cta" class="cta">
    <div class="container">

      <div class="row">
        <div class="col-lg-12 text-center text-lg-left">
          <h3>ইডেন মহিলা কলেজে <span>স্বাগতম</span> আপনাকে</h3>
          <p> ইডেন মহিলা কলেজ একটি প্রাখ্যাত প্রাচীন ও ঐতিহ্যবাহী শিক্ষা প্রতিষ্ঠান। বিগত এক শতাব্দিতে যে শিক্ষিত,
            জাগ্রত, সচেতন, স্বাধীন চিন্তামনস্ক অগ্রসারমান নারীসমাজ এদেশে গড়ে উঠেছে তার মৃত্তিকাগর্ভ ইডেন মহিলা কলেজ।
            বায়ান্নর ভাষা আন্দোলন, ঊনসত্তরের গণঅভ্যুত্থান এবং একাত্তরের মহান মুক্তিযুদ্ধে ইডেন মহিলা কলেজের
            শিক্ষার্থীদের প্রত্যক্ষ, প্রতিবাদী ও সাহসী ভূমিকা রয়েছে। বর্তমানেও দেশচালনা, প্রশাসন, রাজনীতি, শিক্ষা,
            গবেষণা, বিজ্ঞান-প্রকৌশল-আদিপত্য-প্রযুক্তি, পুলিশ তথা কর্মের সকল ক্ষেত্রে ইডেন মহিলা কলেজের ছাত্রীদের রয়েছে
            গর্বিত বিচরণ।
            নারী শিক্ষার বৃহৎ ও অনন্য শিক্ষা প্রতিষ্ঠান ইডেন মহিলা কলেজের ১৫০ বছরের পথ পরিক্রমণের ইতিহাস রয়েছে।
            ‘শুভস্বাধিনী সেবা’ নামক সংঘের নারীহিত চিন্তা থেকে ১৮৭৩ সালে স্বল্পসংখ্যাক বিদ্যার্থী নিয়ে একটি ক্ষুদ্র
            শিক্ষা প্রতিষ্ঠান ভূমিষ্ঠ হয়েছিল তা আজ মহাগৌরবে</p>

          <a class="cta-btn align-middle" href="#">Request a quote</a>
        </div>

      </div>

    </div>
  </section><!-- End Cta Section -->


  <section class="principal-message-section">
    <div class="container principal-container">
      <div class="row">
        <div class="col-md-4 text-center mb-4 mb-md-0">
          <div class="image-container" data-aos="fade-right">
            <img src="assets/img/blog/blog-author.jpg" height="200" class="principal-image float-left" alt="">
          </div>
        </div>
        <div class="col-md-8">
          <div class="principal-message" data-aos="fade-left">
            <h2>অধ্যক্ষের বাণী</h2>
            <p>ইডেন মহিলা কলেজ একটি প্রাখ্যাত প্রাচীন ও ঐতিহ্যবাহী শিক্ষা প্রতিষ্ঠান। বিগত এক শতাব্দিতে যে শিক্ষিত,
              জাগ্রত, সচেতন, স্বাধীন চিন্তামনস্ক অগ্রসারমান নারীসমাজ এদেশে গড়ে উঠেছে তার মৃত্তিকাগর্ভ ইডেন মহিলা কলেজ।
              বায়ান্নর ভাষা আন্দোলন, ঊনসত্তরের গণঅভ্যুত্থান এবং একাত্তরের মহান মুক্তিযুদ্ধে ইডেন মহিলা কলেজের
              শিক্ষার্থীদের প্রত্যক্ষ, প্রতিবাদী ও সাহসী ভূমিকা রয়েছে। বর্তমানেও দেশচালনা, প্রশাসন, রাজনীতি, শিক্ষা,
              গবেষণা, বিজ্ঞান-প্রকৌশল-আদিপত্য-প্রযুক্তি, পুলিশ তথা কর্মের সকল ক্ষেত্রে ইডেন মহিলা কলেজের ছাত্রীদের
              রয়েছে গর্বিত বিচরণ। নারী শিক্ষার বৃহৎ ও অনন্য শিক্ষা প্রতিষ্ঠান ইডেন মহিলা কলেজের ১৫০ বছরের পথ
              পরিক্রমণের ইতিহাস রয়েছে।</p>
            <!-- Add more content or styling as needed -->
          </div>
        </div>
      </div>
    </div>
  </section>


  <section id="features" class="features mt-5">
    <div class="container">

      <div class="section-title" data-aos="fade-up">
        <h2>কলেজ <strong>নোটিশ বোর্ড</strong> সকল তথ্য</h2>
        <p>আপনি এখান থেকে সকল নোটিশ, ইভেন্ট, সেমিনার, ওয়ার্কশপ ও অন্যান্য তথ্য পাবেন</p>
      </div>

      <div class="row">
        <div class="col-lg-4 mb-5 mb-lg-0" data-aos="fade-right">
          <ul class="nav nav-tabs flex-column">
            <li class="nav-item">
              <a class="nav-link active show" data-bs-toggle="tab" href="#tab-1">
                <h4>একাডেমিক</h4>
                <p>সকল প্রকার একাডেমিক তথ্য</p>
              </a>
            </li>
            <li class="nav-item mt-2">
              <a class="nav-link" data-bs-toggle="tab" href="#tab-2">
                <h4>ইভেন্ট</h4>
                <p>সকল প্রকার ইভেন্টের তথ্য</p>
              </a>
            </li>
            <li class="nav-item mt-2">
              <a class="nav-link" data-bs-toggle="tab" href="#tab-3">
                <h4>বিজ্ঞপ্তি</h4>
                <p>সকল প্রকার বিজ্ঞপ্তি</p>
              </a>
            </li>
            <li class="nav-item mt-2">
              <a class="nav-link" data-bs-toggle="tab" href="#tab-4">
                <h4>এন ও সি</h4>
                <p>সকল প্রকার এন ও সি তথ্য</p>
              </a>
            </li>
          </ul>
        </div>
        <div class="col-lg-8 ml-auto" data-aos="fade-left" data-aos-delay="100">
          <div class="tab-content">
            <div class="tab-pane active show" id="tab-1">
              <table class="table table-bordered notices">
                <thead>
                  <tr style="background-color: #007bff;">
                    <th>#</th>
                    <th>তারিখ</th>
                    <th>নোটিস শিরোনাম</th>
                    <th>বিবরণ</th>
                    <th>পোস্ট করেছে</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row">1</th>
                    <td>2024-03-05</td>
                    <td>গুরুত্বপূর্ণ ঘোষণা</td>
                    <td>লোরেম ইপসাম ডোলর সিট অ্যামেট, কনসেক্টেটুর অ্যাডিপিসিং এলিট।</td>
                    <td>অ্যাডমিন</td>
                  </tr>
                  <tr>
                    <th scope="row">2</th>
                    <td>2024-03-06</td>
                    <td>মনে রাখতে হবে: পরীক্ষার সময়সূচি</td>
                    <td>কুইস ভেস্টিবুলাম ড্যাপিবাস ডিয়াম, ইউ টিনসিডান্ট নুল্লা ভেনেনাটিস ভেল।</td>
                    <td>শিক্ষক</td>
                  </tr>
                  <tr>
                    <th scope="row">3</th>
                    <td>2024-03-08</td>
                    <td>ক্যাম্পাস ইভেন্ট: সাংস্কৃতিক রাত</td>
                    <td>সেড এট এরোস এইউ তুর্পিস ভিভারা কমদো এগেট সেড লিবেরো।</td>
                    <td>ছাত্র কর্মকর্তা</td>
                  </tr>
                  <tr>
                    <th scope="row">4</th>
                    <td>2024-03-10</td>
                    <td>লাইব্রেরি বন্ধ</td>
                    <td>ভিভামুস টেমপাস, টুর্পিস সিট আমেট ভিভারা কমদো মি।</td>
                    <td>লাইব্রেরি কর্মকর্তা</td>
                  </tr>
                  <tr>
                    <th scope="row">5</th>
                    <td>2024-03-12</td>
                    <td>ক্লাস পুনঃসূচনা</td>
                    <td>নুল্লাম এট লিও কুইস নুংক ত্রিস্টিক অ্যাকমুসান এগেট উট অডিও।</td>
                    <td>রেজিস্ট্রার</td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="tab-pane" id="tab-2">
              <figure>
                <img src="assets/img/features-2.png" alt="" class="img-fluid">
              </figure>
            </div>
            <div class="tab-pane" id="tab-3">
              <figure>
                <img src="assets/img/features-3.png" alt="" class="img-fluid">
              </figure>
            </div>
            <div class="tab-pane" id="tab-4">
              <figure>
                <img src="assets/img/features-4.png" alt="" class="img-fluid">
              </figure>
            </div>
          </div>
        </div>
      </div>

    </div>
  </section><!-- End Features Section -->


  <section class="menu-section">
    <div class="container">
      <div class="row">
        @foreach($provider_menusWithSubMenus as $menu)
        @if($menu->is_home == 1)
        <div class="col-sm-4 col-12 mb-4">
          <div class="menu-box d-flex flex-column h-100">
            <div class="col-sm-12 col-12 pt-3 pb-2" id="cart" data-aos="fade-in" data-aos-duration="1000">
              <p class="session" style="font-weight: bold">&nbsp;&nbsp;{{ $menu->menu_name }}</p>
              <div class="row">
                <div class="col-sm-3 col-3">
                  <img width="200" src="{{ asset('storage/img/menu_img/'.$menu->upload) }}" class="img-fluid">
                </div>
                <div class="col-sm-9 col-9 p-0">
                  <ul class="menus">

                    @foreach($menu->subMenus as $subMenu)
                        <li><i class="fa fa-caret-right"></i><a href="{{ $subMenu->submenu_slug }}">{{ $subMenu->submenu_name }}</a></li>
                    @endforeach
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
        @endif
        @endforeach


      </div>


    </div>
  </section>

  <!-- ======= Services Section ======= -->
  <section id="services" class="services" style="background-color: antiquewhite;">
    <div class="container">

      <div class="row">
        <div class="col-lg-4 col-md-6">
          <div class="icon-box" data-aos="fade-up">
            <div class="icon"><i class="bi bi-briefcase"></i></div>
            <h4 class="title" style="text-align: left;"><a href="">Lorem Ipsum</a></h4>
            <p class="description">Voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint
              occaecati cupiditate non provident</p>
          </div>
        </div>
        <div class="col-lg-4 col-md-6">
          <div class="icon-box" data-aos="fade-up" data-aos-delay="100">
            <div class="icon"><i class="bi bi-card-checklist"></i></div>
            <h4 class="title"><a href="">Dolor Sitema</a></h4>
            <p class="description">Minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
              commodo consequat tarad limino ata</p>
          </div>
        </div>
        <div class="col-lg-4 col-md-6">
          <div class="icon-box" data-aos="fade-up" data-aos-delay="200">
            <div class="icon"><i class="bi bi-bar-chart"></i></div>
            <h4 class="title"><a href="">Sed ut perspiciatis</a></h4>
            <p class="description">Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
              fugiat nulla pariatur</p>
          </div>
        </div>
        <div class="col-lg-4 col-md-6">
          <div class="icon-box" data-aos="fade-up" data-aos-delay="200">
            <div class="icon"><i class="bi bi-binoculars"></i></div>
            <h4 class="title"><a href="">Magni Dolores</a></h4>
            <p class="description">Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt
              mollit anim id est laborum</p>
          </div>
        </div>
        <div class="col-lg-4 col-md-6">
          <div class="icon-box" data-aos="fade-up" data-aos-delay="300">
            <div class="icon"><i class="bi bi-brightness-high"></i></div>
            <h4 class="title"><a href="">Nemo Enim</a></h4>
            <p class="description">At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis
              praesentium voluptatum deleniti atque</p>
          </div>
        </div>
        <div class="col-lg-4 col-md-6">
          <div class="icon-box" data-aos="fade-up" data-aos-delay="400">
            <div class="icon"><i class="bi bi-calendar4-week"></i></div>
            <h4 class="title"><a href="">Eiusmod Tempor</a></h4>
            <p class="description">Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum
              soluta nobis est eligendi</p>
          </div>
        </div>
      </div>

    </div>
  </section><!-- End Services Section -->

  <!-- ======= Portfolio Section ======= -->
  <section id="portfolio" class="portfolio" style="background-color: #f3f1f0;">
    <div class="container">

      <div class="row" data-aos="fade-up">
        <div class="col-lg-12 d-flex justify-content-center">
          <ul id="portfolio-flters">
            <li data-filter="*" class="filter-active">All</li>
            <li data-filter=".filter-app">App</li>
            <li data-filter=".filter-card">Card</li>
            <li data-filter=".filter-web">Web</li>
          </ul>
        </div>
      </div>

      <div class="row portfolio-container" data-aos="fade-up">

        <div class="col-lg-4 col-md-6 portfolio-item filter-app">
          <img src="assets/img/portfolio/portfolio-1.jpg" class="img-fluid" alt="">
          <div class="portfolio-info">
            <h4>App 1</h4>
            <p>App</p>
            <a href="assets/img/portfolio/portfolio-1.jpg" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="App 1"><i class="bx bx-plus"></i></a>
            <a href="portfolio-details.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
          </div>
        </div>

        <div class="col-lg-4 col-md-6 portfolio-item filter-web">
          <img src="assets/img/portfolio/portfolio-2.jpg" class="img-fluid" alt="">
          <div class="portfolio-info">
            <h4>Web 3</h4>
            <p>Web</p>
            <a href="assets/img/portfolio/portfolio-2.jpg" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="Web 3"><i class="bx bx-plus"></i></a>
            <a href="portfolio-details.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
          </div>
        </div>

        <div class="col-lg-4 col-md-6 portfolio-item filter-app">
          <img src="assets/img/portfolio/portfolio-3.jpg" class="img-fluid" alt="">
          <div class="portfolio-info">
            <h4>App 2</h4>
            <p>App</p>
            <a href="assets/img/portfolio/portfolio-3.jpg" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="App 2"><i class="bx bx-plus"></i></a>
            <a href="portfolio-details.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
          </div>
        </div>

        <div class="col-lg-4 col-md-6 portfolio-item filter-card">
          <img src="assets/img/portfolio/portfolio-4.jpg" class="img-fluid" alt="">
          <div class="portfolio-info">
            <h4>Card 2</h4>
            <p>Card</p>
            <a href="assets/img/portfolio/portfolio-4.jpg" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="Card 2"><i class="bx bx-plus"></i></a>
            <a href="portfolio-details.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
          </div>
        </div>

        <div class="col-lg-4 col-md-6 portfolio-item filter-web">
          <img src="assets/img/portfolio/portfolio-5.jpg" class="img-fluid" alt="">
          <div class="portfolio-info">
            <h4>Web 2</h4>
            <p>Web</p>
            <a href="assets/img/portfolio/portfolio-5.jpg" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="Web 2"><i class="bx bx-plus"></i></a>
            <a href="portfolio-details.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
          </div>
        </div>

        <div class="col-lg-4 col-md-6 portfolio-item filter-app">
          <img src="assets/img/portfolio/portfolio-6.jpg" class="img-fluid" alt="">
          <div class="portfolio-info">
            <h4>App 3</h4>
            <p>App</p>
            <a href="assets/img/portfolio/portfolio-6.jpg" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="App 3"><i class="bx bx-plus"></i></a>
            <a href="portfolio-details.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
          </div>
        </div>

        <div class="col-lg-4 col-md-6 portfolio-item filter-card">
          <img src="assets/img/portfolio/portfolio-7.jpg" class="img-fluid" alt="">
          <div class="portfolio-info">
            <h4>Card 1</h4>
            <p>Card</p>
            <a href="assets/img/portfolio/portfolio-7.jpg" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="Card 1"><i class="bx bx-plus"></i></a>
            <a href="portfolio-details.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
          </div>
        </div>

        <div class="col-lg-4 col-md-6 portfolio-item filter-card">
          <img src="assets/img/portfolio/portfolio-8.jpg" class="img-fluid" alt="">
          <div class="portfolio-info">
            <h4>Card 3</h4>
            <p>Card</p>
            <a href="assets/img/portfolio/portfolio-8.jpg" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="Card 3"><i class="bx bx-plus"></i></a>
            <a href="portfolio-details.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
          </div>
        </div>

        <div class="col-lg-4 col-md-6 portfolio-item filter-web">
          <img src="assets/img/portfolio/portfolio-9.jpg" class="img-fluid" alt="">
          <div class="portfolio-info">
            <h4>Web 3</h4>
            <p>Web</p>
            <a href="assets/img/portfolio/portfolio-9.jpg" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="Web 3"><i class="bx bx-plus"></i></a>
            <a href="portfolio-details.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
          </div>
        </div>

      </div>

    </div>
  </section><!-- End Portfolio Section -->

  <!-- ======= Our Clients Section ======= -->
  <section id="clients" class="clients">
    <div class="container">

      <div class="section-title" data-aos="fade-up">
        <h2>Our <strong>Clubs</strong></h2>
        <p>Our college has some beautifull active clubs for the development of our students</p>
      </div>

      <div class="row no-gutters clients-wrap clearfix" data-aos="fade-up">

        <div class="col-lg-3 col-md-4 col-xs-6 mb-2">
          <div class="client-logo">
            <img src="assets/img/clients/client-1.png" class="img-fluid" alt="">
          </div>
        </div>

        <div class="col-lg-3 col-md-4 col-xs-6">
          <div class="client-logo">
            <img src="assets/img/clients/client-2.png" class="img-fluid" alt="">
          </div>
        </div>

        <div class="col-lg-3 col-md-4 col-xs-6">
          <div class="client-logo">
            <img src="assets/img/clients/client-3.png" class="img-fluid" alt="">
          </div>
        </div>

        <div class="col-lg-3 col-md-4 col-xs-6">
          <div class="client-logo">
            <img src="assets/img/clients/client-4.png" class="img-fluid" alt="">
          </div>
        </div>

        <div class="col-lg-3 col-md-4 col-xs-6">
          <div class="client-logo">
            <img src="assets/img/clients/client-5.png" class="img-fluid" alt="">
          </div>
        </div>

        <div class="col-lg-3 col-md-4 col-xs-6">
          <div class="client-logo">
            <img src="assets/img/clients/client-6.png" class="img-fluid" alt="">
          </div>
        </div>

        <div class="col-lg-3 col-md-4 col-xs-6">
          <div class="client-logo">
            <img src="assets/img/clients/client-7.png" class="img-fluid" alt="">
          </div>
        </div>

        <div class="col-lg-3 col-md-4 col-xs-6">
          <div class="client-logo">
            <img src="assets/img/clients/client-8.png" class="img-fluid" alt="">
          </div>
        </div>

      </div>

    </div>
  </section><!-- End Our Clients Section -->

</main><!-- End #main -->

@endsection
