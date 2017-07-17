<?php
include('session.php');
?>
<!DOCTYPE html>
<html>
<head>
<link href="styles/main.css" rel="stylesheet" type="text/css">
</head>
<body onload="getpdfs()">

<!-- <script type="text/javascript" src="scripts/pdfobject.js"></script> -->
<!-- <script type="text/javascript" src="scripts/main2.js"></script> -->

<header>
<div id="headerdiv">
<img id="headerimg" src="images/header.jpg" height="" width="" alt="The Awesome Nightly Show Intranet" onclick="location.href='logout.php'">
</div>
</header>


<div id="homef">
<img class="icon" src="images/home.png" height="42" width="42" onmouseover="this.src='images/home2.png'" onmouseout="this.src='images/home.png'" onclick="location.href='logout.php'">
</div>
<div id="editf">
<img class="icon" src="images/editmb.png" height="42" width="42" onmouseover="this.src='images/editmb2.png'" onmouseout="this.src='images/editmb.png'" onclick="location.href='profile.php'">
</div>

<script>

columndict = {}
masterdict = {}

function nav(){
  deletepdf(this.id);
  return false;
}

function isJson(str) {
    try {
        JSON.parse(str);
    } catch (e) {
        return false;
    }
    return true;
}

function deletepdf(id){
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
      var msgdiv = document.getElementById("msgs");
      var bdata = xmlhttp.responseText;
      console.log(bdata);
      if (bdata != isJson(bdata)){
      console.log(bdata);
      var jsondata = JSON.parse(bdata);
      updatetoolbar(jsondata);
    }
    else if (bdata == ""){
      updatetoolbar();
    }
    var msg = document.getElementById("message");
    msg.innerHTML = "File deleted.";
    }
    };
    var path = masterdict[id][0];
  var formData = new FormData();
  formData.append("act","del");
  formData.append("id", id);
  formData.append("path", path);
  xmlhttp.open("POST", "upload.php", true);
  xmlhttp.send(formData);
  return false;
}

function removeChildren(dom){
  while (dom.firstChild) {
    dom.removeChild(dom.firstChild);}
}

function updatetoolbar(obj){
    masterdict={}
    columndict={}
    removeChildren(document.getElementById("TODAY"))
    removeChildren(document.getElementById("CALENDAR"))
    removeChildren(document.getElementById("forms"))
    removeChildren(document.getElementById("staff"))
    removeChildren(document.getElementById("building"))

    for (i=0; i<obj.length; i++){
    if (obj[i]['columncat'] !== ""){
    var id = obj[i]['id']
    // thisitem = obj[i]['filename'],obj[i]['filepath']
    if (columndict[obj[i]['columncat']] == null){
      console.log('init');
      columndict[obj[i]['columncat']] = [obj[i]['filename']];
    }
    else {
    columndict[obj[i]['columncat']].push(obj[i]['filename'])}
    var path = obj[i]['filepath']
    var name = obj[i]['filename']
    var column = obj[i]['columncat']
    masterdict[id] = [path, column, name];
    var dropd = document.getElementById(obj[i]['columncat']);

    var newfile = document.createElement('div');
    newfile.innerHTML = "<a href='' id='test'>Delete: " + obj[i]['filename'] + "</a>"
    newfile.id = id;
    dropd.appendChild(newfile);
    // var test = document.getElementById('test');
    newfile.className = "dropcell";
    newfile.onclick = nav;
    var check = 1
    if (check == 0){
    var newmenuitem = document.createElement('div');
    newmenuitem.id = obj[i]['id'];
    newmenuitem.innerHTML = title + "   <a href=''>x</a>";
    newmenuitem.className = "filetile";
    newmenuitem.onclick = function(){deletepdf(this.id); return false}
    column.appendChild(newmenuitem)
    }
  }}
  for (var key in columndict){
    headers = {
      "TODAY": "Today",
      "CALENDAR": "Calendar",
      "forms": "Forms",
      "staff": "Staff & Crew",
      "building": "Building"
    }
    var head = document.getElementById(key+'l');
    head.innerHTML = headers[key];
    if (columndict[key].length > 1){
      var head = document.getElementById(key+'l');
      var newt = '&#9660 ' + head.innerHTML;
      head.innerHTML = newt;

    }
  }
}

// function updatetoolbar(obj){
//   removeChildren(document.getElementById("today"))
//   removeChildren(document.getElementById("calendar"))
//   removeChildren(document.getElementById("forms"))
//   removeChildren(document.getElementById("staff"))
//   removeChildren(document.getElementById("building"))
//   removeChildren(document.getElementById("future"))
//   if (obj){
//   for (i=0; i<obj.length; i++){
//     // console.log(i);
//     if (obj[i]['columncat'] !== ""){
//     var menu = obj[i]['columncat'];
//     var title = obj[i]['filename'];
//     var id = obj[i]['id']
//     var column = document.getElementById(menu);
//     var check = 0;
//       for (var j=0; j<column.childNodes.length; j++){
//         if (column.childNodes[j].id == id){
//           console.log(column.childNodes[j].id);
//           check = 1;
//         }
//       }
//     if (check == 0){
//     var newmenuitem = document.createElement('div');
//     newmenuitem.id = obj[i]['id'];
//     newmenuitem.innerHTML = title + "<br><a href=''>x</a>";
//     newmenuitem.className = "filetile";
//     newmenuitem.onclick = function(){deletepdf(this.id); return false}
//     column.appendChild(newmenuitem)
//   }
//   }
//
// }}
// }

