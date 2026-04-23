<style>
    @media print {
        body * {
            visibility: hidden;
            font-size: 20px !important;
        }

        .td_color {
            background-color: #0a568d !important;
            color: white !important;
            -webkit-print-color-adjust: exact !important;
        }

        .row_color {
            background-color: #6AA42F !important;
            color: black !important;
            -webkit-print-color-adjust: exact !important;
        }

        #report, #report * {
            visibility: visible;
            overflow: visible;
        }

        #report {
            position: absolute;
            left: 0;
            top: 0;
        }

        .patient_table {
            width: 600px;
            margin: 0 auto;
        }

        /*table {*/
        /*    border: 1px solid black;*/
        /*}*/
    }
</style>
<div class="row">
    <div class="col-md-12">
        <button onclick="window.print()" class="btn btn-primary">Print</button>
    </div>
</div>
<div id="report">
    <?php
    include 'report_header.php';
    ?>
    <?php

    $language = $this->session->userdata('language');
    $hotel_id = $this->session->userdata('hotel_id');

    $checkin = $this->db->select('*')
        ->where('checkin_id', $checkin_id)
        ->get('checkin')->row();

    $country = $this->db->select('*')
        ->where('country_id', $checkin->country_id)
        ->get('countries')->row();

    $profession = $this->db->select('*')
        ->where('profession_id', $checkin->profession_id)
        ->get('profession')->row();

    $checkin_details = $this->db->select('*')
        ->where('checkin_id', $checkin_id)
        ->get('checkin_details')->result();


    ?>
    <table border="1" style="border-collapse: collapse;width: 97%;margin: 0 auto;margin-top: 5px;">
        <tr>
            <td style="text-align: center" colspan="4">عقد ايجار
            </td>
        </tr>
        <tr>
            <td class="td_color" style="background-color: #0a568d;color: white">
                <?php
                if ($language == 'english') {
                    ?>
                    Name
                    <?php
                } else {
                    ?>
                    الإسم
                    <?php
                }
                ?>
            </td>
            <td><?php echo $checkin->guest_name ?></td>
            <td class="td_color" style="background-color: #0a568d;color: white">
                <?php
                if ($language == 'english') {
                    ?>
                    ID Number
                    <?php
                } else {
                    ?>
                    رقم البطاقة
                    <?php
                }
                ?>
            </td>
            <td><?php echo $checkin->guest_unique_id ?></td>
        </tr>
        <tr>
            <td class="td_color" style="background-color: #0a568d;color: white">
                <?php
                if ($language == 'english') {
                    ?>
                    Country
                    <?php
                } else {
                    ?>
                    الجنسية
                    <?php
                }
                ?>
            </td>
            <td><?php
                if ($language == 'english') {
                    echo $country->country_enName;
                } else {
                    echo $country->country_arName;
                }
                ?></td>
            <td class="td_color" style="background-color: #0a568d;color: white">
                <?php
                if ($language == 'english') {
                    ?>
                    Place
                    <?php
                } else {
                    ?>
                    مكان الإصدار
                    <?php
                }
                ?>
            </td>
            <td><?php echo $checkin->place ?></td>
        </tr>
        <tr>
            <td class="td_color" style="background-color: #0a568d;color: white">
                <?php
                if ($language == 'english') {
                    ?>
                    Birthday
                    <?php
                } else {
                    ?>
                    الميلاد
                    <?php
                }
                ?>
            </td>
            <td><?php echo date('d-m-Y', strtotime($checkin->date_of_birth)) ?></td>
            <td class="td_color" style="background-color: #0a568d;color: white">
                <?php
                if ($language == 'english') {
                    ?>
                    Mobile
                    <?php
                } else {
                    ?>
                    جوال
                    <?php
                }
                ?>
            </td>

            <td><?php echo $checkin->mobile ?></td>
        </tr>
        <tr>
            <td class="td_color" style="background-color: #0a568d;color: white">
                <?php
                if ($language == 'english') {
                    ?>
                    Profession
                    <?php
                } else {
                    ?>
                    المهنة
                    <?php
                }
                ?>
            </td>
            <td><?php echo $checkin->profession_id ?></td>
            <td class="td_color" style="background-color: #0a568d;color: white">  <?php
                if ($language == 'english') {
                    ?>
                    Total
                    <?php
                } else {
                    ?>
                    المجموع
                    <?php
                }
                ?></td>
            <td><?php echo $checkin->grandRent ?></td>
        </tr>

    </table>
    <table border="1"
           style="border-collapse: collapse;width: 97%;margin: 0 auto;margin-top: 5px;  ">
        <tr class="row_color" style="background-color: #6AA42F;color: black">
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
        <?php
        foreach ($checkin_details as $checkin_detail) {
            $room = $this->db->select('*')
                ->where('room_id', $checkin_detail->room_id)
                ->get('room')->row();
            ?>
            <tr>
                <td><?php echo $checkin_detail->day_or_month_or_year ?></td>
                <td><?php echo $room->room_no_in_english ?></td>
                <td><?php echo date('d-m-Y', strtotime($checkin_detail->dateOfEntry)) ?></td>
                <td><?php echo date('d-m-Y', strtotime($checkin_detail->dateOfExit)) ?></td>
                <td><?php echo $checkin_detail->rent ?></td>
                <td><?php echo $checkin_detail->cash_or_credit ?></td>
                <td><?php echo $checkin_detail->insurance ?></td>
            </tr>
            <?php
        }
        ?>
        <tr>
            <td colspan="7" style="text-align: right">
                ١ - نعم أنا المستأجر اسمي أعلاه قد استلمت الشقة بمحتوياتها كاملة وأن أي تلف أو فقدان من محتويات الشقة
                حسب دفتر الأغراض فإني مسئول مسئولية كاملة عن دفع القيمة كاملة حسب تقييم المكتب .
            </td>
        </tr>
        <tr>
            <td colspan="7" style="text-align: right">
                ۲ - على الخروج قبل إنتهاء المدة المحددة وعند التأخير يحسب على ٢٤ ساعة بقيمتها علما بأن موعد التسليم
                الثانية ظهرا
            </td>
        </tr>
        <tr>
            <td colspan="7" style="text-align: right">
                ٣ - وعند خروجي قبل إنتهاء المدة المحددة فليس لدي الحق نے مطالبة باقي نقودي لأي سبب كان وعلى ذلك أوقع .
            </td>
        </tr>
        <tr>
            <td colspan="7" style="text-align: right">
                ٤ - يلزم الضيف بأنظمة وقوانين المملكة ويحترم عادات وتقاليد البلاد وعند مخالفته لذلك يعتبر العقد لاغي
                ويتم إخلاء الشقة فورا دون المطالبة بأي حق
            </td>
        </tr>
        <tr>
            <td colspan="7" style="text-align: right">
                ه - يلتزم المستأجر بالمحافظة على نظافة الشقة وتسليمها نظيفة كما استلمها وإلا يخصم مقابل ذلك .
            </td>
        </tr>
        <tr>
            <td colspan="7" style="text-align: right">
                ٦ - في حالة العثور على بقع حريق نتيجة الإستعمال المكواة أو السجائر أو أي حروق أخرى فسوف يتحمل الضيف قيمة
                استبدال الموكيت التالف .
            </td>
        </tr>
        <tr>
            <td colspan="7" style="text-align: right">
                ۷ - الإدارة غير مسؤولة عن أي أشياء ثمينة مثل المجوهرات وخلافه في حالة فقدانها ولا يجوز تركها داخل الشقة
                لأي طرف .
            </td>
        </tr>
        <tr>
            <td colspan="7" style="text-align: right">
                ۸ - أقر بمسئوليتي الكاملة عن ما معي من مرافقين وزوار وعن تصرفاتهم كاملة.
            </td>
        </tr>
        <tr>
            <td colspan="7" style="text-align: right">
                ۹ - يتوجب على المستأجر عند التجديد لتسديد قيمة الإيجار كاملة وإلا يعتبر العقد منتهي ويجب إخلاء الشقة
                فورا قرأت الشروط كاملة وعلمت بما فيها وأقربالإلتزام بكل بنود العقد وعلى ذلك أوقع .
            </td>
        </tr>
        <tr>
            <td colspan="7" style="text-align: right">
                ۱۰ - في حالة إلغاء العقد الشهري يحسب بالإيجار اليومي .
            </td>
        </tr>
        <tr>
            <td colspan="7" style="text-align: right">
                ۱۱ - في حالة فقدان الكرت يتم دفع ۱۰۰ ریال غرامة .
            </td>
        </tr>
        <tr>
            <td colspan="7" style="text-align: right">
                ۱۲ - في حالة التأخير عن موعد المغادرة يتم احتساب ۲۰ ريال عن كل ساعة تأخير ،
            </td>
        </tr>
    </table>
    <table border="1" style="border-collapse: collapse;width: 97%;margin: 0 auto;margin-top: 5px;">
        <tr>
            <td class="td_color" colspan="2" style="text-align: center;background-color: #0a568d;color: white">
                <?php
                if ($language == 'english') {
                    ?>
                    Customer signature
                    <?php
                } else {
                    ?>
                    توقيع العميل
                    <?php
                }
                ?>
            </td>
            <td class="td_color" colspan="2" style="text-align: center;background-color: #0a568d;color: white">
                <?php
                if ($language == 'english') {
                    ?>
                    Reception signature
                    <?php
                } else {
                    ?>
                    توقيع الاستقبال
                    <?php
                }
                ?>


            </td>
        </tr>
        <tr>
            <td colspan="2" style="width: 320px">
                <?php
                if ($language == 'english') {
                    ?>
                    Name
                    <?php
                } else {
                    ?>
                    الإسم
                    <?php
                }
                ?>


            </td>

            <td colspan="2" style="width: 320px">
                <?php
                if ($language == 'english') {
                    ?>
                    Name
                    <?php
                } else {
                    ?>
                    الإسم
                    <?php
                }
                ?>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <?php
                if ($language == 'english') {
                    ?>
                    Signature
                    <?php
                } else {
                    ?>
                    توقيع
                    <?php
                }
                ?>
            </td>

            <td colspan="2">
                <?php
                if ($language == 'english') {
                    ?>
                    Signature
                    <?php
                } else {
                    ?>
                    توقيع
                    <?php
                }
                ?>
            </td>

        </tr>
    </table>
</div>