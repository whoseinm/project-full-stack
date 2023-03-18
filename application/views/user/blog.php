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
                <h1 data-animation="bounceIn" data-delay="0.2s">Eventlər</h1>

                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo base_url("home") ?>">Ana səhifə</a></li>
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

  <section class="blog_area section-padding">
    <div class="container">
      <div class="row">

        <?php foreach ($get_all_posts as $item) { ?>

          <?php if ($item['post_img']) { ?>
            <div class="col-lg-6 mb-5 mb-lg-0">
              <div class="blog_left_sidebar">
                <article class="blog_item">
                  <div class="blog_item_img">
                    <a href="<?php echo base_url("blog_detail/" . $item['post_id']) ?>">
                      <img class="card-img rounded-0" style="height:450px; object-fit: cover; object-position: top;"
                        src="<?php echo base_url('uploads/posts/' . $item['post_img']) ?>" alt="">

                    </a>

                  </div>
                  <div class="blog_details">
                    <a class="d-inline-block" href="<?php echo base_url("blog_detail/" . $item['post_id']) ?>">
                      <h2 class="blog-head" style="color: #2d2d2d;">
                        <?php echo $item['post_title'] ?>
                      </h2>
                    </a>
                    <p>
                      <?php $title = mb_strimwidth($item['post_description'], 0, 100, '...');
                      echo $title ?>
                    </p>
                    <ul class="blog-info-link">
                      <li><a href="#"><i class="fa fa-user"></i>
                          <?php echo $item['post_category'] ?>
                        </a></li>
                    </ul>
                  </div>
                </article>
              </div>
            </div>

          <?php } else{ ?>

            <div class="col-lg-6 mb-5 mb-lg-0">
              <div class="blog_left_sidebar">
                <article class="blog_item">
                  <div class="blog_item_img">
                    <a href="<?php echo base_url("blog_detail/" . $item['post_id']) ?>">
                      <img class="card-img rounded-0" style="height:450px; object-fit: contain; object-position: center;"
                        src="<?php echo base_url('uploads/posts/logo.png') ?>" alt="">

                    </a>

                  </div>
                  <div class="blog_details">
                    <a class="d-inline-block" href="<?php echo base_url("blog_detail/" . $item['post_id']) ?>">
                      <h2 class="blog-head" style="color: #2d2d2d;">
                        <?php echo $item['post_title'] ?>
                      </h2>
                    </a>
                    <p>
                      <?php $title = mb_strimwidth($item['post_description'], 0, 100, '...');
                      echo $title ?>
                    </p>
                    <ul class="blog-info-link">
                      <li><a href="#"><i class="fa fa-user"></i>
                          <?php echo $item['post_category'] ?>
                        </a></li>
                    </ul>
                  </div>
                </article>
              </div>
            </div>

          <?php } ?>

        <?php } ?>




      </div>
    </div>
  </section>

</main>

<?php $this->load->view('user/includes/footer') ?>