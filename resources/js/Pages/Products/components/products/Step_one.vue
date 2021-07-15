<template>
    <form class="ml-3">
        <div class="row">
            <div class="col-md-5 card-box">
                <h6 class="my-2">Product Information</h6>
                <div class="form-group">
                    <label for="name">Name<span class="text-red">*</span></label>
                    <input type="text" class="form-control" id="name" v-model="form.title">
                    <div class="text-danger" v-if="errors.title">{{ errors.title}}</div>
                </div>
                <div class="form-group">
                        <label for="name">Select Brand<span class="text-red">*</span></label>
                        <Select2 v-model="form.brand_id" :options="myBrands"  />
                    <div class="text-danger" v-if="errors.brand_id">{{ errors.brand_id}}</div>
                </div>
                <div class="form-group">
                    <label for="name">Select Category<span class="text-red">*</span></label>
                    <Select2 v-model="form.category_id" :options="myCategories"  />
                    <div class="text-danger" v-if="errors.category_id">{{ errors.category_id}}</div>
                </div>
                <div class="form-group">
                    <input type="checkbox" v-model="subCatsOne">
                    If you have a sub category one
                </div>
                <div v-if="subCatsOne == true" class="form-group">
                    <label for="name">Select Category</label>
                    <Select2 v-model="form.subcategory_twos_id" :options="mySubCategoriesStepOne"  />
                    <div class="text-danger" v-if="errors.subcategory_twos_id">{{ errors.subcategory_twos_id}}</div>
                </div>
                <div  class="form-group">
                    <input type="checkbox" v-model="subCatsTwo">
                    If you have a sub category two
                </div>
                <div v-if="subCatsTwo == true" class="form-group">
                    <label for="name">Select Category</label>
                    <Select2 v-model="form.subcategory_twos_id" :options="mySubCategoriesStepOne"  />
                    <div class="text-danger" v-if="errors.subcategory_twos_id">{{ errors.subcategory_twos_id}}</div>
                </div>
                <div class="form-group">
                    <label for="name">Status</label>
                    <Select2 v-model="form.status" :options="myStatus"  />
                    <div class="text-danger" v-if="errors.status">{{ errors.status}}</div>
                </div>
                <div class="form-group">
                    <label for="name">Remark</label>
                    <Select2 v-model="form.remark" :options="myRemark"  />
                    <div class="text-danger" v-if="errors.remark">{{ errors.remark}}</div>
                </div>

            </div>
            <div class="col-md-5 ml-3 card-box ">

                <div class="form-group mt-5">
                    <label for="price">Price<span class="text-red">*</span></label>
                    <input type="number" class="form-control" id="price" v-model="form.price">
                    <div class="text-danger" v-if="errors.price">{{ errors.price}}</div>
                </div>
                <div class="form-group">
                    <label for="img">Main Image<span class="text-red">*</span></label>
                    <input type="file" class="form-control"  id="img"  ref="file" v-on:change="handleFileUpload()"/>
                    <div class="text-danger" v-if="errors.image">{{ errors.image}}</div>
                </div>
                <div class="form-group">
                    <label for="sort-text">Sort Description<span class="text-red">*</span></label>
                    <textarea name="sort-des" id="sort-text" cols="56" rows="7" v-model="form.sort_desc"></textarea>
                    <div class="text-danger" v-if="errors.sort_desc">{{ errors.sort_desc}}</div>
                </div>
                <div class="form-group">
                    <label for="desc">Description<span class="text-red">*</span></label>
                    <textarea name="desc" id="desc" cols="56" rows="7" v-model="form.desc"></textarea>
                    <div class="text-danger" v-if="errors.desc">{{ errors.desc}}</div>
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
            myBrands:[{id:null, text: ''}],
            myCategories:[{id:null, text: ''}],
            myStatus:[{id:'active', text: 'Active'},{id:'inactive', text: 'Inactive'}],
            myRemark:[{id:'new', text: 'New'},{id:'featured', text: 'Featured'},{id:'collection', text: 'Collection'}],
            mySubCategoriesStepOne:[{id:null, text: ''}],
            file:null,
            form: {
                index:'',
                id: undefined,
                title:null,
                brand_id:null,
                category_id:null,
                status:null,
                remark:null,
                price:null,
                sort_desc:null,
                desc:null

            }
        }
    },
    created () {
        for (var i=0; i<this.data.brands.length; i++){
            this.myBrands.push({
                id:this.data.brands[i].id,
                text:this.data.brands[i].name,
            })
        }
        for (var i=0; i<this.data.categories.length; i++){
            this.myCategories.push({
                id:this.data.categories[i].id,
                text:this.data.categories[i].name,
            })
        }
        if(this.viewMode){
            this.form.name = this.data.name
        }
        if(this.editMode){
            this.form.name=this.data.name
        }
    },
    methods: {

        save(params){
            var data = new FormData()
            data.append('title', params.title || '')
            data.append('brand_id', params.brand_id || '')
            data.append('category_id', params.category_id || '')
            data.append('status', params.status || '')
            data.append('remark', params.remark || '')
            data.append('price', params.price || '')
            data.append('sort_desc', params.sort_desc || '')
            data.append('desc', params.desc || '')
            data.append('image', this.file || '')
            this.$inertia.post('/products/store', data);
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
        handleFileUpload(){
            this.file = this.$refs.file.files[0];
        }


    }
}
</script>
<style>

</style>
