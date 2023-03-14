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
        <h5 class="card-header spaceB">Slide list
            <a href="<?php echo base_url('hero_caption_create') ?>">
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
                            <th>Title</th>
                            <th>Img</th>
                            <th>Status</th>
                            <th>Actions</th>


                        </tr>

                        <?php foreach ($slides as $item) { ?>
                            <tr>
                                <td>
                                    <?php echo $item['slider_title'] ?>
                                </td>
                                <td>
                                    <?php if ($item["slider_img"]) { ?>
                                        <img width="70px" height="60px" style="object-fit: cover;"
                                            src="<?php echo base_url('uploads/slider/' . $item['slider_img']); ?>"
                                            alt="img"></img>
                                    <?php } else { ?>
                                        <img width="80px" height="60px" style="object-fit: cover;"
                                            src="http://raddiantdiagnostics.com/wp-content/uploads/2019/12/no_img.jpg"
                                            alt="img">
                                    <?php } ?>
                                </td>
                                <td>
                                    <?php if ($item['slider_status'] == "Active") { ?>
                                        <span class="badge bg-label-success me-1">
                                            <?php echo $item['slider_status']; ?>
                                        </span>
                                    <?php } else if ($item['slider_status'] == "Deactive") { ?>
                                            <span class="badge bg-label-danger me-1">
                                            <?php echo $item['slider_status']; ?>
                                            </span>
                                    <?php } else { ?>
                                            <span class="badge bg-label-primary me-1">---------</span>
                                    <?php } ?>
                                </td>
                                <td>
                                    <a href="<?php echo base_url("hero_detail/" . $item['slider_id']) ?>">
                                        <button type="button" class="btn btn-sm btn-outline-info">Detail</button>
                                    </a>

                                    <a href="<?php echo base_url("hero_edit/".$item['slider_id']) ?>">
                                        <button type="button" class="btn btn-sm btn-outline-warning">Edit</button>
                                    </a>

                                    <a href="<?php echo base_url("hero_caption_delete/" . $item['slider_id']) ?>">
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