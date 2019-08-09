$(document).ready(function(){
  $("#GoogleSearchBTN").click(function(){
    var search = $('#GoogleSearch').val();
    var url = "https://www.googleapis.com/customsearch/KEYSh;
    $.ajax({url: url, success: function(response){
      for (var i = 0; i < response.items.length; i++) {
        var item = response.items[i];

        appendToScreen(item.title, item.link, item.snippet);
      }
    }});
  });


  function appendToScreen(titlex, urlx, descriptionx){
    var node = document.createElement('div');
    node.setAttribute("class", "SearchResults");
    var chckBX = document.createElement('input');
    chckBX.setAttribute("type", "checkbox");
    chckBX.setAttribute("id", "checkbX");
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
});
