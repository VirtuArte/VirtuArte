// Funções para arrasta e solta do arquivo
function readFile(e) {
	var files
	if (e.target.files) {
		files = e.target.files
	} else {
		files = e.dataTransfer.files
	}
	if (files.length == 0) {
		alert('What you dropped is not a file.')
		return
	}
	var file = files[0]
	document.getElementById('fileDragName').value = file.name
	document.getElementById('fileDragSize').value = file.size
	document.getElementById('fileDragType').value = file.type
	reader = new FileReader()
	reader.onload = function (e) {
		document.getElementById('fileDragData').value = e.target.result

		document.getElementById('postPreview').src = e.target.result
	}
	document.getElementById('labelFile').innerHTML = 'Arquivo selecionado'
	document.getElementById('previewArea').style.display = 'block'
	reader.readAsDataURL(file)
}
function getTheFile(e) {
	e.target.style.borderColor = '#ccc'
	readFile(e)
}

var holder = document.getElementById('inputGroupFile01')
holder.ondragover = function () {
	this.classList.add('hover')
	return false
}

holder.ondragleave = function () {
	this.classList.remove('hover')
	return false
}

submit = document.getElementById('publish');

submit.addEventListener('click', () => {
	if (document.getElementById('inputBanner').files.length == 0) {
		document.getElementById('alert').innerHTML = "* Selecione um arquivo";
	}
})

function readPhotoProfile(e) {
	var files
	if (e.target.files) {
		files = e.target.files
	} else {
		files = e.dataTransfer.files
	}
	if (files.length == 0) {
		alert('What you dropped is not a file.')
		return
	}
	var file = files[0]
	document.getElementById('photoDragName').value = file.name
	document.getElementById('photoDragSize').value = file.size
	document.getElementById('photoDragType').value = file.type
	reader = new FileReader()
	reader.onload = function (e) {
		document.getElementById('photoProfile').value = e.target.result
        
		document.getElementById('photoPreview').src = e.target.result
	}
	document.getElementById('labelPhoto').innerHTML = 'Arquivo selecionado'
	document.getElementById('previewPhoto').style.display = 'block'
	reader.readAsDataURL(file)
}
function getThePhoto(e) {
	e.target.style.borderColor = '#ccc'
	readPhotoProfile(e)
}

submit.addEventListener('click', () => {
	if (document.getElementById('inputPhoto').files.length == 0) {
		document.getElementById('alert2').innerHTML = "* Selecione um arquivo";
	}
})