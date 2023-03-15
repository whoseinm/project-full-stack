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

        <h5 class="card-header spaceB">Slider edit
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

            <form action="<?php echo base_url('hero_update_act/'.$hero_single['slider_id']); ?>" method="post"
                enctype="multipart/form-data">
                <label for="title"><b>Title</b></label>
                <input type="text" name="title" class="form-control" value='<?php echo $hero_single['slider_title']; ?>'>




                <label for="descr"><b>About</b></label>
                <textarea name="description" id="description" class="form-control" cols="30"
                    rows="10"><?php echo $hero_single['slider_description']; ?></textarea>

                <label for="title"><b>Link</b></label>
                <input type="text" name="link" class="form-control" value='<?php echo $hero_single['slider_link']; ?>'>


                <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3" style="float: left; margin:0px 0px">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control">
                        <option <?php if ($hero_single['slider_status'] == "") {
                            echo "SELECTED";
                        } ?> value="">-SELECT-</option>
                        <option <?php if ($hero_single['slider_status'] == "Active") {
                            echo "SELECTED";
                        } ?> value="Active">Active</option>
                        <option <?php if ($hero_single['slider_status'] == "Deactive") {
                            echo "SELECTED";
                        } ?> value="Deactive">Deactive</option>
                    </select>
                </div>


                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="float: left; margin:0px">
                    <br>
                    <?php if ($hero_single['slider_img']) { ?>
                        <?php if (!empty($hero['slider_img'])) { ?>
                            <img width="50%" style="object-fit: cover;"
                                src="http://raddiantdiagnostics.com/wp-content/uploads/2019/12/no_img.jpg" alt="">

                        <?php } else { ?>
                            <img width="50%" style="object-fit: cover;"
                                src="<?php echo base_url('uploads/slider/' . $hero_single['slider_img']); ?>" alt="">

                            <a href="<?php echo base_url('slider_img_delete/' . $hero_single['slider_id']); ?>">
                                <button onclick="return confirm('Məlumatı silmək istədiyinizə əminsiniz?')" type="button"
                                    class="btn btn-danger">Delete img</button>
                            </a>


                        <?php } ?>
                    <?php } else { ?>
                        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3" style="float: left; margin:0px">
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