
sass --watch public/scss/style.scss:public/css/style.css --style compressed



SELECT patientPrenom, patientNom, start, description, dureeConsultation, couleur
FROM patient 
INNER JOIN events ON patient.id_patient = events.id_patient
INNER JOIN typeActe ON events.id_type = typeActe.id_type
WHERE id_praticien = 2 AND DATEDIFF (NOW(), start) 
BETWEEN -30 AND 30
ORDER BY start


SELECT praticienNom, praticienPrenom, praticienEmail, id_spe FROM praticien 
INNER JOIN specialite ON specialite.id_spe = praticien.id_spe
WHERE praticienEmail = "nicolas@hubert.com"

INSERT INTO events (id_event, start, id_type, id_patient) 
INNER JOIN (:id_event, :start, :id_type, :id_patient)

INSERT INTO events (title, start, end) VALUES (:title, :start, :end )

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
        eventLimit: true, 
        selectable: true,
        selectHelper: true,
        header: {
            left: 'prev,next, today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay'
        },
        select: function(start, end) {
				
            $('#ModalAdd #start').val(moment(start).format('YYYY-MM-DD HH:mm:ss'));
            $('#ModalAdd #end').val(moment(end).format('YYYY-MM-DD HH:mm:ss'));
            $('#ModalAdd').modal('show');
        },
        eventRender: function(event, element) {
            element.bind('dblclick', function() {
                $('#ModalEdit #id').val(event.id);
                $('#ModalEdit #title').val(event.title);
                $('#ModalEdit #color').val(event.color);
                $('#ModalEdit').modal('show');
            });
        },
        eventDrop: function(event, delta, revertFunc) { // si changement de position

            edit(event);

        },
        eventResize: function(event,dayDelta,minuteDelta,revertFunc) { // si changement de longueur

            edit(event);

        },
        events: [
			<?php foreach($events as $event): 
			
				$start = explode(" ", $event['start']);
				$end = explode(" ", $event['end']);
				if($start[1] == '00:00:00'){
					$start = $start[0];
				}else{
					$start = $event['start'];
				}
				if($end[1] == '00:00:00'){
					$end = $end[0];
				}else{
					$end = $event['end'];
				}
			?>
				{
					id: '<?php echo $event['id']; ?>',
					title: '<?php echo $event['title']; ?>',
					start: '<?php echo $start; ?>',
					end: '<?php echo $end; ?>',
					color: '<?php echo $event['color']; ?>',
				},
			<?php endforeach; ?>
			]
        });
        function edit(event){
			start = event.start.format('YYYY-MM-DD HH:mm:ss');
			if(event.end){
				end = event.end.format('YYYY-MM-DD HH:mm:ss');
			}else{
				end = start;
			}
			
			id =  event.id;
			
			Event = [];
			Event[0] = id;
			Event[1] = start;
			Event[2] = end;
			
			$.ajax({
			 url: 'editEventDate.php',
			 type: "POST",
			 data: {Event:Event},
			 success: function(rep) {
					if(rep == 'OK'){
						alert('Saved');
					}else{
						alert('Could not be saved. try again.'); 
					}
				}
			});
		}
        
    });
});

<!-- 
[{"description":"visite \u00e0 domicile","dureeConsultation":"00:30:00","couleur":"#85ff59","patientNom":"jack","patientPrenom":"jack","start":"0000-00-00"},{"description":"visite \u00e0 domicile","dureeConsultation":"00:30:00","couleur":"#85ff59","patientNom":"jack","patientPrenom":"jack","start":"0000-00-00"},{"description":"visite \u00e0 domicile","dureeConsultation":"00:30:00","couleur":"#85ff59","patientNom":"jack","patientPrenom":"jack","start":"0000-00-00"},{"description":"visite \u00e0 domicile","dureeConsultation":"00:30:00","couleur":"#85ff59","patientNom":"test","patientPrenom":"paul","start":"0000-00-00"},{"description":"visite \u00e0 domicile","dureeConsultation":"00:30:00","couleur":"#85ff59","patientNom":"test","patientPrenom":"paul","start":"0000-00-00"},{"description":"visite \u00e0 domicile","dureeConsultation":"00:30:00","couleur":"#85ff59","patientNom":"test","patientPrenom":"paul","start":"0000-00-00"},{"description":"visite \u00e0 domicile","dureeConsultation":"00:30:00","couleur":"#85ff59","patientNom":"test","patientPrenom":"paul","start":"0000-00-00"},{"description":"visite \u00e0 domicile","dureeConsultation":"00:30:00","couleur":"#85ff59","patientNom":"test","patientPrenom":"paul","start":"0000-00-00"}] -->