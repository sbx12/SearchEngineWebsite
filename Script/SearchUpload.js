const inputElement = document.getElementById("Filex");
var reader;
inputElement.addEventListener("change", handleFiles, false);
var checkcsv = /.+(\.csv)$/;
var checkJSON = /.+(\.json)$/;
var checkXML = /.+(\.xml)$/;

function handleFiles() {
  const fileList = this.files;
  reader = new FileReader();

//Detect what type of file it is
  if((fileList[0].name).match(checkcsv)){
    getCSV(fileList[0]);
  }

  else if ((fileList[0].name).match(checkJSON)) {
    getJSON(fileList[0]);
  }

  else if ((fileList[0].name).match(checkXML)) {
    getXML(fileList[0]);
  }

  else {
      document.getElementById("llama").innerHTML = "Sorry not valid file: " + fileList[0].name;
  }
}

//GET CSV File and parse the data onto web
function getCSV(file){
  reader.onload = function (file) {
      var allTextLines = file.target.result.split(/\r\n|\n/);
      for (var i = 0; i < allTextLines.length - 1; i++) {
          var data = allTextLines[i].split(',');
          appendToScreen(data[0], data[1], data[2]);
      }
  };
  reader.readAsText(file);
}

//Get Json File and parse the data onto web
function getJSON(file){
  reader.onload = function (file) {
      var obj = JSON.parse(file.target.result);
      for(var i = 0; i < obj.Result.length; i++)
        appendToScreen(obj.Result[i].title, obj.Result[i].url, obj.Result[i].description);
  };
  reader.readAsText(file);
}

//Get XML FIle and parse the data onto web
function getXML(file){
  reader.onload = function (file) {
    var xmlDoc = $.parseXML( file.target.result),
    $xml = $( xmlDoc );
    $xml.find( "result" ).each(function () {
      $title = $(this).find( "title" ).text();
      $url = $(this).find( "url" ).text();
      $description = $(this).find( "description" ).text();
      appendToScreen($title, $url, $description);
    });
  };
  reader.readAsText(file);
}

//Used to output the data from the file
function appendToScreen(titlex, urlx, descriptionx){
  var node = document.createElement('div');
  node.setAttribute("class", "SearchResults");
  var chckBX = document.createElement('input');
  chckBX.setAttribute("type", "checkbox");
  chckBX.setAttribute("id", "checkbx");
  var title = document.createElement('p');
  var a = document.createElement('a');
  a.setAttribute("href", urlx);
  a.innerHTML = titlex;
  title.appendChild(a);
  title.setAttribute("id", "SearchTitle");

  var url = document.createElement('p');
  url.innerHTML = urlx;
  url.setAttribute("id", "SearchLink");

  var description = document.createElement('p');
  description.innerHTML = descriptionx;
  description.setAttribute("id", "SearchDescription");
  node.appendChild(chckBX);
  node.appendChild(title);
  node.appendChild(url);
  node.appendChild(description);

  document.body.appendChild(node);
}
