<template>
    <form class="ml-3">
        <div class="row">
            <div class="col-md-5 card-box">

                <h6 class="my-2">Select Categories</h6>
                <div>
                    <label for="name">Category<span class="text-red">*</span></label>
                    <Select2 v-model="form.category_id" :options="myOptions"  />
                </div>
                <div>
                    <label for="name">Sub Category step one<span class="text-red">*</span></label>
                    <Select2 v-model="form.subcategory_twos_id" :options="mySubCategoriesStepOne"  />
                </div>
            </div>
            <div class="col-md-5 ml-3 card-box">
                <h6 class="my-2">Report Information</h6>
                <div class="form-group">
                    <label for="name">Sub Category step two name<span class="text-red">*</span></label>
                    <input type="text" class="form-control" id="name" v-model="form.name">
                    <div class="text-danger" v-if="errors.name">{{ errors.name}}</div>
                </div>
            </div>
        </div>
        <div class="col-md-10 mb-5">
            <div class="m-t-10 text-center">
                <button
                    type="button"
                    class="form-submit-btn  pull-right  ml-10"
                    wire:click.prevent="store()"
                    @click="save(form, 'next')"
                >
                    Next
                </button>

                <button
                    style="background-color: #FF451A"
                    type="button"
                    class="form-submit-btn  ml-10  pull-right "
                    wire:click.prevent="store()"
                    @click="cancel()"
                >
                    Cancel
                </button>
            </div>
        </div>
    </form>


</template>

<script>
import Alert from "@/Pages/Component/Alert";
import Header from "@/Pages/Component/Header";
import Select2 from 'vue3-select2-component';


export default {
    components: {
        Alert,
        Header,
        Select2

    },
    props: ['data','errors', 'createMode','viewMode', 'editMode', 'link', 'title', 'label'],
    data () {
        return {
            myOptions:[{id:null, text: ''}],
            mySubCategoriesStepOne:[{id:null, text: ''}],
            form: {
                index:'',
                id: undefined,
                name:null,
                category_id:null,
                subcategory_twos_id:null

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
        for (let i=0; i<this.data.categories.length; i++){
            this.myOptions.push({
                id:this.data.categories[i].id,
                text:this.data.categories[i].name
            })
        }
            for (let j=0; j<this.data.sub_categories.length; j++){
                this.mySubCategoriesStepOne.push({
                    id:this.data.sub_categories[j].id,
                    text:this.data.sub_categories[j].name
                })

        }
    },
    methods: {
        save(params){
            this.$inertia.post('/categories/subcategoriesTwo/store', params);
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
        },


    }
}
</script>
<style>

</style>
