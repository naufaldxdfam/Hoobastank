$(document).ready(function() {
	var date = new Date();
  var year = date.getFullYear();
  var month = date.getMonth() + 1;
  var day = date.getDate() - 1;
  
  $('.datepicker').pickadate({
	  	
	  	selectYears: true,
  		selectMonths: true,

  		disable:  [
  					{ from: [0,0,0], to: [year,month,day]  } 
  				   ]
	});
});