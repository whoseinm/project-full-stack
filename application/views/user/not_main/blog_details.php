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
                                    <?php echo $blog_detail['post_title'] ?>
                                </h1>

                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb" style="margin-bottom: 100px;">
                                        <li class="breadcrumb-item"><a href="<?php echo base_url("home") ?>">Ana
                                                səhifə</a></li>
                                        <li class="breadcrumb-item"><a href="#">Eventlər</a></li>
                                    </ol>
                                </nav>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="blog_area single-post-area section-padding">
        <div class="container">
            <div class="row">
                <?php if ($blog_detail['post_img']) { ?>
                    <div class="col-lg-12 posts-list">
                        <div class="single-post">
                            <div class="feature-img">
                                <img class="img-fluid" width="100%"
                                    style="height: 700px; object-fit:cover; object-position: top;"
                                    src="<?php echo base_url('uploads/posts/' . $blog_detail['post_img']) ?>" alt="">
                            </div>
                            <div class="blog_details">
                                <p style="font-size: 16px;">
                                    <?php echo $blog_detail['post_description'] ?>
                                </p>

                            </div>
                            <div class="blog_details">
                                <p style="font-size: 16px;">
                                    Paylaşıldığı Tarix:
                                    <b>
                                        <?php echo date("d-m-Y", strtotime($blog_detail['post_date'])) ?>
                                    </b>
                                </p>

                            </div>
                        </div>

                    </div>
                <?php } else { ?>
                    <div class="col-lg-12 posts-list">
                        <div class="single-post">
                            <div class="feature-img">
                                <img class="img-fluid" width="100%"
                                    style="height: 700px; object-fit:contain; object-position: center;"
                                    src="<?php echo base_url('uploads/posts/logo.png') ?>" alt="">
                            </div>
                            <div class="blog_details">
                                <p style="font-size: 16px;">
                                    <?php echo $blog_detail['post_description'] ?>
                                </p>

                            </div>
                            <div class="blog_details">
                                <p style="font-size: 16px;">
                                    Paylaşıldığı Tarix:
                                    <b>
                                        <?php echo date("d-m-Y", strtotime($blog_detail['post_date'])) ?>
                                    </b>
                                </p>

                            </div>
                        </div>

                    </div>
                <?php } ?>

            </div>

            <a href="<?php echo base_url("blog") ?>">
                <button
                    style="width: 100%; padding: 5px 15px; outline: none; border: none; border-radius: 10px; color:white; background:#4255A4; cursor: pointer;">Back</button>
            </a>

        </div>
        </div>
    </section>

</main>

<?php $this->load->view('user/includes/footer') ?>