function show(evt)
{
    //alert("ram ram");
    
    
    //evt=window.event;
    
    var xpos;
    var ypos;
    xpos=evt.clientX;
    ypos=evt.clientY;
    var profilepic=document.getElementById("profilepic");
    profilepic.innerHTML="change Photo";
    profilepic.style.visibility="visible";
    
    //profilepic.style.top=ypos+"px";
    //profilepic.style.left=xpos+"px";
    
    
}
function showpic()
{
    var pic=document.getElementById("pic");
    pic.style.visibility = "visible";
    //alert("ram sa");
}
function open_win()
{
window.open("../admin/photo_upload.php","my_new_window","toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width=400, height=400")
}
function changepic(){
    //alert("hello");
    var changephotolink=document.getElementById("changepiclink");
    var profilepic=document.getElementById("profilepic");
    //document.write(profilepic.style.top);
    changephotolink.style.top=80+"px";
    changephotolink.style.left=20+"px";
    changephotolink.style.visibility="visible";
    //var profilepic=document.getElementById("profilepic");
    profilepic.onmouseout=function(){
                
                document.getElementById("changepiclink").style.visibility="hidden";
    }
}