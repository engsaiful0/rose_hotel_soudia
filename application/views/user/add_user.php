<?php
$language = $this->session->userdata('language');

?>
<div class="col-12 mt-4">
    <div class="card">
        <div class="card-header bg-primary ">
            <h6 style="color:white;text-align:center" class="card-title">
                <?php
                if ($language == 'english') {
                    echo 'Add User';
                } else {
                    echo 'إضافة مستخدم';

                }
                ?>
            </h6>
        </div>
        <div class="card-content">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <?php
                        $language = $this->session->userdata('language');
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

                        <form method="post" enctype="multipart/form-data" action="<?php echo base_url() ?>user-save">
                            <div class="form-row" style="display: none">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">Id No *</label>
                                    <?php
                                    $uniqu_id = $this->db->select('*')->get('user');
                                    $user_id_no = 'U' . str_pad($uniqu_id->num_rows() + 1, 5, '0', STR_PAD_LEFT);

                                    ?>
                                    <input class="form-control" readonly value="<?php echo $user_id_no ?>" required
                                           name="user_id_no" id="user_id_no">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">
                                        <?php
                                        $placeholder='';
                                        if ($language == 'english') {
                                            echo 'User Name';
                                            $placeholder='User Name';
                                        } else {
                                            echo 'اسم االمستخدم';
                                            $placeholder='اسم االمستخدم';

                                        }
                                        ?>
                                       </label>
                                    <input class="form-control" required name="user_name" id="user_name"
                                           placeholder="<?php echo $placeholder?>">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">
                                        <?php
                                        $placeholder='';
                                        if ($language == 'english') {
                                            echo 'Password';
                                            $placeholder='Password';
                                        } else {
                                            echo 'كلمه السر';
                                            $placeholder='كلمه السر';

                                        }
                                        ?>
                                        </label>
                                    <input class="form-control" required name="password" id="password"
                                           placeholder="<?php echo $placeholder?>">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">
                                        <?php
                                        $placeholder='';
                                        if ($language == 'english') {
                                            echo 'Type';
                                            $placeholder='Type';
                                        } else {
                                            echo 'نوع';
                                            $placeholder='نوع';

                                        }
                                        ?>
                                        </label>
                                    <select class="form-control" required name="type" id="type" placeholder="">
                                        <option></option>
                                        <option value="superadmin">Super Admin</option>
                                        <option value="admin">Admin</option>
                                        <option value="admin">User</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">
                                        <?php
                                        $placeholder='';
                                        if ($language == 'english') {
                                            echo 'Hotel';
                                            $placeholder='Hotel';
                                        } else {
                                            echo 'الفندق';
                                            $placeholder='الفندق';

                                        }
                                        ?>
                                        </label>
                                    <select class="form-control" required name="hotel_id" id="hotel_id">
                                        <option></option>
                                        <?php
                                        $hotels = $this->db->select('*')->get('hotel')->result();
                                        foreach ($hotels as $hotel) {
                                            ?>
                                            <option value="<?php echo $hotel->hotel_id ?>"><?php echo $hotel->hotel_name_in_english ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">
                                        <?php
                                        $placeholder='';
                                        if ($language == 'english') {
                                            echo 'Picture';
                                            $placeholder='Picture';
                                        } else {
                                            echo 'صورة';
                                            $placeholder='صورة';

                                        }
                                        ?>
                                        </label>
                                    <input class="form-control" name="picture" id="picture" type="file">
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">
                                <?php
                                $placeholder='';
                                if ($language == 'english') {
                                    echo 'Save';
                                    $placeholder='Save';
                                } else {
                                    echo 'يحفظ';
                                    $placeholder='يحفظ';

                                }
                                ?>
                                </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
