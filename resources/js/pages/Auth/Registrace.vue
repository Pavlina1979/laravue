<script setup lang="ts">
import { useForm } from '@inertiajs/vue3';
import AuthController from "@/actions/App/Http/Controllers/AuthController";

const form = useForm({
    name: '',
    email: '',
    password: ''
})
</script>

<template>
    <h1 class="text-4xl mb-8">Vytvoř si účet</h1>

    <form @submit.prevent="form.submit(AuthController.store())" method="POST">
        <div class="mb-6">
            <label class="block mb-2" for="name">Jméno</label>
            <input class="border border-gray-400 block" type="text" id="name" name="name" placeholder="Jméno"
                v-model="form.name">
            <div v-if="form.errors.email">{{ form.errors.email }}</div>
        </div>
        <div class="mb-6">
            <label class="block mb-2" for="email">Email</label>
            <input class="border border-gray-400 block" type="text" id="email" name="email" placeholder="Email"
                v-model="form.email">
            <div v-if="form.errors.email">{{ form.errors.email }}</div>
        </div>
        <div class="mb-6">
            <label class="block mb-2" for="password">Heslo</label>
            <input class="border border-gray-400 block" type="password" id="password" name="password"
                placeholder="Heslo" v-model="form.password">
            <div v-if="form.errors.password">{{ form.errors.password }}</div>
        </div>
        <button type="submit" :disabled="form.processing">Přihlásit se</button>
    </form>
</template>
