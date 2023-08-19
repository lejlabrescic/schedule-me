$(document).ready(function () {
    var checkAdminLogin = sessionStorage.getItem('admin');
    if (!checkAdminLogin) {
        window.location.href = "./../../../index.html";
    }
    $.ajax({
        url: 'http://localhost/school/BackEnd/appointmentData',
        type: 'GET',
        dataType: 'json',
        success: function (response) {
            for (var i = 0; i < response.length; i++) {
                var element = response[i];
                $('#dataInTable').append(`
                    <tr>
                        <td><span class="bg-td">${element.email}</span></td>
                        <td><span class="bg-td">${element.room_number}</span></td>
                        <td><span class="bg-td">${element.date}</span></td>
                        <td><span class="bg-td">${element.startTime} to ${element.endTime}</span></td>
                        <td>
                            <img src="./../../../assets/images/icon/check.svg" alt=""
                                class="img img-fluid admin-img-set" id="accept"
                                data-roomnumber="${element.room_number}" data-userId="${element.userId}" data-Id="${element.id}">
                            <img src="./../../../assets/images/icon/cross.svg" alt=""
                                class="img img-fluid admin-img-set" id="deny"
                                data-roomnumber="${element.room_number}" data-userId="${element.userId}" data-Id="${element.id}">
                        </td>
                    </tr>
                `);
            }
        },
        error: function () {
            console.log('An error occurred during Ajax request.');
        }
    });

    $(document).on('click', '#accept', function () {
        var userId = $(this).data('userid');
        var roomNumber = $(this).data('roomnumber');
        var postId = $(this).data('id');
        Swal.fire({
            icon: 'question',
            title: 'Are you sure?',
            text: `Do you want to accept the reservation for room ${roomNumber}?`,
            showCancelButton: true,
            confirmButtonText: 'Yes',
            cancelButtonText: 'No'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    method: "POST",
                    url: "http://localhost/school/BackEnd/reservation",
                    data: {
                        userId: userId,
                        roomNumber: roomNumber,
                        postId: postId
                    },
                    success: function (data) {
                        if (data.status === 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Reservation Accepted!',
                                text: data.message,
                                timer: 3000,
                                showConfirmButton: false
                            }).then(() => {
                                window.location.reload();
                            })
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: data.message,
                            });
                        }
                    },
                    error: function () {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'An error occurred during the AJAX request.',
                        });
                    }
                });
            } else {
                return;
            }
        });
    });
    $(document).on('click', '#deny', function () {
        var userId = $(this).data('userid');
        var roomNumber = $(this).data('roomnumber');
        var postId = $(this).data('id');
        $('#denyModal').modal('show');
        $('#sendCommentBtn').on('click', function () {
            var comment = $('#commentInput').val();

            if (comment.trim() !== '') {
                $.ajax({
                    method: "POST",
                    url: "http://localhost/school/BackEnd/denyReservation",
                    data: {
                        userId: userId,
                        roomNumber: roomNumber,
                        comment: comment,
                        postId: postId
                    },
                    success: function (data) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Reservation Denied!',
                            text: 'The request for room ' + roomNumber + ' reservation has been denied.',
                            timer: 3000,
                            showConfirmButton: false
                        }).then(() => {
                            window.location.reload();
                        });
                    },
                    error: function () {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'An error occurred during the request.',
                            timer: 3000,
                            showConfirmButton: false
                        });
                    }
                });
            } else {
                // The comment is empty, show an error message
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Please enter a comment before sending.',
                    timer: 3000,
                    showConfirmButton: false
                });
            }
            $('#denyModal').modal('hide');
        });
    });
});

function LogOUT() {
    sessionStorage.removeItem('userId');
    window.location.href = "./../../../index.html";
}