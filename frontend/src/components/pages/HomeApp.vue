<template>
 
  <div class="px-4 sm:px-6 lg:px-8">
    <div class="sm:flex sm:items-center">
      <div class="sm:flex-auto">
        <h1 class="text-xl font-semibold text-gray-900">Home</h1>
        <p class="mt-2 text-sm text-gray-700">Desafio Vue.js.</p>
      </div>
     
    </div>
    <div class="mt-8 flex flex-col">
      <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
          
          <div class="space-y-4 mb-4 px-4 sm:px-0">
            <p>1) Será enviado um simples desafio em um projeto com vue.js 3 que deve ser entregue versionado em git no prazo solicitado na vaga.</p>
            <p>2) Será realizada uma avaliação da entrega e será marcada uma entrevista.</p>
            <p>3) Após entrevista o candidato(a), será avaliado perante os demais e este será contratado(a) ou ficará no banco de vagas.</p>
            <p>Se você é comprometido(a) com resultados e programar é algo que te faz perder a noção do tempo.... essa é a sua vaga. 😁🤗</p>
          </div>
          
          <div class="max-w-5xl mx-auto">
            <div class="px-4 sm:px-0">
              <p class="mt-2 mb-0 text-3xl font-extrabold text-gray-900">Desafio Frontend</p>
              <p class="mt-2 mb-5 text-md text-gray-900">Implemente melhorias nesta aplicação. Seja criativo! 
                Uma boa usabilidade é sempre bem-vinda.
              </p>
            </div>
            <div class="bg-white px-4 py-6 shadow sm:rounded-lg sm:px-6">
                <div class="sm:flex sm:justify-between sm:items-baseline">
                    <h3 class="text-base font-medium">
                      <span class="text-gray-900">1) CRUD</span>
                    </h3>
                    <p class="mt-1 text-sm text-gray-600 whitespace-nowrap sm:mt-0 sm:ml-3">
                      <time datetime="2021-01-28T19:24">     </time>
                    </p>
                  </div>
                  <div class="mt-4 space-y-6 text-sm text-gray-800">
                    <p>Na página <router-link :to="{name: 'users'}" class="text-blue-600 underline">Usuários</router-link> termine o CRUD. Faça um 
                    formulário de cadastro/edição, e opção para excluir usuário. Integre os dados de usuários com o
                        <a href="https://bitbucket.org/einov/desafiofullstackback" target="_blank" class="text-blue-600 underline">backend</a>. <br>
                    A listagem de usuários está pronta, mas é necessário inicializar o projeto.</p>
                  </div>
            </div>
            <div class="bg-white px-4 py-6 shadow sm:rounded-lg sm:px-6 mt-4">
                <div class="sm:flex sm:justify-between sm:items-baseline">
                    <h3 class="text-base font-medium">
                      <span class="text-gray-900">2) Campo adicional em usuários</span>
                    </h3>
                    <p class="mt-1 text-sm text-gray-600 whitespace-nowrap sm:mt-0 sm:ml-3">
                      <time datetime="2021-01-28T19:24">     </time>
                    </p>
                  </div>
                  <div class="mt-4 space-y-6 text-sm text-gray-800">
                    <p>Na página <router-link :to="{name: 'users'}" class="text-blue-600 underline">Usuários</router-link> adicione 
                    telefone ao usuário. Permita que um usuário possa ter vários números de telefones. Verifique o
                        <a href="https://bitbucket.org/einov/desafiofullstackback" target="_blank" class="text-blue-600 underline">backend</a>, caso necessário.</p>
                  </div>
            </div>
          </div>

            <div class="space-y-4 mb-4 px-4 sm:px-0 mt-4">
                <p>➡️ <a href="https://bitbucket.org/einov/desafiofullstackback" target="_blank" class="text-blue-600 underline">Backend da aplicação</a>.</p>
            </div>
          

        </div>
      </div>
    </div>
  </div>
  
</template>


<script>


export default {
  name: 'HomeApp',
  components: {
  }
}

</script>