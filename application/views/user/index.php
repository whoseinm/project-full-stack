<?php $this->load->view('user/includes/header_style') ?>
<?php $this->load->view('user/includes/navbar') ?>

<div style=""></div>
<main>
  <section class="slider-area" style="background:#16164C;!important">
    <div class="slider-active">

      <div class="single-slider slider-height d-flex align-items-center" style="min-height: 800px!important;">
        <div class="container" style="margin-top: 150px; margin-bottom: 10px;">
          <div class="row">

            <div class="col-xl-6 col-lg-6 col-md-12" style="margin: 30px 0px;">
              <div class="hero__caption">

                <?php if ($item) { ?>
                  <img src="uploads/slider/<?php echo $item['slider_img'] ?>"
                    style="width: 500px; height: 400px; border-radius: 10px; background-size:cover;" alt="">

                <?php } ?>
              </div>

            </div>

            <div class="col-xl-6 col-lg-6 col-md-12">
              <div class="hero__caption">

                <?php if ($item) { ?>
                  <h1 data-animation="fadeInLeft" data-delay="0.2s">
                    <?php echo $item['slider_title'] ?>
                  </h1>
                  <p data-animation="fadeInLeft" data-delay="0.4s">
                    <?php echo $item['slider_description'] ?>
                  </p>
                  <a style="background: white!important; color: #16164C;" href="<?php echo $item['slider_link'] ?>"
                    target="_blank" class="btn hero-btn" data-animation="fadeInLeft" data-delay="0.7s">Ətraflı</a>

                <?php } else { ?>
                  <h1 data-animation="fadeInLeft" data-delay="0.2s">Stimul Education and Consulting</h1>
                  <p data-animation="fadeInLeft" data-delay="0.4s">Həyatınızın Stimulu
                  </p>
                  <a href="<?php echo base_url("courses") ?>" class="btn hero-btn" data-animation="fadeInLeft"
                    style="color:white" data-delay="0.7s">Kurslar</a>
                <?php } ?>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <div class="services-area" style="margin: 20px;">
    <div class="container">
      <div class="row justify-content-sm-center">
        <div class="col-lg-4 col-md-6 col-sm-8">
          <div class="single-services mb-30"
            style="box-shadow: rgba(0, 0, 0, 0.07) 0px 1px 2px, rgba(0, 0, 0, 0.07) 0px 2px 4px, rgba(0, 0, 0, 0.07) 0px 4px 8px, rgba(0, 0, 0, 0.07) 0px 8px 16px, rgba(0, 0, 0, 0.07) 0px 16px 32px, rgba(0, 0, 0, 0.07) 0px 32px 64px;">
            <div class="features-icon">
              <img src="<?php echo base_url('assets/user/') ?>img/icon/icon1.png" alt="">
            </div>
            <div class="features-caption">
              <h3 style="color: #16164C!important;">20+ Kurs sayısı</h3>
              <p style="color: #16164C!important;">Əsas sayı deyil əsas onların necə keçirildiyidir.</p>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-8">
          <div class="single-services mb-30"
            style="box-shadow: rgba(0, 0, 0, 0.07) 0px 1px 2px, rgba(0, 0, 0, 0.07) 0px 2px 4px, rgba(0, 0, 0, 0.07) 0px 4px 8px, rgba(0, 0, 0, 0.07) 0px 8px 16px, rgba(0, 0, 0, 0.07) 0px 16px 32px, rgba(0, 0, 0, 0.07) 0px 32px 64px;">
            <div class="features-icon">
              <img src="<?php echo base_url('assets/user/') ?>img/icon/icon2.svg" alt="">
            </div>
            <div class="features-caption" style="color: #16164C;">
              <h3 style="color: #16164C!important;">İşində Ekspert Treynerlər</h3>
              <p style="color: #16164C!important;">Müəllimlərimiz sizin üçün hər an hazırdırlar</p>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-8">
          <div class="single-services mb-30"
            style="box-shadow: rgba(0, 0, 0, 0.07) 0px 1px 2px, rgba(0, 0, 0, 0.07) 0px 2px 4px, rgba(0, 0, 0, 0.07) 0px 4px 8px, rgba(0, 0, 0, 0.07) 0px 8px 16px, rgba(0, 0, 0, 0.07) 0px 16px 32px, rgba(0, 0, 0, 0.07) 0px 32px 64px;">
            <div class="features-icon">
              <img src="<?php echo base_url('assets/user/') ?>img/icon/icon3.svg" alt="">
            </div>
            <div class="features-caption" style="color: #16164C;">
              <h3 style="color: #16164C!important;">Yaxşı Kurslar</h3>
              <p style="color: #16164C!important;">Ən yaxşı kursları siz sadəcə burda tapa bilərsiniz.</p>
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
            <h2><a href="<?php echo base_url('courses') ?>" style="text-decoration:none; color:#16164C;">Kurslarımız</a>
            </h2>
          </div>
        </div>
      </div>
      <div class="courses-actives">

        <?php foreach ($get_all_courses as $item) { ?>
          <?php if ($item['course_status'] == "Active") { ?>

            <?php if ($item['course_img']) { ?>
              <div class="col-lg-4">
                <div class="properties properties2 mb-30">
                  <div class="properties__card">
                    <div class="properties__img overlay1">
                      <a href="<?php echo base_url("course_single/" . $item['course_id']) ?>"><img
                          style="width:100%; height:330px; object-fit: contain;"
                          src="<?php echo base_url('uploads/courses/' . $item['course_img']) ?>" alt=""></a>
                    </div>

                    <div class="properties__caption">
                      <h3><a href="#">
                          <p>
                            <?php echo $item['course_duration'] ?>
                          </p>
                          <?php echo mb_strimwidth($item['course_name'], 0, 26, "..."); ?>

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
                      <a href="<?php echo base_url("course_single/" . $item['course_id']) ?>"
                        class="border-btn border-btn2">Daha Çox</a>
                    </div>

                  </div>
                </div>
              </div>
            <?php } else { ?>
              <div class="col-lg-4">
                <div class="properties properties2 mb-30">
                  <div class="properties__card">
                    <div class="properties__img overlay1">
                      <a href="<?php echo base_url("course_single/" . $item['course_id']) ?>"><img
                          style="width:100%; height:330px; object-fit: contain; background:white;"
                          src="<?php echo base_url('uploads/courses/logo.png') ?>" alt=""></a>
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
                      <a href="<?php echo base_url("course_single/" . $item['course_id']) ?>"
                        class="border-btn border-btn2">Daha Çox</a>
                    </div>

                  </div>
                </div>
              </div>
            <?php } ?>

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
            <h2 style="color: #16164C;">Məşhur Təlimlər</h2>
          </div>
        </div>
      </div>
      <div class="row">
        <?php foreach ($get_limit_10_category as $item) { ?>
          <div class="col-xs-12 col-lg-3 col-md-4 col-sm-6">
            <div class="single-topic text-center mb-30">
              <div class="topic-img">
                <div class="bg_gradient" style="background:#16164C; height:170px; border-radius: 10px;">
                </div>
                <div class="topic-content-box">
                  <div class="topic-content">
                    <h3><a href="<?php echo base_url("categories/" . $item['category_id']) ?>"
                        style="text-decoration: none;">
                        <?php echo $item['category_title'] ?>
                      </a></h3>
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
          <img src="<?php echo base_url('assets/user/') ?>img/gallery/about2.png" alt="">
        </div>
      </div>
      <div class="left-content2">

        <div class="section-tittle section-tittle2 mb-20">
          <div class="front-text">
            <h2 style="color: #16164C;!important">Şəxsi və peşəkar məqsədlərinizə doğru növbəti addımı bizimlə atın.
            </h2>
            <a style="background: #16164C!important; color: white;" href="<?php echo base_url('contact') ?>"
              target="_blank" class="btn hero-btn" data-animation="fadeInLeft" data-delay="0.7s">Ətraflı</a>
          </div>
        </div>
      </div>
    </div>
  </section>

</main>

<iframe
  src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d12156.2440604024!2d49.8286822!3d40.3853403!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x40307d9bdc74118b%3A0xc8377414faa8f86b!2sSTIMUL%20Education%20%26%20Consulting!5e0!3m2!1saz!2saz!4v1683124025755!5m2!1saz!2saz"
  width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
  referrerpolicy="no-referrer-when-downgrade"></iframe>

<?php $this->load->view('user/includes/footer') ?>