<script setup lang="ts">
import { useForm } from '@inertiajs/vue3';
import TaskController from "@/actions/App/Http/Controllers/TaskController";
import { Link } from '@inertiajs/vue3';

interface Ukol {
    id: number,
    nazev: string,
    popis: string,
    dokdy: Date,
    dokonceno: boolean
}

const props = defineProps<{ ukol: Ukol }>();

const form = useForm({
    nazev: props.ukol.nazev,
    popis: props.ukol.popis,
    dokdy: props.ukol.dokdy,
    dokonceno: props.ukol.dokonceno,
})
const submit = () => {
    //console.log(form);
    form.submit(TaskController.update(props.ukol.id))
}
</script>

<template>
    <h1 class="text-3xl mb-5">Upravit úkol '{{ props.ukol.nazev }}'</h1>
    <form @submit.prevent="submit" class="space-y-2 block">
        <div class="mb-5">
            <label for="nazev" class="block font-medium text-gray-900 mb-2">Název</label>
            <div
                class="flex items-center rounded-md bg-white pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">

                <input id="nazev" type="text" name="nazev"
                    class="block min-w-0 grow bg-white py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6"
                    v-model="form.nazev">
            </div>
            <div v-if="form.errors.nazev">{{ form.errors.nazev }}</div>
        </div>
        <div class="mb-5">
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
            <input type="checkbox" id="dokonceno" true-value="1" false-value="0" v-model="form.dokonceno"> Hotovo
            <label class="block font-medium text-gray-900" for="dokonceno"></label>
        </div>
        <div class="flex space-x-3">
            <button type="submit" class="rounded bg-blue-700 text-white px-2 py-1">Upravit úkol</button>
            <Link :href="TaskController.index()" class="rounded bg-blue-700 text-white px-2 py-1">
                <button>Zrušit</button>
            </Link>
        </div>
    </form>

</template>
