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
            <a href="<?php echo base_url('post_create') ?>">
                <button type="button" class="btn  btn-sm btn-success">Create</button>
            </a>
        </h5>

        <div class="card-body">
            <div class="table-responsive text-nowrap">
                <table class="table table-bordered">
                    <tbody>

                        <tr>
                            <th>Date</th>
                            <th>Category</th>
                            <th>Creator name</th>
                            <th>Img</th>
                            <th>Status</th>
                            <th>Actions</th>


                        </tr>

                        <tr>
                        <td>10.01.2022</td>
                            <td>Education</td>
                            <td>Rashid</td>
                            <td>
                                <img src="" alt="">
                            </td>
                            <td>
                                <span class="badge bg-label-success me-1">Active</span>
                            </td>
                            <td>
                                <button type="button" class="btn btn-sm btn-outline-info">Detail</button>
                                <button type="button" class="btn btn-sm btn-outline-warning">Edit</button>
                                <button type="button" class="btn btn-sm btn-outline-danger">Delete</button>
                            </td>
                        </tr>

                        <tr>
                        <td>10.01.2022</td>
                            <td>Fashion</td>
                            <td>Rashid</td>
                            <td>
                                <img src="" alt="">
                            </td>
                            <td>
                                <span class="badge bg-label-danger me-1">Deactive</span>
                            </td>
                            <td>
                                <button type="button" class="btn btn-sm btn-outline-info">Detail</button>
                                <button type="button" class="btn btn-sm btn-outline-warning">Edit</button>
                                <button type="button" class="btn btn-sm btn-outline-danger">Delete</button>
                            </td>
                        </tr>



                        <tr>
                            <td>10.01.2022</td>
                            <td>Education</td>
                            <td>Rashid</td>
                            <td>
                                <img src="" alt="">
                            </td>
                            <td>
                                <span class="badge bg-label-success me-1">Active</span>
                            </td>
                            <td>
                                <button type="button" class="btn btn-sm btn-outline-info">Detail</button>
                                <button type="button" class="btn btn-sm btn-outline-warning">Edit</button>
                                <button type="button" class="btn btn-sm btn-outline-danger">Delete</button>
                            </td>
                        </tr>

                    </tbody>

                </table>
            </div>
        </div>
    </div>
    <!--/ Bordered Table -->
</div>

<?php $this->load->view("admin/includes/admin_footer") ?>