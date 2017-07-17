

function hover() {
  console.log('hover');
  if (this.id == "editimg"){
    this.src = "images/editmb2.png";
  }
  else {
    this.src = "uploads/upload2.png"
  }
}

function unhover(){
  if (this.id == "editimg"){
    this.src = "images/editmb.png";
  }
  else{
    this.src = "uploads/upload.png"
  }
}

function click(){
  if (this.id == "editimg"){
    editbbpage();
  }
  else{
    uploadpage();
  }
}

function getpdfs(){
  console.log("getting newer pdfs");
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    var bdata = xmlhttp.responseText;
    // console.log('response: ' + bdata);
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
      var msgdiv = document.getElementById("msgs");
      if (isJson(bdata)){
      // console.log(bdata);
      var jsondata = JSON.parse(bdata);
      // console.log(jsondata);
      updatetoolbar(jsondata);
      displayinitial();
    }}
    // else {console.log('response:  ' + xmlhttp.responseText);}
  }
  xmlhttp.open("GET", "content.php", true);
  xmlhttp.send();
  };


function editpage() {
  console.log("changing!");
  var main = document.getElementById("wrap");
  main.innerHTML = "";
  var options = document.createElement('div')
  options.id = "optionsdiv";
  var upload = document.createElement('div');
  upload.id = "uploaddiv";
  var edit = document.createElement('div');
  edit.id = "editdiv"
  var editimg = document.createElement('img');
  editimg.src = "images/editmb.png";
  editimg.id = "editimg";
  editimg.onclick = test;
  var uploadimg = document.createElement('img');
  uploadimg.id = "uploadimg";
  uploadimg.src = "images/upload.png";
  // editimg.onclick = function {this.src="images/editmb2.png"};
  uploadimg.onmouseover = test;
  var editxt = document.createTextNode('Edit Bulletin Board');
  edit.appendChild(editxt);
  edit.appendChild(editimg);
  var uploadtxt = document.createTextNode('Upload new PDFs');
  upload.appendChild(uploadtxt);
  upload.appendChild(uploadimg);
  options.appendChild(edit);
  options.appendChild(upload);
  main.appendChild(options);
}


function updatediv(obj) {
  msgdiv = document.getElementById("msgs");
  msgdiv.innerHTML = "";
  if (obj){
  var j = obj.length;
  // console.log('updatediv: ' + obj);
  for (i=0; i<j; i++){
    var currentmsg = obj[j-(i+1)];
    var cname = currentmsg["name"];
    var cmsg = currentmsg["msg"];
    // msgdiv contains all msgs. msgwrap contains both msg and del;
    // name contains just the name. newmsgdiv contains msgwap and name.
    var newmsgdiv = document.createElement('div');
    newmsgdiv.id=currentmsg["id"];
    newmsgdiv.className = "msgdiv";
    var name = document.createElement('div');
    name.innerHTML = cname + ": ";
    name.className = "name";
    var msgwrap = document.createElement('div')
    msgwrap.className = "wrap";
    var msg = document.createElement('div');
    msg.innerHTML  = cmsg;
    msg.className = "msg";
    // var del = document.createElement('div');
    // del.className = "del";
    // del.innerHTML = "<u>Delete</u>"
    // del.onclick = deletemsg;
    // del.id = currentmsg["id"];
    msgwrap.appendChild(msg);
    // name.appendChild(del)
    newmsgdiv.appendChild(name);
    newmsgdiv.appendChild(msgwrap);

    if (currentmsg["image"] !== "" && currentmsg["image"] !== "none") {
      var imgdiv = document.createElement('div');
      var img = document.createElement('img');
      img.src = currentmsg["image"];
      var imgwidth = parseInt(img.width);
      var divwidth = msgdiv.offsetWidth;
      // console.log(imgwidth);
      if (imgwidth > divwidth || imgwidth > 600 || imgwidth == 0){
        img.className = "uploadimg";
      }
      imgdiv.appendChild(img);
      newmsgdiv.appendChild(imgdiv);
    }
    msgdiv.appendChild(newmsgdiv);
  }}
}

function isJson(str) {
    try {
        JSON.parse(str);
    } catch (e) {
        return false;
    }
    return true;
  }

function loadboard(){
var xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function() {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
      var msgdiv = document.getElementById("msgs");
      var bdata = xmlhttp.responseText;
      // console.log(bdata);
      if (isJson(bdata)){
      // console.log(bdata);
      var jsondata = JSON.parse(bdata);
      // console.log(bdata);
      // console.log(jsondata);
      updatediv(jsondata);
    }
    else if (bdata == ""){
      console.log('no board data');
      updatediv();
    }
  }
    };
text = 'act=load';
console.log('loadboard');
xmlhttp.open("POST", "boardsave.php", true);
xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xmlhttp.send(text);
};


function pdfload(page) {
  main = document.getElementById("wrap")
  main.innerHTML = "<embed src='" + page + "#toolbar=0&navpanes=0&scrollbar=0&view=fitH' type='application/pdf' width=80% height=500px zoom=100%> alt : <a href='" + page + "'>" + page + "</a></embed>";
  // console.log("<object data='" + page + "' type='application/pdf' width=80% height=1000px> alt : <a href='" + page + "'>" + page + "</a></object>");
  return false;
  var open = document.getElementsByClassName('clicked');
  }

  function pdfloadprint(page) {
    main = document.getElementById("wrap")
    main.innerHTML = "<object data='" + page + "' type='application/pdf' width=80% height=1000px> alt : <a href='" + page + "'>" + page + "</a></object>";
    // console.log("<object data='" + page + "' type='application/pdf' width=80% height=1000px> alt : <a href='" + page + "'>" + page + "</a></object>");
    return false;
    }

