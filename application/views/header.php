
<!-- START: Header-->
<div id="header-fix" class="header fixed-top">
    <div class="site-width">
        <nav class="navbar navbar-expand-lg  p-0">
            <div class="navbar-header h4 mb-0 text-center h-100 collapse-menu-bar">
                <a href="#" class="sidebarCollapse" id="collapse"><i class="icon-menu"></i></a>
            </div>
            </form>
            <div class="navbar-right ml-auto h-100">
                <ul class="ml-auto p-0 m-0 list-unstyled d-flex top-icon h-100">
                    <li>
                        <select onchange="language_change(this.value)" name="language_change" id="language_change">
                            <option value="" disabled selected>Change Language</option>
                            <option value="arabic">Arabic</option>
                            <option value="english">English</option>
                        </select>
                    </li>
                    <li class="dropdown user-profile align-self-center d-inline-block">
                        <a href="#" class="nav-link py-0" data-toggle="dropdown" aria-expanded="false">
                            <div class="media">
                                <?php
                                $language = $this->session->userdata('language');
                                $user = $this->db->where('id', $this->session->userdata('id'))->get('user')->row();
                                echo $user->user_name;
                                $hotel = $this->db->where('hotel_id', $this->session->userdata('hotel_id'))->get('hotel')->row();
                                if ($language == 'english') {
                                    ?>
                                    <p>User:<b><?php echo $user->user_name ?></b></p>
                                    <p>Hotel:<b><?php echo $hotel->hotel_name_in_english ?></b></p>
                                    <?php
                                } else {
                                    ?>
                                    <p>User:<b><?php echo $user->user_name ?></b></p><br>
                                    <p>Hotel:<b><?php echo $hotel->hotel_name_in_arabic ?></b></p>
                                    <?php

                                }
                                if ($user->picture == '') {
                                    ?>
                                    <img src="<?php echo base_url() ?>assets/uploads/users/image_icon.png" alt=""
                                         class="d-flex img-fluid rounded-circle"
                                         width="29">
                                    <?php
                                } else {
                                    ?>
                                    <img src="<?php echo base_url() ?>assets/uploads/users/<?php echo $user->picture ?>"
                                         alt="" class="d-flex img-fluid rounded-circle"
                                         width="29">
                                    <?php
                                }
                                ?>
                            </div>
                        </a>

                        <div class="dropdown-menu border dropdown-menu-right p-0">

                            <a href="<?php echo base_url() ?>admin/log_out"
                               class="dropdown-item px-2 text-danger align-self-center d-flex">
                                <span class="icon-logout mr-2 h6  mb-0"></span> Sign Out</a>
                        </div>

                    </li>

                </ul>
            </div>
        </nav>
    </div>
</div>