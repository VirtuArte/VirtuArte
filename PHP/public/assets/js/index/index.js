// function password_show_hide() {
//     var x = document.getElementById("floatingLoginPassword");
//     var show_eye = document.getElementById("show_eye");
//     var hide_eye = document.getElementById("hide_eye");
//     hide_eye.classList.remove("d-none");
//     if (x.type === "password") {
//         x.type = "text";
//         show_eye.style.display = "none";
//         hide_eye.style.display = "block";
//     } else {
//         x.type = "password";
//         show_eye.style.display = "block";
//         hide_eye.style.display = "none";
//     }
// }

// function typeAccount(){
//     alert('testado')
//   }

const type1 = document.getElementById(`type1`);
console.log(type1)
const type2 = document.getElementById(`type2`);
console.log(type2)

type1.addEventListener('onclick', console.log("click 1"));
type2.addEventListener('onclick', console.log("click 2"));

// tipo de conta de usuário
function typeAccount(){
	const personType = document.getElementsByName(`typeProfile`);
	const container = document.getElementById(`additional`);

	personType.forEach(element => {
		if(element.checked){
			if(element.value == 'pessoal'){
				container.innerHTML = ` `
			}
			else if(element.value == 'comercial'){
				container.innerHTML = `
				<fieldset class="border-top pt-4">
                    <legend>Infomações adicionais</legend>
                    <!-- descrição do local -->
                    <div class="form-floating mb-3">
                      <input type="text" class="form-control" id="floatingDescription" name="floatingDescription" placeholder="Descreva sua organização">
                      <label for="floatingDescription">Descrição</label>
                    </div>
                    <!-- valor de entrada -->
                    <div class="form-floating mb-3">
                      <input type="text" class="form-control" id="floatingValue" name="floatingValue" placeholder="Valor mínimo de entrada">
                      <label for="floatingValue">Valor</label>
                    </div>
                    <!-- ENDEREÇO -->
                    <legend class="mb-3">Endereço</legend>
                    <!-- cep -->
                    <div class="form-floating mb-3">
                      <input type="text" class="form-control" id="floatingCep" name="floatingCep" placeholder="CEP" onblur="cep()">
                      <label for="floatingCep">CEP</label>
                    </div>
                    <!-- logradouro -->
                    <div class="form-floating mb-3">
                      <input type="text" class="form-control" id="floatingStreet" name="floatingStreet" placeholder="Logradouro">
                      <label for="floatingStreet">Logradouro</label>
                    </div>
                    <!-- número -->
                    <div class="form-floating mb-3">
                      <input type="text" class="form-control" id="floatingNumber" name="floatingNumber" placeholder="Número">
                      <label for="floatingNumber">Número</label>
                    </div>
                    <!-- complemento -->
                    <div class="form-floating mb-3">
                      <input type="text" class="form-control" id="floatingComplement" name="floatingComplement" placeholder="Complemento">
                      <label for="floatingComplement">Complemento</label>
                    </div>
                    <!-- bairro -->
                    <div class="form-floating mb-3">
                      <input type="text" class="form-control" id="floatingDistrict" name="floatingDistrict" placeholder="Bairro">
                      <label for="floatingDistrict">Bairro</label>
                    </div>
                    <!-- cidade -->
                    <div class="form-floating mb-3">
                      <input type="text" class="form-control" id="floatingCity" name="floatingCity" placeholder="Cidade">
                      <label for="floatingCity">Cidade</label>
                    </div>
                    <!-- estado -->
                    <div class="form-floating mb-3">
                      <input type="text" class="form-control" id="floatingState" name="floatingState" placeholder="Estado">
                      <label for="floatingState">Estado</label>
                    </div>
                  </fieldset>`
			}
		}
	});
}

// preenchimento automatico endereço -> ViaCep
function cep(){
    const inputCep = document.querySelector('[name=floatingCep]');
    const inputStreet = document.querySelector('[name=floatingStreet]');
    const inputComplement = document.querySelector('[name=floatingComplement]');
    const inputDistrict = document.querySelector('[name=floatingDistrict]');
    const inputCity = document.querySelector('[name=floatingCity]');
    const inputState = document.querySelector('[name=floatingState]');
    
    inputCep.addEventListener('focusout', event => {
        // criar promise para receber os dados
        fetch(`https://viacep.com.br/ws/${inputCep.value}/json/`)
        // parametro resposta recebe
        .then(resposta => resposta.json())
        .then(dados => {
            inputStreet.value = dados.logradouro;
            inputComplement.value = dados.complemento;
            inputDistrict.value = dados.bairro;
            inputCity.value = dados.localidade;
            inputState.value = dados.uf;
        }) // resolve
        .catch(error => console.log(error)) // reject
    });
}


