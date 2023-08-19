var userId = sessionStorage.getItem("userId");
if(!userId){
    window.location.href="./../index.html";
}
$(document).ready(function () {
    $('.classroom-number').click(function () {
        const classroomNumber = $(this).text();
        window.location.href = './particular_room/particularRoom.html?classRoom=' + classroomNumber;
    });
});
