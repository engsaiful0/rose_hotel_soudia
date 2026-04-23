<div class="col-12 mt-4">
    <div class="card">
        <div class="card-header bg-primary ">
            <h6 style="color:white;text-align:center" class="card-title">Edit User</h6>
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
                        $user = $this->db->where('id',$user_id)->get('user')->row();
                        ?>
                        <form method="post" enctype="multipart/form-data" action="<?php echo base_url() ?>user-edit-save">
                            <input type="hidden" name="user_id" id="user_id" value="<?php echo $user_id?>">
                            <div class="form-row" style="display: none">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">Id No *</label>

                                    <input class="form-control" readonly value="<?php echo $user->user_id_no?>" required name="user_id_no" id="user_id_no" placeholder="Enter the amount">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">User Name</label>
                                    <input class="form-control" value="<?php echo $user->user_name?>"  required name="user_name" id="user_name" placeholder="Enter User Name">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">Password</label>
                                    <input class="form-control" value="<?php echo $user->password?>"  required name="password" id="password" placeholder="Enter Password">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">Type</label>
                                    <select class="form-control"  required name="type" id="type" placeholder="">
                                        <option value="superadmin" <?php echo $user->type=='superadmin'? 'selected':'' ?> >Super Admin</option>
                                        <option value="admin" <?php echo $user->type=='admin'? 'selected':'' ?>>Admin</option>
                                        <option  value="user" <?php echo $user->type=='user'? 'selected':'' ?>>User</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">Hotel</label>
                                    <select class="form-control" required name="hotel_id" id="hotel_id" >
                                        <?php
                                        $hotels= $this->db->select('*')->get('hotel')->result();
                                        foreach ($hotels as $hotel) {
                                            ?>
                                            <option <?php echo $hotel->hotel_id==$user->hotel_id? 'selected':'' ?> value="<?php echo $hotel->hotel_id ?>"><?php echo $hotel->hotel_name_in_english ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">Picture</label>
                                    <input class="form-control"  name="picture" id="picture" type="file">
                                    <input   value="<?php echo $user->picture?>" class="form-control"  name="picture_edit" id="picture" type="hidden">
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
