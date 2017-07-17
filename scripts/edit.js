function isJson(str) {
    try {
        JSON.parse(str);
    } catch (e) {
        return false;
    }
    return true;
}

images = {};

function updatediv(obj) {
  images = {};
  console.log("updating!");
  msgdiv = document.getElementById("msgs");
  msgdiv.innerHTML = "";
  if (obj){
  var j = obj.length;
  // console.log(obj);
  for (i=0; i<j; i++){
    var currentmsg = obj[j-(i+1)];
    var cname = currentmsg["name"];
    var cmsg = currentmsg["msg"];
    // msgdiv contains all msgs. msgwrap contains both msg and del;
    // name contains just the name. newmsgdiv contains msgwap and name.
    var newmsgdiv = document.createElement('div');
    newmsgdiv.id=currentmsg["id"];
    newmsgdiv.className = "msgdivdel";
    var name = document.createElement('div');
    name.innerHTML = cname + ": ";
    name.className = "name";
    var msgwrap = document.createElement('div')
    msgwrap.className = "wrap";
    var msg = document.createElement('div');
    msg.innerHTML  = cmsg;
    msg.className = "msg";
    //
    var del = document.createElement('div');
    del.className = "del";
    del.innerHTML = "<u>Delete</u>"
    del.onclick = deletemsg;
    del.id = currentmsg["id"];
    //
    msgwrap.appendChild(msg);
    // msgwrap.appendChild(del)
    name.appendChild(del);
    newmsgdiv.appendChild(name);
    newmsgdiv.appendChild(msgwrap);

    images[currentmsg["id"]] = currentmsg["image"];

    if (currentmsg["image"] !== "" && currentmsg["image"] !== "none") {
      console.log("add img!");
      var imgdiv = document.createElement('div');
      var img = document.createElement('img');
      img.src = currentmsg["image"];
      var divwidth = msgdiv.offsetWidth;
      var imgwidth = parseInt(img.width);
      console.log("imgwidth: " + imgwidth);
      if (imgwidth > 500 || imgwidth > divwidth || imgwidth == 0){
        img.className = "uploadimg";
      }
      imgdiv.appendChild(img);
      newmsgdiv.appendChild(imgdiv);
    }
    msgdiv.appendChild(newmsgdiv);
  }}
}

function loadeboard(){
var xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function() {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
      var msgdiv = document.getElementById("msgs");
      var bdata = xmlhttp.responseText;
      // console.log(bdata);
      if (isJson(bdata)){
      updatediv(JSON.parse(bdata));
    }
      else if (bdata == ""){
          updatediv();
      }
      else {
        console.log(bdata);
      }
      }
    };
text = 'act=load';
xmlhttp.open("POST", "http://localhost:8888/boardsave.php", true);
xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xmlhttp.send(text);
};


function pdfload(page) {
  main = document.getElementById("wrap")
  main.innerHTML = "<object data='" + page + "' type='application/pdf' width=80% height=1000px> alt : <a href='" + page + "'>" + page + "</a></object>";
  return false;
  }

function pdfloadls(page) {
  main = document.getElementById("wrap")
  main.innerHTML = "<object data='" + page + "' type='application/pdf' width=100% height=1000px> alt : <a href='" + page + "'>" + page + "</a></object>";
  return false;
}

function displayeboard() {
  main = document.getElementById("wrap");
  main.innerHTML = "<div id='msgs'></div>";
  loadeboard();
}

function deletemsg(){
  var delid = this.id;
  var delpath = images[this.id];
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
      if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
        var msgdiv = document.getElementById("msgs");
        var bdata = xmlhttp.responseText;
        console.log(bdata);
        if (bdata[0] == "e"){
          console.log("error");}
        else if (isJson(bdata)){
        var bdata = JSON.parse(bdata);
        updatediv(bdata);}
        else if (bdata == ""){
          updatediv();}
        }
      };
  text = 'act=del&delid=' + delid + '&delpath=' + delpath;
  xmlhttp.open("POST", "http://localhost:8888/boardsave.php", true);
  xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xmlhttp.send(text);
}

function savef() {
  var fname = document.getElementById("name").value;
  var fmsg = document.getElementById("fmsg").value;
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
      if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
        var msgdiv = document.getElementById("msgs");
        var bdata = xmlhttp.responseText;
        console.log(bdata);
        jsondata = JSON.parse(bdata);
        if (bdata == "error"){
          // do something
        }
        else if (bdata != ""){
          // console.log("hi");
        updatediv(jsondata);
      }
    }};


  var formData = new FormData();
  formData.append("fname",fname);
  formData.append("fmsg", fmsg);
  formData.append("act", "save");
  var getfile = document.getElementById("image").files[0];
  if (getfile != null) {
    formData.append("image", getfile);
    console.log("image!");
  }
  else {
    console.log("no image!");
  }
  xmlhttp.open("POST", "http://localhost:8888/boardsave.php", true);
  // xmlhttp.setRequestHeader("Content-type", "image/png");
  xmlhttp.send(formData);

};
