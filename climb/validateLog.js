function logIn()
{
	var username=document.getElementById("username").value;
  var password=document.getElementById("password").value;

 
  if(username=="")
  {
    window.alert("Username required");
    return;
  }
  else if(password=="")
  {
    window.alert("Password required");
    return;
  }
  else
  {
    var req=new XMLHttpRequest();
    if(!req)
    {
      throw 'Not able to create HttpRequest.';
    }

    var start="username="+username+"&password="+password;

    req.onreadystatechange=function()
    {
      if(this.readyState==4)
      {
        var result=this.responseText;
        if(result!="")
        {
          window.alert(result);
        }
        else
        {
          window.location.replace("http://web.engr.oregonstate.edu/~lindenba/check/main.php");
        }
      }
    };
    var url='http://web.engr.oregonstate.edu/~lindenba/check/logCheck.php';
    req.open('POST', url);
    req.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
    req.send(start);
  }
};