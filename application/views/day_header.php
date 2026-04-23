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
        if ($language == 'english') {
            echo 'Date of Entry';
        } else {
            echo 'تاربخ الدخول';
        }
        ?></td>
    <td><?php
        if ($language == 'english') {
            echo 'Date of Exit';
        } else {
            echo 'تاربخ الخروج';
        }
        ?></td>
    <td><?php
        if ($language == 'english') {
            echo 'Rent';
        } else {
            echo 'قيمة الإيجار';
        }
        ?></td>
       <td><?php
        $due = '';
        if ($language == 'english') {
            echo 'Due';
            $due = '';
        } else {
            echo 'بسبب';
            $due = 'بسبب';
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
            echo 'Insurance';
        } else {
            echo 'التامينات';
        }
        ?></td>
</tr>