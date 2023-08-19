var userId = sessionStorage.getItem("userId");
if(userId) {
  window.location.href="./components/index.html";
}
$(document).ready(function() {
  $('#signup').submit(function(event) {
    event.preventDefault();
    const formData = $(this).serialize();
    $.ajax({
      url: 'http://localhost/school/BackEnd/signin',
      type: 'POST',
      data: formData,
      dataType: 'json',
      success: function(response) {
        if (response.status === 'success') {
          Swal.fire({
            icon: 'success',
            title: 'Success',
            text: response.message,
            showConfirmButton: false,
            timer:3000
          }).then(()=>{
            if(response.role==="student"){
              sessionStorage.setItem('userId',response.user_id);
              window.location.href="./components/index.html";
            }else{
              sessionStorage.setItem('admin',response.role);
              window.location.href="./components/admin/adminDashboard/index.html";
            }
          })
        } else {
          Swal.fire({
            icon: 'error',
            title: 'Error',
            text: response.message,
            showConfirmButton: false,
            timer:3000
          });
        }
      },
      error: function() {
        Swal.fire({
          icon: 'error',
          title: 'Error',
          text: 'An error occurred during form submission. Please try again later.',
          showConfirmButton: false,
          timer:3000
        });
      }
    });
  });
});