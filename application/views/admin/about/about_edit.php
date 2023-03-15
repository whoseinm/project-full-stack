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

        <h5 class="card-header spaceB">About edit
            <a href="<?php echo base_url('admin_about') ?>">
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

            <form action="<?php echo base_url('about_edit_act/').$about_single['about_id']; ?>" method="post" enctype="multipart/form-data">
                <label for="title">Title</label>
                <input type="text" id="title" name="title" class="form-control" value="<?php echo $about_single['about_title']; ?>">
                <br>

                <label for="descr">Description</label>
                <textarea name="description" class="form-control" id="description" cols="30" rows="10" ><?php echo $about_single['about_description']; ?></textarea>
                <br>



                <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2" style="float: left; margin:0px 10px">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control">
                    <option <?php if ($about_single['about_status'] == "") {
                                    echo "SELECTED";
                                } ?> value="">-SELECT-</option>
                        <option <?php if ($about_single['about_status'] == "Active") {
                                    echo "SELECTED";
                                } ?> value="Active">Active</option>
                        <option <?php if ($about_single['about_status'] == "Deactive") {
                                    echo "SELECTED";
                                } ?> value="Deactive">Deactive</option>
                    </select>
                </div>


                <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3" style="float: left; margin:0px">

                    <?php if ($about_single['about_img']) { ?>
                        <?php if (!empty($about['about_img'])) { ?>
                            <img width="100%" style="object-fit: cover;" src="http://raddiantdiagnostics.com/wp-content/uploads/2019/12/no_img.jpg" alt="">

                        <?php } else { ?>
                            <img width="100%" style="object-fit: cover;" src="<?php echo base_url('uploads/about/' . $about_single['about_img']); ?>" alt="">

                            <a href="<?php echo base_url('about_img_delete/'.$about_single['about_id']); ?>">
                                <button onclick="return confirm('Məlumatı silmək istədiyinizə əminsiniz?')" type="button" class="btn btn-danger">Delete img</button>
                            </a>


                        <?php } ?>
                    <?php } else { ?>
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="float: left; margin:0px">
                                <label for="img">IMG</label>
                                <input type="file" id="img" class="form-control" name="user_img">
                            </div>
                        <?php } ?>
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