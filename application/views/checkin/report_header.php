<?php
$language = $this->session->userdata('language');
//$hotel_id = $this->session->userdata('hotel_id');
//if($hotel_id=='')
//{
    $checkin = $this->db->select('*')
        ->where('checkin_id', $checkin_id)
        ->get('checkin')->row();
    $hotel_id=$checkin->hotel_id;
    print_r($hotel_id);
//    die;
//}


$banner = $this->db->where('hotel_id', $hotel_id)->get('company')->row();
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">

            <img style=" width: 100%;height: 90px;" src="<?php echo base_url() ?>assets/uploads/banner/<?php echo $banner->report_banner ?>">
        </div>
    </div>

</div>




