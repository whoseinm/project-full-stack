  <?php $this->load->view('user/includes/header_style') ?>
  <?php $this->load->view('user/includes/navbar') ?>

  <main>

    <section class="slider-area ">
      <div class="slider-active">

        <div class="single-slider slider-height d-flex align-items-center">
          <div class="container">
            <div class="row">
              <div class="col-xl-6 col-lg-7 col-md-12">
                <div class="hero__caption">
                  <h1 data-animation="fadeInLeft" data-delay="0.2s">Online learning<br> platform</h1>
                  <p data-animation="fadeInLeft" data-delay="0.4s">Build skills with courses, certificates, and degrees
                    online from world-class universities and companies</p>
                  <a href="#" class="btn hero-btn" data-animation="fadeInLeft" data-delay="0.7s">Join for Free</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <div class="services-area">
      <div class="container">
        <div class="row justify-content-sm-center">
          <div class="col-lg-4 col-md-6 col-sm-8">
            <div class="single-services mb-30">
              <div class="features-icon">
                <img src="<?php echo base_url('assets/user/')?>img/icon/icon1.svg" alt="">
              </div>
              <div class="features-caption">
                <h3>20+ Kurs sayısı</h3>
                <p>Əsas sayı deyil əsas onların necə keçirildiyidir.</p>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 col-sm-8">
            <div class="single-services mb-30">
              <div class="features-icon">
                <img src="<?php echo base_url('assets/user/')?>img/icon/icon2.svg" alt="">
              </div>
              <div class="features-caption">
                <h3>İşində Ekspert Treynerlər</h3>
                <p>Müəllimlərimiz sizin üçün hər an hazırdırlar</p>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 col-sm-8">
            <div class="single-services mb-30">
              <div class="features-icon">
                <img src="<?php echo base_url('assets/user/')?>img/icon/icon3.svg" alt="">
              </div>
              <div class="features-caption">
                <h3>Yaxşı Kurslar</h3>
                <p>Ən yaxşı kursları siz sadəcə burda tapa bilərsiniz.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="courses-area section-padding40 fix">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-xl-7 col-lg-8">
            <div class="section-tittle text-center mb-55">
              <h2><a href="<?php echo base_url('courses')?>" style="text-decoration:none; color:#4255A4;">Kurslarımız</a></h2>
            </div>
          </div>
        </div>
        <div class="courses-actives">

        <?php foreach ($get_all_courses as $item) { ?>
          <?php if ($item['course_status'] == "Active") { ?>
            <div class="col-lg-4">
              <div class="properties properties2 mb-30">
                <div class="properties__card">
                  <div class="properties__img overlay1">
                    <a href="#"><img style="width:100%; height:250px; object-fit: cover;" src="<?php echo base_url('uploads/courses/' . $item['course_img']) ?>" alt=""></a>
                  </div>

                  <div class="properties__caption">
                    <h3><a href="#">
                        <p>
                          <?php echo $item['course_duration'] ?>
                        </p>
                        <?php echo $item['course_name'] ?>
                      </a></h3>
                    <div class="properties__footer d-flex justify-content-between align-items-center">
                      <div class="restaurant-name">
                        <div>
                          <img width="40px" height="40px" style="border-radius:50%;"
                            src="<?php echo base_url('uploads/trainers/' . $item['trainer_img']); ?>" alt="trainer_img">
                          <p style="color:#6E7697; font-size: 17px;">
                            <?php echo $item['trainer_name'] ?>
                          </p>
                        </div>
                      </div>
                    </div>
                    <a href="#" class="border-btn border-btn2">Daha Çox</a>
                  </div>
                  
                </div>
              </div>
            </div>
          <?php } ?>
        <?php } ?>

        </div>
      </div>
    </div>


    


    <div class="topic-area section-padding40">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-xl-7 col-lg-8">
            <div class="section-tittle text-center mb-55">
              <h2>Məşhur Kategoriyalar</h2>
            </div>
          </div>
        </div>
        <div class="row">
        <?php foreach($get_all_categories as $item){ ?>
          <div class="col-lg-3 col-md-4 col-sm-6">
            <div class="single-topic text-center mb-30">
              <div class="topic-img">
                <div style="background:linear-gradient(to bottom, #c054ff 0%, #5274ff 100%); height:170px; width:270px; border-radius: 10px;"></div>
                <div class="topic-content-box">
                  <div class="topic-content">
                    <h3><a href="#" style="text-decoration: none;"><?php echo $item['category_title'] ?></a></h3>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <?php } ?>
        </div>
      </div>
    </div>


  

    <section class="about-area2 fix pb-padding">
      <div class="support-wrapper align-items-center">
        <div class="right-content2">

          <div class="right-img">
            <img src="<?php echo base_url('assets/user/')?>img/gallery/about2.png" alt="">
          </div>
        </div>
        <div class="left-content2">

          <div class="section-tittle section-tittle2 mb-20">
            <div class="front-text">
              <h2 class="">Şəxsi və peşəkar məqsədlərinizə doğru növbəti addımı bizimlə atın.</h2>
              <a href="<?php echo base_url('contact') ?>" class="btn">Əlaqə</a>
            </div>
          </div>
        </div>
      </div>
    </section>

  </main>

  <?php $this->load->view('user/includes/footer') ?>