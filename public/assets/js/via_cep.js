// conexão do javascript com o hTML
let form = document.forms["main_form_cadastrar"];

let cepFav = "44095292";

// document.addEventListener
// onblur="alert(123)"
form.ciCep.addEventListener("blur", (event) => {
  getAddressByCep(form);
});

/* 

{
  "cep": "44095-292",
  "logradouro": "Rua Três Irmãos",
  "complemento": "",
  "bairro": "Aviário",
  "localidade": "Feira de Santana",
  "uf": "BA",
  "ibge": "2910800",
  "gia": "",
  "ddd": "75",
  "siafi": "3515"
}
*/
// requisição com a api extena da via cep
function getAddressByCep(form) {
  let cep = form.ciCep.value;
  if (cep !== "") {
    let ViaCepURI = `https://viacep.com.br/ws/${cep}/json/`;
    let request = fetch(ViaCepURI);
    request
      .then((res) => res.json())
      .then((res) => {
        form.ciCep.value = res.cep;
        form.ciCidade.value = res.localidade;
        form.cibairro.value = res.bairro;
        form.ciEstado.value = res.uf;
        form.ciRua.value = res.logradouro;
        console.log(res);
      });
  } else {
    return false;
  }
}
