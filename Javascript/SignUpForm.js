function ValidateName()
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