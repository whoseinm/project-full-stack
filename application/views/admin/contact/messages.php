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

                        <?php $say = 0; foreach ($get_messages as $item)  { $say++?>
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
                                    <span class="badge bg-label-success me-1">Active</span>
                                </td>

                                <td>
                                    <button type="button" class="btn btn-sm btn-outline-info">Detail</button>
                                    <button type="button" class="btn btn-sm btn-outline-warning">Baxılıb</button>
                                    <button type="button" class="btn btn-sm btn-outline-danger">Delete</button>
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