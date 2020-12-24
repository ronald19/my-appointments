let $doctor, $date, $specialty, $hours;
let iRadio;

const noHoursAlert =
	`<div class="alert alert-danger" role="alert">
    	<strong>No existen registros con los valores seleccionados</strong>
	</div>`;

$(function(){
  $specialty = $('#specialty');

  $doctor = $('#doctor');
  let htmlOptions = '';
  htmlOptions += `<option value="">--</option>`
  $doctor.html(htmlOptions);

  $date = $('#date');
  $hours = $('#hours');

  $specialty.change(() => {
    const specialtyId = $specialty.val();
    //para apostrofes alt+96
    const url = `/specialties/${specialtyId}/doctors`;
    $.getJSON(url, onDoctorLoaded );
  });

  $doctor.change(loadHours);

  $date.change(loadHours);

});

function onDoctorLoaded(doctors){
  let htmlOptions = '';
  htmlOptions += `<option value="">--</option>`
  doctors.forEach(doctor => {
    htmlOptions += `<option value="${doctor.id}">${doctor.name}</option>`;
  });
  $doctor.html(htmlOptions);
};

function loadHours(){
	const selectedDate =$date.val();
	const doctorId =$doctor.val();
	const url = `/schedule/hours?date=${selectedDate}&doctor_id=${doctorId}`;
    $.getJSON(url, displayHours );
}

function displayHours(data){
	if(!data.morning && !data.afternoon){
		$hours.html(noHoursAlert);
		return;
	}

	let htmlHours = '';
	iRadio = 0;

	if(data.morning){
		const morning_intervals = data.morning;
		morning_intervals.forEach(interval => {
			htmlHours += getRadioIntervalHtml(interval);
		});
	}

	if(data.afternoon){
		const afternoon_intervals = data.afternoon;
		afternoon_intervals.forEach(interval => {
			htmlHours += getRadioIntervalHtml(interval);
		});
	}

	$hours.html(htmlHours);

}

function getRadioIntervalHtml(interval){
	const text = `${interval.start} - ${interval.end}`;
	return `<div class="custom-control custom-radio custom-control-inline">
  		<input type="radio" id="interval${iRadio}" name="interval" class="custom-control-input" value="${text}" required>
  		<label class="custom-control-label" for="interval${iRadio++}">${text}</label>
	</div>`
}