function ksaRemoveEl(id) {
	var child = document.getElementById(id);
	child.parentNode.removeChild(child);
}

function ksa_closeRegisterBox(e) {
	if(!document.getElementById('ksa-box-lightbox').contains(e.target))
		ksaRemoveEl('ksa-lightbox');
}

function ksa_popup(arg, action) {
	var overlay = document.createElement("div");
	overlay.setAttribute("id", "ksa-lightbox");
	overlay.setAttribute("onclick", "ksa_closeRegisterBox(event);");
	overlay.className = "flex flex-center";
	
	var close_lightbox = document.createElement("div");
	close_lightbox.setAttribute("id", "ksa-close-lightbox");
	close_lightbox.setAttribute("onclick", "ksaRemoveEl('ksa-lightbox')");
	overlay.appendChild(close_lightbox);

	var box = document.createElement("form");
	box.setAttribute("id", "ksa-box-lightbox");
	box.setAttribute("action", action);
	box.setAttribute("method", "POST");
	box.setAttribute("id", "ksa-box-lightbox");
	overlay.appendChild(box);

	var row = document.createElement("div");
	row.className = "ksa-row";
	var username = document.createElement("label");
	username.setAttribute("for", "ksa-username");
	username.className = "ksa-label-lightbox";
	username.innerText = "نام کاربری";
	row.appendChild(username);
	var input = document.createElement("input");
	input.setAttribute("id", "ksa-username");
	input.setAttribute("name", "ksa-username");
	input.setAttribute("type", "text");
	input.setAttribute("autocomplete", "off");
	input.className = "ksa-input-lightbox";
	row.appendChild(input);
	box.appendChild(row);

	row = document.createElement("div");
	row.className = "ksa-row";
	var password = document.createElement("label");
	password.setAttribute("for", "ksa-password");
	password.className = "ksa-label-lightbox";
	password.innerText = "رمز عبور";
	row.appendChild(password);
	input = document.createElement("input");
	input.setAttribute("id", "ksa-password");
	input.setAttribute("name", "ksa-password");
	input.setAttribute("type", "password");
	input.setAttribute("autocomplete", "off");
	input.className = "ksa-input-lightbox";
	row.appendChild(input);
	box.appendChild(row);

	if (arg == "login") {
		row = document.createElement("div");
		input = document.createElement("input");
		input.setAttribute("type", "submit");
		input.setAttribute("value", "ورود به سامانه");
		input.className = "ksa-submit-lightbox";
		row.appendChild(input);
		box.appendChild(row);
	} else{
		row = document.createElement("div");
		row.className = "ksa-row";
		var packageId = document.createElement("label");
		packageId.setAttribute("for", "ksa-packageId");
		packageId.className = "ksa-label-lightbox";
		packageId.innerText = "packageId";
		row.appendChild(packageId);
		input = document.createElement("input");
		input.setAttribute("id", "ksa-packageId");
		input.setAttribute("name", "ksa-packageId");
		input.setAttribute("type", "text");
		input.setAttribute("autocomplete", "off");
		input.className = "ksa-input-lightbox";
		row.appendChild(input);
		box.appendChild(row);

		row = document.createElement("div");
		row.className = "ksa-row";
		var mobile = document.createElement("label");
		mobile.setAttribute("for", "ksa-mobile");
		mobile.className = "ksa-label-lightbox";
		mobile.innerText = "موبایل";
		row.appendChild(mobile);
		input = document.createElement("input");
		input.setAttribute("id", "ksa-mobile");
		input.setAttribute("name", "ksa-mobile");
		input.setAttribute("type", "number");
		input.setAttribute("autocomplete", "off");
		input.className = "ksa-input-lightbox";
		row.appendChild(input);
		box.appendChild(row);

		row = document.createElement("div");
		row.className = "ksa-row";
		var name = document.createElement("label");
		name.setAttribute("for", "ksa-name");
		name.className = "ksa-label-lightbox";
		name.innerText = "نام";
		row.appendChild(name);
		input = document.createElement("input");
		input.setAttribute("id", "ksa-name");
		input.setAttribute("name", "ksa-name");
		input.setAttribute("type", "text");
		input.setAttribute("autocomplete", "off");
		input.className = "ksa-input-lightbox";
		row.appendChild(input);
		box.appendChild(row);

		row = document.createElement("div");
		row.className = "ksa-row";
		var family = document.createElement("label");
		family.setAttribute("for", "ksa-family");
		family.className = "ksa-label-lightbox";
		family.innerText = "نام خانوادگی";
		row.appendChild(family);
		input = document.createElement("input");
		input.setAttribute("id", "ksa-family");
		input.setAttribute("name", "ksa-family");
		input.setAttribute("type", "text");
		input.setAttribute("autocomplete", "off");
		input.className = "ksa-input-lightbox";
		row.appendChild(input);
		box.appendChild(row);

		row = document.createElement("div");
		input = document.createElement("input");
		input.setAttribute("type", "submit");
		input.setAttribute("value", "ثبت نام");
		input.className = "ksa-submit-lightbox";
		row.appendChild(input);
		box.appendChild(row);
	}

	document.body.appendChild(overlay);
}