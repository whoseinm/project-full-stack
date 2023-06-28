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

        <h5 class="card-header spaceB">Partnyor Detalları
            <a href="<?php echo base_url('vacancies_admin') ?>">
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

            <form action="<?php echo base_url('vacancy_create_act'); ?>" method="post" enctype="multipart/form-data">
                <label for="title"><b>Vakansiyanın adı</b></label>
                <p><?php echo $vacancy_single['vacancy_name'];?></p>
                <br>

                <label for="descr"><b>Description</b></label>
                <p><?php echo $vacancy_single['vacancy_about'];?></p>
                <br>

                <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3" style="float: left;">
                    <label for="date"><b>Date</b></label>
                    <p><?php echo $vacancy_single['vacancy_add_date'];?></p>
                </div>



                <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2" style="float: left; margin:0px 10px">
                    <label for="status"><b>Status</b></label>
                    <p><?php echo $vacancy_single['vacancy_status'];?></p>
                </div>

                <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2" style="float: left; margin:0px 10px">
                    <label for="status"><b>Creator</b></label>
                    <p><?php echo $vacancy_single['a_name'];?></p>
                </div>

                <?php if ($vacancy_single['vacancy_updater_id'] != 0){ ?>
                <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2" style="float: left; margin:0px 10px">
                    <label for="cate"><b>Updater</b></label>
                    <p><?php echo $vacancy_single['vacancy_updater_id'];?></p>
                </div>
            <?php }else{ ?>
                   <label for="status"><b>Updater</b></label>
                   <p>---------</p>
            <?php }?>


                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="float: left; margin:0px">
                    <label for="img"><b>File</b></label>
                    <br>
                    <?php if(!empty($vacancy_single["vacancy_img"])){ ?>
                        <img width="150px" height="150px" src="<?php echo base_url("uploads/vacancy/".$vacancy_single["vacancy_img"]) ?>" alt="">
                    <?php }else{ ?>
                        <img width="150px" height="150px" src="http://raddiantdiagnostics.com/wp-content/uploads/2019/12/no_img.jpg" alt="">
                    <?php } ?>
                    
                </div>




            </form>



        </div>
    </div>
    <!--/ Bordered Table -->
</div>

<?php $this->load->view("admin/includes/admin_footer") ?>

