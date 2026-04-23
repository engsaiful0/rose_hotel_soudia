<?php
$banner = $this->db->where('banner_id', '1')->get('company')->row();
?>

        <table style="width: 70%;margin: 0 auto">
            <tr>
                <td rowspan="2">
                    <img style=" width: 100%;height: 70px;" src="<?php echo base_url() ?>assets/uploads/banner/<?php echo $banner->report_banner ?>">
                </td>

            </tr>
        </table>


