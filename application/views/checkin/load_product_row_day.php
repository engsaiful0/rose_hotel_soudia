<?php
$language = $this->session->userdata('language');
$hotel_id = $this->session->userdata('hotel_id');
?>
<?php
$dateOfEntryPlaceHolder='';
if ($language == 'english') {
    $dateOfEntryPlaceHolder='Date of Exit';
} else {
    $dateOfEntryPlaceHolder= 'تاربخ الخروج';
}
?>
<?php
$dateOfExitPlaceHolder='';
if ($language == 'english') {
    $dateOfExitPlaceHolder='Date of Entry';
} else {
    $dateOfExitPlaceHolder='تاربخ الدخول';
}
?>
<tr id="tr_<?php echo $id ?>">
    <td>
        <select style="width: 150px" class="form-control"  name="day_or_month_or_year[]"
                id="day_or_month_or_year_<?php echo $id ?>">
            <?php
            if ($language == 'english') {
                ?>
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
                <option>6</option>
                <option>7</option>
                <option>8</option>
                <option>9</option>
                <option>10</option>
                <option>11</option>
                <option>12</option>
                <option>13</option>
                <option>14</option>
                <option>15</option>
                <option>16</option>
                <option>17</option>
                <option>18</option>
                <option>19</option>
                <option>20</option>
                <option>21</option>
                <option>22</option>
                <option>23</option>
                <option>24</option>
                <option>25</option>
                <option>26</option>
                <option>27</option>
                <option>28</option>
                <option>29</option>
                <option>30</option>
                <option>31</option>
                <?php
            } else {
                ?>
                <option>١</option>
                <option>٢</option>
                <option>٣</option>
                <option>٤</option>
                <option>٥</option>
                <option>٦</option>
                <option>٧</option>
                <option>٨</option>
                <option>٩</option>
                <option>١٠</option>
                <option>١١</option>
                <option>١٢</option>
                <option>١٣</option>
                <option>١٤</option>
                <option>١٥</option>
                <option>١٦</option>
                <option>١٧</option>
                <option>١٨</option>
                <option>١٩</option>
                <option>٢٠</option>
                <option>٢١</option>
                <option>٢٢</option>
                <option>٢٣</option>
                <option>٢٤</option>
                <option>٢٥</option>
                <option>٢٦</option>
                <option>٢٧</option>
                <option>٢٨</option>
                <option>٢٩</option>
                <option>٣٠</option>
                <option>٣١</option>
                <?php
            }
            ?>
        </select>
    </td>
    <td>
        <select style="width: 150px" class="form-control"  name="room_id[]"
                id="roomnumberid_<?php echo $id ?>">
            <option></option>
            <?php
            $rooms = $this->db->where('hotel_id', $hotel_id)->where('status', 'Free')->order_by('room_no_in_english','asc')->get('room')->result();
            foreach ($rooms as $room) {
                ?>
                <option value="<?php echo $room->room_id ?>"><?php
                    if ($language == 'english') {
                        echo $room->room_no_in_english;
                    } else {
                        echo $room->room_no_in_arabic;
                    }
                    ?></option>
                <?php
            }
            ?>
        </select>
    </td>
    <td>
        <input class="form-control"  name="dateOfEntry[]" value="<?php echo date('d-m-Y')?>"
               id="dateOfEntry_1"
               placeholder="<?php echo $dateOfEntryPlaceHolder?>">
    </td>
    <td>
        <input class="form-control"  name="dateOfExit[]" value="<?php echo date('d-m-Y')?>"
               id="dateOfExit_1"
               placeholder="<?php echo $dateOfExitPlaceHolder?>">
    </td>
    <td>
        <input class="form-control" name="account_number[]"
               id="account_number_<?php echo $id ?>">
    </td>
    <td>
        <input oninput="subTotalCalculate()"
               onkeypress="return isNumberKey(this, event);"
               class="form-control"
               name="rent[]" id="rent_<?php echo $id ?>">
    </td>
    <td>
        <select class="form-control"  name="cash_or_credit[]" id="cash_or_credit_3">
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
    <td>
        <input class="form-control"  name="insurance[]"
               id="insurance_<?php echo $id ?>">
    </td>
    <td><input  style="width: 100%!important;color:black" type="button" onclick="SomeDeleteRowFunction(this)" readonly id="add_more_<?php echo $id ?>" title="Click TO Remove"  value="-"  ></td>
    </td>
</tr>