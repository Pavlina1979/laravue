<script setup lang="ts">
import TaskController from "@/actions/App/Http/Controllers/TaskController";
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
import { Badge } from '@/components/ui/badge'

defineProps({ ukoly: Object });
</script>

<template>
    <h1 class="text-3xl mb-5">Seznam úkolů</h1>
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

</template>
