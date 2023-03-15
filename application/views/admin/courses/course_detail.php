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

        <h5 class="card-header spaceB">Course Detail
            <a href="<?php echo base_url('courses_admin') ?>">
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


                <label for="title"><b>Course name</b></label>
                <br>
                <?php echo $course_single['course_name'] ?>
                <br><br>

                <label for="descr"><b>About course</b></label>
                <p>
                    <?php echo $course_single['course_description'] ?>
                </p>
                <br>

                <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3" style="float: left;">
                    <label for="date"><b>Course duration</b></label>
                    <p>
                        <?php echo $course_single['course_duration'] ?>
                    </p>
                </div>

                <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3" style="float: left; margin:0px 10px">
                    <label for="trainer"><b>Trainer name</b></label>
                    <p>
                        <?php echo $course_single['trainer_name'] ?>
                    </p>
                </div>

                <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3" style="float: left; margin:0px 10px">
                    <label for="cate"><b>Category</b></label>
                        
                            <p><?php echo $course_single['course_category']; ?></p>
                        
                    </select>
                </div>


                <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2" style="float: left; margin:0px 10px">
                    <label for="status"><b>Status</b></label>
                    <p>
                        <?php echo $course_single['course_status']; ?>
                    </p>
                </div>


                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="float: left; margin:0px">
                    <label for="img"><b>File</b></label>
                    <br>
                    <?php if(!empty($course_single["course_img"])){ ?>
                        <img width="150px" height="150px" src="<?php echo base_url("uploads/courses/".$course_single["course_img"]) ?>" alt="">
                    <?php }else{ ?>
                        <img width="150px" height="150px" src="http://raddiantdiagnostics.com/wp-content/uploads/2019/12/no_img.jpg" alt="">
                    <?php } ?>
                    
                </div>

          



        </div>
    </div>
    <!--/ Bordered Table -->
</div>

<?php $this->load->view("admin/includes/admin_footer") ?>