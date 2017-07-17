
function updatediv(obj) {
  console.log("updating!");
  msgdiv = document.getElementById("msgs");
  msgdiv.innerHTML = "";
  var j = obj.length;
  console.log(obj);
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
    var del = document.createElement('div');
    del.className = "del";
    del.innerHTML = "<u>Delete</u>"
    del.onclick = deletemsg;
    del.id = currentmsg["id"];
    msgwrap.appendChild(msg);
    msgwrap.appendChild(del)
    newmsgdiv.appendChild(name);
    newmsgdiv.appendChild(msgwrap);
    msgdiv.appendChild(newmsgdiv);
  }
}

function loadeboard(){
var xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function() {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
      var msgdiv = document.getElementById("msgs");
      var bdata = xmlhttp.responseText;
      console.log(bdata);
      if (bdata != ""){
      // console.log(bdata);
      var jsondata = JSON.parse(bdata);
      // console.log(bdata);
      // console.log(jsondata);
      updatediv(jsondata);
    }}
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
  var pword = prompt("Please enter the password to delete messages.")
  var delid = this.id;
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
      if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
        var msgdiv = document.getElementById("msgs");
        var bdata = xmlhttp.responseText;
        console.log(bdata);
        if (bdata[0] == "e"){
          alert("Incorrect Password!")
        }
        else if (bdata != ""){
        var bdata = JSON.parse(bdata);
        updatediv(bdata);
        }
        // console.log(bdata);
        // console.log(jsondata);

      }
      };
  text = 'act=del&delid=' + delid + '&fpwd=' + pword;
  xmlhttp.open("POST", "http://localhost:8888/boardsave.php", true);
  xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xmlhttp.send(text);
}

function savef() {
  var fname = document.getElementById("name").value;
  var fmsg = document.getElementById("fmsg").value;
  var fpwd = document.getElementById("password").value;
  console.log(fpwd);
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
      if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
        var msgdiv = document.getElementById("msgs");
        var bdata = xmlhttp.responseText;
        if (bdata != ""){
        // var jsondata = JSON.parse(bdata);
        console.log(bdata);
        // console.log(jsondata);
        // updatediv(jsondata);
      }}
      };
  text = 'fname=' + fname + '&fmsg=' + fmsg + '&fpwd=' + fpwd + '&act=save';
  xmlhttp.open("POST", "http://localhost:8888/boardsave.php", true);
  xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xmlhttp.send(text);
};
