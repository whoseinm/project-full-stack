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
                <div class="container desc col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="row">
                        <div class="img col-xs-12 col-sm-12 col-md-4 col-lg-4">
                            <img style="height: 450px; border-radius: 5px;"
                                src="<?php echo base_url('uploads/trainers/' . $trainer_single['trainer_img']) ?>"
                                alt="">
                        </div>

                        <div class="description col-xs-12 col-sm-12 col-md-6 col-lg-6">
                            <div>
                                <p>
                                    <?php echo $trainer_single['trainer_about'] ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <br>
            <hr>

            <h1 style="text-align:center; font-size: 33px; font-weight: bold; margin-top: 10px;">Keçdiyi Kurslar</h1>
            <div class="container kurs col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="row">
                    <?php foreach ($get_all_courses as $item) { ?>
                        <?php if ($item['course_status'] == "Active") {
                            if ($item['course_trainer'] == $trainer_single['trainer_name']) { ?>
                                <div class="col-lg-4">
                                    <div class="properties properties2 mb-30">
                                        <div class="properties__card">
                                            <div class="properties__img">
                                                <a href="<?php echo base_url("course_single/" . $item['course_id']) ?>"><img
                                                        style="width:100%; height:200px; object-fit: cover; border-radius: 20px;"
                                                        src="<?php echo base_url('uploads/courses/' . $item['course_img']) ?>"
                                                        alt=""></a>
                                            </div>

                                            <div class="properties__caption">
                                                <h3 style="margin: 5px;"><a href="#">
                                                        <p>
                                                            <?php echo $item['course_duration'] ?>
                                                        </p>
                                                        <?php echo $item['course_name'] ?>
                                                    </a></h3>
                                                <div class="properties__footer d-flex justify-content-between align-items-center">
                                                    <div class="restaurant-name">
                                                        <div style="margin:10px;">
                                                            <img width="40px" height="40px" style="border-radius:50%;"
                                                                src="<?php echo base_url('uploads/trainers/' . $item['trainer_img']); ?>"
                                                                alt="trainer_img">
                                                            <p style="color:#6E7697; font-size: 17px;"><?php echo $item['trainer_name'] ?></p>
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

        </div>

        </div>
        </div>
    </section>



</main>

<?php $this->load->view('user/includes/footer') ?>