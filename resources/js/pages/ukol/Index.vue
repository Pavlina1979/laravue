<script setup lang="ts">
import { index, create, edit, filtrHotove, filtrNehotove, destroy } from "@/actions/App/Http/Controllers/TaskController";
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
  DropdownMenuLabel,
  DropdownMenuSeparator,
  DropdownMenuTrigger,
} from '@/components/ui/dropdown-menu';
import { Link } from '@inertiajs/vue3';
import { useDateFormat } from "@vueuse/core";

defineProps({ ukoly: Object });
</script>

<template>
  <h1 class="text-3xl mb-5">Seznam úkolů</h1>
  <div class="flex items-center gap-3">
    <Link :href="create()" class="rounded bg-blue-700 text-white px-2 py-1"><button>Přidat úkol</button></Link>
    <DropdownMenu>
      <DropdownMenuTrigger>Filtrování dle statusu</DropdownMenuTrigger>
      <DropdownMenuContent>
        <DropdownMenuItem>
          <Link :href="index()">Všechny úkoly</Link>
        </DropdownMenuItem>
        <DropdownMenuItem>
          <Link :href="filtrHotove()">Hotové úkoly</Link>
        </DropdownMenuItem>
        <DropdownMenuItem>
          <Link :href="filtrNehotove()">Čekající úkoly</Link>
        </DropdownMenuItem>
      </DropdownMenuContent>
    </DropdownMenu>
  </div>

  <Accordion type="single" collapsible class="w-full" default-value="item-1">
    <AccordionItem :value="index" v-for="(ukol, index) in ukoly" :key="ukol.id">

      <AccordionTrigger class="py-5">{{ ukol.nazev }}</AccordionTrigger>
      <AccordionContent>
        <p>
          {{ ukol.popis }}
        </p>
        <p class="mt-5 flex space-x-4 items-center">
        <div v-if="ukol.dokonceno !== 1">
          Hotovo do: {{ useDateFormat(ukol.dokdy, 'DD. MM. YYYY') }}
        </div>
        <div v-else>
          hotovo
        </div>
        <!-- <div>Hotovo do: {{ ukol.dokdy }}</div> -->
        <Link :href="edit(ukol.id)" class="rounded bg-blue-700 text-white px-2 py-1"><button>Upravit úkol</button>
        </Link>
        <Link :href="destroy(ukol.id)" class="rounded bg-red-800 text-white px-2 py-1"><button>Smazat úkol</button>
        </Link>
        </p>
      </AccordionContent>
    </AccordionItem>


  </Accordion>


  <!-- <Accordion type="single" collapsible class="w-full" default-value="item-1">
    <AccordionItem value="item-1">
      <AccordionTrigger>Product Information</AccordionTrigger>
      <AccordionContent>
        <p>
          Our flagship product combines cutting-edge technology with sleek
          design. Built with premium materials, it offers unparalleled
          performance and reliability.
        </p>
        <p class="mt-2">
          Key features include advanced processing capabilities, and an
          intuitive user interface designed for both beginners and experts.
        </p>
      </AccordionContent>
    </AccordionItem>
    <AccordionItem value="item-2">
      <AccordionTrigger>Shipping Details</AccordionTrigger>
      <AccordionContent>
        <p>
          We offer worldwide shipping through trusted courier partners.
          Standard delivery takes 3-5 business days, while express shipping
          ensures delivery within 1-2 business days.
        </p>
        <p class="mt-2">
          All orders are carefully packaged and fully insured. Track your
          shipment in real-time through our dedicated tracking portal.
        </p>
      </AccordionContent>
    </AccordionItem>
    <AccordionItem value="item-3">
      <AccordionTrigger>Return Policy</AccordionTrigger>
      <AccordionContent>
        <p>
          We stand behind our products with a comprehensive 30-day return
          policy. If you're not completely satisfied, simply return the
          item in its original condition.
        </p>
        <p class="mt-2">
          Our hassle-free return process includes free return shipping and
          full refunds processed within 48 hours of receiving the returned
          item.
        </p>
      </AccordionContent>
    </AccordionItem>
  </Accordion> -->


</template>