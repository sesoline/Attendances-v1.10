<template>
    <div>
        <userPanel>
            <template v-slot:Main>
                
                <div class="flex flex-row-reverse mb-6 md:flex md:items-center">   
                    <div class="px-2" >
                        <button class="bg-green-500 hover:bg-green-800 text-white font-bold py-2 px-4 rounded " type="button" 
                        onclick="window.location='/students'">
                            TEST-O2
                        </button>
                        <inertia-link :href="route('students.index')">
                            TESSST ME
                        </inertia-link>
                    </div>
                </div>

            </template>
        </userPanel>
    </div>
</template>

<script>


import { Link } from '@inertiajs/inertia-vue3'
import userPanel from '@/Layouts/userPanel.vue';

export default {
    components: {userPanel, Link},

    props: {
        
    },
    
}

//console.log(DBdata)

</script>