<template>
    <div class="page-wrapper user-color">
        <slot name="header"></slot>
        <!-- Navbar top Start-->
        <div class="container-fluid user-bg-title">
            <div class="user-serchbox d-flex">
                <div class="user-title capi">
                    <h2 v-if="createMode">{{ title }}</h2>
                    
                </div>
                <div class="searchbox ml-auto">
                    <nav class="navbar user-nav d-flex nav-mr-top">
                        <a :href="route(link)" :active="route().current(link)" class="btn btn-primary btn-sm cls rg-top-btn"><i class="fa fa-angle-left"></i> Mail Settings</a>
                    </nav>
                </div>
            </div>
        </div>
        <!-- Navbar top End-->

        <nav aria-label="Page breadcrumb">
            <ol class="breadcrumb padding-top">
                <li class="breadcrumb-item" aria-current="page">Main</li>
                <li class="breadcrumb-item">{{label}}</li>
                <li v-if="createMode" class="breadcrumb-item">Mail Settings</li>
                <li v-if="createMode" class="breadcrumb-item"> {{title}}</li>
                <li v-else class="breadcrumb-item"> {{data.name}}</li>
            </ol>
        </nav>

        <div class="register-form">
            <div class="col-lg-12  from-wrapper">
                    
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
                protocol:null,
                type:null,
                host:null,
                port:null,
                email:null,
                password:null,
                organization_id: null,
            }
        }
    },
    created () {
      alert('come in')

    },
    methods: {
       

    }
}
</script>
