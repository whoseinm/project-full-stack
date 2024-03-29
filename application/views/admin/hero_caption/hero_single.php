<?php $this->load->view("admin/includes/admin_header_style") ?>

<?php $this->load->view("admin/includes/admin_sidebar") ?>

<?php $this->load->view("admin/includes/admin_navbar") ?>
<br>
<style>
    .spaceB {
        display: flex;
        justify-content: space-between;
    }
</style>
<div class="container">
    <div class="card">

        <h5 class="card-header spaceB">Slider detail
            <a href="<?php echo base_url('hero_caption') ?>">
                <button type="button" class="btn  btn-sm btn-danger">Back</button>
            </a>
        </h5>


        <div class="card-body">

            <?php if ($this->session->flashdata('err')) { ?>
                <div class="alert alert-danger d-flex align-items-center" role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:">
                        <use xlink:href="#exclamation-triangle-fill" />
                    </svg>
                    <div>
                        <?php echo $this->session->flashdata('err'); ?>
                    </div>
                </div>
            <?php } ?>

            <form action="<?php echo base_url('hero_caption_create_act'); ?>" method="post" enctype="multipart/form-data">
                <label for="title"><b>Title</b></label>
                <p>
                    <?php echo $hero_single['slider_title']; ?>
                </p>


                <label for="descr"><b>About</b></label>
                <p>
                    <?php echo $hero_single['slider_description']; ?>
                </p>

                <label for="link"><b>About</b></label>
                <p>
                   <a href="<?php echo $hero_single['slider_link']; ?>"><?php echo $hero_single['slider_link']; ?></a>
                </p>




                <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2" style="float: left; margin:0px 0px">
                    <label for="status"><b>Status</b></label>
                    <p>
                        <?php echo $hero_single['slider_status']; ?>
                    </p>
                </div>


                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="float: left; margin:0px">
                    <label for="img"><b>File</b></label>
                    <br>
                    <?php if (!empty($hero_single["slider_img"])) { ?>
                        <img width="300px" height="300px" style="object-fit: cover;"
                            src="<?php echo base_url("uploads/slider/" . $hero_single["slider_img"]) ?>" alt="">
                    <?php } else { ?>
                        <img width="150px" height="150px" style="object-fit: cover;"
                            src="http://raddiantdiagnostics.com/wp-content/uploads/2019/12/no_img.jpg" alt="">
                    <?php } ?>

                </div>




            </form>



        </div>
    </div>
    <!--/ Bordered Table -->
</div>

<?php $this->load->view("admin/includes/admin_footer") ?>