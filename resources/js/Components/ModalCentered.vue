<template>
    <div>
        <div id='centeredFormModal' class="modal-wrapper">
            <div class="overlay close-modal"></div>
            <div class="modal modal-centered">
                <div class="modal-content shadow-lg p-5">
                        <div class="border-b p-2 pb-3 pt-0 mb-4">
                        <div class="flex justify-between items-center">
                            <!-- Modal title -->
                            <slot name="title"></slot>
                            <span class='close-modal cursor-pointer px-3 py-1 rounded-full bg-gray-100 hover:bg-gray-200'>
                                <i class="fas fa-times text-gray-700"></i>
                            </span>
                        </div>
                    </div>                    
                    <!-- Modal content -->
                    <slot name="content"></slot>
                </div>
            </div>
        </div>        
    </div>
</template>

<script>

export default {


}

</script>
