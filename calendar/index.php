<?php require("../header.php");?>
    <div class="container rounded bg-white p-5">
        <form id="myForm">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="start_datetime">Title</label>
                        <input type="text" id="title_datetime" name="title_datetime" class="form-control">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="start_datetime">Start Date & Time</label>
                        <input type="text" id="start_datetime" name="start_datetime" class="form-control">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="end_datetime">End Date & Time:</label>
                        <input type="text" id="end_datetime" name="end_datetime" class="form-control">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-sm-12 mb-3">
                    <h6 class="fw-bold mb-3">Date & Time Format example</h6>
                    <p>DD/MM/YYYY HH:MM AM/PM (or) DD/MM/YYYY</p>
                    <p>01/02/2024 10:30 AM (or) 01/02/2024</p>
                    <button type="button" class="btn btn-primary" onclick="onSubmit()">Submit</button>
                </div>
            </div>
            
        </form>
        <div id='calendar' class="container"></div>
    </div>
<?php require("../footer.php");?>
<script>
    $(document).ready(function () {

        $("#breadcrumb-title").html("Calendar")
        $("#breadcrumb-title-sub").html("Calendar Details")    
        	
    });
        var calendar = $('#calendar').fullCalendar({
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'listDay,listWeek,month'
			},

			// customize the button names,
			// otherwise they'd all just say "list"
			views: {
				listDay: { buttonText: 'list day' },
				listWeek: { buttonText: 'list week' }
			},

			defaultView: 'month',
			// defaultDate: date,
			// navLinks: true, // can click day/week names to navigate views
			editable: false,
			eventLimit: true, // allow "more" link when too many events
			eventAfterRender: function (event, element, view) {
                console.log("Event After Render called")
            },
            events: "../query_admin/calendar/fetch_calendar.php",
            eventRender: function (event, element, view) {
                if (event.allDay === 'true') {
                    event.allDay = true;
                } else {
                    event.allDay = false;
                }
            },
            selectable: true,
            selectHelper: true,
            eventClick: function (event) {
            var decision = confirm("Do you want to remove event?");
            console.log(event.id + " event.id")
                if (decision) {
                    $.ajax({
                    type: "POST",
                    url: "../query_admin/calendar/delete_calendar.php",
                    data: "&id=" + event.id,
                    success: function (response) {
                        $('#calendar').fullCalendar('removeEvents', event.id);
                        //alert("Updated Successfully");
                    }
                    });
                }

            },
            // select: function (start, end, allDay) {
            // var title = prompt('Event Title:');
            //     if (title) {
            //         var start = fmt(start);
            //         var end = fmt(end);
                    
            //         console.log(start + " start" + end +" end")
            //         return false;
            //         $.ajax({
            //         url: '../query_admin/calendar/add_calendar.php',
            //         data: 'title=' + title + '&start=' + start + '&end=' + end,
            //         type: "POST",
            //         success: function (response) {
            //             var data = JSON.parse(response);
            //             Swal.fire({
            //                 // title: "The Internet?",
            //                 text: data.message,
            //                 icon: data.event
            //             });
            //             calendar.fullCalendar('refetchEvents'); // This will refresh the event list
            //         }
            //         });
            //     }
            // calendar.fullCalendar('unselect');
            // },
		});
    function checkDateWithTime(dateString) {
        // Regular expression to check if the string contains both date and time
        const dateWithTimePattern = /^(0[1-9]|[12][0-9]|3[01])\/(0[1-9]|1[0-2])\/\d{4} (0[1-9]|1[0-2]):([0-5][0-9]) (AM|PM)$/;
        // Regular expression to check if the string contains only the date
        const dateOnlyPattern = /^(0[1-9]|[12][0-9]|3[01])\/(0[1-9]|1[0-2])\/\d{4}$/;

        if (dateWithTimePattern.test(dateString)) {
            // If the date matches the "date and time" pattern, return 1
            return 1;
        } else if (dateOnlyPattern.test(dateString)) {
            // If the date matches the "date only" pattern, return 2
            return 2;
        } else {
            // If neither pattern matches, return an error or invalid
            console.log("Invalid date format");
            return null;
        }
    }
    function convertToMySQLDateTime(dateStr) {
        // Split the input string into date and time with AM/PM
        let [datePart, timePart, ampm] = dateStr.split(' ');

        // Split the date part into day, month, and year
        let [day, month, year] = datePart.split('/');

        // Split the time part into hour and minute
        let [hour, minute] = timePart.split(':');

        // Convert hour to 24-hour format
        if (ampm === 'PM' && hour !== '12') {
            hour = (parseInt(hour) + 12).toString();  // Convert PM hour to 24-hour format
        } else if (ampm === 'AM' && hour === '12') {
            hour = '00';  // Handle the case for 12 AM (midnight)
        }

        // Pad values with leading zeroes where necessary
        hour = hour.padStart(2, '0');
        minute = minute.padStart(2, '0');
        day = day.padStart(2, '0');
        month = month.padStart(2, '0');

        // Return the formatted string in YYYY-MM-DD HH:MM:SS format
        return `${year}-${month}-${day} ${hour}:${minute}:00`;
    }

    // Function 2: Converts a date string "DD/MM/YYYY" to MySQL DATE format "YYYY-MM-DD"
    function convertToMySQLDate(dateStr) {
        // Split the date string into day, month, and year
        let [day, month, year] = dateStr.split('/');

        // Format to MySQL DATE format (YYYY-MM-DD)
        let mysqlDate = year + '-' + 
                        String(month).padStart(2, '0') + '-' + 
                        String(day).padStart(2, '0');

        return mysqlDate;
    }

    function onSubmit(){
        var startDateTime = $("#start_datetime").val().trim()
        var endDateTime = $("#end_datetime").val().trim()
        var titleDateTime = $("#title_datetime").val().trim()
        if(titleDateTime == ""){
            Swal.fire({
                // title: "Good job!",
                text: "Title is required",
                icon: "question"
            });
            return false;
        }
        var result1 = checkDateWithTime(startDateTime); 
        var result2 = checkDateWithTime(endDateTime); 
        // result1 is 1 its date & time then this value is 2 its date only
        var resStartDate = ""
        var resEndDate = ""
        if(result1 == 1 && result2 == 1 || result1 == 2 && result2 == 2){
            if(result1 == 1 && result2 == 1){
                resStartDate = convertToMySQLDateTime(startDateTime);
                resEndDate = convertToMySQLDateTime(endDateTime);
            }
            if(result1 == 2 && result2 == 2){
                resStartDate = convertToMySQLDate(startDateTime);
                resEndDate = convertToMySQLDate(endDateTime);
            }
            // console.log("accepted")
        }else{
            Swal.fire({
                // title: "Good job!",
                text: "Invalid Date time format please check",
                icon: "question"
            });
            return false
        }
        // console.log(resStartDate + " resStartDate")
              
        // console.log(resEndDate + " resEndDate")

        const formData = new FormData();
        formData.append("title", titleDateTime);
        formData.append("start", resStartDate);
        formData.append("end", resEndDate);
        
        $.ajax({
            type: "POST",
            url: '../query_admin/calendar/add_calendar.php',
            data: formData,
            processData: false, // Important for FormData
            contentType: false, // Important for FormData
            success: function (response) {
                var data = JSON.parse(response);
                Swal.fire({
                    // title: "The Internet?",
                    text: data.message,
                    icon: data.event
                });
                calendar.fullCalendar('refetchEvents');
            }
        });
    }
</script>