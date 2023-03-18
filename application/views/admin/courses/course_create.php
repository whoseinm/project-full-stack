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

        <h5 class="card-header spaceB">Course create
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

            <form action="<?php echo base_url('course_create_act'); ?>" method="post" enctype="multipart/form-data">
                <label for="title">Course name</label>
                <input type="text" id="title" name="title" class="form-control">
                <br>

                <label for="descr">About course</label>
                <textarea name="description" class="form-control" id="description" cols="30" rows="10"></textarea>
                <br>

                <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3" style="float: left;">
                    <label for="date">Course duration</label>
                    <input type="text" class="form-control" id="date" placeholder="Months / Hours"
                        name="course_duration">
                </div>

                <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3" style="float: left; margin:0px 10px">
                    <label for="trainer">Trainer name</label>
                    <select name="trainer" id="trainer" class="form-control">
                        <option value="SELECT">-SELECT-</option>
                        <?php foreach ($get_all_trainers as $item) { ?>
                            <?php if ($item['trainer_status'] != "Deactive") { ?>
                                <option value="<?php echo $item['trainer_name']; ?>"><?php echo $item['trainer_name']; ?></option>
                            <?php } ?>
                        <?php } ?>
                    </select>
                </div>
                            
                <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3" style="float: left; margin:0px 10px">
                    <label for="cate">Category</label>
                    <select name="category" id="cate" class="form-control">
                        <option value="">-SELECT-</option>
                        <?php foreach ($get_all_categories as $item) { ?>
                            <option value="<?php echo $item['category_id']; ?>"><?php echo $item['category_title']; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>


                <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2" style="float: left; margin:0px 10px">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control">
                        <option value="">-SELECT-</option>
                        <option value="Active">Active</option>
                        <option value="Deactive">Deactive</option>
                    </select>
                </div>


                <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3" style="float: left; margin:0px">
                    <label for="img">IMG</label>
                    <input type="file" id="img" class="form-control" name="user_img">
                </div>


                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="float: left; margin:0px">
                    <br>
                    <button type="submit" class="btn btn-success" style="float: right;">SEND</button>
                </div>


            </form>



        </div>
    </div>
    <!--/ Bordered Table -->
</div>

<?php $this->load->view("admin/includes/admin_footer") ?>