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
                                    <?php echo $course_single['course_name'] ?>
                                </h1>

                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="<?php echo base_url('home') ?>">Ana
                                                səhifə</a></li>
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

    <section class="section-padding">
        <div class="container">
            <div class="row">
                <div class="container col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="row">
                        <div class="img col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <img style="height: 550px; width:100%; object-fit: contain; border-radius:10px;"
                            <?php if($course_single['course_img']) { ?>
                                src="<?php echo base_url('uploads/courses/' . $course_single['course_img']) ?>">
                            <?php } else{ ?>
                                src="<?php echo base_url('uploads/courses/logo.png') ?>">
                            <?php } ?>
                                

                        </div>

                        <div class="description col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <h1
                                style="color:#4255A4; font-size: 30px; text-align: center; margin-top:15px; font-weight: bold;">
                                Kurs Haqqında</h1>
                            <div>
                                <p>
                                    <?php echo $course_single['course_description'] ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <a href="<?php echo base_url("courses") ?>">
                <button style="width: 100%; padding: 5px 15px; outline: none; border: none; color:white!important; border-radius: 10px; background:#4255A4; cursor: pointer;">Geri</button>
            </a>

        </div>
    </section>

</main>

<?php $this->load->view('user/includes/footer') ?>