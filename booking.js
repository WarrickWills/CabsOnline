// file booking.js
// using POST method
var xhr = createRequest();
function booking(dataSource, divID, firstName, lastName, mobileNumber, pickupDate, pickupTime, unitNum, streetNum, streetAdd, suburb, destinationSuburb) {
	if(xhr) {
		var obj = document.getElementById(divID);
		var requestbody ="&firstName="+encodeURIComponent(firstName)
		+"&lastName="+encodeURIComponent(lastName)
		+"&mobileNumber="+encodeURIComponent(mobileNumber)
		+"&pickupDate="+encodeURIComponent(pickupDate)
		+"&pickupTime="+encodeURIComponent(pickupTime)
		+"&unitNum="+encodeURIComponent(unitNum)
		+"&streetNum="+encodeURIComponent(streetNum)
		+"&streetAdd="+encodeURIComponent(streetAdd)
		+"&suburb="+encodeURIComponent(suburb)
		+"&destinationSuburb="+encodeURIComponent(destinationSuburb);
 		xhr.open("POST", dataSource, true);
		xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		// Response on ready state
		xhr.onreadystatechange = function() {
			if (xhr.readyState == 4 && xhr.status == 200) { 
				obj.innerHTML = "<span style='color:black'>" + xhr.responseText + "</span>";
			} 
		} 
 		xhr.send(requestbody);
	} 
} 

 function createRequest() {
    var xhr = false;  
    if (window.XMLHttpRequest) {
        xhr = new XMLHttpRequest();
    }
    else if (window.ActiveXObject) {
        xhr = new ActiveXObject("Microsoft.XMLHTTP");
    }
    return xhr;
} // end function createRequest()