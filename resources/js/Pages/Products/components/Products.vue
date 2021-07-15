<template>
    <div class="page-wrapper user-color" style="padding-bottom: 20px;">
        <!-- Navbar top Start-->
        <div class="container-fluid user-bg-title">
            <div class="user-serchbox d-flex">
                <div class="user-title capi">
                    <!--                     <h2 v-if="data.mode=='edit'">{{ data.Form_title}}</h2>-->
                    <!--                    <h2 v-if="data.step != 'one'">{{data.report.report_name}}</h2>-->
                    <!--                    <h2 v-else-if="data.mode == 'edit' ">{{data.report_name}}</h2>-->
                    <h2 >{{title}}</h2>

                </div>
                <div class="searchbox ml-auto">
                    <nav class="navbar user-nav d-flex nav-mr-top">
                        <a :href="route(link)" :active="route().current(link)" class="btn btn-primary btn-sm cls rg-top-btn"><i class="fa fa-angle-left"></i> Reports</a>
                    </nav>
                </div>
            </div>
        </div>
        <!-- Navbar top End-->

        <nav aria-label="Page breadcrumb">
            <ol class="breadcrumb padding-top">
                <li class="breadcrumb-item" aria-current="page">Main</li>
                <li class="breadcrumb-item"> {{label}} </li>
                <!--                <li v-if="data.edit != 'yes'" class="breadcrumb-item"> {{ title }}</li>-->
                <!--                <li v-if="data.edit == 'yes'" class="breadcrumb-item"> Update Report</li>-->
                <!--                <li v-if="data.mode == 'edit'" class="breadcrumb-item"> {{ data.report_name }}</li>-->
                <!--                &lt;!&ndash;                <li v-if="data.mode == 'edit'" class="breadcrumb-item"> {{ data.report_name }}</li>&ndash;&gt;-->
                <!--                <li v-if="data.step != 'one'" class="breadcrumb-item">step one</li>-->

            </ol>
        </nav>

        <div class="col-md-12">
            <button type="button" class="btn btn-color" v-if="data.step == 'one'">1 Product Information</button>
            <button type="button" class="btn btn-outline-secondary btn-inactive" v-if="data.step != 'one'">1 Product Information</button>
            <button type="button" class="btn btn-color"  v-if="data.step == 'two'">2 Product Images</button>
            <button type="button" class="btn btn-outline-secondary btn-inactive"  v-if="data.step != 'two'">2 Product Images</button>


            <div>
                <br/>
                <div v-if="data.step == 'one'">
                    <Step_one :data="data" :errors="errors" :title="title" :link="link" :label="label" ></Step_one>
                </div>
                <div v-if="data.step == 'two'">
                    <Step_two :data="data" :errors="errors" :title="title" :link="link" :label="label" ></Step_two>
                </div>

            </div>


        </div>

        <!--        </div>-->
    </div>
</template>

<script>
import Alert from '@/Pages/Component/Alert'
// import { Datetime } from 'vue-datetime';
import Step_one from './products/Step_one'
// import Step_two from './categories/Step_two'




export default {
    components: {
        Alert,
        Step_one,
        // Step_two,


    },
    props: ['data', 'errors', 'editMode', 'link', 'title', 'label'],
    data () {
        return {
        }
    },

    created () {
    },
    methods: {

    }
}
</script>
