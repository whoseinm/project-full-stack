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
        <h5 class="card-header spaceB">About List
            <a href="<?php echo base_url('about_create') ?>">
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
                            <th>Title</th>
                            <th>Img</th>
                            <th>Status</th>
                            <th>Actions</th>


                        </tr>

                        <?php $say = 0;
                        foreach ($about as $item) {
                            $say++ ?>


                            <tr>
                                <td>
                                    <span>
                                        <?php echo $say ?>
                                    </span>
                                </td>
                                <td>
                                    <?php echo $item['about_title'] ?>
                                </td>
                                <td>
                                    <?php if ($item["about_img"]) { ?>
                                        <img width="70px" height="60px" style="object-fit: cover;"
                                            src="<?php echo base_url('uploads/about/' . $item['about_img']); ?>"
                                            alt="img"></img>
                                    <?php } else { ?>
                                        <img width="80px" height="60px" style="object-fit: cover;"
                                            src="http://raddiantdiagnostics.com/wp-content/uploads/2019/12/no_img.jpg"
                                            alt="img">
                                    <?php } ?>
                                </td>
                                <td>
                                    <?php if ($item['about_status'] == "Active") { ?>
                                        <span class="badge bg-label-success me-1">
                                            <?php echo $item['about_status']; ?>
                                        </span>
                                    <?php } else if ($item['about_status'] == "Deactive") { ?>
                                            <span class="badge bg-label-danger me-1">
                                            <?php echo $item['about_status']; ?>
                                            </span>
                                    <?php } else { ?>
                                            <span class="badge bg-label-primary me-1">---------</span>
                                    <?php } ?>
                                </td>
                                <td>

                                    <a href="<?php echo base_url("about_detail/" . $item["about_id"]) ?>">
                                        <button type="button" class="btn btn-sm btn-outline-info">Detail</button>
                                    </a>



                                        <a href="<?php echo base_url("about_edit/" . $item["about_id"]) ?>">
                                        <button type="button" class="btn btn-sm btn-outline-warning">Edit</button>
                                    </a>


                                    <button onclick="return confirm('silmək istədiyinizə, əminsinizmi?')" type="button" class="btn btn-sm btn-outline-danger disabled">Delete</button>


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