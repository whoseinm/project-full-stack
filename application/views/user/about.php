  <?php $this->load->view('user/includes/header_style') ?>
  
  <?php $this->load->view('user/includes/navbar') ?>

  <main>

    <section class="slider-area slider-area2">
      <div class="slider-active">

        <div class="single-slider slider-height2">
          <div class="container">
            <div class="row">
              <div class="col-xl-8 col-lg-11 col-md-12">
                <div class="hero__caption hero__caption2">
                  <h1 data-animation="bounceIn" data-delay="0.2s">Haqqımızda</h1>

                  <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="<?php echo base_url('home') ?>">Ana səhifə</a></li>
                      <li class="breadcrumb-item"><a href="#">Haqqımızda</a></li>
                    </ol>
                  </nav>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>


    <?php foreach($about as $item){ ?>
          <section class="about-area1" style="width:100%!important;">
          <div class="support-wrapper align-items-center" style="margin: 50px 0px 50px 0px; width:100%!important;">
            <div class="left-content1" style="width:82%!important; text-align:center;">
              <div class="about-icon" >
                <img src="<?php echo base_url('assets/user/')?>img/icon/about.svg" alt="">
              </div>

              <div class="section-tittle section-tittle2 mb-45">
                <div class="front-text">
                  <h2 class=""><?php echo $item['about_title'] ?></h2>
                  <p><?php echo $item['about_description'] ?></p>
                </div>
              </div>

            </div>

          </div>
        </section>
    <?php } ?>


  </main>


  <?php $this->load->view('user/includes/footer') ?>