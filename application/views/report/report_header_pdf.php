<?php
$banner = $this->db->where('banner_id', '1')->get('company')->row();
?>

        <table style="width: 300px;margin: 0 auto">
            <tr>
                <td rowspan="2">
                    <img style="width: 400px;height: 70px;" src="assets/uploads/banner/<?php echo $banner->report_banner ?>">
                </td>

            </tr>
        </table>


