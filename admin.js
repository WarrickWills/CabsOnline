// file admin.js
// using POST method
var xhr = createRequest();
function assigning(dataSource, divID, bookingNumber) {
	if(xhr) {
		var obj = document.getElementById(divID);
		var requestbody ="bookingNum="+encodeURIComponent(bookingNumber);
 		xhr.open("POST", dataSource, true);
		xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		// Response on ready state
		xhr.onreadystatechange = function() {
			if (xhr.readyState == 4 && xhr.status == 200) { 
				obj.innerHTML = "<span style='color:black'>" + xhr.responseText + "</span>";
			} // end if
		} // end anonymous call-back function
 		xhr.send(requestbody);
	} // end if
} // end function

function requesting(dataSource, divID, date) {
	if(xhr) {
		var obj = document.getElementById(divID);
		var requestbody ="date="+encodeURIComponent(date);
 		xhr.open("POST", dataSource, true);
		xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		// Response on ready state
		xhr.onreadystatechange = function() {
			if (xhr.readyState == 4 && xhr.status == 200) { 
				obj.innerHTML = "<span style='color:black'>" + xhr.responseText + "</span>";
			} // end if
		} // end anonymous call-back function
 		xhr.send(requestbody);
	} // end if
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