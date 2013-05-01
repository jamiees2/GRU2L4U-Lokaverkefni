$(function(){
	$("#password").on('keyup',function(){

		var $this = $(this);
		var pwd = $this.val();
		var pwd_confirm = $('#password_confirm');
		var $elem = $this.next('.add-on');
		if (pwd !== '')
		{
			pwd_confirm.attr('required',true);
			$this.attr('pattern','^.{6,}$');
		}
		else
		{
			pwd_confirm.attr('required',false);
			$this.attr('pattern','');
			this.setCustomValidity("");
			$elem.text('');
			return;
		}
		pwd_confirm.attr('pattern',pwd);
		var level = 0;
		this.setCustomValidity("");
		if (pwd.length < 6) { 
			this.setCustomValidity("Lykilorð er of stutt"); 
			$elem.text('Of stutt');
			return; 
		}
		else if (pwd.length > 6) level++;
		if (/[A-Z]/.test(pwd) && /[a-z]/.test(pwd)) {level++};
		if (/[0-9]/.test(pwd) && /[A-Za-z]/.test(pwd)) {level++};
		if (/[^A-Za-z0-9]{1,}/.test(pwd)) {level++};
		if (/[^A-Za-z0-9]{2,}/.test(pwd)) {level++};

		switch(level)
		{
			case 0:
			$elem.text('Veikt lykilorð');
			break;
			case 1:
			$elem.text("Betra, en samt ekki gott");
			break;
			case 2:
			$elem.text("Nothæft");
			break;
			case 3:
			$elem.text("Ágætlega sterkt");
			break;
			case 4:
			$elem.text("Sterkt");
			break;
			case 5:
			$elem.text("Mjög sterkt");
			break;
			default:
			break;
		}
	});
});