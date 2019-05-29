<?php

$server  = "";
$username = "";
$password = "";
$dbname = "";

$conn = new mysqli($server, $username, $password, $dbname);

//OUTPUT USING Custom HTML TAG mixed with CSS
function searchOutput($title, $url, $description){
  echo    "<div class=\"SearchResults\">
          <input type=\"checkbox\" name=\"checkbX\" id=\"checkbX\"/>
          <p id=\"SearchTitle\"><a href=\""
            .$url.
          "\">"
            .$title.
          "</a></p>
          <p id=\"SearchLink\">"
            .$url.
          "</p>
          <p id=\"SearchDescription\">"
            .$description.
          "</p>
        </div>";
}

//OUTPUT Seach History
function adminOutput($terms, $COUNT, $searchDate, $timeToSearch){
  echo    "<p>Searched Term: "
            .$terms. " <br />Search results: " .$COUNT. " <br />Date: " .$searchDate. " <br />Search Time: " .$timeToSearch.
          "s</p>";
}

//Get Search History Data
function getSearchHistory($result){

  $queryResults = mysqli_num_rows($result);

  if($queryResults > 0){
    while($row = mysqli_fetch_assoc($result)){
        adminOutput($row['terms'], $row['COUNT'], $row['searchDate'], $row['timeToSearch']);
    }
  }
}

//SEARCH THROUGH YOUR DATABASE ***********************
function SearchMe($search, $conn, $searchType){
  //Query SEARCH Database **********************
  $msc = microtime(true); //TRACK TIME

  //Case-Insensitive
  if($searchType == "caseinsensitive"){
    $sql = "SELECT * FROM  page, word, page_word
    WHERE page.page_Id = page_word.page_Id
    AND word.word_Id = page_word.word_Id
    AND Upper(word.wordName) = Upper('$search')
    ORDER BY freq";
  }

  //Allow Partial Match
  else if($searchType == "allowpartialmatch"){
    $sql = "SELECT * FROM  page, word, page_word
    WHERE page.page_Id = page_word.page_Id
    AND word.word_Id = page_word.word_Id
    AND word.wordName LIKE '$search'
    ORDER BY freq";
  }

  $sqluse = $sql;

  //Get The Data Returned *************
  $result = mysqli_query($conn, $sqluse);

  //Number of results
  $queryResults = mysqli_num_rows($result);

  //OUTPUT to SCREEN
  if($queryResults > 0){
    while($row = mysqli_fetch_assoc($result)){
      searchOutput($row['title'], $row['url'], $row['description']);
    }
  }
  else{
    echo "<div class=\"SearchResults\"> No search results for \"" .$search. "\"</div>";
  }

  $msc = microtime(true)-$msc; //TRACK TIME END

  //SEARCH HISTORY insert into search table ************************
  $sqlx = "INSERT INTO `search` (`search_Id`, `terms`, `COUNT`, `searchDate`, `timeToSearch`)
          VALUES (NULL, '$search', '$queryResults', current_timestamp(), '$msc');";
  mysqli_query($conn, $sqlx);

  $pageidx = $row['page_Id'];
  //UPDATE page table ****************************
  $sqlx = "UPDATE `page` SET `lastIndexed` = current_timestamp() WHERE `page`.`page_Id` = '$pageidx'";
  mysqli_query($conn, $sqlx);

}
 ?>
