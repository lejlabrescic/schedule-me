$(document).ready(function () {
    function getUrlParameter(name) {
        name = name.replace(/[[]/, '\\[').replace(/[\]]/, '\\]');
        var regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
        var results = regex.exec(location.search);
        return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
    }

    const classRoomNumber = getUrlParameter('classRoom');
    let startTime = null;
    let endTime = null;
    let selectedDateStr = null;
    var currentDate = new Date();

    $(document).on('click', '.date-container button', function () {
        var selectedDate = parseInt($(this).find('time').text(), 10);
        var selectedMonth = currentDate.getMonth() + 1;
        var selectedYear = currentDate.getFullYear();
        selectedDate = selectedDate < 10 ? '0' + selectedDate : selectedDate;
        selectedMonth = selectedMonth < 10 ? '0' + selectedMonth : selectedMonth;
        selectedDateStr = selectedYear + '-' + selectedMonth + '-' + selectedDate;
    });

    $('#saveStartTimeBtn').on('click', function () {
        startTime = $('#startTimeInput').val();
        $('.btn-start[data-target="#startTimeModal"]').html(startTime);
    });

    $('#saveEndTimeBtn').on('click', function () {
        endTime = $('#endTimeInput').val();
        $('.btn-start[data-target="#endTimeModal"]').html(endTime);
    });

    $('.Send-btn').on('click', function () {
        if (startTime && endTime && selectedDateStr) {
            var userId = sessionStorage.getItem("userId");
            var dataToSend = {
                startTime: startTime,
                endTime: endTime,
                selectedDate: selectedDateStr,
                classroomNumber: classRoomNumber,
                userId: userId
            };

            $.ajax({
                url: 'http://localhost/school/BackEnd/classRoomAppointment',
                type: 'POST',
                data: dataToSend,
                dataType: 'json',
                success: function (response) {
                    if (response.status === "success") {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: response.message,
                            timer: 3000,
                            showConfirmButton: false
                        });
                    }
                    if (response.status === "error") {
                        Swal.fire({
                            icon: 'info',
                            title: 'Already Taken!',
                            text: response.message,
                            timer: 3000,
                            showConfirmButton: false
                        });
                    }

                },
                error: function () {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'An error occurred during Ajax request.',
                        timer: 3000,
                        showConfirmButton: false
                    });
                }
            });
        } else {
            Swal.fire({
                icon: 'info',
                title: 'warning!',
                text: 'Please select both start and end times and choose a date.',
                timer: 3000,
                showConfirmButton: false
            });
        }
    });
});
