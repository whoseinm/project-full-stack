<?php $this->load->view('user/includes/header_style') ?>
<?php $this->load->view('user/includes/navbar') ?>

<main>

  <section class="slider-area slider-area2" >
    <div class="slider-active">

      <div class="single-slider slider-height3" style="height: 500px; display: flex; align-items:center;">
        <div class="container">
          <div class="row">
            <div class="col-xl-8 col-lg-12 col-md-12">
              <div class="hero__caption hero__caption2">
                <h1 data-animation="bounceIn" data-delay="0.2s">Kurslarımız</h1>

                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo base_url('home') ?>">Ana səhifə</a></li>
                    <li class="breadcrumb-item"><a href="#">Kurslarımız</a></li>
                  </ol>
                </nav>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <div class="courses-area section-padding40 fix">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-xl-7 col-lg-8">
          <div class="section-tittle text-center mb-55">
            <h2 style="color: #16164C;">Kurslarımız</h2>
          </div>
        </div>
      </div>
      <div class="row">

        <?php foreach ($get_all_courses as $item) { ?>
          <?php if ($item['course_status'] == "Active") { ?>
            <div class="col-lg-4">
              <div class="properties properties2 mb-30">
                <div class="properties__card">
                  <div class="properties__img overlay1">

                  <?php if($item['course_img']){ ?>
                    <a href="<?php echo base_url("course_single/" . $item['course_id']."/".  str_replace(' ', '-', $item['course_name'])) ?>"><img
                        style="width:100%; height:340px; object-fit: contain;"
                        src="<?php echo base_url('uploads/courses/' . $item['course_img']) ?>" alt=""></a>
                  <?php }else{ ?>
                    <a href="<?php echo base_url("course_single/" . $item['course_id']) ?>"><img
                        style="width:100%; height:340px; object-fit: contain; background:white;"
                        src="<?php echo base_url('uploads/courses/logo.png') ?>" alt=""></a>
                  <?php } ?>
                    
                  </div>

                  <div class="properties__caption">
                    <h3><a href="#">
                        <p>
                          <?php echo $item['course_duration'] ?>
                        </p>
                        <?php echo mb_strimwidth($item['course_name'], 0, 26, "...");?>
                      </a></h3>
                    <div class="properties__footer d-flex justify-content-between align-items-center">
                      <div class="restaurant-name">
                        <div style="margin-top:10px;">
                          <?php if ($item['trainer_img']) { ?>
                            <img width="40px" height="40px" style="border-radius:50%; object-fit:cover;"
                              src="<?php echo base_url('uploads/trainers/' . $item['trainer_img']); ?>" alt="trainer_img">
                            <a href="<?php echo base_url("trainer_single/" . $item['trainer_id']) ?>"
                              style="color:#16164C; font-size: 17px;">
                              <?php echo $item['trainer_name'] ?>
                            </a>
                          <?php } else { ?>
                            <img width="40px" height="40px" style="border-radius:50%;"
                              src="<?php echo base_url('uploads/trainers/logo.png'); ?>" alt="trainer_img">
                            <a href="<?php echo base_url("trainer_single/" . $item['trainer_id']) ?>"
                              style="color:#6E7697; font-size: 17px;">
                              <?php echo $item['trainer_name'] ?>
                            </a>
                          <?php } ?>

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


      </div>
    </div>






</main>
<?php $this->load->view('user/includes/footer') ?>