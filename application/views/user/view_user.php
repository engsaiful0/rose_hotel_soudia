<!-- START: Card Data-->
<?php
$language = $this->session->userdata('language');

?>
<div class="row">
    <div class="col-12 mt-3">
        <div class="card">
            <div class="card-header bg-primary justify-content-between align-items-center">
                <h4 class="card-title" style="text-align: center;color: white">
                    <?php
                    if ($language == 'english') {
                        echo 'View User';
                    } else {
                        echo 'عرض المستخدم';

                    }
                    ?>
                </h4>
            </div>
            <div class="card-body">
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
                <div class="table-responsive">
                    <table id="example" class="display table dataTable table-striped table-bordered">
                        <thead>
                        <tr>
                            <td>
                                <?php
                                if ($language == 'english') {
                                    echo 'Serial';
                                } else {
                                    echo 'مسلسل';

                                }
                                ?>
                            </td>
                            <th>
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
                                </th>
                            <th> <?php
                                $placeholder='';
                                if ($language == 'english') {
                                    echo 'Password';
                                    $placeholder='Password';
                                } else {
                                    echo 'كلمه السر';
                                    $placeholder='كلمه السر';

                                }
                                ?></th>
                            <th> <?php
                                $placeholder='';
                                if ($language == 'english') {
                                    echo 'Type';
                                    $placeholder='Type';
                                } else {
                                    echo 'نوع';
                                    $placeholder='نوع';

                                }
                                ?></th>
                            <th> <?php
                                $placeholder='';
                                if ($language == 'english') {
                                    echo 'Hotel';
                                    $placeholder='Hotel';
                                } else {
                                    echo 'الفندق';
                                    $placeholder='الفندق';

                                }
                                ?></th>
                            <th> <?php
                                $placeholder='';
                                if ($language == 'english') {
                                    echo 'Picture';
                                    $placeholder='Picture';
                                } else {
                                    echo 'صورة';
                                    $placeholder='صورة';

                                }
                                ?></th>
                            <th>
                                <?php
                                $placeholder='';
                                if ($language == 'english') {
                                    echo 'Edit';
                                } else {
                                    echo 'يحرر';

                                }
                                ?>
                                </th>
                            <th>
                                <?php
                                $placeholder='';
                                if ($language == 'english') {
                                    echo 'Delete';
                                } else {
                                    echo 'حذف';

                                }
                                ?>
                                </th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $users = $this->db->select('*')
                            ->where('is_deleted', '0')
                            ->order_by('id', 'desc')
                            ->from('user')->get()
                            ->result();
                        $sl = 1;
                        foreach ($users as $user) {
                            $user_id = $user->id;
                            $hotel= $this->db->where('hotel_id',$user->hotel_id)->get('hotel')->row();
                            ?>
                            <tr>
                                <td><?php echo $sl++ ?></td>
                                <td><?php echo $user->user_name ?></td>
                                <td><?php echo $user->password ?></td>
                                <td><?php echo $user->type ?></td>
                                <td><?php echo $hotel->hotel_name_in_english ?></td>
                                <td>
                                    <?php
                                    if ($user->picture != '0') {
                                        ?>
                                        <a title="Click to download"
                                           href="<?php echo base_url() ?>assets/user/<?php echo $user->picture ?>"
                                           download="">
                                            <img style="height: 50px;width: 100px;"
                                                 src="<?php echo base_url() ?>assets/user/<?php echo $user->picture ?>">
                                        </a>
                                        <?php
                                    }
                                    ?>
                                </td>
                                <td>
                                    <a title="Edit" class="btn btn-primary"
                                       href="<?php echo base_url() ?>user-edit/<?php echo $user_id ?>"><i
                                                class="fa fa-pen "></i></a>
                                </td>
                                <td>
                                    <a onclick="return confirm('Do you want to delete this head?')" title="Delete"
                                       class="btn btn-danger"
                                       href="<?php echo base_url() ?>user-delete/<?php echo $user_id ?>"><i
                                                class="fa fa-trash "></i></a>
                                </td>
                            </tr>

                            <?php
                        }
                        ?>


                    </table>
                </div>
            </div>
        </div>

    </div>
</div>

