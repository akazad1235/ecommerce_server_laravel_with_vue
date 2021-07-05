<template>
    <div class="page-wrapper user-color">
        <slot name="header"></slot>
        <!-- Navbar top Start-->
        <div class="container-fluid user-bg-title">
            <div class="user-serchbox d-flex">
                <div class="user-title capi">
                    <h2 >dsfsdfsdf</h2>

                </div>
                <div class="searchbox ml-auto">
                    <nav class="navbar user-nav d-flex nav-mr-top">
                        <a class="btn btn-primary btn-sm cls rg-top-btn"><i class="fa fa-angle-left"></i> Mail Settings</a>
                    </nav>
                </div>
            </div>
        </div>
        <!-- Navbar top End-->
        <!-- Navbar top End-->

        <nav aria-label="Page breadcrumb">
            <ol class="breadcrumb padding-top">
                <li class="breadcrumb-item" aria-current="page">Main</li>
                <li class="breadcrumb-item" aria-current="page">Main</li>


            </ol>
        </nav>
        <div class="register-form">
            <div class="col-lg-8 offset-lg-2 from-wrapper">
                <form>
                    <div class="row justify-content-center">

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Name <span class="text-red">*</span></label>
                                <input class="form-control" type="text" v-model="form.name" placeholder="Enter Category Name"/>
                            </div>
                        </div>

                    </div>

                    <div class="m-t-20 text-center">
                        <!--create button start-->
<!--                        <button style="margin-top: 40px; right: 18% !important;"-->
<!--                                type="button" class="save_create"-->
<!--                                wire:click.prevent="store()"-->
<!--                                v-show="createMode"-->
<!--                                @click="save_create(form)"-->

<!--                        >Save & Create Another</button>-->
                        <button style="margin-top: 40px;"
                                type="button" class="save"
                                wire:click.prevent="store()"
                                v-show="createMode"
                                @click="save(form)"

                        >Save</button>
                        <!--create button end-->

                        <!--Edit button start-->
<!--                        <button-->
<!--                            type="button"-->
<!--                            class="save"-->
<!--                            wire:click.prevent="store()"-->
<!--                            v-show="editMode"-->
<!--                            @click="update(form)"-->
<!--                        >-->
<!--                            Update-->
<!--                        </button>-->
                        <!--Edit button end-->
<!--                        <button-->
<!--                            type="button" class="save"-->
<!--                            v-show="viewMode"-->
<!--                            @click="Edit"-->
<!--                        >Edit</button>-->

                    </div>
                </form>
            </div>
        </div>


    </div>
</template>

<script>



export default {
    components: {

    },

    props: ['data', 'errors','createMode','viewMode', 'editMode', 'link', 'title', 'label'],
    data () {
        return {
            myValue: '',
            myOptions:[{id: null, text: ''}],
            mailOptions:[
                {id: 'html', text: 'html'},
                {id: 'css', text: 'css'},
            ],
            photo: null,
            form: {
                index:'',
                id: undefined,
                name:null

            }
        }
    },
    created () {
        alert('ok');
    },
    methods: {
        save(params){

            this.$inertia.post('/categories/store', params);

        }
    }
}
</script>
