/*
filedrag.js - HTML5 File Drag & Drop demonstration
Featured on SitePoint.com
Developed by Craig Buckler (@craigbuckler) of OptimalWorks.net
*/
(function() {

	// getElementById
	function $id(id) {
		return document.getElementById(id);
	}


	// output information
	function Output(msg) {
		var m = $id("gal_imgs");
		m.innerHTML = m.innerHTML + msg;
	}


	// file drag hover
	function FileDragHover(e) {
		e.stopPropagation();
		e.preventDefault();
		e.target.className = (e.type == "dragover" ? "hover" : "");
	}


	// file selection
	function FileSelectHandler(e) {

		// cancel event and hover styling
		FileDragHover(e);

		// fetch FileList object
		var files = e.target.files || e.dataTransfer.files;

		// process all File objects
		for (var i = 0, f; f = files[i]; i++) {
			ParseFile(f);
		}

	}


	// output file information
	function ParseFile(file) {

		if (file.type.indexOf("image") == 0) {
			var reader = new FileReader();
			reader.onload = function(e) {
				//$('#fileselect').val());
				
				alert(e.target);
				Output(
									"<div class='col-md-3'><p><strong>" + file.name + ":</strong><br />" +
									'<img src="' + e.target.result + '" class="img-responsive" /></p></div>'
								);
				var image_name = file.name;
				var image_src = e.target.result;
				var web_id = $('#id').val();
				alert(image_src);
				if(web_id)
				{
					$.ajax(
				    {
				        type:"post",
				        url:"include/upload_user_website_photo.php",
				        data:{
				          	image_name : image_name,
				          	image_src : image_src,
				          	web_id : web_id
				        },
				        success:function(data)
				        {
				          //alert(data);
				            if(data.VerficationStatus=="Y")
				            {
				              Output(
									"<div class='col-md-3'><p><strong>" + file.name + ":</strong><br />" +
									'<img src="' + e.target.result + '" class="img-responsive" /></p></div>'
								);
				            }
				            
				            else
				            {
				              	alert("can't upload image!");
				            }

				             
				        },dataType: "json"
				    });
				}
				
			}
			reader.readAsDataURL(file);
			//submitbutton.style.display = "block";
		}

		// display an image
		
	}


	// initialize
	function Init() {

		var fileselect = $id("fileselect"),
			filedrag = $id("filedrag"),
			submitbutton = $id("submitbutton");

		alert(URL.createObjectURL(event.target.files[0]));
	    

	    
		// file select
		fileselect.addEventListener("change", FileSelectHandler, false);

		// is XHR2 available?
		var xhr = new XMLHttpRequest();
		if (xhr.upload) {

			// file drop
			filedrag.addEventListener("dragover", FileDragHover, false);
			filedrag.addEventListener("dragleave", FileDragHover, false);
			filedrag.addEventListener("drop", FileSelectHandler, false);
			filedrag.style.display = "block";

			// remove submit button
			submitbutton.style.display = "none";
		}
		

	}

	// call initialization file
	if (window.File && window.FileList && window.FileReader) {
		Init();
	}


})();