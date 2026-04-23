<tr>
    <td><?php
        if ($language == 'english') {
            echo 'Day';
        } else {
            echo 'المدة';
        }
        ?></td>
    <td><?php
        if ($language == 'english') {
            echo 'Room Number';
        } else {
            echo 'رقم الشقة';
        }
        ?></td>
    <td><?php
        $dateOfExitPlaceHolder='';
        if ($language == 'english') {
            echo 'Date of Entry';
            $dateOfExitPlaceHolder='Date of Entry';
        } else {
            echo 'تاربخ الدخول';
            $dateOfExitPlaceHolder='تاربخ الدخول';
        }
        ?></td>
    <td><?php
        $dateOfEntryPlaceHolder='';
        if ($language == 'english') {
            echo 'Date of Exit';
            $dateOfEntryPlaceHolder='Date of Exit';
        } else {
            echo 'تاربخ الخروج';
            $dateOfEntryPlaceHolder= 'تاربخ الخروج';
        }
        ?></td>
    <td><?php
        if ($language == 'english') {
            echo 'Rent';
        } else {
            echo 'قيمة الإيجار';
        }
        ?></td>
    <td style="display: none">
        <?php
        $paid='';
        if ($language == 'english') {
            echo 'Paid';
            $paid='';
        } else {
            echo 'دفع';
            $paid='دفع';
        }
        ?>
    </td>
    <td><?php
        $due='';
        if ($language == 'english') {
            echo 'Due';
            $due='';
        } else {
            echo 'بسبب';
            $due='بسبب';
        }
        ?></td>
    <td><?php
        if ($language == 'english') {
            echo 'Cash/Credit';
        } else {
            echo 'السيولة النقدية/تنسب إليه';
        }
        ?></td>
    <td><?php
        if ($language == 'english') {
            echo 'Image';
        } else {
            echo 'صورة';
        }
        ?></td>
    <td style="display: none"><?php
        if ($language == 'english') {
            echo 'Account Number';
        } else {
            echo 'رقم حساب';
        }
        ?></td>
    <td><?php
        if ($language == 'english') {
            echo 'Insurance';
        } else {
            echo 'التامينات';
        }
        ?></td>
    <td></td>
</tr>