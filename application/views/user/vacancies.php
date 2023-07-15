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
                <h1 data-animation="bounceIn" data-delay="0.2s">Vakansiyalar</h1>

                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo base_url('home') ?>">Ana səhifə</a></li>
                    <li class="breadcrumb-item"><a href="#">Vakansiyalar</a></li>
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
            <h2 style="color: #16164C;">Vakansiyalar</h2>
          </div>
        </div>
      </div>
      <div class="row">

        <?php foreach ($get_all_vacancies as $item) { ?>
          <?php if ($item['vacancy_status'] == "Active") { ?>
            <div class="col-lg-4">
              <div class="properties properties2 mb-30">
                <div class="properties__card" style="background:white;">
                  <div class="properties__img overlay1">
                    <?php if($item['vacancy_img']){ ?>
                      <a href="<?php echo base_url("vacancy_single/" . $item['vacancy_id']."/".  str_replace(' ', '-', $item['vacancy_name'])) ?>"><img style="width:100%; height:350px; object-fit: cover;"
                        src="<?php echo base_url('uploads/vacancy/' . $item['vacancy_img']) ?>" alt=""></a>
                    <?php }else{?>
                      <a href="<?php echo base_url("vacancy_single/" . $item['vacancy_id']) ?>"><img style="width:100%; height:350px; object-fit: contain;"
                        src="<?php echo base_url('uploads/vacancy/logo.png') ?>" alt=""></a>
                    <?php } ?>

                  </div>

                  <div class="properties__caption">
                    <h3 style="text-align:center; color: #16164C;">
                      <?php echo $item['vacancy_name'] ?>
                    </h3>

                    <div class="properties__footer d-flex justify-content-between align-items-center">
                      <div class="restaurant-name">

                      </div>
                    </div>
                    <a href="<?php echo base_url("vacancy_single/" . $item['vacancy_id']."/".  str_replace(' ', '-', $item['vacancy_name'])) ?>"
                      class="border-btn border-btn2">Daha Çox</a>
                  </div>

                </div>
              </div>
            </div>
          <?php } ?>
        <?php } ?>


      </div>







</main>
<?php $this->load->view('user/includes/footer') ?>