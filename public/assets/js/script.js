$(document).ready(function() {
	$('[data-toggle="tooltip"]').tooltip();
});
/*
// noUiSlider
var keypressSlider = document.getElementById('keypress'),
	input = document.getElementById('input-with-keypress');

noUiSlider.create(keypressSlider, {
	start: 40,
	step: 10,
	range: {
		'min': 0,
		'20%': [ 300, 100 ],
		'50%': [ 800, 50 ],
		'max': 1000
	}
});

keypressSlider.noUiSlider.on('update', function( values, handle ) {
	input.value = values[handle];
});

input.addEventListener('change', function(){
	keypressSlider.noUiSlider.set([null, this.value]);
});
input.addEventListener('keydown', function( e ) {

	// Convert the string to a number.
	var value = Number( keypressSlider.noUiSlider.get() ),
		sliderStep = keypressSlider.noUiSlider.steps()

	// Select the stepping for the first handle.
	sliderStep = sliderStep[0];

	// 13 is enter,
	// 38 is key up,
	// 40 is key down.
	switch ( e.which ) {
		case 13:
			keypressSlider.noUiSlider.set(this.value);
			break;
		case 38:
			keypressSlider.noUiSlider.set( value + sliderStep[1] );
			break;
		case 40:
			keypressSlider.noUiSlider.set( value - sliderStep[0] );
			break;
	}
});

// noUiSlider
var keypressSlider = document.getElementById('keypress2'),
	input = document.getElementById('input-with-keypress2');

noUiSlider.create(keypressSlider, {
	start: 40,
	step: 10,
	range: {
		'min': 0,
		'20%': [ 300, 100 ],
		'50%': [ 800, 50 ],
		'max': 1000
	}
});

keypressSlider.noUiSlider.on('update', function( values, handle ) {
	input.value = values[handle];
});

input.addEventListener('change', function(){
	keypressSlider.noUiSlider.set([null, this.value]);
});
input.addEventListener('keydown', function( e ) {

	// Convert the string to a number.
	var value = Number( keypressSlider.noUiSlider.get() ),
		sliderStep = keypressSlider.noUiSlider.steps()

	// Select the stepping for the first handle.
	sliderStep = sliderStep[0];

	// 13 is enter,
	// 38 is key up,
	// 40 is key down.
	switch ( e.which ) {
		case 13:
			keypressSlider.noUiSlider.set(this.value);
			break;
		case 38:
			keypressSlider.noUiSlider.set( value + sliderStep[1] );
			break;
		case 40:
			keypressSlider.noUiSlider.set( value - sliderStep[0] );
			break;
	}
});

// noUiSlider
var keypressSlider = document.getElementById('keypress3'),
	input = document.getElementById('input-with-keypress3');

noUiSlider.create(keypressSlider, {
	start: 40,
	step: 10,
	range: {
		'min': 0,
		'20%': [ 300, 100 ],
		'50%': [ 800, 50 ],
		'max': 1000
	}
});

keypressSlider.noUiSlider.on('update', function( values, handle ) {
	input.value = values[handle];
});

input.addEventListener('change', function(){
	keypressSlider.noUiSlider.set([null, this.value]);
});
input.addEventListener('keydown', function( e ) {

	// Convert the string to a number.
	var value = Number( keypressSlider.noUiSlider.get() ),
		sliderStep = keypressSlider.noUiSlider.steps()

	// Select the stepping for the first handle.
	sliderStep = sliderStep[0];

	// 13 is enter,
	// 38 is key up,
	// 40 is key down.
	switch ( e.which ) {
		case 13:
			keypressSlider.noUiSlider.set(this.value);
			break;
		case 38:
			keypressSlider.noUiSlider.set( value + sliderStep[1] );
			break;
		case 40:
			keypressSlider.noUiSlider.set( value - sliderStep[0] );
			break;
	}
});

*/