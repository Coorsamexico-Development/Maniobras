<script setup>
import { watchEffect } from "vue";
import { useForm } from "@inertiajs/inertia-vue3";
import DialogModal from "@/Components/DialogModal.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import SelectComponent from "@/Components/SelectComponent.vue";
import ButtonClose from "@/Components/ButtonClose.vue";
import ButtonSave from "@/Components/ButtonSave.vue";
import { Inertia } from "@inertiajs/inertia";


var props = defineProps({
    maniobra_id: Number,
    show: {
        show: Boolean,
        required: true,
    }
});

const formTurno = useForm({
    name: "",
    cant_personal: '0',
    maniobra_id: props.maniobra_id,
    hora_inicio: "",
    hora_fin: "",
});

const enviarFormTurno = () => {
    formTurno.post(route("turnos.store"), {
        onSuccess: () => close(),
        only: ['maniobras', 'errors'],
        onFinish: () => formTurno.reset(),
    });
};

const emit = defineEmits(["close"]);

const close = () => {
    emit("close");
};
watchEffect(() => {
    if (props.show) {
        formTurno.maniobra_id = props.maniobra_id;
    }
})


</script>
<template>
    <DialogModal :show="show" @close="close()">
        <template #title>
            <h2 class="p-3 pl-6 -mx-6 text-xl font-bold text-blue-900">Nuevo Turno</h2>
        </template>
        <template #content>
            <form class="w-full">
                <div class="flex flex-wrap mb-6 -mx-3 mr-15">
                    <div class="w-full px-3 mb-6 md:w-1/2 md:mb-0">
                        <InputLabel class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase ">Nombre
                            del turno</InputLabel>
                        <TextInput required v-model="formTurno.name"
                            class="block w-full px-4 py-3 mb-3 leading-tight text-gray-500 bg-gray-100 border rounded appearance-none focus:outline-none focus:bg-white">
                        </TextInput>
                    </div>
                    <div class="w-full px-3 md:w-1/2">
                        <InputLabel class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase ">Cantidad
                            de personal</InputLabel>
                        <TextInput required v-model="formTurno.cant_personal" type="number"
                            class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-100 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500">
                        </TextInput>
                    </div>
                </div>
                <div class="flex flex-wrap mb-2 -mx-3">
                    <div class="w-full px-3 mb-6 md:w-1/2 md:mb-0">
                        <InputLabel class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase ">Hora
                            Inicio</InputLabel>
                        <TextInput type="time" required v-model="formTurno.hora_inicio"
                            class="block w-full px-4 py-3 mb-3 leading-tight text-gray-500 bg-gray-100 border rounded appearance-none focus:outline-none focus:bg-white">
                        </TextInput>
                    </div>
                    <div class="w-full px-3 mb-6 md:w-1/2 md:mb-0">
                        <InputLabel class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase ">Hora Fin
                        </InputLabel>
                        <TextInput type="time" required v-model="formTurno.hora_fin"
                            class="block w-full px-4 py-3 mb-3 leading-tight text-gray-500 bg-gray-100 border rounded appearance-none focus:outline-none focus:bg-white">
                        </TextInput>

                    </div>
                </div>
            </form>

            <div class="float-right m-4 mt-8 -mr-1">
                <ButtonSave @click="enviarFormTurno()"> Guardar </ButtonSave>
            </div>
        </template>
        <template #footer>
            <ButtonClose @click="close()" style="float: right" class="-mr-3 ">
                Cerrar
            </ButtonClose>
        </template>
    </DialogModal>
</template>
