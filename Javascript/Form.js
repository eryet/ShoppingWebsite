function ValidateSignUpName()
{
	var input = document.forms["SignUpForm"]["Name"].value;
	var inputvalue =/^[A-Za-z]+$/;
	if(input.match(inputvalue))  
	{  
		return true;  
	}  
	else  
	{  
		alert("Enter only Alphabet!"); 
		document.SignUpForm.Name.focus();  
		return false;  
	}  
}

function ValidateLoginName()  
{  
	var input = document.forms["LoginForm"]["Name"].value;
	var inputvalue =/^[A-Za-z]+$/;
	if(input.match(inputvalue))  
	{  
		return true;  
	}  
	else  
	{  
		alert("Enter only Alphabet!"); 
		document.SignUpForm.Name.focus();  
		return false;  
	}  
}