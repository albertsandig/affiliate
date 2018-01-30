

function timer(timestamp,id) {
    var d = new Date();
    var end = new Date(timestamp);
    var time = end - d;
    if(time >=0){
		 var t = new Date(time);
		 document.getElementById(id).innerHTML =  "Time Remaining: "+t.getMinutes() + " : "+ t.getSeconds();
		 document.getElementById(id+"_button").style.display = 'none';
	 } 
}