<div class="card ">
    <div class="card-header bg-primary">
        <h6 class="card-title" style="text-align: center;color: white">Income Report</h6>
    </div>
    <div class="card-content" style="min-height: 500px;">
        <div class="card-body">
            <form>
                <div class="form-row">
                   <div class="form-group col-md-2">
                      <label for="inputEmail4">From Date</label>
                        <input type="text" class="form-control datepicker" value="" name="from_date" id="from_date" placeholder="From Date">
                    </div>
                  <div class="form-group col-md-2">
                      <label for="inputPassword4">To Date</label>
                       <input type="text" class="form-control datepicker" value="" id="to_date" name="to_date" placeholder="To Date">
                    </div>
                  
                    <div class="form-group col-md-2">
                        <label for="inputPassword4"></label>
                        <input onclick="income_report_load()" style="color: white" type="button" class="form-control bg-primary" id="submit_button" value="Submit">
                    </div>
                </div>
            </form>
        </div>
        <div id="income_report">

        </div>
    </div>
</div>

<script>
    function income_report_load()
    {
        var from_date = $('#from_date').val();
        var to_date = $('#to_date').val();
      
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (xhttp.readyState == 4 && xhttp.status == 200) {

                document.getElementById("income_report").innerHTML = xhttp.responseText;

            }
        }
        //                    alert(xhttp.responseText);
        xhttp.open("POST", "<?php echo site_url('ReportController/income_report_load'); ?>", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        //            xhttp.send("fname=Henry&lname=Ford");
        xhttp.send("from_date=" + from_date+"&to_date="+to_date);
    }
</script>