
$(document).ready(() => {
    var userId = sessionStorage.getItem('userId');
    $.ajax({
        url: 'http://localhost/school/BackEnd/getnotidetails',
        method: 'POST',
        data: { userId: userId },
        success: function (response) {
            if (response.status === "success") {
                for (var i = 0; i < response.data.length; i++) {
                    data = response.data[i];
                    $("#textDown").append(`<p>${data.message}</p>`);
                }
            } else {
                $("#textDown").append(`<p>${response.message}</p>`);
            }
        }
    })
})

function logOut(){
    sessionStorage.removeItem("userId");
    window.location.href="./../../index.html";
}
function LogOUT(){
    sessionStorage.removeItem("userId");
    window.location.href="./../index.html";
}