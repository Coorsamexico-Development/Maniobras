<script setup>
import DataTable from '../../../Components/DataTable.vue';

var props = defineProps({
  maniobristas:Object
});
</script>
<template>
    <DataTable>
        <template #section-header>
            <slot name="section-header">
            </slot>
        </template>
        <template #table-header>
                <tr class="text-center text-md" >
                    <th scope="col" class="px-2 py-1 text-sm font-semibold tracking-wider uppercase cursor-pointer ">
                        <span>
                            Nombre 
                        </span>
                    </th>
                    <th>
                        #
                    </th>
                </tr>
            </template>
            <template #table-body>
                <tr  v-for="maniobrista in maniobristas" :key="maniobrista.id">
                  <td>{{maniobrista.name+' '+maniobrista.ap_paterno+' '+maniobrista.ap_materno}}</td>
                  <td>
                    
                  </td>
                </tr>
            </template>
    </DataTable>
</template>
