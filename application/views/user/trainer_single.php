<?php $this->load->view('user/includes/header_style') ?>
<?php $this->load->view('user/includes/navbar') ?>

<main>

    <section class="slider-area slider-area2">
        <div class="slider-active">

            <div class="single-slider slider-height2">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12">
                            <div class="hero__caption hero__caption2">
                                <h1 data-animation="bounceIn" data-delay="0.2s">
                                    <?php echo $trainer_single['trainer_name'] ?>
                                </h1>

                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="<?php echo base_url('home') ?>">Ana
                                                səhifə</a></li>
                                        <li class="breadcrumb-item"><a href="#">Treynerlər</a></li>
                                    </ol>
                                </nav>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section-padding">
        <div class="container">
            <div class="row">
                <div class="container col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="row">
                        <div class="img col-xs-12 col-sm-12 col-md-4 col-lg-4">
                            <img style="height: 450px; border-radius:10px;" src="<?php echo base_url('uploads/trainers/'.$trainer_single['trainer_img']) ?>" alt="">
                        </div>

                        <div class="description col-xs-12 col-sm-12 col-md-6 col-lg-6">
                            <div>
                                <p><?php echo $trainer_single['trainer_about'] ?></p> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>



        </div>
        </div>

        </div>
        </div>
    </section>

</main>

<?php $this->load->view('user/includes/footer') ?>