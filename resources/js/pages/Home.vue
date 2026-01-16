<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import AuthController from "@/actions/App/Http/Controllers/AuthController";

</script>

<template>
    <nav class="mb-8">
        <ul class="flex gap-4 items-center">
            <template v-if="$page.props.auth.user === null">
                <li>
                    <Link :href="AuthController.login()">Přihlásit</Link>
                </li>
                <li>
                    <Link :href="AuthController.create()">Registrovat</Link>
                </li>
            </template>
            <template v-else>
                <li>
                    <Link :href="AuthController.logout()" method="post">Odhlásit</Link>
                </li>
            </template>
        </ul>
    </nav>
    <div v-if="$page.props.flash.success"
        class="mb-8 border border-green-300 bg-green-200 p-2 border-l-8 border-l-green-500">
        {{ $page.props.flash.success }}
    </div>
    <h1 class="text-4xl">Plánovač úkolů</h1>
</template>
