function validateUsername()
{
  var username=document.getElementById("username").value;
  var password=document.getElementById("password").value;
  var password2=document.getElementById("password2").value;

  if(password!==password2)
  {
    window.alert("Passwords don't match");
    return;
  }
  else if(username=="")
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
      if(this.readyState===4)
      {
        var result=this.responseText;
        if(result!="")
        {
          window.alert(result);
        }
        else
        {
          window.location.replace("http://web.engr.oregonstate.edu/~lindenba/check/index.php");
        }
      }
    };
    
    req.open('POST', 'http://web.engr.oregonstate.edu/~lindenba/check/addUser.php');
    req.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
    req.send(start);
  }
};

  