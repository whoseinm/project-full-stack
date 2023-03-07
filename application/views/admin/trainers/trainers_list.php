<?php $this->load->view("admin/includes/admin_header_style") ?>

<?php $this->load->view("admin/includes/admin_sidebar") ?>

<?php $this->load->view("admin/includes/admin_navbar") ?>


<style>
    .spaceB {
        display: flex;
        justify-content: space-between;
    }
</style>
<div class="container">
    <div class="card">
        <h5 class="card-header spaceB">News List
            <a href="<?php echo base_url('trainer_create') ?>">
                <button type="button" class="btn  btn-sm btn-success">Create</button>
            </a>
        </h5>

        <div class="card-body">

            <?php if ($this->session->flashdata('success')) { ?>
                <div class="alert alert-success d-flex align-items-center" role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:">
                        <use xlink:href="#exclamation-triangle-fill" />
                    </svg>
                    <div>
                        <?php echo $this->session->flashdata('success'); ?>
                    </div>
                </div>
            <?php } ?>

            <div class="table-responsive text-nowrap">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th>#</th>
                            <th>Name,surname</th>
                            <th>Img</th>
                            <th>Status</th>
                            <th>Actions</th>


                        </tr>

                        <?php $say=0; foreach ($trainers as $item) { $say++ ?>


                            <tr>
                                <td>
                                    <span><?php echo $say ?></span>
                                </td>
                                <td>
                                    <?php echo $item['trainer_name'] ?>
                                </td>
                                <td>
                                    <?php if ($item["trainer_img"]) { ?>
                                        <img width="70px" height="60px" style="object-fit: cover;"
                                            src="<?php echo base_url('uploads/trainers/' . $item['trainer_img']); ?>"
                                            alt="img"></img>
                                    <?php } else { ?>
                                        <img width="80px" height="60px" style="object-fit: cover;"
                                            src="http://raddiantdiagnostics.com/wp-content/uploads/2019/12/no_img.jpg"
                                            alt="img">
                                    <?php } ?>
                                </td>
                                <td>
                                    <span class="badge bg-label-success me-1">Active</span>
                                </td>
                                <td>

                                    <a href="<?php echo base_url("trainer_detail/" . $item["trainer_id"]) ?>">
                                        <button type="button" class="btn btn-sm btn-outline-info">Detail</button>
                                    </a>

                                    <a href="<?php echo base_url("trainer_edit/" . $item["trainer_id"]) ?>">
                                        <button type="button" class="btn btn-sm btn-outline-warning">Edit</button>
                                    </a>

                                    <a href="<?php echo base_url("delete_trainer/" . $item["trainer_id"]) ?>">
                                        <button type="button" class="btn btn-sm btn-outline-danger">Delete</button>
                                    </a>

                                </td>
                            </tr>
                        <?php } ?>



                    </tbody>

                </table>
            </div>
        </div>
    </div>
    <!--/ Bordered Table -->
</div>

<?php $this->load->view("admin/includes/admin_footer") ?>