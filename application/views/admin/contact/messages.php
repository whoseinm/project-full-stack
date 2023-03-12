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
        <h5 class="card-header spaceB">Messages List
        </h5>

        <div class="card-body">
            <div class="table-responsive text-nowrap">
                <table class="table table-bordered">
                    <tbody>

                        <tr>
                            <th>#</th>
                            <th>Göndərən</th>
                            <th>E-poçt</th>
                            <th>Müraciət tarixi</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>

                        <?php $say = 0;
                        foreach ($get_messages as $item) {
                            $say++ ?>
                            <tr>
                                <td>
                                    <?php echo $say; ?>
                                </td>
                                <td>
                                    <?php $name = mb_strimwidth($item['contact_name'], 0, 20, '...');
                                    echo $name ?>
                                </td>

                                <td>
                                    <?php echo $item['contact_email'] ?>
                                </td>
                                <td>
                                    <?php echo $item['contact_date'] ?>
                                </td>


                                <td>
                                <?php if ($item['contact_status'] == "Müraciət cavablandırılıb") { ?>
                                        <span class="badge bg-label-success me-1">
                                            <?php echo $item['contact_status']; ?>
                                        </span>
                                    <?php } else if ($item['contact_status'] == "Müraciət cavablandırılmayıb") { ?>
                                            <span class="badge bg-label-danger me-1">
                                            <?php echo $item['contact_status']; ?>
                                            </span>
                                    <?php } else { ?>
                                            <span class="badge bg-label-primary me-1">---------</span>
                                    <?php } ?>
                                </td>

                                </td>

                                <td>
                                    <a href="<?php echo base_url('contact_message_single/' . $item["contact_id"]) ?>">
                                        <button type="button" class="btn btn-sm btn-outline-info">Detail</button>
                                    </a>

                                    <?php if ($item['contact_status'] == 'Müraciət cavablandırılmayıb') { ?>
                                        <a href="<?php echo base_url('contact_viewed/' . $item['contact_id']) ?>">
                                            <button type="button" class="btn btn-sm btn-outline-success">mark as read</button>
                                        </a>
                                    <?php } else { ?>
                                        <a href="<?php echo base_url('contact_view_delete/' . $item['contact_id']) ?>">
                                            <button type="button" class="btn btn-sm btn-outline-danger">cancel view</button>
                                        </a>
                                    <?php } ?>

                                     <a href="<?php echo base_url("contact_delete/".$item['contact_id']) ?>">
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