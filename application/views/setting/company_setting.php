<div class="col-12 mt-4">
    <div class="card">
        <div class="card-header bg-primary ">
            <h6 style="color:white;text-align:center" class="card-title">Company Setting</h6>
        </div>
        <div class="card-content">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <?php
                        if ($this->session->userdata('success') != '') {
                            ?>
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong>
                                    <?php
                                    echo $this->session->userdata('success');
                                    $sdata = array(
                                        'success' => ''
                                    );
                                    $this->session->set_userdata($sdata);
                                    ?>
                                </strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <?php
                        }
                        ?>
                        <?php
                        $language = $this->session->userdata('language');
                        $hotel_id = $this->session->userdata('hotel_id');
                        ?>
                        <?php
                        $company = $this->db->where('hotel_id', $hotel_id)->get('company')->row();
                        ?>
                        <form method="post" enctype="multipart/form-data" action="<?php echo base_url() ?>company-setting-edit-save">
                            <input type="hidden" name="banner_id" id="banner_id" value="<?php echo $company->banner_id?>">
                            <input type="hidden" name="hotel_id" id="hotel_id" value="<?php echo $hotel_id?>">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">Title</label>
                                    <input class="form-control" value="<?php echo $company->title?>"  required name="title" id="title" placeholder="Enter Title">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">Mobile</label>
                                    <input class="form-control" value="<?php echo $company->mobile?>"  required name="mobile" id="mobile" placeholder="Enter mobile">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">Email</label>
                                    <input class="form-control" value="<?php echo $company->email?>"  required name="email" id="email" placeholder="Enter Email">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">Website</label>
                                    <input class="form-control" value="<?php echo $company->website?>"  required name="website" id="website" placeholder="Enter Website">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">Address</label>
                                    <input class="form-control" value="<?php echo $company->address?>"  required name="address" id="address" placeholder="Enter Address">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">Banner Image</label>
                                   <div class="row">
                                        <div class="col-md-9">
                                            <input class="form-control"  name="banner_image" id="banner_image" type="file">
                                            <input   value="<?php echo $company->banner_image?>" class="form-control" required  name="banner_image_edit" id="banner_image_edit" type="hidden">
                                        </div>
                                        <div class="col-md-3">
                                            <img style="height: 50px;" src="<?php echo base_url()?>assets/uploads/banner/<?php echo $company->banner_image?>">
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">Favicon</label>
                                    <div class="row">
                                        <div class="col-md-9">
                                            <input class="form-control"  name="favicon" id="favicon" type="file">
                                            <input   value="<?php echo $company->favicon?>" class="form-control" required name="favicon_edit" id="favicon_edit" type="hidden">
                                        </div>
                                        <div class="col-md-3">
                                            <img style="height: 50px;" src="<?php echo base_url()?>assets/uploads/banner/<?php echo $company->favicon?>">
                                        </div>

                                    </div>

                                </div>

                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">Logo</label>
                                    <div class="row">
                                        <div class="col-md-9">
                                            <input class="form-control"  name="logo" id="logo" type="file">
                                            <input   value="<?php echo $company->logo?>" class="form-control" required name="logo_edit" id="logo_edit" type="hidden"> </div>
                                        <div class="col-md-3">
                                            <img style="height: 50px;" src="<?php echo base_url()?>assets/uploads/banner/<?php echo $company->logo?>">
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">Report Banner</label>
                                    <div class="row">
                                        <div class="col-md-9">
                                            <input class="form-control"  name="report_banner" id="report_banner" type="file">
                                            <input   value="<?php echo $company->report_banner?>" class="form-control" required name="report_banner_edit" id="logo_edit" type="hidden"> </div>
                                        <div class="col-md-3">
                                            <img style="height: 50px;" src="<?php echo base_url()?>assets/uploads/banner/<?php echo $company->report_banner?>">
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
