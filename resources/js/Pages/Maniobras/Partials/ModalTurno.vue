<script setup>
import { ref } from "vue";
import DialogModal from "@/Components/DialogModal.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import ButtonClose from "@/Components/ButtonClose.vue";
import DataTable from "@/Components/DataTable.vue";
import { useForm } from "@inertiajs/inertia-vue3";
import "v-calendar/dist/style.css";
import { SetupCalendar, Calendar, DatePicker } from "v-calendar";
import ButtonAdd from "@/Components/ButtonAdd.vue";
import ModalAddTurno from "../Partials/ModalAddTurno.vue";
import { Inertia } from "@inertiajs/inertia";

var props = defineProps({
    turnos: Object,
    maniobra_id: Number,
});

const emit = defineEmits(["close"]);

const close = () => {
    emit("close");
};

/*Modal*/
const openModalNewTurno = ref(false);

const nuevoTurno = () => {
    openModalNewTurno.value = true;
};

const closeModalNewTurno = () => {
    openModalNewTurno.value = false;
};

</script>
<template>
    <DialogModal :show="show" @close="close()">
        <template #title>
            <h2 class="p-3 pl-6 -mx-6 -mb-8 text-xl font-bold text-blue-900">
                Turnos
            </h2>
            <ButtonAdd
                class="px-1 py-1"
                @click="nuevoTurno"
                style="float: right"
            >
                <svg
                    viewBox="0 0 20 20"
                    enable-background="new 0 0 20 20"
                    class="inline-block w-6 h-6"
                >
                    <path
                        fill="#FFFFFF"
                        d="M16,10c0,0.553-0.048,1-0.601,1H11v4.399C11,15.951,10.553,16,10,16c-0.553,0-1-0.049-1-0.601V11H4.601
                                    C4.049,11,4,10.553,4,10c0-0.553,0.049-1,0.601-1H9V4.601C9,4.048,9.447,4,10,4c0.553,0,1,0.048,1,0.601V9h4.399
                                    C15.952,9,16,9.447,16,10z"
                    />
                </svg>
            </ButtonAdd>
        </template>
        <template #content>
            <DataTable>
                <template #section-header>
                    <slot name="section-header"> </slot>
                </template>
                <template #table-header>
                    <tr class="text-center text-md">
                        <th
                            scope="col"
                            class="px-5 py-3 -mt-4 text-xs font-semibold tracking-wider text-center text-gray-600 uppercase bg-gray-100 border-b-2 border-gray-200"
                        >
                            <span> Turno </span>
                        </th>
                        <th
                            class="px-5 py-3 text-xs font-semibold tracking-wider text-center text-gray-600 uppercase bg-gray-100 border-b-2 border-gray-200"
                        >
                            Hora Inicio
                        </th>
                        <th
                            class="px-5 py-3 text-xs font-semibold tracking-wider text-center text-gray-600 uppercase bg-gray-100 border-b-2 border-gray-200"
                        >
                            Hora Final
                        </th>
                    </tr>
                </template>
                <template #table-body>
                    <tr
                        v-for="turno in turnos"
                        :key="turno.id"
                        class="px-5 py-5 text-sm bg-white border-b border-gray-400 hover:bg-gray-200"
                    >
                        <td>{{ turno.name }}</td>
                        <td>{{ turno.hora_inicio }}</td>
                        <td>{{ turno.hora_fin }}</td>
                    </tr>
                </template>
            </DataTable>

            <ModalAddTurno :clientes="clientes" :maniobra_id="maniobra_id" :status_maniobras="status_maniobras" :show="openModalNewTurno" @close="closeModalNewTurno"></ModalAddTurno>

        </template>
        <template #footer>
            <ButtonClose @click="close()" style="float: right">Cerrar </ButtonClose>
        </template>

    </DialogModal>

</template>

