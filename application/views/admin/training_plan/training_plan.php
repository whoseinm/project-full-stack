<?php
// print_r("<pre>");
// print_r($get_all_posts["post_title"]);
// die();
?>

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
        <h5 class="card-header spaceB">Təlim Planlarının Siyahısı
            <a href="<?php echo base_url('plan_create') ?>">
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
                            <th>Name</th>
                            <th>Date</th>
                            <th>Creator name</th>
                            <th>Img</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>

                        <?php $say = 0;
                        foreach ($get_all_plans as $item) {
                            strrev($say++) ?>
                            <tr>

                                <td>
                                    <?php echo $say ?>
                                </td>
                                <td>
                                    <?php
                                    $title = mb_strimwidth($item['plan_name'], 0, 30, '...');
                                    echo $title ?>
                                </td>
                                </td>
                                <td>
                                    <?php echo date("d-m-Y", strtotime($item['plan_add_date'])); ?>
                                </td>
                                <td>
                                    <?php echo $admin['a_name']; ?>
                                </td>


                                <td>
                                    <?php if ($item["plan_img"]) { ?>
                                        <img width="70px" height="60px" style="object-fit: cover;"
                                            src="<?php echo base_url('uploads/plans/' . $item['plan_img']); ?>" alt="img"></img>
                                    <?php } else { ?>
                                        <img width="80px" height="60px" style="object-fit: cover;"
                                            src="http://raddiantdiagnostics.com/wp-content/uploads/2019/12/no_img.jpg"
                                            alt="img">
                                    <?php } ?>
                                </td>
                                <td>
                                    <?php if ($item['plan_status'] == "Active") { ?>
                                        <span class="badge bg-label-success me-1">
                                            <?php echo $item['plan_status']; ?>
                                        </span>
                                    <?php } else if ($item['plan_status'] == "Deactive") { ?>
                                            <span class="badge bg-label-danger me-1">
                                            <?php echo $item['plan_status']; ?>
                                            </span>
                                    <?php } else { ?>
                                            <span class="badge bg-label-primary me-1">---------</span>
                                    <?php } ?>

                                </td>



                                <td>

                                    <a href="<?php echo base_url("plan_detail/". $item["plan_id"]) ; ?>">
                                        <button type="button" class="btn btn-sm btn-outline-info">Detail</button>
                                    </a>
                                    <a href="<?php echo base_url("plan_edit/". $item["plan_id"]) ; ?>">
                                        <button type="button" class="btn btn-sm btn-outline-warning">Edit</button>
                                    </a>
                                    <a href="<?php echo base_url("plan_delete/". $item["plan_id"]) ; ?>">
                                        <button onclick="return confirm('Təlimi silmək istədiyinizə əminsiz?')" type="button"
                                            class="btn btn-sm btn-outline-danger">Delete</button>
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