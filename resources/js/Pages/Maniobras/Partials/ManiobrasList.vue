<script setup>
import { Inertia } from "@inertiajs/inertia";
import { ref } from "vue";
import axios from "axios";
import ModalCalendar from "../Partials/ModalCalendar.vue";
import ModalTurno from "../Partials/ModalTurno.vue";
import ModalFalta from "../Partials/ModalFalta.vue";

const props = defineProps({
    maniobra: Object,
    maniobristas: Object,
    message: Boolean,
});

let maniobra_id = ref(-1);
maniobra_id.value = props.maniobra.maniobra_id;

let turnos = ref([]);

axios
    .get("turnosPorManiobra/" + maniobra_id.value, {
        maniobra_id: maniobra_id.value,
    }) //enviamos el dato a la ruta
    .then((resp) => {
        //console.log(resp);
        turnos.value = resp.data;
    })
    .catch(function (error) {
        console.log(error);
    });

let modalCalendar = ref(false);
let modalTurno = ref(false);
let modalFalta = ref(false);

const watchCalendar = () => {
    modalCalendar.value = true;
};

const closeCalendar = () => {
    modalCalendar.value = false;
};

const modalTurn = () => {
    modalTurno.value = true;
};

const closeModalTurn = () => {
    modalTurno.value = false;
};

const modalFalt = () => {
    modalFalta.value = true;
};

const closeModalFalt = () => {
    modalFalta.value = false;
};
</script>

