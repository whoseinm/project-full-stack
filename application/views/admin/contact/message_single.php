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

        <h5 class="card-header spaceB">Message detail
            <a href="<?php echo base_url('admin_contact') ?>">
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

            <form action="<?php echo base_url('post_create_act'); ?>" method="post" enctype="multipart/form-data">

                <label for="descr"><b>Mövzu</b></label>
                <p>
                    <?php echo $get_single_message['contact_subject']; ?>
                </p>

                <label for="title"><b>Göndərən adı</b></label>
                <p>
                    <?php echo $get_single_message['contact_name']; ?>
                </p>

                <label for="title"><b>Göndərənin maili</b></label>
                <p>
                    <a href="mailto:<?php echo $get_single_message['contact_email']; ?>">
                        <?php echo $get_single_message['contact_email']; ?>
                    </a>
                </p>


                <label for="descr"><b>Mesaj</b></label>
                <p>
                    <?php echo $get_single_message['contact_message']; ?>
                </p>



                <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2" style="float: left; margin:0px 0px">
                    <label for="status"><b>Status</b></label>
                    <p>
                        <?php if ($get_single_message['contact_status'] == "Müraciət cavablandırılmayıb") {
                            echo "Müraciət cavablandırılmayıb";
                        }
                        if ($get_single_message['contact_status'] == "Müraciət cavablandırılıb") {
                            echo $get_single_message['contact_status'];
                        } ?>
                    </p>
                </div>

                <?php if ($get_single_message['contact_status'] == "Müraciət cavablandırılıb") { ?>
                    <label for="descr"><b>Nə vaxt baxılıb</b></label>
                    <p>
                        <?php echo $get_single_message['contact_viewed_date']; ?>
                    </p>

                    <label for="descr"><b>Kim tərəfindən baxılıb</b></label>
                    <p>
                        <?php echo $get_single_message['a_name']; ?>
                    </p>
                <?php } ?>




            </form>



        </div>
    </div>
    <!--/ Bordered Table -->
</div>

<?php $this->load->view("admin/includes/admin_footer") ?>