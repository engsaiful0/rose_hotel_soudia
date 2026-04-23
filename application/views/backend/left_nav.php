<style>
    .menu-li
    {
    background-color:#1E3D73;border-top: 5px solid white;
    }
    li a:hover
    {
        background-color: green;
    }
    .sub-menu li{
        border-top: 5px solid white;
    }
</style>
<div  class="site-width bg-primary">
    <!-- START: Menu-->
    <?php
    $language = $this->session->userdata('language');
    $hotel_id = $this->session->userdata('hotel_id');
    ?>
    <ul id="side-menu" class="sidebar-menu">
        <li class="dropdown active">
            <ul>
                <li class=" menu-li">

                    <a class="logout " style="text-decoration: none;font-size: 16px;color:white"
                       href="<?php echo base_url() ?>adminHome"/> <i style="padding-left: 5px"style="padding-left: 5px" class="icon-home"></i>
                    <?php
                    if ($language == 'english') {
                        ?>
                        Home
                        <?php
                    } else {
                        ?>

                        الصفحة الرئيسية

                        <?php
                    }
                    ?>

                    </a></li>

                <li class="dropdown  menu-li" style=""">
                    <a style="color:white" href="#"><i style="padding-left: 5px"style="padding-left: 5px" class="fa fa-hotel "></i>
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
                        <li><a style="color:white" href="<?php echo base_url() ?>add-check-in"><i style="padding-left: 5px" class="fa fa-list"></i>
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
                            <li><a style="color:white" href="<?php echo base_url() ?>view-check-in"><i style="padding-left: 5px"class="fa fa-list"></i>
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

                <li class="dropdown  menu-li">
                    <a style="color:white" href="#"><i style="padding-left: 5px"class="fa fa-hotel "></i>
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
                        <li style="border-top: 5px solid white"><a style="color:white" href="<?php echo base_url() ?>add-check-in-month"><i style="padding-left: 5px"class="fa fa-list"></i>
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
                            <li><a style="color:white" href="<?php echo base_url() ?>view-check-in-month"><i style="padding-left: 5px"class="fa fa-list"></i>
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
                <li class="dropdown  menu-li">
                    <a style="color:white" href="#"><i style="padding-left: 5px"class="fa fa-hotel "></i>
                        <?php
                        if ($language == 'english') {
                            ?>
                            Transaction
                            <?php
                        } else {
                            ?>
                            عملية
                            <?php
                        }
                        ?>
                    </a>
                    <ul class="sub-menu">
                        <li style="border-top: 5px solid white"><a style="color:white" href="<?php echo base_url() ?>add-transaction"><i style="padding-left: 5px"class="fa fa-list"></i>
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
                            <li><a style="color:white" href="<?php echo base_url() ?>view-transaction"><i style="padding-left: 5px"class="fa fa-list"></i>
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
                <li class="dropdown  menu-li">
                    <a style="color:white" href="#"><i style="padding-left: 5px"class="fa fa-hotel "></i>
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
                    </a>
                    <ul class="sub-menu">
                        <li style="border-top: 5px solid white"><a style="color:white" href="<?php echo base_url() ?>add-expense"><i style="padding-left: 5px"class="fa fa-list"></i>
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
                             <li class=" menu-li"><a style="color:white" href="<?php echo base_url() ?>view-expense"><i style="padding-left: 5px"class="fa fa-list"></i>
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
                        </a></li>
                            <?php
                        }
                        ?>
                    </ul>
                </li>
                <?php
                $user_type = $this->session->userdata('type');
                if ($user_type == 'superadmin'||$user_type == 'admin') {
                    ?>
                   

                    <?php
                }
                ?>
                <?php
                $user_type = $this->session->userdata('type');
                if ($user_type == 'superadmin'||$user_type == 'admin') {
                    ?>
                    <li style="display: none;" class=" menu-li"><a style="color:white" href="<?php echo base_url() ?>add-late"><i style="padding-left: 5px"class="fa fa-list"></i>
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
                    <li class="dropdown  menu-li"><a style="color:white" href="#"><i style="padding-left: 5px"class="fa fa-list "></i>
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
                        <li><a style="color:white" href="<?php echo base_url() ?>transaction-report"><i style="padding-left: 5px"class="fa fa-list"></i>
                                    <?php
                                    if ($language == 'english') {
                                        ?>
                                        Transaction Report
                                        <?php
                                    } else {
                                        ?>
                                        تقرير المعاملات
                                        <?php
                                    }
                                    ?>
                                </a></li>
                            <li><a style="color:white" href="<?php echo base_url() ?>expense-report"><i style="padding-left: 5px"class="fa fa-list"></i>
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
                            <li><a style="color:white" href="<?php echo base_url() ?>monthly-expense-report"><i style="padding-left: 5px"class="fa fa-list"></i>
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
                            <li><a style="color:white" href="<?php echo base_url() ?>credit-report"><i style="padding-left: 5px"class="fa fa-list"></i>
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
                            <li><a style="color:white" href="<?php echo base_url() ?>checkinday-report"><i style="padding-left: 5px"class="fa fa-list"></i>
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
                            <li><a style="color:white" href="<?php echo base_url() ?>checkinmonth-report"><i style="padding-left: 5px"class="fa fa-list"></i>
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
                            <li><a style="color:white" href="<?php echo base_url() ?>monthly-checkinday-report"><i style="padding-left: 5px"class="fa fa-list"></i>
                                    <?php
                                    if ($language == 'english') {
                                        ?>
                                        Monthly Checkin Report
                                        <?php
                                    } else {
                                        ?>
                                        تقرير تسجيل الوصول الشهري
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
                    <li class="dropdown menu-li"><a style="color:white" href="#"><i style="padding-left: 5px"class="fa fa-users "></i>
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
                            <li><a style="color:white" href="<?php echo base_url() ?>add-user"><i style="padding-left: 5px"class="fa fa-list"></i>
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
                            <li><a style="color:white" href="<?php echo base_url() ?>view-user"><i style="padding-left: 5px"class="fa fa-list"></i>
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


                <li class="dropdown menu-li"><a style="color:white" href="#"><i style="padding-left: 5px"class="icon-wrench"></i>
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
                            <li><a style="color:white" href="<?php echo base_url() ?>company-setting"><i style="padding-left: 5px"class="icon-energy"></i>
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

                            <li><a style="color:white" href="<?php echo base_url() ?>add-room"><i style="padding-left: 5px"class="icon-energy"></i>
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
                                <li><a style="color:white" href="<?php echo base_url() ?>print-text"><i class="icon-energy"></i>
                                    <?php
                                    if ($language == 'english') {
                                        ?>
                                        Print Text
                                        <?php
                                    } else {
                                        
                                      ?>
                                      طباعة نص
                                        <?php
                                    }
                                    ?>
                                </a></li>
                            <?php
                        }
                        $user_type = $this->session->userdata('type');
                        if ($user_type == 'superadmin') {
                            ?>
                            <li><a style="color:white" href="<?php echo base_url() ?>add-hotel"><i style="padding-left: 5px"class="icon-energy"></i>
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
                            <li><a style="color:white" href="<?php echo base_url() ?>database-backup"><i style="padding-left: 5px"class="icon-energy"></i>
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
                <li style="border-bottom: 5px solid white" class=" menu-li">

                    <a class="logout " style="text-decoration: none;font-size: 16px;color: white"
                       href="<?php echo base_url() ?>admin/log_out"/> <i style="padding-left: 5px"class="icon-logout"></i>
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


