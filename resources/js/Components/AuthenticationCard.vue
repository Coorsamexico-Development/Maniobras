<template>
   
    <div class="flex flex-col items-center w-full h-full min-h-screen pt-6 bg-no-repeat bg-cover main sm:justify-center sm:pt-0">
        <div class="grid grid-cols-2 grid-rows-1 gap-2 sm">
            <div class="h-16 py-6 mx-8 mt-40 text-xs text-center text-white bg-blue-600 bg-opacity-50 font- -ml-14 box log sm:max-w-md sm:px-6 caja_texto">
                SOMOS SOLUCIONES LOGÍSTICAS
            </div>
            <div class="ml-28 box w-96 sm:max-w-md sm:mt-6 sm:px-6 sm:rounded-lg">
                <slot />
            </div>
        </div>
    </div>

</template>
