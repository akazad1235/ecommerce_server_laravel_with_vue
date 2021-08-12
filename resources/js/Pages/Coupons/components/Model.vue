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
                    <div :class="viewMode? 'column':'row justify-content-center' ">

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Amount Type <span class="text-red">*</span></label>
                                <select class="form-control">
                                    <option value="parcentage">Parcentage</option>
                                    <option value="parcentage">amount</option>
                                </select>
                                <div class="text-danger" v-if="errors.name">{{ errors.name }}</div>
                            </div>
                            <div class="form-group">
                                <label>Brand permission</label>
                                <multiselect v-model="selectBrands" :options="brandOptions" mode="tags"
                                             :searchable="true"
                                             placeholder="Select brand"
                                             noResultsText="No results found"
                                             label="label"
                                             noOptionsText="The list is empty"
                                             trackBy="value"
                                             >
                                </multiselect>
                            </div>
                            <div class="form-group">
                                <label>Categories permission</label>
                                <multiselect v-model="selectCategories" :options="categoriesOptions" mode="tags"
                                             :searchable="true"
                                             placeholder="Select Categories"
                                             noResultsText="No results found"
                                             noOptionsText="The list is empty"

                                >
                                </multiselect>
                            </div>
                            <div class="form-group">
                                <label>Customer permission</label>
                                <multiselect v-model="selectCustomers" :options="customerOptions" mode="tags"
                                             :searchable="true"
                                             placeholder="Select Customers"
                                             noResultsText="No results found"
                                             noOptionsText="The list is empty"
                                >
                                </multiselect>
                            </div>



                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Amount</label>
                                <input type="number" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Coupon Code</label><br>
                                <input type="radio" class="form-group" name="cpCode" value="Automated">
                                <input type="radio" class="form-group" name="cpCode" value="Manual">
                            </div>
                            <div class="form-group">
                                <label>Expiry Date</label>
                                <input type="date" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Amount Type <span class="text-red">*</span></label>
                                <select class="form-control">
                                    <option value="active">Enable</option>
                                    <option value="inactive">Disable</option>
                                </select>
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
import Multiselect from '@vueform/multiselect'


export default {
    components: {
        Alert,
        Header,
        Multiselect
    },
    props: ['data','errors', 'createMode','viewMode', 'editMode', 'link', 'title', 'label'],
    data () {
        return {
            file:null,
            selectBrands: [],
            selectCategories: [],
            selectCustomers: [],
            brandOptions: [],
            categoriesOptions: [],
            customerOptions: [],

            form: {
                index:'',
                id: undefined,
                name:null,


            }
        }
    },
    mounted () {
        let brands = this.data.brands;
        let categories = this.data.categories;
        let customers = this.data.customers;
        let i = 0
        this.brandOptions=[]
        for(i=0; i<brands.length; i++){
            this.brandOptions.push({
                value: brands[i].id,
                label: brands[i].name
            })
        }
        for(i=0; i<categories.length; i++){
            this.categoriesOptions.push({
                value: categories[i].id,
                label: categories[i].name
            })
        }
        for(i=0; i<customers.length; i++){
            this.customerOptions.push({
                value: customers[i].id,
                label: customers[i].name
            })
        }
    },
    methods: {

        save(params){
            var data = new FormData()
            data.append('name', params.name || '')
            data.append('logo', this.file || '')

            this.$inertia.post('/brand', data);
        },
        save_create(params){
            params['create_another'] = 1;
            this.$inertia.post('/categories/store', params);
            this.form ={}
        },
        Edit(){
            this.$inertia.get('/brand/'+this.data.id+'/edit');

        },
        update(params){
            var data = new FormData()
            data.append('name', params.name || '')
            data.append('logo', this.file || '')

            this.$inertia.post('/brand/'+this.data.id+'/update', data);

        },
        handleFileUpload(){
            this.file = this.$refs.file.files[0];
        }


    }
}
</script>

<style src="@vueform/multiselect/themes/default.css"></style>

