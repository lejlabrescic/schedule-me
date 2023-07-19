$(document).ready(function () {
    function generateCalendar(currentYear, currentMonth) {
        var firstDay = new Date(currentYear, currentMonth, 1);
        var lastDay = new Date(currentYear, currentMonth + 1, 0);
        var startDate = new Date(firstDay);
        startDate.setDate(firstDay.getDate() - firstDay.getDay()); 
        var endDate = new Date(lastDay);
        endDate.setDate(lastDay.getDate() + (6 - lastDay.getDay()));

        var $calendarDates = $('#calendarDates');
        $calendarDates.empty();

        var currentDate = new Date();
        while (startDate <= endDate) {
            var $dateContainer = $('<div class="date-container"></div>');
            var $date = $('<button><time>' + startDate.getDate() + '</time></button>');

            if (startDate.getFullYear() === currentDate.getFullYear() &&
                startDate.getMonth() === currentDate.getMonth() &&
                startDate.getDate() === currentDate.getDate()) {
                $date.addClass('today');
            }

            $dateContainer.append($date);
            $calendarDates.append($dateContainer);
            startDate.setDate(startDate.getDate() + 1);
        }

        $('#currentMonthYear').text(firstDay.toLocaleString('default', { month: 'long' }) + ' ' + currentYear);
    }
    function getCurrentDayOfWeek() {
        var daysOfWeek = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
        var currentDate = new Date();
        var dayOfWeek = currentDate.getDay();
        return daysOfWeek[dayOfWeek];
    }
    $('.month .fa-angle-left').on('click', function () {
        var currentMonth = currentDate.getMonth() - 1;
        var currentYear = currentDate.getFullYear();
        if (currentMonth < 0) {
            currentYear -= 1;
            currentMonth = 11; // December
        }
        generateCalendar(currentYear, currentMonth);
    });
    $('.month .fa-angle-right').on('click', function () {
        var currentMonth = currentDate.getMonth() + 1;
        var currentYear = currentDate.getFullYear();
        if (currentMonth > 11) {
            currentYear += 1;
            currentMonth = 0; // January
        }
        generateCalendar(currentYear, currentMonth);
    });
    $(document).on('click', '.date-container button', function() {
        var selectedDate = parseInt($(this).find('time').text(), 10);
        var selectedMonth = currentDate.getMonth() + 1; 
        var selectedYear = currentDate.getFullYear();

        console.log('Selected Date: ' + selectedDate);
        console.log('Selected Month: ' + selectedMonth);
        console.log('Selected Year: ' + selectedYear);
    });
    var currentDate = new Date();
    generateCalendar(currentDate.getFullYear(), currentDate.getMonth());
});