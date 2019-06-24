/*
	скрипты
*/

$(function(){
$(window).load(function(){
	//вешает обработчик событий на документ
	document.addEventListener('click', EvtListener);
});
});

//обработчик событий на документе
function EvtListener(e){
	let $item = $(e.target);

	if ( $item.hasClass('form__button') ){
		formSubmit($item);
	}
}

//обработчик формы
function formSubmit(item){
	if ( document.location.pathname.indexOf("addcountry") === 1 ){
		const CountryValid = document.getElementById('coutry');
		const NumberOfPeopleValid = document.getElementById('numberOfPeople');
		const Country = item.siblings('#coutry').val();
		const NumberOfPeople = item.siblings('#numberOfPeople').val();
		const $form__wrap = $('.form__wrap');
		const $ajax = $('.ajax');

		if ( 
			CountryValid.validity.valid 
			&& NumberOfPeopleValid.validity.valid 
		){
		} else {
			alert('form not valid');
			return;
		}

		$.ajax({
			type: "POST",
			url: '/api',
			data: 'coutry=' + Country + '&numberOfPeople=' + NumberOfPeople,
			success: function(data){
				console.log(data);
				console.log(data.responseJSON);
				if ( data.code === 201 ){
					$form__wrap.addClass('hidden');
					$ajax.append('add country successful');
				} else {
					alert('server error: ' + data.message);
				}
			},
			error: function (data){
				console.log(data);
				console.log(data.responseJSON);
				data = data.responseJSON;
				alert('server error: ' + data.message);
			}
		});
	}
}
