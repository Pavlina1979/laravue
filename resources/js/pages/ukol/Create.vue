<script setup lang="ts">
import { useForm } from '@inertiajs/vue3';
import { index } from "@/actions/App/Http/Controllers/TaskController";
import { Link } from '@inertiajs/vue3';

const form = useForm({
  nazev: '',
  popis: '',
  dokdy: '',
  dokonceno: ''
})
</script>

<template>
  <h1 class="text-3xl mb-5">Přidat úkol</h1>
  <form @submit.prevent="form.post('/')" class="space-y-2">
    <div>
      <label class="block font-medium text-gray-900 mb-2" for="nazev">Název</label>
      <div
        class="flex items-center rounded-md bg-white pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
        <input
          class="block min-w-0 grow bg-white py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6"
          type="text" id="nazev" v-model="form.nazev">
      </div>
      <div v-if="form.errors.nazev">{{ form.errors.nazev }}</div>
    </div>
    <div>
      <label class="block font-medium text-gray-900 mb-2" for="popis">Popis</label>
      <textarea
        class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
        id="popis" v-model="form.popis"></textarea>
      <div v-if="form.errors.popis">{{ form.errors.popis }}</div>
    </div>
    <div>
      <label class="block font-medium text-gray-900 mb-2" for="dokdy">Dokdy</label>
      <input
        class="block min-w-0 grow bg-white py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6"
        type="date" id="dokdy" v-model="form.dokdy">
      <div v-if="form.errors.dokdy">{{ form.errors.dokdy }}</div>
    </div>
    <div class="mb-5">
      <input type="checkbox" id="dokonceno" v-model="form.dokonceno"> Hotovo
      <label class="font-medium text-gray-900" for="dokonceno"></label>
    </div>
    <div class="flex space-x-3">
      <button type="submit" class="rounded bg-blue-700 text-white px-2 py-1" :disabled="form.processing">Přidat
        úkol</button>
      <Link :href="index()" class="rounded bg-blue-700 text-white px-2 py-1"><button>Zrušit</button></Link>
    </div>
  </form>
</template>