function pdfloadls(page) {
  main = document.getElementById("wrap")
  main.innerHTML = "<object data='" + page + "#toolbar=0&navpanes=0&scrollbar=0' type='application/pdf' width=100% height=1000px> alt : <a href='pdfs/" + page + "'>" + page + "</a></object>";
  return false;
}

function displaybboard() {
  main = document.getElementById("wrap");
  main.innerHTML = "<div id='msgs'></div>";
  loadboard();
}

function showdrop(id){
  var button = document.getElementById(id)

  var drop = button.childNodes[3];
  var linkb = button.childNodes[1];
  console.log('showdopr ' + linkb);
  if (drop.className == "dropcontent"){
    drop.className = "clicked";
    // button.style['border'] = '1px solid red'
    linkb.style['color'] = 'red';
  }
  else {
    drop.className = "dropcontent";
    linkb.style['color'] = 'white'
  }
}

window.onload = function() {
  console.log('running');
  getpdfs()
  document.getElementById("bulletin").onclick = function() {displaybboard(); return false}
  document.getElementById("todayl").onclick = function(){showdrop("first"); return false};
  document.getElementById("staffl").onclick = function(){showdrop("staffb"); return false};
  document.getElementById("formsl").onclick = function(){showdrop("formsb"); return false};
  document.getElementById("buildingl").onclick = function(){showdrop("buildingb"); return false};
  document.getElementById("calendarl").onclick = function(){showdrop("calendarb"); return false};

  // document.getElementById("futureb").onclick = function(){console.log(this.id);showdrop(this.id); return false};
  // document.getElementById("bulletin").onclick = function(){console.log("hi!");displaybboard(); return false}
  return false;
}

function nav(){
  var open = document.getElementsByClassName('clicked');
  console.log('open ' + open);
  if (open){
  for (var i=0; i<open.length; i++){
    console.log(i);
    console.log(open[i]);
    console.log(open[i].className);
    open[i].className = "dropcontent";
  }}
  var buttons = document.getElementsByClassName('dropbtn2');

  for (var i=0; i<buttons.length; i++){
    buttons[i].style["color"] = "white";
  }
  if (masterdict[this.id][1] == "calendar"){
    pdfloadls(masterdict[this.id][0]);
    return false;
  }
  else if (masterdict[this.id][1] == "forms"){
    pdfloadprint(masterdict[this.id][0]);
    return false;
  }
  else {
  pdfload(masterdict[this.id][0]);
  return false;
}
return false;
}

var masterdict = {};
columndict = {};
todaylist = []
headers = {
  "today": "Today",
  "calendar": "Calendar",
  "forms": "Forms",
  "staff": "Staff & Crew",
  "building": "Building"
}

function updatetoolbar(obj){
  todaylist = []
    for (i=0; i<obj.length; i++){
      if (obj[i]['columncat'] == 'TODAY') {
      todaylist.push(obj[i]['filepath'])
      }
    if (obj[i]['columncat'] !== ""){
    var id = obj[i]['id']
    if (columndict[obj[i]['columncat']] == null){
      columndict[obj[i]['columncat']] = [obj[i]['filename']];
    }
    else {
    columndict[obj[i]['columncat']].push(obj[i]['filename'])}
    var path = obj[i]['filepath']
    var name = obj[i]['filename']
    var column = obj[i]['columncat']
    masterdict[id] = [path, column, name];
    var dropd = document.getElementById(obj[i]['columncat']);
    console.log(obj[i]['columncat']);


    var newfile = document.createElement('div');
    var cellid = id + "b";
    newfile.innerHTML = "<a href='' id='" + cellid + "'>" + obj[i]['filename'] + "</a>";
    newfile.id = id;
    dropd.appendChild(newfile);
    newfile.className = "dropcell";
    newfile.onclick = nav;
  }}
  for (var key in columndict){
    var head = document.getElementById(key+'l');
    head.innerHTML = headers[key];
    if (columndict[key].length > 1){
      var head = document.getElementById(key+'l');
      var newt = '&#9660 ' + head.innerHTML;
      head.innerHTML = newt;

    }
  }
}



function displayinitial(){
  if (todaylist.length > 1){
      p1 = todaylist[0]
      p2 = todaylist[1]
      var left = document.getElementById("lpdf");
      var right = document.getElementById("rpdf");
      left.innerHTML = "<embed src='" + p1 + "#toolbar=0&navpanes=0&scrollbar=0&view=fitH' type='application/pdf' width=100% height=500px zoom=100%> alt : <a href='" + p1 + "'>" + p1 + "</a></embed>";
      right.innerHTML = "<embed src='" + p2 + "#toolbar=0&navpanes=0&scrollbar=0&view=fitH' type='application/pdf' width=100% height=500px zoom=100%> alt : <a href='" + p2 + "'>" + p2 + "</a></embed>";
  }
  else if (todaylist.length>0){
    var main = document.getElementById("wrap")
    p = todaylist[0]
    main.innerHTML = "<embed src='" + p + "#toolbar=0&navpanes=0&scrollbar=0&view=fitH' type='application/pdf' width=80% height=500px zoom=100%> alt : <a href='" + p + "'>" + p + "</a></embed>";
  }}