function upload(){
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
      if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
        var msgdiv = document.getElementById("msgs");
        var bdata = xmlhttp.responseText;
        console.log(bdata);
        if (isJson(bdata)){
          var msg = document.getElementById("message");
          msg.innerHTML = "File Upload Successsful!";
          console.log("here");
          updatetoolbar(JSON.parse(bdata));
        }
        else {
          var msg = document.getElementById("message");
          msg.innerHTML = xmlhttp.responseText;
        }
      }
      };
  // text = 'fname=' + fname + '&fmsg=' + fmsg + '&fpwd=' + fpwd + '&act=save';
  var getfile = document.getElementById("fileToUpload").files[0];
  var filefunction = document.getElementById("ffunc").value;
  var title = document.getElementById("title").value;
  var formData = new FormData();
  formData.append(
    "newpdf", document.getElementById("fileToUpload").files[0]
);
  formData.append("ffunc",filefunction);
  formData.append("title", title);
  formData.append("act", "up");
  var xhr = new XMLHttpRequest();
  console.log(formData.keys());
  xmlhttp.open("POST", "upload.php", true);
  // xmlhttp.setRequestHeader("Content-type", "image/png");
  xmlhttp.send(formData);
}

function getpdfs(){
  console.log("getting pdfs");
var xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function() {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
      var msgdiv = document.getElementById("msgs");
      var bdata = xmlhttp.responseText;
      // console.log(bdata);
      if (bdata != ""){
      // console.log(bdata);
      var jsondata = JSON.parse(bdata);
      // console.log(bdata);
      // console.log(jsondata);
      updatetoolbar(jsondata);
    }}
    };
xmlhttp.open("GET", "content.php", true);
xmlhttp.send();
};

function showdrop(id){
  var button = document.getElementById(id)
  var drop = button.childNodes[3];
  var dropstyle = drop.style['display']

  if (dropstyle == "inline-block"){
    drop.style['display'] = 'none'
    button.style['background-color'] = 'black'
  }
  else {
    drop.style['display'] = "inline-block";
    button.style['background-color'] = "red"
    button.style['color'] = 'black';
  }
}


window.onload = function() {
  getpdfs()
  document.getElementById("TODAYl").onclick = function(){showdrop("first"); return false};
  document.getElementById("staffl").onclick = function(){showdrop("staffb"); return false};
  document.getElementById("formsl").onclick = function(){showdrop("formsb"); return false};
  document.getElementById("buildingl").onclick = function(){showdrop("buildingb"); return false};
  document.getElementById("CALENDARl").onclick = function(){showdrop("CALENDARlb"); return false};

  // document.getElementById("futureb").onclick = function(){console.log(this.id);showdrop(this.id); return false};
  // document.getElementById("bulletin").onclick = function(){console.log("hi!");displaybboard(); return false}
  return false;
}
</script>

<div id="navdiv">
    <div class="button drop" id="first">
      <div class="dropbtn2" class="active" id="TODAYl">&#9660 Today</div>
      <div class="dropcontent" id="TODAY">
      </div>
  </div>
  <div class="button drop" id="CALENDARb">
    <div class="dropbtn2" id="CALENDARl">calendar</div>
    <div class="dropcontent" id="CALENDAR"></div>
  </div>
  <div class="button drop" id="formsb">
        <div class="dropbtn2" id="formsl">&#9660 Forms</div>
        <div class="dropcontent" id="forms"></div>
  </div>
  <div class="button drop" id="staffb">
        <div class="dropbtn2" id="staffl">&#9660 Staff &amp Crew</div>
        <div class="dropcontent" id="staff">
        </div>
  </div>
  <div class="button drop" id="buildingb">
        <div class="dropbtn2" id="buildingl">&#9660 Building</div>
        <div class="dropcontent" id="building">
        </div>
  </div>
</div>
<div id="uform">
Use the navigation menu to select a pdf to delete, or upload a new pdf below.<br>
Select file to upload:
      <input type="file" name="fileToUpload" id="fileToUpload">
      <br>
Select the menu in which the pdf should placed:
<select id="ffunc">
  <option value="TODAY">Today</option>
  <option value="CALENDAR">Calendar</option>
  <option value="forms">Forms</option>
  <option value="staff">Staff & Crew</option>
  <option value="building">Building</option>
</select><br>
File Title:  <input type="text" id="title"><br>
<input type="button" value="Upload!" onclick="upload()">

<div id="message"></div>
</div>


</body>
</html>
