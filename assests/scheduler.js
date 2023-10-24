// Script to display schedule for againts users output
// Used Template literals (Template strings)
$("#pmScheduleFormBtn").click(function () {

    toastr.options = {
        "positionClass": "toast-bottom-right",
    };
    
    var text = "";
    var counter = 1;
    var htmlContent = "";

    // To get the current month
    var date_obj = new Date();
    var currentMonth = date_obj.toDateString().substr(4, 3);

    $.ajax({
        method: "POST",
        dataType: "json",
        data: $('#pmScheduleForm').serialize(),
        url: "inc/getSchedule.php",
        success: function (scheduleJson) {
            if(scheduleJson.error){
                toastr.error(scheduleJson.error, 'Error');
            }

            else{
                // Iterating over either month divisions (quaterly, tranually etc)
                scheduleJson.forEach(function (scheduleData) {
                    var cellData = "";
                    var months = Object.keys(scheduleData);

                    // Iterating over each month inside a division
                    months.forEach(function (month) {
                        // If the current month matches the month within the section display
                        // html on top
                        if (currentMonth == month) {
                            $(".currentMonthSpan").html(`${month} ${scheduleData[month]}`);
                        }

                        // Creating dynamic rows for table content
                        cellData +=
                            `<tr><td>${month}</td><td>${scheduleData[month]}</td></tr>`;
                    });

                    // For mentioning text over the table
                    if (counter == 1) {
                        text = "First";
                    } else {
                        text = "Next";
                    }

                    // Dynamic Output HTML Per JSON Data
                    htmlContent += `<div class="single col-lg-3 col-md-6 col-12">
                        <span class="fw-bold input-group-text justify-content-center" id="scheduleTableLabel">${text} Period</span>
                        <table class="table table-hover table-borderless">
                            <thead>
                            <tr>
                                <th scope="col">Month</th>
                                <th scope="col">Number Of Days</th>
                            </tr>
                            </thead>
                            <tbody>
                                ${cellData}
                            </tbody>
                        </table>
                    </div>`;

                    // For mentioning text over the table
                    counter++;
                });

                // Displaying output on frontend
                $('.outputDiv').removeClass('d-none');
                $('#perMonthSchedule').html(htmlContent);
            }

        },
        
        error: function (scheduleJson) {
            toastr.error(scheduleJson.error, 'Error');
        }
    });
});

$('#clearButton').click(function () {
    $('.outputDiv').addClass('d-none');
    $("#pmScheduleForm")[0].scrollIntoView();
});
