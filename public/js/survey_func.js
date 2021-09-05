/*  Wizard */
jQuery(function ($) {
	"use strict";
	$("#wizard_container").wizard({
		stepsWrapper: "#wrapped",
		submit: ".submit",
        transitions: {
            divisi: function( $step, action ) {
				var divisi = $step.find("[name=divisi]:checked").val();

				if (!divisi) {
					$(".error").css('display', 'block');
				}

				return divisi;
			}
        },
		beforeSelect: function (event, state) {
			validateForm();
			if ($('input#website').val().length != 0) {
				return false;
			}
			if (!state.isMovingForward)
				return true;
			var inputs = $(this).wizard('state').step.find(':input');
			return !inputs.length || !!inputs.valid();
		}
	}).validate({
		errorPlacement: function (error, element) {
			if (element.is(':radio') || element.is(':checkbox')) {
				error.insertBefore(element.next());
			} else {
				error.insertAfter(element);
			}

			if(!$('input[name=spesialisasi_divisi]:checked').val())  {
				
			} 
		}
	});
	//  progress bar
	$("#progressbar").progressbar();
	$("#wizard_container").wizard({
		afterSelect: function (event, state) {
			$("#progressbar").progressbar("value", state.percentComplete);
			$("#location").text("(" + state.stepsComplete + "/" + state.stepsPossible + ")");
		}
	});
	// Validate select
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});

	
});

// Summary 
function getVals(formControl, controlType) {
	switch (controlType) {

		case 'question_1':
			// Get the value for a radio
			var value = $(formControl).val();
			$("#question_1").text(value);
			break;

		case 'question_2':
			// Get name for set of checkboxes
			var checkboxName = $(formControl).attr('name');

			// Get all checked checkboxes
			var value = [];
			$("input[name*='" + checkboxName + "']").each(function () {
				// Get all checked checboxes in an array
				if (jQuery(this).is(":checked")) {
					value.push($(this).val());
				}
			});
			$("#question_2").text(value.join(", "));
			break;

		case 'question_3':
			// Get the value for a radio
			var value = $(formControl).val();
			$("#question_3").text(value);
			break;

		case 'additional_message':
			// Get the value for a textarea
			var value = $(formControl).val();
			$("#additional_message").text(value);
			break;
	}
}
	function validateForm() {
		$('#wrapped').validate({
			ignore: [],
			rules: {
				email:{
					remote: {
						param: {
							url: "/check-email",
							type: "post",
						},
						depends: function(element) {
							// compare name in form to hidden field
							return ($(element).val() !== $('#checkEmail').val());
						},
					
					}
				}
			},
			messages: {
				email: {
					remote: "Email sudah terdaftar"
				},
			},
			errorPlacement: function (error, element) {
				if (element.is('select:hidden')) {
					error.insertAfter(element.next('.nice-select'));
				} else {
					error.insertAfter(element);
				}
			}
		});				
	}
