<template>
    <div class="page-wrapper user-color">
        <slot name="header"></slot>
        <!-- Navbar top Start-->
        <div class="container-fluid user-bg-title">
            <div class="user-serchbox d-flex">
                <div class="user-title capi">
                    <h2>{{title}}</h2>

                </div>
                <div class="searchbox ml-auto">
                    <nav class="navbar user-nav d-flex nav-mr-top">
                        <a :href="route(link)" :active="route().current(link)" class="btn btn-primary btn-sm cls rg-top-btn"><i class="fa fa-angle-left"></i>Go Back</a>
                    </nav>
                </div>
            </div>
        </div>
        <!-- Navbar top End-->
        <!-- Navbar top End-->

        <nav aria-label="Page breadcrumb">
            <ol class="breadcrumb padding-top">
                <li class="breadcrumb-item" aria-current="page">Main</li>
                <li class="breadcrumb-item" aria-current="page">Categories</li>
                <li class="breadcrumb-item" aria-current="page">{{label}}</li>
                <li class="breadcrumb-item" aria-current="page" v-if="viewMode">{{this.data.name}}</li>


            </ol>
        </nav>
        <div class="register-form">
            <div class="col-lg-8 offset-lg-2 from-wrapper">
                <form>
                    <div class="row justify-content-center">

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Name <span class="text-red">*</span></label>
                                <input class="form-control" :class="viewMode==1? 'disabled' : ''" type="text" v-model="form.name" placeholder="Enter Category Name"/>
                                <div class="text-danger" v-if="errors.name">{{ errors.name }}</div>
                            </div>

                        </div>

                    </div>

                    <div class="m-t-20 text-center">
<!--                        create button start-->
                        <button style="margin-top: 40px; right: 18% !important;"
                                type="button" class="save_create"
                                wire:click.prevent="store()"
                                v-show="createMode"
                                @click="save_create(form)"

                        >Save & Create Another</button>
                        <button style="margin-top: 40px;"
                                type="button" class="save"
                                wire:click.prevent="store()"
                                v-show="createMode"
                                @click="save(form)"

                        >Save</button>
                        <!--create button end-->

                        <!--Edit button start-->
                        <button
                            type="button"
                            class="save"
                            wire:click.prevent="store()"
                            v-show="editMode"
                            @click="update(form)"
                        >
                            Update
                        </button>
                        <!--Edit button end-->
                        <button
                            type="button" class="save"
                            v-show="viewMode"
                            @click="Edit"
                        >Edit</button>

                    </div>
                </form>
            </div>
        </div>


    </div>
</template>

<script>
import Alert from "@/Pages/Component/Alert";
import Header from "@/Pages/Component/Header";


export default {
    components: {
          Alert,
          Header,

    },
    props: ['data','errors', 'createMode','viewMode', 'editMode', 'link', 'title', 'label'],
    data () {
        return {
            form: {
                index:'',
                id: undefined,
                name:null,
                age:null

            }
        }
    },
    created () {
        if(this.viewMode){
            this.form.name = this.data.name
        }
        if(this.editMode){
            this.form.name=this.data.name
        }
    },
    methods: {
        save(params){
            this.$inertia.post('/categories/store', params);
        },
        save_create(params){
            params['create_another'] = 1;
            this.$inertia.post('/categories/store', params);
            this.form ={}
        },
        Edit(){
            this.$inertia.get('/categories/'+this.data.id+'/edit');

        },
        update(params){
            this.$inertia.post('/categories/'+this.data.id+'/update', params);
        }


    }
}
</script>
<style>

</style>
