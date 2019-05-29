$(document).ready(function(){
	var $SR = $('.SearchResults');

	$('#checkbXALL').click(function(event) {
    if(this.checked) {
        // Iterate each checkbox
        $(':checkbox').each(function() {
            this.checked = true;
        });
    } else {
        $(':checkbox').each(function() {
            this.checked = false;
        });
    }
	});

  $("#DownloadType").click(function(){
		$SR = $('.SearchResults');
		switch($("input[name='fileDownloadSelect']:checked").val()) {
		  case "JSON":
		    downloadJSON();
		    break;
		  case "XML":
		    downloadXML();
		    break;
			case "CSV":
				downloadCSV();
				break;
		  default:
		    alert("No file type selected!");
		}
});


	//DOWNLOAD file in JSON format
  function downloadJSON(){
    var obj = {"Result": []  };
    for(var i = 0; i < $SR.length; i++)
      if(checkBox(i)){
        obj.Result.push({title: $SR.eq(i).find("#SearchTitle").text(),
           url: $SR.eq(i).find("#SearchLink").text(),
           description: $SR.eq(i).find("#SearchDescription").text()}
         );
     }
		 MakeFile(obj, ".json")
  }

	//DOWNLOAD file in XML format
	function downloadXML(){
		var obj = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n<results>\n";
		for(var i = 0; i < $SR.length; i++)
			if(checkBox(i)){
				obj += "	<result>\n";
				obj += "		<title>" + $SR.eq(i).find("#SearchTitle").text()+ "</title>\n";
				obj += "		<url>" + $SR.eq(i).find("#SearchLink").text() + "</url>\n";
				obj += "		<description>" + $SR.eq(i).find("#SearchDescription").text() + "</description>\n";
				obj += "	</result>\n";
		 }
		obj += "</results>";
		MakeFile(obj, ".xml");
	}

	//DOWNLOAD file in CSV format
	function downloadCSV(){
		var obj = "";
		for(var i = 0; i < $SR.length; i++)
			if(checkBox(i)){
				obj += $SR.eq(i).find("#SearchTitle").text() + ",";
				obj += $SR.eq(i).find("#SearchLink").text() + ",";
				obj += $SR.eq(i).find("#SearchDescription").text() + ",\n";
		 }
		MakeFile(obj, ".csv");
	}

	//Creates the FILE type and lets user download
	function MakeFile(obj, type){
		if(type == ".json")
			var dataStr = "data:text/json;charset=utf-8," + encodeURIComponent(JSON.stringify(obj, null, "\t"));
		else if(type == ".xml")
			var dataStr = "data:text/xml;charset=utf-8," + encodeURIComponent(obj);
		else if(type == ".csv")
			var dataStr = "data:text/csv;charset=utf-8," + encodeURIComponent(obj);
		var downloadAnchorNode = document.createElement('a');
		downloadAnchorNode.setAttribute("href",     dataStr);
		downloadAnchorNode.setAttribute("download", "exportName" + type);
		document.body.appendChild(downloadAnchorNode);
		downloadAnchorNode.click();
		downloadAnchorNode.remove();
	}

	//Checks for boxes that have been checked
  function checkBox(pos){
    return $SR.eq(pos).find("#checkbX").is(':checked');
  }

	//Select/Deselect All
	function toggle(source) {
	  checkboxes = document.getElementsByName('checkbX');
	  for(var i=0, n=checkboxes.length;i<n;i++) {
	    checkboxes[i].checked = source.checked;
	  }
	}


});
