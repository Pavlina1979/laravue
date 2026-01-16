<script setup lang="ts">
import TaskController from "@/actions/App/Http/Controllers/TaskController";
import AuthController from "@/actions/App/Http/Controllers/AuthController";

import {
    Accordion,
    AccordionContent,
    AccordionItem,
    AccordionTrigger,
} from '@/components/ui/accordion';
import {
    DropdownMenu,
    DropdownMenuContent,
    DropdownMenuItem,
    DropdownMenuTrigger,
} from '@/components/ui/dropdown-menu';
import { Link } from '@inertiajs/vue3';
import { useDateFormat } from "@vueuse/core";
import { Badge } from '@/components/ui/badge';

defineProps({ ukoly: Object });
</script>

<template>
    <div class="flex justify-between items-center">
        <h1 class="text-3xl mb-5">Seznam úkolů pro {{ $page.props.auth.user.name }}</h1>
        <Link :href="AuthController.logout()" method="post">Odhlásit</Link>
    </div>
    <div v-if="$page.props.flash.success"
        class="mb-8 border border-green-300 bg-green-200 p-2 border-l-8 border-l-green-500">
        {{ $page.props.flash.success }}
    </div>
    <div class="flex items-center gap-3">
        <Link :href="TaskController.create()" class="rounded bg-blue-700 text-white px-2 py-1">Přidat úkol</Link>
        <DropdownMenu>
            <DropdownMenuTrigger>Filtrování dle statusu</DropdownMenuTrigger>
            <DropdownMenuContent>
                <DropdownMenuItem>
                    <Link :href="TaskController.index()">Všechny úkoly</Link>
                </DropdownMenuItem>
                <DropdownMenuItem>
                    <Link :href="TaskController.filtrHotove()">Hotové úkoly</Link>
                </DropdownMenuItem>
                <DropdownMenuItem>
                    <Link :href="TaskController.filtrNehotove()">Čekající úkoly</Link>
                </DropdownMenuItem>
            </DropdownMenuContent>
        </DropdownMenu>
    </div>

    <Accordion type="single" collapsible class="w-full" default-value="item-1">
        <AccordionItem :value="index" v-for="(ukol, index) in ukoly" :key="ukol.id">

            <AccordionTrigger class="py-6 cursor-pointer">

                <div class="flex items-center gap-2">
                    <h2 class="text-2xl">{{ ukol.nazev }}</h2>
                    <Badge v-show="ukol.dokonceno === 1" variant="secondary"
                        class="bg-blue-700 text-white dark:bg-blue-600">
                        <BadgeCheckIcon />
                        Hotovo
                    </Badge>

                    <Badge v-show="ukol.dokonceno !== 1" variant="destructive">
                        <BadgeCheckIcon />
                        Udělat!
                    </Badge>
                </div>

            </AccordionTrigger>
            <AccordionContent>
                <p>
                    {{ ukol.popis }}
                </p>
                <div class="mt-5 flex space-x-4 items-center">
                    <div v-if="ukol.dokonceno !== 1">
                        Hotovo do: {{ useDateFormat(ukol.dokdy, 'DD. MM. YYYY') }}
                    </div>
                    <div v-else>
                        hotovo
                    </div>
                    <!-- <div>Hotovo do: {{ ukol.dokdy }}</div> -->
                    <Link :href="TaskController.edit(ukol.id)" class="rounded bg-blue-700 text-white px-2 py-1">Upravit
                        úkol</Link>
                    <Link :href="TaskController.destroy(ukol.id)"
                        class="rounded bg-red-800 text-white px-2 py-1 cursor-pointer">Smazat
                        úkol</Link>
                </div>
            </AccordionContent>
        </AccordionItem>


    </Accordion>

    <p class="mt-8" v-if="ukoly.length === 0">Zatím nemáte naplánované žádné úkoly</p>

</template>
