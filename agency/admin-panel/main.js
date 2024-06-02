function displayDate() {
  var today = new Date();
  var date =
    today.getFullYear() + "-" + (today.getMonth() + 1) + "-" + today.getDate();
  var day = today.toLocaleDateString("en-US", { weekday: "short" });
  document.getElementById("date").innerText = date + " " + day;
}

function displayTime() {
  var today = new Date();
  var time =
    today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
  document.getElementById("time").innerText = time;
}

displayDate();
displayTime();

setInterval(displayTime, 1000);
