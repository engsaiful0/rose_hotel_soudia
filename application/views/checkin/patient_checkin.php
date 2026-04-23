<div class="col-12 mt-4">
    <div class="card">
        <div class="card-header bg-primary ">
            <h6 style="color:white;text-align:center" class="card-title">Add Patient Registration</h6>
        </div>
        <div class="card-content">
            <div class="card-body">
                <div class="row">
                    <div class="col-8">
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
                        $admission = $this->db->where('admission_id', $admission_id)->get('admission')->row();
                        $patient = $this->db->where('patient_id', $admission->patient_id)->get('checkin')->row();

                        ?>
                        <form method="post" enctype="multipart/form-data"
                              action="<?php echo base_url() ?>edit-patient-save">
                            <input type="hidden" value="<?php echo $admission->patient_id?>" name="patient_id">
                            <input type="hidden" value="<?php echo $admission_id?>" name="admission_id">
                            <div class="card">
                                <div class="card-header bg-info">
                                    <h4 style="text-align:center;color: white ">Patient's Information</h4>
                                </div>
                                <div class="card-body">
                                    <div class="form-row" style="display: none">
                                        <div class="form-group col-md-6">
                                            <label for="inputEmail4">Id No</label>

                                            <input class="form-control" readonly value="<?php echo $patient->auto_id?>" required name="auto_id" id="auto_id">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-row">
                                                <div class="form-group col-md-12">
                                                    <label for="inputEmail4">Patient's Full Name</label>
                                                    <input class="form-control" required name="patient_name"
                                                           id="patient_name" value="<?php echo $patient->patient_name?>"
                                                           placeholder="Enter Patient's Full Name">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-row">
                                                <div class="form-group col-md-12">
                                                    <label for="inputEmail4">Age</label>
                                                    <input class="form-control" required name="age" id="age" value="<?php echo $patient->age?>"
                                                           placeholder="Enter Age">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-row">
                                                <div class="form-group col-md-12">
                                                    <label for="inputEmail4">Date of Admission</label>
                                                    <input readonly class="form-control datepicker" required value="<?php echo date('d-m-y',strtotime($patient->date_of_admission)) ?>"
                                                           name="date_of_admission" id="date_of_admission"
                                                           placeholder="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-row">
                                                <div class="form-group col-md-12">
                                                    <label for="inputEmail4">Registration Number</label>
                                                    <input readonly class="form-control" required name="registration_number"
                                                           id="registration_number" value="<?php echo $patient->age?>"
                                                           placeholder="Enter Registration Number">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-row">
                                                <div class="form-group col-md-12">
                                                    <label for="inputEmail4">NID</label>
                                                    <input class="form-control" required name="nid" id="nid" value="<?php echo $patient->age?>"
                                                           placeholder="Enter NID">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-row">
                                                <div class="form-group col-md-12">
                                                    <label for="inputEmail4">Blood Group</label>

                                                    <select type="text" aria-required="true" required
                                                            class="form-control" name="blood_group"
                                                            id="blood_group">
                                                        <option <?php echo $patient->blood_group=='A+'? 'selected':'' ?>>A+</option>
                                                        <option <?php echo $patient->blood_group=='A-'? 'selected':'' ?>>A-</option>
                                                        <option <?php echo $patient->blood_group=='B+'? 'selected':'' ?>>B+</option>
                                                        <option <?php echo $patient->blood_group=='B-'? 'selected':'' ?>>B-</option>
                                                        <option <?php echo $patient->blood_group=='AB+'? 'selected':'' ?>>AB+</option>
                                                        <option <?php echo $patient->blood_group=='AB-'? 'selected':'' ?>>AB-</option>
                                                        <option <?php echo $patient->blood_group=='O+'? 'selected':'' ?>>O+</option>
                                                        <option <?php echo $patient->blood_group=='O-'? 'selected':'' ?>>O-</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-row">
                                                <div class="form-group col-md-12">
                                                    <label for="inputEmail4">Marital Status</label>
                                                    <select class="form-control" required name="marital_status"
                                                            id="marital_status" placeholder="Enter Marital Status">
                                                        <option <?php echo $patient->blood_group=='Married'? 'selected':'' ?>>Married</option>
                                                        <option <?php echo $patient->blood_group=='Unmarried'? 'selected':'' ?>>Unmarried</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-row">
                                                <div class="form-group col-md-12">
                                                    <label for="inputEmail4">Profession</label>
                                                    <select class="form-control" required name="profession_id"
                                                            id="relegion_id">
                                                        <option selected disabled value="">Select Profession</option>
                                                        <?php
                                                        $professions = $this->db->select('*')->get('profession')->result();
                                                        foreach ($professions as $profession) {
                                                            if($patient->profession_id==$profession->profession_id)
                                                            {
                                                                $selected='selected';
                                                            }
                                                            ?>
                                                            <option <?php echo $selected ?> value="<?php echo $profession->profession_id ?>" <?php echo $patient->profession_id==$profession->profession_id? 'selected':'' ?> ><?php echo $profession->profession_name ?></option>
                                                            <?php
                                                        }
                                                        ?>

                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-row">
                                                <div class="form-group col-md-12">

                                                    <label for="inputEmail4">Religion</label>
                                                    <select class="form-control" required name="religion_id"
                                                            id="religion_id">
                                                        <option selected disabled value="">Select Religion</option>
                                                        <?php
                                                        $religions = $this->db->select('*')->get('religion')->result();
                                                        foreach ($religions as $religion) {
                                                            if($patient->religion_id==$religion->religion_id)
                                                            {
                                                                $selected='selected';
                                                            }
                                                            ?>
                                                            <option <?php   echo $selected?> value="<?php echo $religion->religion_id ?>"><?php echo $religion->religion_name ?></option>
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
                                                    <label for="inputEmail4">Contact Number</label>
                                                    <input class="form-control" placeholder="Enter Contact Number" value="<?php echo $patient->contact_number?>"
                                                           required name="contact_number" id="contact_number">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-row">
                                                <div class="form-group col-md-12">
                                                    <label for="inputEmail4">Present Address</label>
                                                    <textarea class="form-control" name="present_address"
                                                              id="present_address" type="text"><?php echo $patient->present_address?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-row">
                                                <div class="form-group col-md-12">
                                                    <label for="inputEmail4">Permanent Address</label>
                                                    <textarea class="form-control" name="parmanent_address"
                                                              id="parmanent_address" type="text"><?php echo $patient->parmanent_address?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-row">
                                                <div class="form-group col-md-12">
                                                    <label for="inputEmail4">Remarks</label>
                                                    <textarea class="form-control" name="remarks" id="remarks"
                                                              type="text"><?php echo $patient->remarks?></textarea>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-row">
                                                <div class="form-row">
                                                    <div class="form-group col-md-12">
                                                        <label for="inputEmail4">Picture</label>
                                                        <input class="form-control" name="picture" id="picture"
                                                               type="file">
                                                        <input  class="form-control" value="<?php echo $patient->picture?>" name="picture_edit" id="picture"
                                                               type="hidden">
                                                        <img style="width: 100px;height: 100px;" src="<?php echo base_url()?>assets/picture/<?php echo $patient->picture ?>">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-row">
                                                <div class="form-group col-md-12">
                                                    <label for="inputEmail4">Gender</label>
                                                    <select class="form-control" required name="gender"
                                                            id="gender">
                                                        <option <?php echo $patient->blood_group=='Male'? 'selected':'' ?> >Male</option>
                                                        <option <?php echo $patient->blood_group=='Female'? 'selected':'' ?>>Female</option>
                                                        <option <?php echo $patient->blood_group=='Other'? 'selected':'' ?>>Other</option>
                                                    </select>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                    <fieldset>
                                        <legend>Referred By</legend>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-row">
                                                    <div class="form-group col-md-12">
                                                        <label for="inputEmail4">Referral Name</label>
                                                        <select class="form-control"
                                                                name="referral_id " id="referral_id ">
                                                            <?php
                                                            $referrals = $this->db->select('*')->get('referral ')->result();
                                                            foreach ($referrals as $referral) {
                                                                if($patient->referral_id==$referral->referral_id)
                                                                {
                                                                    $selected='selected';
                                                                }
                                                                ?>
                                                                <option <?php   echo $selected?> value="<?php echo $referral->referral_id ?>"><?php echo $referral->referral_name.'-'.$referral->phone ?></option>
                                                                <?php
                                                            }
                                                            ?>
                                                        </select>
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
                                                        <button type="submit" class="btn btn-primary">Update</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                    <div class="col-4">
                        <div class="card">
                            <div class="card-header bg-info">
                                <h4 style="text-align: center;color: white">Family Information</h4>
                            </div>
                            <div class="card-body">
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="inputEmail4">Father's Name</label>
                                        <input class="form-control" placeholder="Enter Father's Name" value="<?php echo $patient->fathers_name?>"
                                               required name="fathers_name" id="fathers_name">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="inputEmail4">Father's Occupation</label>
                                        <select class="form-control" required name="fathers_profession_id"
                                                id="fathers_profession_id">
                                            <?php
                                            $professions = $this->db->select('*')->get('profession')->result();
                                            foreach ($professions as $profession) {
                                                if($patient->fathers_profession_id==$profession->fathers_profession_id)
                                                {
                                                    $selected='selected';
                                                }
                                                ?>
                                                <option <?php echo $selected ?> value="<?php echo $profession->profession_id ?>"><?php echo $profession->profession_name ?></option>
                                                <?php
                                            }
                                            ?>

                                        </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="inputEmail4">Father's Contact Number</label>
                                        <input class="form-control" placeholder="Enter Father's Contact Number" value="<?php echo $patient->fathers_contact_number?>"
                                               required name="fathers_contact_number" id="fathers_contact_number">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="inputEmail4">Mother's Name</label>
                                        <input class="form-control" placeholder="Enter Mother's Name" value="<?php echo $patient->mothers_name?>"
                                               required name="mothers_name" id="mothers_name">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="inputEmail4">Mother's Occupation</label>
                                        <select class="form-control" required name="mothers_profession_id"
                                                id="mothers_profession_id">
                                            <?php
                                            $professions = $this->db->select('*')->get('profession')->result();
                                            foreach ($professions as $profession) {
                                                ?>
                                                <option <?php echo $patient->mothers_profession_id==$profession->mothers_profession_id? 'selected':'' ?> value="<?php echo $profession->profession_id ?>"><?php echo $profession->profession_name ?></option>
                                                <?php
                                            }
                                            ?>

                                        </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="inputEmail4">Mother's Contact Number</label>
                                        <input class="form-control" placeholder="Enter Mother's Contact Number"  value="<?php echo $patient->mothers_contact_number?>"
                                               required name="mothers_contact_number" id="mothers_contact_number">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="inputEmail4">Guardian's Name</label>
                                        <input class="form-control" placeholder="Enter Gurdian's Name"  value="<?php echo $patient->gurdians_name?>"
                                               required name="gurdians_name" id="gurdians_name">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="inputEmail4">Guardian's Occupation</label>
                                        <select class="form-control" required name="gurdians_profession_id"
                                                id="gurdians_profession_id">
                                            <?php
                                            $professions = $this->db->select('*')->get('profession')->result();
                                            foreach ($professions as $profession) {
                                                if($patient->gurdians_profession_id==$profession->fathers_profession_id)
                                                {
                                                    $selected='selected';
                                                }
                                                ?>
                                                <option <?php echo $selected ?> value="<?php echo $profession->profession_id ?>"><?php echo $profession->profession_name ?></option>
                                                <?php
                                            }
                                            ?>

                                        </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="inputEmail4">Guardian's Contact Number</label>
                                        <input class="form-control" placeholder="Enter Gurdian's Contact Number" value="<?php echo $patient->gurdians_contact_number?>"
                                               required name="gurdians_contact_number" id="gurdians_contact_number">
                                    </div>
                                </div>

                            </div>

                        </div>



                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
