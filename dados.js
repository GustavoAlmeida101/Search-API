

cnpj.addEventListener("blur", () => {
    const cnpj = document.querySelector("#cnpj")
    const cnpjSanatizado = limparString(cnpj.value)
    const url = `https://brasilapi.com.br/api/cnpj/v1/${cnpjSanatizado}`

    codigo()

    fetch(url)
        .then(response => {
            if (!response.ok) {
                throw new Error('Erro na requisição');
            }
            return response.json(); 
        })
        .then(data => {
            console.log(data); 
            document.getElementById("nomeempresa").value = data.razao_social;
            document.getElementById("nomefantasia").value = data.nome_fantasia;

            document.getElementById("numero").value = data.numero;

            const cep = document.getElementById("cep").value = data.cep;
            document.getElementById("datainicio").value = data.data_inicio_atividade
            document.getElementById("celular").value = data.ddd_telefone_1
            document.getElementById("telefone").value = data.ddd_telefone_2
            document.getElementById("fax").value = data.ddd_fax
            document.getElementById("email1").value = data.email

            document.getElementById("cidade").value = data.municipio

            document.getElementById("pais").value = data.pais




            function buscarCep(cep) {
                

                // Verifica se o CEP tem o formato correto
                if (cep.length !== 8) {
                    console.error('CEP inválido');
                    return;
                }

                // URL da API ViaCEP
                const url = `https://viacep.com.br/ws/${cep}/json/`;

                // Faz a requisição
                fetch(url)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Erro ao buscar o CEP');
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.erro) {
                            console.error('CEP não encontrado');
                        } else {

                            document.getElementById("cidade").value = data.localidade
                            document.getElementById("estado").value = data.uf
                            document.getElementById("logradouro").value = data.logradouro;
                            document.getElementById("endereco").value = data.logradouro;
                            document.getElementById("bairro").value = data.bairro;
                            document.getElementById("complemento").value = data.complemento;
                        }
                    })
                    .catch(error => {
                        console.error('Erro na requisição:', error);
                    });


            }
            buscarCep(cep)

            

        })
        .catch(error => {
            console.error('Erro:', error); 

        });




})

function limparString(input) {
    if (!input)
        return input;

    return input.replace(/[^0-9]/g, "");
}



function codigo() {
    let max = 1000;
    let numeroAleatorio = Math.floor(Math.random() * max);

    document.getElementById("codigo").value = numeroAleatorio;
}


cep.addEventListener("blur", () => {
    const cep = document.querySelector("#cep").value


    


    // Verifica se o CEP tem o formato correto
    if (cep.length !== 8) {
        console.error('CEP inválido');
        return;
    }

    // URL da API ViaCEP
    const url = `https://viacep.com.br/ws/${cep}/json/`;

    // Faz a requisição
    fetch(url)
        .then(response => {
            if (!response.ok) {
                throw new Error('Erro ao buscar o CEP');
            }
            return response.json();
        })
        .then(data => {
            if (data.erro) {
                console.error('CEP não encontrado');
            } else {


                document.getElementById("cidade").value = data.localidade
                document.getElementById("estado").value = data.uf
                document.getElementById("logradouro").value = data.logradouro;
                document.getElementById("endereco").value = data.logradouro;
                document.getElementById("bairro").value = data.bairro;
                document.getElementById("complemento").value = data.complemento;
            }
        })
        .catch(error => {
            console.error('Erro na requisição:', error);
        });
})












