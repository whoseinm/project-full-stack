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
                <h1 data-animation="bounceIn" data-delay="0.2s">Təlim Planı</h1>

                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo base_url('home') ?>">Ana səhifə</a></li>
                    <li class="breadcrumb-item"><a href="#">Təlim Planı</a></li>
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
            <h2 style="color: #16164C;">Təlim Planı</h2>
          </div>
        </div>
      </div>
      <div class="row">

        <?php foreach ($get_all_plans as $item) { ?>
          <?php if ($item['plan_status'] == "Active") { ?>
            <div class="col-lg-4">
              <div class="properties properties2 mb-30">
                <div class="properties__card">
                  <div class="properties__img overlay1">

                  <?php if($item['plan_img']){ ?>
                    <a href="<?php echo base_url("plan_single/" . $item['plan_id']."/".  str_replace(' ', '-', $item['plan_name'])) ?>"><img
                        style="width:100%; height:340px; object-fit: contain;"
                        src="<?php echo base_url('uploads/plans/' . $item['plan_img']) ?>" alt=""></a>
                  <?php }else{ ?>
                    <a href="<?php echo base_url("plan_single/" . $item['plan_id']) ?>"><img
                        style="width:100%; height:340px; object-fit: contain; background:white;"
                        src="<?php echo base_url('uploads/plans/logo.png') ?>" alt=""></a>
                  <?php } ?>
                    
                  </div>

                  <div class="properties__caption">
                    <h3><a href="#">
                        <?php echo mb_strimwidth($item['plan_name'], 0, 29, "...");?>
                      </a></h3>
                      <br>
                    <a href="<?php echo base_url("plan_single/" . $item['plan_id']."/".  str_replace(' ', '-', $item['plan_name'])) ?>"
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