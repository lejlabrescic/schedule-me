var userId = sessionStorage.getItem("userId");
if(!userId){
    window.location.href="./../index.html";
}
$(document).ready(function () {
    function getUrlParameter(name) {
        name = name.replace(/[[]/, '\\[').replace(/[\]]/, '\\]');
        var regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
        var results = regex.exec(location.search);
        return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
    }

    const classRoomNumber = getUrlParameter('classRoom');

    $.ajax({
        url: 'http://localhost/school/BackEnd/classRoom',
        type: 'POST',
        data: { classroomNumber: classRoomNumber },
        dataType: 'json',
        success: function (response) {
            if (response.status === 'success' && response.data && response.data.length > 0) {
                const classroom = response.data[0];
                const feature = JSON.parse(classroom.feature_room);
                $("#classRoomDetails").html(`
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <p class="particularHeading">Room ${classroom.room_number}</p>
                                <p>Feature & Amenities</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-8 col-md-8 col-sm-12">
                                <div class="d-flex">
                                    <div class="form-check">
                                        <input id="A/C" class="form-check-input" type="checkbox" name="A/C" value="true" ${feature['A/C'] === '1' ? 'checked' : ''} disabled>
                                        <label for="A/C" class="form-check-label">
                                            <span>A/C</span>
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input id="projector" class="form-check-input" type="checkbox" name="projector" value="true" ${feature['projector'] === '1' ? 'checked' : ''} disabled>
                                        <label for="projector" class="form-check-label">
                                            <span>Projector</span>
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input id="wifi" class="form-check-input" type="checkbox" name="wifi" value="true" ${feature['wifi'] === '1' ? 'checked' : ''} disabled>
                                        <label for="wifi" class="form-check-label">
                                            <span>Free Wi-Fi</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <p class="descrption-text">Description</p>
                            </div>
                            <div class="col-lg-10 col-md-12 col-sm-12">
                                <p class="para">${classroom.description}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 text-center">
                        <img src="./../../assets/images/${classroom.image}" alt="side image" class="img img-fluid">
                        <div class="form-check">
                            <input id="require" class="form-check-input new-input" type="checkbox" name="require" value="true" ${classroom['adminApproval'] === '1' ? 'checked' : ''} disabled>
                            <label for="require" class="form-check-label">Requires Admin Approval</label>
                        </div>
                    </div>
                `);
            } else {
                console.log('Invalid or empty response data.');
            }
        },
        error: function () {
            console.log('An error occurred during Ajax request.');
        },
    });
});
