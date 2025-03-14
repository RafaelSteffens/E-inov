<template>
  <div class="px-4 sm:px-6 lg:px-8">
    <div class="sm:flex sm:items-center">
      <div class="sm:flex-auto">
        <h1 class="text-xl font-semibold text-gray-900">Usuários</h1>
        <p class="mt-2 text-sm text-gray-700">Lista de usuários cadastrados no sistema.</p>
      </div>
      <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
        <button @click="openModal" type="button" class="inline-flex items-center justify-center rounded-md border border-transparent 
        bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 
        focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto">
          Novo usuário
        </button> 
      </div>
    </div>

    <div class="mt-8 flex flex-col">
      <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
          <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
            <table class="min-w-full divide-y divide-gray-300">
              <thead class="bg-gray-50">
                <tr>
                  <th class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Nome</th>
                  <th class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Empresa</th>
                  <th class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">E-mail</th>
                  <th class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Telefone</th>
                  <th class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Data de cadastro</th>
                  <th class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                    <span class="sr-only">Ações</span>
                  </th>
                </tr>
              </thead>
              <tbody class="divide-y divide-gray-200 bg-white">
                <tr v-for="user in users" :key="user.email">
                  <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">{{ user.name }}</td>
                  <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ user.company }}</td>
                  <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ user.email }}</td>
                  <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                    <div v-for="phone in user.phones" :key="phone.id">
                      {{ phone.number }}
                    </div>
                    <span v-if="user.phones.length === 0">Nenhum telefone cadastrado</span>
                  </td>
                  <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ user.created_at }}</td>
                  <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                    <a href="#" @click.prevent="editUser(user.id)" class="text-indigo-600 hover:text-indigo-900"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                      <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z"/>
                    </svg></a>
                    <br>
                    <a href="#" @click.prevent="trashUser(user.id)" class="text-indigo-600 hover:text-indigo-900"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                      <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                      <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                    </svg></a>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

  <!-- Modal -->
  <div v-if="isModalOpen" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50">
    <div class="bg-white p-6 rounded-lg shadow-lg w-96">
      <h2 class="text-lg font-semibold mb-4">{{ newUser.id ? 'Editar' : 'Novo' }} Usuário</h2>
      <form @submit.prevent="submitForm">
        <div class="mb-4">
          <label class="block text-sm font-medium text-gray-700">Nome</label>
          <input v-model="newUser.name" type="text" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
        </div>
        <div class="mb-4">
          <label class="block text-sm font-medium text-gray-700">Empresa</label>
          <input v-model="newUser.company" type="text" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
        </div>
        <div class="mb-4">
          <label class="block text-sm font-medium text-gray-700">E-mail</label>
          <input v-model="newUser.email" type="email" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
        </div>
        <div class="mb-4">
          <label class="block text-sm font-medium text-gray-700">Telefones</label>
          <div class="space-y-2">
            <div v-for="(phone, index) in newUser.phones" :key="index" class="flex gap-2 items-center">
              <input 
                v-model="newUser.phones[index]" 
                type="text" 
                required 
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                placeholder="Número de telefone"
              >
              <button 
                v-if="index > 0" 
                @click.prevent="removePhone(index)"
                type="button" 
                class="text-red-500 hover:text-red-700 text-lg"
                title="Remover telefone"
              >
                ×
              </button>
            </div>
            <button 
              @click.prevent="addPhone" 
              type="button" 
              class="text-sm text-indigo-600 hover:text-indigo-800 flex items-center gap-1"
            >
              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
              </svg>
              Adicionar telefone
            </button>
          </div>
        </div>

        <div class="mb-4">
          <label class="block text-sm font-medium text-gray-700">Senha</label>
          <input 
            v-model="newUser.password" 
            type="password" 
            :required="!newUser.id" 
            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
          >
          <p v-if="newUser.id" class="text-sm text-gray-500 mt-1">Deixe em branco para manter a senha atual.</p>
        </div>
        
        <div class="flex justify-end">
          <button @click="closeModal" type="button" class="mr-2 px-4 py-2 bg-gray-300 text-gray-700 rounded-md">Cancelar</button>
          <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">Salvar</button>
        </div>
      </form>
    </div>
  </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from "vue";

const users = ref([]);
const isModalOpen = ref(false);
const newUser = ref({
  name: "",
  email: "",
  phones: [""],
  company: "",
  password: ""
});

onMounted(() => {
  getUsers();
});

const getUsers = async () => {
  try {
    const response = await fetch("http://127.0.0.1:8000/api/users");
    users.value = await response.json();
  } catch (error) {
    console.error(error);
  }
};

const openModal = () => {
  isModalOpen.value = true;
};

const closeModal = () => {
  isModalOpen.value = false;
  newUser.value = {}
};

const addPhone = () => {
  newUser.value.phones.push("");
};

const removePhone = (index) => {
  newUser.value.phones.splice(index, 1);
};

const submitForm = async () => {
  try {
    const userData = {
      ...newUser.value,
      phone: newUser.value.phones.join(", "),
    };

    // Se estiver editando e a senha estiver vazia, remova-a do payload
    if (userData.id && !userData.password) {
      delete userData.password;
    }

    const url = userData.id
      ? `http://127.0.0.1:8000/api/user/edit/${userData.id}`
      : "http://127.0.0.1:8000/api/user";

    const response = await fetch(url, {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(userData),
    });

    if (!response.ok) {
      const errorData = await response.json();
      console.error("Erro ao salvar usuário:", errorData);
      return;
    }

    getUsers();
    alert("Usuário salvo com sucesso!");
    closeModal();
  } catch (error) {
    console.error("Erro na requisição:", error);
  }
};

const editUser = async (userId) => {
  try {
    const response = await fetch(`http://127.0.0.1:8000/api/user/${userId}`);
    const userData = await response.json();
    newUser.value = {
      id: userData.id,
      name: userData.name,
      company: userData.company,
      email: userData.email,
      phones: userData.phones.map(phone => phone.number), 
      password: "",
    };

    isModalOpen.value = true; 
  } catch (error) {
    console.error("Erro ao buscar usuário:", error);
  }
};

const trashUser = async (userId) => {
  if (!confirm('Tem certeza que deseja excluir este usuário?')) return;

  try {
    const response = await fetch(`http://127.0.0.1:8000/api/user/trash/${userId}`, {
      method: 'DELETE',
      headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json',
      },
      credentials: 'include' 
    });

    const data = await response.json(); 
    const userElement = document.getElementById(`user-${userId}`);
    if (userElement) userElement.remove();
    getUsers(); 
    alert(data.message); 
  } catch (error) {
    console.error("Erro:", error);
    alert(error.message || 'Erro ao excluir usuário');
  }
};

</script>