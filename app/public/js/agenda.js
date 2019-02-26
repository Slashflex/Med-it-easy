/** Urgence : #ff0000 => red
	Consultation: #7c7c7c => gray
	Gynécologie: #ff72db => pink
	Pediatrie: #6280ef => blue
	Certificat: #f3ff59 => yellow
	Visite à domicile: #85ff59 => green
	Suivi psychologique: #5800a0 => purple
*/

$(function() {
  let date = new Date();
  let d = date.getDate();
  let m = date.getMonth();
  let y = date.getFullYear();
  let calendar = $("#calendar").fullCalendar({
    locale: "fr",
    slotLabelFormat: ["H:mm"],
    minTime: "08:00:00",
    maxTime: "20:00:00",
    defaultView: "agendaDay",
    editable: true,
    eventLimit: true,
    selectable: true,
    selectHelper: true,
    header: {
      left: "prev,next today",
      center: "title",
      right: "month,agendaWeek,agendaDay"
    },
    eventSources: [
      {
        events: [
          {
            title: "Urgence",
            start: "2019-02-26 08:30:00",
            end: "2019-02-26 09:00:00",
            color: "#ff0000",
            textColor: "#000000"
          },
          {
            title: "Consultation",
            start: "2019-02-26 09:00:00",
            end: "2019-02-26 09:20:00",
            color: "#7c7c7c",
            textColor: "#000000"
          },
          {
            title: "Gynécologie",
            start: "2019-02-26 09:30:00",
            end: "2019-02-26 10:00:00",
            color: "#ff72db",
            textColor: "#000000"
          },
          {
            title: "Pediatrie",
            start: "2019-02-26 10:00:00",
            end: "2019-02-26 10:30:00",
            color: "#6280ef",
            textColor: "#000000"
          },
          {
            title: "Certificat",
            start: "2019-02-26 10:50:00",
            end: "2019-02-26 11:10:00",
            color: "#f3ff59",
            textColor: "#000000"
          },
          {
            title: "Visite à domicile",
            start: "2019-02-26 11:10:00",
            end: "2019-02-26 12:00:00",
            color: "#85ff59",
            textColor: "#000000"
          },
          {
            title: "Suivi psychologique",
            start: "2019-02-26 12:10:00",
            end: "2019-02-26 12:40:00",
            color: "#5800a0",
            textColor: "#000000"
		  },
		  {
            title: "Visite à domicile",
            start: "2019-02-26 13:30:00",
            end: "2019-02-26 14:10:00",
            color: "#85ff59",
            textColor: "#000000"
		  },
		  {
            title: "Pediatrie",
            start: "2019-02-26 14:20:00",
            end: "2019-02-26 14:45:00",
            color: "#6280ef",
            textColor: "#000000"
          },
        ]
      }
    ],
    //"app/model/EventManager.php",
    eventRender: function(event, element, view) {
      if (event.allDay === "true") {
        event.allDay = true;
      } else {
        event.allDay = false;
      }
    },
    selectable: true,
    selectHelper: true,
    select: function(start, end, allDay) {
      $("#ModalAdd #start").val(moment(start).format("YYYY-MM-DD HH:mm:ss"));
      $("#ModalAdd #end").val(moment(end).format("YYYY-MM-DD HH:mm:ss"));
      $("#ModalAdd").modal("show");
      if (title) {
        let start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
        let end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");
        $.ajax({
          url: "app/model/EventManager.php",
          data: "title=" + title + "&start=" + start + "&end=" + end,
          type: "POST",
          success: function(json) {
            alert("Added Successfully");
          }
        });
        calendar.fullCalendar(
          "renderEvent",
          {
            title: title,
            start: start,
            end: end,
            allDay: allDay
          },
          true
        );
      }
      calendar.fullCalendar("unselect");
    },
    editable: true,
    eventDrop: function(event, delta) {
      let start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
      let end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
      $.ajax({
        url: "app/model/EventManager.php",
        data:
          "title=" +
          event.title +
          "&start=" +
          start +
          "&end=" +
          end +
          "&id=" +
          event.id,
        type: "POST",
        success: function(json) {
          alert("Updated Successfully");
        }
      });
    },
    eventClick: function(event) {
      let decision = confirm("Do you really want to do that?");
      if (decision) {
        $.ajax({
          type: "POST",
          url: "app/model/EventManager.php",
          data: "&id=" + event.id,
          success: function(json) {
            $("#calendar").fullCalendar("removeEvents", event.id);
            alert("Updated Successfully");
          }
        });
      }
    },
    eventResize: function(event) {
      let start = $.fullCalendar.formatDate(event.start, "yyyy-MM-dd HH:mm:ss");
      let end = $.fullCalendar.formatDate(event.end, "yyyy-MM-dd HH:mm:ss");
      $.ajax({
        url: "app/model/EventManager.php",
        data:
          "title=" +
          event.title +
          "&start=" +
          start +
          "&end=" +
          end +
          "&id=" +
          event.id,
        type: "POST",
        success: function(json) {
          alert("Updated Successfully");
        }
      });
    }
  });
});
