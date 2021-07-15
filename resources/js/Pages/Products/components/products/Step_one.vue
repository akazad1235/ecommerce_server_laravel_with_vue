<template>
    <form class="ml-3">
        <div class="row">
            <div class="col-md-5 card-box">
                <h6 class="my-2">Product Information</h6>
                <div class="form-group">
                    <label for="name">Name<span class="text-red">*</span></label>
                    <input type="text" class="form-control" id="name" v-model="form.name">
                    <div class="text-danger" v-if="errors.name">{{ errors.name}}</div>
                </div>
                <div class="form-group">
                        <label for="name">Select Brand<span class="text-red">*</span></label>
                        <Select2 v-model="form.subcategory_twos_id" :options="mySubCategoriesStepOne"  />
                </div>
                <div class="form-group">
                    <label for="name">Select Category<span class="text-red">*</span></label>
                    <Select2 v-model="form.subcategory_twos_id" :options="mySubCategoriesStepOne"  />
                </div>
                <div class="form-group">
                    <input type="checkbox" v-model="subCatsOne">
                    If you have a sub category one
                </div>
                <div v-if="subCatsOne == true" class="form-group">
                    <label for="name">Select Category</label>
                    <Select2 v-model="form.subcategory_twos_id" :options="mySubCategoriesStepOne"  />
                </div>
                <div  class="form-group">
                    <input type="checkbox" v-model="subCatsTwo">
                    If you have a sub category two
                </div>
                <div v-if="subCatsTwo == true" class="form-group">
                    <label for="name">Select Category</label>
                    <Select2 v-model="form.subcategory_twos_id" :options="mySubCategoriesStepOne"  />
                </div>
                <div class="form-group">
                    <label for="name">Status</label>
                    <Select2 v-model="form.subcategory_twos_id" :options="mySubCategoriesStepOne"  />
                </div>
                <div class="form-group">
                    <label for="name">Remark</label>
                    <Select2 v-model="form.subcategory_twos_id" :options="mySubCategoriesStepOne"  />
                </div>

            </div>
            <div class="col-md-5 ml-3 card-box ">

                <div class="form-group mt-5">
                    <label for="name">Price<span class="text-red">*</span></label>
                    <input type="number" class="form-control" id="name" v-model="form.name">
                    <div class="text-danger" v-if="errors.name">{{ errors.name}}</div>
                </div>
                <div class="form-group">
                    <label for="name">Main Image<span class="text-red">*</span></label>
                    <input type="file" class="form-control" id="name" >
                    <div class="text-danger" v-if="errors.name">{{ errors.name}}</div>
                </div>
                <div class="form-group">
                    <label for="name">Sort Description<span class="text-red">*</span></label>
                    <textarea name="sort-des" id="" cols="56" rows="7"></textarea>
                    <div class="text-danger" v-if="errors.name">{{ errors.name}}</div>
                </div>
                <div class="form-group">
                    <label for="name">Description<span class="text-red">*</span></label>
                    <textarea name="desc" id="" cols="56" rows="7"></textarea>
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
            subCatsOne:false,
            subCatsTwo:false,
            myOptions:[{id:null, text: ''}],
            mySubCategoriesStepOne:[{id:null, text: ''}],
            form: {
                index:'',
                id: undefined,
                name:null,


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
