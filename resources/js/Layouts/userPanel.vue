<template lang="">
    <div>
        <!--Container -->
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,400i,600,600i,700,700i" rel="stylesheet">
        <div class="mx-auto bg-grey-400">
            <!--Screen-->
            <div class="min-h-screen flex flex-col">
                <!--Header Section Starts Here-->
                <header class="bg-nav">
                    <div class="flex justify-between">
                        <div class="p-1 mx-3 inline-flex items-center">
                            <i class="fas fa-bars pr-2 text-white" @click="sidebarToggle()"></i>
                            <h1 class="text-white p-2">Attendances</h1>
                        </div>
                        <div class="p-1 flex flex-row items-center">
                            <a href="https://github.com/sesoline" class="text-white p-2 mr-2 no-underline hidden md:block lg:block">Github</a>


                            <img @click="profileToggle()" class="inline-block h-8 w-8 rounded-full" src="https://avatars.githubusercontent.com/u/63259173?v=4" alt="">
                            <a href="#" @click="profileToggle()" class="text-white p-2 no-underline hidden md:block lg:block">Andres Munoz</a>
                            <div id="ProfileDropDown" class="rounded hidden shadow-md bg-white absolute pin-t mt-12 mr-1 pin-r">
                                <ul class="list-reset">
                                <li><a href="#" class="no-underline px-4 py-2 block text-black hover:bg-grey-light">My account</a></li>
                                <li><a href="#" class="no-underline px-4 py-2 block text-black hover:bg-grey-light">Notifications</a></li>
                                <li><hr class="border-t mx-2 border-grey-ligght"></li>
                                <li><a href="#" class="no-underline px-4 py-2 block text-black hover:bg-grey-light">Logout</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </header>
                <!--/Header-->

                <div class="flex flex-1">
                    <!--Sidebar-->
                    <aside id="sidebar" class="bg-side-nav md:w-1/6 lg:w-1/6 border-r border-side-nav hidden md:block lg:block">

                        <ul class="list-reset flex flex-col">
                            
                            <li class="w-full h-full py-3 px-2 border-b border-light-border">
                                <Link :href="route('recognition.index')" >
                                    <div class="font-sans font-hairline hover:font-normal text-sm text-nav-item no-underline">
                                        <i class="fab fa-uikit float-left mx-2"></i>
                                        Take Attendance
                                        <span><i class="fa fa-angle-right float-right"></i></span>
                                    </div>
                                </Link>
                            </li>
                            <li class="w-full h-full py-3 px-2 border-b border-light-border" >
                                <Link :href="route('attendances.index')" >
                                    <div class="font-sans font-hairline hover:font-normal text-sm text-nav-item no-underline">
                                        <i class="fab fa-wpforms float-left mx-2"></i>
                                        Attendances
                                        <span><i class="fa fa-angle-right float-right"></i></span>
                                    </div>
                                </Link>
                            </li>
                            <li class="w-full h-full py-3 px-2 border-b border-light-border" :class="selectedColor">
                                <Link :href="route('students.index')">
                                    <div class="font-sans font-hairline hover:font-normal text-sm text-nav-item no-underline" >
                                        <i class="fas fa-table float-left mx-2"></i>
                                        Students
                                        <span><i class="fa fa-angle-right float-right"></i></span>
                                    </div>
                                </Link>
                            </li>
                            <li class="w-full h-full py-3 px-2 border-b border-light-border">
                                <Link :href="route('classrooms.index')">
                                    <div class="font-sans font-hairline hover:font-normal text-sm text-nav-item no-underline" >
                                        <i class="fab fa-wpforms float-left mx-2"></i>
                                        Classrooms
                                        <span><i class="fa fa-angle-right float-right"></i></span>
                                    </div>
                                </Link>
                            </li>                            
                        </ul>

                    </aside>
                    <!--/Sidebar-->
                    
                <!--Main-->
                    <slot name="Main"></slot>    
                <!--/Main-->

                </div>
                
                <!--Footer-->
                <footer class="bg-grey-darkest text-white p-2">
                    <div class="flex flex-1 mx-auto">&copy; Attendances </div>
                    <div class="flex flex-1 mx-auto">by:   <a href="https://github.com/sesoline" target=" _blank">&nbsp sergio.andres@msn.com</a></div>
                </footer>
                <!--/footer-->

            </div>

        </div>
        <!-- <script src="./main.js"></script>         -->
                
    </div>
</template>
<script>




import studentForm from '@/Components/v-StudentForm.vue';
import { Link } from '@inertiajs/inertia-vue3';
//import * as mainJS from '@/main.js';


export default {
    components: {studentForm,Link},
    

    data() {
        return {
            sidebar: document.getElementById('sidebar'),
            profileDropdown: document.getElementById('ProfileDropDown'),            
        }
    },

    computed: {
        selectedColor() {
            if (window.location.pathname == '/students') {
                return 'bg-white'
            } else {
                return ''
            }
        }
    
    },

    methods: {
        sidebarToggle() {
            if (sidebar.style.display === "none") {
                sidebar.style.display = "block";
            } else {
                sidebar.style.display = "none";
            }
        },

        profileToggle() {
            if (profileDropdown.style.display === "none") {
                profileDropdown.style.display = "block";
            } else {
                profileDropdown.style.display = "none";
            }
        },

        toggleModal(action, elem_trigger)
        {            
            elem_trigger.addEventListener('click', function () {
                if (action == 'add') {
                    let modal_id = this.dataset.modal;
                    document.getElementById(`${modal_id}`).classList.add('modal-is-open');
                } else {
                    // Automaticlly get the opened modal ID
                    let modal_id = elem_trigger.closest('.modal-wrapper').getAttribute('id');
                    document.getElementById(`${modal_id}`).classList.remove('modal-is-open');
                }                
            });
        },
    },

    mounted() {
        // Check if there is modals on the page
        if (document.querySelector('.modal-wrapper'))
        {
            // Open the modal
            document.querySelectorAll('.modal-trigger').forEach(btn => {
                this.toggleModal('add', btn);
            });
            
            // close the modal
            document.querySelectorAll('.close-modal').forEach(btn => {
                this.toggleModal('remove', btn);
            });
        }   
    },

    updated() {
        
        // Check if there is modals on the page
        if (document.querySelector('.modal-wrapper'))
        {
            // Open the modal
            document.querySelectorAll('.modal-trigger').forEach(btn => {
                this.toggleModal('add', btn);
            });
            
            // close the modal
            document.querySelectorAll('.close-modal').forEach(btn => {
                this.toggleModal('remove', btn);
            });
        } 
        
    },
  
}

</script>

<style lang="">
    
</style>