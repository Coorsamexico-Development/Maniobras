<template>
   
    <div class="flex flex-col items-center w-full h-full min-h-screen pt-6 bg-no-repeat bg-cover main sm:justify-center sm:pt-0">
        <div class="grid grid-cols-1 grid-rows-1 gap-2 sm:grid-cols-2 sm">
            
            <div class="h-16 py-6 pl-5 mt-1 -ml-4 text-xs text-center text-white bg-blue-600 bg-opacity-50 sm:mt-56 lg:py-6 lg:mx-8 lg:mt-40 lg:-ml-14 box log lg:max-w-md lg:px-6 caja_texto ">
                SOMOS SOLUCIONES LOGÍSTICAS
            </div>
            
            <div class="pl-20 mt-32 box lg:ml-28 lg:w-96 lg:max-w-md lg:mt-6 lg:px-6 lg:rounded-lg">
                <slot />
            </div>
        </div>
    </div>

</template>
