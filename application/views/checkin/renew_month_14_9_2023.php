<script>

    function SomeDeleteRowFunction(btndel) {

        if (typeof (btndel) == "object") {
            $(btndel).closest("tr").remove();
        } else {
            return false;
        }
        grandRentCalculate();
    }


    function load_product_row() {
        $('#img').show();
        var id = document.getElementById("idControl").value * 1;
        document.getElementById("idControl").value = id + 1;
        id = Number(id) + 1;
        // alert(id);

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (xhttp.readyState == 4 && xhttp.status == 200) {

                var newdiv = document.createElement('tr');
                newdiv.innerHTML = xhttp.responseText;
                document.getElementById('product_table').appendChild(newdiv);
                for (var i = 4; i <= id; i++) {

                    $('#roomnumberid_' + i).select2();
                    $('#day_or_month_or_year_' + i).select2();

                    $('#dateOfExit_' + i).datepicker({
                        "changeMonth": true,
                        "changeYear": true,
                        "dateFormat": "dd-mm-yy",
                        "yearRange": '1995:2030'
                    });

                    $('#dateOfEntry_' + i).datepicker({
                        "changeMonth": true,
                        "changeYear": true,
                        "dateFormat": "dd-mm-yy",
                        "yearRange": '1995:2030'
                    });
                }

                $('#img').hide();
            }
        }
        xhttp.open("POST", "<?php echo site_url('CheckinController/load_product_row'); ?>", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        //            xhttp.send("fname=Henry&lname=Ford");
        xhttp.send("id=" + id);
    }

</script>