<template>
    <div
        class="p-2 mt-6 bg-white shadow-md rounded-3xl"
        :class="message ? 'w-full' : 'lg:w-1/3'"
    >
        <div
            :class="
                message
                    ? 'grid grid-cols-3 grid-rows-1 gap-2 overflow-hidden wrapper lg:grid-cols-10 lg:grid-rows-1'
                    : 'grid grid-cols-3 grid-rows-1 gap-2 overflow-hidden wrapper lg:grid-cols-6 lg:grid-rows-1'
            "
        >
            <div class="p-4 pl-16 -ml-10 lg:-ml-0 md:p-4">
                {{ props.maniobra.cliente_name }}
            </div>
            <div
                :class="
                    message
                        ? 'col-span-2 row-start-1 p-4 lg:col-start-2 lg:col-span-3'
                        : 'col-span-2 row-start-1 p-4 lg:col-start-2 lg:col-span-4 ml-4'
                "
            >
                <strong>Nombre de maniobra:</strong>
                {{ props.maniobra.maniobra_name }}
            </div>

            <transition name="slide-fade">
                <div v-if="message">
                    <button
                        @click="modalTurn"
                        type="button"
                        class="p-1 px-5 my-2 ml-16 text-sm text-white bg-blue-800 tooltip btn btn-primary rounded-3xl hover:bg-blue-700 focus:outline-none focus:shadow-outline"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="26.839"
                            height="20.846"
                            viewBox="0 0 27.839 27.846"
                        >
                            <g
                                id="Grupo_7"
                                data-name="Grupo 7"
                                transform="translate(-1098.231 621.986)"
                            >
                                <path
                                    id="Trazado_16"
                                    data-name="Trazado 16"
                                    d="M1098.231-566.931a8.018,8.018,0,0,0,1.906,1.553,6.9,6.9,0,0,0,3.24.889c.607.014,1.214,0,1.821,0h.246a11.139,11.139,0,0,0,.163,1.235,3.6,3.6,0,0,0,3.339,2.761,17.836,17.836,0,0,0,2.742-.02,3.612,3.612,0,0,0,3.322-3.627c0-.107,0-.214,0-.349.639,0,1.254,0,1.868,0a6.983,6.983,0,0,0,2.5-.437,6.9,6.9,0,0,0,2.7-1.823c.047-.052.085-.112.174-.23v5.1a7.61,7.61,0,0,0-6.871,1.215,7.635,7.635,0,0,0-3.131,6.291h-.309c-4.2,0-8.409-.006-12.614.008a1.051,1.051,0,0,1-1.1-.606Z"
                                    transform="translate(0 -45.749)"
                                    fill="#fff"
                                />
                                <path
                                    id="Trazado_17"
                                    data-name="Trazado 17"
                                    d="M1151.079-552.132h6.2a1.985,1.985,0,0,1-1.637,2.322,13.69,13.69,0,0,1-1.679.049,7.907,7.907,0,0,1-1.111-.026A2.032,2.032,0,0,1,1151.079-552.132Z"
                                    transform="translate(-43.937 -58.092)"
                                    fill="#fff"
                                />
                                <path
                                    id="Trazado_18"
                                    data-name="Trazado 18"
                                    d="M1122.272-617.749c-.022-.656-.313-.967-.966-.967h-6.436c0-.313.007-.6,0-.887a2.424,2.424,0,0,0-2.365-2.369q-2.255-.029-4.512,0a2.389,2.389,0,0,0-2.313,2,12.316,12.316,0,0,0-.077,1.26h-.3c-1.993,0-3.987.011-5.98-.008a1.045,1.045,0,0,0-1.1.606v1.468a1.917,1.917,0,0,1,.052.208,5.292,5.292,0,0,0,5.174,4.572c4.53.016,9.061.028,13.591-.006a5.093,5.093,0,0,0,4.458-2.565A5.658,5.658,0,0,0,1122.272-617.749Zm-9.033-.976h-5.97a8.643,8.643,0,0,1,.007-.947.774.774,0,0,1,.773-.671q2.2-.011,4.4,0a.789.789,0,0,1,.785.751C1113.252-619.313,1113.239-619.033,1113.239-618.725Z"
                                    transform="translate(0 0)"
                                    fill="#fff"
                                />
                                <path
                                    id="Trazado_19"
                                    data-name="Trazado 19"
                                    d="M1196.227-528.836a6.093,6.093,0,0,0-5.007,5.511,6.062,6.062,0,0,0,3.882,6.146,14.711,14.711,0,0,0,1.649.424h1.088a1.447,1.447,0,0,1,.182-.047,6.079,6.079,0,0,0,5.321-5.356A6.083,6.083,0,0,0,1196.227-528.836Zm1.908,6.071a.788.788,0,0,1-.806.819c-.607.019-1.215.021-1.822,0a.8.8,0,0,1-.789-.834.805.805,0,0,1,.836-.786c.305-.007.612,0,.957,0,0-.549-.015-1.047,0-1.544a.8.8,0,0,1,1.142-.722.772.772,0,0,1,.477.732C1198.145-524.323,1198.149-523.544,1198.134-522.765Z"
                                    transform="translate(-77.309 -77.385)"
                                    fill="#fff"
                                />
                            </g>
                        </svg>
                    </button>
                </div>
            </transition>
            <transition name="slide-fade">
                <div v-if="message">
                    <button
                        @click="watchCalendar"
                        type="button"
                        class="p-1 px-5 my-2 ml-10 text-sm text-white bg-blue-800 rounded-3xl hover:bg-blue-700 focus:outline-none focus:shadow-outline"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="25.338"
                            height="20.846"
                            viewBox="0 0 25.338 23.836"
                        >
                            <g
                                id="Grupo_10"
                                data-name="Grupo 10"
                                transform="translate(-761.49 396.433)"
                            >
                                <path
                                    id="Trazado_20"
                                    data-name="Trazado 20"
                                    d="M786.824-363a3.859,3.859,0,0,0-.1-.9.634.634,0,0,0-.7-.529q-1.014,0-2.029,0c-.339,0-.414.081-.418.429-.005.47.008.941-.016,1.41a1.885,1.885,0,0,1-1.594,1.874,7.037,7.037,0,0,1-2.8-.05,1.934,1.934,0,0,1-1.435-1.809c-.022-.453-.014-.906-.021-1.36-.006-.39-.111-.494-.507-.494h-6.086c-.409,0-.489.087-.5.491a13.707,13.707,0,0,1-.08,1.724,1.774,1.774,0,0,1-1.789,1.539c-.732.026-1.468.045-2.2,0a1.758,1.758,0,0,1-1.782-1.859c-.019-.461-.008-.923-.013-1.385a.445.445,0,0,0-.5-.507q-1-.011-2,0a.639.639,0,0,0-.643.484c-.047.13-.076.266-.114.4V-343.9a2.579,2.579,0,0,0,1.293.24q11.529-.008,23.058,0a2.572,2.572,0,0,0,.346-.013c.536-.073.641-.194.641-.719Q786.828-353.7,786.824-363Zm-1.952,17.6a1.242,1.242,0,0,1-.544.111q-5.084.009-10.168,0H764.015c-.676,0-.92-.245-.92-.926q0-5.776,0-11.552c0-.686.251-.933.944-.933h20.238c.693,0,.944.247.944.933q0,5.789,0,11.577C785.224-345.863,785.183-345.555,784.872-345.4Z"
                                    transform="translate(0 -28.935)"
                                    fill="#fff"
                                />
                                <path
                                    id="Trazado_21"
                                    data-name="Trazado 21"
                                    d="M948.664-393.641c0,.635,0,1.269,0,1.9a.768.768,0,0,1-.867.867q-.668,0-1.335,0a.765.765,0,0,1-.857-.852q0-1.916,0-3.832a.774.774,0,0,1,.855-.861q.68-.007,1.36,0a.77.77,0,0,1,.844.846C948.666-394.927,948.664-394.284,948.664-393.641Z"
                                    transform="translate(-166.491 -0.011)"
                                    fill="#fff"
                                />
                                <path
                                    id="Trazado_22"
                                    data-name="Trazado 22"
                                    d="M813.218-393.661c0,.643,0,1.286,0,1.928a.758.758,0,0,1-.832.85c-.47.006-.94.006-1.409,0a.75.75,0,0,1-.816-.819q-.008-1.953,0-3.906a.76.76,0,0,1,.821-.819q.7-.012,1.409,0a.763.763,0,0,1,.826.838C813.221-394.947,813.218-394.3,813.218-393.661Z"
                                    transform="translate(-44.009)"
                                    fill="#fff"
                                />
                                <path
                                    id="Trazado_23"
                                    data-name="Trazado 23"
                                    d="M938.745-280.923c-.536,0-1.072,0-1.608,0a.714.714,0,0,1-.8-.795q-.006-1.051,0-2.1a.705.705,0,0,1,.781-.783q1.632-.009,3.265,0a.707.707,0,0,1,.784.806q0,1.039,0,2.077a.714.714,0,0,1-.793.8C939.833-280.921,939.289-280.923,938.745-280.923Z"
                                    transform="translate(-158.113 -101.121)"
                                    fill="#fff"
                                />
                                <path
                                    id="Trazado_24"
                                    data-name="Trazado 24"
                                    d="M871.022-280.927c-.544,0-1.088,0-1.632,0a.709.709,0,0,1-.788-.777q-.008-1.063,0-2.127a.7.7,0,0,1,.762-.776q1.657-.012,3.314,0a.691.691,0,0,1,.751.762q.009,1.076,0,2.151a.7.7,0,0,1-.774.766C872.11-280.924,871.566-280.927,871.022-280.927Z"
                                    transform="translate(-96.856 -101.117)"
                                    fill="#fff"
                                />
                                <path
                                    id="Trazado_25"
                                    data-name="Trazado 25"
                                    d="M802.5-280.923c-.528,0-1.055,0-1.583,0a.709.709,0,0,1-.813-.8q-.005-1.051,0-2.1a.694.694,0,0,1,.774-.783q1.632-.009,3.265,0a.7.7,0,0,1,.777.781q0,1.063,0,2.127a.7.7,0,0,1-.763.772C803.6-280.919,803.048-280.923,802.5-280.923Z"
                                    transform="translate(-34.912 -101.122)"
                                    fill="#fff"
                                />
                                <path
                                    id="Trazado_26"
                                    data-name="Trazado 26"
                                    d="M938.732-217.661c-.552,0-1.1,0-1.657,0a.69.69,0,0,1-.75-.735q-.014-1.1,0-2.2a.686.686,0,0,1,.75-.734q1.67-.005,3.34,0a.68.68,0,0,1,.736.722q.015,1.113,0,2.226a.684.684,0,0,1-.737.723C939.853-217.658,939.293-217.661,938.732-217.661Z"
                                    transform="translate(-158.095 -158.339)"
                                    fill="#fff"
                                />
                                <path
                                    id="Trazado_27"
                                    data-name="Trazado 27"
                                    d="M871-217.661c-.552,0-1.1,0-1.657,0a.688.688,0,0,1-.751-.733q-.014-1.1,0-2.2a.685.685,0,0,1,.747-.737q1.67-.006,3.339,0a.68.68,0,0,1,.738.719q.016,1.113,0,2.226a.688.688,0,0,1-.758.726C872.1-217.658,871.55-217.661,871-217.661Z"
                                    transform="translate(-96.842 -158.339)"
                                    fill="#fff"
                                />
                                <path
                                    id="Trazado_28"
                                    data-name="Trazado 28"
                                    d="M802.487-217.66c-.552,0-1.1,0-1.657,0a.68.68,0,0,1-.741-.737q-.01-1.1,0-2.2a.677.677,0,0,1,.744-.733q1.657-.006,3.314,0a.685.685,0,0,1,.756.749q.005,1.088,0,2.176a.688.688,0,0,1-.759.746C803.592-217.658,803.04-217.66,802.487-217.66Z"
                                    transform="translate(-34.9 -158.339)"
                                    fill="#fff"
                                />
                            </g>
                        </svg>
                    </button>
                </div>
            </transition>
            <transition name="slide-fade">
                <div v-if="message">
                    <button
                        @click="modalFalt"
                        type="button"
                        class="p-1 px-5 my-2 ml-3 text-sm text-white bg-orange-500 rounded-3xl hover:bg-orange-400 focus:outline-none focus:shadow-outline"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="25.568"
                            height="20.846"
                            viewBox="0 0 33.568 23.836"
                        >
                            <g
                                id="Grupo_12"
                                data-name="Grupo 12"
                                transform="translate(-1497.935 487.069)"
                            >
                                <path
                                    id="Trazado_29"
                                    data-name="Trazado 29"
                                    d="M1585.282-327.9c-1.7,0-3.392,0-5.088,0a3.556,3.556,0,0,1-3.468-2.329,3.531,3.531,0,0,1,.7-4.082,10.183,10.183,0,0,1,3.188-2.311.489.489,0,0,1,.569.046,7.1,7.1,0,0,0,8.232.014.526.526,0,0,1,.6-.059,10.018,10.018,0,0,1,3.169,2.28,3.628,3.628,0,0,1,.7,4.133,3.517,3.517,0,0,1-3.408,2.3c-1.733.026-3.467.006-5.2.006Z"
                                    transform="translate(-70.592 -135.344)"
                                    fill="#fff"
                                />
                                <path
                                    id="Trazado_30"
                                    data-name="Trazado 30"
                                    d="M1606.249-447.026a5.958,5.958,0,0,1,6.085-5.976,5.882,5.882,0,0,1,5.789,5.884,5.93,5.93,0,0,1-5.928,6A6.053,6.053,0,0,1,1606.249-447.026Z"
                                    transform="translate(-97.483 -30.661)"
                                    fill="#fff"
                                />
                                <path
                                    id="Trazado_31"
                                    data-name="Trazado 31"
                                    d="M1721.361-482.1a4.964,4.964,0,0,1-6.709,4.668.638.638,0,0,1-.493-.665,6.813,6.813,0,0,0-2.316-4.9.516.516,0,0,1-.164-.642,4.98,4.98,0,0,1,5.37-3.376A4.945,4.945,0,0,1,1721.361-482.1Z"
                                    transform="translate(-192.329)"
                                    fill="#fff"
                                />
                                <path
                                    id="Trazado_32"
                                    data-name="Trazado 32"
                                    d="M1522.707-481.914a4.957,4.957,0,0,1,4-4.916,5,5,0,0,1,5.638,3.218.648.648,0,0,1-.2.828,6.786,6.786,0,0,0-2.246,4.889.523.523,0,0,1-.381.544A4.942,4.942,0,0,1,1522.707-481.914Z"
                                    transform="translate(-22.295 -0.141)"
                                    fill="#fff"
                                />
                                <path
                                    id="Trazado_33"
                                    data-name="Trazado 33"
                                    d="M1507.708-388.531a7.4,7.4,0,0,0,1.652,3.342,2.441,2.441,0,0,1-.247.165,11.33,11.33,0,0,0-3.3,2.538.62.62,0,0,1-.407.179c-1.447.012-2.894.028-4.341,0a2.979,2.979,0,0,1-2.827-1.977,2.974,2.974,0,0,1,.532-3.374,7.671,7.671,0,0,1,2.332-1.786.486.486,0,0,1,.417.008,6.153,6.153,0,0,0,6.009.938A1.413,1.413,0,0,1,1507.708-388.531Z"
                                    transform="translate(0 -87.825)"
                                    fill="#fff"
                                />
                                <path
                                    id="Trazado_34"
                                    data-name="Trazado 34"
                                    d="M1719.473-385.4a7.354,7.354,0,0,0,1.643-3.33c.118.032.22.056.32.088a6.078,6.078,0,0,0,5.769-.939.467.467,0,0,1,.59-.046,8.122,8.122,0,0,1,2.332,1.849,2.972,2.972,0,0,1,.435,3.358,2.958,2.958,0,0,1-2.758,1.91c-1.459.031-2.919.012-4.378,0a.572.572,0,0,1-.388-.146,11.263,11.263,0,0,0-3.484-2.664C1719.533-385.329,1719.519-385.354,1719.473-385.4Z"
                                    transform="translate(-199.386 -87.622)"
                                    fill="#fff"
                                />
                            </g>
                        </svg>
                    </button>
                </div>
            </transition>
            <transition name="slide-fade">
                <div v-if="message">
                    <button
                        type="button"
                        class="p-1 px-4 my-2 ml-16 text-sm text-white bg-orange-500 lg:-ml-2 rounded-3xl hover:bg-orange-400 focus:outline-none focus:shadow-outline"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="27.74"
                            height="20.846"
                            viewBox="0 0 27.74 29.896"
                        >
                            <g
                                id="Grupo_15"
                                data-name="Grupo 15"
                                transform="translate(-2095.371 770.026)"
                            >
                                <path
                                    id="Trazado_35"
                                    data-name="Trazado 35"
                                    d="M2110.778-659.4a9.779,9.779,0,0,0-5.8,9.924c-.392,0-.811.024-1.226,0a22.09,22.09,0,0,1-8.2-2.353.36.36,0,0,1-.178-.265c.168-3.372,1.218-6.349,3.99-8.48a8.432,8.432,0,0,1,11.308,1.045C2110.706-659.491,2110.738-659.447,2110.778-659.4Z"
                                    transform="translate(0 -98.144)"
                                    fill="#fff"
                                />
                                <path
                                    id="Trazado_36"
                                    data-name="Trazado 36"
                                    d="M2153.389-770.026a4.274,4.274,0,0,1,4.263,4.268,4.277,4.277,0,0,1-4.293,4.273,4.277,4.277,0,0,1-4.246-4.286A4.272,4.272,0,0,1,2153.389-770.026Z"
                                    transform="translate(-48.953)"
                                    fill="#fff"
                                />
                                <g
                                    id="Grupo_14"
                                    data-name="Grupo 14"
                                    transform="translate(2106.032 -757.213)"
                                >
                                    <path
                                        id="Trazado_37"
                                        data-name="Trazado 37"
                                        d="M2304.66-475.952c0-.005-.005-.008,0,0Z"
                                        transform="translate(-2296.667 489.351)"
                                        fill="#fff"
                                    />
                                    <path
                                        id="Trazado_38"
                                        data-name="Trazado 38"
                                        d="M2223.579-626.255A8.553,8.553,0,0,0,2215-617.7a8.55,8.55,0,0,0,8.5,8.533,8.546,8.546,0,0,0,8.581-8.517A8.544,8.544,0,0,0,2223.579-626.255Zm3.152,9.177a2.341,2.341,0,0,1,.539,1.574c-.038,1.426-1.189,2.379-3.2,2.623,0,.314,0,.633,0,.952-.006.386-.221.627-.545.62s-.513-.241-.521-.61c-.007-.309-.008-.618-.012-.927a9.977,9.977,0,0,1-1.251-.269,2.687,2.687,0,0,1-1.91-2.114,1.5,1.5,0,0,1-.024-.365.518.518,0,0,1,.512-.512.512.512,0,0,1,.54.446,1.887,1.887,0,0,0,2.12,1.672v-3.175a3.313,3.313,0,0,1-2.691-1.258,2.314,2.314,0,0,1-.48-1.592c.073-1.113,1.067-2.45,3.2-2.522,0-.333-.006-.643,0-.952a.525.525,0,0,1,.543-.58.521.521,0,0,1,.521.57c.008.31,0,.62,0,.935a8.932,8.932,0,0,1,1.05.181,2.755,2.755,0,0,1,2.124,2.193,1.405,1.405,0,0,1,.022.365.52.52,0,0,1-.52.5.513.513,0,0,1-.533-.455,1.876,1.876,0,0,0-2.122-1.658v3.173A3.316,3.316,0,0,1,2226.731-617.078Z"
                                        transform="translate(-2214.996 626.255)"
                                        fill="#fff"
                                    />
                                </g>
                                <path
                                    id="Trazado_39"
                                    data-name="Trazado 39"
                                    d="M2282.871-572.347v3.2a2.129,2.129,0,0,1-1.881-.864,1.212,1.212,0,0,1-.024-1.437A2.118,2.118,0,0,1,2282.871-572.347Z"
                                    transform="translate(-168.851 -180.062)"
                                    fill="#fff"
                                />
                                <path
                                    id="Trazado_40"
                                    data-name="Trazado 40"
                                    d="M2317-521.22v-3.205a2.122,2.122,0,0,1,1.9.9,1.211,1.211,0,0,1,0,1.41A2.127,2.127,0,0,1,2317-521.22Z"
                                    transform="translate(-201.876 -223.714)"
                                    fill="#fff"
                                />
                            </g>
                        </svg>
                    </button>
                </div>
            </transition>
            <transition name="slide-fade">
                <div v-if="message">
                    <button
                        type="button"
                        class="p-1 px-5 my-2 ml-10 text-sm text-white bg-blue-800 lg:-ml-10 rounded-3xl hover:bg-blue-700 focus:outline-none focus:shadow-outline"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="25.887"
                            height="20.846"
                            viewBox="0 0 26.887 26.892"
                        >
                            <path
                                id="Trazado_41"
                                data-name="Trazado 41"
                                d="M3084.957-585.061a13.492,13.492,0,0,0-13.465,13.422,13.493,13.493,0,0,0,13.447,13.47,13.47,13.47,0,0,0,13.44-13.437A13.466,13.466,0,0,0,3084.957-585.061Zm5.788,15.47q-2.469,2.482-4.95,4.951a1.181,1.181,0,0,1-1.719-.006q-2.455-2.435-4.889-4.891a1.2,1.2,0,0,1,0-1.74,1.216,1.216,0,0,1,1.743.032c.841.83,1.674,1.667,2.507,2.5a2.275,2.275,0,0,1,.189.249l.088-.055v-.308q0-4.415,0-8.83a1.222,1.222,0,0,1,1.639-1.2,1.249,1.249,0,0,1,.809,1.255q0,2.572,0,5.144v4.015c.112-.1.184-.168.252-.236q1.283-1.283,2.567-2.566a1.173,1.173,0,0,1,1.26-.309,1.162,1.162,0,0,1,.824.97A1.124,1.124,0,0,1,3090.745-569.591Z"
                                transform="translate(-3071.492 585.061)"
                                fill="#fff"
                            />
                        </svg>
                    </button>
                </div>
            </transition>

            <div class="box">
                <button
                    @click="message = !message"
                    type="button"
                    :class="
                        message
                            ? 'p-1 px-6 my-2 ml-3.5 hidden text-md text-white text-md font-bold bg-green-600 lg:-ml-16 rounded-3xl hover:bg-green-500 focus:outline-none focus:shadow-outline'
                            : 'p-1 px-6 my-2 ml-8 mt-0 text-md text-white text-md font-bold bg-green-600 lg:-ml-3  lg:mt-5 rounded-3xl hover:bg-green-500 focus:outline-none focus:shadow-outline'
                    "
                >
                    <svg
                        version="1.1"
                        id="Layer_1"
                        xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink"
                        x="0px"
                        y="0px"
                        viewBox="0 0 512 512"
                        style="enable-background: new 0 0 512 512"
                        xml:space="preserve"
                        fill="currentcolor" 
                        height="24"
                        width="24"
                    >
                        <path
                            d="M489.834,385.299h-41.733V102.505c0-11.152-8.671-20.135-19.823-20.135h-43.851c-11.152,0-20.555,8.983-20.555,20.135
			v282.794h-62.063v-179.14c0-11.152-8.664-20.349-19.816-20.349h-43.849c-11.152,0-20.564,9.197-20.564,20.349v179.14h-62.063
			V276.281c0-11.152-8.656-19.543-19.809-19.543H91.858c-11.152,0-20.57,8.39-20.57,19.543v109.017H22.166
			C9.924,385.299,0,395.223,0,407.464s9.924,22.166,22.166,22.166h467.669c12.241,0,22.166-9.924,22.166-22.166
			S502.077,385.299,489.834,385.299z"
                        />
                    </svg>
                </button>
            </div>
        </div>
    </div>
    <!--MODALS -->
    <ModalCalendar
        :show="modalCalendar"
        :maniobristas="maniobristas"
        :turnos="turnos"
        @close="closeCalendar"
    ></ModalCalendar>
    <ModalTurno
        :show="modalTurno"
        @close="closeModalTurn"
        :turnos="turnos"
        :maniobra_id="maniobra_id"
    ></ModalTurno>
    <ModalFalta
        :show="modalFalta"
        @close="closeModalFalt"
        :faltas="faltas"
    ></ModalFalta>
</template>

<style>
.slide-fade-enter-active {
    transition: all 2.5s ease-out;
}

/*
.slide-fade-leave-active {
  transition: all 1s cubic-bezier(1, 0.2, 0.4, 1);
}*/

.slide-fade-enter-from,
.slide-fade-leave-to {
    transform: translateX(-30px);
    opacity: 0;
}

.bounce-enter-active {
    animation: bounce-in 0.5s;
}

@keyframes bounce-in {
    0% {
        transform: scale(0);
    }
    50% {
        transform: scale(1.5);
    }
    100% {
        transform: scale(1);
    }
}
</style>
