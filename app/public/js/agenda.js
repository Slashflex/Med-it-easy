$(function () {
    let date = new Date();
    let d = date.getDate();
    let m = date.getMonth();
    let y = date.getFullYear();
    let calendar = $('#calendar').fullCalendar({
        locale: 'fr',
        slotLabelFormat: ['H:mm'],
        minTime: "08:00:00",
    maxTime: "20:00:00",
        defaultView: "agendaWeek",
        editable: true,
        header: {
            left: 'prev,next',
            center: 'title',
            right: 'month,agendaWeek,agendaDay'
        },
        events: "app/model/EventManager.php",
        eventRender: function (event, element, view) {
            if (event.allDay === 'true') {
                event.allDay = true;
            } else {
                event.allDay = false;
            }
        },
        selectable: true,
        selectHelper: true,
        select: function (start, end, allDay) {
            let title = prompt('Event Title:');
            if (title) {
                let start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
                let end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");
                $.ajax({
                    url: 'app/model/EventManager.php',
                    data: 'title=' + title + '&start=' + start + '&end=' + end,
                    type: "POST",
                    success: function (json) {
                        alert('Added Successfully');
                    }
                });
                calendar.fullCalendar('renderEvent', {
                        title: title,
                        start: start,
                        end: end,
                        allDay: allDay
                    },
                    true
                );
            }
            calendar.fullCalendar('unselect');
        },
        editable: true,
        eventDrop: function (event, delta) {
            let start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
            let end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
            $.ajax({
                url: 'app/model/EventManager.php',
                data: 'title=' + event.title + '&start=' + start + '&end=' + end + '&id=' + event.id,
                type: "POST",
                success: function (json) {
                    alert("Updated Successfully");
                }
            });
        },
        eventClick: function (event) {
            let decision = confirm("Do you really want to do that?");
            if (decision) {
                $.ajax({
                    type: "POST",
                    url: "app/model/EventManager.php",
                    data: "&id=" + event.id,
                    success: function (json) {
                        $('#calendar').fullCalendar('removeEvents', event.id);
                        alert("Updated Successfully");
                    }
                });
            }
        },
        eventResize: function (event) {
            let start = $.fullCalendar.formatDate(event.start, "yyyy-MM-dd HH:mm:ss");
            let end = $.fullCalendar.formatDate(event.end, "yyyy-MM-dd HH:mm:ss");
            $.ajax({
                url: 'app/model/EventManager.php',
                data: 'title=' + event.title + '&start=' + start + '&end=' + end + '&id=' + event.id,
                type: "POST",
                success: function (json) {
                    alert("Updated Successfully");
                }
            });
        }
    });
});