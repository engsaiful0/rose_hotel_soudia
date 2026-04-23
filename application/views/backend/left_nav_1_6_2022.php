<div class="site-width">
    <!-- START: Menu-->
    <?php
    $language = $this->session->userdata('language');
    $hotel_id = $this->session->userdata('hotel_id');
    ?>
    <ul id="side-menu" class="sidebar-menu">
        <li class="dropdown active">
            <ul>
                <li><a href="<?php echo base_url() ?>adminHome"><i class="icon-home mr-1"></i>
                        <?php
                        if ($language == 'english') {
                            ?>
                            Home
                            <?php
                        } else {
                            ?>
                            <h4 >الصفحة الرئيسية</h4>
                            <?php
                        }
                        ?>
                    </a>
                </li>
                <li class="dropdown">
                    <a href="#"><i class="fa fa-hotel "></i>
                        <?php
                        if ($language == 'english') {
                            ?>
                            Day
                            <?php
                        } else {
                            ?>
                            يوم
                            <?php
                        }
                        ?>
                    </a>
                    <ul class="sub-menu">
                        <li><a href="<?php echo base_url() ?>add-check-in"><i class="fa fa-list"></i>
                                <?php
                                if ($language == 'english') {
                                    ?>
                                    Add
                                    <?php
                                } else {
                                    ?>
                                    يضيف
                                    <?php
                                }
                                ?>
                            </a>
                        </li>
                        <?php
                        $user_type = $this->session->userdata('type');
                        if ($user_type == 'admin' || $user_type == 'superadmin') {
                            ?>
                            <li><a href="<?php echo base_url() ?>view-check-in"><i class="fa fa-list"></i>
                                    <?php
                                    if ($language == 'english') {
                                        ?>
                                        View
                                        <?php
                                    } else {
                                        ?>رأي
                                        <?php
                                    }
                                    ?>
                                </a>
                            </li>
                            <?php
                        }
                        ?>
                    </ul>
                </li>

                <li class="dropdown">
                    <a href="#"><i class="fa fa-hotel "></i>
                        <?php
                        if ($language == 'english') {
                            ?>
                            Month
                            <?php
                        } else {
                            ?>
                            شهر
                            <?php
                        }
                        ?>
                    </a>
                    <ul class="sub-menu">
                        <li><a href="<?php echo base_url() ?>add-check-in-month"><i class="fa fa-list"></i>
                                <?php
                                if ($language == 'english') {
                                    ?>
                                    Add
                                    <?php
                                } else {
                                    ?>
                                    يضيف
                                    <?php
                                }
                                ?>
                            </a>
                        </li>
                        <?php
                        $user_type = $this->session->userdata('type');
                        if ($user_type == 'admin' || $user_type == 'superadmin') {
                            ?>
                            <li><a href="<?php echo base_url() ?>view-check-in-month"><i class="fa fa-list"></i>
                                    <?php
                                    if ($language == 'english') {
                                        ?>
                                        View
                                        <?php
                                    } else {
                                        ?>رأي
                                        <?php
                                    }
                                    ?>
                                </a>
                            </li>
                            <?php
                        }
                        ?>
                    </ul>
                </li>
                <?php
                $user_type = $this->session->userdata('type');
                if ($user_type == 'superadmin'||$user_type == 'admin') {
                    ?>
                    <li><a href="<?php echo base_url() ?>add-expense"><i class="fa fa-list"></i>
                            <?php
                            if ($language == 'english') {
                                ?>
                                Expense
                                <?php
                            } else {
                                ?>مصروف
                                <?php
                            }
                            ?>
                        </a></li>

                    <?php
                }
                ?>
                <?php
                $user_type = $this->session->userdata('type');
                if ($user_type == 'superadmin'||$user_type == 'admin') {
                    ?>
                    <li><a href="<?php echo base_url() ?>add-late"><i class="fa fa-list"></i>
                            <?php
                            if ($language == 'english') {
                                ?>
                                Late
                                <?php
                            } else {
                                ?>متأخر
                                <?php
                            }
                            ?>
                        </a></li>

                    <?php
                }
                ?>
                <?php
                $user_type = $this->session->userdata('type');
                if ($user_type == 'superadmin') {
                    ?>
                    <li class="dropdown"><a href="#"><i class="fa fa-list "></i>
                            <?php
                            if ($language == 'english') {
                                ?>
                                Report
                                <?php
                            } else {
                                ?>
                                تقرير
                                <?php
                            }
                            ?>
                        </a>
                        <ul class="sub-menu">
                            <li><a href="<?php echo base_url() ?>expense-report"><i class="fa fa-list"></i>
                                    <?php
                                    if ($language == 'english') {
                                        ?>
                                        Expense Report
                                        <?php
                                    } else {
                                        ?>
                                        تقرير المصاريف
                                        <?php
                                    }
                                    ?>
                                </a></li>
                            <li><a href="<?php echo base_url() ?>monthly-expense-report"><i class="fa fa-list"></i>
                                    <?php
                                    if ($language == 'english') {
                                        ?>
                                        Monthly Expense Report
                                        <?php
                                    } else {
                                        ?>
                                        تقرير المصاريف الشهرية
                                        <?php
                                    }
                                    ?>
                                </a></li>
                            <li><a href="<?php echo base_url() ?>credit-report"><i class="fa fa-list"></i>
                                    <?php
                                    if ($language == 'english') {
                                        ?>
                                        Credit Report
                                        <?php
                                    } else {
                                        ?>
                                        تقرير الائتمان
                                        <?php
                                    }
                                    ?>
                                </a></li>
                            <li><a href="<?php echo base_url() ?>checkinday-report"><i class="fa fa-list"></i>
                                    <?php
                                    if ($language == 'english') {
                                        ?>
                                        Checkin(Day) Report
                                        <?php
                                    } else {
                                        ?>
                                        تقرير تسجيل الوصول (اليوم)
                                        <?php
                                    }
                                    ?>
                                </a></li>
                            <li><a href="<?php echo base_url() ?>checkinmonth-report"><i class="fa fa-list"></i>
                                    <?php
                                    if ($language == 'english') {
                                        ?>
                                        Checkin(Month) Report
                                        <?php
                                    } else {
                                        ?>
                                        تقرير تسجيل الوصول (شهر)
                                        <?php
                                    }
                                    ?>
                                </a></li>
                        </ul>
                    </li>
                    <?php
                }
                ?>
                <?php
                $user_type = $this->session->userdata('type');
                if ($user_type == 'superadmin') {
                    ?>
                    <li class="dropdown"><a href="#"><i class="fa fa-users "></i>
                            <?php
                            if ($language == 'english') {
                                ?>
                                User
                                <?php
                            } else {
                                ?>مستخدم
                                <?php
                            }
                            ?>
                        </a>
                        <ul class="sub-menu">
                            <li><a href="<?php echo base_url() ?>add-user"><i class="fa fa-list"></i>
                                    <?php
                                    if ($language == 'english') {
                                        ?>
                                        Add
                                        <?php
                                    } else {
                                        ?>
                                        يضيف
                                        <?php
                                    }
                                    ?>
                                </a>
                            </li>
                            <li><a href="<?php echo base_url() ?>view-user"><i class="fa fa-list"></i>
                                    <?php
                                    if ($language == 'english') {
                                        ?>
                                        View
                                        <?php
                                    } else {
                                        ?>رأي
                                        <?php
                                    }
                                    ?>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <?php
                }
                ?>


                <li class="dropdown"><a href="#"><i class="icon-wrench"></i>
                        <?php
                        if ($language == 'english') {
                            ?>
                            Setting
                            <?php
                        } else {
                            ?>ضبط
                            <?php
                        }
                        ?>
                    </a>
                    <ul class="sub-menu">
                        <?php
                        $user_type = $this->session->userdata('type');
                        if ($user_type == 'admin' || $user_type == 'superadmin') {
                            ?>
                            <li><a href="<?php echo base_url() ?>company-setting"><i class="icon-energy"></i>
                                    <?php
                                    if ($language == 'english') {
                                        ?>
                                        Company
                                        <?php
                                    } else {
                                        ?>شركة
                                        <?php
                                    }
                                    ?>
                                </a></li>

                            <li><a href="<?php echo base_url() ?>add-room"><i class="icon-energy"></i>
                                    <?php
                                    if ($language == 'english') {
                                        ?>
                                        Room
                                        <?php
                                    } else {
                                        ?>غرفة
                                        <?php
                                    }
                                    ?>
                                </a></li>
                            <?php
                        }
                        $user_type = $this->session->userdata('type');
                        if ($user_type == 'superadmin') {
                            ?>
                            <li><a href="<?php echo base_url() ?>add-hotel"><i class="icon-energy"></i>
                                    <?php
                                    if ($language == 'english') {
                                        ?>
                                        Hotel
                                        <?php
                                    } else {
                                        ?>الفندق
                                        <?php
                                    }
                                    ?>
                                </a></li>
                            <?php
                        }
                        ?>
                        <?php
                        $user_type = $this->session->userdata('type');
                        if ($user_type == 'admin' || $user_type == 'superadmin') {
                            ?>
                            <li><a href="<?php echo base_url() ?>database-backup"><i class="icon-energy"></i>
                                    <?php
                                    if ($language == 'english') {
                                        ?>
                                        Database
                                        <?php
                                    } else {
                                        ?>الفندققاعدة البيانات
                                        <?php
                                    }
                                    ?>
                                </a>
                            </li>
                            <?php
                        }
                        ?>
                    </ul>
                </li>
                <li>

                    <a class="logout " style="text-decoration: none;font-size: 16px;"
                       href="<?php echo base_url() ?>admin/log_out"/> <i class="icon-logout"></i>
                    <?php
                    if ($language == 'english') {
                        ?>
                        Logout
                        <?php
                    } else {
                        ?>

                        تسجيل خروج

                        <?php
                    }
                    ?>

                    </a></li>

            </ul>
        </li>


    </ul>
    <!-- END: Menu-->
    <ol class="breadcrumb bg-transparent align-self-center m-0 p-0 ml-auto">
        <li class="breadcrumb-item"><a href="#">Application</a></li>
        <li class="breadcrumb-item active">Dashboard</li>
    </ol>
</div>