<div class="row">
    <img src="<?php echo base_url() ?>assets/ajax-loader.gif" id="img"
         style="display:none;position:fixed;z-index:1"/>
    <div class="col-12">
        <?php

        if ($this->session->userdata('success') != '') {
            ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>
                    <?php
                    //                    echo $this->session->userdata('success');
                    //                    $sdata = array(
                    //                        'success' => ''
                    //                    );
                    //                    $this->session->set_userdata($sdata);
                    ?>
                </strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <?php
        }

        $language = $this->session->userdata('language');
        $hotel_id = $this->session->userdata('hotel_id');

        $checkin_details=$this->db->where('checkin_details_id',$checkin_details_id)->get('checkin_details')->row();
        $checkin=$this->db->where('checkin_id',$checkin_details->checkin_id)->get('checkin')->row();
        $checkin_id=$checkin_details->checkin_id;
        ?>

        <form method="get" enctype="multipart/form-data"
              action="<?php echo base_url() ?>renew-month-save">
            <input type="hidden"  name="day_or_month" value="month">
            <?php
            $uniquid = $this->db->select('*')->get('checkin');
            $uniquid = time().'day'.$hotel_id. str_pad($uniquid->num_rows() + 1, 5, '0', STR_PAD_LEFT);
            ?>
            <input type="hidden"  name="uniquid" value="<?php echo $uniquid?>">
            <input type="hidden"  name="checkin_id" value="<?php echo $checkin_id?>">
            <input type="hidden"  name="checkin_details_id" value="<?php echo $checkin_details_id?>">

            <input type="hidden"  name="hotel_id" value="<?php echo $hotel_id?>">
            <div class="card">
                <div class="card-header bg-info">
                    <h3 style="text-align: center">
                        <?php
                        if ($language == 'english') {
                            ?>
                            Renew(Month)
                            <?php
                        } else {
                            ?>
                            تجديد
                            <?php
                        }
                        ?>
                    </h3>

                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="inputEmail4">
                                        <?php
                                        $placeholder_guest_name='';
                                        if ($language == 'english') {
                                            echo 'Name';
                                            $placeholder_guest_name='Enter Guest Name';
                                        } else {
                                            echo 'الإسم';
                                            $placeholder_guest_name='أدخل اسم الضيف';
                                        }
                                        ?>
                                    </label>
                                    <input  class="form-control" required name="guest_name"
                                            id="guest_name" value="<?php echo $checkin->guest_name?>"
                                            placeholder="<?php echo $placeholder_guest_name?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="inputEmail4">
                                        <?php

                                        if ($language == 'english') {
                                            echo 'Id Number';
                                        } else {
                                            echo 'رقم البطاقة';
                                        }
                                        ?>
                                    </label>
                                    <?php
                                    $uniqu_id = $this->db->where('hotel_id', $hotel_id)->get('checkin_id');
                                    $guest_unique_id = $uniqu_id->num_rows() + 1;
                                    $uniqu_ids = $this->db->where('hotel_id', $hotel_id)->get('checkin_id')->result();
                                    ?>
                                    <input type="hidden" id="guest_type" name="guest_type" value="new">
                                    <input value="<?php echo $checkin->guest_unique_id ?>" readonly onchange="infoLoad(this.value)" type="text" class="form-control"
                                           name="guest_unique_id"
                                           id="guest_unique_id" list="guest_unique_ids"/>
                                </div>
                            </div>
                        </div>
                    </div>

                    <input type="hidden" id="idControl" value="1">
                    <input type="hidden" id="current_id" value="1">
                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="inputEmail4">
                                        <?php
                                        if ($language == 'english') {
                                            echo 'Country';
                                        } else {
                                            echo 'الجنسية';
                                        }
                                        ?>
                                    </label>
                                    <select class="form-control" required name="country_id"
                                            id="country_id_all">
                                        <?php
                                        $countries = $this->db->select('*')->get('countries')->result();
                                        foreach ($countries as $countrie) {
                                            $selected='';
                                            if($countrie->country_id==$checkin->country_id)
                                            {
                                                $selected='selected';
                                            }
                                            ?>
                                            <option <?php echo $selected?> value="<?php echo $countrie->country_id ?>"><?php
                                                if ($language == 'english') {
                                                    echo $countrie->country_enName;
                                                } else {
                                                    echo $countrie->country_arName;

                                                }
                                                ?></option>
                                            <?php
                                        }
                                        ?>

                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="inputEmail4"><?php
                                        $placeholder_place='';
                                        if ($language == 'english') {
                                            echo 'Place';
                                            $placeholder_place='Enter Place';
                                        } else {
                                            echo 'مكان الإصدار';
                                            $placeholder_place='أدخل المكان';
                                        }
                                        ?></label>
                                    <input readonly value="<?php echo $checkin->place?>" class="form-control" required name="place"
                                           id="place"
                                           placeholder="<?php echo $placeholder_place?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="inputEmail4"><?php
                                        $dateOfBirthPlaceHolder='';
                                        if ($language == 'english') {
                                            echo 'Birthday';
                                            $dateOfBirthPlaceHolder='Birthday';
                                        } else {
                                            echo 'الميلاد';
                                            $dateOfBirthPlaceHolder='الميلاد';
                                        }
                                        ?></label>
                                    <input readonly class="form-control" required name="date_of_birth" value="<?php echo date('d-m-Y',strtotime($checkin->date_of_birth))?>"
                                           id="datepicker"
                                           placeholder="<?php echo $dateOfBirthPlaceHolder?>">

                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="inputEmail4"><?php
                                        $mobilePlaceholder='';
                                        if ($language == 'english') {
                                            echo 'Mobile';
                                            $mobilePlaceholder='Mobile';
                                        } else {
                                            echo 'جوال';
                                            $mobilePlaceholder= 'جوال';
                                        }
                                        ?></label>
                                    <input  class="form-control" required name="mobile"
                                            id="mobile" value="<?php echo $checkin->mobile?>"
                                            placeholder="<?php echo $mobilePlaceholder?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="inputEmail4"><?php
                                        $profession_id_placeholder='';
                                        if ($language == 'english') {
                                            echo 'Profession';
                                            $profession_id_placeholder='Profession';
                                        } else {
                                            echo 'المهنة';
                                            $profession_id_placeholder='المهنة';
                                        }
                                        ?></label>
                                    <input  class="form-control" required name="profession_id"
                                            id="profession_id" value="<?php echo $checkin->profession_id?>"
                                            placeholder="<?php echo $profession_id_placeholder?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="inputEmail4"><?php
                                        $subtotal_placeholder='';
                                        if ($language == 'english') {
                                            echo 'Sub Total';
                                            $subtotal_placeholder='';
                                        } else {
                                            echo 'المجموع الفرعي';
                                            $subtotal_placeholder='المجموع الفرعي';
                                        }
                                        ?></label>
                                    <input type="text" readonly placeholder="<?php echo $subtotal_placeholder?>" class="form-control" value="<?php echo $checkin->grandRent?>"
                                           required name="grandRent" id="grandRent">
                                </div>
                            </div>
                        </div>
                    </div>

                    <fieldset>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <table id="product_table"
                                               class="table table-bordered table-striped table-hover">
                                            <?php
                                            include 'table_header_month.php';
                                            ?>

                                            <tr>
                                                <td>
                                                    <select  style="width: 150px" required class="form-control"  name="day_or_month_or_year"
                                                             id="day_or_month_or_year_1">
                                                        <option><?php echo $checkin_details->day_or_month_or_year?></option>
                                                        <?php
                                                        include 'month.php';
                                                        ?>
                                                    </select>
                                                </td>
                                                <td>
                                                    <?php
                                                    $rooms = $this->db->where('hotel_id', $hotel_id)->where('status', 'Free')->order_by('room_no_in_english','asc')->get('room')->result();
                                                    $room_single = $this->db->where('room_id', $checkin_details->room_id)->get('room')->row();

                                                    ?>
                                                    <select  style="width: 150px" required class="form-control"  name="room_id"
                                                             id="roomnumberid_1">
                                                        <option  value="<?php echo $room_single->room_id ?>"><?php
                                                            if ($language == 'english') {
                                                                echo $room_single->room_no_in_english;
                                                            } else {
                                                                echo $room_single->room_no_in_arabic;
                                                            }
                                                            ?></option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <input   class="form-control" required name="dateOfEntry" value="<?php echo date('d-m-Y')?>"
                                                             id="dateOfEntry_1"
                                                             placeholder="<?php echo $dateOfEntryPlaceHolder?>">
                                                </td>
                                                <td>
                                                    <input class="form-control" required name="dateOfExit"
                                                           id="dateOfExit_1" value="<?php echo date('d-m-Y',strtotime($checkin_details->dateOfExit))?>"
                                                           placeholder="<?php echo $dateOfExitPlaceHolder?>">
                                                </td>
                                                <td>
                                                    <input oninput="subTotalCalculate()" value="<?php echo $checkin_details->rent?>"
                                                           onkeypress="return isNumberKey(this, event);"
                                                           class="form-control" required
                                                           name="rent" id="rent_1">
                                                </td>
                                                <td style="display: none">
                                                    <input style="display: none" oninput="due_cal(this.id)"  placeholder="<?php echo $paid?>" class="form-control"
                                                           name="paid" id="paid_1">
                                                </td>
                                                <td>
                                                    <input  placeholder="<?php echo $due?>" class="form-control"
                                                            name="due" id="due_1">
                                                </td>

                                                <td>
                                                    <select class="form-control"  name="cash_or_credit" id="cash_or_credit_1">
                                                        <option value="cash"><?php
                                                            if ($language == 'english') {
                                                                echo 'Cash';
                                                            } else {
                                                                echo 'السيولة النقدية';
                                                            }
                                                            ?></option>
                                                        <option value="credit"><?php
                                                            if ($language == 'english') {
                                                                echo 'Credit';
                                                            } else {
                                                                echo 'تنسب إليه';
                                                            }
                                                            ?></option>
                                                    </select>
                                                </td>
                                                <td >
                                                    <input class="form-control" type="file" name="image_1"
                                                           id="image_1">
                                                    <input class="form-control" type="hidden" name="image_1_name" id="image_1_name">
                                                </td>

                                                <td style="display: none">
                                                    <input class="form-control" value="<?php echo $checkin_details->account_number?>" name="account_number"
                                                           id="account_number_1">
                                                </td>
                                                <td>
                                                    <input class="form-control"  name="insurance" value="<?php echo $checkin_details->insurance?>"
                                                           id="insurance_1">
                                                </td>
                                                <td></td>
                                            </tr>


                                        </table>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </fieldset>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-row">
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="inputEmail4">&nbsp;</label>
                                        <button  onclick="buttonDisable()" type="submit" class="btn btn-primary">
                                            Renew Save

                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>

    </form>
    <img src="<?php echo base_url() ?>assets/ajax-loader.gif" id="img" style="display:none;position:fixed;z-index:1"/>
</div>
<script>
    function buttonDisable()
    {
        document.getElementById('renewSaveButton').disabled=true;
        // $('#img').show();
    }
</script>