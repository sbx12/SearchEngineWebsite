var displayText = document.getElementById("INFOX");
var browser = document.getElementById("BrowserX");
var screeen = document.getElementById("ScreenX");
var locatioon = document.getElementById("LocationX");

function showBrowser(event){
  displayText.innerHTML = "Your Browser Information <br>" + navigator.userAgent;
}

function getLocation() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showLocation);
  } else {
    displayText.innerHTML = "Geolocation is not supported by this browser.";
  }
}

function showLocation(position){
  displayText.innerHTML = "Your Location Information <br>Latitude: " + position.coords.latitude +
  "<br>Longitude: " + position.coords.longitude;
}

function showScreen(event){
  displayText.innerHTML = "Your Screen Information <br>Inner Height: " +  window.innerHeight + "<br>Inner Width: " + window.innerWidth;
}

browser.addEventListener("click", showBrowser);
screeen.addEventListener("click", showScreen);
locatioon.addEventListener("click", getLocation);
